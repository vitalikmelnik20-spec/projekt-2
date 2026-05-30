<?php
$sql_host="localhost";
$sql_id="name_bd";
$sql_pass="pass_bd";
$sql_db="name_bd";
$link = @mysql_connect ("$sql_host", "$sql_id", "$sql_pass") or die ("Нема конекта");
$link2 = @mysql_select_db("$sql_db") or die ("aaa");
mysql_query("SET NAMES 'utf8'");
/* проверим всех у кого меньше 1000 мест */
$query = mysql_query("SELECT * FROM `users` WHERE `league_place` < 1000");
while($row = mysql_fetch_assoc($query)){
$mesto = ($row['league_place']);
$qq = (1000 - $mesto);
/* если от 850 до 1000 то пропишим всем 1000 место */
if($mesto > '850' && $mesto < '1000'){
echo ''.$row['login'].' '.($mesto + $qq).'<br>';
mysql_query('UPDATE `users` SET `league_place` = "'.($mesto + $qq).'" WHERE `id` = "'.$row['id'].'"');
/* если меньше 850 то рандомно пропишим от 200 мест, до 240. Важно не привышайте лимит 240, иначе пропишится больше 1000 */
}elseif($mesto < '850'){
$q = round(rand(200, 240));
echo ''.$row['login'].' '.($mesto + $q).'<br>';
mysql_query('UPDATE `users` SET `league_place` = "'.($mesto + $q).'" WHERE `id` = "'.$row['id'].'"');
}
}
/*пропишим всем по 25 боев*/
mysql_query("UPDATE `users` SET `league_fights`='25'");
?>
