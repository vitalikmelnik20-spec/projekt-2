<?
    
include './system/common.php';   
include './system/functions.php'; 
include './system/user.php';
 $title = 'рассылка';   
include './system/h.php'; 
auth();
///////рассылка////////
switch($_GET[mod]){
default:




if(empty($_POST['text'])){
echo "<div class='title'>Рассылка</div>";
echo '<center> 
Введите текст: <br/>
<form name="form" action="mod_1.php" method="post">
<textarea name="text" cols="25" rows="2"></textarea>';

echo "<br><input type=\"submit\" value=\"Отправить\" class=\"button\"></form></center>";
?>
<div class='line'></div>
<div class='list'>
<li><a href='adm.php'> <img src="/images/icon/arrow.png" alt=""> Вернуться</a></li></div>
<?
}else{
$text=htmlspecialchars($_POST[text]);
$req = mysql_query("SELECT `id` FROM `users`");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto>1){
While($us = mysql_fetch_array($req))
{
$text1 = '$_POST[text]'; // Текст сообщения
$time = time(); //Ничего не трогаем
$read = '0'; // Ничего не трогаем
$to = $us['id']; // Ничего не трогаем
$from = '2'; // Ид отправителя сообщения (от кого)

if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = '.$us['id'].' AND `ho` = "2"'),0) == 0) {
mysql_query("INSERT INTO `contacts` SET `user` = '".$us['id']."', `ho` = '2', `time` = ".time()."");
}	
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = '.$us['id'].' AND `ho` = "2"');
mysql_query("INSERT INTO `mail` SET `from` = '$from',`time` = '$time', `read` = '$read',`to`='$to',`text` = '<center><small><a> админ рассылка </a></small> </center> $_POST[text]'");

  

}
echo'<img src=\'pic/main/!.png\'> Рассылка успешно отправлена!';
}else{
echo'<img src=\'pic/main/!.png\'> Нет игроков';
}
}
break;
             //////////

case'gold':
if(empty($_POST['g'])){
echo "<div class='title'>Рассылка</div>";
echo '<center> 
Введите количество золота: <br/>
<form name="form" action="mod_1.php?mod=gold" method="post">
<textarea name="g" cols="25" rows="1"></textarea>';

echo "<br><input type=\"submit\" value=\"Отправить\" class=\"button\"></form></center>";
?>
<div class='line'></div>
<div class='list'>
<li><a href='adm.php'> <img src="/images/icon/arrow.png" alt=""> Вернуться</a></li></div>
<?
}else{
$text=htmlspecialchars($_POST[g]);
$req = mysql_query("SELECT `id` FROM `users`");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto>1){
While($us = mysql_fetch_array($req))
{
$text1 = '$user[login]'; // Текст сообщения
$time = time(); //Ничего не трогаем
$read = '0'; // Ничего не трогаем
$to = $us['id']; // Ничего не трогаем
$from = '2'; // Ид отправителя сообщения (от кого)
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = '.$us['id'].' AND `ho` = "2"'),0) == 0) {
mysql_query("INSERT INTO `contacts` SET `user` = '".$us['id']."', `ho` = '2', `time` = ".time()."");
}	
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = '.$us['id'].' AND `ho` = "2"');
mysql_query("UPDATE `users` SET `g` = `g` + '$_POST[g]' WHERE `id` = '$us[id]' ");

mysql_query("INSERT INTO `mail` SET `from` = '$from',`time` = '$time', `read` = '$read',`to`='$to',`text` = ' $user[login] отправил вам $_POST[g] золота'");

 
}
echo'<img src=\'pic/main/!.png\'> Рассылка успешно отправлена!';
}else{
echo'<img src=\'pic/main/!.png\'> Нет игроков';
}
}
break;
    //////

case'silver':
if(empty($_POST['s'])){
echo "<div class='title'>Рассылка</div>";
echo '<center> 
Введите количество серебра: <br/>
<form name="form" action="mod_1.php?mod=silver" method="post">
<textarea name="s" cols="25" rows="1"></textarea>';

echo "<br><input type=\"submit\" value=\"Отправить\" class=\"button\"></form></center>";
?>
<div class='line'></div>
<div class='list'>
<li><a href='adm.php'> <img src="/images/icon/arrow.png" alt=""> Вернуться</a></li></div>
<?
}else{
$text=htmlspecialchars($_POST[s]);
$req = mysql_query("SELECT `id` FROM `users`");
////////////////////////////
$avto=mysql_num_rows($req);
if($avto>1){
While($us = mysql_fetch_array($req))
{
$text1 = '$user[login]'; // Текст сообщения
$time = time(); //Ничего не трогаем
$read = '0'; // Ничего не трогаем
$to = $us['id']; // Ничего не трогаем
$from = '2'; // Ид отправителя сообщения (от кого)
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `contacts` WHERE `user` = '.$us['id'].' AND `ho` = "2"'),0) == 0) {
mysql_query("INSERT INTO `contacts` SET `user` = '".$us['id']."', `ho` = '2', `time` = ".time()."");
}	
mysql_query('UPDATE `contacts` SET `time` = \''.time().'\' WHERE `user` = '.$us['id'].' AND `ho` = "2"');
mysql_query("UPDATE `users` SET `s` = `s` + '$_POST[s]' WHERE `id` = '$us[id]' ");

mysql_query("INSERT INTO `mail` SET `from` = '$from',`time` = '$time', `read` = '$read',`to`='$to',`text` = ' $user[login] отправил вам $_POST[s] серебра'");

}
echo'<img src=\'pic/main/!.png\'> Рассылка успешно отправлена!';
}else{
echo'<img src=\'pic/main/!.png\'> Нет игроков';
}
}
break;
     //////

}


include './system/f.php';
  
?>
