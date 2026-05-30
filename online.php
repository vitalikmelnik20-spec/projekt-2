<?
include './system/common.php';
include './system/functions.php';      
include './system/user.php';

if(!$user) {
header('location: /');   
exit;
}

$action = _string($_GET['action']);
switch($action) {

case 'clan':
$title = 'Без клана';
include './system/h.php';
?><div class="main">
<div class="block_zero"><a href="/online/">Все игроки</a> | Без клана | <a href="/online/search/">Поиск</a></div>
<div class="mini-line"></div>
<div class="block_zero">
	
<?	
$max = 10;
$count = mysql_num_rows(mysql_query("SELECT `id` FROM `users` WHERE (SELECT COUNT(`user`) FROM `clan_memb` WHERE `user` = `users`.`id`)  = 0  and `users`.`online` > '".(time() - 300)."'"));
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));
if($page > $pages) {
$page = $pages;
}
if($page < 1) {
$page = 1;
}
$start = $page * $max - $max;
$q = "SELECT * FROM `users` WHERE (SELECT COUNT(`user`) FROM `clan_memb` WHERE `user` = `users`.`id`)  = 0  and `users`.`online` > '".(time() - 300)."' ORDER BY `level` DESC LIMIT ".$start.", ".$max."";
$q = mysql_query($q);
while($row = mysql_fetch_assoc($q)) {
	
if($row['self'] == '/index.php')$ontitle = '- Главная';
if($row['self'] == '/chat.php')$ontitle = '- Чат';
if($row['self'] == '/moder_chat.php')$ontitle = '- Чат';
if($row['self'] == '/clan.php')$ontitle = '- Клан';
if($row['self'] == '/mail.php')$ontitle = '- Почта';
if($row['self'] == '/forum.php')$ontitle = '- Форум';
if($row['self'] == '/settings.php')$ontitle = '- Настройки';
if($row['self'] == '/shop.php')$ontitle = '- Магазин снаряжения';
if($row['self'] == '/smiles.php')$ontitle = '- Список смайликов';
if($row['self'] == '/smith.php')$ontitle = '- Кузница';
if($row['self'] == '/ticket.php')$ontitle = '- Поддержка';
if($row['self'] == '/train.php')$ontitle = '- Тренировка';
if($row['self'] == '/user.php')$ontitle = '- Профиль';
if($row['self'] == '/trade.php')$ontitle = '- Получить золото';
if($row['self'] == '/save.php')$ontitle = '- Сохранение';
if($row['self'] == '/sage.php')$ontitle = '- Хижина мудреца';
if($row['self'] == '/sack.php')$ontitle = '- Ресурсы';
if($row['self'] == '/rules-3.php')$ontitle = '- Соглашение';
if($row['self'] == '/rules-2.php')$ontitle = '- Правила общения';
if($row['self'] == '/rules-1.php')$ontitle = '- Правила игры';
if($row['self'] == '/rinok.php')$ontitle = '- Центр города';
if($row['self'] == '/revolt.php')$ontitle = '- Мятеж';
if($row['self'] == '/relic.php')$ontitle = '- Хижина мудреца';
if($row['self'] == '/rating.php')$ontitle = '- Рейтинг';
if($row['self'] == '/quest.php')$ontitle = '- Хижина мудреца';
if($row['self'] == '/profesion.php')$ontitle = '- Професии';
if($row['self'] == '/podarok.php')$ontitle = '- Ежедневный подарок';
if($row['self'] == '/pits.php')$ontitle = '- Магазин питомцев';
if($row['self'] == '/petshop.php')$ontitle = '- Магазин питомцев';
if($row['self'] == '/pets_sxvatk.php')$ontitle = '- Схватка питомцев';
if($row['self'] == '/pet.php')$ontitle = '- Магазин питомцев';
if($row['self'] == '/online.php')$ontitle = '- Онлайн';
if($row['self'] == '/nabeg.php')$ontitle = '- Набег';
if($row['self'] == '/mody.php')$ontitle = '- Список модераторов';
if($row['self'] == '/moderators.php')$ontitle = '- Список модераторов';
if($row['self'] == '/league.php')$ontitle = '- Лига';
if($row['self'] == '/lab.php')$ontitle = '- Лаборатория';
if($row['self'] == '/king.php')$ontitle = '- Король бессмертных';
if($row['self'] == '/journal.php')$ontitle = '- Журнал Сражений';
if($row['self'] == '/item.php')$ontitle = '- Снаряжение';
if($row['self'] == '/inv.php')$ontitle = '- Снаряжение';
if($row['self'] == '/gifts_2.php')$ontitle = '- Почта';
if($row['self'] == '/gifts.php')$ontitle = '- Почта';
if($row['self'] == '/gerb.php')$ontitle = '- Клан';
if($row['self'] == '/fights.php')$ontitle = '- Сражения';
if($row['self'] == '/farm.php')$ontitle = '- Поход';
if($row['self'] == '/exchanger.php')$ontitle = '- Обменник';
if($row['self'] == '/exchange.php')$ontitle = '- Обменник';
if($row['self'] == '/equip.php')$ontitle = '- Снаряжение';
if($row['self'] == '/duel.php')$ontitle = '- Дуэли';
if($row['self'] == '/drakon.php')$ontitle = '- Пещерный Дракон';
if($row['self'] == '/degeneration.php')$ontitle = '- Перерождение';
if($row['self'] == '/cw.php')$ontitle = '- Клановые Битвы';
if($row['self'] == '/complect.php')$ontitle = '- Магазин снаряжения';
if($row['self'] == '/common.php')$ontitle = '- Общее';
if($row['self'] == '/coliseum.php')$ontitle = '- Колизей';
if($row['self'] == '/clans.php')$ontitle = '- Рейтинг';
if($row['self'] == '/cforum.php')$ontitle = '- Форум';
if($row['self'] == '/campaign.php')$ontitle = '- Поход';
if($row['self'] == '/cave.php')$ontitle = '- Пещера';
if($row['self'] == '/bazaar.php')$ontitle = '- Аукцион ресурсов';
if($row['self'] == '/arena.php')$ontitle = '- Арена';
if($row['self'] == '/amulets.php')$ontitle = '- Амулеты';
if($row['self'] == '/ability.php')$ontitle = '- Умения';
?>

<font color="FFD700"><img src="/images/icon/race/<?=$row['r'].($row['online'] > (time() - 300) ? '':'-off')?>.png" alt=""><font color="FFD700"> <a href="/user/<?=$row['id']?>/"><?=$row['login']?></a> <img src="/images/icon/level.png" alt=""> <?=$row['level']?> <?=$ontitle?><br>
</div></font>
<?
}
?>

<?=pages('?');?>
</div></div>

<?
include './system/f.php';
break;

default:
$title = 'Онлайн';
include './system/h.php';
?>
<div class="main">
<div class="block_zero">Все игроки | <a href="/online/?action=clan">Без клана</a> | <a href="/online/search/">Поиск</a></div>
<div class="mini-line"></div>
<?
$usn= mysql_query("SELECT * FROM `users` ORDER BY `id` DESC LIMIT 1");
while($usnew= mysql_fetch_assoc($usn)){
echo"<div class='block_zero'>";
$texter = 'Приветствуем нового игрока '.$usnew['login'].'!</div><div class="mini-line"></div>';
echo '<center><img src="/images/smiles/mini_blush.gif"> '.$texter.'';
echo'';}
?>
<div class="block_zero">

<?
$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `online` > "'.(time() - 300).'"'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));
if($page > $pages) {
$page = $pages;
}
if($page < 1) {
$page = 1;
}
$start = $page * $max - $max;
$q = mysql_query('SELECT * FROM `users` WHERE `online` > "'.(time() - 300).'" ORDER BY `level` DESC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) { 

if($row['self'] == '/index.php')$ontitle = '- Главная';
if($row['self'] == '/chat.php')$ontitle = '- Чат';
if($row['self'] == '/moder_chat.php')$ontitle = '- Чат';
if($row['self'] == '/clan.php')$ontitle = '- Клан';
if($row['self'] == '/mail.php')$ontitle = '- Почта';
if($row['self'] == '/forum.php')$ontitle = '- Форум';
if($row['self'] == '/settings.php')$ontitle = '- Настройки';
if($row['self'] == '/shop.php')$ontitle = '- Магазин снаряжения';
if($row['self'] == '/smiles.php')$ontitle = '- Список смайликов';
if($row['self'] == '/smith.php')$ontitle = '- Кузница';
if($row['self'] == '/ticket.php')$ontitle = '- Поддержка';
if($row['self'] == '/train.php')$ontitle = '- Тренировка';
if($row['self'] == '/user.php')$ontitle = '- Профиль';
if($row['self'] == '/trade.php')$ontitle = '- Получить золото';
if($row['self'] == '/save.php')$ontitle = '- Сохранение';
if($row['self'] == '/sage.php')$ontitle = '- Хижина мудреца';
if($row['self'] == '/sack.php')$ontitle = '- Ресурсы';
if($row['self'] == '/rules-3.php')$ontitle = '- Соглашение';
if($row['self'] == '/rules-2.php')$ontitle = '- Правила общения';
if($row['self'] == '/rules-1.php')$ontitle = '- Правила игры';
if($row['self'] == '/rinok.php')$ontitle = '- Центр города';
if($row['self'] == '/revolt.php')$ontitle = '- Мятеж';
if($row['self'] == '/relic.php')$ontitle = '- Хижина мудреца';
if($row['self'] == '/rating.php')$ontitle = '- Рейтинг';
if($row['self'] == '/quest.php')$ontitle = '- Хижина мудреца';
if($row['self'] == '/profesion.php')$ontitle = '- Професии';
if($row['self'] == '/podarok.php')$ontitle = '- Ежедневный подарок';
if($row['self'] == '/pits.php')$ontitle = '- Магазин питомцев';
if($row['self'] == '/petshop.php')$ontitle = '- Магазин питомцев';
if($row['self'] == '/pets_sxvatk.php')$ontitle = '- Схватка питомцев';
if($row['self'] == '/pet.php')$ontitle = '- Магазин питомцев';
if($row['self'] == '/online.php')$ontitle = '- Онлайн';
if($row['self'] == '/nabeg.php')$ontitle = '- Набег';
if($row['self'] == '/mody.php')$ontitle = '- Список модераторов';
if($row['self'] == '/moderators.php')$ontitle = '- Список модераторов';
if($row['self'] == '/league.php')$ontitle = '- Лига';
if($row['self'] == '/lab.php')$ontitle = '- Лаборатория';
if($row['self'] == '/king.php')$ontitle = '- Король бессмертных';
if($row['self'] == '/journal.php')$ontitle = '- Журнал Сражений';
if($row['self'] == '/item.php')$ontitle = '- Снаряжение';
if($row['self'] == '/inv.php')$ontitle = '- Снаряжение';
if($row['self'] == '/gifts_2.php')$ontitle = '- Почта';
if($row['self'] == '/gifts.php')$ontitle = '- Почта';
if($row['self'] == '/gerb.php')$ontitle = '- Клан';
if($row['self'] == '/fights.php')$ontitle = '- Сражения';
if($row['self'] == '/farm.php')$ontitle = '- Поход';
if($row['self'] == '/exchanger.php')$ontitle = '- Обменник';
if($row['self'] == '/exchange.php')$ontitle = '- Обменник';
if($row['self'] == '/equip.php')$ontitle = '- Снаряжение';
if($row['self'] == '/duel.php')$ontitle = '- Дуэли';
if($row['self'] == '/drakon.php')$ontitle = '- Пещерный Дракон';
if($row['self'] == '/degeneration.php')$ontitle = '- Перерождение';
if($row['self'] == '/cw.php')$ontitle = '- Клановые Битвы';
if($row['self'] == '/complect.php')$ontitle = '- Магазин снаряжения';
if($row['self'] == '/common.php')$ontitle = '- Общее';
if($row['self'] == '/coliseum.php')$ontitle = '- Колизей';
if($row['self'] == '/clans.php')$ontitle = '- Рейтинг';
if($row['self'] == '/cforum.php')$ontitle = '- Форум';
if($row['self'] == '/campaign.php')$ontitle = '- Поход';
if($row['self'] == '/cave.php')$ontitle = '- Пещера';
if($row['self'] == '/bazaar.php')$ontitle = '- Аукцион ресурсов';
if($row['self'] == '/arena.php')$ontitle = '- Арена';
if($row['self'] == '/amulets.php')$ontitle = '- Амулеты';
if($row['self'] == '/ability.php')$ontitle = '- Умения';
?>

<font color="FFD700"><img src="/images/icon/race/<?=$row['r'].($row['online'] > (time() - 300) ? '':'-off')?>.png" alt=""> <font color="FFD700"><a href="/user/<?=$row['id']?>/"><?=$row['login']?></a> <img src="/images/icon/level.png" alt=""> <?=$row['level']?> <?=$ontitle?><br> </font>

<?
}
?>

<?=pages('?');?>
</div></div>

<?
include './system/f.php';
break;
case 'search':
$title = 'Поиск игрока';
include './system/h.php';  
$login = _string($_POST['login']);
if($login) {
$users = mysql_query('SELECT * FROM `users` WHERE `login` = "'.$login.'"');
$users = mysql_fetch_array($users);
if($users) {
header('location: /user/'.$users['id'].'/');
}
else
{
}
}
?>
<div class="main">
<div class="block_zero"><a href="/online/">Все игроки</a> | <a href="/online/?action=clan">Без клана</a> | Поиск</div>
<div class="mini-line"></div>

<div class="block_zero" action="/online/search/">
<form method="post">
<div>Имя персонажа:<br>
<input class="text medium-text" name="login" maxlength="20" value="" type="text">
<br>
<span class="btn"><span class="end"><input class="label" value="Поиск" type="submit">Поиск</span></span>
</div>
</form>
</div>
</div>
<?
include './system/f.php';
break;
} 
?>