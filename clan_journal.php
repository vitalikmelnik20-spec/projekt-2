<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
        
    $title = 'Клановый журнал'; 

   include './system/h.php';  

   
    if(!$user && !$clan) {
header:('location:/');
}
?>
<div class='main'>
<div class='menuList'>
<?
if(isset($_GET['delll'])){
mysql_query("DELETE FROM `clan_journal` WHERE `cl_id` = '$clan[id]'");
header('location:/clan/journal');
}
$max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_journal` WHERE `cl_id` = "'.$clan['id'].'"'),0);
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
$q = mysql_query('SELECT * FROM `clan_journal` WHERE `cl_id` = "'.$clan['id'].'" ORDER BY `stick` DESC, `id` DESC LIMIT '.$start.', '.$max.'');
  while($row = mysql_fetch_array($q)) {
  
  $i++;

?>

<?=$row['text']?> <small><?=date('d.m', $row['time'])?> в <?=date('H:i:s', $row['time'])?>
 </small><div class='dot-line'></div>

<?
}
?>
<?=pages('/clan/journal/?')?>


</div>
<?
  
  }else{
?>
Журнал пуст
<?
}
?>

</div>
<?
   include './system/f.php';  
