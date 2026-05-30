<?

include '../system/common.php';  
include '../system/functions.php';
include '../system/user.php';  

if(!$user) header('location: /');
$title = 'Повелитель мрака';
include '../system/h.php';
    $damageUs = mysql_result(mysql_query("SELECT SUM( uron ) , `user_id`  
                            FROM  `monst_log`
                            WHERE `user_id`='$user_id'"),0);

							
if($_GET['travma'] == true){
if($user['g'] < 550){ echo 'Не хватает <img src=\'/images/icon/gold.png\' alt=\'*\'/> '.(550 - $user['g']).' золота<div class=\'separ\'></div><a href=\'/trade/\'>Купить</a>';}
  $query = mysql_query('SELECT * FROM `travma` WHERE `user` = \''.$user['id'].'\'');
    $inv = mysql_fetch_array($query);
  if($inv) {  
    mysql_query('UPDATE `users` SET `g` = `g`-550,`str` = `str`+150 WHERE `id` = \''.$user['id'].'\'');
    mysql_query('DELETE FROM `travma` WHERE `user` = \''.$user['id'].'\'');
}
}							

$df1=  round(rand($user['def']/15,$user['def']/17));
$df2 = round(rand($user['agi']/15,$user['agi']/17));
$aluk_def = round(rand($df1,$df2));
$my_atk = round(rand($user['str']/12,$user['str']/15)-$aluk_def);

$df1=  round(rand($lord['str']/6,$user['str']/4));
$user_def = round(rand($df1));
$my_atacked = round(rand($user['str']/6,$user['str']/4)-$user_def);



if ($my_atk<1){$my_atk = $user['level']+rand($user['level'],$user['level']/2);}
$monst = mysql_fetch_assoc(mysql_query("SELECT * FROM `monst` ORDER BY `id` LIMIT 1"));




if($monst['health']==0){
echo '<div class="player"><br/>
<center><b><font size="3" color="MediumSlateBlue">..::Повелитель мраков убит!::..</font><br/><br/>
<font size="3" color="indianred">Завершено!</font></b>
<br/></center><br/>
<center><font size="1" color="orange">* Акция длится 12 часов!</font>
</center>
</div>';
    include './system/f.php';
   mysql_query("UPDATE `monst` SET `dead` = '0', `id` = '1', `max_health` = '1000000', `s` = '5000000', `g` = '5000000', `exp` = '10000000'");

    exit;
    }
    
if($my_atk >$monst['health'] && $monst['health']<0)
{
    mysql_query("UPDATE `monst` SET `health`=0 WHERE `id`='".$monst['id']."'")or die (mysql_error());
echo '<div class="player"><br/>
<center><b><font size="3" color="MediumSlateBlue">..::Повелитель мрака::..</font><br/><br/>
<font size="3" color="indianred">Завершено!</font></b>
<br/></center><br/>
<center><font size="1" color="orange">* Акция длится 12 часов!</font>
</center>
</div>';

$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `monst_log`"),0);
        if($total>0){
$q_nagr = mysql_query("SELECT * FROM `monst_log` GROUP BY `user_id` ORDER BY RAND()");
/*3 лучших */
$top_q  = mysql_query("SELECT SUM( uron ) , `user_id`     FROM  `monst_log` GROUP BY  `user_id` ORDER BY  SUM( uron ) DESC LIMIT 10"); 
$topes_us = 'Лучшие в бою с Повелитилем мрака:<br> ';
while($top= mysql_fetch_assoc($top_q)){
//Расчёт награды
$max_uron = mysql_result(mysql_query("SELECT SUM( uron ) FROM `monst_log` WHERE `user_id`='".$top['user_id']."'"),0);
$moneyReward = $max_uron/4;
// Пишем в журнал
if($max_uron >0){
mysql_query("INSERT INTO `journal` SET `from`='".$top['user_id']."',`text`='Вы один из лучших (нанесли ".$max_uron." урона).',`time`='".time()."'"); 
}
$name_top = mysql_fetch_assoc(mysql_query("SELECT `login` FROM `users` WHERE `id`='".$top['user_id']."' LIMIT 10"));
$topes_us.= '<span class="login">'.$name_top['login'].'</span>('.$max_uron.')<br>'; 
                $monst['g']=$monst['g']-1;
				$monst['s']=$monst['s']-1;
                $monst['exp']=$monst['exp']-1;
}
mysql_query("INSERT INTO `chat` SET `user`='1', `text`='".$topes_us."', `time`='".time()."'");
#sleep(1);
//////
mysql_query("TRUNCATE TABLE  `monst_log`");
}
include './system/f.php';
exit;}
    
$user['vit'] = $user['hp']-$my_atacked;    
$monst_sila = array('Простой удар','Прицельный удар','Магический удар','Удар возмездии','Сокрушительный удар');
shuffle($monst_sila);
$rand_m = rand(1,500);
?>
<?
$rand_g = rand(0,2);
$rand_s = rand(0,3000);
$rand_exp = rand(0,7000);
$gg = '<img src="/images/icon/vit.png">';
$g = '<img src="/images/icon/gold.png">';
$s = '<img src="/images/icon/silver.png">';
$exp = '<img src="/images/icon/exp.png">';

if($user['hp']<100){
echo '<div id="error"><font color="#c06060"><center>Дождитесь окончания боя или восстановите у колдуна здоровье и ману!</font></center></div>';
echo'<center>Здоровье дракона:<font color="yellow"> '.$monst['health'].'</font>/<font color="red">'.$monst['max_health'].'</font></center>';
$monst_log_q = mysql_query("SELECT * FROM `monst_log` ORDER BY `time` DESC LIMIT 5");
echo '</div><div class="main"><div class="block_zero"><center><font color="yellow">Лог боя</font><br>';
while($monst_log = mysql_fetch_assoc($monst_log_q)){
$ank = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$monst_log['user_id']."'"));
echo '<a href="user.php?id='.$ank['id'].'">'.$ank['login'].'</a> '.$monst_log['text'].'<br>';
}
echo '</center>';
include './system/f.php';
exit;
}
if (isset($_GET['attack']))
{
    mysql_query("INSERT INTO `monst_log` SET
    `user_id`='".$user['id']."',
`text`='ударил на <font color=red><b>".$my_atk."</b></font> ".$gg." и украл у него <b>".$rand_g." ".$g." </b>, <b>".$rand_s." ".$s." </b>, <b>".$rand_exp." ".$exp." </b>',
    `time`='".time()."',
    `uron`='".$my_atk."'");

    mysql_query("UPDATE `monst` SET `health`=`health`-".$my_atk.", `g`=`g`-".$rand_g.", `s`=`s`-".$rand_s.", `exp`=`exp`-".$rand_exp." WHERE `id`='".$monst['id']."'");
	mysql_query("UPDATE `users` SET  `exp`=`exp`+".$rand_exp.", `g`=`g`+".$rand_g.",`s`=`s`+".$rand_s."  WHERE `id`='".$user['id']."'");
    $all_uron = mysql_result(mysql_query("SELECT SUM( uron )FROM `monst_log` WHERE `user_id`='".$user['id']."'"),0);
    $perc_health_monst = round($monst['health']/$monst['max_health']*100,2);
    header("Location: ?");
    exit;
}
else
{

    mysql_query("INSERT INTO `monst_log` SET
    `lords`='".$monst['id']."',
    `text`='<font color=orange>Повелитель мрака</font> ударил ".$user['login']." на <font color=red><b>".$my_atacked."</b> ".$gg."</font>',
    `time`='".time()."',
    `udar`='".$my_atacked."'");
    mysql_query("UPDATE `users` SET `hp`=`hp`-".$my_atacked." WHERE `id`='".$user['id']."'");
    $all_uron = mysql_result(mysql_query("SELECT SUM( udar )FROM `monst_log` WHERE `lords`='".$monst['id']."'"),0);
    $perc_health_lord = round($user['health']/$user['max_health']*100,2);
}
$monst_progress = round(100/($monst['max_health']/$monst['health']));

?>  
<div class='main'>
<?
echo'<table cellpading="0" cellspacing="0"><tbody><tr><td><img src="/images/lair/3.png"/></td>
<td valign="top" style="padding-left: 5px;"><font color="red">Повелитель Мрака</font><br/>
<small><div class="hp_line"><div class="hp_line_fill hp-orange" style="width:'.$monst_progress.'%"></div><div class="hp_line_text">'.$monst['health'].' / '.$monst['max_health'].'</div></div></small>
<div class="mini-line"></div>
<div class="mt5 c-sky"><span class=""><small>Доступные доргоценности: '.n_f($monst['g']).'<img src="/images/icon/gold.png"> | '.n_f($monst['s']).'<img src="/images/icon/silver.png"> | '.n_f($monst['exp']).'<img src="/images/icon/exp.png"></small></span></div><br/>
<a class="btn" href="?attack"><span class="end"><span class="label">Атаковать</span></span></a>

</td></tr></tbody></table><br/>';
echo '<div class="mini-line"></div>';
$monst_log_q = mysql_query("SELECT * FROM `monst_log` ORDER BY `time` DESC LIMIT 5");
echo '</div></div>';
echo '
<div class="main"><div class="block_zero center"><font color="red">Журнал боя</font></div><div class="mini-line"></div></div>';
while($monst_log = mysql_fetch_array($monst_log_q)){
$row = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$monst_log['user_id']."'"));
?>
<div class ='main'><div class='block_zero'><small>
<a href='/pers_info/<?=$row['id']?>/'><?=$row['login']?></a></span>  <?=$monst_log['text'];?>
</small></div></div>
<div class ='mini-line'/></div>
<?
}?>
<div class ='mini-line'/></div>

<div class='main'>
<table cellpading="0" cellspacing="0"><tbody><tr><td><img src="http://144.76.125.123/maneken/h_114_115_108_37_126_119_161_168_2217559194_avatar0.png?1.3.69" class="radius" height="48" alt=""/></td>
<td valign="top" style="padding-left: 5px;"><span class='dgreen'><?=$user['login']?></span><br/>
<?
$hp_progress = round(100/($user['vit']/$user['hp']));
?>
<small><div class="hp_line"><div class="hp_line_fill hp-orange" style="width:<?=$hp_progress;?>%"></div><div class="hp_line_text"><?=$user['vit'];?> / <?=$user['hp'];?></div></div></small><br/>
<small><img src='/images/icon/str.png'> <?=$user['str'];?> <img src='/images/icon/agi.png'> <?=$user['agi'];?> <img src='/images/icon/def.png'> <?=$user['def'];?> <img src='/images/icon/vit.png'> <?=$user['vit'];?></small>
</td></tr></tbody></table>
</div></div>

<?
include '../system/f.php';
?>

