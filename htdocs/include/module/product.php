<?php
class module_product extends module
{
    protected function action_index()
    {
        if (id()) {
            $this->action_item();
            return;
        }
        
        $catalogue_id = $this->get_param('catalogue');
        $catalogue_tree = model::factory('catalogue')->get_tree(
            model::factory('catalogue')->get_list(
                array('catalogue_active' => 1), array('catalogue_order' => 'asc')
            ), $catalogue_id
        );
        
        $this->view->assign('catalogue_tree', $catalogue_tree);
        
        if ($catalogue_tree->has_children()) {
            $this->content = $this->view->fetch('module/product/catalogue');
        } else {
            $product_list = model::factory('product')->get_list(
                array('product_catalogue' => $catalogue_id, 'product_active' => 1),
                array('product_leader' => 'desc', 'product_order' => 'asc')
            );
            $this->view->assign('product_list', $product_list);
            $this->content = $this->view->fetch('module/product/list');
        }
    }
    
    protected function action_item()
    {
        try {
            $item = model::factory('product')->get(id());
        } catch (Exception $e) {
            not_found();
        }
        
        $this->view->assign($item);
        $this->output['product'] = true;
        $this->output['meta_title'] = $item->get_product_title();
        $this->content = $this->view->fetch('module/product/item');
    }
}