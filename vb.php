<?

/**
# Данный модуль был написан TJersy
# Контакты: http://bymas.ru/id11894
# TJcompany | 2015 
# Любое распространение мода запрещено
**/ 


include './system/common.php';
include './system/functions.php';
include './system/user.php';
if(!$user) header('location: /');

$title = 'Великая битва';    
include './system/h.php';
echo "<div class='title'>$title</div>";

/*Админ*/

$a_f = mysql_fetch_array(mysql_query("SELECT * FROM `tj_admin`"));
$b_TJ = mysql_fetch_array(mysql_query("SELECT * FROM `tj_users` WHERE `id_user` = '$user[id]'"));
$s_u = mysql_fetch_array(mysql_query("SELECT * FROM `tj_users` ORDER BY `wins` DESC LIMIT 1"));
$lider_TJ = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '$s_u[id_user]'"));
$battle_win = mysql_fetch_array($s_u);
$top = mysql_query("SELECT * FROM `tj_users` WHERE `id_user` != '$lider_TJ[id]'  ORDER BY `wins` DESC LIMIT $a_f[top]");

/*Взнос*/
if(isset($_POST['vznos']) && mysql_result(mysql_query('SELECT COUNT(*) FROM `tj_users` WHERE `id_user` = "'.$user['id'].'" LIMIT 1'),0) == '0'){
	if($user['g'] < $a_f['silver_vznos']) echo('Недостаточно серебра');
	elseif($user['s'] < $a_f['gold_vznos']) echo('Недостаточно золота');
    else{
		
		mysql_query("INSERT INTO `tj_users` SET `id_user` = '$user[id]', `wins` = '0'") or die(mysql_error());
		mysql_query("UPDATE `users` SET `g` = `g` - '$a_f[gold_vznos]', `s` = `s` - '$a_f[silver_vznos]' WHERE `id` = '$user[id]'");
		header('Location:?');
		
		
	}
	
}


	
if($a_f['on/off'] > time() && mysql_result(mysql_query('SELECT COUNT(*) FROM `tj_users` WHERE `id_user` = "'.$user['id'].'" LIMIT 1'),0) == '0'){
echo "<div class='content' >
<center><img src='http://img3.wikia.nocookie.net/__cb20140527161839/castleclash/ru/images/1/1b/Nobility_9.png' width='30%'><br/>
<b>Перед тобой - великие врата битвы.</b><br/>
Суть этой битвы такова:</center>
<br/>
<small><font color='#F90'>1.Вы подаете заявку на участие!<br/>
2.Вы сражаетесь на дуэлях, арене.<br/>
3.После окончания сражений подводятся итоги!<br/>
<b>Окончание великой битвы через: "._time($a_f['on/off']-time())."</b>
</font></small><br/><center><b> Награда</b><br/></center>
 Победитель битвы получает:<br/> 
<img src='/images/icon/gold.png'> ".n_f($a_f[wins_gold])." <br/>
<img src='/images/icon/silver.png'> ".n_f($a_f[wins_silver])." <br/>
<hr/>
 Топ $a_f[top] игроков получают:<br/> 
<img src='/images/icon/gold.png'> ".n_f($a_f[top_gold])." <br/>
<img src='/images/icon/silver.png'> ".n_f($a_f[top_silver])." <br/>
<br/><center><b>Стоимость участия:</b><br/>
<img src='/images/icon/silver.png'> $a_f[silver_vznos] <br/>
<img src='/images/icon/gold.png'> $a_f[gold_vznos] <br/>
<form action='' method='POST'>
<input type='submit' name='vznos'  class='button' value='Участвовать'>
</form>
</div>";
####################
####################
}elseif($a_f['on/off'] > time()  && mysql_result(mysql_query('SELECT COUNT(*) FROM `tj_users` WHERE `id_user` = "'.$user['id'].'" LIMIT 1'),0) == '1'){
echo "<div class='content' >
<center><img src='http://img3.wikia.nocookie.net/__cb20140527161839/castleclash/ru/images/1/1b/Nobility_9.png' width='30%'><br/>
<b>Окончание великой битвы через: "._time($a_f['on/off']-time())."</b><br/>
<br/>
Мои битвы: <b>$b_TJ[wins]</b>

</center>

<center> Лидер битвы:
<h2> $lider_TJ[login] | бои:  $s_u[wins] </h2>

<small><font color='#F90'>* Учитываются все битвы проведенные на арене и в дуэлях.</font></small>

</center>
</div>";

################
################
}elseif($a_f['on/off'] < time()){
	
	
	
echo "<div class='content' >
<center><img src='http://img3.wikia.nocookie.net/__cb20140527161839/castleclash/ru/images/1/1b/Nobility_9.png' width='30%'><br/>
<b>Великая битва окончена!<br/>Поздравляем победителей и ТОП игроков! </b>
<h3>Победитель:<br/>
$lider_TJ[login] | Битвы: $s_u[wins] </h3>
<br/></center>
<font color='#F90'>Приветствуем топ <b>$a_f[top]</b> игроков:</font> <br/>";
if(mysql_num_rows($top)=='0') echo "<font color='#fa6464'> Топ игроки отсутствуют</font>";

while($tops = mysql_fetch_array($top)){
	
	$row  = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '$tops[id_user]' LIMIT 1"));?>

	
<img src='/images/icon/race/<?=$row['r'].($row['online'] > (time() - 300) ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$row['id']?>/'><?=$row['login']?></a> <img src='/images/icon/level.png' alt='*'/> <?=$row['level']?> ур<br/>  Битвы: <?=$tops['wins']?><Br/>
	
	<?
}

echo "</div></center>";


}




include './system/f.php';

?>