<?


include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) header('location: /');
$title = 'Царство Аида';

include './system/h.php';


$sw ='Тень ';

$name = $sw. $user['login'];



$aid = mysql_query('SELECT * FROM `aid` WHERE `id`=1');       


   $aid = mysql_fetch_array($aid);


 
        $hp_aid = round(100/(100000/$aid['hp']));

  



 





if(!$aid) {


  mysql_query('INSERT INTO `aid` (`id`) VALUES (1)');


header('location:aid.php');exit;}



if($aid['status']==0 && $aid['time']<=time()){


mysql_query('UPDATE `aid` SET `hp` = 100000 ,`status`=1 WHERE `id` = 1');   


if($aid['gr']!=0){  mysql_query('UPDATE `users` SET `str` = `str`-2000,`vit`=`vit`-2000,`agi`=`agi`-2000,`def`=`def`-2000 WHERE `id` = "'.$aid['gr'].'"'); 
mysql_query('UPDATE `aid` SET `gr`=0 WHERE `id` =1');  }      


header('location:aid.php');exit;


} 



$ten = mysql_query('SELECT * FROM `aid_ten` WHERE `users` = "'.$user['id'].'"');      


    $ten = mysql_fetch_array($ten);

if($aid['hp']>0){   if(!$ten) {


  mysql_query('INSERT INTO `aid_ten` (users,hp,strong,def,name) VALUES ("'.$user['id'].'","'.$user['hp'].'","'.$user['str'].'","'.$user['def'].'","'.$name.'")');


mysql_query('UPDATE `aid` SET `ten` =`ten`+1 WHERE `id`= 1');


header('location:aid.php');exit;


} 

}



$udar = $user['str']/10;
$udar = ceil($udar);

if($udar>2000){ $udar= mt_rand(1900,2000); }

$plus = $udar+1000;



if (isset($_GET['bat'])){



if($aid['status']==0){ header('location:aid.php');exit;}


if($aid['ten']<=0){ header('location:aid.php');exit;}
if($ten['hp']<=0){ header('location:aid.php');exit;}





if($aid['voln']==0){

mysql_query('UPDATE `aid` SET `hp` = `hp`-'.$udar.' WHERE `id`=1');   







mysql_query('UPDATE `aid_ten` SET `koef` = `koef`+ '.$udar.' WHERE `users` = '.$user[id].'');    


if($udar>=$aid['hp']){   


mysql_query('UPDATE `aid` SET `voln` =1,`hp`=0 WHERE `id`= 1');

mysql_query('UPDATE `users` SET `exp` =`exp`+5000 WHERE `aide`= 1');     header('location:aid.php');exit; }












$war =  mt_rand(1,5);




if($war==2){


$ot = $ten['hp']*5/100;



$ot = ceil($ot);
if($ot>=$ten['hp']){ mysql_query('UPDATE `aid` SET `ten` =`ten`-1 WHERE `id`= 1'); }


mysql_query('UPDATE `aid_ten` SET `hp` = `hp`- '.$ot.' WHERE `users` = '.$user[id].'');    

mysql_query('UPDATE `aid` SET `hp` = `hp`+ '.$ot.' WHERE `id` = 1');    
$_SESSION['prot']='<font color=red>Аид поглащает энергию вашей тени, воруя у нее 5% здоровья</font>'; 

}



$_SESSION['log']='<font color=green>Вы Ударили Аида на '.$udar.'</font>'; 
header('location:aid.php');exit;
}


if($aid['voln']==1){





$prot= mysql_fetch_assoc(mysql_query("SELECT * FROM `aid_ten` WHERE `hp`>0 ORDER BY RAND() LIMIT 1"));


if($udar>=$prot['hp']){ 

mysql_query('UPDATE `aid` SET `ten` =`ten`-1 WHERE `id`= 1'); 


mysql_query('UPDATE `aid_ten` SET `koef` = `koef`+ '.$plus.' WHERE `users` = '.$user[id].'');    

$_SESSION['log']='<font color=green>Вы убили '.$prot['name'].'</font>';}

else{   

mysql_query('UPDATE `aid_ten` SET `koef` = `koef`+ '.$udar.' WHERE `users` = '.$user[id].'');    
mysql_query('UPDATE `aid_ten` SET `hp` = `hp`- '.$udar.' WHERE `users` = '.$prot[users].'');    


$_SESSION['log']='<font color=green>Вы Ударили '.$prot['name'].' на '.$udar.'</font>';} 

$new = mysql_fetch_assoc(mysql_query("SELECT * FROM `aid` WHERE `id` = 1")); 
if($new['ten']<=0){




$geroi = mysql_fetch_assoc(mysql_query("SELECT * FROM `aid_ten` ORDER BY `koef` DESC LIMIT 1")); 


mysql_query('UPDATE `users` SET `str` = `str`+2000,`vit`=`vit`+2000,`agi`=`agi`+2000,`def`=`def`+2000 WHERE `id` = "'.$geroi['users'].'"');    




mysql_query('UPDATE `aid` SET `status` = "0",`voln`="0",



`time` = "'.(time() + 21600).'" , `gr`="'.$geroi['users'].'" WHERE `id` = 1');




mysql_query('UPDATE `users` SET `aide` = "0"');


mysql_query("truncate table `aid_ten` ");



}

header('location:aid.php');exit;



}



}

?><img src="/aid/cad.jpg" width="100%"><?






if($aid['status']==1){ 
?>
<div class='f'>                  

<center><b><font color=red>Аид</font> <img src="/images/icon/health.png" alt="*"><?=$aid['hp']?><font color=green>(<?=$hp_aid?>%)</font></b> <font color=orange>Тени: <?=$aid['ten']?></font></center>








</div><?


if($ten['hp']>0){

?><center><a href='aid.php?bat' class='btn'><span class='end'><span class='label'>Атаковать</a></span></span><?



if (isset($_SESSION['log'])){?><div class='line'></div><div class='content'><center><?=$_SESSION['log']?><center></div><?   $_SESSION['log']=NULL; }


if (isset($_SESSION['prot'])){?><div class='content'><center><?=$_SESSION['prot']?><center></div><?   $_SESSION['prot']=NULL; }





?><div class='content'><font color=green> Ваша Тень</font> <img src="/images/icon/health.png" alt="*"><?=$ten['hp']?><img src="/images/icon/str.png" alt="*"><?=$ten['strong']?><img src="/images/icon/def.png" alt="*"><?=$ten['def']?></div>









<?

}elseif($ten['hp']<=0){ ?><div class='content' align='center'> <font color=red>Ваша тень погибла обжигая вам руки... вы не можете принимать участие в бою</font></div> <?           }


}elseif($aid['status']==0){


$hr = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$aid['gr']."'")); 



?><div class='content' align='center'> <font color=orange>До следующей битвы <?=_time($aid['time'] - time())?> </font></div><? 


?><center><div class='content'><font color=green> Тени пали, сжигая все вокругюю только истинный герой получит благословение Аида</font> </div></center><?


?><center><div class='content'><font color=orange> Герой Битвы: </font> <a href='/user/<?=$hr['id']?>/'><?=$hr['login']?></a></div></center><?





}

include './system/f.php';
