<? 
     
    include './system/common.php'; 
     
 include './system/functions.php'; 
         
      include './system/user.php'; 
     
if(!$clan) { 

  header('location: /'); 
  exit; 

} 
if(!$user) { 

  header('location: /'); 
  exit; 

} 
    
    $title = 'БКО';

include './system/h.php';  


?>






 <div class="content">
<center>

<img src='http://tjwar.ru/images/clanwar.png' alt='*'/></br>
Бонус Клан Опыта(БКО) повышает количество опыта, который вы получаете в боях. Максимальное количество БКО равное 200%. </br>



 <font color='#909090'>Купить +2% БКО. </br>Цена: <?=($user['bko']*10)?> <img src='/images/icon/gold.png' alt='*'/> золота.</font></br>




<?

if (isset($_GET['plys']))
{

if($user['bko'] >= 100){
echo "Достигнуто ограничение";
}else{

if($user['g'] < ($user['bko']*10) ){?>У вас мало золота <?}else{

 if($user['s']<($user['bko']*10)){?>У вас мало серебра <?}else{

   $_SESSION['ok']='Успешно';


mysql_query("UPDATE `users` SET `g` = ".($user['g']-($user['bko']*10)).", `bko` =   `bko`+ 1
                                                            WHERE `id` = ".$user['id']."");

   mysql_query('UPDATE `clan_memb` SET 
                                                    `v` = `v` + 2 WHERE `id` = "'.$clan_memb['id'].'"');

 header('location: ?'); 

}
}

}



}


if($user['bko'] <= 99 ){?>
<div class="cntr"><a href='?plys' class='button'> Купить</span></span></a></div>

 
<?}else{?> Достигнуто ограничение <?}?>



 У вас <?=($user['bko']*2)?> % БКО
 </form>
</center>
</div> 





<?
include './system/f.php';
?>