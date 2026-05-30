


<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Пустоши';    



include './system/h.php';



	$name = array ('Леса Орков','Долина Грёз','Кладбище Некроманта');


	$vrag = array ('Орк','Падший Титан','Некромант');

	$hp_act = array (20000,30000,50000); //хп на этапы






$mor = mysql_query('SELECT * FROM `mor` WHERE `id`=1');       


   $mor = mysql_fetch_array($mor);


$next = $mor['etap']+1;

if(!$mor) {


  mysql_query('INSERT INTO `mor` (`id`) VALUES (1)');


header('location:mor.php');exit;}


if($mor['status']==0 && $mor['time']<=time()){


mysql_query('UPDATE `mor` SET `hp` = '.$hp_act[$mor['etap']].' ,`status`=1 WHERE `id` = 1');   




header('location:mor.php');exit;

}







if($mor['etap']==0){ 
$text = array ('Пройти этого великана, не так просто','Злобное Рычание наполняет лес','Среди деревьев промелькнула тень','Только истинный герой сможет убить Орка'); 

shuffle($text); }


if($mor['etap']==1){ 
$text = array ('Падший Титан одним ударом может разрубить доспех','Оружие не пробивают его щит.. бой будет вечным','Гнев Титана Смертелен','Победить его возможно только толпой!!!'); 


shuffle($text); }



if($mor['etap']==2){ 
$text = array ('Некромант поднимает скелеты из могил','Ваши ноги вязнут в свежи вырытой земле','Некромант использует магию для боя на расстоянии','Скелеты бьют вас по рукам, выбивая оружие'); 


shuffle($text); }



$i_clan_memb = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"');

  $i_clan_memb = mysql_fetch_array($i_clan_memb);
  
    if(!$i_clan_memb) { header('location:index.php');exit; }
if($i_clan_memb) {

    $clan = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$i_clan_memb['clan'].'"');

    $clan = mysql_fetch_array($clan);  }


$rand = mt_rand(1,10);

$vant = $clan['level'];

$num = $clan['level']*10;

$uron = $num;




$uron=$uron+$user['level'];

$uron=$uron+$rand;


if (isset($_GET['fay'])){


if($mor['status']==0){ header('location:mor.php');exit;}


if($uron>=$mor['hp']){
if($mor['etap']==0){ 
$best = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` ORDER BY `cris` DESC LIMIT 1"));

mysql_query('UPDATE `mor` SET `ter_1` = '.$best[id].',`etap`=`etap`+1, `hp` = '.$hp_act[$next].' WHERE `id` =1');   



mysql_query('UPDATE `clans` SET `cris` =0');   
}


if($mor['etap']==1){ 
$best = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` ORDER BY `cris` DESC LIMIT 1"));

mysql_query('UPDATE `mor` SET `ter_2` = '.$best[id].',`etap`=`etap`+1, `hp` = '.$hp_act[$next].' WHERE `id` =1');   



mysql_query('UPDATE `clans` SET `cris` =0');   
} 

if($mor['etap']==2){ 
$best = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` ORDER BY `cris` DESC LIMIT 1"));

mysql_query('UPDATE `mor` SET `ter_3` = '.$best[id].' WHERE `id` =1');   



mysql_query('UPDATE `clans` SET `cris` =0');   
mysql_query('UPDATE `mor` SET `status` = "0",

`time` = "'.(time() + 21600).'" ,`etap`=0 WHERE `id` = 1');





}


header('location:mor.php');exit;

}


mysql_query('UPDATE `mor` SET `hp` = `hp`- '.$uron.' WHERE `id` = 1');   


$ran = mt_rand(1,100);

if($vant>=$ran){





$col = mt_rand(1,3);


mysql_query('UPDATE `clans` SET `cris` = `cris`+ '.$col.' WHERE `id` = '.$clan[id].'');   

if($mor['etap']==0){

$exp = $col*50;

mysql_query('UPDATE `users` SET `exp` = `exp`+ '.$exp.' WHERE `id` = '.$user[id].'');   
if($mor['ter_1']!=0){

mysql_query('UPDATE `clans` SET `g` = `g`+ '.$col.' WHERE `id` = '.$mor[ter_1].'');   

}


}

if($mor['etap']==1){

$sera = $col*100;

mysql_query('UPDATE `users` SET `s` = `s`+ '.$sera.' WHERE `id` = '.$user[id].'');   

if($mor['ter_2']!=0){

mysql_query('UPDATE `clans` SET `g` = `g`+ '.$col.' WHERE `id` = '.$mor[ter_2].'');   


} 

}
if($mor['etap']==2){

$gold = $col*10;

mysql_query('UPDATE `users` SET `g` = `g`+ '.$gold.' WHERE `id` = '.$user[id].'');   
if($mor['ter_3']!=0){

mysql_query('UPDATE `clans` SET `g` = `g`+ '.$col.' WHERE `id` = '.$mor[ter_3].'');   

} 

 }
$_SESSION['log']='<font color=green>Вы Атаковали '.$vrag[$mor['etap']].' на '.$uron.'</font><font color=red> Найдено <img src="mor/cris.png"> '.$col.'</font>';


}
else{
$_SESSION['log']='<font color=green>Вы Атаковали '.$vrag[$mor['etap']].' на '.$uron.'</font>';

}

  
  header('location: mor.php');exit;


  
  

}




?><div class='content' align='center'><img src="/mor/mor.jpg " width="100%"></div><?


if($mor['status']==1){
?><div class='content' align='center'> Территория: <font color=orange> <?=$name[$mor['etap']]?></font> </div><?



?><div class='content' align='center'><?=$vrag[$mor['etap']]?><img src='/images/icon/health.png' alt='*'/>(<?=$mor['hp']?>/<?=$hp_act[$mor['etap']]?>) </div><?




?><div class='content' align='center'><a href='mor.php?fay' class='button'>Атаковать</a><br/></div><?

if (isset($_SESSION['log'])){?><div class='line'></div><div class='content'><center><?=$_SESSION['log']?><center></div><?   $_SESSION['log']=NULL; }



?><div class='line'></div><div class='content'> <center><font color=orange><?=$text[0]?></font></center></div><?






?><div class='line'></div><div class='content'>    <table>

        <tr>
            <td style="width: 45px;"><img src="mor/at.jpg"></td>




<td>
Найдено Кристаллов(<?=$clan['cris']?>) </br> Примерный Урон ~   <font color='#90c090'><b><?=$uron?> </b></font><br> <font color=green>Шанс Нахождения Кристаллов: <?=$vant?>%</font>






















                </div>
            </td>
        </tr>
</table><? 

}else{





$vv1 = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id`='".$mor['ter_1']."'"));

$vv2 = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id`='".$mor['ter_2']."'"));

$vv3 = mysql_fetch_assoc(mysql_query("SELECT * FROM `clans` WHERE `id`='".$mor['ter_3']."'"));


?><div class='content' align='center'> <font color=green>До следующего захвата Осталось: <?=_time($mor['time'] - time())?> </font></div><?





?><div class='content' align='center'> <font color=orange>Леса Орков</font> Владения (<img src='/images/icon/clan/<?=$vv1['r']?>.png' alt='*'/> <a href='/clan/<?=$vv1['id']?>/'><?=$vv1['name']?></a>)</div><?


?><div class='content' align='center'> <font color=orange>Долина Грёз</font> Владения (<img src='/images/icon/clan/<?=$vv2['r']?>.png' alt='*'/> <a href='/clan/<?=$vv2['id']?>/'><?=$vv2['name']?></a>)</div><?



?><div class='content' align='center'> <font color=orange>Кладбище Некроманта</font> Владения (<img src='/images/icon/clan/<?=$vv3['r']?>.png' alt='*'/> <a href='/clan/<?=$vv3['id']?>/'><?=$vv3['name']?></a>)</div><?










}



include './system/f.php';

