<?php
class module_product extends module
{
    protected function action_index()
    {
        $this->content = $this->view->fetch('module/product/item');
    }

    protected function action_location()
    {
        $this->content = $this->view->fetch('module/menu/location');
    }
}