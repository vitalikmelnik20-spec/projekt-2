<? 


include './system/common.php'; 
include './system/functions.php'; 
include './system/user.php'; 
  
if(!$user) { 
header('location: /');    
exit; 
} 

$title = 'Логово монстров'; 
$i = $user['lair']; // Этапы 

include './system/h.php';   
?> 

<div class='main'> 
<center>Одолей монстров - и получай награду в виде легендарных вещей!</center></div> 
<? 
if (isset($_SESSION['message'])){ 
?> 
<div class='mini-line'></div> 
<div class='content'> 
<?=$_SESSION['message']?> 
<? 
$w_chanse = rand(0,20); 
$chanse = rand(0,20) * rand(0,25); 
if($chanse < $w_chanse) { 
$w = mysql_query('SELECT * FROM `shop` WHERE `id` < 73 ORDER BY RAND() LIMIT 1'); 
$w = mysql_fetch_array($w); 

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `place` = "0" AND `user` = "'.$user['id'].'"'),0) + 1 < 20) { 
mysql_query('INSERT INTO `inv` (`user`, 
                                    `item`, 
                                   `bonus`, 
                                    `_str`, 
                                    `_vit`, 
                                    `_agi`, 
                                    `_def`) VALUES ("'.$user['id'].'", 
                                                       "'.$w['id'].'", 
                                                    "'.$w['bonus'].'", 
                                                     "'.$w['_str'].'", 
                                                     "'.$w['_vit'].'", 
                                                     "'.$w['_agi'].'", 
                                                     "'.$w['_def'].'")'); 

$w_id = mysql_insert_id(); 
$w = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$w_id.'"'); 
$w = mysql_fetch_array($w); 
$item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w['item'].'"'); 
$item = mysql_fetch_array($item); 
mysql_query('UPDATE `inv` SET `quality` = '.$item['quality'].' WHERE `id` = '.$w_id); 
?> 
<div class='separ'></div> 
<font color='#f0c060'>Новая вещь в твоей <img src='/images/icon/bag.png' alt=''/> <a href='/inv/bag/'><u>сумке</u></a>!</font><br/> 
<? 
switch($item['quality']) { 
case 0: 
$bonus = 0; 
$quality = 'Простой'; 
$quality_color = "#908060"; 
break; 

case 1: 
$bonus = 5; 
$quality = 'Обычный'; 
$quality_color = "#60c030"; 
break; 

case 2: 
$bonus = 10; 
$quality = 'Редкий'; 
$quality_color = "#6090c0"; 
break; 

case 3: 
$bonus = 15; 
$quality = 'Эпический'; 
$quality_color = "#c060f0"; 
break; 

case 4: 
$bonus = 20; 
$quality = 'Легендарный'; 
$quality_color = "#f06000"; 
break; 

case 5: 
$bonus = 50; 
$quality = 'Божественный'; 
$quality_color = "#909090"; 
case 6: 
$bonus = 65; 
$quality = 'Титанический'; 
$quality_color = "#909090"; 
case 7: 
$bonus = 25; 
$quality = 'Необычный'; 
$quality_color = "#c6f"; 

break; 
}  
?> 
<div align='center'> 
<table cellpadding='0' cellspacing='0'> 
<tr> 
<td><img src='/itemImage.php?id=<?=$w['item']?>' alt='*'/></td> 
<td valign='top' align='left' style='padding-left: 5px;'><img src='/images/icon/quality/<?=$item['quality']?>.png' alt='*'/> <a href='/item/<?=$w['id']?>/'><?=$item['name']?></a> 
<br/> 
<small><small> 
<font color="<?=$quality_color?>"><?=$quality?> [<?=$w['bonus']?>/<?=$bonus?>]</font> 
<? 
if($user['w_'.$item['w']] != 0) { 
$equip_item = mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$user['w_'.$item['w']].'"'); 
$equip_item = mysql_fetch_array($equip_item); 
if(($row['_str'] + $w['_vit'] + $w['_agi'] + $w['_def']) - ($equip_item['_str'] + $equip_item['_vit'] + $equip_item['_agi'] + $equip_item['_def']) > 0) { 
?> 
<font color='#30c030'>+<?=($w['_str'] + $w['_vit'] + $w['_agi'] + $w['_def']) - ($equip_item['_str'] + $equip_item['_vit'] + $equip_item['_agi'] + $equip_item['_def'])?></font>  
<? 
} 
}else{ 
?> 
<font color="#30c030">+<?=($w['_str'] + $w['_vit'] + $w['_agi'] + $w['_def'])?></font>  
<? 
} 
} 
} 
?> 
  </small></small></td></tr></table> 
</div> 
</center> 
</div></div> 
<? 
unset($_SESSION['message']); 
} 
// Имя монстров 
$name = array ( 
1 => 'Дух', 
2 => 'Люцифер', 
3 => 'Демон смерти', 
4 => 'Демон огня', 
5 => 'Призрак', 
6 => 'Талас', 
7 => 'Голем', 
8 => 'Минотавр', 
9 => 'Фараон', 
10 => 'Глава демонов' 
); 
# end 
if ($user['lair_time'] > time())  
{ 
?> 
                 <div class='mini-line'></div> 
                 <div class='main'> 
                 <table cellpadding='0' cellspacing='0'> 
                 <tr> 
                 <td><img src='/images/lair/<?=$i?>.png' alt='*'/></td> 
                 <td valign='top' style='padding-left: 5px;'><?=$name[$i]?> 
                 <br/> 
                 <small><small> 
                 Пройдено <?=$i?> из 10<br /> 
                 Осталось <?=date('i',$user['lair_time']-time());?> мин. 
                 </small></small></td></tr></table> 
                 </center> 
                 </small></small></td> 
                 </tr></table> 
                 </div> 
                 <div class='mini-line'></div> 
                 <div class='menuList'><li> Побеждая монстров вы получаете  
                 <img src='/images/icon/gold.png' alt=''/> золото в <a href='/lair.php'></a></li></div> 

<? 
}else{ 
?> 
                 <div class='mini-line'></div> 
                 <div class='main'> 
                 <table cellpadding='0' cellspacing='0'> 
                 <tr> 
                 <td><img src='/images/lair/<?=$i?>.png' alt='*'/></td> 
                 <td valign='top' style='padding-left: 5px;'><?=$name[$i]?> 
                 <br/> 
                 <small><small> 
                 Пройдено <?=$i?> из 10<br /> 
                 </small></small></td></tr></table> 
                 <a href='?target=<?=$i?>' class='btn'><span class='end'><span class='label'>Атаковать</a></span></span> 
                 </center> 
                 </small></small></td> 
                 </tr></table> 
                 </div> 
                 <div class='mini-line'></div> 
                 <div class='menuList'><li> Побеждая монстров вы получаете  
                 <img src='/images/icon/gold.png' alt=''/> золото в <a href='/lair.php'></a></li></div> 
<? 
} 
// Нападение против монстра 
if(isset($_GET['target'])) { 
// Переадресация если время не истекло 
if ($user['lair_time'] > time()) 
{ 
header("Location: /lair.php"); 
exit; 
} 
// Если hp OR mp по 0 
if($user['hp'] < 0 OR $user['mp'] < 250) { 
?> 
<div class='mini-line'></div> 

<div class='main' align='center'> 
<font color='#c06060'>Для нападения надо минимум <img src='/images/icon/health.png' alt='*'/> 10% жизни и <img src='/images/icon/mana.png' alt='*'/> 250 маны</font> 
<div class='separ'></div> 

<table cellpadding='0' cellspacing='0'> 
<tr> 

<td><img src='/images/alchemy/potion.png' alt='*'/></td> 
<td valign='top' style='padding-left: 5px;' align='left'><b>Настойка бодрости</b><br/> 
<small><small>+100% маны и жизни</small></small></td> 
</tr></table> 

<div class='separ'></div> 
<div align='center'><a href='/lab/wiz/?potion=true&referal=/lair.php' class='btn'><span class='end'><span class='label'>Купить</a></span></span><br/><br/> 
<font color='#909090'>Цена: <img src='/images/icon/gold.png' alt='*'/> 15 золота</font> 
</div> 
</div> 
<div class='mini-line'></div> 
<? 
include './system/f.php'; 
exit; 
} 


// Система урона 
$dmg = round(rand(($user['agi']/7),($user['str']/4))); 
$dmg_opp = round(rand(($user['str']/6),($user['agi']/3))); 


if($dmg > $dmg_opp) { 

$gold += rand(25,45) * $user['level']; 
$_exp +=  rand(1,5)  * $user['level']; 
mysql_query('UPDATE `users` SET  
                              `g` = "'.($user['g'] + $gold).'", 
                              `exp` = "'.($user['exp'] + $_exp).'", 
                              `lair` = "'.($user['lair'] + 1).'", 
                              `lair_time` = "'.(time() + 2700).'", 
                              `hp` = "'.($user['hp'] - $dmg_opp).'", 
                              `mp` = "'.($user['mp'] - 250).'" WHERE `id` = "'.$user['id'].'"'); 
if($user['lair'] >= 10) { 
mysql_query('UPDATE `users` SET  
                              `lair` = "1" WHERE `id` = "'.$user['id'].'"'); 
} 

$_SESSION['message'] = "<center>Вы победили <div class='separ'></div> Вы получили <img src='/images/icon/gold.png' alt='*'/> $gold золота и <img src='/images/icon/exp.png' alt='*'/> $_exp"; 
header("Location: /lair.php"); 
exit; 
}else{ 
$silver += rand(40,60) * $user['level']; 
mysql_query('UPDATE `users` SET  
                               `s` = "'.($user['s'] + $silver).'", 
                               `lair_time` = "'.(time() + 2700).'", 
                               `hp` = "'.($user['hp'] - $dmg_opp).'", 
                               `mp` = "'.($user['mp'] - 250).'" WHERE `id` = "'.$user['id'].'"'); 
if($user['lair'] >= 10) { 
mysql_query('UPDATE `users` SET  
                              `lair` = "1" WHERE `id` = "'.$user['id'].'"'); 
} 
$_SESSION['message'] = "<center>Вы проиграли <div class='separ'></div> Вы получили <img src='/images/icon/silver.png' alt='*'/> $silver  серебра"; 
header("Location: /lair.php"); 
exit; 
} 
} 
include './system/f.php'; 
?>