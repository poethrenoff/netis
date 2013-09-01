<?php
class model_partner extends model
{
    // Возвращает адреса партнера
    public function get_address_list()
    {
        return model::factory('partner_address')->get_list(array('address_partner' => $this->get_id()));
    }
}