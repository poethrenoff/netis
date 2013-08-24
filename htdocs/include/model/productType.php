<?php
class model_productType extends model
{
    // Возвращает группы свойств типа товара
    public function get_property_group_list()
    {
        return model::factory('property_group')->get_list(
            array('group_type' => $this->get_id(), 'group_active' => 1), array('group_order' => 'asc')
        );
    }
    
    // Возвращает свойства типа товара, распределенные по группам
    public function get_property_list()
    {
        $product_type_property_list = db::select_all('
                select
                    *
                from
                    property
                    inner join property_group on property_group.group_id = property.property_group
                where
                    property_group.group_type = :product_type and property.property_active = :property_active
                order by
                    property.property_order',
            array('product_type' => $this->get_id(), 'property_active' => 1)
        );
        
        $property_list = array();
        foreach ($product_type_property_list as $product_property) {
            $property = model::factory('property')->get($product_property['property_id'], $product_property);
            $property_list[$property->get_property_group()][$property->get_id()] = $property;
        }
        return $property_list;
    }
}