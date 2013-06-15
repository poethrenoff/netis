<?php
class model_marker extends model
{
    // Получение маркеров продукта
    public function get_by_product($product_id) {
        $records = db::select_all('
            select marker.* from marker
                inner join product_marker on product_marker.marker_id = marker.marker_id
            where product_marker.product_id = :product_id',
                array('product_id' => $product_id));
        return $this->get_batch($records);
    }
}