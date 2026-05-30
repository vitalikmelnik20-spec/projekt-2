<? 
     
    include './system/common.php'; 
     
 include './system/functions.php'; 
         
      include './system/user.php'; 
     
if(!$user) { 

  header('location: /'); 
  exit; 

} 
    
    $title = 'БКО';

include './system/h.php';  


?>

 
<?

if (isset($_GET['plys']))
{

if($clan_memb['bko'] >= 200 ){
echo "Достигнуто ограничение";
}else{

if($user['g']<($clan_memb['bko']*3)){?>У вас мало золота <?}else{


	

 						
mysql_query("UPDATE `users` SET `g` = ".($user['g']-($clan_memb['bko']*3)).", `v` =   `v`+ 2
, `bko` =   `bko`+ 2
                                                            WHERE `id` = ".$user['id']."");


}
}
}






if($clan_memb['bko'] <= 199 ){?>
<div class="cntr"><a href='?go' class="ubtn inbl mt-15 green mb5"><span class="ul"><span class="ur">Улучшить за <img class="icon" src="/images/icon/gold.png" /><?=$clan_memb['bko']*3?></span></span></a></div>
<?}else{?> Достигнуто ограничение <?}?>




<?
include './system/f.php';
?>