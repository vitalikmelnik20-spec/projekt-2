<?php
include './system/common.php';
include './system/functions.php';
include './system/user.php';
if(!$user) {
header('location: /');
exit;
}
if(isset($_GET['top'])){
$title = 'Топ пар';
include './system/h.php';
$max = 15;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `zags` WHERE `status` = "da"'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));
if($page > $pages) {
$page = $pages;
}
if($page < 1) {
$page = 1;
}
$start = $page * $max - $max;
$q = mysql_query('SELECT * FROM `zags` WHERE `status` = "da" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');
echo "<div class='block_zero'>";
if($count == 0)echo "Нет пар<br>";
while($post = mysql_fetch_array($q)) {
$ank = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$post['id_0'].'"');
$ank = mysql_fetch_array($ank);
$ank2 = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$post['id_1'].'"');
$ank2 = mysql_fetch_array($ank2);
echo "<a href='/user/$ank[id]/'>$ank[login]</a> женат на <a href='/user/$ank2[id]/'>$ank2[login]</a>";
echo "<div class='dot-line'></div>";
}
pages('/zags/?top&');
echo "</div>";
include './system/f.php';
break;
}
$zags = mysql_query('SELECT * FROM `zags` WHERE `id_0` = "'.$user['id'].'" OR `id_1` = "'.$user['id'].'"');
$zags = mysql_fetch_array($zags);
if(!$zags and $user['sex'] == 0){
mysql_query('INSERT INTO `zags` SET `id_0` = "'.$user['id'].'", `status` = "off"');
header("Location: ?");
exit();
}
if(isset($_GET['noviz'])){
mysql_query('UPDATE `zags` SET `id_1` = "0", `status` = "off" WHERE `id` = "'.$zags['id'].'"');
$_SESSION['ok'] = 'Заявка отменина';
header("Location: /zags/?".rand(4999,5999));
exit();
}
if(isset($_GET['post'])){
if(isset($_POST['login'])){
$login = mysql_query('SELECT * FROM `users` WHERE `login` = "'.$_POST['login'].'"');
$login = mysql_fetch_array($login);
if(!$login)$err = 'Такой девушки не существует';
if($login['sex'] == 0)$err = 'Гомосекам здесь не место';
if($user['g'] < 500)$err = 'Не достатачно золота';
if(!$err){
mysql_query('UPDATE `zags` SET `id_1` = "'.$login['id'].'", `status` = "net" WHERE `id` = "'.$zags['id'].'"');
mysql_query('UPDATE `users` SET `g` = "'.($user['g']-500).'" WHERE `id` = "'.$user['id'].'"');
$_SESSION['ok'] = 'Заявка успешно отправлена';
header("Location: /zags/?".rand(4999,5999));
exit();
}else{
$_SESSION['error'] = $err;
header("Location: /zags/?".rand(4999,5999));
exit();
}
}else{
$_SESSION['error'] = 'Введите ник жены';
header("Location: /zags/?".rand(4999,5999));
exit();
}
}
if(isset($_GET['vizok']) and $user['sex'] == 1){
mysql_query('UPDATE `zags` SET `status` = "da" WHERE `id` = "'.$_GET[vizok].'"');
$_SESSION['ok'] = 'Теперь вы замужняя';
header("Location: /zags/?".rand(4999,5999));
exit();
}
if(isset($_GET['vizno']) and $user['sex'] == 1){
mysql_query('UPDATE `zags` SET `status` = "off" WHERE `id` = "'.$_GET[vizno].'"');
$_SESSION['ok'] = 'Заявка отменена';
header("Location: /zags/?".rand(4999,5999));
exit();
}
if(isset($_GET['razvod']) and $zags['status'] == 'da'){
mysql_query('UPDATE `zags` SET `status` = "off" WHERE `id` = "'.$zags['id'].'"');
$_SESSION['ok'] = 'Теперь вы свободны';
header("Location: /zags/?".rand(4999,5999));
exit();
}
$title = 'Загс';
include './system/h.php';
if(isset($_SESSION['error'])){
echo "<div class='error center'><img src='/images/icon/error.png'> $_SESSION[error]</div>";
unset($_SESSION['error']);
}
if(isset($_SESSION['ok'])){
echo "<div class='ok center'><img src='/images/icon/ok.png'> $_SESSION[ok]</div>";
unset($_SESSION['ok']);
}
echo "<div class='menuList'><li><a href='?top'><img src='/images/icon/user.png' width='16px'>Наши пары</a></li></div><div class='mini-line'></div>";
$w = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$zags['id_1'].'"');
$w = mysql_fetch_array($w);
if($user['sex'] == 1){
$zags = mysql_query('SELECT * FROM `zags` WHERE `id_1` = "'.$user['id'].'" AND `status` = "da"');
$zags = mysql_fetch_array($zags);
if($zags){
$m = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$zags['id_0'].'"');
$m = mysql_fetch_array($m);
echo "<div class='block_zero center'>";
echo "Вы замужем за <a href='/user/$m[id]/'>$m[login]</a>";
echo "<div class='center'>";
echo "<a href='?razvod' class='btn'><span class='end'><span class='label'>Развестись</a>";
echo "</div>";
echo "</div>";
}else{
$max = 15;
$count = mysql_result(mysql_query('SELECT COUNT(*) FROM `zags` WHERE `id_1` = "'.$user['id'].'" AND `status` = "net"'),0);
$pages = ceil($count/$max);
$page = _string(_num($_GET['page']));
if($page > $pages) {
$page = $pages;
}
if($page < 1) {
$page = 1;
}
$start = $page * $max - $max;
$q = mysql_query('SELECT * FROM `zags` WHERE `id_1` = "'.$user['id'].'" AND `status` = "net" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');
echo "<div class='block_zero'>";
if($count == 0)echo "Заявок на свадьбу нет<br>";
while($post = mysql_fetch_array($q)) {
$ank = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$post['id_0'].'"');
$ank = mysql_fetch_array($ank);
echo "<a href='/user/$ank[id]/'>$ank[login]</a> хочет на вас жениться...";
echo "<div class='center'>";
echo "<a href='?vizok=$post[id]' class='btn'><span class='end'><span class='label'>Приньть</a><br><a href='?vizno=$post[id]' class='grey'>Отказаться</a>";
echo "</div>";
echo "<div class='dot-line'></div>";
}
pages('/zags/?');
echo "</div>";
}
}else{
if($zags['status'] == 'da'){
echo "<div class='block_zero center'>";
echo "Вы женаты на: <a href='/user/$w[id]/'>$w[login]</a>";
echo "<div class='center'>";
echo "<a href='?razvod' class='btn'><span class='end'><span class='label'>Развестись</a>";
echo "</div>";
echo "</div>";
}elseif($zags['status'] == 'off'){
echo "<div class='block_zero center'>";
echo "Вы не женаты...";
echo "</div>";
echo "<div class='dot-line'></div>";
echo "<form class='block_zero center' action='?post' method='post'>";
echo "Введите ник жены<br><input class='text medium-text' name='login' value=''><br/>";
echo "<span class='btn'><span class='end'><input class='label' type='submit' value='Отправить заявку'/>Отправить заявку</span></span><br>";
echo "<span class='grey'>Стоимость: <img src='/images/icon/gold.png'> 500 золота</span>";
echo "</form>";
}
if($zags[status] == 'net'){
echo "<div class='block_zero center'>";
echo "<a href='/user/$w[id]/'>$w[login]</a>, еще не принила вашу заявку...<br>";
echo "<a href='?noviz' class='btn'><span class='end'><span class='label'><span class='grey'>Отменить заявку</span></span></span></a>";
echo "</div>";
}
echo "<div class='mini-line'></div>";
echo "<ul class='hint'>";
echo "<li>Женившись вам не будет предоставленно ни каких привилегий.</li>";
echo "</ul>";
}
include './system/f.php';
?>