<?php
if (!isset($user)){
header('Location: index.php');exit();
}

$user['login']=_string($user['login']);

$req = mysql_query("SELECT * FROM `relict` WHERE `usr` = '".$user['login']."' LIMIT 1");
$avto = mysql_num_rows($req);
if($avto==0){
mysql_query("INSERT INTO `relict` SET `usr` = '". $user['login']."'");
}else{
$rel = mysql_fetch_assoc($req);
}

$nominal=mt_rand(0,400);

if($nominal==10){
mysql_query("UPDATE `relict` SET `a1` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['a1']+$rel['a2']+$rel['a3']+$rel['a4'];
$img="../images/relict/1.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==20){
mysql_query("UPDATE `relict` SET `a2` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['a1']+$rel['a2']+$rel['a3']+$rel['a4'];
$img="../images/relict/2.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==30){
mysql_query("UPDATE `relict` SET `a3` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['a1']+$rel['a2']+$rel['a3']+$rel['a4'];
$img="../images/relict/3.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==40){
mysql_query("UPDATE `relict` SET `a4` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['a1']+$rel['a2']+$rel['a3']+$rel['a4'];
$img="../images/relict/4.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==50){
mysql_query("UPDATE `relict` SET `b1` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['b1']+$rel['b2']+$rel['b3']+$rel['b4'];
$img="../images/relict/5.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==60){
mysql_query("UPDATE `relict` SET `b2` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['b1']+$rel['b2']+$rel['b3']+$rel['b4'];
$img="../images/relict/6.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==70){
mysql_query("UPDATE `relict` SET `b3` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['b1']+$rel['b2']+$rel['b3']+$rel['b4'];
$img="../images/relict/7.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==80){
mysql_query("UPDATE `relict` SET `b4` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['b1']+$rel['b2']+$rel['b3']+$rel['b4'];
$img="../images/relict/8.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==90){
mysql_query("UPDATE `relict` SET `c1` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['c1']+$rel['c2']+$rel['c3']+$rel['c4'];
$img="../images/relict/9.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==100){
mysql_query("UPDATE `relict` SET `c2` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['c1']+$rel['c2']+$rel['c3']+$rel['c4'];
$img="../images/relict/10.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==110){
mysql_query("UPDATE `relict` SET `c3` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['c1']+$rel['c2']+$rel['c3']+$rel['c4'];
$img="../images/relict/11.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==120){
mysql_query("UPDATE `relict` SET `c4` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['c1']+$rel['c2']+$rel['c3']+$rel['c4'];
$img="../images/relict/12.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==130){
mysql_query("UPDATE `relict` SET `d1` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['d1']+$rel['d2']+$rel['d3']+$rel['d4'];
$img="../images/relict/13.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==140){
mysql_query("UPDATE `relict` SET `d2` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['d1']+$rel['d2']+$rel['d3']+$rel['d4'];
$img="../images/relict/14.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==150){
mysql_query("UPDATE `relict` SET `d3` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['d1']+$rel['d2']+$rel['d3']+$rel['d4'];
$img="../images/relict/15.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==160){
mysql_query("UPDATE `relict` SET `d4` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['d1']+$rel['d2']+$rel['d3']+$rel['d4'];
$img="../images/relict/16.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==170){
mysql_query("UPDATE `relict` SET `e1` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['e1']+$rel['e2']+$rel['e3']+$rel['e4'];
$img="../images/relict/17.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==180){
mysql_query("UPDATE `relict` SET `e2` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['e1']+$rel['e2']+$rel['e3']+$rel['e4'];
$img="../images/relict/18.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==190){
mysql_query("UPDATE `relict` SET `e3` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['e1']+$rel['e2']+$rel['e3']+$rel['e4'];
$img="../images/relict/19.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==200){
mysql_query("UPDATE `relict` SET `e4` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['e1']+$rel['e2']+$rel['e3']+$rel['e4'];
$img="../images/relict/20.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==210){
mysql_query("UPDATE `relict` SET `f1` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['f1']+$rel['f2']+$rel['f3']+$rel['f4'];
$img="../images/relict/21.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==220){
mysql_query("UPDATE `relict` SET `f2` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['f1']+$rel['f2']+$rel['f3']+$rel['f4'];
$img="../images/relict/22.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==230){
mysql_query("UPDATE `relict` SET `f3` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['f1']+$rel['f2']+$rel['f3']+$rel['f4'];
$img="../images/relict/23.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==240){
mysql_query("UPDATE `relict` SET `f4` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['f1']+$rel['f2']+$rel['f3']+$rel['f4'];
$img="../images/relict/24.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==250){
mysql_query("UPDATE `relict` SET `g1` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['g1']+$rel['g2']+$rel['g3']+$rel['g4'];
$img="../images/relict/25.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==260){
mysql_query("UPDATE `relict` SET `g2` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['g1']+$rel['g2']+$rel['g3']+$rel['g4'];
$img="../images/relict/26.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==270){
mysql_query("UPDATE `relict` SET `g3` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['g1']+$rel['g2']+$rel['g3']+$rel['g4'];
$img="../images/relict/27.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==280){
mysql_query("UPDATE `relict` SET `g4` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['g1']+$rel['g2']+$rel['g3']+$rel['g4'];
$img="../images/relict/28.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==290){
mysql_query("UPDATE `relict` SET `h1` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['h1']+$rel['h2']+$rel['h3']+$rel['h4'];
$img="../images/relict/29.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==300){
mysql_query("UPDATE `relict` SET `h2` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['h1']+$rel['h2']+$rel['h3']+$rel['h4'];
$img="../images/relict/30.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==310){
mysql_query("UPDATE `relict` SET `h3` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['h1']+$rel['h2']+$rel['h3']+$rel['h4'];
$img="../images/relict/31.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==320){
mysql_query("UPDATE `relict` SET `h4` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['h1']+$rel['h2']+$rel['h3']+$rel['h4'];
$img="../images/relict/32.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==330){
mysql_query("UPDATE `relict` SET `i1` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['i1']+$rel['i2']+$rel['i3']+$rel['i4'];
$img="../images/relict/33.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==340){
mysql_query("UPDATE `relict` SET `i2` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['i1']+$rel['i2']+$rel['i3']+$rel['i4'];
$img="../images/relict/34.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==350){
mysql_query("UPDATE `relict` SET `i3` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['i1']+$rel['i2']+$rel['i3']+$rel['i4'];
$img="../images/relict/35.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==360){
mysql_query("UPDATE `relict` SET `i4` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['i1']+$rel['i2']+$rel['i3']+$rel['i4'];
$img="../images/relict/36.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==370){
mysql_query("UPDATE `relict` SET `j1` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['j1']+$rel['j2']+$rel['j3']+$rel['j4'];
$img="../images/relict/37.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==380){
mysql_query("UPDATE `relict` SET `j2` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['j1']+$rel['j2']+$rel['j3']+$rel['j4'];
$img="../images/relict/38.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==390){
mysql_query("UPDATE `relict` SET `j3` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['j1']+$rel['j2']+$rel['j3']+$rel['j4'];
$img="../images/relict/39.png";
$name="<a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a><br><small>Собрано: $min из 4</small>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}

if($nominal==400){
mysql_query("UPDATE `relict` SET `j4` = '1' WHERE `usr` = '". $user['login']."'");
$rel = mysql_fetch_assoc(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));
$min=$rel['j1']+$rel['j2']+$rel['j3']+$rel['j4'];
$img="../images/relict/40.png";
$name="<a href='../relic.php?log=relict'><a href='../relic.php?log=relict'>Новая реликвия в твоей <img src='../images/icon/relic.png'/> коллекции</a></a>";
echo "<div class='separ'></div>$name<br><br><img src='$img' width='50' height='50'/>";
}
?>