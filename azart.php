<?php

include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Обитель Судеб';    





include './system/h.php';


$price = 100; //цена одной игры




$prog = 1000; //необходимый уровень прогресса для получения сундука


if($user['azart_sunduk']==1){ $sunduk='<font color=silver>Серебряный Сундук</font>'; }

if($user['azart_sunduk']==2){ $sunduk='<font color=gold>Золотой Сундук</font>'; }

if($user['azart_sunduk']==3){ $sunduk='<font color=violet>Магический Сундук</font>'; }


$azart = mysql_query('SELECT * FROM `azart` WHERE `id`=1');         


 $azart = mysql_fetch_array($azart);
if(!$azart) {



  mysql_query('INSERT INTO `azart` (`id`) VALUES (1)');


header('location:azart.php');exit;}


if($user['azart_exp']>=$prog){



$ran = mt_rand(1,5);




$sun=0;


if($ran<=3){ $sun=1; }  if($ran==4){ $sun=2; } if($ran==5){ $sun=3; }




     mysql_query('UPDATE `users` SET `azart_sunduk` ='.$sun.',`azart_exp`=0 WHERE `id` = "'.$user['id'].'"');   







}


if (isset($_GET['open'])){ 

if($user['azart_sunduk']==0){ header('location:azart.php?');exit; }


if($user['azart_sunduk']==1){

$hpy = mt_rand(80,100);

     mysql_query('UPDATE `users` SET `vit` = `vit` + '.$hpy.',`azart_1`=`azart_1`+'.$hpy.',`azart_sunduk`=0 WHERE `id` = "'.$user['id'].'"');   







$_SESSION['info']='Вы нашли полюс титана <img src="azart/hp.png" style="box-shadow: 0px 0px 20px green; margin: 10px;">'.$hpy.'';}


if($user['azart_sunduk']==2){


$def = mt_rand(80,100);

     mysql_query('UPDATE `users` SET `def` = `def` + '.$def.',`azart_2`=`azart_2`+'.$def.',`azart_sunduk`=0 WHERE `id` = "'.$user['id'].'"');   








$_SESSION['info']='Вы нашли осколок луны <img src="azart/def.png" style="box-shadow: 0px 0px 20px blue; margin: 10px;">'.$def.'';}




if($user['azart_sunduk']==3){


$str = mt_rand(80,100);

     mysql_query('UPDATE `users` SET `str` = `str` + '.$str.',`azart_3`=`azart_3`+'.$str.',`azart_sunduk`=0 WHERE `id` = "'.$user['id'].'"');   









$_SESSION['info']='Вы нашли перо солнца <img src="azart/str.png" style="box-shadow: 0px 0px 20px violet; margin: 10px;">'.$str.'';}











header('location:azart.php?');exit;
}

if (isset($_GET['game'])){ 


if($user['g']< $price) { $_SESSION['info']='<center><font color=red>Недостаточно Золота</font></center>';  header('location:azart.php');exit; }




$cush = $price*5/100; 


$sd = mt_rand(1,2);


if($user['azart_sunduk']==0) { 

if($sd==2){


$exp= mt_rand(50,250);




     mysql_query('UPDATE `users` SET `azart_exp` = `azart_exp` + '.$exp.' WHERE `id` = "'.$user['id'].'"');   


$_SESSION['expp']='<b><font color=green>+('.$exp.')</font></b>';




}}


$vx = mt_rand(1,2);


if($vx==1){

$rs = mt_rand(1000,2000);
     mysql_query('UPDATE `users` SET `s` =  `s`+'.$rs.' , `g`=`g`-'.$price.' WHERE `id` = "'.$user['id'].'"');   


     mysql_query('UPDATE `azart` SET `cush` =  `cush`+'.$cush.' WHERE `id` = 1');   

$_SESSION['info']='<font color=green> Вы выиграли <img src="/images/icon/silver.png" alt="s"/> '.$rs.'</font>';





}


if($vx==2){

$rexp = mt_rand(50,300);

     mysql_query('UPDATE `users` SET `exp` =  `exp`+'.$rexp.',`g`=`g`-'.$price.' WHERE `id` = "'.$user['id'].'"');   


     mysql_query('UPDATE `azart` SET `cush` =  `cush`+'.$cush.' WHERE `id` = 1');   

$_SESSION['info']='<font color=green> Вы выиграли <img src="/images/icon/exp.png" alt="exp"/>'.$rexp.'</font>';}


$ranb = mt_rand(1,100);

if($ranb<11){



     mysql_query('UPDATE `users` SET `g` =  `g`+'.$azart[cush].' WHERE `id` = "'.$user['id'].'"');   

     mysql_query('UPDATE `azart` SET `cush` =0 , `djek`='.$user[id].',`djek_pot`='.$azart[cush].' WHERE `id` = 1');   


$_SESSION['djek']='<b><font color=red> Джек-Пот : <img src="/images/icon/gold.png" alt="g"/>'.$azart[cush].'</font></b>';}



header('location:azart.php?');exit;
}

?><center><div class="content"><img src="/images/lt.jpg" alt=""></div></center><?

if (isset($_SESSION['djek'])){?><div class='line'></div><div class='content'><center><?=$_SESSION['djek']?><center></div><?   $_SESSION['djek']=NULL;  }
if (isset($_SESSION['info'])){?><div class='line'></div><div class='content'><center><?=$_SESSION['info']?><center></div><?   $_SESSION['info']=NULL;  }







?><center><a href='azart.php?game' class='btn'><span class='end'><span class='label'>Сыграть за <img src='/images/icon/gold.png' alt='g'/><?=$price?></a></span></span><? 

?><div class='line'></div><?

?><div class='content'><font color=green> Джек-пот: </font> <img src='/images/icon/gold.png' alt='g'/><?=$azart['cush']?> </div><?


if($azart['djek']>0){






$lost = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$azart['djek']."'")); 

?><div class='content'><font color=red> Последний Джек-пот: </font><?=$lost['login']?> <img src='/images/icon/gold.png' alt='g'/><?=$azart['djek_pot']?> </div><?





}

?><div class='line'></div><?



if($user['azart_sunduk']==0){ 


?><center><div class='content'><img src="/images/pe.png" alt="">Ваш прогресс <?=$user['azart_exp']?><?=$_SESSION['expp']?>/<?=$prog?><font color=grey>(до выпадения сундука)</font> </div></center><? ?><center><a href="/azart_art.php?/" class='btn'><span class='end'><span class='label'>Найденные Артефакты</a></span></span><?





$_SESSION['expp']=NULL;




}else { 


?> <center><div class='content'>  <?=$sunduk?></br><img src="/images/azart/<?=$user['azart_sunduk']?>.png" width="70"></div></center><?



?><center><a href='azart.php?open' class='btn'><span class='end'><span class='label'>Открыть Сундук</a></span></span><? 




}

include_once 'system/f.php'; 
