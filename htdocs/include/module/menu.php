<?php
class module_menu extends module
{
    protected function action_index()
    {
        $menu_id = $this->get_param('id');
        $menu_template = $this->get_param('template');
        
        $menu_list = model::factory('menu')->get_list(
            array('menu_active' => 1), array('menu_order' => 'asc')
        );
        
        $site = site(); $current_page = page();
        $page_list = array_reindex($site['page'], 'page_id');
        foreach ($menu_list as $menu_index => $menu_item) {
            if (isset($page_list[$menu_item->get_menu_page()])) {
                $menu_url = $page_list[$menu_item->get_menu_page()]['page_path'];
                $menu_list[$menu_index]->set_menu_url($menu_url);
            }
        }
        
        $menu_tree = model::factory('menu')->get_tree($menu_list, $menu_id);
        
        $this->view->assign($menu_tree);
        $this->content = $this->view->fetch('module/menu/' . $menu_template);
    }
    
    protected function action_location()
    {
        $menu_id = $this->get_param('id');
        $menu_template = $this->get_param('template');
        
        $menu_list = model::factory('menu')->get_list(
            array('menu_active' => 1), array('menu_order' => 'asc')
        );
        
        $current_menu = null;
        $site = site(); $current_page = page();
        $page_list = array_reindex($site['page'], 'page_id');
        foreach ($menu_list as $menu_index => $menu_item) {
            if (isset($page_list[$menu_item->get_menu_page()])) {
                $menu_url = $page_list[$menu_item->get_menu_page()]['page_path'];
                $menu_list[$menu_index]->set_menu_url($menu_url);
            }
            if ($menu_list[$menu_index]->get_menu_url() == $current_page['page_path']) {
                $current_menu = $menu_list[$menu_index];
            }
        }
        
        $menu_current = model::factory('menu')->get_tree($menu_list, $current_menu->get_id());
        
        $menu_location = array($menu_current);
        while ($menu_parent = $menu_current->get_parent()) {
            $menu_location[] = $menu_current = $menu_parent;
            if ($menu_parent->get_id() == $menu_id) {
                break;
            }
        }
        
        $this->view->assign('menu_location', array_reverse($menu_location));
        $this->content = $this->view->fetch('module/menu/' . $menu_template);
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Дополнительные параметры хэша модуля
    protected function ext_cache_key()
    {
        $current_page = page();
        
        return parent::ext_cache_key() +
            array('_page' => $current_page['page_id']);
    }
}