<?php
class model_news extends search
{
    protected $search_fields = array(
        'news_title', 'news_announce', 'news_content',
    );
    
    // Получение ссылки на объект
    public function get_result_url()
    {
        return url_for(array('controller' => 'about/news', 'action' => 'item', 'id' => $this->get_id()));
    }
    
    // Получение описания объекта
    public function get_result_title()
    {
        return 'Новости';
    }
}