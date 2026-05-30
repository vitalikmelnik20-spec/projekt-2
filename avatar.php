<?php
include './system/common.php';
include './system/functions.php';
include './system/user.php';
$title = 'Загрузка аватара'; 
include './system/h.php';
$sett = mysql_query("SELECT * FROM `set` WHERE `usr` = '$user[login]' LIMIT 1");
$set = mysql_fetch_assoc($sett); 
if($set['vip']=='on'){
switch($_GET['mod']){
default:
case 'load':
echo'<div class="wrapper"><div class="lent w80 mlra">
<div class="bl-ttl"><div class="te">
<div class="ttl">Загрузка Аватара</div></div></div>';
echo "<font color='#ffc22b'> • Можно загружать аватары любых размеров, весом не больше 200кб, в формате jpg. </font><font color=aqua>Бесплатно загрузка</font></br>";
	 if($_POST['go']==5)
	 {
	 // проверим соответсвует ли загружаемый аватар нашим параметрам
	 if($_FILES['avatar']['size']>200500){$err_avatar_size='Аватар слишком велик!';}
	 if(!($_FILES['avatar']['type']=='image/pjpeg' OR $_FILES['avatar']['type']=='image/jpeg'))
	 {$err_avatar_type='Файл имеет неразрешенный тип!';}
	 
	 // сохраним аватар на сервере, если нет ошибок
	 if(!$err_avatar_size AND !$err_avatar_type)
	     {
         $avatar_name=$user['id'];
		 
		 $avatar_way="images/avatar/".$avatar_name; // путь в аватару
		 
		 // удалим уже существующие аватары
		 $avatar_del=$avatar_way.".gif";
		 unlink($avatar_del);
		 $avatar_del=$avatar_way.".jpg";
		 unlink($avatar_del);
		$avatar_del=$avatar_way.".png";
		 unlink($avatar_del);	 
		 // добавляем расширение к файлу
         switch($_FILES['avatar']['type'])
		     {
		     case 'image/pjpeg': $avatar_way.=".jpg"; break;
			 case 'image/jpeg': $avatar_way.=".jpg"; break;
			 }
			

		 copy($_FILES['avatar']['tmp_name'], $avatar_way); // сохраним файл на сервер
		 }
	 }
	 
	 // выведем ошибки, если они есть
	 if($err_avatar_size){echo $err_avatar_size;}
	 if($err_avatar_type){echo $err_avatar_type;}
	 
	 $catalog="images/avatar/";
	 
	 
	 
	 // отобразим уже загруженный аватар
 
	 $i=1;
	 $dir = opendir ($catalog);
     while ($file = readdir ($dir)) 
     {
	 if($file=="$user[login].jpg")
	     {
		 echo"<center><span class='blue'>$file</span></br>";
         echo '<br><img width="120" height="160" src="/'.$catalog.'/'.$file.'"></img><br><br/>';
		 echo '<a class="btn _dark" href="'.$_SERVER['PHP_SELF'].'?mod=save&ok='.$file.'&alm='.$user['g'].'" value="Сохранить">Сохранить</a>'; 
		 echo '</center>';
	     }
     }
     closedir ($dir);
	 
	 
	 // форма загрузки
	 echo'
	 <form action="?mod=load" method="post" enctype="multipart/form-data">
	 <input type="hidden" name="go" value="5">
	 <input class="text" type="file" name="avatar"><br><br>
	<input class="label" type="submit" value="закачать">
	<input class="label" type="Reset" value="сброс">
	 </form></div>';
echo'</div></div>';
break;

case 'save':

if($_GET['ok']!==$name){
$name = $_GET['ok'];
if(isset($set['avatar'])){
mysql_query("UPDATE `set` SET `avatar` = '$name' WHERE `usr`='$user[login]'");
}
echo "<div class='wrapper'><div class='block_zero center'>";
echo"<font color='#71cc71'> Аватарка сохранена</font></br>";
echo '</div></div>';}
     

break;
}
}else{
echo '<div class="wrapper"><div class="block_zero center">';
echo '<font color="red">Внимания!</font> У вас не куплен Премиум аккаунт<br/><br/>';
echo '</div><div class="mini-line"></div><div class="block_zero"><ul class="hint">';
echo '<li>Вы можете купить <img width="15" height="15" src="/images/icon/vip.png"><a href="/vip.php">Премиум аккаунт.</a></li>';
echo '</div></div>';
}
include './system/f.php';
?>