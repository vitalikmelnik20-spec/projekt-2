<?
    include './system/common.php';
 include './system/functions.php';
      include './system/user.php';
if(!$user OR !empty($user['code'])) {
	header('location: /');
	exit;
}
$title="Казино";
include './system/h.php';  




$bazaar=mysql_fetch_array(mysql_query("SELECT * FROM `bazaar` WHERE `id`='1'"));






if (isset($_SESSION['msg'])){
echo "<div class=' backfon-3 backten-y'><center>$_SESSION[msg]</center></div>";
$_SESSION['msg']=NULL;
}
$sack=mysql_fetch_array(mysql_query("SELECT * FROM `sack` WHERE `user`='".$user['id']."'"));

if(!$sack){
	mysql_query("INSERT INTO `sack` SET `user`='".$user['id']."'");
	header("location:?");
	exit;
}








if($_GET['open']==1){
if($user[kazino]<1){
$_SESSION['msg']="<a class='button-red backgreen ib '>У вас нет фишек</a>";
header('location:?');
exit();
}





// шанс сорвать джекпот


if($user['id']>0){
$random=rand(1,1000);
}

if($bazaar[luck]>200){
$random=rand(1,100);
}

if($random==1){
$sum = $bazaar[luck];	
$img="<img src='/images/icon/gold.png'/>";
$name="";
mysql_query("UPDATE `users` SET `g`='".($user[g]+$sum)."' WHERE `id`='$user[id]'");
mysql_query("UPDATE `bazaar` SET `luck` = `luck` - '".$bazaar[luck]."' WHERE `id` = '1'");
// в лог админки

$time = time(); //Ничего не трогаем
$read = '0'; // Ничего не трогаем
$to = $user['id']; // Ничего не трогаем
$from = $user['id']; 
$text = 'сорвал джекпот '.$sum.' Золота'; // Текст сообщения

mysql_query("INSERT INTO `admin_log` SET `user_id` = '$from',`time` = '$time', `text` = '$text', `num` = '$sum'");


 ////// Сообщение в чате
mysql_query("INSERT INTO `chat` SET `user`='2', `text`=' ".$user[login]." сорвал Джекпот: ".$sum." Золота', `time`='".time()."'");

//выполнение квеста 
//сорвать джекпот
$q = mysql_query ('select * from `user_q` WHERE (`user`="' . $user['id'] . '") AND (`complete`="0")');
if (mysql_num_rows ($q) != 0) {
while ($user_q = mysql_fetch_array ($q)) {
$q_ = mysql_query ('SELECT * FROM `quest` WHERE (`id`="' . $user_q['q'] . '")');
$quest = mysql_fetch_array ($q_);
if ($user_q['c']<$quest['c']) {
                
if ($quest['place']=='8') {
                
if ($quest['type']=='0') {
mysql_query ('UPDATE `user_q` SET `c`=`c`+1 WHERE (`user`="' . $user['id'] . '") AND (`q`="' . $quest['id'] . '")');
}}}}}
}



// кол-во призов
$nominal=rand(1,2);


// Серебро
if($nominal==1){
$sum=rand(200,6000);
$img="<img src='/images/icon/silver.png'/>";
$name="";
mysql_query("UPDATE `users` SET `kazino`='".($user[kazino]-1)."',`s`='".($user[s]+$sum)."' WHERE `id`='$user[id]'");
mysql_query("UPDATE `bazaar` SET `luck`=`luck`+'0' WHERE `id`='1'");
}



// ЗОЛОТО
if($nominal==2){
$sum=rand(7,150);
$img="<img src='/images/icon/gold.png'/>";
$name="";
mysql_query("UPDATE `users` SET `kazino`='".($user[kazino]-1)."',`g`='".($user[g]+$sum)."' WHERE `id`='$user[id]'");
mysql_query("UPDATE `bazaar` SET `luck`=`luck`+'1' WHERE `id`='1'");
}










$_SESSION['msg']="<a class='button-green backgreen ib '>Получено: $sum $img</a>";
header('location:?');
exit;
}


















echo '

<center><img style="width: 100%;" src="/images/card_fon.png"></center>
<center>Крути Казино</center>
<center><a href="?open=1" class="btn"><span class="end"><span class="label">Начать крутить казино</a></span></span>
';
?>


<center>Стоимость фишки 50 <img src='/images/icon/gold.png'> , у тебя фишек <?=$user['kazino']?><br> <a href="?buy" class='btn'><span class='end'><span class='label'>Купить фишку</a></span></span>


<? // покупка фишки
if (isset($_GET['buy']) && $user['g']>=50){
mysql_query("UPDATE `users` SET `kazino`=`kazino`+'1' WHERE `id`='".$user['id']."'");
mysql_query("UPDATE `users` SET `g`=`g`-'50' WHERE `id`='".$user['id']."'");
header('Location: /game/');
}?>



<?
include './system/f.php';  
?>