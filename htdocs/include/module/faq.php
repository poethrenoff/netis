<?php
class module_faq extends module
{
    // Вывод списка вопросов
    protected function action_index()
    {
        $model_faq = model::factory('faq');
        
        $total = $model_faq->get_count();
        $count = max(1, intval($this->get_param('count')));
        
        $pages = paginator::construct($total, array('by_page' => $count));
        
        $item_list = $model_faq->get_list(array(), array('faq_order' => 'asc'), $pages['by_page'], $pages['offset']);
        
        $this->view->assign('item_list', $item_list);
        $this->view->assign('pages', paginator::fetch($pages));
        
        $this->content = $this->view->fetch('module/faq/list');
    }
    
    // Вывод конкретного вопроса
    protected function action_item()
    {
        try {
            $item = model::factory('faq')->get(id());
        } catch (Exception $e) {
            not_found();
        }
        
        $this->view->assign($item);
        $this->content = $this->view->fetch('module/faq/item');
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Дополнительные параметры хэша модуля
    protected function ext_cache_key()
    {
        return parent::ext_cache_key() +
            ($this->action == 'item' ? array('_id' => id()) : array());
    }
}