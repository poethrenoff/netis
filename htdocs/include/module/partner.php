<?php
class module_partner extends module
{
    // Вывод списка партнеров
    protected function action_index()
    {
        $type_values = array();
        foreach (metadata::$objects['partner']['fields']['partner_type']['values'] as $value) {
            $type_values[$value['value']] = $value['title'];
        }
        
        $city_list = model::factory('city')->get_city_list_with_partner();
        $region_list = model::factory('region')->get_list(array(), array('region_title' => 'asc'));
        
        $city_by_region = array(); $city_on_top = array(); 
        foreach ($city_list as $city) {
            if ($city->get_city_on_top()) {
                $city_on_top[$city->get_id()] = $city;
            } else {
                $city_by_region[$city->get_city_region()][$city->get_id()] = $city;
            }
        }
        
        if (!empty($_POST)) {
            $partner_filter = array('partner_active' => 1);
            if ($_POST['city']) {
                $partner_filter['partner_city'] = $_POST['city'];
            }
            if ($_POST['type']) {
                $partner_filter['partner_type'] = $_POST['type'];
            }
            $partner_list = model::factory('partner')->get_list($partner_filter, array('partner_title' => 'asc'));
            $this->view->assign('partner_list', $partner_list);
        }
        
        $this->view->assign('type_values', $type_values);
        $this->view->assign('region_list', $region_list);
        $this->view->assign('city_list', $city_list);
        $this->view->assign('city_on_top_list', $city_on_top);
        $this->view->assign('city_by_region_list', $city_by_region);
        
        $this->content = $this->view->fetch('module/partner/index');
    }
}