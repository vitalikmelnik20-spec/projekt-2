<?php

/*
Выполнить sql запрос в базу
ALTER TABLE `users` ADD `ulogin_network` VARCHAR(16) NULL DEFAULT NULL AFTER `password`, ADD `ulogin_uid` VARCHAR(64) NULL DEFAULT NULL AFTER `ulogin_network`;

В файле index.php заменить <div id="uLogin_21423521" data-uloginid="21421421"> на свое значение
Ссылка для редиректа: http://domen.ru/ulogin.php
*/

if (isset($_POST['token'])) {

$s = file_get_contents('http://ulogin.ru/token.php?token='.$_POST['token'].'&host='.$_SERVER['HTTP_HOST']);
$user = json_decode($s, true);
//$user['network'] - соц. сеть, через которую авторизовался пользователь
//$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
//$user['first_name'] - имя пользователя
//$user['last_name'] - фамилия пользователя

if (isset($user['network']) && isset($user['identity']) && isset($user['uid'])) {

    include './system/common.php';
    include './system/functions.php';

    $login = trim($user['first_name']);
    $network = trim($user['network']);
    $uid = md5($user['uid'].'CnWSLb');

    $user = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `ulogin_network` = "'.$network.'" AND `ulogin_uid` = "'.$uid.'" LIMIT 1'));

    if($user) {
        setCookie('id', $user['id'], time() + 86400, '/');
        setCookie('uid', $uid, time() + 86400, '/');
        header('location: /');
        exit;
    } else {
        if(mysql_query('INSERT INTO `users` (`login`, `ulogin_network`, `ulogin_uid`) VALUES ("'.$login.'", "'.$network.'", "'.$uid.'")')) {
            $id = mysql_insert_id();

            if($ref) {
                $ref_user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$ref.'"');
                $ref_user = mysql_fetch_array($ref_user);

                if($ref_user) {
                    mysql_query('INSERT INTO `ref` (`user`,
                                      `ho`) VALUEs ("'.$ref_user['id'].'",
                                                                "'.$id.'")');
                    mysql_query("UPDATE `users` SET `s`  = `s`+ '1000' WHERE `id` = '$ref_user[id]'");

                }
            }

            $user = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
            $user = mysql_fetch_array($user);
$_u = 1;
$_save = 1;
$_g = 45000;
$_noc = 0;
$_s = 250000;
$_bos = 100000;
mysql_query('UPDATE `users` SET `hp` = "'.($user['vit'] * 2).'",`mp` = "'.$user['mana'].'" WHERE `id` = "'.$id.'"');
mysql_query('UPDATE `users` SET `save`  ="'.$_save.'",`g`  ="'.$_g.'",`s`  ="'.$_s.'",`boshp`  ="'.$_bos.'", `bosshp`  ="'.$_bos.'",`noc`  ="'.$_noc.'" WHERE `id` = "'.$id.'"');
////////Mail 
$text = 'Привет удачи в игре.
Вас ожидает множество вкусностей, частые обновления и многое другое. 
Вам выдано на развитие 45000 золота и 250000 серебра 
Арена до 15 уровня вы будешь атаковать по 1 разу а с 16 будет доступна кнопка провести все бои!
С 20 уровня тебе будет доступен ежедневный босс в нем золото/опыт/серебро!
А в городе есть:
У нас есть мини игры Фортуна/Сундук
Покупка золота - очень дешёвое золото 1000 ровно 1 рубль , если ты с Украины то 2500 ровно 1грн  можно купить у Админа Безумный 
а также есть Священный храм  там  игроки могут пожениться :)
Есть хижина мудреца там Можно выполнить задания или получить трофей
Я советую перейти тебе в Мой герой -> Тренировка и про качать персонажа 
За тренировку дают мастерство  а чем больше его тем больше комплектов у тебя открыто!
Мана нужна для боёв на арене или в дуэлях ну много где так же как и здоровье!


'; // Текст сообщения
$time = time(); //Ничего не трогаем
$read = '0'; // Ничего не трогаем
$to = $user['id']; // Ничего не трогаем
$from = '3'; // Ид отправителя сообщения (от кого)

mysql_query("INSERT INTO `mail` SET `from` = '$from',`time` = '$time', `read` = '$read',`to`='$to',`text` = '$text'");

   mysql_query('INSERT INTO `contacts` (`user`,`ho`, `time`) VALUES (\''.$user['id'].'\',  \'3\',    \''.time().'\')');

            setCookie('id', $user['id'], time() + 86400, '/');
            setCookie('uid', $uid, time() + 86400, '/');
            header('location: /');
            exit;
        }
    }
} else {
    header('Location:/');
    exit;
}

} else {
    header('Location:/');
    exit;
}
?>