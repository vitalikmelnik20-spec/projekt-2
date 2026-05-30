<?php
require_once __DIR__ . '/mysql_compat.php';

$GLOBALS['__sqlite_path'] = getenv('SQLITE_PATH') ?: '/data/game.db';

// Kept for backward compat (mysql_connect call in functions.php ignores these for SQLite)
$db_host     = 'localhost';
$db_user     = 'root';
$db_password = '';
$db_name     = 'game';
$db_port     = 3306;
