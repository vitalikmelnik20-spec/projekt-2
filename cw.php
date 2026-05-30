<?php



// root path
define ("ROOT", $_SERVER['DOCUMENT_ROOT']);

// load all system components
foreach (array (
				ROOT . "/system/common.php",
				ROOT . "/system/functions.php",
				ROOT . "/system/user.php"
) as $file) {
				require $file;
}


// require login
if (!isset ($user)) {
				header ("location: /");
exit;
}


// check
$query = mysql_query ("SELECT `clans`.`g` as `gold`, `clan_memb`.* FROM `clan_memb` LEFT JOIN `clans` ON `clans`.`id`=`clan_memb`.`clan` WHERE (`clan_memb`.`user`='$user[id]')");
if (mysql_num_rows ($query)!=0)
				$c = mysql_fetch_array ($query);

// header
				$title = "Клановые войны";
				
$self = 'Клановые войны';
$inFight = mysql_num_rows(mysql_query("SELECT `id`,`self` FROM `users` 
                                    WHERE `self`='".($self)."' and 
                                    `online`>'".(time()-300)."'"));
				
require ROOT . "/system/h.php";

?>



<?php

// configurations
define ("TIME",   3600 * 3); // откат мероприятия (3  часа)
define ("DURATION", 1800); // продолжительность мероприятия (30 минут)
define ("PRICE", 		  1000); // стоимость подачи заявки (1000 золота)
define ("ATTACK_DELAY", 5);
define ("_1st", 500000); // награда за первое место
define ("_2st", 400000); // за 2е
define ("_3st", 300000); // за 3е
define ("_4st", 200000); // за 2е
define ("_5st", 100000);

if (isset ($_SESSION['messages'])) {
?>
<div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
<?php
		foreach ($_SESSION['messages'] as $messages) {
				
?>

		<?=$messages?><br/>

<?php			
		}
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
		<?php
unset ($_SESSION['messages']);
}

?>

<ul style='list-style:none;padding:0px;margin:0px;' class='menu'>

<?php

if (mysql_num_rows (mysql_query ("SELECT * FROM `cw_event`"))!=0) {
				$e = mysql_fetch_array (mysql_query ("SELECT * FROM `cw_event` ORDER BY `id` DESC LIMIT 1"));
				
				if ($e['start']==0 and $e['time']<=time ()) {
								mysql_query ("UPDATE `cw_event` SET `start`='1',`time`=`time`+" . DURATION . " WHERE (`id`='$e[id]')");
								header ('location: /cw.php');
				}
				if ($e['start']==1 and mysql_num_rows (mysql_query ("SELECT * FROM `cw_clans` WHERE (`id_event`='$e[id]')"))==1) {
								mysql_query ("UPDATE `cw_event` SET `end`='1' WHERE (`id`='$e[id]')");
								mysql_query ("INSERT INTO `cw_event` (`start`,`end`,`time`) VALUES ('0','0','" . (time ()+TIME). "')");
				}
				
				if ($e['start']==1 and $e['end']==0 and $e['time']<=time ()) {
								mysql_query ("UPDATE `cw_event` SET `end`='1' WHERE (`id`='$e[id]')");
								mysql_query ("INSERT INTO `cw_event` (`start`,`end`,`time`) VALUES ('0','0','" . (time ()+TIME). "')");
								$messages = "<h3>Турнир завершен</h3>";
								$i = 0;
								$q = mysql_query ("SELECT `clans`.*,`cw_clans`.`kp` FROM `cw_clans` LEFT JOIN `clans` ON `clans`.`id`=`cw_clans`.`id_clan` WHERE (`cw_clans`.`id_event`='$e[id]') ORDER BY `cw_clans`.`kp` DESC LIMIT 3");


								while ($_c = mysql_fetch_array ($q)) {
									
												$i++;
												$messages.= "$i. <a href='/clan/$_c[id]'>$_c[name]</a> <img src='/images/icon/exp.png' alt=''/> ";

												if ($i==1) {
mysql_query ("UPDATE `clans` SET `exp`=`exp`+" . _1st . " WHERE (`id`='$_c[id]')");															
														$messages.= _1st .  " Опыта";
												}
												elseif ($i==2) {
mysql_query ("UPDATE `clans` SET `exp`=`exp`+" . _2st . " WHERE (`id`='$_c[id]')");	
$messages.= _2st .  " Опыта";																
												}
												elseif ($i==3) {
mysql_query ("UPDATE `clans` SET `exp`=`exp`+" . _3st . " WHERE (`id`='$_c[id]')");
																$messages.= _3st .  " Опыта";
																
												}
																elseif ($i==4) {
mysql_query ("UPDATE `clans` SET `exp`=`exp`+" . _4st . " WHERE (`id`='$_c[id]')");	
$messages.= _4st .  " Опыта";																
												}
												elseif ($i==5) {
mysql_query ("UPDATE `clans` SET `exp`=`exp`+" . _5st . " WHERE (`id`='$_c[id]')");
																$messages.= _5st .  " Опыта";
												}
												$messages.=" ($_c[kp]  убийств за турнир)<br/>\n";





								
								$topes_us.= '<span class="login"> '.$i.' '.$_c['name'].' ('.$_c['kp'].'  убийств за турнир) <br></font>';
											
								}

mysql_query("INSERT INTO `chat` SET `user`='3', `user_id`='1', `text`='Турнир завершен</br>' '".$topes_us."', `time`=".time()."");
								$_SESSION['messages'][] = $messages;
								header ('location: /cw.php'); // будет перенаправлять на кланвары..

								
				}
				
				$q = mysql_query ("SELECT * FROM `cw_memb` WHERE (`id_event`='$e[id]') AND (`id_user`='$user[id]')");
				if ($e['start'] == 1 and mysql_num_rows ($q)!=0) {
				
				
								$m = mysql_fetch_array ($q);
								if ($m['hp']==0) {
?>
				<div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
								Вас убили, дождитесь окончания турнира! | <?=ceil (($e['time']-time ())/60)?> мин.
				</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php								
										
								}
								else {
												
  										$_GET['change'] = isset ($_GET['change']) ? intval ($_GET['change']) : 0;
											if ($_GET['change']==1) {

																$query = mysql_query ("SELECT * FROM `cw_memb` WHERE (`id_event`='$e[id]') AND (`id_clan`!='$m[id_clan]') ORDER BY RAND()");
																if (mysql_num_rows ($query)!=0) {
																		
																				$opponent = mysql_fetch_array ($query);
																				mysql_query ("UPDATE `cw_memb` SET `id_opponent`='$opponent[id]' WHERE (`id_event`='$m[id_event]') AND (`id_user`='$m[id_user]')");		

																}

																header ('location:/cw.php');
																exit;
												}
  										$_GET['regeneration'] = isset ($_GET['regeneration']) ? intval ($_GET['regeneration']) : 0;
											if ($_GET['regeneration']==1) {
															if ((time () - $m['last_regeneration'])>60) {
																			mysql_query ("UPDATE `cw_memb` SET `hp`='" . ceil (($user['vit']*2)) . "',`last_regeneration`='" . time () . "' WHERE (`id`='$m[id]')");		
															}
																header ('location:/cw.php');
																exit;
												}


?>
				<div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
								До конца <?=_time($e['time']-time ())?> мин.
								<span style='float:left;'><img src='/images/icon/health.png' alt=''/> <?=$m['hp']?></span>
				</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php
												if ($m['id_opponent']!=0) {
																$cw_opponent = mysql_fetch_array (mysql_query ("SELECT * FROM `cw_memb` WHERE (`id`='$m[id_opponent]')"));
																if ($cw_opponent['hp']!=0) {
																				$opponent = mysql_fetch_array (mysql_query ("SELECT * FROM `users` WHERE (`id`='$cw_opponent[id_user]')"));


												$_GET['attack'] = isset ($_GET['attack']) ? intval ($_GET['attack']) : 0;
												if ($_GET['attack']==1) {
																if (time () - $m['last_attack']<ATTACK_DELAY) {
																				header ('location: /cw.php'); exit;
																}
																
																// current damage
																$dmg = 0;
														
																

																// ablitities
																// 0 - don't active, 1 - active
																$ability_1 = 0;
																$ability_2 = 0;
																$ability_3 = 0;
																$ability_4 = 0;
																
																		
																		if ($user['ability_1']!=0) {
																		
																				$ability_1_b = 20 + ($user['ability_1']*5) - 5;
																				$ability_1_c = 5 	+ ($user['ability_1']*3) - 3;

																				if (mt_rand(0, 100) <= $ability_1_c)
																						$ability_1 = 1;
																		
																		}
																		
																		

																		if ($user['ability_2']!=0) {
																		
																				$ability_2_b = 20 + ($user['ability_2']*5) - 5;
																				$ability_2_c = 5 	+ ($user['ability_2']*3) - 3;

																				if (mt_rand(0, 100) <= $ability_2_c)
																						$ability_2 = 1;
																		
																		}

																		

																		if ($user['ability_3']!=0) {
																		
																				$ability_2_b   = 5 + ($user['ability_3']*3) - 3;
																				$ability_2_c   = 5 + ($user['ability_3']*2) - 2;
																				$ability_2_c_c = 20+ ($user['ability_3']*5) - 5;


																				if (mt_rand(0, 100) <= $ability_3_c)
																						$ability_3 = 1;
																		
																		}
																		


																		if ($user['ability_4']!=0) {
																		
																				$ability_2_b = 20 + ($user['ability_4']*2) - 2;
																				$ability_2_c = 5 	+ ($user['ability_4']*5) - 5;

																				if (mt_rand(0, 100) <= $ability_4_c)
																						$ability_4 = 1;
																		
																		}
																		
																		

																		$dmg += ceil (rand(($user['str']/6), ($user['str']/4)));
																		
																		if ($ability_1==1) {
																				$dmg += ceil (($dmg / 100) * $ability_1_b);
																		}

																		$dmg -= ceil (rand(($opponent['def']/12), ($opponent['def']/7)));        
																		
																		if ($dmg < 0)
																				$dmg = 0;

																		$crit = $ability_1==1?((rand (1,2)*($user['agi']/100)+$ability_3_c_c)-(rand (1,2)*($opponent['agi']/100))):((rand (1,2)*($user['agi']/100))-(rand (1,2)*($opponent['agi']/100)));
																		
																		if (mt_rand(0, 100) <= $crit) {   
																		
																				$dmg *= 2;

																				if($ability_3 == 1) {							 
																						$dmg += ceil (($dmg/100)*$ability_3_b);								
																				}    
																		
																		}

																		$dodge = ((rand (1,3)*($opponent['agi']/100))-(rand (1,3)*($user['agi']/100)));
														
																		if(mt_rand(0, 100) <= $dodge)
																				$dmg = 0;
																
																		
																		if ($dmg>$cw_opponent['hp']) {
																						$dmg = $cw_opponent['hp'];
																		
																						mysql_query ("UPDATE `cw_clans` SET `kp`=`kp`+1 WHERE (`id_event`='$e[id]') AND (`id_clan`='$m[id_clan]')");
																						mysql_query ("INSERT INTO `cw_log` (`id_event`,`text`) VALUES ('$e[id]','$user[login] убил $opponent[login]')");
																		}
																		
																mysql_query ("UPDATE `cw_memb` SET `hp`=`hp`-$dmg WHERE (`id`='$m[id_opponent]')");
																mysql_query ("UPDATE `cw_memb` SET `last_attack`=" . time () . " WHERE (`id`='$m[id]')");
												?>
<div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
<?php
																if ($dmg==0) {
mysql_query ("INSERT INTO `cw_log` (`id_event`,`text`) VALUES ('$e[id]','$user[login] попытался ударить $opponent[login]')");
?>
																Вы промахнулись
<?php				
}
else
{
mysql_query ("INSERT INTO `cw_log` (`id_event`,`text`) VALUES ('$e[id]','$user[login] нанес $opponent[login] $dmg урона')");
?>
																Вы нанесли <b><?=$dmg?></b> урона
												<?php
																}
															if ($ability_1!=0 || $ability_2!=0 || $ability_3!=0 | $ability_4!=0) {
?>
														<div class='separator'></div>

<?php
																		if($ability_1==1) {
												?>
														<img src='/images/ability/1.<?=$user['ability_1_quality']?>.png' style='width:25px;height:25px;' alt=''/>
												<?php
																		}
																		if($ability_2==1) {
												?>
														<img src='/images/ability/2.<?=$user['ability_2_quality']?>.png' style='width:25px;height:25px;' alt=''/>
												<?php
																		}
																		if($ability_3==1) {
												?>
														<img src='/images/ability/3.<?=$user['ability_3_quality']?>.png' style='width:25px;height:25px;' alt=''/>
												<?php
																		}
																		if($ability_4==1) {
												?>
														<img src='/images/ability/4.<?=$user['ability_4_quality']?>.png' style='width:25px;height:25px;' alt=''/>
												<?php
																		}
																}
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
<?php
}

$i_clan2 = mysql_query('SELECT * FROM `clan_memb` WHERE `id_event` = "'.$cw_opponent['id'].'"');
    $i_clan2 = mysql_fetch_array($i_clan2);


$i_clan = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$cw_opponent['id_clan'].'"');
    $i_clan = mysql_fetch_array($i_clan);
	$i_clan_memb = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$cw_opponent['id_user'].'"');
  $i_clan_memb = mysql_fetch_array($i_clan_memb);

	switch($i_clan_memb['rank']) {
  
    case 0:
    $rank = 'Новобранец';
     break;
    case 1:
    $rank = 'Боец';
     break;
    case 2:
    $rank = 'Офицер';
     break;
    case 3:
    $rank = 'Генерал';
     break;
    case 4:
    $rank = '<font color=\'#30c030\'>Лидер клана</font>';
     break;
    
  }
$clan_vsego = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_memb` WHERE `clan` = "'.$i_clan['id'].'"'),0);
//$clab_ubit = mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_memb` WHERE `hp` = "'.($cw_opponent['id'] == 0).'"'),0);
$clan_onlaiv = mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_memb` WHERE `id_clan` = "'.$i_clan['id'].'" AND  `last_attack` > "'.(time() - 160).'"'),0);
$clab_ubit = mysql_result(mysql_query("SELECT SUM(`hp`='0') FROM `cw_memb` WHERE (`id_event`='$e[id]') AND (`id_clan`='$cw_opponent[id_clan]')"),0);

?>


<div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
<font color='#FFCC00'><img src='/images/icon/clan/<?=$i_clan['r']?>.png' alt='*'/> <?=$i_clan['name']?>,</font> <font color='#009E00'>всего бойцов <img src='/images/icon/clan/<?=$i_clan['r']?>.png' alt='*'/> <?=$clan_vsego?></font>, в бою <?=$clan_onlaiv?>, <font color='#FD310E'>убитых <img src='/images/icon/race/bot.png' alt='*'/> <?=$clab_ubit;?></font><br/></div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>


  <div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
								<br><b><font color='#FFCC00'><img src='/images/icon/race/<?=$opponent['r']?>.png' alt='*'/> <?=$opponent['login']?></font>, <?=$rank?></b><br/><br/>
								<font color='#969696'>Противника параметры:</font><br/>
<img src='/images/icon/str.png' alt='*'/> <?=$opponent['str']?> <img src='/images/icon/vit.png' alt='*'/> <?=$opponent['vit']?> <img src='/images/icon/agi.png' alt='*'/> <?=$opponent['agi']?> <img src='/images/icon/def.png' alt='*'/> <?=$opponent['def']?>
                  <font color='#969696'><br>Ваши параметры:<br/></font>

      <img src='/images/icon/str.png' alt='*'/> <font color="
  
<?
if($opponent['str'] < $user['str']) {
$diff += $opponent['str'] - $user['str'];
?>#009E00<? 
    
    }
    else
    {

?>#FF6600<?
    
    }
?>
">  <?=$user['str']?></font>
  <img src='/images/icon/vit.png' alt='*'/> <font color="
  
<?
if($opponent['vit'] < $user['vit']) {
    
      $diff += $opponent['vit'] - $user['vit'];
    
?>#009E00<? 
    
    }
    else
    {

?>#FF6600<?
    
    }
    

?>
  
  ">  <?=$user['vit']?></font>
  <img src='/images/icon/agi.png' alt='*'/> <font color="
  
<?
if($opponent['agi'] < $user['agi']) {
    
      $diff += $opponent['agi'] - $user['agi'];
    
?>#009E00<? 
    
    }
    else
    {

?>#FF6600<?
    
    }
    

?>
  
  ">  <?=$user['agi']?></font>
  <img src='/images/icon/def.png' alt='*'/> <font color="
  
<?

    if($opponent['def'] < $user['def']) {
    
      $diff += $opponent['def'] - $user['def'];
    
?>#009E00<? 
    
    }
    else
    {

?>#FF6600<?
    
    }
    

?>
  
  ">  <?=$user['def']?></font><br/>

             
                            
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div></div>
       <div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>                         
                                
<?php
				if ((time () - $m['last_attack'])>ATTACK_DELAY) {

?>								<a href='/cw.php?attack=1' class='button'>Атаковать</a><br/>
<?php
				}
				else {
?>
				До удара <?=(ATTACK_DELAY - (time () - $m['last_attack']))?> сек<br/>
				<a href='/cw.php' class='button'>Обновить</a><br/>
<?php
				}
?>
								<a href='/cw.php?change=1' class='button'>Сменить противника</a><br/>
<?php
				if ((time () - $m['last_regeneration'])>60) {
?>
								<a href='/cw.php?regeneration=1' class='button'>Восстановиться</a>
<?php				
				}

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

<?php																				
																				
																				
																}
																else {
?>
				<div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
								Ваш противник убит<br/>
								<a href='/cw.php?change=1' class='button'>Найти противника</a>
				</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php																				
																}
												}
												else {											
?>
				<div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
								У вас нет противника!<br/>
								<a href='/cw.php?change=1' class='button'>Найти противника</a>
				</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php												
												}
								}
								
								$q = mysql_query ("SELECT * FROM `cw_log` WHERE (`id_event`='$e[id]') ORDER BY `id` DESC LIMIT 10");
								while ($log = mysql_fetch_array ($q)) {
?>
<div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8">
<?=$log['text']?>
</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php
								}
				
				
				}
				else {
								if ($e['start']==1) {
?>												
				 <div class="bdr cnr f mb2 bl nd ">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
								Битва в самом разгаре!<br/>
								До конца остается <?=ceil (($e['time']-time ())/60)?> мин.<br/>
</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php												
								}
								else {
								
												$_GET['register'] = isset ($_GET['register']) ? intval ($_GET['register']) : 0;


				if (isset ($c)) {
								if (mysql_num_rows (mysql_query ("SELECT * FROM `cw_clans` WHERE (`id_event`='$e[id]') AND (`id_clan`='$c[clan]')"))==0) {
												if ($c['rank']==4 OR $c['rank']==3) {
																// register clan at event
																if ($_GET['register']==1) {
if($clan) {

	$topes_us.= '<span class="login"><font color="90c0c0"></span>Наш клан участвует в турнире кланов!!!</font>';
	mysql_query("INSERT INTO `chat` SET `clan`= '".$clan['id']."', `read` ='0', `user`='3', `user_id`='1', `text`='".$topes_us."', `time`='".time()."'");
}
																				if ($c['gold']>=PRICE) {
																								
																								mysql_query ("INSERT INTO `cw_clans` (`id_event`,`id_clan`,`kp`) VALUES ('$e[id]','$c[clan]','0')");
																								mysql_query ("UPDATE `clans` SET `g`=`g`-" . PRICE . " WHERE (`id`='$c[clan]')");
																								$query = mysql_query ("SELECT `users`.* FROM `clan_memb` LEFT JOIN `users` ON `users`.`id`=`clan_memb`.`user` WHERE (`clan_memb`.`clan`='$c[clan]')");
																								while ($m = mysql_fetch_array ($query)) {
																												mysql_query ("INSERT INTO `cw_memb` (`id_event`,`id_clan`,`id_user`,`hp`,`id_opponent`) VALUES ('$e[id]', '$c[clan]', '$m[id]', '" . ($m['vit']*2) . "','0')");

																								}
																				}
																				
																				header ('location:/cw.php');																
																}
												}
?>
				 <div class="bdr cnr f mb2 bl nd ">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
                <img src='/images/barbars/cw.png' width='100%' alt='*'/>
  <?

?>
                Турнир начнется через <?=_time($e['time']-time ())?> мин.</br>
				Всего кланов <?=mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_clans` WHERE (`id_event`='.$e['id'].')'),0)?><br><br>
                <?
												
												if ($c['rank']==4 OR $c['rank']==3) {
                ?>
				  <a href="/cw.php?register=1" class='button'>Подать заявку</a><br/>Цена: <img src="/images/icon/gold.png " alt 'g'><?=PRICE?> золота
<?
									}
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
<?php
}else {
?>
 <div class="bdr cnr f mb2 bl nd ">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8" align='center'>
<img src='/images/barbars/cw.png' width='100%' alt='*'/>
								Ваш клан учавствует в турнире!<br/><br><a href='/cw.php' class='button'>Обновить</a><br><br>
								Турнир начнется через <?=_time($e['time']-time ())?> мин.</br>Всего кланов <?=mysql_result(mysql_query('SELECT COUNT(*) FROM `cw_clans` WHERE (`id_event`='.$e['id'].')'),0)?>

				</div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php								
								}

				}

?>
				
				<div class="bdr cnr f mb2 bl nd">
<div class="wr1"><div class="wr2"><div class="wr3"><div class="wr4"><div class="wr5"><div class="wr6"><div class="wr7"><div class="wr8"><span style="color: #999999; font-size: 12px;"> В процессе турнира, участники одного клана сражаются с участниками другого клана зарабатывая очки убийств.<br/>
								Клан набравший больше всех очков убийств выигрывает.</br></span>
<span style="color: #FF9900; font-size: 12px;">Награда за первое место 500 000 опыта в клан.</br>Награда за второе место 400 000 опыта в клан.</br>Награда за третье место 300 000 опыта в клан.</br>Награда за четвертое место 200 000 опыта в клан.</br>Награда за пятое место 100 000 опыта в клан.</br></span></div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
<?php

								}
				}

} 
else {

				mysql_query ("INSERT INTO `cw_event` (`start`,`end`,`time`) VALUES ('0','0','" . (time ()+TIME). "')");
				header ('location:/cw.php');
				
}

?>

</ul>

<?php

// footer
require ROOT . "/system/f.php";