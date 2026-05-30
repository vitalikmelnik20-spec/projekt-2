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

if (isset($_SESSION['sexerrgold'])){
echo "".$_SESSION['sexerrgold']."";
$_SESSION['sexerrgold']=NULL;
}

if($_GET['sex'] == true) { 
if($user['g'] < 10) $errors[] = '<div class="center"><div class="block_light"><span class="white">Нужно больше золота!</span><div class="separ"></div><form action="/trade/" method="post"><span class="btn"><span class="end"><input class="label" value="Купить золото" type="submit">Купить золото</span></span></form><span class="grey"><img src="/images/icon/gold.png" alt="">'.(10 - $user['g']).' золота</span></div></div><div class="mini-line"></div>';  
if($errors) {
foreach($errors as $error) {
$_SESSION['sexerrgold'] = ''.$error.'';
}
header('location: /settings/sex/');
}else{
mysql_query('UPDATE `users` SET `sex` = \''.($user['sex'] == 0 ? 1:0).'\', `g` = `g` - 10 WHERE `id` = \''.$user['id'].'\'');
$_SESSION['ussex'] = '<div class="ok center"><img src="/images/icon/ok.png" alt=""> Пол персонажа был успешно изменён!</div>';
header('location: /settings/');
}  
}
?>

<div class="block_zero center">
<div>Текущий пол: <span class="blue"><?=($user['sex'] == 0 ? 'Мужской':'Женский')?></span>
<br>Желаете сменить пол на <span class="blue"><?=($user['sex'] == 0 ? 'Женский':'Мужской')?></span>?<br>
<span class="grey">Стоимость: <img src="/images/icon/gold.png" alt="">10 золота</span>
<div class="mb10"></div>
<a class="btn" href="/settings/sex/?sex=true"><span class="end"><span class="label"> Да, сменить</span></span></a>
<br>
<a href="/settings/">Нет, отмена</a>
</div>
</div>

<div class="mini-line"></div>
<div class="menuList">
<li><a href="/settings/"><img src="/images/icon/arrow.png" alt="">Вернуться в настройки</a></li>
</div>

<?
include './system/f.php';
?>