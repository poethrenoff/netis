<?php
class model_productFile extends search
{
    protected $search_fields = array(
        'file_title',
    );
    
    // Получение ссылки на объект
    public function get_result_url()
    {
        return url_for(array('controller' => 'support/download', 'action' => 'item', 'id' => $this->get_file_product()));
    }
    
    // Получение описания объекта
    public function get_result_title()
    {
        return 'Скачать';
    }
}