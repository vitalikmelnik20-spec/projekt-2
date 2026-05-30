<?php
require_once __DIR__ . '/mysql_compat.php';

$db_host     = getenv('MYSQLHOST')     ?: getenv('MYSQL_HOST')     ?: 'localhost';
$db_user     = getenv('MYSQLUSER')     ?: getenv('MYSQL_USER')     ?: 'root';
$db_password = getenv('MYSQLPASSWORD') ?: getenv('MYSQL_PASSWORD') ?: '';
$db_name     = getenv('MYSQLDATABASE') ?: getenv('MYSQL_DATABASE') ?: 'projekt';
$db_port     = (int)(getenv('MYSQLPORT') ?: getenv('MYSQL_PORT') ?: 3306);

$GLOBALS['__mysql_port'] = $db_port;
