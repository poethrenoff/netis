<?php
class module_joinus extends module
{
    // Форма приглашения к сотрудничеству
    protected function action_index()
    {
        $type_values = array(
            'distributor' => 'дистрибьютор', 'dealer' => 'дилер', 'retail' => 'розница',
        );
        
        if (!empty($_POST)) {
            $error = array();
            
            $require_fields = array('title', 'site', 'city', 'address',
                'type', 'fio', 'email', 'skype', 'phone');
            foreach ($require_fields as $field_name) {
                if (!isset($_POST[$field_name]) || is_empty($_POST[$field_name])) {
                    $error[$field_name] = 'Не заполнено обязательное поле';
                }
            }
            if (!isset($error['type']) && !in_array($_POST['type'], array_keys($type_values))) {
                $error['type'] = 'Поле заполнено некорректно';
            }
            if (!isset($error['email']) && !valid::factory('email')->check($_POST['email'])) {
                $error['email'] = 'Поле заполнено некорректно';
            }
            
            // Отправка сообщения
            if (!$error) {
                $from_email = get_preference('from_email');
                $from_name = get_preference('from_name');
                
                $joinus_email = get_preference('joinus_email');
                $joinus_subject = get_preference('joinus_subject');
                
                $joinus_view = new view();
                $joinus_view->assign('type_values', $type_values);
                $joinus_message = $joinus_view->fetch('module/joinus/message');
                
                sendmail::send($joinus_email, $from_email, $from_name, $joinus_subject, $joinus_message);
                
                session::flash('success', true);
                
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
            
            $this->view->assign('error', $error);
        }
        
        $this->content = $this->view->fetch('module/joinus/form');
    }
    
    // Отключаем кеширование
    protected function get_cache_key()
    {
        return false;
    }
}