<?
include_once 'system/common.php';
include_once 'system/functions.php';
include_once 'system/user.php';
$title='Подарки';
include_once 'system/h.php';
////////////		открываем информацию о данных игрока снова 	//////////////
//-------------------------------------
  $log = $user['id'];
  $reqdsdfrfd = mysql_query("SELECT * FROM `users` WHERE `id` = '".$log."' and `id` = '".$user['id']."' LIMIT 1");
  $user = mysql_fetch_assoc($reqdsdfrfd);
//-------------------------------------
///////////////////////////////////////////////////////////////////////////////
if (!isset($user) && !isset($_GET['id'])){header("Location: /index.php?".SID);exit;}
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id` = '".$ank['id']."' LIMIT 1"))){header("Location: /index.php?".SID);exit;}
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$_GET['id']."' LIMIT 1"));
if(empty($ank['id'])){
echo'<font color=red>Нет такого игрока!</font>';
echo"<br/><div class=silka><a href=\"/?\">Главная</a>";
include_once 'system/f.php';exit;
}
if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('gifts\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));
$p = (isset($_GET['p'])) ? htmlspecialchars($_GET['p']) : null;
switch($p){
case 'send_gifts':
$pid = intval($_GET['pid']);
if(isset($_GET['go'])){
if ($user['id']==$ank['id']){echo "<font color=red><p>Себе дарить нельзя</p></font>";
include_once 'system/f.php';exit;
}

$curr=date("d.m.y / H:i");
$cena = 25;
$msg=_string($_POST['msg']);
$ank['id'];
if($ank==0){
msg ('Пользователь не найден :(');
}else{
if(isset($user) & $user['g']<=$cena){
echo "<font color=red><p>У Вас не достаточно Золота :(</p></font>";
}else{
////////////////////
mysql_query("UPDATE `users` SET `g` = '".($user['g']-$cena)."' WHERE `id` = '$user[id]' LIMIT 1");
////////////////////
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = "'.$ank['id'].'" AND `ho` = "2"'),0) == 0) {
mysql_query("INSERT INTO `contacts` SET `user` = '".$ank['id']."', `ho` = 2, `time` = ".time()."");
}
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = "'.$ank['id'].'" AND `ho` = "2"');
/////////////////////////
$text = "К вам пришёл подарок от <img src=\'/images/icon/race/".$user['r'].".png\' alt=\'*\'/> <a href=\'/user/".$user['id']."/\'>".$user['login']." </a>!";
mysql_query("INSERT INTO `mail` SET `from` = '2', `to` = '".$ank['id']."', `time` = ".time().", `read` = '0', `text` = '".$text."'"); // отправляем сообщение

////////////////////
mysql_query("INSERT INTO `gifts` (`id_user`, `ot_id`, `text`, `time`, `id_gifts`) values('".$ank['id']."', '".$user['id']."', '".$msg."', ".time().", '".$pid."')");
////////////////////

echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'><p>Отправка подарка успешно завершена :)</p>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"user.php?id=".$ank['id']."\"><span class='end'><span class='label'> Продолжить</span></span></a></p></div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>";

include './system/f.php';
}
}
exit;
}
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo"Выбранный подарок:<img src='/gifts/".$pid.".gif' width='30' height='30' alt='' class='icon'/></br>";
echo "<font color='red'>Для начала выбери подарок!</font>";
echo "<form method=\"post\" action=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid="._string(_num($_GET['pid']))."&go\">";
echo "Получатель:<b> <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></b><br/><br />\n";
echo "Ваше сообщение:<br/>";
echo "<input type=\"text\" name=\"msg\" value=\"\"/><br />\r\n";
echo "<input type=\"submit\" value=\"Подарить\" />";
echo "</form>\n";
echo'<small>С вашего счета будет снято 25 Золота</small></div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';



break;
}
$pod = (isset($_GET['pod'])) ? htmlspecialchars($_GET['pod']) : null;


////////////


switch($pod) {


case '1':
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center>Выбери подарок для  <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></center></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=105\"><img src='/gifts/105.gif' width='30' height='30' alt=''></a>"; 
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=1\"><img src='/gifts/1.gif' width='30' height='30' alt=''> </a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=24\"><img src='/gifts/24.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=25\"><img src='/gifts/25.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=26\"><img src='/gifts/26.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=5\"><img src='/gifts/5.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=6\"><img src='/gifts/6.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=7\"><img src='/gifts/7.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=9\"><img src='/gifts/9.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=10\"><img src='/gifts/10.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=30\"><img src='/gifts/30.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=11\"><img src='/gifts/11.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=107\"><img src='/gifts/107.gif'  width='30' height='30' alt=''></a>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=2\"><span class='end'><span class='label'> Дальше</span></span></a></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div>';
break;
case '2':
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center>Выбери подарок для  <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></center></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=12\"><img src='/gifts/12.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=127\"><img src='/gifts/127.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=13\"><img src='/gifts/13.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=28\"><img src='/gifts/28.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=113\"><img src='/gifts/113.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=14\"><img src='/gifts/14.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=15\"><img src='/gifts/15.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=16\"><img src='/gifts/16.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=18\"><img src='/gifts/18.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=19\"><img src='/gifts/19.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=20\"><img src='/gifts/20.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=21\"><img src='/gifts/21.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=118\"><img src='/gifts/118.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=108\"><img src='/gifts/108.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=121\"><img src='/gifts/121.gif'  width='30' height='30' alt=''></a>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=1\"><span class='end'><span class='label'>Назад</span></span></a></p>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=3\"><span class='end'><span class='label'> Дальше</span></span></a></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div></div>';
break;
case '3':
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center>Выбери подарок для  <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></center></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
 echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=22\"><img src='/gifts/22.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=3\"><img src='/gifts/3.gif'  height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=23\"><img src='/gifts/23.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=2\"><img src='/gifts/2.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=129\"><img src='/gifts/129.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=125\"><img src='/gifts/125.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=27\"><img src='/gifts/27.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=17\"><img src='/gifts/17.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=29\"><img src='/gifts/29.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=38\"><img src='/gifts/38.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=40\"><img src='/gifts/40.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=106\"><img src='/gifts/106.gif'  width='30' height='30' alt=''></a>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=2\"><span class='end'><span class='label'> Назад</span></span></a></p>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=4\"><span class='end'><span class='label'> Дальше</span></span></a></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div></div>';
break;
case '4':
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center>Выбери подарок для  <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></center></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
 echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=31\"><img src='/gifts/31.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=8\"><img src='/gifts/8.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=32\"><img src='/gifts/32.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=33\"><img src='/gifts/33.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=34\"><img src='/gifts/34.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=35\"><img src='/gifts/35.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=36\"><img src='/gifts/36.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=37\"><img src='/gifts/37.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=126\"><img src='/gifts/126.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=39\"><img src='/gifts/39.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=4\"><img src='/gifts/4.gif'  width='30' height='30' alt=''></a>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=3\"><span class='end'><span class='label'> Назад</span></span></a></p>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=5\"><span class='end'><span class='label'> Дальше</span></span></a></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div></div>';
break;
case '5':
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center>Выбери подарок для  <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></center></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
 echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=41\"><img src='/gifts/41.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=119\"><img src='/gifts/119.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=42\"><img src='/gifts/42.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=43\"><img src='/gifts/43.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=44\"><img src='/gifts/44.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=45\"><img src='/gifts/45.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=46\"><img src='/gifts/46.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=47\"><img src='/gifts/47.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gift&id=".$ank['id']."&pid=48\"><img src='/gifts/48.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=49\"><img src='/gifts/49.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=50\"><img src='/gifts/50.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gift&id=".$ank['id']."&pid=100\"><img src='/gifts/100.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gift&id=".$ank['id']."&pid=101\"><img src='/gifts/101.gif'  width='30' height='30' alt=''></a>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=4\"><span class='end'><span class='label'> Назад</span></span></a></p>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=6\"><span class='end'><span class='label'> Дальше</span></span></a></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div></div>';
break;

case '6':
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center>Выбери подарок для  <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></center></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=51\"><img src='/gifts/51.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=52\"><img src='/gifts/52.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=53\"><img src='/gifts/53.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=54\"><img src='/gifts/54.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=55\"><img src='/gifts/55.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=57\"><img src='/gifts/57.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=58\"><img src='/gifts/58.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gift&id=".$ank['id']."&p&id=59\"><img src='/gifts/59.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=102\"><img src='/gifts/102.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=56\"><img src='/gifts/56.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=114\"><img src='/gifts/114.gif'   width='30' height='30' alt=''></a>";
echo "  <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=117\"><img src='/gifts/117.gif'   width='30' height='30' alt=''></a>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=5\"><span class='end'><span class='label'> Назад</span></span></a></p>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=7\"><span class='end'><span class='label'> Дальше</span></span></a></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div></div>';
break;
case '7':
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center>Выбери подарок для  <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></center></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";

echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=61\"><img src='/gifts/61.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=62\"><img src='/gifts/62.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=63\"><img src='/gifts/63.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=64\"><img src='/gifts/64.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=65\"><img src='/gifts/65.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=66\"><img src='/gifts/66.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=60\"><img src='/gifts/60.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=67\"><img src='/gifts/67.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=120\"><img src='/gifts/120.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gift&id=".$ank['id']."&p&id=68\"><img src='/gifts/68.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=69\"><img src='/gifts/69.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=70\"><img src='/gifts/70.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=71\"><img src='/gifts/71.gif'   width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=72\"><img src='/gifts/72.gif'   width='30' height='30' alt=''></a>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=6\"><span class='end'><span class='label'> Назад</span></span></a></p>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=8\"><span class='end'><span class='label'> Дальше</span></span></a></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div></div>';
break;
case '8':
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center>Выбери подарок для  <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></center></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";

echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=99\"><img src='/gifts/99.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=103\"><img src='/gifts/103.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=124\"><img src='/gifts/124.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=128\"><img src='/gifts/128.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=104\"><img src='/gifts/104.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=109\"><img src='/gifts/109.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=110\"><img src='/gifts/110.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=111\"><img src='/gifts/111.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=112\"><img src='/gifts/112.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=115\"><img src='/gifts/115.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=116\"><img src='/gifts/116.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=122\"><img src='/gifts/112.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=123\"><img src='/gifts/123.gif'  width='30' height='30' alt=''></a>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=7\"><span class='end'><span class='label'> Назад</span></span></a></p>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=9\"><span class='end'><span class='label'> Дальше</span></span></a></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div></div>';

break;
case '9':
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center>Выбери подарок для  <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></center></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";

echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=73\"><img src='/gifts/73.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=74\"><img src='/gifts/74.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=75\"><img src='/gifts/75.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=76\"><img src='/gifts/76.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=77\"><img src='/gifts/77.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=78\"><img src='/gifts/78.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=79\"><img src='/gifts/79.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=80\"><img src='/gifts/80.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=81\"><img src='/gifts/81.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=82\"><img src='/gifts/82.gif'  width='30' height='30' alt=''></a>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=8\"><span class='end'><span class='label'> Назад</span></span></a></p>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=10\"><span class='end'><span class='label'> Дальше</span></span></a></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div></div>';
break;
case '10':
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center>Выбери подарок для  <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></center></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";

echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=83\"><img src='/gifts/83.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=84\"><img src='/gifts/84.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=85\"><img src='/gifts/85.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=86\"><img src='/gifts/86.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=87\"><img src='/gifts/87.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=88\"><img src='/gifts/88.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=89\"><img src='/gifts/89.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=90\"><img src='/gifts/90.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=91\"><img src='/gifts/91.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=92\"><img src='/gifts/92.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=93\"><img src='/gifts/93.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=94\"><img src='/gifts/94.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=95\"><img src='/gifts/95.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=96\"><img src='/gifts/96.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=97\"><img src='/gifts/97.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=98\"><img src='/gifts/98.gif'  width='30' height='30' alt=''></a>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=9\"><span class='end'><span class='label'> Назад</span></span></a></p>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=11\"><span class='end'><span class='label'> Дальше</span></span></a></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div></div>';
break;
case '11':
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center>Выбери подарок для  <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></center></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";

echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=130\"><img src='/gifts/130.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=131\"><img src='/gifts/131.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=132\"><img src='/gifts/132.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=133\"><img src='/gifts/133.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=134\"><img src='/gifts/134.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=135\"><img src='/gifts/135.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=136\"><img src='/gifts/136.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=137\"><img src='/gifts/137.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=138\"><img src='/gifts/138.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=139\"><img src='/gifts/139.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=140\"><img src='/gifts/140.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=141\"><img src='/gifts/141.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=142\"><img src='/gifts/142.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=143\"><img src='/gifts/143.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=144\"><img src='/gifts/144.gif'  width='30' height='30' alt=''></a>";
echo " <a href=\"gifts.php?p=send_gifts&id=".$ank['id']."&pid=145\"><img src='/gifts/145.gif'  width='30' height='30' alt=''></a></br>";
echo "<div class=inoy><p align='center'><a class='btn' href=\"gifts.php?id=".$ank['id']."&pod=10\"><span class='end'><span class='label'> Назад</span></span></a></p>";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div></div>';
}
if ($k_page>1)str("/gifts.php?id=".$ank['id']."&pod",$k_page,$page); // Вывод страниц




include_once 'system/f.php';
?>