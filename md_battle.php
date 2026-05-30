<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user OR $user['access'] < 1) {

  header('location: /');
    
exit;

}



$title = 'Великая битва | Управление';    
include './system/h.php';
echo "<div class='title'>$title</div>";

if(isset($_POST['submit'])){
	
	
	$silver_vznos = _num($_POST['silver_vznos']);
    $gold_vznos = _num($_POST['gold_vznos']);
	$wins_gold = _num($_POST['wins_gold']);
	$wins_silver = _num($_POST['wins_silver']);
	$top_gold = _num($_POST['top_gold']);
	$top_silver = _num($_POST['top_gold']);
	$top = _num($_POST['top']);

	
	$time = intval($_POST['time']);
	$time_ban = $_POST['time_ban'];
	///////////////////////////////////////////////////////////////////
	if ($time_ban == 'sek')$timeban = $time;
	if ($time_ban == 'min')$timeban = $time*60;
	if ($time_ban == 'hour')$timeban = $time*60*60;
	if ($time_ban == 'day')$timeban = $time*60*60*24;
	if ($time_ban == 'week')$timeban = $time*60*60*24*7;
	if ($time_ban == 'month')$timeban = $time*60*60*24*7*4;
	$timebanned = time() + $timeban;
	
	
	
	
	  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `tj_admin`'),0) == '0'){
		  
		  mysql_query("INSERT INTO `tj_admin` 
		  SET `silver_vznos` = '$silver_vznos',
		  `gold_vznos` = '$gold_vznos',
		  `wins_gold` = '$wins_gold',
		  `wins_silver` = '$wins_silver',
		  `top_gold` = '$top_gold',
		  `top_silver` = '$top_silver',
		  `top` = '$top',`on/off` = '$timebanned'");

		  mysql_query("DELETE FROM `tj_users`");
		  mysql_query("UPDATE `tj_admin` SET `check_nagrada` = '0'");
	  } else {
		  
		    
		   mysql_query("UPDATE  `tj_admin` 
		  SET `silver_vznos` = '$silver_vznos',
		  `gold_vznos` = '$gold_vznos',
		  `wins_gold` = '$wins_gold',
		  `wins_silver` = '$wins_silver',
		  `top_gold` = '$top_gold',
		  `top_silver` = '$top_silver',
		  `top` = '$top',`on/off` = '$timebanned'");
		  
		  mysql_query("DELETE FROM `tj_users`");
		  mysql_query("UPDATE `tj_admin` SET `check_nagrada` = '0'");
	  }
	  
}
if(isset($_GET['ostanovka']) && mysql_result(mysql_query('SELECT COUNT(*) FROM `tj_admin` WHERE `on/off`'),0) <  time()){
	
	mysql_query("UPDATE `tj_admin` SET `on/off` = '0'");
}
$value = mysql_fetch_array(mysql_query("SELECT * FROM `tj_admin`"));
if($value['on/off'] > time()){
	
	echo '<div class="content">Великая битва начата <br/> 
	Желаете досрочно остановить её?<br/> Битва закончится через: '._time($value['on/off']-time()).'<br/> 
	<a href="?ostanovka">Остановить битву</a></div>';
}else{
	

echo "<div class='content'>
				<form action='' method='post'>
			
			Взнос: Серебро<br/>
			<input type = 'text' name = 'silver_vznos' value='$value[silver_vznos]'> <br/>

	Взнос: Золото<br/>
			<input type = 'text' name = 'gold_vznos' value='$value[gold_vznos]'> <br/>
			
Награда топа: Серебро<br/>
			<input type = 'text' name = 'top_silver' value='$value[top_silver]'> <br/>
			
Награда топа: Золото<br/>
			<input type = 'text' name = 'top_gold' value='$value[top_gold]'> <br/>
			
Награда победителя: Серебро<br/>
			<input type = 'text' name = 'wins_silver' value='$value[wins_silver]'> <br/>
			
Награда победителя: Золото<br/>
			<input type = 'text' name = 'wins_gold' value='$value[wins_gold]'> <br/>
Количество топ игроков: <br/>
			<input type = 'text' name = 'top' value='$value[top]'> <br/>


<center>
Установите время битвы: <br/>
<input name='time' type='text'><br/>
<select name='time_ban'>
<option value='sek'>Секунд</option>
				<option value='min'>Минут</option>
				<option value='hour'>Часов</option>
				<option value='day'>Дней</option>
				<option value='week'>Недель</option>
				<option value='month'>Месяцев</option></select>
				<br/>
					<input type='submit' name='submit' class='button' value='Изменить'/>
				</form>
			</div>
			
			
			
			
			
			

			
			
			";
}
			
include './system/f.php';
?>
