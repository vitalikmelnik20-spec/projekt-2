<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}
    
    $title = 'Центр города';


include './system/h.php';  

?>

<div class='content' align='center'>
<font color='#9bc'> В городе ты найдешь все необходимое для боев и сражений!</font>
</div>
 <div class='mini-line'></div>
<div class='menuList'>
  <li align='center'><img src='/images/town/fights.png' alt='*'/></li>

<?

  if($user['level'] < 0) {
  
?>

<li class='no_b'><a href='/trade/'><img src='/images/icon/gold.png' alt='*'/> Получить золото</a></li>
  <small><font color='#999'>Доступно с <img src='/images/icon/level.png' alt='*'/> 10 уровня</font></small>
  </li>
  
<?

  }
  
  $undying_member = mysql_query('SELECT * FROM `undying_member` WHERE `user` = "'.$user['id'].'" ORDER BY `id` DESC LIMIT 1');
  $undying_member = mysql_fetch_array($undying_member);

  $undying = mysql_query('SELECT * FROM `undying` WHERE `start` = "0" LIMIT 1');
  $undying = mysql_fetch_array($undying);  


?>


<li class='no_b'><a href="/azart.php/"><img src="/images/arka.png" alt="">Обитель судеб</a></li> 

<li class='no_b'><a href="/game/"><img src="/images/labir.png"  width="15">Казино</a></li> 
<li class='no_b'><a href="/fish.php"><img src="/fish/fish.png" alt="">Рыбалка</a></li> 
<li class='no_b'><a href='/vip.php'><img src='/images/icon/vip.png' width='16px' height='16px' alt='*'/><font color="orange">V </font><font color="indianred">I </font><font color="yellow">P</font></a></li> 
<li class='no_b'><a href='/zags/'><img src='/images/icon/zags.png' width='16px' height='16px' alt='*'/>Священный храм</a></li> 

<?

  if($user['level'] < 0) {

?>

<small><font color='#999'>Доступно с <img src='/images/icon/level.png' alt='*'/> 4 уровня</font></small>

<?
  
  }
  else
  {

?>



<?

  }

?>

  </li>

<li class='no_b'></li>
</div>

<?

include './system/f.php';

?>