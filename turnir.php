<?
require_once 'system/common.php';
require_once 'system/functions.php';
require_once 'system/user.php';
$title = 'Турнир';
require_once 'system/h.php';
?>


<?

$sort = _string($_GET['sort']);



    $max = 10;

  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `arena` > 0'),0);
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

switch($sort) {
    default:
$q = mysql_query('SELECT * FROM `users` WHERE `arena` > 0 ORDER BY `arena` DESC LIMIT '.$start.', '.$max.'');
  
      break;
}

  


 while($row = mysql_fetch_array($q)) {

  $i++;
?>





 


<?=$i?>. <img src='/images/icon/race/<?=$row['r'].($row['online'] > time() - 300 ? '':'-off')?>.png' alt='*'> <a href='/user/<?=$row['id']?>/'><?=$row['login']?></a>

<?


switch($sort) {
     default:

?>

<b> <img src='http://tiwar.ru/images/icon/gift.png' alt=''/> <?=($row['arena'])?></b>



<?

      break;
    
    }
?>

<br/>

<?

    
  
}
  
  
?>

<?=pages('/turnir/'.$sort.'/?');?>


</div><ul class='hint'><li>Недельный турнир по черепам!
Черепа падают на арене!</li></ul><div class='line'></div> <?require_once 'system/f.php';?>

