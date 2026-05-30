<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';  
 
if(!$user) {
header('location: /');
exit;
}


switch($_GET['action']) {
default:

$title = 'Настройки';    
include './system/h.php'; 

if (isset($_SESSION['passerr'])){
echo "".$_SESSION['passerr']."";
$_SESSION['passerr']=NULL;
}

if (isset($_SESSION['usname'])){
echo ''.$_SESSION['usname'].'';
$_SESSION['usname']=NULL;
}
if (isset($_SESSION['ussex'])){
echo ''.$_SESSION['ussex'].'';
$_SESSION['ussex']=NULL;
}
if (isset($_SESSION['usrace'])){
echo ''.$_SESSION['usrace'].'';
$_SESSION['usrace']=NULL;
}
if (isset($_SESSION['uspass'])){
echo ''.$_SESSION['uspass'].'';
$_SESSION['uspass']=NULL;
}
if (isset($_SESSION['usemail'])){
echo ''.$_SESSION['usemail'].'';
$_SESSION['usemail']=NULL;
}

$password = _string($_POST['password']);
if($password) {  
if(!preg_match('/[a-z0-9]{2,20}/i', $password)) $errors[] = '<div class="error center"><img src="/images/icon/error.png" alt=""> Некорректный пароль персонажа!</div>';

if($errors) {
foreach($errors as $error) {
$_SESSION['namerr'] = ''.$error.'';
}
header('location: /settings/');
}else{
mysql_query('UPDATE `users` SET `password` = \''.$password.'\' WHERE `id` = \''.$user['id'].'\'');
setCookie('password', $password, time() + 86400, '/');
$_SESSION['uspass'] = '<div class="ok center"><img src="/images/icon/ok.png" alt=""> Пароль персонажа был успешно изменён!</div>';
header('location: /settings/');
} 
}
?>

<div class="block_zero">Ник: <span class="blue"><?=$user['login']?></span><br>
<img src="/images/icon/arrow.png" alt=""> <a href="/settings/name/">Изменить <img src="/images/icon/gold.png" alt="">500</a>
</div>
<div class="dot-line"></div>
<div class="block_zero">Сторона: <img src="/images/icon/race/<?=$user['r']?>.png" alt=""> <span class="blue"><?=($user['r'] == 0 ? 'Асура':'Борея')?></span><br>
<img src="/images/icon/arrow.png" alt=""> <a href="/settings/race/">Сменить сторону <img src="/images/icon/gold.png" alt="">1000</a>
</div>
<div class="dot-line"></div>
<div class="block_zero">Пол: <span class="blue"><?=($user['sex'] == 0 ? 'Мужской':'Женский')?></span><br>
<img src="/images/icon/arrow.png" alt=""> <a href="/settings/sex/">Сменить пол</a>
</div>
<div class="dot-line"></div>

<div class="block_zero">
<form action="/settings/" method="post">
<div>Новый пароль:<br>
<input class="text medium-text" name="password" maxlength="16" value="" type="text">
<br>
<span class="btn"><span class="end"><input class="label" name="send_message" value="Сменить" type="submit">Сменить</span></span>
</div>
</form>
</div>
<a href='/exit'><font color=\'#909090\'>Выйти из игры</font></a><br>

<?
if($user['eread'] == 0){
?>
<div class="mini-line"></div>
<div class="block_zero"><img src="/images/icon/arrow.png" alt=""> <a href="/settings/email/">Укажите вашу почту</a></div>
<?
?>
<?
}
if($clan_memb['rank'] == 4){
?>
<?
}
?>


<?
include './system/f.php';
break;

case 'quit':
$title = 'Настройки';

if($clan_memb['rank'] < 4){
header('location: /settings/');
}

$id = _string(_num($_GET['id']));

if(!$id && $clan) {
$id = $clan['id'];
}

$i = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$id.'"');
$i = mysql_fetch_array($i);

if(!$clan['id'] OR $clan['id'] != $i['id']) {
header('location: /settings/');
exit;
}

include './system/h.php'; 
?>

<div class="menuList">
<p>Вы <span class="green">Лидер клана</span>. Вы уверены, что хотите покинуть клан?</p>
<li><a href="/clan/<?=$clan['id']?>/?exit"><img src="/images/icon/ok.png" alt="">Да, уверен</a></li>
<li><a href="/settings/"><img src="/images/icon/error.png" alt="">Нет, отмена</a></li>
</div>

<?
include './system/f.php';
break;
}
?>