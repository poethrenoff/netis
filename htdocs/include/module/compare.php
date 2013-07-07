<?php
class module_compare extends module
{
    protected function action_index()
    {
        $this->view->assign(compare::factory());
        
        $this->output['product'] = true;
        $this->content = $this->view->fetch('module/compare/index');
    }
    
    protected function action_info()
    {
        $this->view->assign(compare::factory());
        $this->content = $this->view->fetch('module/compare/info');
    }
    
    protected function action_add()
    {
        try {
            $product = model::factory('product')->get(id());
        } catch (Exception $e) {
            not_found();
        }
        
        if (!$product->get_product_active()) {
            not_found();
        }
        
        $compare = compare::factory();
        $limit = max(1, intval($this->get_param('limit')));
        
        try {
            if ($compare->count() >= $limit) {
                throw new Exception('Нельзя добавить к сравнению более ' .
                    declOfNum($limit, array('товара', 'товаров', 'товаров')));
            }
            
            if ($compare->count() && $compare->get_type() != $product->get_product_type()) {
                throw new Exception('Нельзя сравнивать товары разного типа');
            }
            
            $compare->add($product->get_id(), $product->get_product_type());
            
            $this->view->assign($compare);
            $this->view->fetch('module/compare/info');
            
            $this->content = json_encode(array(
                'success' => true,
                'message' => $this->view->fetch('module/compare/info'),
            ));
        } catch (Exception $e) {
            $this->content = json_encode(array(
                'success' => false,
                'message' => $e->getMessage(),
            ));
        }
    }
    
    protected function action_delete()
    {
        compare::factory()->delete(id());
        redirect_back();
    }
    
    protected function action_clear()
    {
        compare::factory()->clear();
        redirect_back();
    }
    
    // Отключаем кеширование
    protected function get_cache_key()
    {
        return false;
    }
}