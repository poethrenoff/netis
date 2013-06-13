<?php
class module_download extends module
{
    // Вывод файлов для скачивания
    protected function action_index()
    {
        $this->content = $this->view->fetch('module/download/list');
    }
}