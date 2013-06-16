<?php
class admin_table_productFile extends admin_table
{
    protected function action_add_save($redirect = true)
    {
        $primary_field = parent::action_add_save(false);
        $record = $this->get_record($primary_field);
        
        if ((isset($_FILES['file_name_file']['name']) && $_FILES['file_name_file']['name']))
            db::update('file', array('file_size' => filesize($this->get_file_path($record['file_name']))), array($this->primary_field => $primary_field));
        
        if ($redirect)
            $this->redirect();
        
        return $primary_field;
    }
    
    protected function action_edit_save($redirect = true)
    {
        parent::action_edit_save(false);
        
        $record = $this->get_record();
        $primary_field = $record[$this->primary_field];
        
        if ((isset($_FILES['file_name_file']['name']) && $_FILES['file_name_file']['name']))
            db::update('file', array('file_size' => filesize($this->get_file_path($record['file_name']))), array($this->primary_field => $primary_field));
        
        if ($redirect)
            $this->redirect();
    }
    
    protected function get_file_path($file_name)
    {
        return str_replace(UPLOAD_ALIAS, UPLOAD_DIR, $file_name);
    }
}
