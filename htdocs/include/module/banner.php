<?php
class module_banner extends module
{
    // Вывод случайного баннера
    protected function action_index()
    {
        $banner_item = model::factory('banner')->get_banner();
        
        $this->view->assign($banner_item);
        $this->content = $this->view->fetch('module/banner/item');
    }
}