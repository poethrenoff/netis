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
            $product = model::factory('product')->get(id());
        } catch (Exception $e) {
            not_found();
        }
        
        if (!$product->get_product_active()) {
            not_found();
        }
        
        $this->view->assign('product', $product);
        
        $this->view->assign('marker_list', $product->get_marker_list());
        $this->view->assign('picture_list', $product->get_picture_list());
        $this->view->assign('property_list', $product->get_property_list());
        $this->view->assign('property_group_list', $product->get_property_group_list());
        $this->view->assign('file_list', $product->get_file_list());
        $this->view->assign('certificate_list', $product->get_certificate_list());
        $this->view->assign('product_link_list', $product->get_product_link_list());
                
        $file_type_list = model::factory('product_file_type')->get_list(array(), array('type_order' => 'desc'));
        $this->view->assign('file_type_list', $file_type_list);
        
        $file_lang_list = model::factory('product_file_lang')->get_list();
        $this->view->assign('file_lang_list', $file_lang_list);
        
        $this->output['product'] = true;
        $this->output['meta_title'] = $product->get_product_title();
        
        $this->content = $this->view->fetch('module/product/item');
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Äîïîëíèòåëüíûå ïàğàìåòğû õıøà ìîäóëÿ
    protected function ext_cache_key()
    {
        return parent::ext_cache_key() + (id() ? array('_id' => id()) : array());
    }
}