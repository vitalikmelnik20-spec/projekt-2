<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}
    
    $title = 'Черный список';


include './system/h.php'; 
?>
<div class='main'>
<?
 $max = 10; 
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `blacklist` WHERE `user` = \''.$user['id'].'\''),0);
  $pages = ceil($count/$max); 
   $page = _string(_num($_GET['page']));

  if($page > $pages) $page = $pages; 
   
  if($page < 1) $page = 1; 
     
  $start = $page * $max - $max; 

  if($count > 0) { 

    
    $q = mysql_query('SELECT * FROM `blacklist` WHERE `user` = \''.$user['id'].'\' ORDER BY `time` DESC LIMIT '.$start.', '.$max.'');

    while($row = mysql_fetch_array($q)) {
$ho = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = \''.$row['user2'].'\''));

?><div class='block_zero'><a href='/user/<?=$ho['id']?>'>
<img src='/images/icon/race/<?=$ho['r']?>.png' alt=''/> <?=$ho['login']?></a>, <img src='/images/icon/level.png' alt=''/> <?=$ho['level']?> ур <span class='medium'>( <a href='/mail/blacklist/?delete=<?=$ho['id']?>'>Удалить</a> )</span><br/>
</div>
<div class='dot-line'></div>
<?

    }

  echo '
<div class=\'block_zero\'>
'.pages('/mail/blacklist?').'</div>';

  }
  else
  {

    echo '<div class=\'block_zero\'><font color=\'#909090\'>Черный список пуст</font></div>';

  }
?>
<div class='dot-line'></div>
<?

$name = _string($_POST['name']);
$name = strToLower($name);
if(isset($_GET['add'])){
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `friends` WHERE `user` = \''.$user['id'].'\' AND `user2` = \''.$name.'\''),0) != 0){
mysql_query('DELETE FROM `friends` WHERE `user` = "'.$user['id'].'" AND `user2` = "'.$name.'"');
}
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `blacklist` WHERE `user` = \''.$user['id'].'\' AND `user2` = \''.$name.'\''),0) != 0){
 echo'Данный игрок уже в вашем чёрном списке';  
}else{
if($user['id'] == $name){
echo'<center>Себя нельзя добавлять в чёрный список</center>';
}else{
if($name == 0){
echo'<center>Введите ID игрока</center>';
}else{
mysql_query("INSERT INTO `blacklist` (`user`,`user2`)VALUES('$user[id]','$name')");
header('location:/mail/blacklist?');
}
}
}
}

$what = $ho['id'];
if(isset($_GET['delete']) == $what){ 
    mysql_query('DELETE FROM `blacklist` WHERE `user` = "'.$user['id'].'" AND `user2` = "'.$ho['id'].'"');

  } 

?>
<div class='block_zero' align='left'>
  <form action='?add' method='post'>
<br/>
Введите ID игрока:
<br/>
  <input name='name' class='text'>
<br/>
  <span class='btn'><span class='end'><input class='label' type='submit' value='Добавить'>Добавить</span></span><br/>
  </form>
</div>
<div class='dot-line'></div><div class='menuList'><li><a href='/mail'><img src='/images/icon/arrow.png' alt=''/>Вернуться в почту</a></li></div></div>
<?
include './system/f.php';  