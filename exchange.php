<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) {
header('location: /');   
exit;
}

switch($_GET['action']) {
default:

$msg = htmlspecialchars($_GET['msg']);
if ($msg == 1)$msg = '<div class="ok center"><img src="/images/icon/ok.png"> Обмен был успешно завершен!</div>';
else if ($msg == 2)$msg = '<div class="error center"><img src="/images/icon/error.png"> Обмен не удался!</div>';
else $msg = '';

$title = 'Обменник';    
include './system/h.php';

if (isset($_SESSION['exmsg'])){
echo ''.$_SESSION['exmsg'].'';
$_SESSION['exmsg']=NULL;
}

$exchange = mysql_fetch_array(mysql_query('SELECT * FROM `exchange` WHERE `user_id` = '.$user['id'].''));
if (!$exchange)mysql_query('INSERT INTO `exchange` (`user_id`,`count`,`time`) VALUES ('.$user['id'].',"0",'.time().')');
if (time()-$exchange['time']>=86400){
mysql_query('UPDATE `exchange` SET `count` = 0,`time` = '.time().' WHERE `user_id` = '.$user['id'].'');
header('Location: ?');
break;
}

$_SESSION['exmsg'] = ''.$msg.'';
?>


<div class="block_zero center blue">Обмен: <img src="/images/icon/silver.png" alt=""> Серебро -&gt; <img src="/images/icon/gold.png" alt=""> Золото<br></div>
<div class="mini-line"></div>

<?
if($exchange['count']>=$user['level']){
?>
<div class="block_zero grey center">Нет доступного золота к обмену</div>
<?
}else{
?>
<div class="block_zero center"><span class="small grey">Доступное золото к обмену: <?echo ($user['level']-$exchange['count']);?> из <?echo $user['level'];?></span></div>
<div class="dot-line"></div>
<div class="menuList">
<?
if(($user['level']-$exchange['count'])>=1){
?>
<li><a href="/trade/exchange/silver/1/"><img src="/images/icon/arrow.png" alt="">Обменять <span class="white"><img src="/images/icon/silver.png" alt=""><?=(1*500)?> <span class="blue">-&gt;</span> <img src="/images/icon/gold.png" alt="">1</span></a></li>
<?
}
if(($user['level']-$exchange['count'])>=5){
?>
<li><a href="/trade/exchange/silver/5/"><img src="/images/icon/arrow.png" alt="">Обменять <span class="white"><img src="/images/icon/silver.png" alt=""><?=(5*500)?> <span class="blue">-&gt;</span> <img src="/images/icon/gold.png" alt="">5</span></a></li>
<?
}
if($user['level']>=10){
if(($user['level']-$exchange['count'])>=10){
?>
<li><a href="/trade/exchange/silver/10/"><img src="/images/icon/arrow.png" alt="">Обменять <span class="white"><img src="/images/icon/silver.png" alt=""><?=(10*500)?> <span class="blue">-&gt;</span> <img src="/images/icon/gold.png" alt="">10</span></a></li>
<?
}
}
?>
</div>
<?
}
?>

<div class="mini-line"></div>
<ul class="hint"><li>Каждый уровень героя позволяет обменивать на <img src="/images/icon/gold.png" alt=""> 1 золото больше</li></ul>
<div class="mini-line"></div>

<?
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<div class="block_zero center blue">Купить <img src="/images/icon/silver.png" alt=""> Cеребро</div>
<div class="mini-line"></div>
<?
if($user['g'] < 1){
?>
<div class="block_zero grey center">Недостаточно золота к обмену</div>
<?
}else{
?>
<div class="menuList">
<?
if ($user['g']>=1){
?>
<li><a href="/trade/exchange/gold/1/"><img src="/images/icon/arrow.png" alt="">Купить <span class="white"><img src="/images/icon/silver.png" alt=""><?=(1*500)?> за <img src="/images/icon/gold.png" alt="">1</span></a></li>
<?
}
if ($user['g']>=10){
?>
<li><a href="/trade/exchange/gold/10/"><img src="/images/icon/arrow.png" alt="">Купить <span class="white"><img src="/images/icon/silver.png" alt=""><?=(10*500)?> за <img src="/images/icon/gold.png" alt="">10</span></a></li>
<?
}
if ($user['g']>=100){
?>
<li><a href="/trade/exchange/gold/100/"><img src="/images/icon/arrow.png" alt="">Купить <span class="white"><img src="/images/icon/silver.png" alt=""><?=(100*500)?> за <img src="/images/icon/gold.png" alt="">100</span></a></li>
<?
}
?>
</div>
<?
}


include './system/f.php';
break;

case 'exchange':
$title = 'Обменник';    
include './system/h.php';
$exc = htmlspecialchars($_GET['exc']);
$count = htmlspecialchars($_GET['count']);
$exchange = mysql_fetch_array(mysql_query('SELECT * FROM `exchange` WHERE `user_id` = '.$user['id'].''));
if($count < 0 or $count > 100){ 
header('location: /trade/exchange/?msg=2');
break;
}
$silver = $count * 500;
if ($exc == 'gold'){
if (($user['level']-$exchange['count'])<$count){
header('location: /trade/exchange/?msg=2');
break;
}
if ($user['s'] < $silver){
header('location: /trade/exchange/?msg=2');
break;
}
mysql_query('UPDATE users set g = g + '.$count.' , s = s - '.$silver.' where id = '.$user['id'].'');
mysql_query('UPDATE exchange set count = count + '.$count.', time = '.time().' where user_id = '.$user['id'].'');
header('location: /trade/exchange/?msg=2');
}
else if ($exc == 'silver'){
if ($user['g'] < $count){
header('location: /trade/exchange/?msg=1');
break;
}
mysql_query('UPDATE users set g = g - '.$count.' , s = s + '.$silver.' where id = '.$user['id'].'');
header('location: /trade/exchange/?msg=1');
}
else header('location: /trade/exchange/?msg=2');
include './system/f.php';
break;

}

?>