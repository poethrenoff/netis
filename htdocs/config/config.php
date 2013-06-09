<?php
/**
 * Настроки проекта
 */
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL & ~E_STRICT);

setlocale(LC_ALL, 'ru_RU.UTF8');
ini_set('date.timezone', 'Europe/Moscow');

define('SITE_TITLE', 'Netis');

define('DB_TYPE', 'mysql'); // mysql, pgsql, sqlite
define('DB_HOST', 'localhost');
define('DB_NAME', 'netis');
define('DB_USER', 'netis');
define('DB_PASSWORD', 'netis');

define('APP_DIR', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

define('CLASS_DIR', APP_DIR . 'include' . DIRECTORY_SEPARATOR);
define('VIEW_DIR', APP_DIR . 'view' . DIRECTORY_SEPARATOR);
define('UPLOAD_DIR', APP_DIR . 'upload' . DIRECTORY_SEPARATOR);
define('UPLOAD_ALIAS', '/upload/');

define('CACHE_SITE', false);
define('CACHE_TYPE', 'file'); // file, memory
define('CACHE_TIME', 900);
define('CACHE_DIR', dirname( APP_DIR ) . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR);

define('CACHE_HOST', 'localhost');
define('CACHE_PORT', '11211');

define('PRODUCTION', false);
define('ERROR_EMAIL', 'error@example.com');
define('ERROR_SUBLECT', 'Сообщение об ошибке');

define('LOG_DIR', dirname( APP_DIR ) . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR);

include_once CLASS_DIR . 'include.php';
