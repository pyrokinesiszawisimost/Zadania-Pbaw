<?php

define('_ROOT_PATH', dirname(__FILE__));

// Определяем константы сервера и приложения
define('_SERVER_NAME', 'localhost');
define('_SERVER_URL', 'http://' . _SERVER_NAME);
define('_APP_ROOT', '/projekt6');
define('_APP_URL', _SERVER_URL . _APP_ROOT);

if (!isset($conf)) {
    $conf = new stdClass();

}
$conf->debug = true;

$conf->root_path = _ROOT_PATH;
$conf->app_url = _APP_URL;

$conf->action_url = $conf->app_url . '/index.php?action=';

$conf->db_type    = 'mysql';                  // тип СУБД
$conf->db_server  = 'localhost';              // адрес хоста БД
$conf->db_name    = 'simpledb';               // имя схемы из вашего SQL-скрипта
$conf->db_user    = 'root';                   // пользователь (проверьте!)
$conf->db_pass    = '';                       // пароль (проверьте!)
$conf->db_charset = 'utf8';                   // кодировка

// необязательные параметры Medoo
$conf->db_port   = '3306';
$conf->db_prefix = '';                        // префикс таблиц (если нужен)
$conf->db_option = [                          // опции PDO
    PDO::ATTR_CASE => PDO::CASE_NATURAL,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

define('ROLE_ADMIN', 'admin');
define('ROLE_USER', 'user');

error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
