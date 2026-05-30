<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
auth();

switch($_GET['action']) {
default:

$title = 'Рейтинг кланов';    
include './system/h.php';  
?>
<div class='main'>
<?
$max = 10;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clans`'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));
if($page > $pages) {
$page = $pages;
}
if($page < 1) {
$page = 1;
}
$start = $page * $max - $max;
if($page == 1) {
$i = $page - 1;
}
elseif($page == 2) {
$i = ($page + 9);
}else{
$i = ($page * 10) - 9;
}

if($page == 1) {
echo '
<div class="center"><div class="block_zero"><img src="/images/town/hd/rating.jpg" alt="" width="100%"></div></div>
<div class="mini-line"></div>
';
}

if($count > 0) {

$q = mysql_query('SELECT * FROM `clans` ORDER BY `level` DESC,`exp` DESC LIMIT '.$start.', '.$max.'');
while($row = mysql_fetch_array($q)) {
$i++;
if($i < 4) {
?>

<div class="block_zero">
<img src="/images/icon/crys/<?=$i?>.png" alt=""> <?=$i?> место<div class="mb10"></div>
<a href="/clan/<?=$row['id']?>/"><img class="float-left" src="/images/icon/clan/gerb/<?=$row['gerb']?>.png" alt="" style="margin-right:3px;"></a>
<img src="/images/icon/clan/<?=$row['r']?>.png" alt=""> <a href="/clan/<?=$row['id']?>/"><?=$row['name']?></a> <br>
<img src="/images/icon/level.png" alt=""> Уровень: <b><?=$row['level']?></b> <br>
<img src="/images/icon/exp.png" alt=""> Опыт: <?=n_f($row['exp'])?><br>
</div>
<div class="mini-line"></div>

<?
}else{
?>

<div class="block_zero">
<span class="white"><?=$i?></span>. <img src="/images/icon/clan/<?=$row['r']?>.png" alt=""> <a href="/clan/<?=$row['id']?>/"><?=$row['name']?></a>, <img src="/images/icon/level.png" alt="lvl"> <b><?=$row['level']?></b><br>
<img src="/images/icon/exp.png" alt=""> <?=n_f($row['exp'])?> опыта</div>
<div class="dot-line"></div>

<?
}
}
?>

<div class="block_zero"><?=pages('?')?></div>

<?
} 
?>

<div class="dot-line"></div>
<div class="menuList"><li><a href="?action=search"><img src="/images/icon/clan.png" alt="">Поиск клана</a></li></div>
<div class="mini-line"></div>
<div class="menuList"><li><a href="/clans/create/"><img src="/images/icon/clan.png" alt="">Создать клан</a></li></div>
<div class="mini-line"></div>
<ul class="hint">
<li>Рейтинг обновляется один раз в 10 минут</li>
<li>Чтобы вступить в уже существующий клан, попросите лидера клана пригласить вас</li>
</ul>
</div>
<?
include './system/f.php';
break;

case 'create':
$title = 'Создать клан';    
include './system/h.php';  
$cost = 2000;
?>



<?

  if($clan) {

?>

<div class='main'><font color='#999'>Для создания клана необходимо выйти из уже существующего</font></div>

<?

  }
  else
  {
  
$name = check($_POST['name']);

  if($name && $user['g'] >= $cost) {
    $clans = mysql_query('SELECT * FROM `clans` WHERE `name` = "'.$name.'"');
    $clans = mysql_fetch_array($clans);
  
  if(!$clans) {
    mysql_query('UPDATE `users` SET `g` = "'.($user['g'] - $cost).'" WHERE `id` = "'.$user['id'].'"');

  mysql_query('INSERT INTO `clans` (`name`,`r`) VALUES ("'.$name.'", "'.$user['r'].'")');
  $clan_id = mysql_insert_id();
mysql_query('INSERT INTO `clan_rud` (`clan`,`lvl`,`g_max`,`time`) VALUES ("'.$clan_id.'","1","60","'.(time() +(20*3600)).'")');
mysql_query('INSERT INTO `clan_rud_user` SET `clan` = "'.$clan_id.'",`user` = "'.$user['id'].'"');
  mysql_query('INSERT INTO `clan_memb` (`clan`,`user`,`rank`, `time`,`last_update`) VALUES ("'.$clan_id.'", "'.$user['id'].'", "4", "'.time().'","'.(time() + ((60 * 60) * 24)).'")');
  
  header('location: /clan/');
  
  }
  
  }

?>

<div class='main' align='center'>
  <form action='' method='post'>
  Название клана:<br/>
  <input required pattern = "[A-Z,a-z,А-Я,а-я,0-9/s]{4,20}" type = "text" name='name'/><br/>
  <span class='btn'><span class='end'>
    <input class='label' type='submit' value='Создать клан'>
  </span></span></form><center>
    <span class='grey'>Цена: <img src='/images/icon/gold.png' alt=''/>
2000 золота</span></div></center>
<div class='mini-line'></div>
<div class ='main'><ul class='hint'><li>В названии можно использовать от 5 до 20 рус. или латин. символов.</li></ul></div>
  </form>
</div>

<?
  
  }

include './system/f.php';

  break;

  case 'search':
$title = 'Поиск клана';    
include './system/h.php';  

$log = _string($_POST['log']);
  if($log) {
    $clun = mysql_query('SELECT * FROM `clans` WHERE `name` = "'.$log.'"');
    $clun = mysql_fetch_array($clun);
  
  if($clun) {

    header('location: /clan/'.$clun['id'].'/');

  }
  else
  {
  echo'Нет такого клана';
  }

  }

?>

<div class='main'>
<div class='block_zero'>
  <form action='/clans/search/' method='post'>
    Название клана:<br/><input name='log' class='text'/><br/>
     <span class='btn'><span class='end'><input class='label' type='submit' value='Поиск'>Поиск</span></span>
</form>
</div><div class='mini-line'></div>
<div class='menuList'><li><a href='/clans/'><img src='/images/icon/clan.png' alt=''/>Список кланов</a></li></div>
</div>
<?
include './system/f.php';

  break;

}

?>