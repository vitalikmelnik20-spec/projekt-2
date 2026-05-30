<?
    
    include '../system/common.php';
    
 include '../system/functions.php';
        
      include '../system/user.php';
    
auth();

$title = 'Волшебный сундук';    

include '../system/h.php';  
  switch ($act) {
  	case 'go':
  	if($user['key'] == 0){
  		$error = $error . 'У вас нету ключей!';
  	}
  	if(empty($error)){
echo '<div class = "center" >
<img src="/images/1.png" height="60">';
$rand = rand(0,100);
mysql_query("update `users` set `key` = `key` - 1 where `id` = '".$user['id']."'");
if($rand == 0) {
echo '<div class="block_zero center">В этом сундуке ничего нет!</div>';
}
if($rand >= 1 AND $rand <= 50){
  $rand_ser = rand(10,1000);
  echo '<a href="/sunduk"><div class="block_zero center">Вы нашли: '.$rand_ser.' <img src="/images/icon/s.png"> Серебра!</div>';
mysql_query("update `users` set `s` = `s` + '".$rand_ser."' where `id` = '".$user['id']."'");
}
if($rand >= 51 AND $rand <= 89){
    $rand_ser = rand(10,1000);
  echo '<a href="/sunduk"><div class="block_zero center">Вы нашли: '.$rand_ser.' <img src="/images/icon/s.png"> Серебра!</div>';
mysql_query("update `users` set `s` = `s` + '".$rand_ser."' where `id` = '".$user['id']."'");
}
if($rand >= 90 AND $rand <= 100){
$rangold = rand(0,10);
echo '<a href="/sunduk"><div class="block_zero center">Вы нашли: '.$rangold.' <img src="/images/icon/gold.png"> золота!</div>';
mysql_query("update `users` set `g` = `g` + '".$rangold."' where `id` = '".$user['id']."'");
}
echo '<a href = "/sunduk" class = "butt">Назад</a></div>';
  	}else{
  		echo $error;
  	}
  		break;
  	default:
  		echo '
<div class="center block_zero">
Выбери сундук: <br><br>
<a href="/sunduk/go"><img src="/images/0.png" height="60"></a> 
<div style="margin-right: 6px;"></div>
<a href="/sunduk/go"><img src="/images/0.png" height="60"></a>
<a href="/sunduk/go"><img src="/images/0.png" height="60"></a>
</div><div class="main block_zero">Чтобы открыть сундук нужен ключ который ты можешь найти в <a href="/farm">Походе</a>!
<br>
У тебя: ';
if($user['key'] == 0){
echo '<span class = "red">'.$user['key'].'</span>';
}else{
echo '<span class = "lime">'.$user['key'].'</span>';
}
echo ' ключей
</div>';
  		break;
  }
include '../system/f.php';

?>