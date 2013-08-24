<?php
class metadata
{
    public static $objects = array(
        /**
         * Таблица "Тексты"
         */
        'text' => array(
            'title' => 'Тексты',
            'fields' => array(
                'text_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'text_tag' => array('title' => 'Метка', 'type' => 'string', 'show' => 1, 'sort' => 'asc', 'errors' => 'require|alpha', 'group' => array()),
                'text_title' => array('title' => 'Заголовок', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require'),
                'text_content' => array('title' => 'Текст', 'type' => 'text', 'editor' => 1, 'errors' => 'require'),
             ),
         ),
        
        /**
         * Таблица "Тексты"
         */
        'news' => array(
            'title' => 'Новости',
            'fields' => array(
                'news_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'news_title' => array('title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require'),
                'news_announce' => array('title' => 'Анонс', 'type' => 'text', 'editor' => 1, 'errors' => 'require'),
                'news_content' => array('title' => 'Текст', 'type' => 'text', 'editor' => 1, 'errors' => 'require'),
                'news_date' => array('title' => 'Дата публикации', 'type' => 'date', 'show' => 1, 'sort' => 'desc', 'errors' => 'require'),
             ),
         ),
        
        /**
         * Таблица "Меню"
         */
        'menu' => array(
            'title' => 'Меню',
            'fields' => array(
                'menu_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'menu_parent' => array('title' => 'Родительский элемент', 'type' => 'parent'),
                'menu_title' => array('title' => 'Заголовок', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require'),
                'menu_page' => array('title' => 'Раздел', 'type' => 'table', 'table' => 'page', 'show' => 1),
                'menu_url' => array('title' => 'URL', 'type' => 'string', 'show' => 1),
                'menu_image' => array('title' => 'Изображение', 'type' => 'image', 'upload_dir' => 'menu'),
                'menu_order' => array('title' => 'Порядок', 'type' => 'order', 'group' => array('menu_parent')),
                'menu_active' => array('title' => 'Видимость', 'type' => 'active'),
            ),
        ),
        
        /**
         * Таблица "FAQ"
         */
        'faq' => array(
            'title' => 'FAQ',
            'fields' => array(
                'faq_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'faq_question' => array('title' => 'Вопрос', 'type' => 'text', 'main' => 1, 'editor' => 1, 'errors' => 'require'),
                'faq_answer' => array('title' => 'Ответ', 'type' => 'text', 'editor' => 1, 'errors' => 'require'),
                'faq_order' => array('title' => 'Порядок', 'type' => 'order'),
            ),
        ),
        
        /**
         * Таблица "Тизеры"
         */
        'teaser' => array(
            'title' => 'Тизеры',
            'fields' => array(
                'teaser_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'teaser_title' => array('title' => 'Заголовок', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require'),
                'teaser_image' => array('title' => 'Изображение', 'type' => 'image', 'upload_dir' => 'teaser', 'errors' => 'require'),
                'teaser_url' => array('title' => 'URL', 'type' => 'string', 'show' => 1, 'errors' => 'require'),
                'teaser_order' => array('title' => 'Порядок', 'type' => 'order'),
                'teaser_active' => array('title' => 'Видимость', 'type' => 'active'),
            ),
        ),
        
        /**
         * Таблица "Баннеры"
         */
        'banner' => array(
            'title' => 'Баннеры',
            'fields' => array(
                'banner_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'banner_title' => array('title' => 'Заголовок', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require'),
                'banner_image' => array('title' => 'Изображение', 'type' => 'image', 'upload_dir' => 'banner', 'errors' => 'require'),
                'banner_url' => array('title' => 'URL', 'type' => 'string', 'show' => 1, 'errors' => 'require'),
                'banner_active' => array('title' => 'Видимость', 'type' => 'active'),
            ),
        ),
        
        /**
         * Таблица "Каталог"
         */
        'catalogue' => array(
            'title' => 'Каталог',
            'fields' => array(
                'catalogue_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'catalogue_parent' => array( 'title' => 'Родительский раздел', 'type' => 'parent' ),
                'catalogue_title' => array( 'title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require' ),
                'catalogue_description' => array( 'title' => 'Описание', 'type' => 'text', 'editor' => 1 ),
                'catalogue_image' => array('title' => 'Изображение', 'type' => 'image', 'upload_dir' => 'catalogue'),
                'catalogue_order' => array( 'title' => 'Порядок', 'type' => 'order', 'group' => array( 'catalogue_parent' ) ),
                'catalogue_active' => array( 'title' => 'Видимость', 'type' => 'active' ),
             ),
            'links' => array(
                'product' => array( 'table' => 'product', 'field' => 'product_catalogue' ),
             ),
        ),
        
        /**
         * Таблица "Товары"
         */
        'product' => array(
            'title' => 'Товары',
            'class' => 'product',
            'fields' => array(
                'product_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'product_catalogue' => array( 'title' => 'Каталог', 'type' => 'table', 'table' => 'catalogue', 'errors' => 'require' ),
                'product_type' => array( 'title' => 'Тип товара', 'type' => 'table', 'table' => 'product_type', 'errors' => 'require' ),
                'product_code' => array( 'title' => 'Артикул', 'type' => 'string', 'show' => 1, 'errors' => 'require' ),
                'product_title' => array( 'title' => 'Название', 'type' => 'string', 'main' => 1, 'errors' => 'require' ),
                'product_intro' => array( 'title' => 'Описание для списка', 'type' => 'text' ),
                'product_description' => array( 'title' => 'Описание', 'type' => 'text', 'editor' => 1 ),
                'product_features' => array( 'title' => 'Характеристики', 'type' => 'text', 'editor' => 1 ),
                'product_application' => array( 'title' => 'Применение', 'type' => 'text', 'editor' => 1 ),
                'product_leader' => array( 'title' => 'Лидер продаж', 'type' => 'boolean' ),
                'product_order' => array( 'title' => 'Порядок', 'type' => 'order', 'group' => array( 'product_catalogue' ) ),
                'product_active' => array( 'title' => 'Видимость', 'type' => 'active' ),
            ),
            'links' => array(
                'picture' => array( 'title' => 'Картинки', 'table' => 'product_picture', 'field' => 'picture_product', 'ondelete' => 'cascade' ),
                'file' => array( 'title' => 'Файлы',  'table' => 'product_file', 'field' => 'file_product', 'ondelete' => 'cascade' ),
            ),
            'relations' => array(
                'marker' => array( 'secondary_table' => 'marker', 'relation_table' => 'product_marker',
                    'primary_field' => 'product_id', 'secondary_field' => 'marker_id', 'title' => 'Маркеры' ),
                'link' => array( 'secondary_table' => 'product', 'relation_table' => 'product_link',
                    'primary_field' => 'product_id', 'secondary_field' => 'link_product_id', 'title' => 'Рекомендуемые' ),
            ),
        ),
        
        /**
         * Таблица "Рекомендуемые товары"
         */
        'product_link' => array(
            'title' => 'Рекомендуемые товары',
            'internal' => true,
            'fields' => array(
                'product_id' => array( 'title' => 'Товар', 'type' => 'table', 'table' => 'product', 'errors' => 'require' ),
                'link_product_id' => array( 'title' => 'Товар', 'type' => 'table', 'table' => 'product', 'errors' => 'require' ),
            ),
        ),
        
        /**
         * Таблица "Изображения товаров"
         */
        'product_picture' => array(
            'title' => 'Изображения товаров',
            'fields' => array(
                'picture_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'picture_product' => array( 'title' => 'Товар', 'type' => 'table', 'table' => 'product', 'errors' => 'require' ),
                'picture_image' => array( 'title' => 'Изображение', 'type' => 'image', 'upload_dir' => 'image', 'main' => 1, 'errors' => 'require' ),
                'picture_order' => array( 'title' => 'Порядок', 'type' => 'order', 'group' => array( 'picture_product' ) ),
            )
        ),
        
        /**
         * Таблица "Файлы для скачивания"
         */
        'product_file' => array(
            'title' => 'Файлы для скачивания',
            'class' => 'productFile', 'model' => 'productFile',
            'fields' => array(
                'file_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'file_product' => array( 'title' => 'Товар', 'type' => 'table', 'table' => 'product', 'errors' => 'require' ),
                'file_type' => array( 'title' => 'Тип файла', 'type' => 'table', 'table' => 'product_file_type', 'filter' => 1, 'errors' => 'require' ),
                'file_title' => array( 'title' => 'Описание', 'type' => 'string', 'main' => 1, 'errors' => 'require' ),
                'file_name' => array( 'title' => 'Файл', 'type' => 'file', 'upload_dir' => 'file', 'errors' => 'require' ),
                'file_lang' => array( 'title' => 'Язык файла', 'type' => 'table', 'table' => 'product_file_lang', 'filter' => 1, 'errors' => 'require' ),
                'file_date' => array( 'title' => 'Дата', 'type' => 'date', 'show' => 1 ),
                'file_size' => array( 'title' => 'Размер', 'type' => 'int', 'show' => 1, 'no_add' => 1, 'no_edit' => 1 ),
            ),
        ),
        
        /**
         * Таблица "Типы товаров"
         */
        'product_type' => array(
            'title' => 'Типы товаров',
            'model' => 'productType',
            'fields' => array(
                'type_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'type_title' => array( 'title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'sort' => 'asc', 'errors' => 'require' ),
            ),
            'links' => array(
                'product' => array( 'table' => 'product', 'field' => 'product_type' ),
                'property_group' => array( 'table' => 'property_group', 'field' => 'group_type' ),
            ),
        ),
        
        /**
         * Таблица "Типы файлов для скачивания"
         */
        'product_file_type' => array(
            'title' => 'Типы файлов для скачивания',
            'fields' => array(
                'type_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'type_title' => array( 'title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'sort' => 'asc', 'errors' => 'require' ),
                'type_order' => array( 'title' => 'Порядок', 'type' => 'order' )
            ),
            'links' => array(
                'product_file' => array( 'table' => 'product_file', 'field' => 'file_type' ),
            ),
        ),
        
        /**
         * Таблица "Языки файлов для скачивания"
         */
        'product_file_lang' => array(
            'title' => 'Языки файлов для скачивания',
            'fields' => array(
                'lang_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'lang_title' => array( 'title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'sort' => 'asc', 'errors' => 'require' ),
            ),
            'links' => array(
                'product_file' => array( 'table' => 'product_file', 'field' => 'file_lang' ),
            ),
        ),
        
        /**
         * Таблица "Маркеры"
         */
        'marker' => array(
            'title' => 'Маркеры',
            'fields' => array(
                'marker_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'marker_title' => array( 'title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'sort' => 'asc', 'errors' => 'require' ),
                'marker_picture' => array( 'title' => 'Картинка', 'type' => 'image', 'upload_dir' => 'marker' ),
            ),
            'relations' => array(
                'product' => array( 'secondary_table' => 'product', 'relation_table' => 'product_marker',
                    'primary_field' => 'marker_id', 'secondary_field' => 'product_id', 'title' => 'Товары' ),
            ),
        ),
        
        /**
         * Таблица "Связь маркеров с товарами"
         */
        'product_marker' => array(
            'title' => 'Связь маркеров с товарами',
            'internal' => true,
            'fields' => array(
                'product_id' => array( 'title' => 'Товар', 'type' => 'table', 'table' => 'product', 'errors' => 'require' ),
                'marker_id' => array( 'title' => 'Маркер', 'type' => 'table', 'table' => 'marker', 'errors' => 'require' ),
            ),
        ),
        
        /**
         * Таблица "Группы свойств"
         */
        'property_group' => array(
            'title' => 'Группы свойств',
            'fields' => array(
                'group_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'group_type' => array( 'title' => 'Тип товара', 'type' => 'table', 'table' => 'product_type', 'errors' => 'require' ),
                'group_title' => array( 'title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require' ),
                'group_order' => array( 'title' => 'Порядок', 'type' => 'order', 'group' => array( 'group_type' ) ),
                'group_active' => array( 'title' => 'Видимость', 'type' => 'active' ),
            ),
            'links' => array(
                'property' => array( 'table' => 'property', 'field' => 'property_group' ),
            ),
        ),
        
        /**
         * Таблица "Свойства"
         */
        'property' => array(
            'title' => 'Свойства',
            'class' => 'property',
            'fields' => array(
                'property_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'property_group' => array( 'title' => 'Группа свойств', 'type' => 'table', 'table' => 'property_group', 'errors' => 'require' ),
                'property_title' => array( 'title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require' ),
                'property_kind' => array( 'title' => 'Тип свойства', 'type' => 'select', 'show' => 1, 'filter' => 1, 'values' => array(
                    array( 'value' => 'string', 'title' => 'Строка' ), 
                    array( 'value' => 'number', 'title'  => 'Число' ),
                    array( 'value' => 'boolean', 'title'  => 'Флаг' ),
                    array( 'value' => 'select', 'title'  => 'Список' ) ), 'errors' => 'require' ),
                'property_unit' => array( 'title' => 'Единица измерения', 'type' => 'string' ),
                'property_order' => array( 'title' => 'Порядок', 'type' => 'order', 'group' => array( 'property_group' ) ),
                'property_active' => array( 'title' => 'Видимость', 'type' => 'active' )
            ),
            'links' => array(
                'property_value' => array( 'table' => 'property_value', 'field' => 'value_property', 'show' => array( 'property_kind' => array( 'select' ) ), 'ondelete' => 'cascade' ),
            ),
        ),
        
        /**
         * Таблица "Значения свойств"
         */
        'property_value' => array(
            'title' => 'Значения свойств',
            'class' => 'propertyValue',
            'fields' => array(
                'value_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'value_property' => array( 'title' => 'Свойство', 'type' => 'table', 'table' => 'property', 'errors' => 'require' ),
                'value_title' => array( 'title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'sort' => 'asc', 'errors' => 'require' ),
            ),
        ),
        
        /**
         * Таблица "Свойства товара"
         */
        'product_property' => array(
            'title' => 'Свойства товара',
            'internal' => 1,
            'fields' => array(
                'product_id' => array( 'title' => 'Товар', 'type' => 'table', 'table' => 'product', 'errors' => 'require' ),
                'property_id' => array( 'title' => 'Свойство', 'type' => 'table', 'table' => 'property', 'errors' => 'require' ),
                'value' => array( 'title' => 'Значение', 'type' => 'string', 'errors' => 'require' ),
            ),
        ),
        
        /**
         * Таблица "Регионы"
         */
        'region' => array(
            'title' => 'Регионы',
            'fields' => array(
                'region_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'region_title' => array( 'title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'sort' => 'asc', 'errors' => 'require' ),
            ),
            'links' => array(
                'city' => array( 'table' => 'city', 'field' => 'city_region' ),
            ),
        ),
        
        /**
         * Таблица "Города"
         */
        'city' => array(
            'title' => 'Города',
            'fields' => array(
                'city_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'city_region' => array( 'title' => 'Регион', 'type' => 'table', 'table' => 'region', 'filter' => 1, 'errors' => 'require' ),
                'city_title' => array( 'title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'sort' => 'asc', 'errors' => 'require' ),
                'city_capital' => array( 'title' => 'Столица', 'type' => 'boolean', 'show' => 1 ),
                'city_on_top' => array( 'title' => 'Наверху', 'type' => 'boolean', 'show' => 1 ),
            ),
            'links' => array(
                'partner' => array( 'table' => 'partner', 'field' => 'partner_city' ),
            ),
        ),
        
        /**
         * Таблица "Партнеры"
         */
        'partner' => array(
            'title' => 'Партнеры',
            'fields' => array(
                'partner_id' => array( 'title' => 'Идентификатор', 'type' => 'pk' ),
                'partner_title' => array( 'title' => 'Название компании', 'type' => 'string', 'show' => 1, 'main' => 1, 'sort' => 'asc', 'errors' => 'require' ),
                'partner_site' => array( 'title' => 'Сайт компании', 'type' => 'string', 'errors' => 'require' ),
                'partner_city' => array( 'title' => 'Город', 'type' => 'table', 'table' => 'city', 'errors' => 'require' ),
                'partner_address' => array( 'title' => 'Адрес', 'type' => 'string', 'errors' => 'require' ),
                'partner_type' => array('title' => 'Тип комапнии', 'type' => 'select', 'filter' => 1, 'values' => array(
                        array('value' => 'distributor', 'title' => 'дистрибьютор'),
                        array('value' => 'dealer', 'title' => 'дилер'),
                        array('value' => 'retail', 'title' => 'розница')), 'show' => 1, 'errors' => 'require'),
                'partner_fio' => array( 'title' => 'ФИО', 'type' => 'string', 'errors' => 'require' ),
                'partner_email' => array( 'title' => 'Email', 'type' => 'string', 'errors' => 'require' ),
                'partner_skype' => array( 'title' => 'Skype', 'type' => 'string', 'errors' => 'require' ),
                'partner_phone' => array( 'title' => 'Телефон', 'type' => 'string', 'errors' => 'require' ),
                'partner_active' => array( 'title' => 'Опубликовать на сайте', 'type' => 'active' ),
            ),
        ),
        
        ////////////////////////////////////////////////////////////////////////////////////////
        
        /**
         * Таблица "Настройки"
         */
        'preference' => array(
            'title' => 'Настройки',
            'class' => 'builder',
            'fields' => array(
                'preference_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'preference_title' => array('title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require'),
                'preference_name' => array('title' => 'Имя', 'type' => 'string', 'show' => 1, 'filter' => 1, 'errors' => 'require|alpha', 'group' => array()),
                'preference_value' => array('title' => 'Значение', 'type' => 'string', 'show' => 1),
            )
        ),
        
        /**
         * Таблица "Разделы"
         */
        'page' => array(
            'title' => 'Разделы',
            'class' => 'page',
            'fields' => array(
                'page_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'page_parent' => array('title' => 'Родительский раздел', 'type' => 'parent'),
                'page_layout' => array('title' => 'Шаблон', 'type' => 'table', 'table' => 'layout', 'errors' => 'require'),
                'page_title' => array('title' => 'Название', 'type' => 'string', 'main' => 1, 'errors' => 'require'),
                'page_name' => array('title' => 'Каталог', 'type' => 'string', 'show' => 1, 'errors' => 'alpha', 'group' => array('page_parent')),
                'page_folder' => array('title' => 'Папка', 'type' => 'boolean'),
                'meta_title' => array('title' => 'Заголовок', 'type' => 'text'),
                'meta_keywords' => array('title' => 'Ключевые слова', 'type' => 'text'),
                'meta_description' => array('title' => 'Описание', 'type' => 'text'),
                'page_order' => array('title' => 'Порядок', 'type' => 'order', 'group' => array('page_parent')),
                'page_active' => array('title' => 'Видимость', 'type' => 'active'),
             ),
            'links' => array(
                'block' => array('table' => 'block', 'field' => 'block_page', 'ondelete' => 'cascade'),
             ),
        ),
        
        /**
         * Таблица "Блоки"
         */
        'block' => array(
            'title' => 'Блоки',
            'class' => 'block',
            'fields' => array(
                'block_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'block_page' => array('title' => 'Раздел', 'type' => 'table', 'table' => 'page', 'errors' => 'require'),
                'block_module' => array('title' => 'Модуль', 'type' => 'table', 'table' => 'module', 'errors' => 'require'),
                'block_title' => array('title' => 'Название', 'type' => 'string', 'main' => 1, 'errors' => 'require'),
                'block_area' => array('title' => 'Область шаблона', 'type' => 'table', 'table' => 'layout_area', 'errors' => 'require'),
             ),
            'links' => array(
                'block_param' => array('table' => 'block_param', 'field' => 'block', 'ondelete' => 'cascade'),
             ),
        ),
        
        /**
         * Таблица "Шаблоны"
         */
        'layout' => array(
            'title' => 'Шаблоны',
            'class' => 'layout',
            'fields' => array(
                'layout_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'layout_title' => array('title' => 'Название', 'type' => 'string', 'main' => 1, 'errors' => 'require'),
                'layout_name' => array('title' => 'Системное имя', 'type' => 'string', 'show' => 1, 'errors' => 'require|alpha'),
             ),
            'links' => array(
                'page' => array('table' => 'page', 'field' => 'page_layout', 'hidden' => 1),
                'area' => array('table' => 'layout_area', 'field' => 'area_layout', 'title' => 'Области'),
             ),
        ),
        
        /**
         * Таблица "Области шаблона"
         */
        'layout_area' => array(
            'title' => 'Области шаблона',
            'class' => 'builder',
            'fields' => array(
                'area_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'area_layout' => array('title' => 'Шаблон', 'type' => 'table', 'table' => 'layout', 'errors' => 'require'),
                'area_title' => array('title' => 'Название', 'type' => 'string', 'main' => 1, 'errors' => 'require'),
                'area_name' => array('title' => 'Системное имя', 'type' => 'string', 'show' => 1, 'errors' => 'require|alpha'),
                'area_main' => array('title' => 'Главная область', 'type' => 'default', 'show' => 1, 'group' => array('area_layout')),
                'area_order' => array('title' => 'Порядок', 'type' => 'order', 'group' => array('area_layout')),
             ),
            'links' => array(
                'bloсk' => array('table' => 'block', 'field' => 'block_area'),
             ),
        ),
        
        /**
         * Таблица "Модули"
         */
        'module' => array(
            'title' => 'Модули',
            'class' => 'module',
            'fields' => array(
                'module_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'module_title' => array('title' => 'Название', 'type' => 'string', 'main' => 1, 'errors' => 'require'),
                'module_name' => array('title' => 'Системное имя', 'type' => 'string', 'show' => 1, 'group' => array(), 'errors' => 'require|alpha'),
             ),
            'links' => array(
                'block' => array('table' => 'block', 'field' => 'block_module'),
                'module_param' => array('table' => 'module_param', 'field' => 'param_module', 'title' => 'Параметры', 'ondelete' => 'cascade'),
             ),
        ),
        
        /**
         * Таблица "Параметры модулей"
         */
        'module_param' => array(
            'title' => 'Параметры модулей',
            'class' => 'param',
            'fields' => array(
                'param_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'param_module' => array('title' => 'Модуль', 'type' => 'table', 'table' => 'module', 'errors' => 'require'),
                'param_title' => array('title' => 'Название', 'type' => 'string', 'main' => 1, 'errors' => 'require'),
                'param_type' => array('title' => 'Тип параметра', 'type' => 'select', 'filter' => 1, 'values' => array(
                        array('value' => 'string', 'title' => 'Строка'),
                        array('value' => 'int', 'title' => 'Число'),
                        array('value' => 'text', 'title' => 'Текст'),
                        array('value' => 'select', 'title' => 'Список'),
                        array('value' => 'table', 'title' => 'Таблица'),
                        array('value' => 'boolean', 'title' => 'Флаг')), 'show' => 1, 'errors' => 'require'),
                'param_name' => array('title' => 'Системное имя', 'type' => 'string', 'show' => 1, 'group' => array('param_module'), 'errors' => 'require|alpha'),
                'param_table' => array('title' => 'Имя таблицы', 'type' => 'select', 'values' => '__OBJECT__', 'show' => 1),
                'param_default' => array('title' => 'Значение по умолчанию', 'type' => 'string'),
                'param_require' => array('title' => 'Обязательное', 'type' => 'boolean'),
                'param_order' => array('title' => 'Порядок', 'type' => 'order', 'group' => array('param_module')),
             ),
            'links' => array(
                'param_value' => array('table' => 'param_value', 'field' => 'value_param', 'show' => array('param_type' => array('select')), 'title' => 'Значения', 'ondelete' => 'cascade'),
                'block_param' => array('table' => 'block_param', 'field' => 'param', 'ondelete' => 'cascade'),
             ),
        ),
        
        /**
         * Таблица "Значения параметров модулей"
         */
        'param_value' => array(
            'title' => 'Значения параметров модулей',
            'class' => 'paramValue',
            'fields' => array(
                'value_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'value_param' => array('title' => 'Параметр', 'type' => 'table', 'table' => 'module_param', 'errors' => 'require'),
                'value_title' => array('title' => 'Название', 'type' => 'string', 'main' => 1, 'errors' => 'require'),
                'value_content' => array('title' => 'Значение', 'type' => 'string', 'show' => 1, 'group' => array('value_param'), 'errors' => 'require'),
                'value_default' => array('title' => 'По умолчанию', 'type' => 'default', 'show' => 1, 'group' => array('value_param')),
             ),
        ),
        
        /**
         * Таблица "Параметры блоков"
         */
        'block_param' => array(
            'title' => 'Параметры блоков',
            'internal' => true,
            'fields' => array(
                'block' => array('title' => 'Блок', 'type' => 'table', 'table' => 'block'),
                'param' => array('title' => 'Параметр', 'type' => 'table', 'table' => 'module_param'),
                'value' => array('title' => 'Значение', 'type' => 'text'),
             ),
        ),
        
        /**
         * Таблицы управления правами доступа
         */
        
        'admin' => array(
            'title' => 'Администраторы',
            'fields' => array(
                'admin_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'admin_title' => array('title' => 'Имя', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require'),
                'admin_login' => array('title' => 'Логин', 'type' => 'string', 'show' => 1, 'errors' => 'require|alpha', 'group' => array()),
                'admin_password' => array('title' => 'Пароль', 'type' => 'password'),
                'admin_email' => array('title' => 'Email', 'type' => 'string', 'errors' => 'email'),
                'admin_active' => array('title' => 'Активный', 'type' => 'active'),
             ),
            'relations' => array(
                'admin_role' => array('secondary_table' => 'role', 'relation_table' => 'admin_role',
                    'primary_field' => 'admin_id', 'secondary_field' => 'role_id'),
             ),
        ),
        
        'admin_role' => array(
            'title' => 'Роли администраторов',
            'internal' => true,
            'fields' => array(
                'admin_id' => array('title' => 'Администратор', 'type' => 'table', 'table' => 'admin', 'errors' => 'require'),
                'role_id' => array('title' => 'Роль', 'type' => 'table', 'table' => 'role', 'errors' => 'require'),
             ),
        ),
        
        'role' => array(
            'title' => 'Роли',
            'fields' => array(
                'role_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'role_title' => array('title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require'),
                'role_default' => array('title' => 'Главный администратор', 'type' => 'default', 'show' => 1),
             ),
            'relations' => array(
                'role_object' => array('secondary_table' => 'object', 'relation_table' => 'role_object',
                    'primary_field' => 'role_id', 'secondary_field' => 'object_id'),
             ),
        ),
        
        'role_object' => array(
            'title' => 'Права на системные разделы',
            'internal' => true,
            'fields' => array(
                'role_id' => array('title' => 'Роль', 'type' => 'table', 'table' => 'role', 'errors' => 'require'),
                'object_id' => array('title' => 'Системный раздел', 'type' => 'table', 'table' => 'object', 'errors' => 'require'),
             ),
        ),
        
        'object' => array(
            'title' => 'Системные разделы',
            'fields' => array(
                'object_id' => array('title' => 'Идентификатор', 'type' => 'pk'),
                'object_parent' => array('title' => 'Родительский раздел', 'type' => 'parent'),
                'object_title' => array('title' => 'Название', 'type' => 'string', 'show' => 1, 'main' => 1, 'errors' => 'require'),
                'object_name' => array('title' => 'Объект', 'type' => 'select', 'values' => '__OBJECT__'),
                'object_order' => array('title' => 'Порядок', 'type' => 'order', 'group' => array('object_parent')),
                'object_active' => array('title' => 'Видимость', 'type' => 'active'),
            )
        ),

        /**
         * Утилита "Файл-менеджер"
         */
        'fm' => array(
            'title' => 'Файл-менеджер',
            'class' => 'fm'
        ),
   );
}

//db::create();
