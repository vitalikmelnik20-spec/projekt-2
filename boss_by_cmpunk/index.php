<?
include_once '../system/common.php';
    
include_once '../system/functions.php';
        
include_once '../system/user.php';

include_once '../system/h.php';
auth();

if($user[level] < 5){

echo '<center><div class="content"><img src="http://od.tiwar.mobi/images/town/hd/hell.jpg"></center>
<div class="h">Для сражений с боссами требуется <img src="/images/icon/level.png"> 5 уровень<br>
Ваш уровень: <img src="/images/icon/level.png"> '.$user['level'].'</div>
</center></div>';
exit;
}


if($user[level] >= 5){

$kount = mysql_result(mysql_query("SELECT COUNT(*)  FROM `boss`"),0);




echo '<div class="block_zero"><center><img style = "width: 100%;"src="http://od.tiwar.mobi/images/town/hd/hell.jpg"></center></div>';
?>

<div class="line"></div>

<div class="content" align="center">
<font color="violet">Для нападения надо минимум <img src="/images/icon/health.png" alt="*"/> 10% жизни и <img src="/images/icon/mana.png" alt="*"/> 250 маны</font>
  <div class="separator"></div>

<table cellpadding="0" cellspacing="0">
<tr>
  <td><img src="/images/town/wizard.png" alt="*"/></td>
  <td valign="top" style="padding-left: 5px;" align="left"><b>Настойка бодрости</b><br/>
  <small><small>+100% маны и жизни</small></small></td>

</tr></table>

  <div class="separator"></div>

<div align="center"><a href="/lab/wiz/?potion=true&referal=/boss_by_cmpunk/index.php/" class="button">Купить</a><br/><br/>
  <font color="#909090">Цена: <img src="/images/icon/gold.png" alt="*"/> 100 золота</font>
</div>

</div>
<div class="line"></div>

<?

echo "<div class='line'></div>";
if($kount == 0)echo "<div class='content'>Нет боссов!</div><div class='mini-line'></div>";
$q = mysql_query("SELECT * FROM `boss` ORDER BY `lvl` ASC");
while($boss = mysql_fetch_assoc($q)) {

echo '<div class="tab">
<div>
<img style = "width: 100%; height: 80px;"  src = "/boss_by_cmpunk/'.$boss['image'].'"/>
</div>
<div>
<span class="yellow"> '.$boss['name'].'</span><br>
<img src="/images/icon/level.png"> '.$boss['lvl'].' Уровень<br>
<img src="/images/icon/gold.png"> '.$boss['gold'].',
 <img src="http://213.239.195.28/xaos/16x16/ruby.png"> '.$boss['rub'].',
  <br><img src="/images/icon/silver.png"> '.$boss['s'].',
  <img src="/images/icon/exp.png"> '.$boss['exp'].'
<a class="button" href="boss.php?id='.$boss['id'].'">Выбрать</a>
</div></div>';
}





}

include_once '../system/f.php';
?>