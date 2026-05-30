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

if (isset($_SESSION['racerr'])){
echo "".$_SESSION['racerr']."";
$_SESSION['racerr']=NULL;
}
if (isset($_SESSION['racerrgold'])){
echo "".$_SESSION['racerrgold']."";
$_SESSION['racerrgold']=NULL;
}

if($_GET['race'] == true) { 
if($user['g'] < 1000) $errors[] = '<div class="center"><div class="block_light"><span class="white">Нужно больше золота!</span><div class="separ"></div><form action="/trade/" method="post"><span class="btn"><span class="end"><input class="label" value="Купить золото" type="submit">Купить золото</span></span></form><span class="grey"><img src="/images/icon/gold.png" alt="">'.(1000 - $user['g']).' золота</span></div></div><div class="mini-line"></div>';  
if($errors) {
foreach($errors as $error) {
$_SESSION['racerrgold'] = ''.$error.'';
}
header('location: /settings/name/');
}else{
if($clan){
$_SESSION['racerr'] = '<div class="error center"><img src="/images/icon/error.png" alt=""> Ошибка, вы состоите в клане!</div>';
header('location: /settings/race/');
}else{
mysql_query('UPDATE `users` SET `r` = "'.($user['r'] == 0 ? 1:0).'", `g` = `g` - 1000 WHERE `id` = "'.$user['id'].'"');
$_SESSION['usrace'] = '<div class="ok center"><img src="/images/icon/ok.png" alt=""> Сторона персонажа была успешно изменена!</div>';
header('location: /settings/');
} 
} 
}  
?>

<div class="block_zero center">
<form action="/settings/race/?race=true" method="post">
<div>Текущая сторона: <img src="/images/icon/race/<?=$user['r']?>.png" alt=""> <span class="blue"><?=($user['r'] == 0 ? 'Асура':'Борея')?></span>
<br>Желаете сменить сторону на <img src="/images/icon/race/<?=($user['r'] == 0 ? 1:0)?>.png" alt=""> <span class="blue"><?=($user['r'] == 0 ? 'Борея':'Асура')?></span>?<br>
<span class="grey">Стоимость: <img src="/images/icon/gold.png" alt="">1000 золота</span>
<div class="mb10"></div>
<span class="btn"><span class="end"><input class="label" value="Да, сменить" type="submit">Да, сменить</span></span>
<br>
<a href="/settings.">Нет, отмена</a>
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