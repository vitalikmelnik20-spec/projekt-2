<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';    
if(!$user) {
header('location: /');    
exit;
}
$title = 'Ежедневный подарок';    
include './system/h.php';
$gift = mysql_fetch_assoc(mysql_query("SELECT * FROM `user_podarok` WHERE `user_id` = '$user[id]' order by `last_auth` desc limit 1"));

$time = $gift['last_auth'] + 86400;
$now = time();
echo "<table class='post'>";

if(isset($_GET['take'])){
if ($time < $now) {

echo "<div class='block_light'><center><b>Поздравляем вы получили подарок <br><span class='green'>Приятной игры</span></center></div>";
mysql_query("UPDATE `users` SET `g` = `g` + '250' WHERE `id` = '$user[id]'");
mysql_query("UPDATE `users` SET `s` = `s` + '1000' WHERE `id` = '$user[id]'");
mysql_query("UPDATE `user` SET `health` = `health` + '0' WHERE `id` = '$user[id]'");
if(mysql_result(mysql_query("SELECT count(user_id) from `user_podarok` where `user_id` = '".$user['id']."'"),0) == 0){
mysql_query("INSERT INTO `user_podarok` SET `last_auth` = '$now', `stage` = '1', `user_id` = '$user[id]'");
}else{
mysql_query("UPDATE `user_podarok` SET `last_auth` = '$now', `stage` = `stage` + '1' WHERE `user_id` = '$user[id]'");
}

} else {
echo "</br></br>";
}
}


if ($time < $now) {
echo "<center><b><br>Вы можете забрать подарок только один раз в день. Подарок содержит: 250 <img width='16' height='16' src='images/icon/gold.png' alt='o'>, 1000 <img width='16' height='16' src='images/icon/silver.png' alt='o'><br>Напоминаем еще раз, подарок можно забрать только один раз день.<br><span class='green'>Приятной игры</span></b><br />
<form action='podarok.php?take' method='post'><br/>
<center><span class='btn'><span class='end'><input class='label' type='submit' name='take' value='Забрать'/>
</form></center>";
} else {
$hour_t = ceil(($time - $now) / 3600);
$min = ceil(($time - $now) / 60);
if ($hour_t == 1 or $hour_t == 21) {
$hour = 'час';
} elseif ($hour_t >= 2 and $hour_t <= 4 or $hour_t >= 22 and $hour_t <= 24) {
$hour = 'часа';
} elseif ($hour_t >= 5 and $hour_t <= 20) {
$hour = 'часов';
}
echo "<center><b>Вы уже получали сегодня свой подарок.</br>Приходите через: <span class='green'>$min</span></b> мин.</b></centet><br><br>";
}
echo "</table>";
include_once 'system/f.php';
?>