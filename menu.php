<?
include './system/common.php';  
include './system/functions.php';
include './system/user.php';
        
$title = 'Игра';
include './system/h.php';
auth();
///News
if(isset($_SESSION['news'])){
echo $_SESSION['news'];
unset($_SESSION['news']);
}

if($user){
if($mail > 0) {
?>

<div class="menuList">
<li class="center"><a href="/mail/"><img src="/images/icon/mail.png" alt=""><span class="green">Новая почта</span> +<?=$mail;?></a></li>
</div>
<div class="dot-line"></div>

<?
} 

$max = 1;
$q = mysql_query("SELECT * FROM `forum_topic` WHERE `sub` = '1' ORDER BY `id` DESC LIMIT 1");
while($row = mysql_fetch_array($q)) {
if (isset($_GET['nread'])){
if($user['nread'])$nnred = '0';
mysql_query("UPDATE `users` SET `nread` = '".($nnred + $row['id'])."' WHERE `id` = '".$user['id']."'");
header("Location: /");
exit;
}
 
if (isset($_GET['sread'])){
if($user['nread'])$nnred = '0';
mysql_query("UPDATE `users` SET `nread` = '".($nnred + $row['id'])."' WHERE `id` = '".$user['id']."'");
header("Location: /forum/topic/".$row['id']."/");
exit;
}
if($row['id'] > $user['nread']){
?>
<div class="block_light center">
<span class="dgreen">Новая тема в новостях!</span>
<div class="separ"></div>
<img src="/images/icon/forum_2.png" alt=""> <b><?=$row['name']?></b> <img src="/images/icon/forum_2.png" alt="">
<div class="mb10"></div>
<a class="btn" href="?sread"><span class="end"><span class="label">Посмотреть новость</span></span></a>
<br/>
<a href="?nread">Скрыть</a>
</div>
<div class="mini-line"></div>
<?
}
}
?>


</div>

<div class="mini-line"></div>

<div class="menuList">
<?
 if($user['access'] != 0) echo '<li><center><a href="/adm/"><img src="/images/icon/arena.png" alt="">Админка </a></center></a></li>';
  

//Главная
echo '
<div class="block_zero center">
        <img src="/images/main_w.jpg" width="100%" alt=""/>
        <div class="mb5"></div>Сражайся на Арене!
<div class="mini-line"></div>
 <div class="mini_text">
            <img alt="" src="/assets/img/f.png"/> Сражения <img alt="" src="/assets/img/f.png"/>
        </div>
        <div class="tab">
<div><a href = "/boss_by_cmpunk/index.php" ><img src="/images/icon/arena.png" alt=""/>Боссы</a></div>
</div>
<div class="tab">
<div><a href = "/arena?attack=true" ><img src="/images/icon/arena.png" alt=""/>Арена</a></div>
<div><a href = "/cave/" class="grey"><img src="/images/icon/cave.png" alt=""/>Пещера</a></div>
</div>
<div class="tab">
<div><a href="/polezombi.php/"><img src="/images/icon/polezobi.png"  width="15">Поле зомби</a></div>
<div><a href="/cw/"><img src="/images/icon/clanwar.png" alt="">Клановые битвы</a></div>
</div>
<div class="tab">
<div><a href="/revolt/"><img src="/images/icon/hellworld.png" alt="">Мятеж</a></div>
<div><a href="/aid.php/"><img src="/images/icon/clanwar.png" alt="">Царство Аида</a></div>
</div>
<div class="tab">
<div><a href="/lair.php/"><img class="icon" src="http://144.76.127.94/view/image/icons/ability.png" /> Логово монстров</a></div>
<div><a href="/king.php"><img src="/images/icon/king.png" alt="*"/> Король бессмертных</a></div>
</div>
<div class="tab">
<div><a href="/undying.php"><img src="/images/icon/bar.png" alt="*"/> Долина бессмертных</a></div>
<div><a href = "/campaign/" class="grey"><img src="/images/icon/farm.png" alt=""/>Поход</a></div>
</div>
<div class="mini-line"></div>
 <div class="mini_text">
            <img alt="" src="/assets/img/f.png"/> Покупки <img alt="" src="/assets/img/f.png"/>
        </div>
<div class="tab">
<div><a href = "/sage.php/" class="grey"><img src="/images/icon/quest.png" alt=""/>Хижина мудреца</a></div>
<div><a href = "/trade/" class="grey"><img src="/images/icon/gold.png" alt=""/>Получить золото</a></div>
</div>
<div class="tab">
<div><a href = "/shop/" class="grey"><img src="/images/icon/equip.png" alt=""/>Магазин снаряжения</a></div>
<div><a href = "/shop/" class="grey"><img src="/images/icon/equip.png" alt=""/>Профессии</a></div>
</div>
<div class="mini-line"></div>
<div class="tab">
<div><a href = "/smith/" class="grey"><img src="/images/icon/smith.png" alt=""/>Кузница</a></div>
<div><a href = "/lab/" class="grey"><img src="/images/icon/lab.png" alt=""/>Лаборатория</a></div>
</div></div>
<div class = "tab">
<div><a href = "/sunduk" class="grey">Сундук</a></div>
</div>
</div>
';
}
include './system/f.php';
?>