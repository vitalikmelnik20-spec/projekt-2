<?

  list($msec,$sec)
             = explode(chr(32), microtime()); 
  $gtime     = $sec+$msec; 

header('Content-type: text/html; charset=utf-8');
header('Expires: Thu, 21 Jul 1977 07:30:00 GMT');
header('Last-Modified: '.gmdate('r').' GMT');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
echo '
<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="copyright" content="Aleks1122CMS"/>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
<meta name="language" content="russian, ru, русский"/>
<meta name="robots" content="all"/>
<link rel="shortcut icon" href="/favicon.ico?2"/>
<link rel="stylesheet" type="text/css" href="/style.css"/>
<meta name="keywords" content="Новая игра,РПГ,Онлайн игра,Много пользовательская игра, текстовая онлайн игра,Рпг текстовая игра,РПГ в разработке,Текстовая онлайн игра в разработке"/>
<meta name="description" content = "Новая игра которая в разработке"/>
<title>'.$title.'</title>
</head>
<body>';


    if($user['g'] > 1800000000  ) {
        
      
    
mysql_query('UPDATE `users` SET `g`="0",`s`="0" WHERE `id` = "'.$user['id'].'" '); 
}

?>
 <?php
mysql_query('UPDATE `users` SET `self` = "'.$title.'" WHERE `id` = "'.$user['id'].'"');
if($user) { 
$a_f = mysql_fetch_array(mysql_query("SELECT * FROM `tj_admin`")); 
$s_u = mysql_fetch_array(mysql_query("SELECT * FROM `tj_users` ORDER BY `wins` DESC LIMIT 1")); 
$lider_TJ = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '$s_u[id_user]'")); 
if($a_f['on/off'] < time() && $a_f['check_nagrada'] == '0'){ 
mysql_query("UPDATE `users` SET `s` = `s` + '$a_f[wins_silver]', `g` = `g` + '$a_f[wins_gold]' WHERE `win_battle` != '0' AND `id` = '$lider_TJ[id]'") or die(mysql_error()); 
mysql_query("UPDATE `users` SET `s` = `s` + '$a_f[top_silver]', `g` = `g` + '$a_f[top_gold]' WHERE `win_battle` != '0' AND `id` != '$lider_TJ[id]' ORDER BY `win_battle` DESC LIMIT $a_f[top]") or die(mysql_error()); 
mysql_query("UPDATE `users` SET `win_battle` = '0'");  
mysql_query("UPDATE `tj_admin` SET `check_nagrada` = '1' "); 
header('Location:?'); 
} 
}
?>
<?
if($user) {
$exp_1 = mysql_query("SELECT * FROM `user_level` WHERE `level` = '".$user['level']."'");
$exp_2 = mysql_fetch_array($exp_1);
      $exp = $exp_2['exp'];  
$exp_progress = round(100/($exp/$user['exp']));
if($exp_progress > 100) {
$exp_progress = 100;
}
function clan_exp($i) {
    $clan_exp_1 = mysql_query("SELECT * FROM `clan_level` WHERE `level` = '".$i."'");
$clan_exp_2 = mysql_fetch_array($clan_exp_1);
      $clan_exp = $clan_exp_2['exp']; 
return $clan_exp;
}
$lvlclan = $clan['level'] + 1;
$time = time();
    if($clan && $clan['level'] < 36 && $clan['exp'] >= clan_exp($clan['level'])) {
mysql_query('UPDATE `clans` SET `level` = `level` + 1,
`exp` = "0" WHERE `id` = "'.$clan['id'].'"');
mysql_query("INSERT INTO `chat` (`clan`, 
`user`,
`text`, 
`time`) VALUES ('$clan[id]', 
'0',
'<span class=dgreen>Ваш клан получил $lvlclan уровень</span>',
'$time')");

}

$mail = mysql_result(mysql_query('SELECT COUNT(*) FROM `mail` WHERE `uid2` = "'.$user['id'].'" AND `proch` = "0"'),0);
$_chat = mysql_query('SELECT COUNT(*) FROM `chat` WHERE `clan` = "0" AND `to` = "'.$user['id'].'" AND `read` = "0"');
$_chat = mysql_result($_chat,0);


if($_SERVER['PHP_SELF'] == '/index.php')$title = 'Главная';
if($_SERVER['PHP_SELF'] == '/clan.php')$title = 'Клан';
?>

<div class="main" style="word-wrap:break-word;"><span style="text-shadow:none;"></span>
<span class="ttl fl"><?=$title?></span>
<span class="bl rght nwr">
<?if($mail > 0) {?><a href="/mail/"><img src="/images/icon/mail.png" alt=""></a> | <?}if($_chat > 0) {?><a href="/chat/"><img src="/images/icon/chat.png"></a> | <?}?>
<div class="block_img_1">
            <span style = "float: right;"><?=$user['mp']?> <img style="width: 16px; height: 16px;" src="/images_i/icon/4.png"/></span>
            <img src="/images_i/xx/4.png"/> <?=$user['hp']?>
        </div>
     <div class="progress">
            <div class="exp" style="width:<?=$exp_progress?>%"></div>
        </div>
</span>
<?
$lvluser = $user['level'] + 1;
    if($user['level'] < 65 AND $user['exp'] >= $exp) {
        $new  = $user['level'] + 1;
        $g = 10 + ($user['level'] * 5) - 5;
$time = time();
    mysql_query('UPDATE `users` SET `level` = `level` + 1,
                                      `exp` = "0",
                                       `hp` = "'.($user['vit'] * 2).'",
                                       `mp` = "'.$user['mana'].'",
                                        `g` = "'.($user['g'] + $g).'" WHERE `id` = "'.$user['id'].'"');
if($clan){
mysql_query("INSERT INTO `chat` (`clan`, 
`user`,
`text`, 
`time`) VALUES ('$clan[id]', 
'0',
'<span class=dgreen>$user[login] получил $lvluser уровень</span>',
'$time')");
}
$read = '1';  
$to = $user['id'];
$from = '2';
$text = 'Поздравляем вы достигли уровня '.$lvluser.'. Награда: <img src="/images/icon/gold.png"/> '.$g.' золота!';
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `dialog` WHERE `uid2` = '.$user['id'].' AND `uid1` = "2"'),0) == 0) {
mysql_query("INSERT INTO `dialog` SET `uid2` = '".$user['id']."', `uid1` = '2', `time` = ".time()."");
}
mysql_query("INSERT INTO `mail` SET `uid1` = '$from',`time` = '$time',`uid2`='$to',`text` = '$text'");
   

?> 
<? 
if($user[level]>2){ 
?> 
<div class='block_outer center' style='margin:7px 4px 7px 4px;'><img src='/images/icon/2hit.png' alt=''/> <span class='dgreen bold'>Поздравляем!</span> <img src='/images/icon/2hit.png' alt=''/><div class='separ'></div>Ты получил новый уровень!<br/><span class='blue'>Награда:</span> <img src='/images/icon/gold.png' alt=''/> <?=$g?> золота<div class='separ'></div><? 
if($user[level]<2){ 
?><span class='yellow'>Тебе доступны <img src='/images/icon/league.png' alt=''/> Дуэли!</span><div class='mb10'></div><a class='btn' href='/duel/'><span class='end'><span class='label'>Перейти в дуэли</span></span></a></div><?}?> 
</div> 
<? 
} 
?> 
<? 
if($user[level]<2){ 
?><?}?> 

<?
 if($user['level'] == "19") { 
mysql_query('UPDATE `users` SET `league_place`="1000",`league`="2",`league_fights`="25" WHERE `id` = "'.$user['id'].'"'); 
}elseif($user['level'] == "29") { 
mysql_query('UPDATE `users` SET `league_place`="1000",`league`="3",`league_fights`="25" WHERE `id` = "'.$user['id'].'"'); 
}elseif($user['level'] == "49") { 
mysql_query('UPDATE `users` SET `league_place`="1000",`league`="4",`league_fights`="25" WHERE `id` = "'.$user['id'].'"'); 
}elseif($user['level'] == "79") { 
mysql_query('UPDATE `users` SET `league_place`="1000",`league`="5",`league_fights`="25" WHERE `id` = "'.$user['id'].'"'); 
}elseif($user['level'] == "99") { 
mysql_query('UPDATE `users` SET `league_place`="1000",`league`="6",`league_fights`="25" WHERE `id` = "'.$user['id'].'"'); 
}
 elseif($user['league'] == "0") { 
mysql_query('UPDATE `users` SET `league_place`="1000",`league`="1",`league_fights`="25" WHERE `id` = "'.$user['id'].'"'); 
}
?>

<?

}

if($clan) {
$clan_msg = mysql_fetch_array(mysql_query('SELECT * FROM `clan_msg` WHERE `clan` = "'.$clan['id'].'" AND `time` >= "'.$clan_memb['time'].'" ORDER BY `time` DESC LIMIT 1'));
if($clan_msg && mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_msg_read` WHERE `msg` = "'.$clan_msg['id'].'" AND `user` = "'.$user['id'].'"'),0) == 0 ) {
$clan_msg_user = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$clan_msg['user'].'"'));
if($_GET['clan_msg_read'] == true) {
mysql_query('INSERT INTO `clan_msg_read` (`msg`,`user`) VALUES ("'.$clan_msg['id'].'","'.$user['id'].'")');
header('location: ?');
}
?>

<div class="block_light center">
<b>Клановое объявление</b>
<br><?=$clan_msg['text']?><br>
Отправитель: <img src="/images/icon/race/<?=$clan_msg_user['r']?>.png" alt=""> <?=$clan_msg_user['login']?><br>
<span class="grey"><?=_times(time() - $clan_msg['time'])?></span>
<div class="separ"></div>
<a class="grey" href="?clan_msg_read=true">Скрыть</a>
</div>
<div class="mini-line"></div>

<?
}
}else{
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_invite` WHERE `user` = "'.$user['id'].'"'),0) > 0) {
$_invite = mysql_fetch_array(mysql_query('SELECT * FROM `clan_invite` WHERE `user` = "'.$user['id'].'"'));
$clan_invite = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$_invite['clan'].'"'));
if($_GET['invite'] == $clan_invite['id']) {
  mysql_query('INSERT INTO `clan_rud_user` SET `clan` = "'.$clan_invite['id'].'",`user` = "'.$user['id'].'"');
mysql_query('INSERT INTO `clan_journal` (`clan`,`text`,`close`,`time`) VALUES ("'.$clan_invite['id'].'","<img src=/images/icon/race/'.$user['r'].'.png> '.$user['login'].' вступил в клан","1","'.time().'")'); 
mysql_query('INSERT INTO `clan_memb` (`clan`,`user`,`time`,`last_update`) VALUES ("'.$clan_invite['id'].'","'.$user['id'].'","'.time().'","'.(time() + ((60 * 60) * 24)).'")');
mysql_query('DELETE FROM `clan_invite` WHERE `user` = "'.$user['id'].'"');
header('location: /clan/');
exit;
}
    
if($_GET['cancel_invite'] == true){
mysql_query('DELETE FROM `clan_invite` WHERE `clan` = "'.$clan_invite['id'].'" AND `user` = "'.$user['id'].'"');
header('location: '.$_SERVER['PHP_SELF'].'?');
exit;
}
?>

<div class='block_light center'>
<b>Приглашение в клан</b><br/><br/>

<table cellpadding='0' cellspacing='0' align='center'>
<tr>
<td><img src='/images/icon/clan/gerb/1.png' alt='*'/></td><td valign='top' style='padding-left: 5px; text-align: left;'>
<img src='/images/icon/clan/<?=$clan_invite['r']?>.png' alt='*'/> <a href='/clan/<?=$clan_invite['id']?>/'><?=$clan_invite['name']?></a><br/>
В клане: <b><?=mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_memb` WHERE `clan` = "'.$clan_invite['id'].'"'),0)?></b> человек<br/>
Бонус: <font color='#90c090'>+<?=clan_buff($clan_invite['built_1'])?></font> к сумме
</td>
</tr></table>

<div class='separ'></div>

<a href='?invite=<?=$clan_invite['id']?>'class='btn'><span class='end'><span class='label'>Вступить</span></span></a><br/>
<a href='?cancel_invite=true'><font color='#909090'>Отказаться</font></a>

</div>

<?
}
}

$q_gift = mysql_query("SELECT * FROM `user_podarok` WHERE `user_id` = '$user[id]'");
$gift = mysql_fetch_array($q_gift);
$time = $gift['last_auth'] + 86400;
$now = time();
if ($time < $now) {
echo "<div class='menuList'>";
echo "<li><center><a href='/podarok'><img src='/images/icon/podarok.png'>Получить подарок<img src='/images/icon/podarok.png'></a></center></li></div><div class='dot-line'></div>";}
//Колизей
if($_SERVER['PHP_SELF'] != '/coliseum.php'){
  $member = mysql_query('SELECT * FROM `coliseum_member` WHERE `user` = "'.$user['id'].'" ORDER BY `time` DESC LIMIT 1');
  $member = mysql_fetch_array($member);

  if($member) {

  $battle = mysql_query('SELECT * FROM `coliseum` WHERE `id` = "'.$member['battle'].'"');
  $battle = mysql_fetch_array($battle);
  if($battle['time'] > time() && mysql_result(mysql_query('SELECT COUNT(*) FROM `coliseum_member` WHERE `battle` = "'.$battle['id'].'"'),0) >= 2) {
echo "<div class='block_light center'>";
echo "<b class='dgreen'>Вы участвуете в битве</b><br>
<span class='grey'>До начала боя: ".($battle['time'] - time())." секунд</span>";
echo "<div class='separ'></div>";
echo "<a href='/coliseum/' class='btn'><span class='end'><span class='label'>Перейти в колизей</span></span></a>";
echo "</div>";
  }elseif($battle['start'] == 1 && $battle['end'] == 0){
  echo "<div class='block_light center'>";
echo "<b class='dgreen'>Вы учавствуите в битве</b><br>
<span class='grey'>Бой начался!</span>";
echo "<div class='separ'></div>";
echo "<a href='/coliseum/' class='btn'><span class='end'><span class='label'>Перейти в колизей</span></span></a>";
echo "</div>";
  }
  }
  }

if($_SERVER['PHP_SELF'] != '/drakon.php'){
if($user['mp']>25){
if($user['hp']>50){
$aluko = mysql_fetch_assoc(mysql_query("SELECT * FROM `aluko` ORDER BY `id` LIMIT 1"));
if($aluko['health']>0){
echo '<center><div class="block_zero"><img src="/images/icon/minidrakon.png">На помощь! На нас опять напал Дракон!<img src="/images/icon/minidrakon.png"><br>
<a href="/drakon.php"class="btn"><span class="end"><span class="label">Атаковать дракона</span></span></a></div></center>';
echo"<div class='mini-line'></div>";
}
}
}
}
$hrevolt =  mysql_fetch_assoc(mysql_query("SELECT * FROM  `time_jurnal` WHERE `name`='revolt' ORDER BY `id` DESC LIMIT 1"));
	if(($hrevolt['time'] - time()) < 900 && $hrevolt['time'] > time()) {
	
		$h =  ($hrevolt['time']-time())/3600%60;
		$m = ($hrevolt['time']-time())/60%60;
		$s = ($hrevolt['time']-time())%60;
	
	?>
			
				</br>Мятеж начнётся через: <font color='gren'><?php echo $h.':'.$m.':'.$s;?></font><br/><?							
	}
if($user['journal']>0){echo '<div class="mini-line"></div><div class="block_zero center"><a href="/journal.php"class="btn"><span class="end"><span class="label"><span style="color: #3C3;">Новых оповещений: +'.$user['journal'].'</span></span></span></div></a>';}
}else{
?>
<div class='main' style='word-wrap:break-word;'><span style='text-shadow:none;'></span>
<?
}
//Повышение ранга в колизее
if($user['star_1'] == 1 and $user['star_2'] == 1 and $user['star_3'] == 1){
	mysql_query('UPDATE `users` SET `star_1` = 0 ,`star_2` = 0 ,`star_3` = 0 ,`coliseum_rating` = `coliseum_rating` - 1 WHERE `id` ='.$user['id'].'');
	header('Location: ?');
}
//Повышение ранга в колизее(конец)
//чтобы небыло неполных звезд
if($user['star_1'] == '0.5' AND $user['star_2'] == '0.5'){
	mysql_query('UPDATE `users` SET `star_1` = 1 ,`star_2` = 0 WHERE `id` ='.$user['id'].'');
	header('Location: ?');
}
if($user['star_1'] == '0.5' AND $user['star_2'] == '1'){
	mysql_query('UPDATE `users` SET `star_1` = 1 ,`star_2` = 0.5 WHERE `id` ='.$user['id'].'');
	header('Location: ?');
}
if($user['star_2'] == '0.5' AND $user['star_3'] == '0.5'){
	mysql_query('UPDATE `users` SET `star_2` = 1 ,`star_3` = 0 WHERE `id` ='.$user['id'].'');
	header('Location: ?');
}
if($user['star_2'] == '0.5' AND $user['star_3'] == '1'){
	mysql_query('UPDATE `users` SET `star_2` = 1 ,`star_3` = 0.5 WHERE `id` ='.$user['id'].'');
	header('Location: ?');
}

?>




