<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
$title = 'Бонус клан опыта';
include './system/h.php';
$V_C = mysql_fetch_array(mysql_query('SELECT * FROM `v_clan` WHERE `user` = '.$user['id'].''));
if(!$V_C){
	mysql_query('INSERT INTO `v_clan` (`user`,`v`)VALUES('.$user['id'].',0)');
	header('Location: /clan/expbonus');
}
switch($V_C['v']){
	case 0:
	$coast = '10';
	$V = '10';
	break;
	case 10:
	$coast = '20';
	$V = '50';
	break;
	case 50:
	$coast = '30';
	$V = '100';
	break;
	case 100:
	$coast = '40';
	$V = '150';
	break;
	case 150:
	$coast = '50';
	$V = '200';
	break;
	case 200:
	$coast = '0';
	$V = '0';
	break;
}
?><div class='main'>
Ваша верность клана: <?=$V_C['v']?>%<br/>
Вы можете увеличить верность клану.<br/>
<small>Верность клана дает больше опыта в клан от сражений</small>
<?
if($V_C['v'] == '200'){
?>
Вы неможете больше увеличить верность
<?
}else{
	if($user['g'] >= $coast){
	if($_GET['v'] == '1'){
		mysql_query('UPDATE `v_clan` SET `v` = '.$V.' WHERE `user` = '.$user['id'].'');
		mysql_query('UPDATE `users` SET `g` = `g` - '.$coast.' WHERE `user` = '.$user['id'].'');
		header ('Location: /clan/expbonus');
	}
	}else{
		echo'У вас недостаточно золота';
	}
?>
<a href='?v=1'>Повысить верность <?=$coast?><img src='/images/icon/gold.png'></a>
<?
}
?>
</div>
<?
include './system/f.php';
?>