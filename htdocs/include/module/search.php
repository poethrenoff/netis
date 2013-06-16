<?php
class module_search extends module
{
    protected $filter_clause = '';
    protected $filter_binds = array();
    
    protected $search_tables = array(
        'news', 'product', 'product_file', 'faq',
    );
    
    protected function action_index()
    {
        $search_value = trim(init_string('keyword'));
        $this->set_filter_condition($search_value);
        
        $total = $this->get_count();
        $count = max(1, intval($this->get_param('count')));
        
        $pages = paginator::construct($total, array('by_page' => $count));
        
        $result_list = $this->get_result($pages['by_page'], $pages['offset']);
        
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
        
        $result_list = $this->get_result($short_count);
        
        $this->view->assign('result_list', $result_list);
        $this->content = $this->view->fetch('module/search/get_result');
    }
    
    protected function action_form()
    {
        $this->content = $this->view->fetch('module/search/form');
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    protected function get_count()
    {
        $query = 'select count(*) from (' . $this->filter_clause . ') as tmp';
        return db::select_cell($query, $this->filter_binds);
    }
    
    protected function get_result($limit = null, $offset = null)
    {
        $limit_clause = $this->get_limit_clause($limit, $offset);
        $query = 'select * from (' . $this->filter_clause . ') as tmp ' . $limit_clause;
        $result_list = db::select_all($query, $this->filter_binds);
        
        foreach ($result_list as $result_index => $result_item) {
            $model = model::factory($result_item['search_table'])->get($result_item['primary_field']);
            
            $result_list[$result_index]['result_url'] = $model->get_result_url();
            $result_list[$result_index]['result_title'] = $model->get_result_title();
            $result_list[$result_index]['result_content'] = $model->get_result_content($result_item['result_field']);
        }
        
        return $result_list;
    }
    
    protected function set_filter_condition($search_value, $limit = null)
    {
        $search_words = preg_split('/\s+/', $search_value);
        
        $filter_binds = array();
        foreach ($this->search_tables as $search_table) {
            $model = model::factory($search_table);
            
            $table_filter_clause = array();
            foreach ($model->get_search_fields() as $field_name) {
                $field_filter_clause = array();
                foreach ($search_words as $search_index => $search_word) {
                    $field_prefix = $search_table . '_' . $field_name . '_' . $search_index;
                    $field_filter_clause[] = 'lower(' . $search_table  . '.' . $field_name . ') like :' . $field_prefix;
                    $filter_binds[$field_prefix] = '%' . mb_strtolower($search_word , 'utf-8') . '%';
                }
                $table_filter_clause[] = join(' and ', $field_filter_clause);
            }
            
            $conditions_clause = array();
            foreach ($model->get_search_conditions() as $field_name => $field_value) {
                $field_prefix = $search_table . '_' . $field_name;
                $conditions_clause[] = $search_table . '.' . $field_name . ' = :' . $field_prefix;
                $filter_binds[$field_prefix] = $field_value;
            }
            
            $limit_clause = $this->get_limit_clause($limit);
            
            $search_clause[] = '(
                select ' . $model->get_primary_field() . ' as primary_field,
                ' . $model->get_main_field() . ' as result_field,
                \'' . $search_table . '\' as search_table from ' . $search_table . '
                where (' . join(' or ', $table_filter_clause) . ')' .
                    ($conditions_clause ? ( ' and ' . join(' and ', $conditions_clause) ) : '') . '
                ' . $limit_clause . '
            )';
        }
        
        $this->filter_binds = $filter_binds;
        $this->filter_clause = join(' union ', $search_clause);
    }
    
    protected function get_limit_clause($limit = null, $offset = null) {
        $limit_clause = '';
        if (isset($limit)) {
            $limit_clause .= 'limit ' . $limit;
            if (isset($offset)) {
                $limit_clause .= ' offset ' . $offset;
            }
        }
        return $limit_clause;
    }
}