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
}