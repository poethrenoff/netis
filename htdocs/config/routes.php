<?php
    /**
     * Пользовательские правила маршрутизации
     */
    $routes = array(
        // Маршрут к файлам товара
        '/support/download/@id' => array(
            'controller' => 'support/download',
            'action' => 'item',
        ),
    );
