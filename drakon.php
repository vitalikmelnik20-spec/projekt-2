<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';   
 
if(!$user OR $user['level'] < 25) {

  header('location: /');
    
exit;

}
$title = 'Пещерный Дракон';
include './system/h.php';


   
$df1=  round(rand($user['def']/15,$user['def']/17));
$df2 = round(rand($user['agi']/10,$user['agi']/9));
$aluk_def = round(rand($df1,$df2));
$my_atk = round(rand($user['str']/6,$user['str']/4)-$aluk_def);
if ($my_atk<1)
{
$my_atk = $user['level']+rand($user['level'],$user['level']/2);
}
$aluko = mysql_fetch_assoc(mysql_query("SELECT * FROM `aluko` ORDER BY `id` LIMIT 1"));
if($aluko['health']==0){
 echo '<div class="bdr cnr f">
<center>
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
 <img src="images/icon/pdrakon.png"></center><br>
<font color="green">Дракон повержен. Он может вернуться в любое время,так-что не сиди сложа руки будь готов к бою.</font></center></br>';
include './system/f.php';
exit;
}
if($my_atk >$aluko['health'] and $aluko['health']!=0){
mysql_query("UPDATE `aluko` SET `health`=0 WHERE `id`='".$aluko['id']."'")or die (mysql_error());
echo '<div class="main"><center><img src="images/icon/arena.png">Дракон повержен. Он может вернуться в любое время,так-что не сиди сложа руки будь готов к бою.</div> </div></div></div></div></div></div></div></div> </center>';
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `aluko_log`"),0);
if($total>0){
$q_nagr = mysql_query("SELECT * FROM `aluko_log` GROUP BY `user_id` ORDER BY RAND()");
/*3 лучших */
$top_q  = mysql_query("SELECT SUM(uron) , `user_id` FROM  `aluko_log` GROUP BY  `user_id` ORDER BY  SUM(uron) DESC LIMIT 10");
$topes_us = '<font color="90c0c0">Результат сражения с Драконом:</font><br> ';
while($top= mysql_fetch_assoc($top_q)){
mysql_query("UPDATE `users` SET `s`=`s`+".$aluko['s']."  WHERE `id`='".$top['user_id']."'");
// Рассчёт награды
$max_uron = mysql_result(mysql_query("SELECT SUM( uron ) FROM `aluko_log` WHERE `user_id`='".$top['user_id']."'"),0);
$cena_uron=1; // монет за единицу урона            
$uron_money=$max_uron/16;
$_exp = rand(3000,35000);
$_gold = rand(60,100);
// Рассчёт награды
// Пишем в журнал
if($max_uron >0){
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = '.$top['user_id'].' AND `ho` = "2"'),0) == 0) {
mysql_query("INSERT INTO `contacts` SET `user` = '".$top['user_id']."', `ho` = '2', `time` = ".time()."");
}	
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = '.$top['user_id'].' AND `ho` = "2"');
$text = "Вы нанесли <font color=\'#c66\'> ".$max_uron." урона </font></br> получили награду:</br> <font color=\'#FFFF00\'><img src=\'/images/icon/gold.png\' alt=\'*\'/> ".$_gold." золота,</font></br> <font color=\'#C0C0C0\'><img src=\'/images/icon/silver.png\' alt=\'*\'/> серебра ".$uron_money."</font></br><font color=\'#FFFFFF\'> опыта <img src=\'/images/icon/exp.png\' alt=\'*\'/> ".$_exp." </font>";
mysql_query("INSERT INTO `mail` SET `from` = '2', `to` = '".$top['user_id']."', `time` = '".time()."', `read` = '0', `text` = '".$text."'");
mysql_query("UPDATE `users` SET `exp`=`exp`+".$_exp.", `s`=`s`+".$uron_money.", `g`=`g`+ ".$_gold."  WHERE `id`='".$top['user_id']."'");
}          
$name_top = mysql_fetch_assoc(mysql_query("SELECT `login`, `r` FROM `users` WHERE `id`='".$top['user_id']."' LIMIT 1"));
$topes_us.= '<span class="login"><font color="90c0c0"><img src="/images/icon/race/'.$name_top['r'].'.png" "alt"="*"/> '.$name_top['login'].'</span> (Нанес '.$max_uron.' урона )<br></font>'; 
$aluko['s']=$aluko['s']-4;
$aluko['exp']= round($aluko['exp']/2);
}
mysql_query("INSERT INTO `chat` SET `user`='2', `text`='".$topes_us."', `time`='".time()."'");
#sleep(1);
//////
mysql_query("TRUNCATE TABLE  `aluko_log`");
}
include './system/f.php';
exit;
}
$aluko['health'] = $aluko['health']-$my_atk;    
   $aluko_progress = round(100/($aluko['max_health']/$aluko['health']));
$aluko_sl = array('ударил','нанес урон','порезал','побил','царапнул','укусил','пнул','ткнул в глаз','укусил за ухо','плюнул в глаз','отбил бедро','укусил за попу');
shuffle($aluko_sl);
if($user['mp']<150){
echo '<div id="error"> <div class="bdr cnr f">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"> <center><font color="#c06060">Для нападения надо минимум <img src="/images/icon/mana.png" alt="*"/> 150 маны<br> 
</font>';
 if($user['lab'] < '31'){
  $_cena = 16;  
   }
   if($user['lab'] > '29'){
  $_cena = 51;  
   }
echo 'Купленно настоек '.$user['lab'].'</br>';
echo' <a  href="/lab/wiz/?potion=true&referal=/drakon" class="btn"><span class="end"><span class="label"> Пополнить ману за <img src=\'/images/icon/gold.png\' alt="*"/> '.$_cena.' золота </br></a></span> </span> </center> ';
echo'<center>Здоровье дракона:<font color="green"> '.$aluko['health'].'</font>/<font color="green">'.$aluko['max_health'].'</font></center>';

http://30.ru/lab/wiz/?potion=true&referal=/arena?lastPlayer
$aluko_log_q = mysql_query("SELECT * FROM `aluko_log` ORDER BY `time` DESC LIMIT 3");
echo '<center><font color="yellow">Лог боя</font><br>';
while($aluko_log = mysql_fetch_assoc($aluko_log_q)){
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$aluko_log['user_id']."'"));
echo '<a href="user.php?id='.$ank['id'].'">'.$ank['login'].'</a> '.$aluko_log['text'].'<br>';
}
echo '</center> </div></div></div> </div></div></div> </div></div></div> ';
include './system/f.php';
exit;
}
if($user['hp']<550){
echo '<div id="error"> <div class="bdr cnr f">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
 <font color="#c06060"><center>Вы погибли в бою , дождитесь окончания боя или восстановите у колдуна здоровье!!!</font>';
 echo' <a  href="/lab/" class="btn"><span class="end"><span class="label"> Пополнить ману и здоровье</a></span> </span> </center> ';
echo'<center> 

</font>

 

'.$aluko['max_health'].'
Здоровье дракона:<font color="green"> '.$aluko['health'].'</font>/<font color="green">'.$aluko['max_health'].'</font></center>  <div class="enemy-hp2">
<div class="enemy-hp-remain2 hp-green" style="width:'.$aluko_progress.'%"></div>
</div>
 ';
$aluko_log_q = mysql_query("SELECT * FROM `aluko_log` ORDER BY `time` DESC LIMIT 5");
echo '<center><font color="yellow">Лог боя</font><br>';
while($aluko_log = mysql_fetch_assoc($aluko_log_q)){
  
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$aluko_log['user_id']."'"));
echo '<a href="user.php?id='.$ank['id'].'">'.$ank['login'].'</a> '.$aluko_log['text'].'<br>';
}
echo '</center></div></div></div> </div></div></div> </div></div></div> ';
include './system/f.php';
exit;
}
mysql_query("INSERT INTO `aluko_log` SET `user_id`='".$user['id']."',`text`='".$aluko_sl[0]." <b>Дракона</b> на <b>".$my_atk."</b>',`time`='".time()."',`uron`='".$my_atk."'");
$_hp = rand(100,250);
$_mp = rand(50,50);
mysql_query("UPDATE `aluko` SET `health`=`health`-".$my_atk." WHERE `id`='".$aluko['id']."'");
mysql_query('UPDATE `users` SET `hp` = `hp` - '.$_hp.' WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `mp` = `mp` - '.$_mp.' WHERE `id` = "'.$user['id'].'"');
   $aluko_progress = round(100/($aluko['max_health']/$aluko['health']));
$all_uron = mysql_result(mysql_query("SELECT SUM( uron )FROM `aluko_log` WHERE `user_id`='".$user['id']."'"),0);
$perc_health_aluko = round($aluko['health']/$aluko['max_health']*100,2);
echo '   
<div class="center">
 <div class="bdr cnr f">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<center><img src="http://tjwar.ru/images/icon/odrakon.png"><br>  
Дракон - опасный,летающий монстр эпохи титанов,будь готов к всему. </center><br>



<center>Здоровье:<font color="blue"> '.$aluko['health'].'</font>/<font color="blue">'.$aluko['max_health'].'</font></center>
  <div class="enemy-hp2">
<div class="enemy-hp-remain2 hp-green" style="width:'.$aluko_progress.'%"></div>
</div>
<center>
<a class="btn" href="/drakon"><span class="end"><span class="label">Атаковать</span></span></a></span></span>';
$aluko_log_q = mysql_query("SELECT * FROM `aluko_log` ORDER BY `time` DESC LIMIT 3");
echo '</center></div></div></div> </div></div></div> </div></div></div>

<div class="bdr cnr f mb2 bl nd ">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><font color="yellow">Лог боя</font><br>';
while($aluko_log = mysql_fetch_array($aluko_log_q))
{
$row = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$aluko_log['user_id']."'"));
?>

<img src='/images/icon/race/<?=$row['r'].($row['online'] > (time() - 2000) ? '':'-off')?>.png' alt='*'/>
<a href='/user/<?=$row['id']?>/'>
<?=$row['login']?>
</a></span> | <?=$aluko_log['text'];?>
<div class='dot-line'></div>
<?
}
$queryLiders  = mysql_query("SELECT SUM( uron ) , `user_id`  FROM  `aluko_log`GROUP BY  `user_id` ORDER BY  SUM( uron ) DESC LIMIT 5");
?>
</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div> 
 <div class="bdr cnr f mb2 bl nd ">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<center>Топ 5 бойцов:</center>

<?
$alPos = 0;
while ($liders = mysql_fetch_array($queryLiders))
{
$alPos++;
$row = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$liders['user_id']."'"));
$damageUs = mysql_result(mysql_query("SELECT SUM( uron ) , `user_id` FROM  `aluko_log`WHERE `user_id`='".$liders['user_id']."'"),0);
?>  

<?=$alPos;?>.<img src='/images/icon/race/<?=$row['r'].($row['online'] > (time() - 100) ? '':'-off')?>.png' alt='*'/>
<a href='/user/<?=$row['id']?>/'>
<?=$row['login'];?></a></span>
<span class ='float:right;'/>
<?=$damageUs;?>
</span>
<div class ='separ'/></div>

 
<?
}
echo '</div></div></div> </div></div></div> </div></div>
 </div></div>';
include './system/f.php';
?>