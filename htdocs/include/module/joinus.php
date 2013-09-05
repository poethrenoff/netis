<?php
class module_joinus extends module
{
    // Форма приглашения к сотрудничеству
    protected function action_index()
    {
        $type_values = array();
        foreach (metadata::$objects['partner']['fields']['partner_type']['values'] as $value) {
            $type_values[$value['value']] = $value['title'];
        }
        
        $city_list = model::factory('city')->get_list(array(), array('city_title' => 'asc'));
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
            $error = array();
            
            $require_fields = array('title', 'site', 'city', 'address',
                'type', 'fio', 'email', 'skype', 'phone', 'contact_phone');
            foreach ($require_fields as $field_name) {
                if (!isset($_POST[$field_name]) || is_empty($_POST[$field_name])) {
                    $error[$field_name] = 'Не заполнено обязательное поле';
                }
            }
            if (!isset($error['type']) && !in_array($_POST['type'], array_keys($type_values))) {
                $error['type'] = 'Поле заполнено некорректно';
            }
            if (!isset($error['city']) && !in_array($_POST['city'], array_keys($city_list))) {
                $error['city'] = 'Поле заполнено некорректно';
            }
            if (!isset($error['email']) && !valid::factory('email')->check($_POST['email'])) {
                $error['email'] = 'Поле заполнено некорректно';
            }
            
            $_POST['logo'] = '';
            if (isset($_FILES['logo']['name']) && $_FILES['logo']['name']) {
                $upload = upload::fetch('logo', array('upload_path' => 'partner',
                    'allowed_types' => 'gif|jpg|jpe|jpeg|png', 'max_filesize' => 500 * 1024));
                if ($upload->is_error()) {
                    $error['logo'] = $upload -> get_error();
                } else {
                    $_POST['logo'] = $upload->get_file_link();
                }
            }
            
            if (!$error) {
                // Сохранение партнера в базе
                $partner = model::factory('partner')
                    ->set_partner_title($_POST['title'])
                    ->set_partner_site($_POST['site'])
                    ->set_partner_city($_POST['city'])
                    ->set_partner_type($_POST['type'])
                    ->set_partner_fio($_POST['fio'])
                    ->set_partner_email($_POST['email'])
                    ->set_partner_skype($_POST['skype'])
                    ->set_partner_phone($_POST['phone'])
                    ->set_partner_contact_phone($_POST['contact_phone'])
                    ->set_partner_logo($_POST['logo'])
                    ->set_partner_active(0)
                    ->save();
                
                // Сохранение адреса партнера в базе
                $partner_address = model::factory('partner_address')
                    ->set_address_title($_POST['address'])
                    ->set_address_partner($partner->get_id())
                    ->save();
                
                // Отправка сообщения
                $from_email = get_preference('from_email');
                $from_name = get_preference('from_name');
                
                $joinus_email = get_preference('joinus_email');
                $joinus_subject = get_preference('joinus_subject');
                
                $joinus_view = new view();
                $joinus_view->assign('city_list', $city_list);
                $joinus_view->assign('type_values', $type_values);
                $joinus_message = $joinus_view->fetch('module/joinus/message');
                
                sendmail::send($joinus_email, $from_email, $from_name, $joinus_subject, $joinus_message);
                
                session::flash('success', true);
                
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
            
            $this->view->assign('error', $error);
        }
        
        $this->view->assign('type_values', $type_values);
        $this->view->assign('region_list', $region_list);
        $this->view->assign('city_on_top_list', $city_on_top);
        $this->view->assign('city_by_region_list', $city_by_region);
        
        $this->content = $this->view->fetch('module/joinus/form');
    }
    
    // Отключаем кеширование
    protected function get_cache_key()
    {
        return false;
    }
}