<?php
class module_product extends module
{
    protected function action_index()
    {
        //
    }
    
    protected function action_hotbuys()
    {
        $product_list = model::factory('product')->get_list(
            array('product_leader' => 1)
        );
        
        $this->view->assign('product_list', $product_list);
        $this->content = $this->view->fetch('module/product/hotbuys');
    }
}