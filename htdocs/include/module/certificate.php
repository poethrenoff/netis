<?php
class module_certificate extends module
{
    // Вывод списка сертификатов
    protected function action_index()
    {
        $certificate_filter = array();
        if (init_string('type')) {
            $certificate_filter['certificate_type'] = init_string('type');
        }
        
        $total = model::factory('certificate')->get_count($certificate_filter);
        $count = max(1, intval($this->get_param('count')));
        
        $pages = paginator::construct($total, array('by_page' => $count));
        
        $certificate_list = model::factory('certificate')->get_list($certificate_filter, array(), $pages['by_page'], $pages['offset']);
        $this->view->assign('certificate_list', $certificate_list);
        $this->view->assign('pages', paginator::fetch($pages));
        
        $certificate_type_list = model::factory('certificate_type')->get_list();
        $this->view->assign('certificate_type_list', $certificate_type_list);
        
        $this->content = $this->view->fetch('module/certificate/index');
    }
    
    // Загрузка сертификата
    protected function action_download()
    {
        try {
            $certificate = model::factory('certificate')->get(id());
        } catch (Exception $e) {
            not_found();
        }
        
        $file_name = str_replace( UPLOAD_ALIAS, normalize_path( UPLOAD_DIR ), $certificate->get_certificate_image() );
        
        header( 'Content-Description: File Transfer' );
        header( 'Content-Type: application/octet-stream' );
        header( 'Content-Transfer-Encoding: binary' );
        header( 'Content-Disposition: attachment; filename=' . basename( $file_name ) );
        header( 'Content-Length: ' . filesize( $file_name ) );
        
        ob_clean();
        
        readfile( $file_name );
        
        exit;
    }
}