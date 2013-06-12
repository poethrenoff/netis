<?php
class model_product extends model
{
    // ¬озвращает изображение по умолчанию
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
}