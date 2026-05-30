<?php
$sql_host="localhost";
$sql_id="db1488015297";
$sql_pass="123456";
$sql_db="db1488015297";
$link = @mysql_connect ("$sql_host", "$sql_id", "$sql_pass") or die ("Нема конекта");
$link2 = @mysql_select_db("$sql_db") or die ("aaa");
mysql_query("SET NAMES 'utf8'");
$query = mysql_query("SELECT * FROM `users`");
while($user = mysql_fetch_assoc($query)){
/*распределим по лигам имеющихся игроков, тут измените по своим параметрам в зависимости от уровней у вас*/	
if($user['level'] >= "1" && $user['level'] <= "20"){
	
  mysql_query("UPDATE `users` SET `league_place` = '1000',`league` = '1',`league_fights` = '25' WHERE `id` = '".$user['id']."'");
  
}elseif($user['level']>="20" && $user['level']<='30'){
	
  mysql_query("UPDATE `users` SET `league_place` = '1000',`league` = '2',`league_fights` = '25' WHERE `id` = '".$user['id']."'");
  
}elseif($user['level']>="30" && $user['level']<='50'){
	
  mysql_query("UPDATE `users` SET `league_place` = '1000',`league` = '3',`league_fights` = '25' WHERE `id` = '".$user['id']."'");
  
}elseif($user['level']>="50" && $user['level']<='80'){
	
  mysql_query("UPDATE `users` SET `league_place` = '1000',`league` = '4',`league_fights` = '25' WHERE `id` = '".$user['id']."'");
  
}elseif($user['level']>="80" && $user['level']<='100' ){
	
  mysql_query("UPDATE `users` SET `league_place` = '1000',`league` = '5',`league_fights` = '25' WHERE `id` = '".$user['id']."'");
  
}elseif($user['level']>="100"){
	
  mysql_query("UPDATE `users` SET `league_place` = '1000',`league` = '6',`league_fights` = '25' WHERE `id` = '".$user['id']."'");

}
}
?>
