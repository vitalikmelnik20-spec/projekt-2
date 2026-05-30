<?php 


include_once 'system/common.php'; 
include_once 'system/functions.php'; 
     
      include './system/user.php'; 
  
$title = 'Пещера зомби'; 
include_once 'system/h.php'; 

 $g = rand(0,0); //Золото
 $mp = rand(10,100); //Манна

 $k = rand(0,4); //Камни
 $key = rand(0,1); //Ключи
 $z = rand(0,20);  //Убито зомби
 $exp = rand(10,2000); //Опыт
 $s = rand(10,2000); //Серебро
if (isset($_GET['spin']) && $user['mp']>=100) 
{ 
    $chanse = rand(2,4); 


    if ($chanse ==1) 
    { 
        $text = "<br /><div class=' '><center> Потрачено маны: $mp <img src='images/icon/mana.png'> Увидели убитого зомби и обыскали и нашли: $g <img src='images/icon/g.png'> золота </div></center></br>"; 
        mysql_query("UPDATE `users` SET `g`=`g`+'$g' WHERE `id`='".$user['id']."'"); 
    } 
    elseif($chanse==4) 
    { 
        $text  =  
 "<br /><div class=' '><center> Потрачено маны: $mp <img src='images/icon/mana.png'> Вы под ногами  нашли: $s <img src='images/icon/silver.png'> серебра </div></center></br>"; 
        mysql_query("UPDATE `users` SET `s`=`s`+'$s' WHERE `id`='".$user['id']."'"); 
    } 
    elseif ($chanse==2) { 
        $text  = "<br /><div class=' '><center> Потрачено маны: $mp <img src='images/icon/mana.png'> Вы убили:$z зомби и получили: $exp <img src='images/icon/exp.png'> опыта </div></center></br>"; 
        mysql_query("UPDATE `users` SET `exp`=`exp`+'$exp' WHERE `id`='".$user['id']."'"); 
    } 
    elseif($chanse==3) 
    { 
        $text  = "<br /><div class=' '><center> Потрачено маны: $mp <img src='images/icon/mana.png'> Вы подняли:$k камня и получили  $key <img src='images/icon/key.png'> ключ</div></center></br>"; 
        mysql_query("UPDATE `users` SET `key`=`key`+'$key' WHERE `id`='".$user['id']."'"); 
    } 

    mysql_query("UPDATE `users` SET `mp`=`mp`-'$mp' WHERE `id`='".$user['id']."'"); 

    ?> 

    <div class ='f'/> 
<center><?=$text;?></center> 
<hr> 
    </div> 
    <div class ='f'/></div> 

    <? 
} 


?> 



    <div class  ='f'/> 

 <? 


if ($user['mp']>=100) 
{ 
    ?> 
    <form action = '?spin' method ='post'/> 
    <center> 
<input type ='submit' value =' Обыск ' style = 'width:75%;'/> 
    </center> 
</form> 
<? 

} 
else 
{ 
    ?> 

    <? 
} 

?> 
</div> 

</div> 
<div class ='f'/> 
<center> Один обыск минус до 100 маны! </center> 
</div> 
    <center> 
<p><font color="red" ">         Вы попали в пещеру к зомби! 
<hr> 
 </font></p>  
<p><font color="#00FA9A">            При обыске пищеры,  у тебя на пути могут встретиться враги! 
<hr> 
 </font></p>  



  
Пока ты обыскиваешь пещеру  ты можешь найти ценные ресурсы золото,серебро! 
 <hr> 
За убийство зомби на своём пути ты получишь опыт!  
 <hr> 
А под каждым камнем лежит ключ! Который можно потратить в <a href="sunduk.php"> 
 <font color="gold">Сундук 
</a> 
 <hr> 
Удачных поисков! 
    </center> 
    </div> 




 <div class  ='f'/> 

 </font></p>  
<p><font color="#00FA9A">Если маны меньше 100! Надпись ОБЫСК исчезает до востоновления более 100 маны  маны вам нужно подождать или  
 <a href="/lab/wiz/?potion=true&referal=/lu.php?"> 
 <font color="#00FA9A">                   Востоновить ману! 
</a> 

  




<? 

include_once 'system/f.php';