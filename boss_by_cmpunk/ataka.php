<?
include_once '../system/common.php';
    
include_once '../system/functions.php';
        
include_once '../system/user.php';

include_once '../system/h.php';
    
auth();
$health = 50;
if (isset($_GET['id']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `boss` WHERE `id` = '".intval($_GET['id'])."'"),0) == true){
$boss = mysql_fetch_assoc(mysql_query("SELECT * FROM `boss` WHERE `id`  = '".intval($_GET['id'])."'"));
}else{
echo "<div class='h'>Босс не найден</div>";
}
if($user['level'] < $boss[lvl]){
echo "<div class='content'>Уровень босса выше вашего ".$boss['lvl']."</div>";
}else{
if($user['hp'] < 20){
echo "<Div class='content'>Для нападения нужно 20 Здоровья и 250 маны</div>";

}
if($user['mp'] < 300){
echo "Для нападения надо 300 маны";

}else{
$title = 'Босс '.$boss['name'];
include './system/h.php';  
$bos_param = $boss['sila'] + $boss['health'] + $boss['lovk'] + $boss['zashit'];
$boss_param = $bos_param;

$user_param = $user['str'] + $user['vit'] + $user['agi'] + $user['def'] ;
if($boss_param > $user_param){

mysql_query("update `users` set `hp` = '".($user['hp']-$health)."',`mp`='".($user['mp']-300)."' where (`id` = '".$user['id']."')");

echo "<font color='red'>Вас убил босс</font>";

}else{

mysql_query("update `users` set`s` = '".($user['s']+$boss['s'])."',`rub` = '".($user['rub']+$boss['rub'])."', `exp` = '".($user['exp']+$boss['exp'])."',`g` = '".($user['g']+$boss['gold'])."',`hp` = '".($user['hp']-$health)."',`mp`='".($user['mp']-300)."' where (`id` = '".$user['id']."')");

echo "<div class='content'><center><img src='http://od.tiwar.mobi/images/town/hd/hell.jpg'><br>
 </center> <br>  Вы убили босса <img src='http://od.tiwar.mobi/images/icon/silver.png' alt=''/> ".$boss[s]."  <img src='http://213.239.195.28/xaos/16x16/ruby.png' alt=''/> ".$boss[rub]." <img src='/images/icon/gold.png' alt=''/> ".$boss[gold]." золота <img src='/images/icon/exp.png' alt='exp'/> ".$boss[exp]." опыта</centre><br> 
     <a href='ataka.php?id=$boss[id]'><centre> Сразиться еще раз</centre></a></div>";

}
}
}
include_once '../system/f.php';
?>