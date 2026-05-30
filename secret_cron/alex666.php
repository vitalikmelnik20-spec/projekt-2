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
$titleNews = 'Турнир дуэлей '.$q['0'].'.'.$q['1'].'.'.$q['2'].'';
$top_q  = mysql_query("SELECT  `id` FROM `users` ORDER BY `arena` DESC LIMIT 5");
 while($top = mysql_fetch_assoc($top_q)){
	$alPos++;
$nagrada = 75000 / $alPos;
$name_top = mysql_fetch_assoc(mysql_query("SELECT `id`, `login`, `r`, `arena` FROM `users` WHERE `id`='".$top['id']."' LIMIT 1"));

$topes_us.= '[center]'.$alPos.' место </br><a href=\'/clan/'.$name_top['id'].'\'>'.$name_top['login'].'</a><img src=\'/images/icon/arena.png\' alt=\'*\'/> черепов: '.$name_top['arena'].' награда <img src=\'/images/icon/gold.png\' alt=\'*\'/> '.$nagrada.' игроку[/center]';

	   mysql_query('UPDATE `users` SET `g`=`g` + '.$nagrada.'  WHERE `id` = '.$name_top['id'].'');


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
mysql_query('UPDATE `users` SET  `arena` = "0"');

?>
