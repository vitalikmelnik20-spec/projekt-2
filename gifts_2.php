<?
include_once 'system/common.php';
include_once 'system/functions.php';
include_once 'system/user.php';
$title='Подарки';
include_once 'system/h.php';



//include_once 'sys/inc/compress.php';

if (empty($_GET['id'])){$_GET['id']=$user['id'];}



$ank=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$_GET['id']."' LIMIT 1"));
if(empty($ank['id'])){
echo'<font color=red>Нет такого игрока!</font>';
echo"<br/><div class=silka><a href=\"/?\">Главная</a>";
include './system/f.php';exit;
}


$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `gifts` WHERE `id_user` = '".$ank['id']."' LIMIT 1"), 0);

if ($k_post==0)
{
echo '<center> <div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">У игрока <img src=\'/images/icon/race/'.$ank['r'].'.png\' alt=\'*\'/> <a href=\'/user/'.$ank['id'].'/\'>'.$ank['login'].' </a> нет подарков:(Будьте Первыми!</center>';
}


echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo "<p><center><font color='yellow'>Подарки игрока <img src='/images/icon/race/".$ank['r'].".png' alt='*'/> <a href='/user/".$ank['id']."/'>".$ank['login']." </a></font></center></p>";
    $max = 3; 
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `gifts` WHERE `id_user` = "'.$ank['id'].'"'),0);
  $pages = ceil($count/$max); 
   $page = _string(_num($_GET['page']));

    if($page > $pages) { 
     
   $page = $pages; 
     
    } 
   
    if($page < 1) { 
     
   $page = 1; 
     
    } 
     
  $start = $page * $max - $max; 

$q = mysql_query('SELECT * FROM `gifts` WHERE `id_user` = "'.$ank['id'].'" ORDER BY `time` LIMIT '.$start.', '.$max.'');

  while($f = mysql_fetch_array($q)) {

$a = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$f['ot_id']."' LIMIT 1"));


echo"<center><img src='/gifts/".$f['id_gifts'].".gif' alt='' class='icon'/><br>";
echo "<div class=msg>От: $a[login]</br> ";
echo " <small>Время Отправки <font color=grey>"._times(time() - $f['time'])." </font></small></div></br> ";
echo "<div class=msg>Примечание: ".$f['text']." </div> </center></br>";


}
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
 echo "<div class='bdr cnr f mb2 bl nd '>
<div class='wr1'><div class='wr2'><div class='wr3'><div class='wr4'><div class='wr5'><div class='wr6'><div class='wr7'><div class='wr8'>";
echo " ".pages('/gifts_2/id/'.$ank['id'].'/?')."";
echo '</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>';
include './system/f.php';
?>