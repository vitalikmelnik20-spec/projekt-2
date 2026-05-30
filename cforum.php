<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

  $sub = _string(_num($_GET['sub']));
$topic = _string(_num($_GET['topic']));

  $subt = _string(_num($_GET['sub']));

if(!$sub && !$topic) {
    $title = 'Форум';    

include './system/h.php';  



$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `cforum_sub`'),0);

if($count > 0) {


  if($_GET['create'] == true && $user['access'] == 2) {

  $name = _string($_POST['name']);
$access = _string(_num($_POST['access']));
  if($name) {
  
    mysql_query('INSERT INTO `cforum_sub` (`name`,
                                        `access`) VALUES ("'.$name.'",
                                                        "'.$access.'")');

    header('location: /cforum/');

  }

?>

  <div class='maim'>
  
  <form action='/cforum/?create=true' method='post'>
  
  Название раздела:<br/>
  <input name='name'/><br/>
  Создавать топики могут:<br/>
  <select name='access'>
  <option value='0'>все</option>
  <option value='1'>модераторы</option>
  <option value='2'>администраторы</option>
  </select><br/>
<span class="btn"><span class="label">  <input class="end" type='submit' value='Создать'/></span></span>
  
  </form>

  </div>
  <div class='mini-line'></div>

<?

  }

$id = _string(_num($_GET['id']));

  if($id && $user['access'] == 2) {
  
  $i = mysql_query('SELECT * FROM `cforum_sub` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);
  
  if(!$i) {
  
    header('location: /cforum/');
    
  exit;
  
  }
  
  
$name = _string($_POST['name']);
  if($name) {
  
    mysql_query('UPDATE `cforum_sub` SET `name` = "'.$name.'" WHERE `id` = "'.$i['id'].'"');

    header('location: /cforum/?adm=true');

  }
  
?>

  <div class='main'>
  
  <form action='/cforum/?adm=true&id=<?=$i['id']?>' method='post'>
  
  Название раздела:<br/>
  <input name='name' value='<?=$i['name']?>'/> <span class="btn"><span class="label"><input class="end" type='submit' value='Сохранить'/></span></span>
  
  </form>

  </div>
  <div class='mini-line'></div>

<?

  if($_GET['delete'] == true) {
  
    $q = mysql_query('SELECT * FROM `cforum_topic` WHERE `sub` = "'.$i['id'].'"');
    while($row = mysql_fetch_array($q)) {
      mysql_query('DELETE FROM `cforum_comments` WHERE `topic` = "'.$row['id'].'"');
    }
    
   mysql_query('DELETE FROM `cforum_topic` WHERE `sub` = "'.$i['id'].'"');
    
      mysql_query('DELETE FROM `cforum_sub` WHERE `id` = "'.$i['id'].'"');
    
    header('location: /cforum/?adm=true');
    
    }

  }

?>

<div class='menuList'>

<?

$q = mysql_query('SELECT * FROM `cforum_sub`');

  while($row = mysql_fetch_array($q)) {

  $i++;

?>

  <li>

<?


  if($_GET['adm'] == true && $user['access'] == 2) {

?>

  <span style='float: right;'>( <a href='/cforum/?adm=true&id=<?=$row['id']?>&delete=true'>Удалить</a> | <a href='/cforum/?adm=true&id=<?=$row['id']?>'>Редактировать</a> )</span>

<?

  }

?>

  <a href='/cforum/sub/<?=$row['id']?>/'><img src='/images/icon/section.png' alt='*'/> <?=$row['name']?></a></li>

<?
  
  }

?>

  <li <?=($_GET['adm'] == true ? '':'class=\'no_b\'')?>>

<?

  if($user['access'] == 2) {

?>

  <a href=''><a href='/cforum/<?=($_GET['adm'] == true ? '':'?adm=true')?>' <?=($_GET['adm'] == true ? 'style=\'color: #909090;\'':'')?>><img src='/images/icon/arrow.png' alt='*'/> Управление форумом</a></a>

<?

  if($_GET['adm'] == true) {

?>

  <li class='no_b'><a href='/cforum/?create=true'><img src='/images/icon/arrow.png' alt='*'/> Создать раздел</a></li>

<?
  
  }
  
  }

?>
  
  </li>

</div>

<?

  }
  else
  {

?>

<div class='main'><font color='#909090'></font></div>

<?

  }
  
include './system/f.php';

  }
  elseif($sub) {
  
  $sub = mysql_query('SELECT * FROM `cforum_sub` WHERE `id` = "'.$sub.'"');
  $sub = mysql_fetch_array($sub);

  if(!$sub) {
  
      header('location: /cforum');
  
  exit;
  
  }

if($_GET['create'] == true && $cl['id'] == $ce['clan']) {

    $title = 'Новый топик';    

include './system/h.php';



  if($user['save'] == 1) {


     $name = _string($_POST['name']);
              $text = _string($_POST['text']);

  if($name && $text) {
    
  if($user['level'] > 14) {
  
      mysql_query('INSERT INTO `cforum_topic` (`sub`,
                                             `name`,
                                             `user`,
                                             `text`,
                                             `time`) VALUES ("'.$sub['id'].'",
                                                                  "'.$name.'",
                                                            "'.$user['id'].'",
                                                                  "'.$text.'",
                                                                 "'.time().'")');
  
    $topic_id = mysql_insert_id();
  
    header('location: /cforum/topic/'.$topic_id.'/');
  
  }
  else
  {

?>

<div class='main' align='center'><font color='#909090'>Топики можно создавать с <img src='/images/icon/level.png' alt='*'/> 15 уровня!</font></div>
<div class='mini-line'></div>

<?
  
  }
  
  }
  

?>


<div class='main'>
  <form action='/cforum/sub/<?=$sub['id']?>/?create=true' method='post'>
  Название топика:<br/>
<input type='text' name='name' class='text medium-text'/><br/>
  
  Оглавление:<br/>
 <textarea name='text' rows='3'  class='text large'></textarea><br/>
  <span class='btn'><span class='end'><input class='label' type='submit' value='Создать топик'>Создать топик</span></span></form>
</div>

<?

  
  }
  else
  {

?>

<div class='main'><font color='#999'>Для создания топика вам нужно сохранить своего персонажа</font></div>

<?
  
  }


include './system/f.php';  


}
else
{

    $title = $sub['name'];    

include './system/h.php';

  
 $cl = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$sub['id'].'"');
 $cl = mysql_fetch_array($cl);
 
 $ce = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"');
 $ce = mysql_fetch_array($ce);
 
 $cm = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"');
 $cm = mysql_fetch_array($cm);
 

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `cforum_topic` WHERE `sub` = "'.$sub['id'].'"'),0);
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

?>

<div class='menuList'>

<?

$q = mysql_query('SELECT * FROM `cforum_topic` WHERE `sub` = "'.$sub['id'].'" ORDER BY `stick` DESC, `id` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {
  
  $i++;


?>

<li><a href='/cforum/topic/<?=$row['id']?>/' <?=($row['stick'] == 1 ? 'style="font-weight: bold;"':'')?>><img src='/images/icon/forum_<?=($row['close'] == 1 ? 3:2)?>.png' alt='*'/> <?=$row['name']?></a></li>

<?

  }
  
?>

<li class='no_b'><?=pages('/cforum/sub/'.$sub['id'].'/?')?></li>
  
  </li>


</div>

<?
  
  }
  else
  {

?>

<div class='main'><font color='#999'>Форум пуст!</font></div>

<?

  }

?>

</div>
<?

  if($cl['id'] == $ce['clan']) {

?>
<div class='main'>
 <div class='mini-line'></div>
<div class='menuList'>

  <li class='no_b'><a href='/cforum/sub/<?=$sub['id']?>/?create=true'><img src='/images/icon/forum_2.png'> Создать новый топик</a></li>

</div>

<?
  }


include './system/f.php';

}

}

elseif($topic) {

  $topic = mysql_query('SELECT * FROM `cforum_topic` WHERE `id` = "'.$topic.'"');
  $topic = mysql_fetch_array($topic);

  if(!$topic) {
  
      header('location: /cforum');
  
  exit;
  
  }

    $title = $topic['name'];

include './system/h.php';  

  $topic_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$topic['user'].'"');
  $topic_user = mysql_fetch_array($topic_user);


if($_GET['adm'] == true && $user['access'] > 0) {

?>
</div
<div class='main'>
<img src='/images/icon/arrow.png' alt='*'/> 


<a href='/cforum/topic/<?=$topic['id']?>/?stick=true'> <?=($topic['stick'] == 0 ? 'Закрепить':'Открепить')?></a> | <a href='/cforum/topic/<?=$topic['id']?>/?close=true'> <?=($topic['close'] == 0 ? 'Закрыть':'Открыть')?></a> | <a href='/cforum/topic/<?=$topic['id']?>/?delete=true'>Удалить</a> | <a href='/cedit.php?id=<?=$topic['id']?>/'> Ред.</a></div>
 <div class='mini-line'></div>

<?

}

?>

<div class='main'>
  <img src='/images/icon/race/<?=$topic_user['r'].($topic_user['online'] > time() - 300 ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$topic_user['id']?>/'><?=$topic_user['login']?></a>, <?=_times(time() - $topic['time'])?><br/>

<?

  if($topic_user['access'] == 1) {
  
?>
<font color='f09060'>
<?
  
  }
  
  if($topic_user['access'] == 2) {
  
?>
<font color='90c0c0'>
<?
  
  }

?>

<?=bb(smiles($topic['text']))?>

<?

  if($topic_user['access'] > 0) {
  
?>
</font>
<?
  
  }

?>

</div>
<div class='mini-line'></div>

<?

      if($user['access'] > 0) {
  
   if($_GET['stick'] == true) {

    mysql_query('UPDATE `cforum_topic` SET `stick` = "'.($topic['stick'] == 0 ? 1:0).'" WHERE `id` = "'.$topic['id'].'"');
  
  header('location: /cforum/topic/'.$topic['id'].'/?adm=true');
  
  }
  
   if($_GET['close'] == true) {

    mysql_query('UPDATE `cforum_topic` SET `close` = "'.($topic['close'] == 0 ? 1:0).'" WHERE `id` = "'.$topic['id'].'"');
  
  header('location: /cforum/topic/'.$topic['id'].'/?adm=true');
  
  }

if($_GET['delete'] == true) {

    $q = mysql_query('SELECT * FROM `cforum_comments` WHERE `topic` = "'.$topic['id'].'"');
    while($row = mysql_fetch_array($q)) {
      mysql_query('DELETE FROM `cforum_comments` WHERE `id` = "'.$row['id'].'"');
    }

  header('location: /cforum/sub/'.$topic['sub'].'/?adm=true');
  
    mysql_query('DELETE FROM `cforum_topic` WHERE `id` = "'.$topic['id'].'"');

  }

?>

<div class='menuList'>
  <li class='no_b'><a href='/cforum/topic/<?=$topic['id']?>/<?=($_GET['adm'] == true ? '':'?adm=true')?>' <?=($_GET['adm'] == true ? 'style=\'color: #909090;\'':'')?>><img src='/images/icon/arrow.png' alt='*'/> Управление топиком</a></li>
</div>
<div class='mini-line'></div>

<?

  }

  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `cforum_comments` WHERE `topic` = "'.$topic['id'].'"'),0);

?>

<div class='main'>
Комментарии: <b><?=$count?></b>
</div>

<?

  if($count > 0) {

?>

<div class='mini-line'></div>
<div class='menu'>

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

$q = mysql_query('SELECT * FROM `cforum_comments` WHERE `topic` = "'.$topic['id'].'" ORDER BY `id` LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {

  $comment_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $comment_user = mysql_fetch_array($comment_user);

?>

<li><img src='/images/icon/race/<?=$comment_user['r'].($comment_user['online'] > time() - 300 ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$comment_user['id']?>/'><?=$comment_user['login']?></a><?

if($comment_user['id'] != $user['id']) {

?> <a href='/cforum/topic/<?=$topic['id']?>/?page=<?=$page?>&to=<?=$comment_user['id']?>'>(&#187;)</a><? } ?>, <?=_times(time() - $row['time'])?><br/>

<?

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

  if($comment_user['access'] == 1) {
  
?>
<font color='f09060'>
<?
  
  }
  
  if($comment_user['access'] == 2) {
  
?>
<font color='90c0c0'>
<?
  
  }

?>

<?=bb(smiles($row['text']))?>

<?

  if($comment_user['access'] > 0) {
  
?>
</font>
<?
  
  }
  
  if($user['access'] > 0) {

$comment = _string(_num($_GET['comment']));

             if($comment) {
  
    mysql_query('DELETE FROM `cforum_comments` WHERE `id` = "'.$comment.'"');

    header('location: /cforum/topic/'.$topic['id'].'/?page='.$page);

  }

?>

<a href='/cforum/topic/<?=$topic['id']?>/?page=<?=$page?>&comment=<?=$row['id']?>'>[x]</a>

<?
  
  }

?>

</li>

<?

  }

?>

<li class='no_b'><?=pages('/cforum/topic/'.$topic['id'].'/?')?></li>

</div>

<?

  }
?>

<div class='mini-line'></div>
<div class='main'>

<?

  if($topic['close'] == 0) {

  if($user['save'] == 1) {

  if($user['level'] > 5) {

$text = _string($_POST['text']);

  $to = _string(_num($_GET['to']));

  if($to) {

      $_to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$to.'"');
      $_to = mysql_fetch_array($_to);
  
  if(!$_to OR $_to['id'] == $user['id']) {

    header('location: /cforum/topic/'.$topic['id'].'/?page='.$page);
    
  exit;
  
  }
  
  }

  if($_to) {
  
    $text = str_replace($_to['login'].', ', '', $text);
  
  }

  if($text) {
  
    mysql_query('INSERT INTO `cforum_comments` (`topic`,`user`,`to`,`text`,`time`) VALUES ("'.$topic['id'].'", "'.$user['id'].'", "'.$_to['id'].'", "'.$text.'", "'.time().'")');
  
  header('location: /cforum/topic/'.$topic['id'].'/?page='.$pages);
  
  }

?>

<form action='/cforum/topic/<?=$topic['id']?>/?page=<?=$page?>&to=<?=$to?>' method='post'>
  Сообщение:<br/>
<textarea name='text' style='width: 100%;'><?=($to ? $_to['login'].', ':'')?></textarea><br/>
<span class='btn'><span class='end'><input class='label' type='submit' value='Отправить'>Отправить</span></span></form>
</div>
</div>
</div>
<?

  }
  else
  {

?>

<font color='#999'>Писать на форуме можно с <img src='/images/icon/level.png' alt='*'/> 5 уровня</font>

<?
  
  }
  
  }
  else
  {

?>

<font color='#999'>Для общения на форуме вам нужно сохранить своего персонажа</font>

<?
  
  }
  
  }
  else
  {

?>

<font color='#f33'>Топик закрыт</font>

<?
  
  }

?>
<div class="main">
<?
include './system/f.php';  
?>

</div>
</div>
<?
}

?>