<?
    
include './system/common.php';
    
include './system/functions.php';
         
include './system/user.php';
    
if(!$user) { header('location: /'); exit; }

$title = ($_GET['clan'] == true) ? 'Клановый чат':'Общий чат';

include './system/h.php';  

echo '<div class="main">';

if($user['save'] == 0) {

  echo '<div class=\'block_zero\'><font color=\'#909090\'>Для общения в чате вам нужно сохранить своего персонажа</font></div>';

}
else
{

  echo '<div class=\'block_zero\'>';


  if($user['level'] < 3) {

    echo '<font color=\'#909090\'>Писать в чат можно с <img src=\'/images/icon/level.png\' alt=\'\'/> 3 уровня</font>';

  }
  else
  {

$text = _string($_POST['text']);
  $to = _string(_num($_GET['to']));

  if($to) {

      $_to = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$to.'"');
      $_to = mysql_fetch_array($_to);
  
  if(!$_to OR $_to['id'] == $user['id']) {
  
    header('location: /clanchat/'.($_GET['clan'] == true ? 'clan/':''));
    
  exit;
  
  }
  
  }

  if($text) {
  
    $antiflood = mysql_fetch_array(mysql_query('SELECT * FROM `clanchat` WHERE `clan` = \''.($_GET['clan'] == true ? $clan['id']:0).'\' AND `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT 1'));
  
    if(time() - $antiflood['time'] < 2) $errors[] = 'Писать можно только 1 раз в 1 секунду';

    if($errors) {
    
      echo '<div class=\'block\' align=\'center\'>';
      
      foreach($errors as $error) {
        
        echo $error.'<br/>';
        
      }
    
      echo '</div>
      <div class=\'mini-line\'></div>';
    
    }
    else
    {

      if($_to) {
      
        $text = str_replace($_to['login'].', ', '', $text);
      
      }
      
        $text = eregi_replace( "[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "(~)", $text);
        
        $text = str_replace(array('ru',
                                 'net',
                                 'com',
                                  'рф',
                                  'tk',
                                  'su',
                                  'us',
                                'mobi',
                                  'ua',
                                 'www',
                                'http'), '*', $text);

      
        mysql_query('INSERT INTO `clanchat` (`clan`,
                                         `user`,
                                           `to`,
                                         `text`,
                                         `time`) VALUES ("'.($_GET['clan'] == true ? $clan['id']:0).'",
                                                         "'.$user['id'].'", 
                                                          "'.$_to['id'].'",
                                                               "'.$text.'",
                                                              "'.time().'")');
      
      header('location: /clanchat/'.($_GET['clan'] == true ? 'clan/':''));
  
    }
  
  }

?>

  <form action='/chat/<?=($_GET['clan'] == true ? 'clan/':'')?>?to=<?=$to?>' method='post'>
  
    <input name='text' style='width: 90%;' value="<?=($to ? $_to['login'].', ':'')?>" class='text'/> <a href='/smiles'><img src='/images/mini_ulibka.gif'></a><br/>
     <span class='btn'><span class='end'><input class='label' type='submit' value='Отправить'>Отправить </span></span></form>

<?

}

?>

<?

    $max = 15;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clanchat` WHERE `clan` = "'.($_GET['clan'] == true ? $clan['id']:0).'"'),0);
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



$msg = _string(_num($_GET['msg']));

       if($msg) {

    $i_msg = mysql_query('SELECT * FROM `clanchat` WHERE `id` = "'.$msg.'"');
    $i_msg = mysql_fetch_array($i_msg);

    if(!$i_msg) {
    
      header('location: /clanchat/'.($_GET['clan'] == true ? 'clan/':'').'?page='.$page);
      exit;
    
    }

    if($_GET['clan'] == true && $clan_memb['rank'] == 4 OR $user['access'] > 0) {
        
      mysql_query('DELETE FROM `clanchat` WHERE `clan` = "'.($_GET['clan'] == true ? $clan['id']:0).'" AND`id` = "'.$i_msg['id'].'"');

    }

    header('location: /clanchat/'.($_GET['clan'] == true ? 'clan/':'').'?page='.$page);

  }



$q = mysql_query('SELECT * FROM `clanchat` WHERE `clan` = "'.($_GET['clan'] == true ? $clan['id']:0).'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {
  if($row['to'] == $user['id'] && $row['read'] == 0) {
  
    mysql_query('UPDATE `chat` SET `read` = "1" WHERE `id` = "'.$row['id'].'"');
  
  }

  $sender = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $sender = mysql_fetch_array($sender);
if($row['user'] == 0){
$sender['login'] = 'Система';
$sender['r'] = 'bot';
}
?>
<br>
<img src='/images/icon/race/<?=$sender['r']?>.png' alt='*'/>

<a href='/user/<?=$sender['id']?>/'><?=$sender['login']?></a><?

  if($sender['id'] != $user['id']) {

?> <a href='/chat/<?=($_GET['clan'] == true ? 'clan/':'')?>?to=<?=$sender['id']?>'>(»)</a><?

  }

?>:<?

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

<a href='/clanchat/<?=($_GET['clan'] == true ? 'clan/':'')?>?msg=<?=$row['id']?>'>(x)</a>

<?

  }
  
?>

<?

  }

  }
  else
  {
  
?>

<font color='#909090'>Сообщений нет</font>

<?
  
  }

?>

<?

  if($clan) {
  
     $_clanchat = mysql_query('SELECT COUNT(*) FROM `clan` WHERE `clanchat` = "0" AND `to` = "'.$user['id'].'" AND `read` = "0"');
     $_clanchat = mysql_result($_chat,0);

$_clan_clanchat = mysql_query('SELECT COUNT(*) FROM `clan` WHERE `clan` = "'.$clan['id'].'" AND `to` = "'.$user['id'].'" AND `read` = "0"');
$_clan_clanchat = mysql_result($_clan_chat,0);

?>

 <div class="dot-line"></div>
<div class="block_zero medium">
<img src="/images/icon/chat.png" alt=""> <?=($_GET['clan'] == true ? '<a href="/clanchat/">Титаны</a>':'<span class="grey">Титаны</span>')?><?=($_clanchat > 0 ? '<span class="green"> (+)</span>':'')?> | <?=($_GET['clan'] == true ? '<span class="grey">Клан</span>':'<a href="/chat/clan/">Клан</a>')?><?=($_clan_chat > 0 ? '<span class="green"> (+)</span>':'')?>
</div>

<?

  }

?>
<div class="dot-line"></div>
<div class="block_zero"><?=pages('/clanchat/'.($_GET['clan'] == true ? 'clan/':'').'?');?></div>
<div class="dot-line"></div>


<?

  if($_GET['read_all'] == true) {

    mysql_query('UPDATE `clanchat` SET `read` = "1" WHERE '.($_GET['clan'] == true ? '`clan` = "'.$clan['id'].'" AND':'').' `to` = "'.$user['id'].'"');
    
    header('location: /clanchat/'.($_GET['clan'] == true ? 'clan/':''));
  
  }

?>
<div class="menuList">
<li><a href="/smiles.php"><img src="/images/icon/user.png" alt="">Смайлы</a></li>
<li><a href="/moderators"><img src="/images/icon/user.png" alt="">Список модераторов</a></li>
<li><a href="/forum/topic/30/"><img src="/images/icon/arrow.png" alt="">Правила чата</a></li>
</div>
<?

}
?>
</div>
<?
include './system/f.php';

?>