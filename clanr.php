<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


switch($_GET['action']) {

default:

    $title = 'Рейтинг арены кланов';    

include './system/h.php';  

?>

 <div class="bdr cnr f">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<div class='title'><?=$title?></div>
 
 <center>

 <div class="bdr cnr menu ">

<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"> 
 <img src="http://tjwar.ru/images/new/clans.png" alt="logoclans" >
 </center>

<?

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clans` WHERE `arena` > 1 '),0);
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
  
  }
  else
  {
  
    $i = ($page * 10) - 9;
  
  }

if($count > 0) {

$q = mysql_query('SELECT * FROM `clans` ORDER BY `arena` DESC,`arena` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {
  
  $i++;

if($i < 4) {

?>

<div class='content'>
<?=$i?> место<br/><br/>

<table cellpadding='0' cellspacing='0'>
<tr>
<td><img src='/images/icon/clan/gerb/<?=$row['gerb']?>.png' alt='*'/></td><td valign='top' style='padding-left: 5px;'><img src='/images/icon/clan/<?=$row['r']?>.png' alt=''*/> <a href='/clan.php?id=<?=$row['id']?>'><?=$row['name']?></a><br/>
<img src='/images/icon/level.png'/> Уровень: <b><?=$row['level']?></b><br/>
<img src='/images/icon/arena.png' alt='*'/> Рейтинг: <?=n_f($row['arena'])?></td>
</tr></table>

 <div class='line'></div>

<?

  }
  else
  {

?>

<img src='/images/icon/clan/<?=$row['r']?>.png' alt=''*/> <a href='/clan.php?id=<?=$row['id']?>'><?=$row['name']?></a>, <img src='/images/icon/arena.png'/> <?=$row['arena']?></br>

 
<?

  }


  }

?>

<?=pages('?')?></br>

<?

  }
  else
  {

?>


<?

  }
  
?>

<a href='/clans/'><img src='/images/icon/clan.png' alt='*'/> Кланы</a>




</div>
 </div> </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>

<?

include './system/f.php';

  break;

  case 'create':

    $title = 'Создать клан';    

include './system/h.php';  

$cost = 20000000000000000;

?>

<div class='title'><?=$title?></div>
 <div class='line'></div>

<?

  if($clan) {

?>

<div class='content'><font color='#999'>Для создания клана необходимо выйти из уже существующего</font></div>

<?

  }
  else
  {
  
$name = _string($_POST['name']);
$name = strToLower($name);

  if($name && $user['g'] >= $cost) {
    $clans = mysql_query('SELECT * FROM `clans` WHERE `name` = "'.$name.'"');
    $clans = mysql_fetch_array($clans);
  
  if(!$clans) {
    mysql_query('UPDATE `users` SET `g` = "'.($user['g'] - $cost).'" WHERE `id` = "'.$user['id'].'"');
  
  mysql_query('INSERT INTO `clans` (`name`,`r`) VALUES ("'.$name.'", "'.$user['r'].'")');

  $clan_id = mysql_insert_id();
  
  mysql_query('INSERT INTO `clan_memb` (`clan`,`user`,`rank`, `time`,`last_update`) VALUES ("'.$clan_id.'", "'.$user['id'].'", "4", "'.time().'","'.(time() + ((60 * 60) * 24)).'")');
  
 mysql_query('UPDATE `users` SET `noc` = "1" WHERE `id` = "'.$user['id'].'"');
  header('location: /clan.php');
  
  }
  
  }

?>

<div class='content' align='center'>
  <form action='' method='post'>
  Название клана:<br/>
  <input name='name'/><br/>
  <input type='submit' value='Создать клан'/><br/>
  <font color='#999'>Цена: <img src='/images/icon/gold.png' alt='*'/> <?=$cost?> золота</font>
  </form>
</div>

<?
  
  }

include './system/f.php';

  break;
  
}

?>