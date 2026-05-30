<?php
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
/*if(!$user OR $user['access'] < 1) {

  header('location: /');
    
exit;

}*/

$title = 'Платежи WorldKassa.ru';

include './system/h.php';



function who($id = 0) {	
	
$us = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1"));

return (empty($us)?'БОТ': ' '.$ico.' <a href="/user/'.$us['id'].'"> '.$us['login'].' </a>');

}


$logs = mysql_query("SELECT * FROM `worldkassa` WHERE `time_oplata` != '0' ORDER BY `id` DESC");



echo '<div class="title">Платежи WorldKassa.ru</div>
<div class="line"></div>';


if(mysql_num_rows($logs) == '0') echo 'Записей не найдено';

while ($TJlogs = mysql_fetch_array($logs)){

 
if($TJlogs['time_oplata'] > '0') $p = '<font color="green"> Оплачено </font>';


echo '<div class="content">
ID: '.$TJlogs['id'].' <br/>Время: '.date('d.m|H:i',$TJlogs['time']).' <br/> Ник: '.who($TJlogs['id_user']).' <br>Состояние: '.$p.'  <br>Сумма: '.$TJlogs['summa'].' <br/> </div>               ';


}


include './system/f.php';

?>