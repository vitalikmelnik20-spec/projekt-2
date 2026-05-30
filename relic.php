<?php
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if (!isset($user)){
header('Location: index.php');exit();
}

$title = 'Древние реликвии';
include './system/h.php';
$relict = mysql_fetch_array(mysql_query("SELECT * FROM `relict` WHERE `usr` = '". $user['login']."' LIMIT 1"));

echo'<div class="content"><center><span style="color: #9bc;">Собери реликвии и получи награду<br>Реликвии выпадают на  <img src="images/icon/arena.png" alt="*"><a href="arena.php"> Арене</a>, за победу над противником</span></center></div><div class="mini-line"></div><div class="content"><center>';

if(isset($_GET['log'])){
if($_GET['log'] == '10' AND $relict['a1']=='1'){
mysql_query("UPDATE `users` SET `g` = `g` + '10' WHERE `login` = '". $user['login']."'");
mysql_query("UPDATE `relict` SET `a1` = '0', `a2` = '0', `a3` = '0', `a4` = '0' WHERE `usr` = '". $user['login']."'");
$_SESSION['message'] = 'Награда получена!';
header('Location: relic.php?');exit();
}
elseif($_GET['log'] == '20' AND $relict['b1']=='1'){
mysql_query("UPDATE `users` SET `g` = `g` + '20' WHERE `login` = '". $user['login']."'");
mysql_query("UPDATE `relict` SET `b1` = '0', `b2` = '0', `b3` = '0', `b4` = '0' WHERE `usr` = '". $user['login']."'");
$_SESSION['message'] = 'Награда получена!';
header('Location: relic.php?');exit();
}
elseif($_GET['log'] == '30' AND $relict['c1']=='1'){
mysql_query("UPDATE `users` SET `g` = `g` + '30' WHERE `login` = '". $user['login']."'");
mysql_query("UPDATE `relict` SET `c1` = '0', `c2` = '0', `c3` = '0', `c4` = '0' WHERE `usr` = '". $user['login']."'");
$_SESSION['message'] = 'Награда получена!';
header('Location: relic.php?');exit();
}
elseif($_GET['log'] == '40' AND $relict['d1']=='1'){
mysql_query("UPDATE `users` SET `g` = `g` + '40' WHERE `login` = '". $user['login']."'");
mysql_query("UPDATE `relict` SET `d1` = '0', `d2` = '0', `d3` = '0', `d4` = '0' WHERE `usr` = '". $user['login']."'");
$_SESSION['message'] = 'Награда получена!';
header('Location: relic.php?');exit();
}
elseif($_GET['log'] == '50' AND $relict['e1']=='1'){
mysql_query("UPDATE `users` SET `g` = `g` + '50' WHERE `login` = '". $user['login']."'");
mysql_query("UPDATE `relict` SET `e1` = '0', `e2` = '0', `e3` = '0', `e4` = '0' WHERE `usr` = '". $user['login']."'");
$_SESSION['message'] = 'Награда получена!';
header('Location: relic.php?');exit();
}
elseif($_GET['log'] == '60' AND $relict['f1']=='1'){
mysql_query("UPDATE `users` SET `g` = `g` + '60' WHERE `login` = '". $user['login']."'");
mysql_query("UPDATE `relict` SET `f1` = '0', `f2` = '0', `f3` = '0', `f4` = '0' WHERE `usr` = '". $user['login']."'");
$_SESSION['message'] = 'Награда получена!';
header('Location: relic.php?');exit();
}
elseif($_GET['log'] == '70' AND $relict['g1']=='1'){
mysql_query("UPDATE `users` SET `g` = `g` + '70' WHERE `login` = '". $user['login']."'");
mysql_query("UPDATE `relict` SET `g1` = '0', `g2` = '0', `g3` = '0', `g4` = '0' WHERE `usr` = '". $user['login']."'");
$_SESSION['message'] = 'Награда получена!';
header('Location: relic.php?');exit();
}
elseif($_GET['log'] == '80' AND $relict['h1']=='1'){
mysql_query("UPDATE `users` SET `g` = `g` + '80' WHERE `login` = '". $user['login']."'");
mysql_query("UPDATE `relict` SET `h1` = '0', `h2` = '0', `h3` = '0', `h4` = '0' WHERE `usr` = '". $user['login']."'");
$_SESSION['message'] = 'Награда получена!';
header('Location: relic.php?');exit();
}
elseif($_GET['log'] == '90' AND $relict['i1']=='1'){
mysql_query("UPDATE `users` SET `g` = `g` + '90' WHERE `login` = '". $user['login']."'");
mysql_query("UPDATE `relict` SET `i1` = '0', `i2` = '0', `i3` = '0', `i4` = '0' WHERE `usr` = '". $user['login']."'");
$_SESSION['message'] = 'Награда получена!';
header('Location: relic.php?');exit();
}
elseif($_GET['log'] == '100' AND $relict['j1']=='1'){
mysql_query("UPDATE `users` SET `g` = `g` + '100' WHERE `login` = '". $user['login']."'");
mysql_query("UPDATE `relict` SET `j1` = '0', `j2` = '0', `j3` = '0', `j4` = '0' WHERE `usr` = '". $user['login']."'");
$_SESSION['message'] = 'Награда получена!';
header('Location: relic.php?');exit();
}
else{
$_SESSION['err']='Вы уже получали эту награду!';
header('Location: relic.php');exit();
}
}

if($relict['a1']==1){$a1='1';}else{$a1='1-1';}
echo"<img src='images/relict/$a1.png'/> ";

if($relict['a2']==1){$a2='2';}else{$a2='2-1';}
echo"<img src='images/relict/$a2.png'/> ";

if($relict['a3']==1){$a3='3';}else{$a3='3-1';}
echo"<img src='images/relict/$a3.png'/> ";

if($relict['a4']==1){$a4='4';}else{$a4='4-1';}
echo"<img src='images/relict/$a4.png'/> ";

if($relict['a1']==1 AND $relict['a2']==1 AND $relict['a3']==1 AND $relict['a4']==1){
echo'<a class="btn" href="relic.php?log=10"><span class="end"><span class="label"><br />Забрать <img src="images/icon/gold.png" alt="*"> 10</span></span></a>';
}
else{
echo"<br><span style='color: #9bc;'>Награда:</span> <img src='images/icon/gold.png'/> 10 золота";
}

echo'</div><div class="mini-line"></div><div class="content"><center>';

if($relict['b1']==1){$a5='5';}else{$a5='5-1';}
echo"<img src='images/relict/$a5.png'/> ";

if($relict['b2']==1){$a6='6';}else{$a6='6-1';}
echo"<img src='images/relict/$a6.png'/> ";

if($relict['b3']==1){$a7='7';}else{$a7='7-1';}
echo"<img src='images/relict/$a7.png'/> ";

if($relict['b4']==1){$a8='8';}else{$a8='8-1';}
echo"<img src='images/relict/$a8.png'/> ";

if($relict['b1']==1 AND $relict['b2']==1 AND $relict['b3']==1 AND $relict['b4']==1){
echo'<a class="btn" href="relic.php?log=20"><span class="end"><span class="label"><br />Забрать <img src="images/icon/gold.png" alt="*"> 20</span></span></a>';
}else{
echo"<br><span style='color: #9bc;'>Награда:</span> <img src='images/icon/gold.png'/> 20 золота";
}

echo'</div><div class="mini-line"></div><div class="content"><center>';

if($relict['c1']==1){$a9='9';}else{$a9='9-1';}
echo"<img src='images/relict/$a9.png'/> ";

if($relict['c2']==1){$a10='10';}else{$a10='10-1';}
echo"<img src='images/relict/$a10.png'/> ";

if($relict['c3']==1){$a11='11';}else{$a11='11-1';}
echo"<img src='images/relict/$a11.png'/> ";

if($relict['c4']==1){$a12='12';}else{$a12='12-1';}
echo"<img src='images/relict/$a12.png'/> ";

if($relict['c1']==1 AND $relict['c2']==1 AND $relict['c3']==1 AND $relict['c4']==1){
echo'<a class="btn" href="relic.php?log=30"><span class="end"><span class="label"><br />Забрать <img src="images/icon/gold.png" alt="*"> 30</span></span></a>';
}else{
echo"<br><span style='color: #9bc;'>Награда:</span> <img src='images/icon/gold.png'/> 30 золота";
}

echo'</div><div class="mini-line"></div><div class="content"><center>';

if($relict['d1']==1){$a13='13';}else{$a13='13-1';}
echo"<img src='images/relict/$a13.png'/> ";

if($relict['d2']==1){$a14='14';}else{$a14='14-1';}
echo"<img src='images/relict/$a14.png'/> ";

if($relict['d3']==1){$a15='15';}else{$a15='15-1';}
echo"<img src='images/relict/$a15.png'/> ";

if($relict['d4']==1){$a16='16';}else{$a16='16-1';}
echo"<img src='images/relict/$a16.png'/> ";

if($relict['d1']==1 AND $relict['d2']==1 AND $relict['d3']==1 AND $relict['d4']==1){
echo'<a class="btn" href="relic.php?log=40"><span class="end"><span class="label"><br />Забрать <img src="images/icon/gold.png" alt="*"> 40</span></span></a>';
}else{
echo"<br><span style='color: #9bc;'>Награда:</span> <img src='images/icon/gold.png'/> 40 золота";
}

echo'</div><div class="mini-line"></div><div class="content"><center>';

if($relict['e1']==1){$a17='17';}else{$a17='17-1';}
echo"<img src='images/relict/$a17.png'/> ";

if($relict['e2']==1){$a18='18';}else{$a18='18-1';}
echo"<img src='images/relict/$a18.png'/> ";

if($relict['e3']==1){$a19='19';}else{$a19='19-1';}
echo"<img src='images/relict/$a19.png'/> ";

if($relict['e4']==1){$a20='20';}else{$a20='20-1';}
echo"<img src='images/relict/$a20.png'/> ";

if($relict['e1']==1 AND $relict['e2']==1 AND $relict['e3']==1 AND $relict['e4']==1){
echo'<a class="btn" href="relic.php?log=50"><span class="end"><span class="label"><br />Забрать <img src="images/icon/gold.png" alt="*"> 50</span></span></a>';
}else{
echo"<br><span style='color: #9bc;'>Награда:</span> <img src='images/icon/gold.png'/> 50 золота";
}

echo'</div><div class="mini-line"></div><div class="content"><center>';

if($relict['f1']==1){$a21='21';}else{$a21='21-1';}
echo"<img src='images/relict/$a21.png'/> ";

if($relict['f2']==1){$a22='22';}else{$a22='22-1';}
echo"<img src='images/relict/$a22.png'/> ";

if($relict['f3']==1){$a23='23';}else{$a23='23-1';}
echo"<img src='images/relict/$a23.png'/> ";

if($relict['f4']==1){$a24='24';}else{$a24='24-1';}
echo"<img src='images/relict/$a24.png'/> ";

if($relict['f1']==1 AND $relict['f2']==1 AND $relict['f3']==1 AND $relict['f4']==1){
echo'<a class="btn" href="relic.php?log=60"><span class="end"><span class="label"><br />Забрать <img src="images/icon/gold.png" alt="*"> 60</span></span></a>';
}else{
echo"<br><span style='color: #9bc;'>Награда:</span> <img src='images/icon/gold.png'/> 60 золота";
}

echo'</div><div class="mini-line"></div><div class="content"><center>';

if($relict['g1']==1){$a25='25';}else{$a25='25-1';}
echo"<img src='images/relict/$a25.png'/> ";

if($relict['g2']==1){$a26='26';}else{$a26='26-1';}
echo"<img src='images/relict/$a26.png'/> ";

if($relict['g3']==1){$a27='27';}else{$a27='27-1';}
echo"<img src='images/relict/$a27.png'/> ";

if($relict['g4']==1){$a28='28';}else{$a28='28-1';}
echo"<img src='images/relict/$a28.png'/> ";

if($relict['g1']==1 AND $relict['g2']==1 AND $relict['g3']==1 AND $relict['g4']==1){
echo'<a class="btn" href="relic.php?log=70"><span class="end"><span class="label"><br />Забрать <img src="images/icon/gold.png" alt="*"> 70</span></span></a>';
}else{
echo"<br><span style='color: #9bc;'>Награда:</span> <img src='images/icon/gold.png'/> 70 золота";
}

echo'</div><div class="mini-line"></div><div class="content"><center>';

if($relict['h1']==1){$a29='29';}else{$a29='29-1';}
echo"<img src='images/relict/$a29.png'/> ";

if($relict['h2']==1){$a30='30';}else{$a30='30-1';}
echo"<img src='images/relict/$a30.png'/> ";

if($relict['h3']==1){$a31='31';}else{$a31='31-1';}
echo"<img src='images/relict/$a31.png'/> ";

if($relict['h4']==1){$a32='32';}else{$a32='32-1';}
echo"<img src='images/relict/$a32.png'/> ";

if($relict['h1']==1 AND $relict['h2']==1 AND $relict['h3']==1 AND $relict['h4']==1){
echo'<a class="btn" href="relic.php?log=80"><span class="end"><span class="label"><br />Забрать <img src="images/icon/gold.png" alt="*"> 80</span></span></a>';
}else{
echo"<br><span style='color: #9bc;'>Награда:</span> <img src='images/icon/gold.png'/> 80 золота";
}

echo'</div><div class="mini-line"></div><div class="content"><center>';

if($relict['i1']==1){$a33='33';}else{$a33='33-1';}
echo"<img src='images/relict/$a33.png'/> ";

if($relict['i2']==1){$a34='34';}else{$a34='34-1';}
echo"<img src='images/relict/$a34.png'/> ";

if($relict['i3']==1){$a35='35';}else{$a35='35-1';}
echo"<img src='images/relict/$a35.png'/> ";

if($relict['i4']==1){$a36='36';}else{$a36='36-1';}
echo"<img src='images/relict/$a36.png'/> ";

if($relict['i1']==1 AND $relict['i2']==1 AND $relict['i3']==1 AND $relict['i4']==1){
echo'<a class="btn" href="relic.php?log=90"><span class="end"><span class="label"><br />Забрать <img src="images/icon/gold.png" alt="*"> 90</span></span></a>';
}else{
echo"<br><span style='color: #9bc;'>Награда:</span> <img src='images/icon/gold.png'/> 90 золота";
}

echo'</div><div class="mini-line"></div><div class="content"><center>';

if($relict['j1']==1){$a37='37';}else{$a37='37-1';}
echo"<img src='images/relict/$a37.png'/> ";

if($relict['j2']==1){$a38='38';}else{$a38='38-1';}
echo"<img src='images/relict/$a38.png'/> ";

if($relict['j3']==1){$a39='39';}else{$a39='39-1';}
echo"<img src='images/relict/$a39.png'/> ";

if($relict['j4']==1){$a40='40';}else{$a40='40-1';}
echo"<img src='images/relict/$a40.png'/> ";

if($relict['j1']==1 AND $relict['j2']==1 AND $relict['j3']==1 AND $relict['j4']==1){
echo'<a class="btn" href="relic.php?log=100"><span class="end"><span class="label"><br />Забрать <img src="images/icon/gold.png" alt="*"> 100</span></span></a>';
}else{
echo"<br><span style='color: #9bc;'>Награда:</span> <img src='images/icon/gold.png'/> 100 золота";
}

echo'</center></div><div class="mini-line"></div><div class="content"><ul class="hint"><li>Реликвии можно найти сражаясь на  <img src="images/icon/arena.png" alt="*"><a href="arena.php"> Арене</a></li><li>Древние реликвии - это набор вещей, которые вам надо собрать, что бы получить награду</li></ul></div>';
include './system/f.php';
?>