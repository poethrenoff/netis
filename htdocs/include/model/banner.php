<?php
class model_banner extends model
{
    // Получение случайного баннера
    public function get_banner() {
        $banner = db::select_row('
            select * from banner where banner_active = :banner_active order by rand() limit 1',
                array('banner_active' => 1));
        return $this->get($banner['banner_id'], $banner);
    }
}