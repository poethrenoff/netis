<?php
class model_faq extends search
{
    protected $search_fields = array(
        'faq_question', 'faq_answer',
    );
    
    // Получение ссылки на объект
    public function get_result_url()
    {
        return url_for(array('controller' => 'support/faq', 'action' => 'item', 'id' => $this->get_id()));
    }
    
    // Получение описания объекта
    public function get_result_title()
    {
        return 'FAQ';
    }
}