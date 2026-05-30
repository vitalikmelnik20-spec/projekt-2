<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
   
$action = _string($_GET['action']);

switch($action) {
default:
    
$title = 'Общее';
include './system/h.php'; 
 
if($user) {
echo '
<div class="menuList">
<li><a class="dgreen" href="/common/refferal/"><img src="/images/icon/user.png" alt="">Пригласи друга</a></li>
<li><a href="/ticket/"><img src="/images/icon/arrow.png" alt="">Поддержка</a></li>
<li><a href="/agreement/"><img src="/images/icon/arrow.png" alt="">Соглашение</a></li>
<li><a href="/rules/1/"><img src="/images/icon/arrow.png" alt="">Правила игры</a></li>
<li><a href="/rules/2/"><img src="/images/icon/arrow.png" alt="">Правила общения</a></li>
</div>
';
include './system/f.php';
}else{
echo '
<div class="head" onclick="location.href=&quot;/&quot;"><div class="center">Общее</div></div>
<div class="line"></div>
<div class="menuList">
<li><a href="/agreement/"><img src="/images/icon/arrow.png" alt="">Соглашение</a></li>
<li><a href="/rules/1/"><img src="/images/icon/arrow.png" alt="">Правила игры</a></li>
<li><a href="/rules/2/"><img src="/images/icon/arrow.png" alt="">Правила общения</a></li>
</div>
';
include './system/f.php';
}
break;

case 'refferal':
if(!$user) {
header('location: /');    
exit;
}

$title = 'Реферальная система';
include './system/h.php';  
?>

<div class="block_zero">Ваша ссылка: http://<?=$_SERVER['HTTP_HOST']?>/start/<?=$user['id']?></div>
<div class='dot-line'></div>
<div class='block_zero center'>
<span class="Admin">Если игрок зарегистрируется по вашей ссылке, вы получите <img src="/images/icon/gold.png"> 500 золота!</span>
</div>
<div class='mini-line'></div>

<?
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ref` WHERE `user` = "'.$user['id'].'"'),0);
?>

<div class='block_zero'>
<b>Приглашено друзей: [<?=$count?>]</b><br>

<?
$max = 10;
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));
if($page > $pages) {
$page = $pages;
}
if($page < 1) {
$page = 1;
}
$start = $page * $max - $max;

if($count > 0) {

$q = mysql_query('SELECT * FROM `ref` WHERE `user` = "'.$user['id'].'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {
$ho = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['ho'].'"');
$ho = mysql_fetch_array($ho); 
?>

<img src='/images/icon/race/<?=$ho['r'].($ho['online'] > (time() - 300) ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$ho['id']?>/'><?=$ho['login']?></a><br/>

<?
}
?>

<div class="dot-line"></div>
<?=pages('/common/refferal/?');?>

<?
}else{
?>

<font color='#999'>Вы ещё никого не пригласили</font>

<?
}
?>

</div>

<?

include './system/f.php';

  break;

}
  

?>