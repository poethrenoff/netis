<?php
class model_product extends model
{
    // ���������� ����������� �� ���������
    public function get_product_image()
    {
        $record = db::select_row('
            select * from product_picture
            where picture_product = :picture_product
            order by picture_default desc',
                array('picture_product' => $this->get_id()));
        $picture = model::factory('product_picture')->get($record['picture_id'], $record);
        return $picture->get_picture_image();
    }
    
    // ���������� URL ������
    public function get_product_url()
    {
        // @todo ��������� ��� ��������
        // @todo ��������� �������������� ��������
        $catalogue = model::factory('catalogue')->get($this->get_product_catalogue());
        return url_for(array('controller' => $catalogue->get_catalogue_url(), 'id' => $this->get_id()));
    }
}