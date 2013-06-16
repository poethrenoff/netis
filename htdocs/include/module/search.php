<?php
class module_search extends module
{
    protected $filter_clause = '';
    protected $filter_binds = array();
    
    protected $search_tables = array(
        'news' => array(
            'primary_field' => 'news_id', 'main_field' => 'news_title', 
            'search_fields' => array(
                'news_title', 'news_announce', 'news_content',
            ),
        ),
        'product' => array(
            'primary_field' => 'product_id', 'main_field' => 'product_title', 
            'search_fields' => array(
                'product_code', 'product_title', 'product_description', 'product_features',
            ),
            'conditions' => array(
                'product_active' => 1,
            )
        ),
        'product_file' => array(
            'primary_field' => 'file_id', 'main_field' => 'file_title', 
            'search_fields' => array(
                'file_title',
            ),
        ),
        'faq' => array(
            'primary_field' => 'faq_id', 'main_field' => 'faq_question', 
            'search_fields' => array(
                'faq_question', 'faq_answer',
            ),
        )
    );
    
    protected function action_index()
    {
        $search_value = trim(init_string('keyword'));
        $this->set_filter_condition($search_value);
        
        $total = $this->get_count();
        $count = max(1, intval($this->get_param('count')));
        
        $pages = paginator::construct($total, array('by_page' => $count));
        
        $result_list = $this->get_list($pages['by_page'], $pages['offset']);
        
        $this->adjunct_result($result_list);
        
        $this->view->assign('result_list', $result_list);
        
        $this->output['product'] = true;
        $this->content = $this->view->fetch('module/search/index');
    }
    
    protected function action_get_result()
    {
        $short_count = max(1, intval($this->get_param('short_count')));
        $group_count = floor($short_count / count($this->search_tables));
        
        $search_value = trim(init_string('keyword'));
        $this->set_filter_condition($search_value, $group_count);
        
        $result_list = $this->get_list($short_count);
        
        $this->adjunct_result($result_list);
        
        $this->view->assign('result_list', $result_list);
        $this->view->display('module/search/get_result');
        exit;
    }
    
    protected function adjunct_result(&$result_list)
    {
        foreach ($result_list as $result_index => $result_item) {
            switch ($result_item['search_table']) {
                case 'news':
                    $result_list[$result_index]['result_title'] = 'Новости';
                    $result_list[$result_index]['result_url'] = url_for(array('controller' => 'about/news', 'action' => 'item', 'id' => $result_item['primary_field']));
                    break;
                case 'product':
                    $product = model::factory('product')->get($result_item['primary_field']);
                    $catalogue = model::factory('catalogue')->get($product->get_product_catalogue());
                    $result_list[$result_index]['result_title'] = 'Товары / ' . $catalogue->get_catalogue_title();
                    $result_list[$result_index]['result_url'] = $product->get_product_url();
                    break;
                case 'product_file':
                    $product_file = model::factory('product_file')->get($result_item['primary_field']);
                    $result_list[$result_index]['result_title'] = 'Скачать';
                    $result_list[$result_index]['result_url'] = url_for(array('controller' => 'support/download', 'action' => 'item', 'id' => $product_file->get_file_product()));
                    break;
                case 'faq':
                    $result_list[$result_index]['result_title'] = 'FAQ';
                    $result_list[$result_index]['result_url'] = url_for(array('controller' => 'support/faq', 'action' => 'item', 'id' => $result_item['primary_field']));
                    break;
            }
            $content = strip_tags(trim($result_item['main_field']));
            $content = (mb_strlen($content, 'utf-8') > 80) ? mb_substr($content, 0, 80, 'utf-8') . '...' : $content;
            $result_list[$result_index]['main_field'] = $content;
        }
    }
    
    protected function get_count()
    {
        $query = 'select count(*) from (' . $this->filter_clause . ') as tmp';
        return db::select_cell($query, $this->filter_binds);
    }
    
    protected function get_list($limit = null, $offset = null)
    {
        $limit_clause = $this->get_limit_clause($limit, $offset);
        $query = 'select * from (' . $this->filter_clause . ') as tmp ' . $limit_clause;
        return db::select_all($query, $this->filter_binds);
    }
    
    protected function set_filter_condition($search_value, $limit = 0)
    {
        $search_words = preg_split('/\s+/', $search_value);
        
        $filter_binds = array();
        foreach ($this->search_tables as $search_table => $table_desc) {
            $table_filter_clause = array();
            foreach ($table_desc['search_fields'] as $field_name) {
                $field_filter_clause = array();
                foreach ($search_words as $search_index => $search_word) {
                    $field_prefix = $search_table . '_' . $field_name . '_' . $search_index;
                    $field_filter_clause[] = 'lower(' . $search_table  . '.' . $field_name . ') like :' . $field_prefix;
                    $filter_binds[$field_prefix] = '%' . mb_strtolower($search_word , 'utf-8') . '%';
                }
                $table_filter_clause[] = join(' and ', $field_filter_clause);
            }
            
            $conditions_clause = array();
            if (isset($table_desc['conditions']) && $table_desc['conditions']) {
                foreach ($table_desc['conditions'] as $field_name => $field_value) {
                    $field_prefix = $search_table . '_' . $field_name;
                    $conditions_clause[] = $search_table . '.' . $field_name . ' = :' . $field_prefix;
                    $filter_binds[$field_prefix] = $field_value;
                }
            }
            $search_clause[] = '(
                select ' . $table_desc['primary_field'] . ' as primary_field,
                ' . $table_desc['main_field'] . ' as main_field,
                \'' . $search_table . '\' as search_table from ' . $search_table . '
                where (' . join(' or ', $table_filter_clause) . ')' .
                    ($conditions_clause ? ( ' and ' . join(' and ', $conditions_clause) ) : '') .
                ($limit ? ' limit ' . $limit : '') . '
            )';
        }
        
        $this->filter_binds = $filter_binds;
        $this->filter_clause = join(' union ', $search_clause);
    }
    
    protected function get_limit_clause($limit = 0, $offset = 0) {
        $limit_clause = '';
        if (isset($limit)) {
            $limit_clause .= 'limit ' . $limit;
            if (isset($offset)) {
                $limit_clause .= ' offset ' . $offset;
            }
        }
        return $limit_clause;
    }
    
    protected function action_form()
    {
        $this->content = $this->view->fetch('module/search/form');
    }
}