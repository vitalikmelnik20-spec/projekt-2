<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';    
if(!$user) {
header('location: /');   
exit;
}
$title = 'Великие сражения';
include './system/h.php';  
?>

<div class="block_zero center blue">Великие сражения титанов!<br></div>

<div class="mini-line"></div>
<div class="center"><div class="block_zero"><img src="/images/town/hd/fights.jpg" alt="" width="100%"></div></div>
<div class="mini-line"></div>

<div class="menuList">
<?
$league = array( '', 'новичков', 'опытных', 'претендентов', 'мастеров', 'титанов', 'избранных' );
?>
<li><a href="/league.php/"><img src="/images/icon/league.png" alt="">Лига  <?=$league[$user['league']]?> <?=( $user['league_fights'] > 1 ? '<font color=\'#30c030\'>(+)</font>':'')?></a></li>
<li><a href="/polezombi.php/"><img src="/images/icon/polezobi.png"  width="15">Поле зомби</a></li>
<li><a href="/cw/"><img src="/images/icon/clanwar.png" alt="">Клановые битвы</a></li>
<li><a href="/revolt/"><img src="/images/icon/hellworld.png" alt="">Мятеж</a></li>
<li><a href="/aid.php/"><img src="/images/icon/clanwar.png" alt="">Царство Аида</a></li>
<li><a href="/lair.php/"><img class="icon" src="http://144.76.127.94/view/image/icons/ability.png" /> Логово монстров</a></li>
<?

$king_member = mysql_query('SELECT * FROM `king_member` WHERE `user` = "'.$user['id'].'" ORDER BY `id` DESC LIMIT 1');
$king_member = mysql_fetch_array($king_member);
$king= mysql_query('SELECT * FROM `king` WHERE `start` = "0" LIMIT 1');
$king= mysql_fetch_array($king);  
?>
<li><a href='/king.php'><img src='/images/icon/king.png' alt='*'/> Король бессмертных <?=($king_member['battle'] != $king['id'] ? '<font color=\'#3c3\'>(+)</font>':'')?></a>
<?
if($user['level'] < 7) {
?>
<small><font color='#999'>Доступно с <img src='/images/icon/level.png' alt='*'/> 10 уровня</font></small>
<?
}
else
{
?>
<small>Битва через: <?=_time($king['time'] - time())?></small>
<?
}
?>
<div class="menuList">
<?
$undying_member = mysql_query('SELECT * FROM `undying_member` WHERE `user` = "'.$user['id'].'" ORDER BY `id` DESC LIMIT 1');
$undying_member = mysql_fetch_array($undying_member);
$undying = mysql_query('SELECT * FROM `undying` WHERE `start` = "0" LIMIT 1');
$undying = mysql_fetch_array($undying);  
?>
<li><a href='/undying.php'><img src='/images/icon/bar.png' alt='*'/> Долина бессмертных <?=($undying_member['battle'] != $undying['id'] ? '<font color=\'#3c3\'>(+)</font>':'')?></a>
<?
if($user['level'] < 4) {
?>
<small><font color='#999'>Доступно с <img src='/images/icon/level.png' alt='*'/> 4 уровня</font></small>
<?
}
else
{
?>
<small>Битва через: <?=_time($undying['time'] - time())?></small>
<?
}

?>
<div>
<?
include './system/f.php';
?>