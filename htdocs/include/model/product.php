<?php
class model_product extends model
{
    // ���������� URL ������
    public function get_product_url()
    {
        $catalogue = model::factory('catalogue')->get($this->get_product_catalogue());
        return url_for(array('controller' => $catalogue->get_catalogue_url(), 'id' => $this->get_id()));
    }
    
    // ���������� ������� ������
    public function get_marker_list()
    {
        return model::factory('marker')->get_by_product($this->get_id());
    }
    
    // ���������� ����������� ������
    public function get_picture_list()
    {
        return model::factory('product_picture')->get_list(
            array('picture_product' => $this->get_id()), array('picture_order' => 'asc')
        );
    }
    
    // ���������� ����� ������, �������������� �� �����
    public function get_download_list()
    {
        $product_file_list = model::factory('product_file')->get_list(
            array('file_product' => $this->get_id()), array('file_date' => 'desc')
        );
        
        $file_type_list = array_reindex(
            metadata::$objects['product_file']['fields']['file_type']['values'], 'value'
        );
        $file_lang_list = array_reindex(
            metadata::$objects['product_file']['fields']['file_lang']['values'], 'value'
        );
        
        $file_list = array();
        foreach ($product_file_list as $product_file) {
            $product_file->set_file_type($file_type_list[$product_file->get_file_type()]['title']);
            $product_file->set_file_lang($file_lang_list[$product_file->get_file_lang()]['title']);
            
            $file_list[$product_file->get_file_type()][] = $product_file;
        }
        return $file_list;

    }
    
    // ���������� ����������� �� ���������
    public function get_product_image()
    {
        $picture_list = model::factory('product_picture')->get_list(
            array('picture_product' => $this->get_id()), array('picture_order' => 'asc'), 1
        );
        $default_image = current($picture_list);
        return $default_image->get_picture_image();
    }
    
    // ���������� ������ ������� ������
    public function get_property_group_list()
    {
        return model::factory('property_group')->get_list(
            array('group_type' => $this->get_product_type(), 'group_active' => 1), array('group_order' => 'asc')
        );
    }
    
    // ���������� �������� ������, �������������� �� �������
    public function get_property_list()
    {
        $product_property_list = db::select_all('
                select
                    property.*, ifnull(property_value.value_title, product_property.value) as property_value
                from
                    property
                    left join product_property on product_property.property_id = property.property_id
                    left join property_value on property_value.value_property = property.property_id and
                        property_value.value_id = product_property.value
                where
                    product_property.product_id = :product_id and property.property_active = :property_active
                order by
                    property.property_order',
            array('product_id' => $this->get_id(), 'property_active' => 1)
        );
        
        $property_list = array();
        foreach ($product_property_list as $product_property) {
            $property = model::factory('property')->get($product_property['property_id'], $product_property)
                ->set_property_value($product_property['property_value']);
            $property_list[$property->get_property_group()][] = $property;
        }
        return $property_list;
    }
    
    // ���������� ������ ��������������� �������
    public function get_product_link_list()
    {
        $product_link_list = db::select_all('
                select
                    product.*
                from
                    product
                    inner join product_link on product_link.link_product_id = product.product_id
                where
                    product_link.product_id = :product_id and product.product_active = :product_active
                order by
                    product.product_order',
            array('product_id' => $this->get_id(), 'product_active' => 1)
        );
        return model::factory('product')->get_batch($product_link_list);
    }
}