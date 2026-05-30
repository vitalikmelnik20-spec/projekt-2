<?php
$sql_host="localhost";
$sql_id="db1488015297";
$sql_pass="123456";
$sql_db="db1488015297";

	$link = @mysql_connect ("$sql_host", "$sql_id", "$sql_pass") or die ("Нема конекта");
	$link2 = @mysql_select_db("$sql_db") or die ("aaa");
$aluko = mysql_fetch_assoc(mysql_query("SELECT * FROM `aluko` ORDER BY `id` LIMIT 1"));	
$rand = rand(100000,200000);
if($aluko['health']==0){	
mysql_query("UPDATE `aluko` SET `health`= '".$rand."', `max_health` = '".$rand."'");	
}
?>