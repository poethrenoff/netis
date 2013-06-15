<?php
class module_download extends module
{
    // Вывод списка моделей
    protected function action_index()
    {
        $catalogue_list = model::factory('catalogue')->get_catalogue_list();
        $this->view->assign('catalogue_list', $catalogue_list);
        
        $file_type_list = model::factory('product_file_type')->get_list(array(), array('type_order' => 'desc'));
        $this->view->assign('file_type_list', $file_type_list);
        
        $this->content = $this->view->fetch('module/download/index');
    }
    
    // Вывод файлов для скачивания
    protected function action_item()
    {
        try {
            $product = model::factory('product')->get(id());
        } catch (Exception $e) {
            not_found();
        }
        
        $this->view->assign('product', $product);
        
        $this->view->assign('file_list', $product->get_file_list());
                
        $file_type_list = model::factory('product_file_type')->get_list(array(), array('type_order' => 'desc'));
        $this->view->assign('file_type_list', $file_type_list);
        
        $file_lang_list = model::factory('product_file_lang')->get_list();
        $this->view->assign('file_lang_list', $file_lang_list);
        
        $this->output['meta_title'] = $product->get_product_title();
        
        $this->content = $this->view->fetch('module/download/item');
    }
    
    // Получение списка товаров
    protected function action_get_product()
    {
        $product_list = model::factory('catalogue')->get(id())->get_product_list();
        
        $this->view->assign('product_list', $product_list);
        $this->view->display('module/download/get_product');
        exit;
    }
}