<?php
    /**
     * Пользовательские правила маршрутизации
     */
    $routes = array(
        // Путь к новостям
        '/about/news/@id' => array(
            'controller' => 'about/news',
            'action' => 'item',
        ),
        
        // Путь к вопросам
        '/support/faq/@id' => array(
            'controller' => 'support/faq',
            'action' => 'item',
        ),
        
        // Путь к файлам
        '/support/download/@id' => array(
            'controller' => 'support/download',
            'action' => 'item',
        ),
   );
