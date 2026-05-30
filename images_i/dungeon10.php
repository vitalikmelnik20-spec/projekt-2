<?php
include './system/common.php';
include './system/functions.php';
include './system/user.php';
$title = 'Окрестности города';
$boss = $db->query('SELECT * FROM `boss` WHERE `user` = ?', [$user['id']])->fetch();
$timex = $db->query('SELECT * FROM `users` WHERE `id` = ?', [$user['id']])->fetch();
$action = isset($_GET['action']) ? _string($_GET['action']) : '';
if($action != 'fight' ){
    include('./system/h.php');
}
if(isset($_SESSION['err'])) {
    echo '
    <div class="error center"><img src="/images/icon/error.png">'.$_SESSION['err'].'</div>
    ';
    unset($_SESSION['err']);
}
if(isset($_SESSION['ok'])) {
    echo '
    <div class="ok center"><img src="/images/icon/ok.png">'.$_SESSION['ok'].'</div>
    ';
    unset($_SESSION['ok']);
}
$camp = $db->query('SELECT * FROM `campaign` WHERE `id_user` = ? LIMIT 1', [$user['id']])->fetch();
if(!$camp){
    $db->query('INSERT INTO `campaign` SET `id_user` = ?', [$user['id']]);
    header('Location: /dungeon10');
    exit;
}

$camp_boss = $db->query('SELECT * FROM `campaign_boss` WHERE `id` = ? LIMIT 1', [$camp['boss']])->fetch();

if($camp['time'] <= time() and $camp['status'] == 2 and $camp['user_hp'] != 0 and $camp['boss_hp'] != 0){
    $db->query('UPDATE `campaign` SET `status` = 3, `udar` = 999999999 WHERE `id_user` =  LIMIT 1', [$user['id']]);
    header('Location: /dungeon10');
    exit;
}

if(($action != '' and $action != 'sent') and ($camp['status'] == '0' OR $camp['status'] == '4')) {
    return header('Location: /dungeon10');
}

if($action != 'find' and $camp['status'] == '1') {
    return header('Location: /dungeon10/find');
}

if($action != 'lose' and $camp['status'] == '3'){
    return header('Location: /dungeon10/lose');
}

if($action != 'fight' and $camp['status'] == '2' and $action != 'exit'){
    return header('Location: /dungeon10/fight');
}


switch($action){
    default:
        if(isset($_GET['go'])){
            $boss_id = mt_rand(100, 103);
            if($user['level'] < 10) {
                $boss_hp = rand(300, 500);
            } else {
                $boss_hp = rand(500, 700);
            }
            $db->query('UPDATE `campaign` SET `kol` = `kol` - 0, `status` = 1, `boss` = ?, `boss_stat` = 1, `boss_hp` = ?, `level` = ?, `user_hp` = ?, `udar` = 999999999 WHERE `id_user` = ? LIMIT 1', [$boss_id, $boss_hp, $camp_boss['level'], $user['vit'], $user['id']]);
            $db->query('INSERT INTO `boss` SET `user` = ?, `time` = ?', [$user['id'], time()]);
            header('Location: /dungeon10');
            exit;
        }
        echo '
        <div class="delta"></div>
        <img style="width: 100%;" src="/images/town/hunter1.png">
        <div class="header-title"><span style="color: rgb(228, 208, 105);">Окрестности города</div>
        <div class=" backfon-3 backten-y"><center><br>
        <center>
        <a href="/dungeon10/go/" class="button-green backgreen ib">Пройтись по окрестностям города</a><br>
        <a href="/" class="button-red backgreen ib">Bернуться в город</a>
        ';
        break;

    case 'find':
        if(isset($_GET['fight'])){
            $db->query('UPDATE `campaign` SET `status` = ?, `stone_stat` = ?, `grass_stat` = ?, `time` = ? WHERE `id_user` = ? LIMIT 1', [2, 0, 0, time() + 1200, $user['id']]);
            $db->query('DELETE FROM `campaign_log` WHERE `id_user` = ?', [$user['id']]);
            header('Location: /dungeon10');
            exit;
        }
        echo '
        <div class="header-title">Окрестности города</div>
        <a href="/dungeon10/find/fight">
        <img src="/images/town/hunter1.png" alt="*" width="100%">
        </a>
        <div class="header-title">На вас напал: '.$camp_boss['name'].'
        </div>
        <div class=" backfon-3 backten-y"><div class="blocks-l  textgrey p5 w95pc fzzz pr"><div class="blocks-l-l w64" style="">
        <div style="background: url(/images/mob/'.$camp_boss['id'].'.png); background-size: cover" class=" br6 h54 w54 tac vam"></div></div><div class="blocks-l-t "><div class=" qwest-heder mt-1 "></div><div class="mt3 textorange-2">
        <span style="color: rgb(228, 208, 105);"></div>
        <div class="mt3 textorange-2">
        <span style="color: rgb(228, 208, 105);">
        '.$camp_boss['name'].'<br>
        Здоровье: '.$camp['boss_hp'].'<br>
        Защита: '.$camp_boss['def'].'
        </div></div>
        </div>
        <div class="delta"></div>

        <br>
        <center>	
        <a class="button-51 backgreen ib" href="/dungeon10/find/fight">Начать бой</a>
        ';
        break;
    
    case 'fight':
        if(isset($_GET['win'])){
            $chance = rand(1, 100);
            $xpboss = rand(40, 60);
            if($user['premium'] == 1) {
                $xpboss = $xpboss + ceil($xpboss * (30 / 100));
            }
            if(rand(1, 10) <= 3){
                $crboss = rand(100, 150);
            } else {
                $crboss = 0;
            }
            if(rand(1, 100) <= 2){
                $rubinboss = 1;
            } else {
                $rubinboss = 0;
            }
            $res_3 = 0;
            if($user['hunter'] == 1 and $chance <= 20) {
                $res_3 = 1;
            }
            if($user['hunter'] == 2 and $chance <= 30) {
                $res_3 = 1;
            }
            if($user['hunter'] == 3 and $chance <= 40) {
                $res_3 = 1;
            }
            if($user['hunter'] >= 4 and $chance <= 50) {
                $res_3 = 1;
            }
            $db->query('UPDATE `campaign` SET `status` = ?, `udar` = ? WHERE `id_user` = ? LIMIT 1', [3, 999999999, $user['id']]);
            $db->query('UPDATE `users` SET `mobs` = `mobs` + ?, `exp` = `exp` + ?, `g` = `g` + ?, `rubin` = `rubin` + ?, `res_3` = `res_3` + ? WHERE `id` = ? LIMIT 1', [1, $xpboss, $crboss, $rubinboss, $res_3, $user['id']]);
            $text = '
            За победу в Окрестностях города вы получили: 
            <br>'.$xpboss.'<img src="/images/new/exp.png"> 
            '.($crboss > 0 ? $crboss.'<img src="/images/icon/crystal_blue.png">' : '').' 
            '.($rubinboss > 0 ? $rubinboss.'<img src="/images/rubin.png">' : '').' 
            '.($res_3 > 0 ? $res_3.'<img width="15" height="15" src="/images/res/3.png">' : '');
            $db->query('INSERT INTO `journal` SET `from` = ?, `text` = ?, `read` = ?, `tip` = ?, `time` = ?', [$user['id'], $text, '0', $camp['boss'], time()]); 
            $db->query('UPDATE `campaign` SET `status` = ? WHERE `id_user`= ? LIMIT 1', [0, $user['id']]);
            if($clan['id'] > 0) {
                $db->query('UPDATE `clans` SET `exp` = `exp` + ? WHERE `id` = ?', [$xpboss / 2, $clan['id']]);
                $db->query('UPDATE `clan_memb` SET `exp` = `exp` + ? WHERE `clan` = ? AND `user` = ?', [$xpboss / 2, $clan['id'], $user['id']]);
            }
            header('Location: /location/');
            exit;
        }
        if(isset($_GET['lose'])){
            $db->query('UPDATE `campaign` SET `status` = ?, `udar` = ? WHERE `id_user` = ? LIMIT 1', [3, 999999999, $user['id']]);
            $db->query('UPDATE `users` SET `exp` = `exp` + ? WHERE `id` = ? LIMIT 1', [($camp_boss['exp'] / 5), $user['id']]);
            header('Location: /dungeon10');
            exit;
        }

        if(isset($_GET['attack'])) {
            if(time() - $boss['time'] < 1) {
                $log = 'Вы промахнулись';
                $db->query('INSERT INTO `campaign_log` SET `id_user` = ?, `text` = ?', [$user['id'], $log]);
                header('Location: /dungeon10');
                exit;
            }
            $minattack = $user['str'] / 6;
            $maxattack = $user['str'] / 4;
            $user_udar = ceil(rand($minattack, $maxattack));
            if(time() - $boss['time'] >= 0) {
                $db->query('UPDATE `boss` SET `time` = ? WHERE `user` = ', [(time() + 1), $user['id']]);
            }
            $db->query('UPDATE `campaign` SET `boss_hp` = `boss_hp` - ?, `udar` = `udar` - ? WHERE `id_user` = ? LIMIT 1', [$user_udar, 1, $user['id']]);
            $camp = $db->query('SELECT * FROM `campaign` WHERE `id_user` = ? LIMIT 1', [$user['id']])->fetch();
            if($camp['boss_hp'] <= 0){
                $db->query('UPDATE `campaign` SET `boss_hp` = ?, `boss_stat` = ? WHERE `id_user` = ? LIMIT 1', [0, 4, $user['id']]);
                $log = 'Вы ударили '.$camp_boss['name'].' на '.$user_udar.'hp .';
                $kill_boss_log = 'Вы убили '.$camp_boss['name'];
                $db->query('INSERT INTO `campaign_log` SET `id_user` = ?, `text` = ?', [$user['id'], $log]);
                $db->query('INSERT INTO `campaign_log` SET `id_user` = ?, `text` = ?', [$user['id'], $kill_boss_log]);
            } else {
                if($camp['udar'] > 0){
                    $boss_min = 4;
                    $boss_max = 12;
                    $boss_udar = rand($boss_min, $boss_max);
                    $log = $camp_boss['name'].' получил(а) от вас '.$user_udar.' едениц урона.';
                    $db->query('INSERT INTO `campaign_log` SET `id_user` = ?, `text` = ?', [$user['id'], $log]);
                } else {
                    $db->query('UPDATE `campaign` SET `status` = ?, `udar` = ? WHERE `id_user` = ? LIMIT 1', [3, 999999999, $user['id']]);
                }
            }
            $db->query('UPDATE `campaign` SET `user_hp` = `user_hp` - ? WHERE `id_user` = ? LIMIT 1', [$boss_udar, $user['id']]);
            $camp = $db->query('SELECT * FROM `campaign` WHERE `id_user` = ? LIMIT 1', [$user['id']])->fetch();
            if($camp['boss_stat'] != 4) {
                if($camp['user_hp'] <= 0) {
                    $db->query('UPDATE `campaign` SET `user_hp` = ? WHERE `id_user` = ? LIMIT 1', [0, $user['id']]);
                    $boss_log = 'Получен удар от '.$camp_boss['name'].' на '.$boss_udar.' hp</span>'.$skill;
                    $kill_user_boss_log = 'Bы получили смертельный удар от '.$camp_boss['name'];
                    $db->query('INSERT INTO `campaign_log` SET `id_user` = ?, `text` = ?', [$user['id'], $boss_log]);
                    $db->query('INSERT INTO `campaign_log` SET `id_user` = ?, `text` = ?', [$user['id'], $kill_user_boss_log]);
                } else {
                    $boss_log = '<span style="color: rgb(255, 0, 0);">Получен удар от '.$camp_boss['name'].' на '.$boss_udar.' hp</span>';
                    $db->query('INSERT INTO `campaign_log` SET `id_user` = ?, `text` = ?', [$user['id'], $boss_log]);
                }
            }
            header('Location: /dungeon10');
            exit;
        }
        if($camp['boss_hp']=='0' OR $camp['user_hp']=='0'){
            include('./system/h.php');
        } else {
            echo '
            <!DOCTYPE html>
            <html>
            <head>
            <title>',$title.'</title>
            <link rel="shortcut icon" href="/favicon.ico"/>
            <meta name="viewport" content="width=device-width; minimum-scale=1; maximum-scale=1">
            <link rel="stylesheet" href="/style.css"/>
            </head>
            <body>
            ';
            $hp = $camp['user_hp'];
            $hp_progress = round(100 / ($user['vit'] / $camp['user_hp']));
            if($hp_progress > 100) {
                $hp_progress = 100;
            }
            echo '
            <div class="header-title">
            <table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;">
            <tbody>
            <tr>
            <td style="text-align: left; vertical-align: middle;"><img src="/images/xx/4.png"> '.$camp['user_hp'].'</td>
            <td style="text-align: center; vertical-align: middle;">
            <center><img style="width: 20px; height: 20px;" src="/images/rang/'.$user['rang'].'.jpg">'.$user['login'].', ';
            if(!$user['r']) {
                echo 'Cветлый ';
            } else {
                echo 'Темный ';
            }
            if($user['class']) {
                echo 'Друид, ';
            }
            if(!$user['class']) {
                echo 'Паладин, ';
            }
            echo $user['level'].'ур.';
            $mail = count($db->query("SELECT * FROM `mail` WHERE `to` = {$user['id']} AND `read` = 0")->fetchAll());
            if($mail > 0) {
                echo '&nbsp;<a href="/mail/"><img style="width: 17px; height: 12px;" src="/images/mail/1.png" alt="*"/></a>';
            } else {
                echo '&nbsp;<a href="/mail/"><img style="width: 17px; height: 12px;" src="/images/mail/0.png"></a></div>';
            }
            echo '
            </center>
            </td>
            <td style="text-align: right; vertical-align: middle;">',$user['mp'],' 
            <img style="width: 20px; height: 20px;" src="/images/icon/4.png"></td>
            </tr>
            </tbody>
            </table>
            </div>
            <div class=" backfon-3 backten-y">
            <div class="foot-info-exp">
            <div class="foot-info-exp-fill" style="width:<?=$hp_progress?>%"></div>
            </div>
            <div style="text-align: center;"><span style="color: rgb(153, 153, 153);">
            Здоровье: '.n_f($camp['user_hp']).'/'.n_f($user['vit']).' 
            </span></div></div>
            </div>
            </div>
            <div class="header-title">Окрестности города</div>
            <div class=" backfon-3 backten-y"><div class="blocks-l  textgrey p5 w95pc fzzz pr"><div class="blocks-l-l w64" style="">
            <div style="background: url(/images/mob/'.$camp_boss['id'].'.png); background-size: cover" class=" br6 h54 w54 tac vam  ">
            </div></div><div class="blocks-l-t "><div class=" qwest-heder mt-1 "></div><div class="mt3 textorange-2">
            <span style="color: rgb(228, 208, 105);"></div>
            <div class="mt3 textorange-2">
            <span style="color: rgb(228, 208, 105);">
            '.$camp_boss['name'].'<br>
            Здоровье: '.$camp['boss_hp'].'<br>
            Защита: '.$camp_boss['def'].'
            </div></div>
            </div>
            <div class="header-title">&nbsp;</div>
            <div class=" backfon-3 backten-y"><center>
            ';
        }
        echo '
        <div class=" backfon-3 backten-y">
        ';
        if($camp['boss_stat'] == 4){
            echo'
            <div class="header-title">Победа!</div>
            <img style="width: 100%;" src="/images/hunter_win.png">
            <div class="header-title">Зверь был повержен!</div>
            <center>
            <br><a class="button-green backgreen ib" href="/dungeon10/fight/win">Покинуть поле боя</a><br><br>
            ';
        } elseif($camp['user_hp'] == 0){
            echo '
            <div class="header-title">Поражение</div>
            <img style="width: 100%;" src="/images/hunter_lose.png">
            <div class="header-title">Bы были повержены в бою</div>
            <center>
            <br><a class="button-red backgreen ib" href="/dungeon10/fight/lose">Bернуться в окрестности</a>
            <br><a class="button-green backgreen ib" href="?heel_me">Излечить раны и вернуться в бой <img src="/images/rubin.png">2</a>
            <br><br>
            ';
            if (isset($_GET['heel_me']) && $user['rubin'] >= 2){
                mysql_query("UPDATE `users` SET `rubin`=`rubin`-'2' WHERE `id`='".$user['id']."'");
                mysql_query("UPDATE `campaign` SET `user_hp` = '".$user['vit']."'	WHERE `id_user`='".$user['id']."' LIMIT 1");
                header('Location: /dungeon10/fight');
                exit;
            }
        } else {
            echo '
            <a class="button-51 backgreen ib" href="/dungeon10/fight/attack">Ударить зверя</a>
            ';
            if(time() - $boss['time'] == -1) {
                echo '
                <center>До следующего удара: 1 секунда</center>
                ';
            }
            echo '
            </div>
            <div class="header-title">Зелья</div>
            <table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
            <td style="width: 25%; text-align: center;">
            <a class="i-amu">
            <img src="/images/elic1.gif" height="45" width="45">
            <span class="amu-num">'.$user['elic1'].'</span>
            ';
            if($user['elic1'] <= 0) {
                echo '
                    <br><a class="button-51 backgreen ib">Использовать</a></td>
                ';
            }
            if($user['elic1'] >= 1) {
                echo '
                <br><a class="button-green backgreen ib" href="?elic1">Использовать</a></td>
                ';
            }
            echo '
            <td style="width: 25%; text-align: center;">
            <a class="i-amu">
            <img src="/images/elic2.gif" height="45" width="45">
            <span class="amu-num">'.$user['elic2'].'</span>
            ';
            if($user['elic2'] <= 0) {
                echo '
                <br><a class="button-51 backgreen ib">Использовать</a></td>
                ';
            }
            if($user['elic2'] > 0) {
                echo '
                <br><a class="button-green backgreen ib" href="?elic2">Использовать</a></td>
                ';
            }
            echo '
            <td style="width: 25%; text-align: center;">
            <a class="i-amu">
            <img src="/images/elic3.gif" height="45" width="45">
            <span class="amu-num">'.$user['elic3'].'</span>
            <br><a class="button-51 backgreen ib">Использовать</a></td>
            <td style="width: 25%; text-align: center;">
            <a class="i-amu">
            <img src="/images/elic4.gif" height="45" width="45">
            <span class="amu-num">'.$user['elic4'].'</span>
            <br><a class="button-51 backgreen ib">Использовать</a></td>
            </tr></tbody></table><br>
            <div class="delta"></div>
            ';
            if (isset($_GET['elic1']) and $user['elic1'] >= 1 and $camp['user_hp'] < $user['vit']) {
                $heal = $camp['user_hp'] + $user['vit'] * 1/2;
                if($camp['user_hp'] + $heal > $user['vit']) {
                    $heal = $user['vit'];
                }
                $db->query('UPDATE `users` SET `elic1` = `elic1` - 1 WHERE `id` = ?', [$user['id']]);
                $db->query('UPDATE `campaign` SET `user_hp` = ? WHERE `id_user` = ? LIMIT 1', [$heal, $user['id']]);
                header('Location: /dungeon10/fight');
                exit;
            }
            if (isset($_GET['elic2']) and $user['elic2'] >= 1 and $camp['user_hp'] < $user['vit']) {
                $db->query('UPDATE `users` SET `elic2` = `elic2` - 1 WHERE `id` = ?', [$user['id']]);
                $db->query('UPDATE `campaign` SET `user_hp` = ? WHERE `id_user` = ? LIMIT 1', [$user['vit'], $user['id']]);
                header('Location: /dungeon10/fight');
                exit;
            }
        }
        echo '
        <div class="header-title">История битвы</div>
        ';
        $logs = $db->query('SELECT `text` FROM `campaign_log` WHERE `id_user` = ? ORDER BY(`id`) DESC LIMIT 40', [$user['id']])->fetchAll();
        foreach($logs as $camp_log) {
            echo $camp_log['text'].'<div class="delta"></div>';
        }
        break;

    case 'exit':
        if(isset($_GET['exit'])){
            header('Location: /');
            exit;
        }
        echo '
        <div class="main">
        <div class="block_zero center">
        Ваш персонаж сейчас находится в бою, хотите туда вернуться?
        <div class="mb5"></div>
        <div class="center">
        <a class="btn" href="/dungeon">
        <span class="end">
        <span class="label">
        <span class="dgreen">
        <img src="/images/icon/2hit.png" alt="*">
        Вернуться в бой!
        </span>
        </span>
        </span>
        </a>
        <div class="mb10">
        </div>
        <a class="grey" href="/dungeon10/exit/exit">
        выйти из боя
        </a>
        </div>
        </div>
        </div>
        ';
        break;

    case 'lose':
        if(isset($_GET['end'])){
            mysql_query("UPDATE `campaign` SET `status`='0' WHERE `id_user`='".$user['id']."' LIMIT 1");
            header('Location: /dungeon10/');
            exit;
        }
        echo '
        <div class="header-title">Окрестности города</div>
        ';
        if($camp['boss_hp'] == 0){
            echo '
            <img style="width: 100%;" src="/images/hunter_win.png">
            <div class="header-title">Победа</div>
            ';
        } else {
            echo '
            <img style="width: 100%;" src="/images/hunter_lose.png">
            <div class="header-title">Поражение</div>
            ';
        }
        echo '
        <div class=" backfon-3 backten-y">
        <br>
        <center><span style="color: rgb(228, 208, 105);">	
        Дикий зверь растерзал вас.
        </span></center>
        <br>
        <center><a class="button-51 backgreen ib" href="/dungeon10/lose/end">Bернуться в окрестности города</a></center>
        <div class=" backfon-3 backten-y">
        ';
    break;
}
include './system/f.php';
?>