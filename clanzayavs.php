<? 
include './system/common.php'; 
include './system/functions.php'; 
include './system/user.php'; 
if(!$user) {
header('location: /');
exit;
} 
$title = 'Заявки в клан'; 
include './system/h.php'; 
$za = mysql_fetch_array(mysql_query('SELECT * FROM `clan_z` WHERE `clan` = '.$clan['id'].' ORDER BY `id` DESC LIMIT 10')); 
$zay = mysql_query('SELECT * FROM `clan_z` WHERE `clan` = '.$clan['id'].' ORDER BY `id` DESC LIMIT 10'); 
if($za){ 
while($row = mysql_fetch_array($zay)){ 
 $us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = '.$row['user'].'')); 
if($_GET['true'] == '1') { 
mysql_query('INSERT INTO `clan_memb` (`clan`,`user`,`time`,`last_update`) VALUES ("'.$clan['id'].'", "'.$row['user'].'","'.time().'","'.(time() + ((60 * 60) * 24)).'")');     
mysql_query('DELETE FROM `clan_z` WHERE `user` = "'.$us['id'].'"'); 
header('location: /clan/'); 
exit; 
} 
if($_GET['false'] == '1') { 
mysql_query('DELETE FROM `clan_z` WHERE `user` = "'.$us['id'].'"'); 
header('location: /clan/'); 
exit; 
} 
 ?> 
 <div class='main'> 
 <center>Персонаж <?=$row['user']?> хочет вступить в клан!<br> 
<?if($clan_memb['rank'] >= 3){?><div class='center'><a class='btn' href='?true=1'><span class='end'><span class='label'>[Принять]</span></span></a></div><div class='center'><a class='btn' href='?false=1'><span class='end'><span class='label'>[Отклонить]</span></span></a></div><?}?></center> 
 </div> 
 <div class='dgreen'></div> 
 <? 
} 
 }else{ 
  ?> 
  <center><div class='main'><div class='menuList'>Нету заявок в ваш клан</div></div></center> 
  <? 
 } 
?> <div class='main'><div class='menuList'><div class='mini-line'></div>
<a class='' href='/clan/'><img src='/images/icon/clan.png'> Вернуться в клан</a> </div></div>
<? 
include './system/f.php'; 
?>