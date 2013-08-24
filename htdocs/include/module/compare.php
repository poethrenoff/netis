<?php
class module_compare extends module
{
    protected function action_index()
    {
        $compare = compare::factory();
        
        if ($compare->get_type()) {
            $product_type = model::factory('product_type')->get($compare->get_type());
            
            $property_list = $product_type->get_property_list();
            $property_group_list = $product_type->get_property_group_list();
            
            $product_list = array(); $property_compare_list = array();
            foreach ($compare->get() as $product_type => $product_list) {
                foreach ($product_list as $product_id) {
                    $product_list[$product_id] = model::factory('product')->get($product_id);
                    $product_property_list = $product_list[$product_id]->get_property_list();
                    foreach ($product_property_list as $property_group_id => $product_property_group_list) {
                        foreach ($product_property_group_list as $property_id => $product_property) {
                            $property_compare_list[$property_group_id][$property_id][$product_id] =
                                $product_property->get_property_value();
                        }
                    }
                }
            }
            foreach ($property_compare_list as $property_group_id => $property_group_compare_list) {
                foreach ($property_group_compare_list as $property_id => $property_value_list) {
                    $property_compare_list[$property_group_id][$property_id]['equals'] =
                        count($property_value_list) == $compare->count() && count(array_unique($property_value_list)) == 1;
                    if ($property_compare_list[$property_group_id][$property_id]['equals'] && init_string('show') == 'diff') {
                        unset($property_compare_list[$property_group_id][$property_id]);
                    }
                }
            }
            
            $this->view->assign('product_list', $product_list);
            $this->view->assign('property_list', $property_list);
            $this->view->assign('property_group_list', $property_group_list);
            $this->view->assign('property_compare_list', $property_compare_list);
        }
        
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
        
        if ($compare->count() >= $limit) {
            $this->content = json_encode(array(
                'error' => 'Извините, сравнение более ' . declOfNum($limit, array('товара', 'товаров', 'товаров')) . ' не предусмотрено',
            ));
        } elseif ($compare->get_type() && $compare->get_type() != $product->get_product_type() && !isset($_REQUEST['confirm'])) {
            $this->content = json_encode(array(
                'confirm' => 'Сравнение товаров разных типов невозможно. Добавить новый товар, удалив прежний список?',
            ));
        } else {
            $compare->add($product->get_id(), $product->get_product_type());
            
            $this->view->assign($compare);
            $this->view->fetch('module/compare/info');
            
            $this->content = json_encode(array(
                'message' => $this->view->fetch('module/compare/info'),
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