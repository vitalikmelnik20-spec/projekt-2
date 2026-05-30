<?
include_once './system/common.php';  
include_once './system/functions.php';
include_once './system/user.php';
        
$title = 'Игра';
include_once './system/h.php';  
noauth();
if($_POST){ 
	$login = $_POST['login'];
$password = $_POST['password'];
$password_has = sha1(md5(md5(sha1(md5(sha1($password))))));
$q = mysql_query('SELECT * FROM `users` WHERE `login` = "'.$login.'" AND `password` = "'.$password_has.'" LIMIT 1');
$user_1 = mysql_fetch_array($q);
if($user_1['login'] != $login AND $user_1['password'] != $password_has){
    $error = $error . 'Неправильный логин или пароль';
}

if(empty($error)) {
	session_start();
	$hid = base64_encode($user_1['id']);
    $_SESSION['id'] = $hid;
    $_SESSION['password'] = $password_has;
    setCookie('id', $hid, time() + 86400, '/');
setCookie('password', $password_has, time() + 86400, '/');
header('location: /menu');
$_SESSION['news'] = '<div class="block_light center">Добро пожаловать в мир титанов<br/> Приятной игры!<img src="/images/smiles/mini_ulibka.gif" alt=""></div>';
}else{
    echo $error;
}
}

$ref = _string(_num($_GET['ref']));
?> 
<div class="center"><div class="LogotypeINDEX"><img alt="" src="/assets/img/logo.png" style = "max-width:100% !important;"/></div></div>
<div class="block_zero center">
<h1>Сражайся вместе с нами</h1>
<span class="medium">
Впервые на мобильниках. Игра, о которой ходят легенды
<br/>
Теперь к легенде можешь прикоснуться и ты!
</span>
<div class="mb10"></div>
<h1 class="yellow">В игре уже <?=n_f(mysql_result(mysql_query('SELECT COUNT(*) FROM `users`'),0))?> игроков!</h1>
</div>
<div class="mini-line" style="margin-top:5px;"></div>
<div class="block_zero center" style="padding-top:15px;"><div class="bigBtn"><a class="btn" href="/start/<?=$ref?>"><img alt="" src="/assets/img/2.png"></a></div></div>
<div class="separ"></div>

<?
if(isset($_GET['sign_in'])){
echo '
<div class="block_zero center" style="padding-bottom:8px;">
<form action = "" method="post">
<div style="margin-bottom:10px;">Имя персонажа:<br/>
<input required name="login" value="" type="text"/>
<br/>Пароль:<br/>
<input required name="password" type="password"/>
<br/>
<input class = "vhod" value="Войти" type="submit"/>
</div>
<a class="btn" href="/repass/">Забыли пароль?</a>
</form>
</div>
';
}else{
	echo '
<div class = "tab center">
<div><a href="/?sign_in">Войти</a></div>
</div>
';
}
?>

<div class="mini-line"></div>
<div class="block_zero">
<div class="center"><img src="/images/icon/2hit.png" alt=""> <span class="bold">Об игре</span> <img src="/images/icon/2hit.png" alt=""></div>
<ul>
«Битва титанов» - захватывающая игра, для мобильных телефонов
<br/>
Сражения, приключения, общение, любовь - всё это, неотъемлемая часть нашего мира
</ul>
</div>

<?
include_once './system/f.php';
?>