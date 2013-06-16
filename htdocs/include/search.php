<?php
abstract class search extends model
{
    // Поле с названием главной записи
    protected $main_field = '';
    
    // Список полей, участвующих в поиске
    protected $search_fields = array();
    
    // Список дополнительных условий поиска
    protected $search_conditions = array();
    
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function __construct($object)
    {
        parent::__construct($object);
        
        $object_desc = metadata::$objects[$object];
        foreach ($object_desc['fields'] as $field_name => $field_desc) {
            if (isset( $field_desc['main'] ) && $field_desc['main']) {
                $this->main_field = $field_name;
            }
        }
        if (!$this->main_field) {
            throw new Exception('Ошибка в описании таблицы "' . $object . '". Отсутствует главное поле.', true);
        }
    }
    
    // Получение ссылки на объект
    abstract public function get_result_url();
    
    // Получение описания объекта
    abstract public function get_result_title();

    // Получение поля с названием главной записи
    public function get_main_field()
    {
        return $this->main_field;
    }
    
    // Получение списка полей, участвующих в поиске
    public function get_search_fields()
    {
        return $this->search_fields;
    }
    
    // Получение списка дополнительных условий поиска
    public function get_search_conditions()
    {
        return $this->search_conditions;
    }
    
    // Обработка полученных результатов
    public function get_result_content($result)
    {
        $content = strip_tags(trim($result));
        $content = (mb_strlen($content, 'utf-8') > 80) ? mb_substr($content, 0, 80, 'utf-8') . '...' : $content;
        return $content;
    }
}