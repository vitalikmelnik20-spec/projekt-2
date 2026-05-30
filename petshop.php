<?php
include 'system/common.php';
include 'system/functions.php';
include 'system/user.php';
$title='Магазин питомцев';
include 'system/h.php';
if (!isset ($user)) {header('location: /');exit;}
$pet_id= _string(_num($_GET['pet_id']));
$pet_u = mysql_query('SELECT * FROM `pet_u` WHERE `user_id` = "'.$user['id'].'"');
$pet_u = mysql_fetch_array($pet_u);
$cena_str=$pet_u['lvl_str']*250;
$cena_vit=$pet_u['lvl_vit']*250;
$cena_agi=$pet_u['lvl_agi']*250;
$cena_def=$pet_u['lvl_def']*250;
$cena_mana=$pet_u['lvl_mana']*150;
$plus_str=10;
$plus_vit=10;
$plus_agi=10;
$plus_def=10;
$plus_mana=6;
$pet = mysql_query('SELECT * FROM `pet` WHERE `id` = "'.$pet_id.'"');
$pet = mysql_fetch_array($pet);
if(!$pet_id){
?>
<?
if($pet_u){
?><div class='main'><center>Твои питомцы</div></center><?
$q = mysql_query('SELECT * FROM `pet_u` where `user_id`="'.$user['id'].'" ');
while($row_u = mysql_fetch_array($q)) {
?><div class='content'><a href='/petshop/<?=$row_u['id'];?>/'><img src='/images/pet/mini/<?=$row_u['screen'];?>' alt='' style='margin-right:5px;float:left;'/></a><img src='/images/pet/icon/<?=$row_u['screen'];?>' alt=''/> <span class='yellow'><?=$row_u['name'];?></span>, <span class='dgreen medium'><img src='/images/icon/ok.png' alt=''/> Выбран</span><br/><div style='clear:both;'></div><div class='mb10'></div><div class='center'><a class='btn' href='/petshop/<?=$row_u['pet_id'];?>/'><span class='end'><span class='label'>Посмотреть</span></span></a></div></div><?
}
}
?><div class='main'><center>Боевые питомцы:</div></center>
<div class='center'><div class='block_zero'><img src='http://tiwar.ru/images/town/hd/petshop.jpg' width='100%' alt=''/></div></div><div class='mini-line'></div>
<div class='mini-line'></div><?
$q = mysql_query('SELECT * FROM `pet` where `id`!="'.$pet_u['pet_id'].'" ');
while($row = mysql_fetch_array($q)) {
?><div class='main'><a href='/petshop/<?=$row['id'];?>/'><img src='/images/pet/mini/<?=$row['screen'];?>' alt='' style='margin-right:5px;float:left;'/></a><img src='/images/pet/icon/<?=$row['screen'];?>' alt=''/> <span class='yellow'><?=$row['name'];?></span><br/>Цена: <img src='/images/icon/gold.png' alt='*'/> <?=$row['cena'];?><br/><div style='clear:both;'></div><div class='mb10'></div><div class='center'><a class='btn' href='/petshop/<?=$row['id'];?>/'><span class='end'><span class='label'>Посмотреть</span></span></a></div></div><?
}
}elseif($pet_id){
if(isset($_GET['vugn'])){

mysql_query('UPDATE `users` SET `vit` = `vit`-"'.$pet_u['vit'].'", `str` = `str`-"'.$pet_u['str'].'", `agi` = `agi`-"'.$pet_u['agi'].'", `def` = `def`-"'.$pet_u['def'].'", `mana` = `mana`-"'.$pet_u['mana'].'" WHERE `id` = "'.$user['id'].'"');

mysql_query("delete from `pet_u` WHERE `user_id`='".$user['id']."' limit 1");
header('location: /petshop/');exit;}
if(isset($_GET['up'])){
if($pet_u['pet_id']==$pet['id']){
if(isset($_GET['str'])){
if($user['g']<$cena_str){
$_SESSION['err']='У вас не хватает золота';
header('location: /petshop/'.$pet['id'].'/');exit;}
mysql_query("UPDATE `users` SET `g`=`g`-'".$cena_str."' WHERE `id`='".$user['id']."'");
mysql_query("UPDATE `pet_u` SET `str`=`str`+'".$plus_str."',`lvl_str`=`lvl_str`+'1' WHERE `user_id`='".$user['id']."' limit 1");
mysql_query('UPDATE `users` SET `str` = `str`+"'.$plus_str.'" WHERE `id` = "'.$user['id'].'"');
$_SESSION['ok']='Сила питомца успешно прокачана'; 
header('location: /petshop/'.$pet['id'].'/');exit;}
if(isset($_GET['agi'])){
if($user['g']<$cena_agi){
$_SESSION['err']='У вас не хватает золота';
header('location: /petshop/'.$pet['id'].'/');exit;}
mysql_query("UPDATE `users` SET `g`=`g`-'".$cena_agi."' WHERE `id`='".$user['id']."'");
mysql_query("UPDATE `pet_u` SET `agi`=`agi`+'".$plus_agi."',`lvl_agi`=`lvl_agi`+'1' WHERE `user_id`='".$user['id']."' limit 1");
mysql_query('UPDATE `users` SET `agi` = `agi`+"'.$plus_agi.'" WHERE `id` = "'.$user['id'].'"');
$_SESSION['ok']='Удача питомца успешно прокачана'; 
header('location: /petshop/'.$pet['id'].'/');exit;}
if(isset($_GET['vit'])){
if($user['g']<$cena_vit){
$_SESSION['err']='У вас не хватает золота';
header('location: /petshop/'.$pet['id'].'/');exit;}
mysql_query("UPDATE `users` SET `g`=`g`-'".$cena_vit."' WHERE `id`='".$user['id']."'");
mysql_query("UPDATE `pet_u` SET `vit`=`vit`+'".$plus_vit."',`lvl_vit`=`lvl_vit`+'1' WHERE `user_id`='".$user['id']."' limit 1");
mysql_query('UPDATE `users` SET `vit` = `vit`+"'.$plus_vit.'" WHERE `id` = "'.$user['id'].'"');
$_SESSION['ok']='Жизнь питомца успешно прокачана'; 
header('location: /petshop/'.$pet['id'].'/');exit;}
if(isset($_GET['def'])){
if($user['g']<$cena_def){
$_SESSION['err']='У вас не хватает золота';
header('location: /petshop/'.$pet['id'].'/');exit;}
mysql_query("UPDATE `users` SET `g`=`g`-'".$cena_def."' WHERE `id`='".$user['id']."'");
mysql_query("UPDATE `pet_u` SET `def`=`def`+'".$plus_def."',`lvl_def`=`lvl_def`+'1' WHERE `user_id`='".$user['id']."' limit 1");
mysql_query('UPDATE `users` SET `def` = `def`+"'.$plus_def.'" WHERE `id` = "'.$user['id'].'"');
$_SESSION['ok']='Защита питомца успешно прокачана'; 
header('location: /petshop/'.$pet['id'].'/');exit;}
if(isset($_GET['mana'])){
if($user['g']<$cena_mana){
$_SESSION['err']='У вас не хватает золота';
header('location: /petshop/'.$pet['id'].'/');exit;}
mysql_query("UPDATE `users` SET `g`=`g`-'".$cena_mana."' WHERE `id`='".$user['id']."'");
mysql_query("UPDATE `pet_u` SET `mana`=`mana`+'".$plus_mana."',`lvl_mana`=`lvl_mana`+'1' WHERE `user_id`='".$user['id']."' limit 1");
mysql_query('UPDATE `users` SET `mana` = `mana`+"'.$plus_mana.'" WHERE `id` = "'.$user['id'].'"');
$_SESSION['ok']='Мана питомца успешно прокачана'; 
header('location: /petshop/'.$pet['id'].'/');exit;}

}else{
if(!isset($_GET['buy'])){
?><?
if(!empty($_SESSION['err'])){?><center><div class="menuList"><span style=color:red><?=$_SESSION['err'];?></span></div></center><?
$_SESSION['err']=NULL;}
?><div class='list'><center><form action='/petshop/up/<?=$pet_id;?>/buy' method='post'>
Выберите прозвище питомцу:<br/>
<input name='prozv'/><br/>
<span class='btn'><span class='end'><input class='label' type='submit' value='Купить'/>Купить
</form></span></span></center></div><div class=\'mini-line\'></div>
<?
}

if(isset($_GET['buy'])){
if($user['g']<$pet['cena']){
$_SESSION['err']='У вас не хватает золота';
header('location: /petshop/'.$pet['id'].'/');exit;}
if($pet_u){header('location: /petshop/'.$pet['id'].'/');exit;}
$petname= _string($_POST['prozv']);
if(strlen($petname)>16){
$_SESSION['err']='Длина прозвища не более 16 символов';
header('location: /petshop/up/'.$pet_id.'');exit;}
if(strlen($petname)<3){
$_SESSION['err']='Длина прозвища не менее 3 символов';
header('location: /petshop/up/'.$pet_id.'');exit;}
if(!isset($petname)){header('location: /petshop/up/'.$pet_id.'');exit;}
mysql_query("UPDATE `users` SET `g`=`g`-'".$pet['cena']."' WHERE `id`='".$user['id']."'");
mysql_query("INSERT INTO `pet_u` SET `pet_id`='".$pet['id']."',`name`='".$petname."',`screen`='".$pet['screen']."',`lvl_vit`='1',`lvl_agi`='1',`lvl_str`='1',`lvl_def`='1',`lvl_mana`='1',`vit`='".$pet['vit']."',`str`='".$pet['str']."',`agi`='".$pet['agi']."',`def`='".$pet['def']."', `mana`='".$pet['mana']."',`user_id`='".$user['id']."' ");

mysql_query('UPDATE `users` SET `vit` = `vit`+"'.$pet['vit'].'", `str` = `str`+"'.$pet['str'].'", `agi` = `agi`+"'.$pet['agi'].'", `def` = `def`+"'.$pet['def'].'", `mana` = `mana`+"'.$pet['mana'].'" WHERE `id` = "'.$user['id'].'"');

header('location: /petshop/'.$pet['id'].'/');exit;}
}
}
if(!isset($_GET['up'])){
?>
<div class='center'><div class='main'><img src='/images/pet/<?=$pet['screen'];?>' alt=''/><br/><?
if($pet_u['pet_id']==$pet['id']){
?></div><div class="main"><?=$pet_u['name'];?></div><?
if(!empty($_SESSION['ok'])){?><div class="menuList"><span style=color:green><?=$_SESSION['ok'];?></pan></div><?
$_SESSION['ok']=NULL; }
if(!empty($_SESSION['err'])){?><center><div class="list"><span style=color:red><?=$_SESSION['err'];?></span></div></center><?
$_SESSION['err']=NULL;}
?></div><div class='content'>
<img src='/images/icon/str.png' alt='*'/> Сила: <?=$pet_u['str'];?>
<font color="#999">(+<?=$plus_str;?>)</font>
<br/><a href='/petshop/up/<?=$pet_id;?>/str/' class='btn'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/gold.png' alt='*'/> <?=$cena_str;?></a></span></span>
</div><div class='dot-line'></div>

<div class='content'>
<img src='/images/icon/vit.png' alt='*'/> Жизнь: <?=$pet_u['vit'];?>
<font color="#999">(+<?=$plus_vit;?>)</font>
<br/><a href='/petshop/up/<?=$pet_id;?>/vit/' class='btn'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/gold.png' alt='*'/><?=$cena_vit;?></a></span></span>
</div><div class='dot-line'></div>

<div class='content'>
<img src='/images/icon/agi.png' alt='*'/> Удача: <?=$pet_u['agi'];?>
<font color="#999">(+<?=$plus_agi;?>)</font>
<br/><a href='/petshop/up/<?=$pet_id;?>/agi/' class='btn'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/gold.png' alt='*'/> <?=$cena_agi;?></a></span></span>
</div><div class='dot-line'></div>

<div class='content'>
<img src='/images/icon/def.png' alt='*'/> Защита: <?=$pet_u['def'];?>
<font color="#999">(+<?=$plus_def;?>)</font>
<br/><a href='/petshop/up/<?=$pet_id;?>/def/' class='btn'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/gold.png' alt='*'/> <?=$cena_def;?></a></span></span>
</div><div class='dot-line'></div>

<div class='main'>
<img src='/images/icon/mana.png' alt='*'/> Мана: <?=$pet_u['mana'];?>
<font color="#999">(+<?=$plus_mana;?>)</font>
<br/><a href='/petshop/up/<?=$pet_id;?>/mana/' class='btn'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/gold.png' alt='*'/> <?=$cena_mana;?></a></span></span></br>
</div>
<div class='mini-line'></div></div><? }
else{
?><span class='bold dgreen'>Статы: </span><span style='color:#6f6f6f;'> <img src='/images/icon/str.png' alt='*'/> <?=$pet['str'];?>   <img src='/images/icon/vit.png' alt='*'/> <?=$pet['vit'];?>  <img src='/images/icon/agi.png' alt='*'/> <?=$pet['agi'];?>  <img src='/images/icon/def.png' alt='*'/> <?=$pet['def'];?>  <img src='/images/icon/mana.png' alt='*'/> <?=$pet['mana'];?> </span>
</div><div class='line'></div><?
if(!empty($_SESSION['err'])){?><center><div class="menuList"><span style=color:red><?=$_SESSION['err'];?></span></div></center><?
$_SESSION['err']=NULL;}
?>
</div><div class='mini-line'></div><div class='block_zero'> <a href='/petshop/up/<?=$pet['id'];?>/'><span class='end'><span class='label'>Купить</span></span></a><br/>
<span class='grey'>Цена: <img src='/images/icon/gold.png' alt=''/> <?=$pet['cena'];?> золота</span></div></div><? }
?><div class='main'><div class='menuList'><a href='/petshop/'><img src='/images/pet/icon.gif' alt=''/> Магазин питомцев</a></div>
<?
}
}
include './system/f.php';
?>