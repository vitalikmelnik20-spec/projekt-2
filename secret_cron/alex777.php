<?php
$sql_host="localhost";
$sql_id="db1488015297";
$sql_pass="123456";
$sql_db="db1488015297";

	$link = @mysql_connect ("$sql_host", "$sql_id", "$sql_pass") or die ("Нема конекта");
	$link2 = @mysql_select_db("$sql_db") or die ("aaa");
	
mysql_query("SET NAMES 'utf8'");

$q =  explode(":", date('d:m:o'));
/** 
* Формируем заголовок новости
*/
$alPos = 0;
$titleNews = 'Самые лучшие кланы за неделю на '.$q['0'].'.'.$q['1'].'.'.$q['2'].'';
$top_q  = mysql_query("SELECT  `id` FROM `clans` ORDER BY `arena` DESC LIMIT 5");
 while($top = mysql_fetch_assoc($top_q)){
	$alPos++;
$nagrada = 18000 / $alPos;
$name_top = mysql_fetch_assoc(mysql_query("SELECT `id`, `name`, `r`, `arena` FROM `clans` WHERE `id`='".$top['id']."' LIMIT 1"));

$topes_us.= '[center]'.$alPos.' место </br><img src=\'/images/icon/race/'.$name_top['r'].'.png\' alt=\'*\'/> <a href=\'/clan/'.$name_top['id'].'\'>'.$name_top['name'].'</a><br> <img src=\'/images/icon/arena.png\' alt=\'*\'/> рейтинг: '.$name_top['arena'].'<br>награда <img src=\'/images/icon/gold.png\' alt=\'*\'/> '.$nagrada.' в казну[/center]';

	   mysql_query('UPDATE `clans` SET `g`=`g` + '.$nagrada.'  WHERE `id` = '.$name_top['id'].'');


 }

mysql_query('INSERT INTO `forum_topic` (`sub`,
                                        `name`,
										`stick`,
                                        `user`,
                                        `text`,
                                        `time`) VALUES ("1",
                                                             "'.$titleNews.'",
                                                             "0",
                                                       "1",
                                                             "'.$topes_us.'",
                                                           "'.time().'")');
mysql_query('UPDATE `clans` SET  `arena` = "0"');
mysql_query('UPDATE `clan_memb` SET  `arena` = "0"');
?>
