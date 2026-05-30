<?
include '../system/common.php';  
include '../system/functions.php';
include '../system/user.php';
        
$title = 'Боссы';
include '../system/h.php';  
auth();

if (isset($_GET['id']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `boss` WHERE `id` = '".intval($_GET['id'])."'"),0) == true){
$boss = mysql_fetch_assoc(mysql_query("SELECT * FROM `boss` WHERE `id`  = '".intval($_GET['id'])."'"));
}else{

header('Location: /');

}
$pets_param1 = $user['silapets'] + $user['vinoslpets'] + $user['healthpets'];
$boss_param = $boss['sila'] + $boss['health'] + $boss['lovk'] + $boss['zashit'];
$user_param = $user['str'] + $user['vit'] + $user['agi'] + $user['def'] ;
$title = 'Босс '.$boss['name'];

include_once '../system/h.php';
echo "<div class='f'>
 <b><center>$boss[name]</b><br></span><br><img src='/images/icon/str.png'> Сила: $boss[sila]<br><img src='/images/icon/vit.png'> Здоровье: $boss[health]<br><img src='/images/icon/agi.png'> Ловкость: $boss[lovk]<br><img src='/images/icon/def.png'> Защита: $boss[zashit]<br><img src='/images/icon/2hit.png'> $boss_param VS $user_param (<span class='dgreen'>+$pets_param1</span>)
 <br><br><a class='btn' href='/boss_by_cmpunk/ataka.php?id=$boss[id]'><span class='end'><span class='label'>Атаковать</span></span></a><br><br></center>";
include_once '../system/f.php';
?>