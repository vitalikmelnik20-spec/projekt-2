<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';    
if(!$user) {
header('location: /');   
exit;
}
$title = 'Хижина мудреца';
include './system/h.php';  
$q = mysql_query ('select * from `user_q` WHERE (`user`="' . $user['id'] . '") AND (`complete`="0")');
if (mysql_num_rows ($q) != 0) {
while ($user_q = mysql_fetch_array ($q)) {
$q_ = mysql_query ('SELECT * FROM `quest` WHERE (`id`="' . $user_q['q'] . '")');
$quest = mysql_fetch_array ($q_);
if ($user_q['c']==$quest['c'])
$sage_flag = true;
}
}
?>
</div></div><div class='block_zero center blue'>Выполняй задания, собирай трофеи и реликвии<br/></div><div class='mini-line'></div><div class='center'><div class='block_zero'><img src='http://tiwar.ru/images/town/hd/sage.jpg' width='100%' alt=''/></div></div><div class='mini-line'></div><div class='menuList'><li><a href='/quest/'><img src='/images/icon/quest.png' alt=''/>Задания<span class='green'> <?= ( $sage_flag ? ' <span style="color:#30c030;">(+)</span>':'' ) ?></span><br/><span class='white small'>Выполняй задания, получай хорошую награду</span></a></li><li><a href='/medal/'><img src='/images/icon/quest.png' alt=''/>Трофеи<br/><span class='white small'>Получи все трофеи и стань легендарным титаном</span></a></li><li><a href='/relic.php'/'><img src='/images/icon/relic.png' alt=''/>Древние реликвии<br/><span class='white small'>Получай реликвии за выполнение ежедневных заданий</span></a></li></div><div class='mini-line'><?
include './system/f.php';
?>