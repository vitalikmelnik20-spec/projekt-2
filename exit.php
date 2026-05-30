<?
include './system/common.php';  
include './system/functions.php';
include './system/user.php';
        
$title = 'ыход';
include './system/h.php';  
noauth();
session_name("SESID");
session_start();
setcookie('id', '');
setcookie('password', '');
session_destroy();
header('location: /');
include './system/f.php';
?>