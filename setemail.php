<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if(!$user) {
header('location: /');   
exit;
}

if($user['eread'] == 1) {
header('location: /settings/');   
exit;
}

$title = 'Настройки';    
include './system/h.php'; 

if (isset($_SESSION['mailerr'])){
echo "".$_SESSION['mailerr']."";
$_SESSION['mailerr']=NULL;
}

$eemail = _string($_POST['email']);
if($eemail) {
if(mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `email` = \''.$eemail.'\''),0) != 0) $errors = '<div class="error center"><img src="/images/icon/error.png" alt=""> Указанный E-mail уже используется!</div>';   
if($errors) {
$_SESSION['mailerr'] = ''.$errors.'';
header('location: /settings/email/');
echo $errors.'';
}else{
mysql_query('UPDATE `users` SET `email` = \''.$eemail.'\',`eread` = \'1\' WHERE `id` = \''.$user['id'].'\'');
$_SESSION['usemail'] = '<div class="ok center"><img src="/images/icon/ok.png" alt=""> E-mail персонажа был успешно изменён!</div>';
header('location: /settings/');
}  
}
?>

<div class="block_zero">
<form action="/settings/email/" method="post">
<div>Ваш e-mail:<br>
<input class="text medium-text" name="email" maxlength="50" value="" type="text">
<br>
<span class="btn"><span class="end"><input class="label" value="Сохранить" type="submit">Сохранить</span></span>
</div>
</form>
<ul class="hint">
<li>Внимание! Задать свой e-mail можно только один раз! Поменять потом нельзя!</li>
<li>E-mail нужен, чтобы вы смогли восстановить свой пароль, если забудете.</li>
</ul>
</div>

<div class="mini-line"></div>
<div class="menuList">
<li><a href="/settings/"><img src="/images/icon/arrow.png" alt="">Вернуться в настройки</a></li>
</div>

<?
include './system/f.php';
?>