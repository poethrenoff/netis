<?php
class module_hotbuys extends module
{
    protected function action_index()
    {
        //
    }
    
    protected function action_short()
    {
        $product_list = model::factory('product')->get_list(
            array('product_leader' => 1)
        );
        
        $this->view->assign('product_list', $product_list);
        $this->content = $this->view->fetch('module/hotbuys/short');
    }
}