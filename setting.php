<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) {
header('location: /');
exit;
}

if($user['save'] == 0) {
header('location: /save/'); 
exit;
}

$title = 'Настройки';    
include './system/h.php';  

$login = _string($_POST['login']);

if($login) {
if($user['g'] < 250) $errors[] = 'Ошибка, нехватает <img src=\'/images/icon/gold.png\' alt=\'*\'> '.(250 - $user['g']).' золота<div class=\'separator\'></div><a href=\'/trade/\' class=\'btn\'><span class=\'end\'><span class=\'label\'>Купить</a></span></span>';  
if(!preg_match('/[a-z0-9а-я]{2,20}/i', $login)) $errors[] = 'Ошибка, имя персонажа введено не верно';
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `login` = \''.$login.'\''),0) != 0) $errors[] = 'Ошибка, персонаж с такими именем уже зарегестрирован';
        
if($errors) {
echo '<div class=\'main\' align=\'center\'>';
foreach($errors as $error) {
echo $error.'<br/>';
}    
echo '</div><div class=\'mini-line\'></div>';
}else{
mysql_query('UPDATE `users` SET `login` = \''.$login.'\',`g` = `g` - 250 WHERE `id` = \''.$user['id'].'\'');
header('location: /');
}
}
 
$password = _string($_POST['password']);
if($password) {  
if(!preg_match('/[a-z0-9]{2,20}/i', $password)) $errors[] = 'Ошибка, пароль введен неверно';
  
if($errors) {
echo '<div class=\'main\' align=\'center\'>';
foreach($errors as $error) {
echo $error.'<br/>';
}
echo '</div><div class=\'mini-line\'></div>';
}else{
mysql_query('UPDATE `users` SET `password` = \''.$password.'\' WHERE `id` = \''.$user['id'].'\'');
setCookie('password', $password, time() + 86400, '/');
header('location: /');
} 
}
 
echo '<div class=\'menuList\'>
<li><a href=\'/settings/exit/\'>Покинуть клан</a>';

if($_GET['action']) {
echo '<div class=\'mini-line\'></div><div class=\'main\'>';

switch($_GET['action']) {
case 'login':
echo '<form action=\'/settings/login/\' method=\'post\'>
  Введите новое имя:<br/>
  <input name=\'login\'/><br/>
 <span class=\'btn\'><span class=\'end\'><input class=\'label\' type=\'submit\' name=\'send_message\' value=\'Сменить\'/>Сменить
</form></span></span>';
break;

case 'password':
echo '<form action=\'/settings/password/\' method=\'post\'>
  Введите новый пароль:<br/>
  <input name=\'password\'/><br/>
  <span class=\'btn\'><span class=\'end\'><input class=\'label\' type=\'submit\' name=\'send_message\' value=\'Сменить\'/>Сменить
</form></span></span></form>';
break;

case 'race':
if($_GET['change'] == true && $user['g'] >= 50) {  
mysql_query('UPDATE `users` SET `r` = "'.($user['r'] == 0 ? 1:0).'", `g` = `g` - 50 WHERE `id` = "'.$user['id'].'"');
header('location: /');
}
echo 'Текущая сторона: <img src=\'/images/icon/race/'.$user['r'].'.png\' alt=\'*\'/> '.($user['r'] == 0 ? 'Асура':'Борея').'<br/>
Желаете сменить сторону на <img src=\'/images/icon/race/'.($user['r'] == 0 ? 1:0).'.png\' alt=\'*\'/> '.($user['r'] == 0 ? 'Борея':'Асура').'?<br/><br/>
<a href=\'/settings/race/?change=true\' class=\'btn\'><span class=\'end\'><span class=\'label\'>Да,сменить</a></span></span>';
break;

case 'sex':
if($_GET['change'] == true) {  
mysql_query('UPDATE `users` SET `sex` = \''.($user['sex'] == 0 ? 1:0).'\' WHERE `id` = \''.$user['id'].'\'');
header('location: /');
}
echo '<div class="block_zero">Вы уверены что хотите сменить пол на <b>'.($user['sex'] == 0 ? 'Женский':'Мужской').'</b>?<br/>
<a class="btn" href="/settings/sex/?change=true"><span class="end"><span class="label">Да, сменить</span></span></a></div>';
break;

case 'exit':
echo '<form class="block_zero center" action=\'/settings/exit/\' method=\'post\'>Вы уверены что хотите покинуть клан?<br/>
<a class="btn" href="/exit"><span class="end"><span class="label">Да, уверен</span></span></a>
</form>';
break;

echo '</div>';
} 
echo '</div>';
}  
include './system/f.php';

?>