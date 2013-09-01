<?php
class model_certificate extends model
{
    // Получение условия фильтрации записей
    public function get_filter_condition($where = array()) {
        list($filter_clause, $filter_binds) = parent::get_filter_condition($where);
        
        $filter_clause = ($filter_clause ? ($filter_clause . ' and ') : 'where ') .
            '(type_permanent = :type_permanent or certificate.certificate_expiration >= :certificate_expiration)';
        $filter_binds['type_permanent'] = 1;
        $filter_binds['certificate_expiration'] = date::now();
        
        return array($filter_clause, $filter_binds);
    }

    // Получение количества объектов
    public function get_count($where = array()) {
        list($filter_clause, $filter_binds) = $this->get_filter_condition($where);
        return db::select_cell("
            select count(*) from certificate
                inner join certificate_type on certificate_type.type_id = certificate.certificate_type
            {$filter_clause}", $filter_binds);
    }

    // Получение списка объектов
    public function get_list($where = array(), $order = array(), $limit = null, $offset = null) {
        list($filter_clause, $filter_binds) = $this->get_filter_condition($where);
        $order_clause = $this->get_order_clause($order);
        $limit_clause = $this->get_limit_clause($limit, $offset);
        
        $records = db::select_all("
            select * from certificate
                inner join certificate_type on certificate_type.type_id = certificate.certificate_type
            {$filter_clause} {$order_clause} {$limit_clause}", $filter_binds);
        
        return $this->get_batch($records);
    }
}