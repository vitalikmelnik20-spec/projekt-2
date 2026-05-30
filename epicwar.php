<?php

include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Мрачные Чертоги';    





include './system/h.php';






	$name = array ('.','Упырь','Ведьма','Великан','Кровавый Страж');


	$str = array (0,100,200,1500,2000); // урон боссов


	$def = array (0,500,1000,2500,5000); // защита боссов

	$ess = array ('.','Упыря','Ведьму','Великана','Кровавого Стража');


$infa = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"');


  $infa = mysql_fetch_array($infa);

  
    if(!$infa) { header('location:index.php');exit; }



    $clan = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$infa['clan'].'"');


    $clan = mysql_fetch_array($clan);

$boss = ($clan['epic_boss']>1) ? $clan['epic_boss'] : 2 ;
$plus = $clan['level']*5000;

$viewhp = 200000*$boss; // хп боссов

$viewhp=$viewhp+$plus;
if($clan['epic_boss']>=5){ 



$expr = mt_rand(1000,3000);// опыт за поход


$silr = mt_rand(4000,8000); //серебро за поход

$golr = mt_rand(1000,2000);//золото за поход


mysql_query('UPDATE `clans` SET `epic_exp` = `epic_exp`+'.$expr.',`epic_s` = `epic_s`+'.$silr.',`epic_gold` = `epic_gold`+'.$golr.',`exp` = `exp`+'.$expr.',`s` = `s`+'.$silr.',`g` = `g`+'.$golr.',`epic_war`= 0 ,`epic_run`= 0 ,`epic_boss`=0 WHERE `id` = '.$clan[id].'');    



mysql_query('UPDATE `users` SET `exp` = `exp`+'.$expr.',`s` = `s`+'.$silr.',`g` = `g`+'.$golr.',`uron_pohod`= 0 ,`epic_run`= 0,`self`=1 WHERE `griz` = '.$user[griz].'');    



mysql_query('UPDATE `clans` SET `epic_time` = "'.(time() + 21600).'" WHERE `id` = '.$clan[id].'');

$fin ="Поход окончен, Награда <img src=/images/icon/exp.png> $expr <img src=/images/icon/silver.png> $silr <img src=/images/icon/gold.png> $golr ";







mysql_query('INSERT INTO `clan_msg` (`clan`,
                                             `user`,
                                             `text`,
                                             `time`) VALUES ("'.$clan['id'].'",
                                                             "'.$user['id'].'",

                                                                   "'.$fin.'",
                                                                   "'.time().'")'); 


header('location:epicwar.php');exit; 




}
if($user['griz']!=$infa['clan']){ 


mysql_query('UPDATE `users` SET `griz` ='.$infa['clan'].' WHERE `id` = '.$user[id].'');    

header('location:epicwar.php');exit; }


$text ='Поход начался, <a href=/epicwar.php>В бой</a>';



$box = $str[$clan['epic_boss']];

$bloc= $def[$clan['epic_boss']];

$opp=$ess[$clan['epic_boss']];
$name=$name[$clan['epic_boss']];


$run=$clan['epic_run']*10;
if (isset($_GET['start'])){ 

if($clan['epic_time']>time()){ header('location:epicwar.php');exit;} 


if($infa['rank']<3){ header('location:epicwar.php');exit;} 


if($clan['war']==1){ header('location:epicwar.php');exit;} 

mysql_query('UPDATE `clans` SET `epic_war` =1, `epic_boss`=1  ,`epic_hp`='.$viewhp.' WHERE `id` = '.$clan[id].'');    





mysql_query('INSERT INTO `clan_msg` (`clan`,
                                             `user`,
                                             `text`,
                                             `time`) VALUES ("'.$clan['id'].'",
                                                             "'.$user['id'].'",

                                                                   "'.$text.'",
                                                                   "'.time().'")'); 


header('location:epicwar.php');exit; 





}


$uron = $user['str']-$bloc;
$last = ($uron>0) ? $uron : mt_rand(100,200);


if($clan['epic_run']>0){ $bub=$last*$run/100; $last=$last+$bub; }


$mons = $box-$user['def'];


$monstr = ($mons>0) ? $mons : 1;



$getstat = $clan['epic_hp']-$last;

$last= ceil($last);



if (isset($_GET['at'])){ 

if($clan['epic_war']==0){ header('location:epicwar.php');exit;}
if($user['hp']<100){ $_SESSION['logme']='<font color=red>для атаки неободимо более 100 здоровья</font> <a href="/lab/wiz/?potion=true&referal=/epicwar.php">Востановить</a> ';   header('location:epicwar.php');exit;}




if($getstat<=0){ 


mysql_query('UPDATE `clans` SET `epic_hp` ='.$viewhp.' , `epic_boss`=`epic_boss`+1, `epic_total`=`epic_total`+1 WHERE `id` = '.$clan[id].'');    




}
mysql_query('UPDATE `clans` SET `epic_hp` = `epic_hp`-'.$last.', `epic_uron`=`epic_uron`+'.$last.' WHERE `id` = '.$clan[id].'');    


mysql_query('UPDATE `users` SET `hp` = `hp`-'.$monstr.', `uron_pohod`=`uron_pohod`+'.$last.' WHERE `id` = '.$user[id].'');    




$runa = mt_rand(1,100);


if($runa<21){




mysql_query('UPDATE `users` SET `epic_run` = `epic_run`+1 WHERE `id` = '.$user[id].'');    

mysql_query('UPDATE `clans` SET `epic_run` = `epic_run`+1 WHERE `id` = '.$clan[id].''); }   
$mes = ($runa<21) ? '<font color=silver>(найдена руна)</font>' : null;



//способности

$treo = mt_rand(1,5);

if($clan['epic_boss']==2 and $treo==3){ 






if($user['epic_run']>0){

mysql_query('UPDATE `users` SET `epic_run` = `epic_run`-1 WHERE `id` = '.$user[id].'');    
mysql_query('UPDATE `clans` SET `epic_run` = `epic_run`-1 WHERE `id` = '.$clan[id].'');    
$_SESSION['efect']='<font color=violet>Ведьма использует магию разрушая вашу руну</font>'; 

} else{  mysql_query('UPDATE `users` SET `hp` = `hp`-1000 WHERE `id` = '.$user[id].'');     $_SESSION['efect']='<font color=violet>Ведьма поджигает вас молнией на 1000, игнорируя броню</font>';  }          



 
}


if($clan['epic_boss']==3 and $treo==3){ 



mysql_query("UPDATE `users` SET `hp` = `hp`-1500 WHERE `self`='/epicwar.php' and `griz`='".$user['griz']."' ");    













$_SESSION['efect']='<font color=violet>Великан скатывает каминные глыбы, раня всех участников сражения на 1500</font>';          


}





if($clan['epic_boss']==4 and $treo==3){ 


$my = $user['hp']*10/100;



$my = ceil($my);


mysql_query('UPDATE `users` SET `hp` = `hp`-'.$my.' WHERE `id` = '.$user[id].'');    
mysql_query('UPDATE `clans` SET `epic_hp` = `epic_hp`+'.$my.' WHERE `id` = '.$clan[id].'');    



$_SESSION['efect']='<font color=violet>Кровавый Голем питается вашей кровью. потеряно '.$my.' здоровья</font>';          

}

$_SESSION['logme']='<font color=lime>Вы ударили '.$opp.' на '.$last.'</font>  '.$mes.''; 


$_SESSION['log']='<font color=red>'.$name.' атакует вас на '.$monstr.'</font>'; 









header('location:epicwar.php');exit;
}

if($clan['epic_war']==0){ 
?>
<div class="block_zero center"><img src="/images/epik/logo.jpg" alt="" width="100%"></div>
<?


?><div class='content'><?


if($clan['epic_time']>time()){ ?><center><font color=lime>До следующего похода <?=_time($clan['epic_time'] -time())?> </font><center><? }

?><center><a href='epicwar.php?' class='btn'><span class='end'><span class='label'>Обновить</a></span></span><?

if($infa['rank']>2){  

?><center><a href='epicwar.php?start' class='btn'><span class='end'><span class='label'>Начать Сражение</a></span></span><? }




?></div><?

}







if($clan['epic_war']==1){








?>
<div class="block_zero center"><img src="/images/epik/logo.jpg" alt="" width="100%"></div>
<?






?><div class='line'></div><div class='f'>    <table>


        <tr>
            <td style="width: 45px;"><img src='/images/epik/<?=$clan['epic_boss']?>.png' alt='' width='30' height='30' style='float:left;margin-right:3px;margin-top:3px;'/></td>









<td>
<?=$name?> <img src="/images/icon/health.png" alt="hp"> <?=$clan['epic_hp']?>  <img src='/images/icon/str.png' alt='*'/> <?=$box?> <img src='/images/icon/def.png' alt='*'/> <?=$bloc?> </br></br>
















</div>
            </td>
        </tr>
</table></div><? 




?><center><a href='epicwar.php?at' class='btn'><span class='end'><span class='label'>Бить <?=$opp?></a></span></span><? 



if (isset($_SESSION['logme'])){?><div class='line'></div><div class='verx'><center><?=$_SESSION['logme']?><center></div><?   $_SESSION['logme']=NULL; }

if (isset($_SESSION['log'])){?><div class='line'></div><div class='verx'><center><?=$_SESSION['log']?><center></div><?   $_SESSION['log']=NULL; }


if (isset($_SESSION['efect'])){?><div class='line'></div><div class='verx'><center><?=$_SESSION['efect']?><center></div><?   $_SESSION['efect']=NULL; }




?><center><div class='content'> <?=($clan['epic_run']>0) ? "Усиление $run% " : "Усилений нет" ?> </center><?

















?><div class='line'></div><?

?><div class='content'> В бою:    </br><?




$sogf = mysql_query("SELECT * FROM `users` WHERE `self`='/epicwar.php' and `griz`='".$clan['id']."' ORDER BY `uron_pohod` DESC LIMIT 10");











while($sog = mysql_fetch_assoc($sogf)){



?><b><font color="gold"><?=$sog['login']?>(<?=$sog['uron_pohod']?>)</font>*<?=$sog['epic_run']?><br></b><?



}


?></div><?




}
include_once './system/f.php'; 

