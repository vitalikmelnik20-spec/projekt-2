<?$online1 = mysql_num_rows( mysql_query('SELECT * FROM `users` WHERE `online` > \''.( time() - (60) ).'\'') );
$online2 = mysql_num_rows( mysql_query('SELECT * FROM `users` WHERE `online` > \''.( time() - (3600) ).'\'') );
$online3 = mysql_num_rows( mysql_query('SELECT * FROM `users` WHERE `online` > \''.( time() - (21600) ).'\'') );
$online4 = mysql_num_rows( mysql_query('SELECT * FROM `users` WHERE `online` > \''.( time() - (86400) ).'\'') );
?>
Онлайн за:</br>
1 мин.:<?=n_f($online1)?></br>
1час.:<?=n_f($online2)?></br>
6 часов.:<?=n_f($online3)?></br>
24 часа.:<?=n_f($online4)?>
<hr>