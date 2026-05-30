<?



list($msec, $sec) = explode( chr(32), microtime() );

$online = mysql_num_rows( mysql_query('SELECT * FROM `users` WHERE `online` > \''.( time() - (300) ).'\'') );



if($user['id'] > 0)
{
 echo '
  <div class="svet"></div>
    <div class="bgf center">
        <a href="/menu">
            <img alt="" src="/assets/img/t1.png"/>
        </a>
        <a href="/user/">
            <img alt="" src="/assets/img/t2.png"/>
            '.(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv`WHERE `user` = "'.$user['id'].'"AND `equip` = "0" AND `place` ="0" AND `new` = "0"'),0) > 0 ?'<span class="green">(+)</span>':'').'
        </a>
        <a href="/clan/">
        <img alt="" src="/assets/img/t3.png"/>
        </a>
    </div>
    <div class="svet"></div>
<div class="mt center">
        <a href="/forum"> Форум </a>|
        <a href="/chat"> Чат </a>|
        <a href="/settings"> Настройки </a>|
<a href="/rating/"> Рейтинг </a> | 
<a class="grey" href="/common/">Общее</a>
    </div>
    <div class="svet"></div>
    <div class="menufoot">
        <a href = "/online.php">Онлайн: '.n_f($online).'</a>
    </div>
';
?>
<div class='center'><img src='/images/icon/level.png' alt='lvl'/> <?=$user['level']?> | <img src='/images/icon/gold.png' alt='g'/> <?=$user['g']?> |
 <img src='/images/icon/silver.png' alt='s'/> <?=$user['s']?>
<div class='mb10'></div><a href='https://vk.com/club179312775'>Группа ВК</a></span><div class='mb10'></div></div>


<?php

}

?>

</body></html>
