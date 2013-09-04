<?php
class model_city extends model
{
    // Возвращает список городов, где есть партнеры
    public function get_city_list_with_partner()
    {
        $city_list = db::select_all('
                select
                    city.*
                from
                    city
                    inner join partner on partner.partner_city = city.city_id
                where
                    partner.partner_active = :partner_active
                group by
                    city.city_id
                order by
                    city.city_title',
            array('partner_active' => 1)
        );
        
        return $this->get_batch($city_list);
    }
    
    // Возвращает список городов, где есть провайдеры
    public function get_city_list_with_provider()
    {
        $city_list = db::select_all('
                select
                    city.*
                from
                    city
                    inner join provider on provider.provider_city = city.city_id
                group by
                    city.city_id
                order by
                    city.city_title'
        );
        
        return $this->get_batch($city_list);
    }    
}