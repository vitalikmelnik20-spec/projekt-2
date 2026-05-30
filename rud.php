
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=utf-8"/><link rel="icon" href="/favicon.ico" type="image/x-icon"/>
<link rel="icon" href="favicon.ico" type="image/x-icon"/><link rel="stylesheet" href="http://volna.mobi/xaos/style.css" type="text/css"/></head><body>
<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user && !$clan) {

  header('location: /');
    
exit;

}


$id = _string(_num($_GET['id']));

if(!$id && $clan) {
    $id = $clan['id'];
}

  $i = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$id.'"');
  $i = mysql_fetch_array($i);

  if(!$i) {
  
header('location: /clans/');
  exit;
  
  }


$bu = mysql_query('SELECT * FROM `clan_rud` WHERE `clan` = "'.$clan['id'].'"');  
  $bu = mysql_fetch_array($bu);

$bog = mysql_query('SELECT * FROM `clan_rud_user` WHERE `user` = "'.$user['id'].'"');  
  $bog = mysql_fetch_array($bog);

 if(!$bog) {
  
    mysql_query('INSERT INTO `clan_rud_user` (`user`,`clan`) VALUES ("'.$user['id'].'","'.$clan['id'].'")');
  }


$a=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$user['id'].'" LIMIT 1'));
$title =' Золотой рудник';
    include './system/h.php';

?>
<div class="title-top">Золотой Рудник</div><div class="separ2"></div>

<?
if(isset($_SESSION['er'])){
echo $_SESSION['er'];
unset($_SESSION['er']);
}
$rud=rand(1,3);


$expo = rand(238,$user['level'] * 3) + rand(186, $clan['level']) + rand(346, $bu['lvl']);
if(isset($_GET['go'])){
 
if($bu['g'] >=$bu['g_max']){

}else{
mysql_query('UPDATE `clans` SET `g` = `g` + "'.($rud).'" WHERE `id` = "'.$clan['id'].'"');
mysql_query('UPDATE `users` SET `exp` = `exp` + "'.($expo).'" WHERE `id` = "'.$user['id'].'"');
       mysql_query('UPDATE `clan_memb` SET `g` = `g` + "'.($rud).'" WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');
mysql_query('UPDATE `users` SET `mana` = `mana` - 50 WHERE `id` = "'.$user['id'].'"');
mysql_query('UPDATE `clan_rud_user` SET `gold` = `gold` + "'.($rud).'" WHERE `user` = "'.$user['id'].'"');
mysql_query('UPDATE `clan_rud` SET `g` = `g` + "'.($rud).'" WHERE `clan` = "'.$clan['id'].'"');



$_SESSION['er'] = '<div class="jour2">
<div class="jour" style="border-radius:3px"><div style="padding:1px"><img src="http://volna.mobi/xaos/style2/money.png" alt=""/> Золото клана +'.$rud.', <img src="http://volna.mobi/xaos/icons_old/exp2.png" alt=""/> Опыт +'.$expo.'</div></div></div><div class="separ2"></div>';
header('location: /rud/');
}

}

?>

<div class="menu_link2">
<table><tr><td style="width:52px;padding-top:4px"><img src="http://volna.mobi/xaos/style/mine_gold5.jpg" alt="" style="border:1px solid #131313;border-radius:2px;height:50px;width:50px"/>
</td>
<td style="padding-left:4px">
<div style="color:khaki;font-size:16px;">Золотой Рудник, <?=$bu['lvl']?> ур.</div>Сегодня найдено <img src="http://volna.mobi/xaos/style2/money.png" alt=""/>  <?=$bu['g']?> из <?=$bu['g_max']?> <div style="padding:3px">

<?
if($bu['g_max'] <=$bu['g']){
?>
<a class="mybutt_off">Удар киркой <img src="http://volna.mobi/xaos/style/energy.png" alt=""/> 50</a>
<?
}else{
?>

<a href="/rud/go/" class="mybutt_att">Удар киркой <img src="http://volna.mobi/xaos/style/energy.png" alt=""/> 50</a>
<?
}
?>
</div></td></tr></table></div><div class="separ"></div>
<?
$max = 5;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_rud_user` WHERE `clan` = "'.$i['id'].'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;



 $q = mysql_query('SELECT * FROM `clan_rud_user` WHERE `clan` = "'.$i['id'].'" ORDER BY `gold` DESC LIMIT '.$start.', '.$max.'');    
  while($row = mysql_fetch_array($q)) {


$ank=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'" LIMIT 1'));
  $i++;
?>
<div class="menu_link3"><div><img src='/images/icon/race/<?=$ank['r'],($ank['online'] > time() - 300 ? '':'-off')?>.png' alt='*'/> <a href="/user/<?=$ank['id']?>/"><?=$ank['login']?></a> <span style="color:#a5a5a5">+<?=$row['gold']?> <img src="http://volna.mobi/xaos/style2/money.png" alt=""/></span></div></div>


<?
}
$rudl=15000+($bu['lvl']* 15000);
if(isset($_GET['lvl'])){
if($$rudl >=$clan['g']){

}else{

if($bu['lvl'] >=$clan['level']){

}else{
mysql_query('UPDATE `clan_rud` SET `lvl` = `lvl` + 1, `g_max` = `g_max` +60 WHERE `clan` = "'.$clan['id'].'"');
mysql_query('UPDATE `clans` SET `s` = `s` - "'.($rudl).'" WHERE `id` = "'.$clan['id'].'"');
}
}
}
?>
</div></div>
<div class="separ3"></div><div class="menu_link2"><div class="div_hr2"><ul class="pagination"><li class="next"><?=pages('/chat/'.($_GET['clan'] == true ? 'clan/':'').'?');?></li></ul>
</div></div><div class="separ3"></div>


<div class="separ"></div><a href="/rud/lvl/" class="menu_link"><img src="http://volna.mobi/xaos/16x16/arrow_up.png" alt=""/> Улучшить рудник <img src="http://volna.mobi/xaos/16x16/purse.png" alt=""/> <?=$rudl?> <span style="color:#a5a5a5">(<?=$bu['lvl']?> / <?=$clan['level']?>)</span></a><div class="separ3"></div>
<?

include './system/f.php';
?>