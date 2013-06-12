<?php
class admin_table_product extends admin_table
{
    protected function action_copy_save($redirect = true)
    {
        $primary_field = parent::action_copy_save(false);
        
        // Копируем изображения товара
        $product_picturies = db::select_all('
                select * from product_picture where picture_product = :picture_product',
            array('picture_product' => id()));
        foreach($product_picturies as $product_picture) {
            unset($product_picture['picture_id']);
            db::insert('product_picture', array('picture_product' => $primary_field) + $product_picture);
        }
        
        // Копируем файлы товара
        $product_files = db::select_all('
                select * from product_file where file_product = :file_product',
            array('file_product' => id()));
        foreach($product_files as $product_file) {
            unset($product_file['file_id']);
            db::insert('product_file', array('file_product' => $primary_field) + $product_file);
        }
        
        // Копируем свойства товара
        $product_properties = db::select_all('
                select property, value from product_property where product = :product',
            array('product' => id()));
        foreach($product_properties as $product_property)
            db::insert('product_property', array('product' => $primary_field) + $product_property);
        
        if ($redirect)
            $this->redirect();
        
        return $primary_field;
    }
    
    protected function action_delete($redirect = true)
    {
        $record = $this->get_record();
        $primary_field = $record[$this->primary_field];
        
        parent::action_delete(false);
        
        db::delete('product_property', array('product' => $primary_field));
        
        if ($redirect)
            $this->redirect();
    }
    
    protected function action_property()
    {
        $record = $this->get_record();
        $primary_field = $record[$this->primary_field];
        
        $properties = db::select_all('
                select property.property_id, property.property_title, property.property_kind,
                    product_property.value, property.property_unit, property.property_group, property_group.group_title
                from property
                    inner join property_group on property_group.group_id = property.property_group
                    inner join product on property_group.group_type = product.product_type
                    left join product_property on product_property.property = property.property_id and
                        product_property.product = product.product_id
                where product.product_id = :product_id
                order by property_group.group_order, property.property_order',
            array('product_id' => $primary_field));
        
        $form_fields = array();
        foreach($properties as $property_index => $property_value)
        {
            if (!isset($form_fields['group[' . $property_value['property_group'] . ']'])) {
                $form_fields['group[' . $property_value['property_group'] . ']'] = array(
                    'title' => $property_value['group_title'], 'type' => 'group'
               );
            }
            
            $property_type = $property_value['property_kind'] == 'number' ? 'float' : $property_value['property_kind'];
            $property_errors = $property_type == 'float' ? 'float' : '';
            
            $form_fields['property[' . $property_value['property_id'] . ']'] = array(
                'title' => $property_value['property_title'] . ($property_value['property_unit'] ?
                    ' (' . $property_value['property_unit'] . ')' : ''),
                'type' => $property_type, 'errors' => $property_errors,
                'value' => field::form_field($property_value['value'], $property_type));
            
            if ($property_value['property_kind'] == 'select')
            {
                $values = db::select_all('
                        select * from property_value
                        where value_property = :value_property
                        order by value_title',
                    array('value_property' => $property_value['property_id']));
                    
                $value_records = array();
                foreach ($values as $value)
                    $value_records[] = array('value' => $value['value_id'], 'title' => $value['value_title']);
                
                $form_fields['property[' . $property_value['property_id'] . ']']['values'] = $value_records;
            }
        }
       
        $record_title = $record[$this->main_field];
        $action_title = 'Редактирование свойств';
        
        $this->view->assign('record_title', $this->object_desc['title'] . ($record_title ? ' :: ' . $record_title : ''));
        $this->view->assign('action_title', $action_title);
        $this->view->assign('fields', $form_fields);
        
        $form_url = url_for(array('object' => $this->object, 'action' => 'property_save', 'id' => $primary_field));
        $this->view->assign('form_url', $form_url);
        
        $this->content = $this->view->fetch('admin/form');
        $this->output['meta_title'] .= ($record_title ? ' :: ' . $record_title : '') . ' :: ' . $action_title;
    }
    
    protected function action_property_save($redirect = true)
    {
        $record = $this->get_record();
        $primary_field = $record[$this->primary_field];
        
        $properties = db::select_all('
                select property.property_id, property.property_title, property.property_kind
                from property
                    inner join property_group on property_group.group_id = property.property_group
                    inner join product on property_group.group_type = product.product_type
                where product.product_id = :product_id',
            array('product_id' => $primary_field));
        
        $property_values = init_array('property');
        
        $insert_fields = array();
        foreach($properties as $property_index => $property_value)
        {
            $property_type = $property_value['property_kind'] == 'number' ? 'float' : $property_value['property_kind'];
            $property_errors_code = $property_type == 'float' ? field::$errors['float'] : 0;
            
            if (isset($property_values[$property_value['property_id']]))
                $insert_fields[$property_value['property_id']] =
                    field::set_field($property_values[$property_value['property_id']],
                array('title' => $property_value['property_title'],
                    'type' => $property_type, 'errors_code' => $property_errors_code));
        }
        
        db::delete('product_property', array('product' => $primary_field));
        foreach($insert_fields as $property_id => $property_value)
            if ($property_value !== null && $property_value !== '')
                db::insert('product_property', array(
                    'product' => $primary_field, 'property' => $property_id, 'value' => $property_value));
        
        if ($redirect)
            $this->redirect();
    }
    
    //////////////////////////////////////////////////////////////////////////
    
    protected function get_record_actions($record)
    {
        $actions = parent::get_record_actions($record);
        
        $actions['property'] = array('title' => 'Свойства', 'url' =>
            url_for(array('object' => $this->object, 'action' => 'property',
                'id' => $record[$this->primary_field])));
        
        return $actions;
    }
}
