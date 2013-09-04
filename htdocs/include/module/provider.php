<?php
class module_provider extends module
{
    // Вывод списка партнеров
    protected function action_index()
    {
        $city_list = model::factory('city')->get_city_list_with_provider();
        $region_list = model::factory('region')->get_list(array(), array('region_title' => 'asc'));
        
        $city_by_region = array(); $city_on_top = array(); 
        foreach ($city_list as $city) {
            if ($city->get_city_on_top()) {
                $city_on_top[$city->get_id()] = $city;
            } else {
                $city_by_region[$city->get_city_region()][$city->get_id()] = $city;
            }
        }
        
        $this->view->assign('region_list', $region_list);
        $this->view->assign('city_on_top_list', $city_on_top);
        $this->view->assign('city_by_region_list', $city_by_region);
        
        $this->content = $this->view->fetch('module/provider/index');
    }
}