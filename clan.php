<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
auth();

$id = _string(_num($_GET['id']));

if(!$id AND $clan > 0) {
    $id = $clan['id'];
}

  $i = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);

  if(!$i) {
  
      header('location: /clans/');
  
  exit;
  
  }

switch($_GET['action']) {
  default:

    $title = 'Клан "'.$i['name'].'"';    

include './system/h.php';

?>

<div class='main'>
<?

if($clan && $clan['id'] == $i['id'] && $clan_memb['rank'] == 4 && $_GET['adm'] == true) {
  $text = _string($_POST['text']);
  if($text) {
    mysql_query('INSERT INTO `clan_msg` (`clan`,
                                             `user`,
                                             `text`,
                                             `time`) VALUES ("'.$clan['id'].'",
                                                             "'.$user['id'].'",
                                                                   "'.$text.'",
                                                                   "'.time().'")');
    header('location: /clan/');  
  }

?>

<div class='block_zero'>
<form action='/clan/?adm=true' method='post'>
  Новое обьявление:<br/> <input name='text' class='text'/> <br>
<span class='btn'><span class='end'><input class='label' type='submit' value='Отправить'></span></span>
</form>
</div>
 <div class='mini-line'></div>

<?

  }

?>

<div class='block_zero'>

<?

  $_exp = round(100 / (clan_exp($i['level']) / $i['exp']));

  if($_exp > 100) {
  
     $_exp = 100;
  
  }

?>

<table cellpadding='0' cellspacing='0'><tr>
<td>

<?

  if($clan && $clan['id'] == $i['id'] && $clan_memb['rank'] == 4) {

?>

<a href='/clan/gerb/'>

<?

  }

?>

<img src='/images/icon/clan/gerb/<?=$i['gerb']?>.png' alt='*'/>

<?

  if($clan && $clan['id'] == $i['id'] && $clan_memb['rank'] == 4) {

?>

</a>

<?

  }

?>

</td><td valign='top' style='padding-left: 5px;'><img src='/images/icon/clan/<?=$i['r']?>.png' alt=''*/> <b><?=$i['name']?></b><br/>

<img src='/images/icon/level.png'/> Уровень: <b><?=$i['level']?></b><br/>
<img src='/images/icon/exp.png' alt='*'/> Опыт: <?=n_f($i['exp'])?> / <?=n_f(clan_exp($i['level']))?> <font color='#999'>(<?=$_exp?>%)</font></td>
</tr></table>

</div>
<div class='mini-line'></div>

<?

if($clan['id'] == $i['id']) {

?>
<div class="mini-line"></div>
<div class="menuList">
<li class="original">
<a class="white" href="/clan/built/"><img src="/images/icon/clan/building.png" alt="" style="float:left;margin-top:3px;" height="30px" width="30px">
<img src="/images/icon/clan.png" alt="">Статуя клана<br>
<span class="medium"><?=($clan['built_1'] > 0 ? '<span class="dgreen bold">+'.$clan_buff.'</span> к параметрам':'<span class="dgreen bold">+0</span> к параметрам')?></span></a>
</li>
</div>
<div class="mini-line"></div>
<div class="menuList">
<li class="original">
<a class="white" href="/epicwar.php"><img src='/images/8.png' alt='' height='30px' width='30px' style='float:left;margin-top:3px;'/>
<img src='http://tiwar.ru/images/icon/hellworld.png' alt=''/>Клановые подземелья<br>
<span class="medium">Битва с тварями из преисподней</span></a></li>
</div>
<div class="mini-line"></div>
<div class="menuList">
<li class="original">
<a class="white" href="/bko.php"><img src='/images/8.png' alt='' height='30px' width='30px' style='float:left;margin-top:3px;'/>
<img src='http://tiwar.ru/images/icon/hellworld.png' alt=''/>БКО<br>
<span class="medium">Улучшение Бонуса Кланового Опыта</span></a></li>
</div>
<div class="mini-line"></div>
<div class="menuList">
<li class="original">
<a class="white" href="/clan/money/"><img src="/images/icon/clan/chest.png" alt="" style="float:left;margin-top:3px;" height="30px" width="30px">
<img src="/images/icon/gold.png" alt="">Казна клана<br>
<span class="medium"><img src="/images/icon/silver.png" alt="silver"><?=n_f($clan['s'])?> <img src="/images/icon/gold.png" alt="gold"><?=n_f($clan['g'])?></span></a></li>
<a href="/rud/" class="menu_link"><img src="http://volna.mobi/xaos/16x16/helmet_mine.png" alt=""/> Золотой Рудник <span style="color:#a5a5a5"> (<?=$clan_rud['g']?> / <?=$clan_rud['g_max']?>)</span></a>
</div>
<?


}
?>

<div class="mini-line"></div>
<div class="menuList">
<li><a href="/cforum/sub/<?=$i['id']?>/"><img src="/images/icon/section.png" alt="">Форум клана</a></li>
<?
if($clan['id'] == $i['id']) {
$_chat = mysql_query('SELECT COUNT(*) FROM `chat` WHERE `clan` = "'.$clan['id'].'" AND `to` = "'.$user['id'].'" AND `read` = "0"');
$_chat = mysql_result($_chat,0);
?>
<li><a href='/clan/application/'><img src='/images/icon/arrow.png' alt='*'/> Заявки на вступление <?=mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_z` WHERE `clan` = "'.$clan['id'].'"'),0) > 0 ? '<small><font color=\'#30c030\'>(+)</font></small>':''?></a></li>
<li><a href='/clan/journal'><img src='/images/journal.png' alt='*'/> Журнал клана</a></li>
<li><a href="/chat/clan/"><img src="/images/icon/chat.png" alt="">Чат клана  <?=($_chat > 0 ? '<font color=\'#3c3\'>(+)</font>':'')?></a></li></div>

<?

$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `chat` WHERE `clan` = "'.($clan['id']).'"'),0);
if($count > 0) {
$msg = _string(_num($_GET['msg']));
if($msg) {
$i_msg = mysql_query('SELECT * FROM `chat` WHERE `id` = "'.$msg.'"');
$i_msg = mysql_fetch_array($i_msg);
if(!$i_msg) {
header('location: /chat/'.('clan/').'?page='.$page);
exit;
}
if($_GET['clan'] == true && $clan_memb['rank'] == 4 OR $user['access'] > 0) {
mysql_query('DELETE FROM `chat` WHERE `clan` = "'.($clan['id']).'" AND`id` = "'.$i_msg['id'].'"');
}
header('location: /chat/'.('clan/').'?page='.$page);
}
$q = mysql_query('SELECT * FROM `chat` WHERE `clan` = "'.($clan['id']).'" ORDER BY `id` DESC LIMIT 3');
  while($row = mysql_fetch_array($q)) {

  if($row['to'] == $user['id'] && $row['read'] == 0) {
  
    mysql_query('UPDATE `chat` SET `read` = "1" WHERE `id` = "'.$row['id'].'"');
  
  }

  $sender = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $sender = mysql_fetch_array($sender);

echo "<br>";
echo "".($sender['id'] != 0 ? "<img src='/images/icon/race/".$sender['r'].($sender['online'] > (time() - 1200) ? '':'-off').".png' alt='*'/>":'<img src=\'/images/icon/race/bot.png\' alt="*"/>')." ";


echo "".($sender['id'] != 0 ? "<a href='/user/".$sender['id']."/'>".$sender['login']." </a>":'Система')."";



  if($sender['id'] != $user['id']) {
echo "".($sender['id'] != 0 ? "<a href='/chat/".($_GET['clan'] == true ? '':'clan/')."?to=".$sender['id']."'> (&#187;)</a>":'')."";
  }

    if($row['to']) {

      $__to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['to'].'"');
      $__to = mysql_fetch_array($__to);

if($__to['id'] == $user['id']) {

?>

<font color='#90c090'>

<?

    }

?>

<?=$__to['login']?>,

<?

if($__to['id'] == $user['id']) {

?>

</font>

<?

    }
    
    }

    if($sender['access'] == 1) {

?>

<font color='#f09060'>

<?

    }

?>

<?

    if($sender['access'] == 2) {

?>

<font color='#90c0c0'>

<?

    }

?>


<?=smiles($row['text'])?>

<?

    if($sender['access'] > 0) {

?>

</font>

<?

    }

  if($user['access'] > 0) {


?>

<a href='/chat/<?=('clan/')?>?msg=<?=$row['id']?>'>[x]</a>

<?

  }
  
  }

  }
  else
  {
  
?>

<font color='#909090'>Сообщений нет</font>

<?
  
  }

?>
<div class="menuList">

<?

}

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_memb` WHERE `clan` = "'.$i['id'].'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

if(!$clan){
$za = mysql_fetch_array(mysql_query('SELECT * FROM `clan_z` WHERE `clan` = '.$i['id'].''));
if(!$za){
if($_GET['zay'] == '1'){
mysql_query('INSERT INTO `clan_z` (`user`,`clan`)VALUES('.$user['id'].','.$i['id'].')');
}
?><div class='menuList'>
<li><a href='?zay=1'><img class="icon" src="http://144.76.127.94/view/image/icons/clan_add.png" /> Подать Заявка на вступление</a></li></div>
<div class="mini-line">
<?
}else{
?>
<div class='block'>Вы уже подали заявку в клан!</div>
<div class="mini-line">
<?
}
}
?>
<div class='block_zero center'>В клане <span class='bold'><?=$count?></span> титанов <br/>
<? if($clan['id'] == $i['id']) {
?>
<a class='grey' href='/online/?action=clan'>поиск игроков в клан</a></div>

<?
}
?>
</div><div class='dot-line'></div>
<?

if($count > 0) {

$q = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$i['id'].'" ORDER BY `rank` DESC,`exp` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {

  $memb = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $memb = mysql_fetch_array($memb);

  switch($row['rank']) {
  
    case 0:
    $rank = 'Новобранец';
     break;
    case 1:
    $rank = 'Боец';
     break;
    case 2:
    $rank = 'Офицер';
     break;
    case 3:
    $rank = 'Генерал';
     break;
    case 4:
    $rank = '<font color=\'#3c3\'>Лидер клана</font>';
     break;
    
  }


  
if($clan && $clan['id'] == $i['id'] && $row['user'] != $user['id'] && $clan_memb['rank'] == 4 && $_GET['adm'] == true) {

?>

<span style='float: right;'><a href='/clan/memb/<?=$row['id']?>/'><img src='/images/icon/settings.png' alt='*'/></a></span>

<?

}

?> 
<div class='menuList'><li><a style='padding-bottom:2px;padding-top:2px;' href='/user/<?=$row['user']?>/'><img src='/images/icon/race/<?=$memb['r'],($memb['online'] > time() - 300 ? '':'-off')?>.png' alt=''/><?=$memb['login']?>, <span class='white'><?=$rank?></span><br/><span class='grey'> <?=n_f($row['exp'])?> опыта/<?=n_f($row['arena'])?> Арена</span></a></li>
<?

  }

?><div class='block_zero'>
<?=pages('/clan/'.$i['id'].'/'.($_GET['adm'] == true ? '?adm=true&':'?'))?></div>
<div class='mini-line'></div>
<div class="block_zero"><img src="/images/icon/clan.png" alt=""> О клане: <?=$i['infa']?></div>
<div class='mini-line'></div>
<?
  
  }
  else
  {
 
?>


<?

  }

?>

</div>

<?

if($clan && $clan['id'] == $i['id']) {

  if(isSet($_GET['exit']) && $clan_memb['rank'] != 4) {
  
  mysql_query('DELETE FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');
    $time = time();
    mysql_query("INSERT INTO `clan_journal`(`cl_id`,`text`,`time`)VALUES('$clan[id]','<a href=/user/$user[id]>$user[login]</a> покинул клан','$time')"); 

    header('location: /clans/');

  exit;

  }

?>

<div class='menuList'>

<?

if($clan['id'] == $i['id'] && $clan_memb['rank'] == 4) {

?>
<li><a href='/clan/info/'><img src='/images/icon/arrow.png'> О клане</a></li>
  <li><a href='/clan/<?=($_GET['adm'] == true ? '':'?adm=true')?>' <?=($_GET['adm'] == true ? 'style="color:#999;"':'')?>><img src='/images/icon/arrow.png' alt='*'/> <?=($_GET['adm'] == true ? 'Скрыть управление':'Управление кланом')?></a></li>

<li><a href='/clan/deleteclan'><img src='/images/icon/arrow.png'> Распустить клан</a></li>
<?

  }

?>

  <li><a href='/clan/?exit'><img src='/images/icon/arrow.png' alt='*'/> Покинуть клан</a></li>

</div></div>

<?

}

?>

<?

if($clan['id'] == $i['id'] && $clan_memb['rank'] == 4) {

?>

 <div class='mini-line'></div>
<div class='block_zero'>

<?

  if($_POST['change_rank_for_invite']) {
  
    $rank = _string(_num($_POST['rank']));
    
    mysql_query('UPDATE `clans` SET `rank_for_invite` = "'.$rank.'" WHERE `id` = "'.$clan['id'].'"');
  
  
    header('location: /clan/');
  
  }

?>

  Приглашать в клан может:<br/>
   <form action='/clan/' method='post'>
   <select name='rank'>
   <option value='0'>Новобранец</option>
   <option value='1'>Боец</option>
   <option value='2'>Офицер</option>
   <option value='3'>Генерал</option>
   <option value='4'>Лидер клана</option>
   </select><br/>
   <span class='btn'><span class='end'>  <input class='label'type='submit' value='Сохранить' name='change_rank_for_invite'/>Сохранить</span></span>
   </form>
</div>
 <div class='mini-line'></div>
<div class='block_zero'>

<?

  if($_POST['change_rank_for_delete']) {
  
    $rank = _string(_num($_POST['rank']));
    
    mysql_query('UPDATE `clans` SET `rank_for_delete` = "'.$rank.'" WHERE `id` = "'.$clan['id'].'"');
  
  
    header('location: /clan/');
  
  }

?>

   Удалять из клана может:<br/>
   <form action='/clan/' method='post'>
   <select name='rank'>
   <option value='0'>Новобранец</option>
   <option value='1'>Боец</option>
   <option value='2'>Офицер</option>
   <option value='3'>Генерал</option>
   <option value='4'>Лидер клана</option>
   </select><br/>
   
   <span class='btn'><span class='end'>  <input class='label'type='submit' value='Сохранить' name='change_rank_for_delete'/></span></span>
   </form>
</div>
 <div class='mini-line'></div>
<div class='block_zero'>

<?

  if($_POST['change_name']) {
  
    if($clan['g'] < 500) {
    
      header('location: /clan/');
     
    exit;
    
    }
    
    $name = _string($_POST['name']);
    
    if($name) {
    
    mysql_query('UPDATE `clans` SET `g` = `g` - 500,
                                 `name` = "'.$name.'" WHERE `id` = "'.$clan['id'].'"');
  $time = time();
    mysql_query("INSERT INTO `clan_journal`(`cl_id`,`text`,`time`)VALUES('$clan[id]','Лидер сменил название клана','$time')"); 

    }
  
    header('location: /clan/');
  
  }

?>

 <form action='/clan/?change_name=true' method='post'> 
  Новое название:<br/> 
  <input type='text' class='text' name='name'/> <br/>
<span class='btn'><span class='end'>  <input class='label'type='submit' value='Сохранить' name='change_name'/></span></span>
   </form>
</div>
</div>
<?

}
  
include './system/f.php';
  break;



  case 'money':
    $title = 'Казна клана';    

include './system/h.php';  

if(!$clan['id'] OR $clan['id'] != $i['id']) {

  header('location: /clan/');

exit;

}

$g = _string(_num($_POST['g']));

$s = _string(_num($_POST['s']));

  if($g OR $s) {
   
     if($user['level'] > 20) {
   if($g && $user['g'] >= $g && $_POST['g'] < 100000) {
      mysql_query('UPDATE `clans` SET `g` = `g` + '.$g.' WHERE `id` = "'.$clan['id'].'"');
      mysql_query('UPDATE `users` SET `g` = `g` - '.$g.' WHERE `id` = "'.$user['id'].'"');
    mysql_query("INSERT INTO `clan_journal`(`cl_id`,`text`,`time`)VALUES('$clan[id]','<a href=/user/$user[id]>$user[login]</a> вложил в казну клана $g <img src=/images/icon/gold.png> золото','$time')");     

    
}
}
    
    
       if($user['level'] > 20) {
   if($s && $user['s'] >= $s && $_POST['s'] < 100000) {
      mysql_query('UPDATE `clans` SET `s` = `s` + '.$s.' WHERE `id` = "'.$clan['id'].'"');
      mysql_query('UPDATE `users` SET `s` = `s` - '.$s.' WHERE `id` = "'.$user['id'].'"');
    mysql_query("INSERT INTO `clan_journal`(`cl_id`,`text`,`time`)VALUES('$clan[id]','<a href=/user/$user[id]>$user[login]</a> вложил в казну клана $s <img src=/images/icon/silver.png> серебра','$time')"); 
}
}
   
  
  header('location: /clan/money/');
  
  }

?>
<div class='main'>
<div class='block_zero'>
   Казна клана: <img src='/images/icon/silver.png' alt='*'/> <?=n_f($i['s'])?> <img src='/images/icon/gold.png' alt='*'/> <?=n_f($i['g'])?><br/>
У вас на счету: <img src='/images/icon/silver.png' alt='*'/> <?=n_f($user['s'])?> <img src='/images/icon/gold.png' alt='*'/> <?=n_f($user['g'])?>
</div><div class='mini-line'></div><div class='menuList'><li><a href='/clan/gold/'><img src='/images/icon/arrow.png' alt=''/>Рейтинг по золоту</a></li><li><a href='/clan/silver/'><img src='/images/icon/arrow.png' alt=''/>Рейтинг по серебру</a></li></div><div class='mini-line'></div>
<div class='block_zero'>

<form action='/clan/money/' method='post'>
  <img src='/images/icon/gold.png' alt='*'/>  <input type='text' class='text' maxlength="5" name='g' value='0'/><br/>
  <img src='/images/icon/silver.png' alt='*'/> <input type='text' class='text' maxlength="5" name='s' value='0'/><br/>
  <span class='btn'><span class='end'><input class='label' type='submit' value='Пополнить'/>Пополнить</span></span>
</form></br>
• Пополнение казны только с 21 уровня!!!
</div>
</div>

<?
include './system/f.php';
  break;

  case 'memb':

if(!$clan['id'] OR $clan['id'] == $i['id'] && $clan_memb['rank'] < 4) {

  header('location: /clan/');

exit;

}

$memb = _string(_num($_GET['memb']));

  $memb = mysql_query('SELECT * FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$memb.'"');
  $memb = mysql_fetch_array($memb);

  if(!$memb) {

  header('location: /clan/');

exit;
  
  }
  
  $memb_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$memb['user'].'"');
  $memb_user = mysql_fetch_array($memb_user);
  
    $title = $memb_user['login'];    

include './system/h.php';  

    if($memb['rank'] != 3 && $memb['rank'] < $clan_memb['rank']) {
  
  if($_GET['up'] == true) {
  
      mysql_query('UPDATE `clan_memb` SET `rank` = "'.($memb['rank'] + 1).'" WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$memb['id'].'"');
$time = time();
    mysql_query("INSERT INTO `clan_journal`(`cl_id`,`text`,`time`)VALUES('$clan[id]','<a href=/user/$user[id]>$user[login]</a> повысил <a href=/user/$memb_user[id]>$memb_user[login]</a>','$time')"); 

      header('location: /clan/memb/'.$memb['id'].'/');
  
  }
     
  }

  if($memb['rank'] < $clan_memb['rank'] && $memb['rank'] > 0) {

    if($_GET['down'] == true) {

      mysql_query('UPDATE `clan_memb` SET `rank` = "'.($memb['rank'] - 1).'" WHERE `clan` = "'.$clan['id'].'" AND `id` = "'.$memb['id'].'"');
$time = time();
mysql_query("INSERT INTO `clan_journal`(`cl_id`,`text`,`time`)VALUES('$clan[id]','<a href=/user/$user[id]>$user[login]</a> понизил <a href=/user/$memb_user[id]>$memb_user[login]</a>','$time')"); 

        header('location: /clan/memb/'.$memb['id'].'/');

    }

  }

?>

<div class='main'>

<div class='block_zero'>

<?

  switch($memb['rank']) {
  
    case 0:
    $rank = 'Новобранец';
     break;
    case 1:
    $rank = 'Боец';
     break;
    case 2:
    $rank = 'Офицер';
     break;
    case 3:
    $rank = 'Генерал';
     break;
    case 4:
    $rank = '<font color=\'#3c3\'>Лидер клана</font>';
     break;
    
  }

?>

Звание: <?=$rank?><br/>
  <img src='/images/icon/exp.png' alt='*'/> Опыт: <?=n_f($memb['exp'])?><br/>
  <img src='/images/icon/gold.png' alt='*'/> <?=n_f($memb['g'])?><br/>
<img src='/images/icon/silver.png' alt='*'/> <?=n_f($memb['s'])?><br/>
Дата вступления: <?=date('d.m.y', $memb['time'])?>

</div>
<div class='mini-line'></div>
<div class='block_zero' align='center'>
<?

     if($memb['rank'] != 3 && $memb['rank'] < $clan_memb['rank']) {

?>

  <a href='/clan/memb/<?=$memb['id']?>/?up=true' class='btn'><span class='end'><span class='label'>Повысить</a></span></span>

<?

  }

  if($memb['rank'] < $clan_memb['rank'] && $memb['rank'] > 0) {

?>

 <a href='/clan/memb/<?=$memb['id']?>/?down=true' class='btn'><span class='end'><span class='label'>Понизить</a></span></span>

<?
  
  }


?>

</div>
</div>

<?

  if($clan_memb['rank'] == 4) {
  
    if($_GET['lider'] == true) {
    
      mysql_query('UPDATE `clan_memb` SET `rank` = "4" WHERE `id` = "'.$memb['id'].'"');
      mysql_query('UPDATE `clan_memb` SET `rank` = "3" WHERE `user` = "'.$user['id'].'"');
    
    header('location: /clan/');
    
    }
  
?>

<div class='mini-line'></div>
   <div class='block_zero' align='center'>

 <center> <a href='/clan/memb/<?=$memb['id']?>/?lider=true' class='btn'><span class='end'><span class='label'>Передать лидерство</a></span></span>

</div>

<?
  
  }

  if($memb['rank'] < $clan_memb['rank'] && $clan_memb['rank'] >= $clan['rank_for_delete']) {
  
  if($_GET['delete'] == true) {
  
    mysql_query('DELETE FROM `clan_memb` WHERE `id` = "'.$memb['id'].'"');
    $time = time();
mysql_query("INSERT INTO `clan_journal`(`cl_id`,`text`,`time`)VALUES('$clan[id]','<a href=/user/$user[id]>$user[login]</a> исключил <a href=/user/$memb_user[id]>$memb_user[login]</a>','$time')"); 

$read = '1';  
$to = $memb_user['id'];
$from = '2';
$text = 'Вы покинули или были исключены из клана <a href="/clan/'.$clan["id"].'"><img src="/images/icon/race/'.$clan["r"].'.png">'.$clan["name"].'</a>"';
mysql_query("INSERT INTO `mail` SET `from` = '$from',`time` = '$time',`to`='$to',`text` = '$text'");
 mysql_query("INSERT INTO `contacts` (`user`,`ho`, `time`) VALUES ('$memb_user[id]','2','$time')");  
  header('location: /clan/');
  
  }
  
?>

<div class='mini-line'></div>
   <div class='block_zero' align='center'>

  <a href='/clan/memb/<?=$memb['id']?>/?delete=true' class='btn'><span class='end'><span class='label'>Исключить</a></span></span>

</div>
</div>
<?

  }

include './system/f.php';
  break;

  case 'built':
    $title = 'Статуя клана';    

include './system/h.php';  

if(!$clan['id'] OR $clan['id'] != $i['id']) {

  header('location: /clan/');

exit;

}

  $progress = round(100 / (34 / $i['built_1']));

  function cost($i) {
    
    switch($i) {
      case 0:
      $cost = 60000; 
       break;
      case 1:
      $cost = 60000; 
       break;
      case 2:
      $cost = 120000; 
       break;
      case 3:
      $cost = 180000; 
       break;
      case 4:
      $cost = 1800; 
       break;
      case 5:
      $cost = 120000; 
       break;
      case 6:
      $cost = 240000; 
       break;
      case 7:
      $cost = 360000; 
       break;
      case 8:
      $cost = 3600; 
       break;
      case 9:
      $cost = 180000; 
       break;
      case 10:
      $cost = 360000; 
       break;
      case 11:
      $cost = 540000; 
       break;
      case 12:
      $cost = 7200; 
       break;
      case 13:
      $cost = 240000; 
       break;
      case 14:
      $cost = 480000; 
       break;
      case 15:
      $cost = 720000; 
       break;
      case 16:
      $cost = 14400; 
       break;
      case 17:
      $cost = 300000; 
       break;
      case 18:
      $cost = 600000; 
       break;
      case 19:
      $cost = 900000; 
       break;
      case 20:
      $cost = 28800; 
       break;
      case 21:
      $cost = 360000; 
       break;
      case 22:
      $cost = 720000; 
       break;
      case 23:
      $cost = 1080000; 
       break;
      case 24:
      $cost = 57600; 
       break;
      case 25:
      $cost = 420000; 
       break;
      case 26:
      $cost = 840000; 
       break;
      case 27:
      $cost = 1260000; 
       break;
      case 28:
      $cost = 115200; 
       break;
      case 29:
      $cost = 480000; 
       break;
      case 30:
      $cost = 960000; 
       break;
      case 31:
      $cost = 230400; 
       break;
      case 32:
      $cost = 540000; 
       break;
      case 33:
      $cost = 1080000; 
       break;
      case 34:
      $cost = 1620000;
       break;
      case 35:
      $cost = 1620000;
       break;
    }
  
  return $cost;
  
  }
  
  function value($i) {
  
    switch($i) {
      case 0:
      $value = 0; 
       break;
      case 1:
      $value = 0; 
       break;
      case 2:
      $value = 0; 
       break;
      case 3:
      $value = 0; 
       break;
      case 4:
      $value = 1; 
       break;
      case 5:
      $value = 0; 
       break;
      case 6:
      $value = 0; 
       break;
      case 7:
      $value = 0; 
       break;
      case 8:
      $value = 1; 
       break;
      case 9:
      $value = 0; 
       break;
      case 10:
      $value = 0; 
       break;
      case 11:
      $value = 0; 
       break;
      case 12:
      $value = 1; 
       break;
      case 13:
      $value = 0; 
       break;
      case 14:
      $value = 0; 
       break;
      case 15:
      $value = 0; 
       break;
      case 16:
      $value = 1; 
       break;
      case 17:
      $value = 0; 
       break;
      case 18:
      $value = 0; 
       break;
      case 19:
      $value = 0; 
       break;
      case 20:
      $value = 1; 
       break;
      case 21:
      $value = 0; 
       break;
      case 22:
      $value = 0; 
       break;
      case 23:
      $value = 0; 
       break;
      case 24:
      $value = 1; 
       break;
      case 25:
      $value = 0; 
       break;
      case 26:
      $value = 0; 
       break;
      case 27:
      $value = 0; 
       break;
      case 28:
      $value = 1; 
       break;
      case 29:
      $value = 0; 
       break;
      case 30:
      $value = 0; 
       break;
      case 31:
      $value = 1; 
       break;
      case 32:
      $value = 0; 
       break;
      case 33:
      $value = 0; 
       break;
      case 34:
      $value = 0; 
       break;

    }
    
  return $value;
      
  }

?>
<div class='main'>
<div class='block_zero'>
<img src='/images/icon/clan.png' alt='*'/> <b>Статуя клана:</b> <img src='/images/icon/level.png' alt='*'/> <?=$i['built_1']?> уровень<br/>
<?
  
  if($i['built_1'] > 0) {

?>

Бонус: <font color='#90c090'>+<?=clan_buff($i['built_1'])?></font> к сумме параметров<br/>

<?
  
  }

?>

<font color='#90b0c0'>Прогресс:</font> <?=$progress?>%
</div>
 <div class='mini-line'></div>
<div class='block_zero'>

<?
$lvlbuilt = $i['built_1'] + 1;
  if($i['id'] == $clan['id'] && $clan_memb['rank'] == 4 && $i['built_1'] < 34) {

  if($_GET['up'] == true) {
  
    if($i[(value($i['built_1']) == 1 ? 'g':'s')] >= cost($i['built_1'])) {
    
      mysql_query('UPDATE `clans` SET `built_1` = `built_1` + 1,
     `'.(value($i['built_1']) == 1 ? 'g':'s').'` = `'.(value($i['built_1']) == 1 ? 'g':'s').'` - '.cost($i['built_1']).' WHERE `id` = "'.$i['id'].'"');
    
mysql_query("INSERT INTO `chat` (`clan`, 
`user`,
`text`, 
`time`) VALUES ('$clan[id]', 
'0',
'<span class=dgreen>Статуя клана была улучшена до $lvlbuilt уровня</span>',
'$time')");


    header('location: /clan/built/');
    
    }
  
  }

?>

 <div class='center'><a href='/clan/built/?up=true' class='btn'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($i['built_1']) == 1 ? 'gold':'silver')?>.png' alt= '*' /> <?=cost($i['built_1'])?></a></center>

<? 

  } 

?> 
<div class='content'> 
<img src='/images/icon/clan.png' alt='*'/> <b>Клановый бонус:</b><br /> 
 Бонус: <font color='#90c090'>+<?=clan_buff($i['built_1'])?></font> к сумме параметров<br/> 
<font color='#90b0c0'>Информация:</font> после активации лидером <font color='#90c090'>"Клановый бонус"</font>, все игроки получат +<?=clan_buff($i['built_1'])?> к сумме параметров</font>  
  </div> 
   <div class='mini-line'></div> 
   <div class='main'> 
<? 
if($i['built_2_time'] > time()) { 
?> 
<center> Осталось:  <?=_time($i['built_2_time'] - time())?></center> 
<? 
}else{ 
?>    
<div class='center'><a href='/clan/built/?done=true' class='btn'><span class='end'><span class='label'>Активировать за <img src='/images/icon/gold.png' alt= '*' /> 72 </a></span></span></li> 
<? 
} 
?>        
  </div> 

</div><div class="mini-line"></div> 
<div class='main'><div class='menuList'> 
             <img src='/images/icon/clan.png' alt='*'/> <b>Казармы:</b>  
                 <img src='/images/icon/level.png' alt='*'/> <?=$i['barrack']?> уровень<br/> 
                      Максимальное коло-во состава: <font color='#90c090'><?=$i['barrack']?></font> чел.<br/> 
          <font color='#90b0c0'>Информация:</font> Казармы увеличивают максимальное коло-во игроков клана</font>  
      </div> 
<div class='mini-line'></div> 
<div class='content'> 
<? 
$_cost_built_barrack = $i['barrack'] * 45;
if($i['id'] == $clan['id'] && $clan_memb['rank'] == 4 && $i['barrack'] < 50) {
     
      if($_GET['barrack'] == true) {
                
             if($i['g'] >= $_cost_built_barrack)    {
         
             mysql_query('UPDATE `clans` SET `g` = "'.($i['g'] - $_cost_built_barrack).'", 
                                                          `barrack` = "'.($i['barrack'] + 1).'" WHERE `id` = "'.$i['id'].'"');
              
             exit(header('location: /clan/built/'));
     } 
   
  } 
     
     
?>    
    <div class='center'><a href='/clan/built/?barrack=true' class='btn'><span class="end"><span class="label">Улучшить за <img src='/images/icon/gold.png' alt= '*' /> <?=$_cost_built_barrack?> </a></span></span></div> 
<? 
} 

?>        
  </div> 
   
   

</div> 

<?

include './system/f.php';
  break;

case 'deleteclan':
    $title = 'Распустить клан';    

include './system/h.php';  

if(!$clan['id'] OR $clan['id'] != $i['id']) {

  header('location: /clan/');

exit;

}
if(isset($_GET['no'])){
header('location:/clan');
}

if(isset($_GET['yes'])){
  if($clan_memb['rank'] == 4) {
mysql_query("UPDATE `users` SET `g` = `g` + 1000 WHERE `id` = '$user[id]'");
mysql_query("DELETE FROM `clans` WHERE `id` = '$clan[id]'");
header('location:/clans');
mysql_query("DELETE FROM `clan_memb` WHERE `clan` = '$clan[id]'");
}
}
?>
<div class='main'><div class='center'><div class='block_zero'><img src='http://tiwar.ru/images/town/hd/clanstatue.jpg' width='100%' alt=''/></div></div>
<div class='mini-line'></div>
<small>Вы действительно хотите распустить клан?<br/>
 - Мы вернем вам <span class='dgreen'>50%</span> золота от стартовой суммы.</small>
<div class='mini-line'></div>
<center><a class='btn' href='?yes'><span class='end'><span class='label'>Да</span></span></a><a class='btn' href='?no'><span class='end'><span class='label'>Нет</span></span></a>

</div>

<?
include './system/f.php';
  break;

case 'gerb': 
    $title = 'Герб клана';     

if($clan['id'] == 0 || $clan_memb['rank'] < 4){ 
header("Location: /"); 
exit; 

} 
include './system/h.php';   

$error = NULL; 

if(isset($_POST['id'])) { 
$id = _num($_POST['id']); 
if($id > 1 || $id < 16) { 
$z = 0; 
$se = 0; 
mysql_query("UPDATE `clans` SET `gerb` = '".$id."' WHERE `id` = '".$clan['id']."'");
mysql_query("UPDATE `clans` SET `g` = `g` - '".$z."' WHERE `id` = '".$clan['id']."'");
mysql_query("UPDATE `clans` SET `s`= `s` - '".$se."' WHERE `id` = '".$clan['id']."'");
$time = time(); 
mysql_query("INSERT INTO `clan_journal`(`cl_id`,`text`,`time`)VALUES('$clan[id]','<a href=/user/$user[id]>$user[login]</a> сменил герб клана','$time')");  
header("Location: /clan/"); 
exit(); 
} 

} 

if($error) { 
echo '<div class="main" style="color: red">
'.$error.' 
</div>'; 
} 

echo '<div class="main"> 
<div class="mini-line"></div> 
<form class="main" method="post" action="">
Выбрать клановый герб:<br />'; 
for($i = 1; $i < 16; $i++) { 
echo '<div class="main">'; 
echo '<input type="radio" name="id" value="'.$i.'" /> 
<img src="/images/icon/clan/gerb/'.$i.'.png" /><br/>';  
echo '</div><div class="mini-line"></div>'; 
} 
echo ' 
<div class="main"/> 
<span class="btn"><span class="end"><input class="label" type="submit" value="Отправить"></span></span> 
</form> 
<div class="mini-line"></div> 
<div class="grey"><small> 
</div></div></small> 
</div>'; 

include './system/f.php';   
break; 

case 'info': 
$title = 'О клане';     
include './system/h.php';
  
if(isset($_GET['edit'])){
$infa = htmlspecialchars(trim(mysql_real_escape_string($_POST['infa'])));     
mysql_query("UPDATE `clans` SET `infa` = '".$infa."' WHERE `id` = '".$clan['id']."'");
header('location: /clan/');
}

$u = mysql_query("SELECT * FROM `clans` WHERE `id` = '".$clan['id']."'");
while($u1 = mysql_fetch_assoc($u)){
?>
<div class="main">
<div class="block_zero">
<form action="?edit" method="post">
О клане: <br>
<input class="text medium-text" name="infa" maxlength="150" value="<?=$u1['infa']?>" type="text"><br>
<span class="btn"><span class="end"><input class="label" name="edit" value="Сохранить" type="submit"></span></span>
</form>
</div> 
</div>
</div>
<?
}
include './system/f.php'; 
  break; 

}
?>