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

if (isset($_SESSION['namerr'])){
echo "".$_SESSION['namerr']."";
$_SESSION['namerr']=NULL;
}

$login = _string($_POST['login']);
if($login) {
if($user['g'] < 500) $errors[] = '<div class="center"><div class="block_light"><span class="white">Нужно больше золота!</span><div class="separ"></div><form action="/trade/" method="post"><span class="btn"><span class="end"><input class="label" value="Купить золото" type="submit">Купить золото</span></span></form><span class="grey"><img src="/images/icon/gold.png" alt="">'.(500 - $user['g']).' золота</span></div></div><div class="mini-line"></div>';  
if(!preg_match('/[a-z-а-я]{2,20}/i', $login)) $errors[] = '<div class="error center"><img src="/images/icon/error.png" alt=""> Некорректный ник персонажа!</div>';
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `login` = \''.$login.'\''),0) != 0) $errors[] = '<div class="error center"><img src="/images/icon/error.png" alt=""> Персонаж с таким ником уже существует!</div>';
   
if($errors) {
foreach($errors as $error) {
$_SESSION['namerr'] = ''.$error.'';
}
header('location: /settings/name/');
}else{
mysql_query('UPDATE `users` SET `login` = \''.$login.'\',`g` = `g`-500 WHERE `id` = \''.$user['id'].'\'');
$_SESSION['usname'] = '<div class="ok center"><img src="/images/icon/ok.png" alt=""> Ник персонажа был успешно изменён!</div>';
header('location: /settings/');
}
}  
?>

<div class="block_zero center">
<form action="/settings/name/" method="post">
<div>Текущий ник: <span class="blue"><?=$user['login']?></span>
<br>Новый ник:<br>
<input class="text medium-text" name="login" maxlength="20" value="" type="text">
<br>
<span class="grey">Стоимость: <img src="/images/icon/gold.png" alt="">500 золота</span>
<div class="mb10"></div>
<span class="btn"><span class="end"><input class="label" value="Изменить ник" type="submit">Изменить ник</span></span>
<br>
<a href="/settings/">Нет, отмена</a>
</div>
</form>
</div>

<div class="mini-line"></div>
<div class="menuList">
<li><a href="/settings/"><img src="/images/icon/arrow.png" alt="">Вернуться в настройки</a></li>
</div>

<?
include './system/f.php';
?>