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
        
        if (init_string('city')) {
            $provider_list = model::factory('provider')->get_list(array('provider_city' => init_string('city')));
            
            $this->view->assign('provider_list', $provider_list);
        }
        
        if (init_string('provider')) {
            try {
                $provider = model::factory('provider')->get(init_string('provider'));
                
                $this->view->assign('provider', $provider);
                
                $advice_list = $provider->get_advice_list(); $advice_list_by_type = array();
                foreach ($advice_list as $advice) {
                    $advice_list_by_type[$advice->get_advice_type()][$advice->get_id()] = $advice;
                }
                if (isset($advice_list_by_type['letter'])) {
                    $this->view->assign('letter_list', $advice_list_by_type['letter']);
                }
                if (isset($advice_list_by_type['instruction'])) {
                    $this->view->assign('instruction_list', $advice_list_by_type['instruction']);
                }
                
                $this->view->assign('product_list', $provider->get_product_list());
            } catch (AlarmException $e) {
                not_found();
            }
        }
        
        $this->view->assign('region_list', $region_list);
        $this->view->assign('city_on_top_list', $city_on_top);
        $this->view->assign('city_by_region_list', $city_by_region);
        
        $this->content = $this->view->fetch('module/provider/index');
    }
    
    // Получение списка провайденов
    protected function action_get_provider()
    {
        $provider_list = model::factory('provider')->get_list(array('provider_city' => id()));
        
        $this->view->assign('provider_list', $provider_list);
        $this->content = $this->view->fetch('module/provider/get_provider');
    }
}