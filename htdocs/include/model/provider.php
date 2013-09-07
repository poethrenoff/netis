<?php
class model_provider extends model
{
    // Возвращает файлы провайдера
    public function get_advice_list()
    {
        return model::factory('provider_advice')->get_list(array('advice_provider' => $this->get_id()), array('advice_type' => 'asc'));
    }
    
    // Возвращает товары, привязанные к провайдеру
    public function get_product_list()
    {
        $product_list = db::select_all('
            select
                product.*
            from
                product
                inner join provider_product using(product_id)
            where
                provider_product.provider_id = :provider_id and product.product_active = :product_active
            order by
                product.product_title',
            array(
                'provider_id' => $this->get_id(), 'product_active' => 1,
            )
        );
        
        return model::factory('product')->get_batch($product_list);
    }
}