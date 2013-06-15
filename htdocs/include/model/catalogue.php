<?php
class model_catalogue extends hierarchy
{
    // Возвращает URL каталога
    public function get_catalogue_url()
    {
        static $catalogue_url_cache = array();
        
        if (isset($catalogue_url_cache[$this->get_id()])) {
            return $catalogue_url_cache[$this->get_id()];
        }
        
        $site = site();
        foreach ($site['page'] as $page) {
            foreach ($page['block'] as $block) {
                if ($block['module_name'] == 'product') {
                    foreach ($block['param'] as $param_name => $param_value) {
                        if ($param_name == 'catalogue' && $param_value == $this->get_id()) {
                            return $catalogue_url_cache[$this->get_id()] = $page['page_path'];
                        }
                    }
                }
            }
        }
        
        return $catalogue_url_cache[$this->get_id()] = '/';
    }
    
    // Возвращает подкаталоги данного каталога
    public function get_catalogue_list()
    {
        $parent_field = $this->is_new ? 0 : $this->get_id();
        return model::factory('catalogue')->get_list(
            array('catalogue_parent' => $parent_field, 'catalogue_active' => 1), array('catalogue_order' => 'asc')
        );
    }
    
    // Возвращает список товаров в данном каталоге (включая подкаталоги)
    public function get_product_list($with_children = true)
    {
        $product_list = model::factory('product')->get_list(
            array('product_catalogue' => $this->get_id(), 'product_active' => 1), array('product_order' => 'asc')
        );
        
        if ($with_children) {
            foreach ($this->get_catalogue_list() as $catalogue_item) {
                $product_list = array_merge($product_list, $catalogue_item->get_product_list($with_children));
            }
        }
        
        return $product_list;
    }
}