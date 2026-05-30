<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';    
if(!$user) {
header('location: /');   
exit;
}
$title = 'Турниры';
include './system/h.php';  
?>

<div class="block_zero center blue">Великие турниры титанов!<br></div>

<div class="mini-line"></div>
<div class="center"><div class="block_zero"><img src="/images/town/hd/fights.jpg" alt="" width="100%"></div></div>
<div class="mini-line"></div>

<div class="menuList">
<li><a href="/turnir/" class='grey'><img src='/images/icon/lab.png' alt=''/>Турнир дуэлей</a></li>
<li><a href="/vb.php/" class='grey'><img src='/images/icon/lab.png' alt=''/> Великая битва</a></li>
<li><a  class='grey'><center>Турниры клана</center></a></li>
<li><a href="/clanr.php" class='grey'><img src='/images/icon/lab.png' alt=''/>Рейтинг Арены Клана</a></li>
<div>
<?
include './system/f.php';
?>