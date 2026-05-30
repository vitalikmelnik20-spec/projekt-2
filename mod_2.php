<?php
include './system/common.php';   
include './system/functions.php'; 
include './system/user.php';

include './system/h.php'; 
auth();
switch($_GET[go]){
default:
echo' <div class="title">Рега</div>';






$faq = mysql_query("SELECT * FROM `config`");
$conf = mysql_fetch_array($faq);
if(empty($_POST[name])){
echo "<form action='?go=1' method='post'>";
$item = mysql_fetch_array($req);


echo"Регистрация: </br> 
<select name='rega'>
<option value='on'>";
if($conf[rega] == 'on'){
echo"Сейчас открытая";
}else{
echo"Сейчас закрытая";}
echo" </option>
<option value='on'>Открытая 
</option>
<option value='off'>Закрытая 
</option>
</select> </br>";
///
if($conf[rega] == 'on'){
echo"Причина закрытия игры: </br>
<input class='input' type='text' value='$conf[rega_off_msg]' size='20' name='rega_off_msg'><br/>";
}
///

echo '
 <center>
<input class="button" type="submit" value="Сохранить" /></form>
</center>';

}
break;
/////////


case '1':
$faq = mysql_query("SELECT * FROM `config`");
$conf = mysql_fetch_array($faq);


mysql_query("UPDATE `config` SET
        `rega` =  '$_POST[rega]',
        `rega_off_msg` =  '$_POST[rega_off_msg]' 
 WHERE `id` = '1'");

echo" <div class='title'> Сохранение </div>
<center> Изменения приняты! </center> 
<div class='list'>
<li><a href='index.php'>
<img src='../images/icon/arrow.png'> В админку </a></li></div>";

////////




}
include '/system/f.php';
?>
