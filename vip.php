<?php
include './system/common.php';
include './system/functions.php';  
include './system/user.php';
$title = 'Премиум Аккаунт';
if($user['save'] == 0) {header('location: /save/');}
if(!$user) {header('location: /');exit;}
include './system/h.php';
$sett = mysql_query("SELECT * FROM `set` WHERE `usr` = '$user[login]' LIMIT 1");
$set = mysql_fetch_assoc($sett); 
switch($_GET['mod']){

default:
$ab = $set['viptime'] -$time;
echo'<div class="wrapper">';
echo"Преимущества VIP:<br>
<ul class='hint'>
<li>Установка собственного <a href='/avatar.php'>аватара</a>.</li>
<li>Бонус x2 к опыту!</li>
<li>x2 опыт увеличивается только на <a href='/arena/'>арене</a> и в <a href='/duel/'>дуэли</a></li>
<li>Ускоренная регенерация здоровья.</li>
</ul>
</div><div class='hr'></div>";
if($set['vip']=='on'){
echo'<div class="wrapper center">';
echo'Поздравляем, вы купили Vip - статус</div></div><div class="hr"></div>';
}else{
echo'<a class="wrapper" href="vip.php?mod=vip"><button type="submit" value="Купить премиум-аккаунт">Купить премиум-аккаунт</button></a>';
}
echo'</div></div>';
break;

case 'vip':
if(empty($_POST['kolvo'])){
echo'<div class="wrapper center">';
echo'<div class="lent w80 mlra">
<div class="bl-ttl"><div class="te">
<div class="ttl">Премиум аккаунт</div></div></div>
<div class="lines"></div>';
echo"<span class='vmz gold'><b>Стоимость за 1 сутки 1000 <img src='/images/icon/gold.png'> золота.</b></span></br>
<form action='vip.php?mod=vip' method='POST'>
Введите кол-во суток:<br/><br/>
<input class='text' type=\"number\" value=\"1\" size=\"20\" name=\"kolvo\"/><br/>";
echo '<input class="button" type="submit" name="submit" value="Купить"></form></div></div>';
echo'<a class="wrapper" href="/vip.php"><img src="/images/nz.png"><span class="vmz white"> Вернуться назад</span></a>';
}
elseif($_POST['kolvo']>0 AND $_POST['kolvo']<=$user['g']){
$_POST['kolvo'] = htmlspecialchars(stripslashes(addslashes($_POST['kolvo'])));
$vremya=$_POST['kolvo']*24;
echo'<div class="wrapper">';
echo"Вы действительно хотите купить VIP на $vremya час.?</br><br/><a href='vip.php?mod=ok&kolvo=$_POST[kolvo]'><input class='btn _green' type='submit' value='Да'></span></span></a> <a href='vip.php?'><input class='btn _green' type='submit' value='Нет'></span></span></a></div></div>";
}else{
$_SESSION['err'] = '<br/><div class=\'separ\'></div><a href=\'/trade/\'>Купить</a>';
}
break;

case 'ok':
$time = time();
if($set['vip']=='on'){
exit;
}
if(empty($_GET['kolvo'])){
header('Location: vip.php?mod=vip');exit;
}else{
$kol = htmlspecialchars(stripslashes(addslashes($_GET['kolvo'])));
$vremya = $kol*24;
$kols = $kol*1000;
if($user['g']-$kols<0){
$_SESSION['err'] = 'У Вас не хватает золота!<br/><div class=\'separ\'></div><a href=\'/trade/\'>Купить</a>';
break;
}else{
$viptime = $time+(24*3600*$kol);
mysql_query("INSERT INTO `set` (`vip`, `viptime`, `usr`) values('on', '$viptime', '$user[login]')");
mysql_query("UPDATE `users` SET `g` = '$user[g]'-'$kols' WHERE `id` = '$user[id]' LIMIT 1");
echo'<div class="wrapper">';
echo"<span class='dgreen'>Поздравляем, вы купили Vip - статус на $vremya часов!</span><br/><a href='/vip.php'>Вернуться назад</a></div></div>";
}
}
break;
}
include './system/f.php';
?>