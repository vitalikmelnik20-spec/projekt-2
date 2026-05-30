<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';

if(!$user OR $user['access'] < 1) {
    header('location: /');
    exit;
}

$is_super = ($user['access'] >= 2);

function adm_only() {
    global $is_super;
    if(!$is_super) { header('location: /adm/'); exit; }
}

switch($_GET['action']) {

// ─── ГОЛОВНА ──────────────────────────────────────────────────────────────
default:
    $title = 'Адмін-панель';
    include './system/h.php';
?>
<div class='main'>
<div class='block_zero'>
<b>Статистика сервера</b><div class='separ'></div>
<?
$total    = mysql_result(mysql_query('SELECT COUNT(*) FROM `users`'), 0);
$online   = mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `online` > "'. (time()-300) .'"'), 0);
$banned   = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `time` > "'.time().'"'), 0);
$tot_gold = mysql_result(mysql_query('SELECT SUM(`g`) FROM `users`'), 0);
$tot_silv = mysql_result(mysql_query('SELECT SUM(`s`) FROM `users`'), 0);
?>
👥 Гравців: <b><?=$total?></b> &nbsp;|&nbsp;
🟢 Онлайн: <b><?=$online?></b> &nbsp;|&nbsp;
🔴 Забанено: <b><?=$banned?></b><br>
💰 Золото в грі: <b><?=number_format($tot_gold,0,'',' ')?></b> &nbsp;|&nbsp;
🪙 Срібло: <b><?=number_format($tot_silv,0,'',' ')?></b>
</div>
<div class='mini-line'></div>
<div class='menuList'>
<li><a href='/adm/?action=players'><img src='/images/icon/arrow.png'> Гравці / пошук</a></li>
<li><a href='/adm/?action=edit_user'><img src='/images/icon/arrow.png'> Редагування гравця</a></li>
<li><a href='/adm/ban/'><img src='/images/icon/arrow.png'> Бани</a></li>
<li><a href='/adm/ban/list/'><img src='/images/icon/arrow.png'> Список банів (<?=$banned?>)</a></li>
<li><a href='/adm/?action=give'><img src='/images/icon/arrow.png'> Видати ресурси</a></li>
<li><a href='/adm/?action=give_all'><img src='/images/icon/arrow.png'> Видати всім гравцям</a></li>
<li><a href='/adm/trade/'><img src='/images/icon/arrow.png'> Передача предметів</a></li>
<li><a href='/adm/?action=mail_all'><img src='/images/icon/arrow.png'> Розсилка пошти</a></li>
<li><a href='/adm/?action=boss'><img src='/images/icon/arrow.png'> Керування босами</a></li>
<?php if($is_super): ?>
<li><a href='/adm/?action=reg'><img src='/images/icon/arrow.png'> Реєстрація вкл/викл</a></li>
<li><a href='/adm/acc/'><img src='/images/icon/arrow.png'> Редагування акаунту (стара)</a></li>
<li><a href='/adm/deposit/'><img src='/images/icon/arrow.png'> Передача валюти (стара)</a></li>
<li><a href='/adm/clon/'><img src='/images/icon/arrow.png'> Перевірка мульти</a></li>
<?php endif; ?>
</div>
</div>
<? include './system/f.php'; break;

// ─── СПИСОК ГРАВЦІВ ───────────────────────────────────────────────────────
case 'players':
    $title = 'Гравці';
    include './system/h.php';
    $search = isset($_POST['login']) ? mysql_real_escape_string(trim($_POST['login'])) : '';
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
?>
<div class='main'>
<div class='block_zero'>
<form action='/adm/?action=players' method='post'>
Пошук за логіном або ID:<br>
<input name='login' value='<?=htmlspecialchars($search)?>' placeholder='логін або ID'/>
<input type='submit' value='Знайти'/>
</form>
</div>
<div class='mini-line'></div>
<?
$where = '';
if($search !== '') {
    if(is_numeric($search)) {
        $where = 'WHERE `id` = "'.$search.'"';
    } else {
        $where = 'WHERE `login` LIKE "%'.$search.'%"';
    }
} elseif($filter === 'online') {
    $where = 'WHERE `online` > "'.(time()-300).'"';
} elseif($filter === 'banned') {
    $where = 'JOIN `ban` ON `ban`.`user`=`users`.`id` WHERE `ban`.`time` > "'.time().'"';
}
$q = mysql_query('SELECT `users`.`id`,`login`,`level`,`access`,`online`,`g`,`s`,`r` FROM `users` '.$where.' ORDER BY `id` DESC LIMIT 50');
echo "<div class='block_zero'>";
while($row = mysql_fetch_array($q)) {
    $on = $row['online'] > time()-300;
    $acc_label = ['0'=>'Гравець','1'=>'Мод','2'=>'Адмін','3'=>'Супер'];
    echo "<div style='padding:4px 0;border-bottom:1px solid #333'>";
    echo "<img src='/images/icon/race/".($row['r']?$row['r']:'0').($on?'':'-off').".png'> ";
    echo "<a href='/adm/?action=edit_user&id={$row['id']}'><b>{$row['login']}</b></a> ";
    echo "ID:{$row['id']} · Lv{$row['level']} · ".($acc_label[$row['access']]??'?');
    echo " · 💰{$row['g']} · 🪙{$row['s']}";
    if($is_super) echo " &nbsp;<a href='/adm/?action=edit_user&id={$row['id']}' style='color:#8af'>[ред]</a>";
    echo "</div>";
}
echo "</div>";
?>
<div class='mini-line'></div>
<div class='menuList'>
<li><a href='/adm/?action=players&filter=online'> Тільки онлайн</a></li>
<li><a href='/adm/?action=players'> Всі</a></li>
</div>
</div>
<? include './system/f.php'; break;

// ─── РЕДАГУВАННЯ ГРАВЦЯ ───────────────────────────────────────────────────
case 'edit_user':
    adm_only();
    $title = 'Редагування гравця';
    include './system/h.php';

    // Save changes
    if(isset($_POST['save']) && isset($_POST['uid'])) {
        $uid = (int)$_POST['uid'];
        $target = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`="'.$uid.'"'));
        if($target && $target['access'] < $user['access']) {
            $new_login  = mysql_real_escape_string(trim($_POST['login']));
            $new_s      = (int)$_POST['s'];
            $new_g      = (int)$_POST['g'];
            $new_crystal= (int)$_POST['crystal'];
            $new_level  = min(65, max(1, (int)$_POST['level']));
            $new_exp    = (int)$_POST['exp'];
            $new_str    = (int)$_POST['str'];
            $new_vit    = (int)$_POST['vit'];
            $new_agi    = (int)$_POST['agi'];
            $new_def    = (int)$_POST['def'];
            $new_mana   = (int)$_POST['mana'];
            $new_skill  = (int)$_POST['skill'];
            $new_hp     = (int)$_POST['hp'];
            $new_status = mysql_real_escape_string(trim($_POST['status']));
            $new_color  = mysql_real_escape_string(trim($_POST['status_color']));
            $new_access = min((int)$user['access']-1, max(0, (int)$_POST['access']));

            mysql_query('UPDATE `users` SET
                `login`="'.$new_login.'",
                `s`='.$new_s.',`g`='.$new_g.',`crystal`='.$new_crystal.',
                `level`='.$new_level.',`exp`='.$new_exp.',
                `str`='.$new_str.',`vit`='.$new_vit.',`agi`='.$new_agi.',
                `def`='.$new_def.',`mana`='.$new_mana.',`skill`='.$new_skill.',
                `hp`='.$new_hp.',`access`="'.$new_access.'",
                `status`="'.$new_status.'",`status_color`="'.$new_color.'"
                WHERE `id`="'.$uid.'"');

            if(!empty($_POST['new_pass'])) {
                $p = $_POST['new_pass'];
                $h = sha1(md5(md5(sha1(md5(sha1($p))))));
                mysql_query('UPDATE `users` SET `password`="'.$h.'" WHERE `id`="'.$uid.'"');
            }

            // Unban
            if(isset($_POST['unban'])) {
                mysql_query('DELETE FROM `ban` WHERE `user`="'.$uid.'"');
            }

            echo "<div class='block_zero center' style='color:#4f4'>✅ Збережено!</div><div class='mini-line'></div>";
        }
    }

    // Load user to edit
    $edit_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if(!$edit_id && isset($_POST['find_id'])) $edit_id = (int)$_POST['find_id'];
    $acc = $edit_id ? mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`="'.$edit_id.'"')) : null;
?>
<div class='main'>
<div class='block_zero'>
<form action='/adm/?action=edit_user' method='post'>
ID гравця: <input name='find_id' size='6' value='<?=$edit_id?>'/>
<input type='submit' value='Завантажити'/>
</form>
</div>
<?php if($acc): ?>
<div class='mini-line'></div>
<div class='block_zero'>
<form action='/adm/?action=edit_user' method='post'>
<input type='hidden' name='uid' value='<?=$acc['id']?>'>
<b><?=$acc['login']?></b> (ID:<?=$acc['id']?>)<div class='separ'></div>

<table style='width:100%;border-spacing:4px'>
<tr><td>Логін</td><td><input name='login' value='<?=htmlspecialchars($acc['login'])?>'></td></tr>
<tr><td>Новий пароль</td><td><input name='new_pass' placeholder='(залишити порожнім)'></td></tr>
<tr><td>Рівень доступу (0-<?=((int)$user['access']-1)?>)</td><td><input name='access' value='<?=$acc['access']?>' size='3'></td></tr>
<tr><td colspan='2'><hr></td></tr>
<tr><td>Золото</td><td><input name='g' value='<?=$acc['g']?>'></td></tr>
<tr><td>Срібло</td><td><input name='s' value='<?=$acc['s']?>'></td></tr>
<tr><td>Кристали</td><td><input name='crystal' value='<?=$acc['crystal']?>'></td></tr>
<tr><td colspan='2'><hr></td></tr>
<tr><td>Рівень</td><td><input name='level' value='<?=$acc['level']?>' size='5'></td></tr>
<tr><td>Досвід</td><td><input name='exp' value='<?=$acc['exp']?>'></td></tr>
<tr><td>HP</td><td><input name='hp' value='<?=$acc['hp']?>'></td></tr>
<tr><td colspan='2'><hr></td></tr>
<tr><td>Сила (str)</td><td><input name='str' value='<?=$acc['str']?>' size='5'></td></tr>
<tr><td>Здоров'я (vit)</td><td><input name='vit' value='<?=$acc['vit']?>' size='5'></td></tr>
<tr><td>Спритність (agi)</td><td><input name='agi' value='<?=$acc['agi']?>' size='5'></td></tr>
<tr><td>Захист (def)</td><td><input name='def' value='<?=$acc['def']?>' size='5'></td></tr>
<tr><td>Мана</td><td><input name='mana' value='<?=$acc['mana']?>' size='5'></td></tr>
<tr><td>Майстерність</td><td><input name='skill' value='<?=$acc['skill']?>'></td></tr>
<tr><td colspan='2'><hr></td></tr>
<tr><td>Статус</td><td><input name='status' value='<?=htmlspecialchars($acc['status'])?>'></td></tr>
<tr><td>Колір статусу</td><td><input name='status_color' value='<?=htmlspecialchars($acc['status_color'])?>'> <span style='color:<?=$acc['status_color']?>'>▉</span></td></tr>
</table>

<?php
$is_banned = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `user`="'.$acc['id'].'" AND `time`>'.time()), 0);
if($is_banned) echo "<br>⚠️ Гравець забанений &nbsp;<label><input type='checkbox' name='unban' value='1'> Розбанити</label>";
?>
<br><br>
<input type='submit' name='save' value='💾 Зберегти зміни' style='width:100%;padding:6px'>
</form>
</div>
<?php endif; ?>
</div>
<? include './system/f.php'; break;

// ─── ВИДАТИ РЕСУРСИ ГРАВЦЮ ────────────────────────────────────────────────
case 'give':
    adm_only();
    $title = 'Видати ресурси';
    include './system/h.php';

    if(isset($_POST['submit'])) {
        $uid = (int)$_POST['id'];
        $target = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users` WHERE `id`="'.$uid.'"'));
        if($target) {
            $fields = ['g','s','crystal','rub'];
            foreach($fields as $f) {
                $val = (int)$_POST[$f];
                if($val != 0) mysql_query('UPDATE `users` SET `'.$f.'`=`'.$f.'`+'.($val).' WHERE `id`="'.$uid.'"');
            }
            echo "<div class='block_zero center' style='color:#4f4'>✅ Видано гравцю {$target['login']}!</div><div class='mini-line'></div>";
        }
    }
?>
<div class='main'><div class='block_zero'>
<form action='/adm/?action=give' method='post'>
ID гравця: <input name='id' size='6'><br><br>
<table>
<tr><td>Золото</td><td><input name='g' value='0'></td></tr>
<tr><td>Срібло</td><td><input name='s' value='0'></td></tr>
<tr><td>Кристали</td><td><input name='crystal' value='0'></td></tr>
<tr><td>Рубіни</td><td><input name='rub' value='0'></td></tr>
</table>
<small>Від'ємне значення — забрати ресурс.</small><br><br>
<input type='submit' name='submit' value='Видати'>
</form>
</div></div>
<? include './system/f.php'; break;

// ─── ВИДАТИ ВСІМ ─────────────────────────────────────────────────────────
case 'give_all':
    adm_only();
    $title = 'Видати всім гравцям';
    include './system/h.php';

    if(isset($_POST['submit'])) {
        $fields = ['g','s','crystal'];
        foreach($fields as $f) {
            $val = (int)$_POST[$f];
            if($val != 0) mysql_query('UPDATE `users` SET `'.$f.'`=`'.$f.'`+'.($val));
        }
        echo "<div class='block_zero center' style='color:#4f4'>✅ Виконано!</div><div class='mini-line'></div>";
    }
?>
<div class='main'><div class='block_zero'>
<b>⚠️ Дія застосовується до ВСІХ гравців!</b>
<div class='separ'></div>
<form action='/adm/?action=give_all' method='post'>
<table>
<tr><td>Золото</td><td><input name='g' value='0'></td></tr>
<tr><td>Срібло</td><td><input name='s' value='0'></td></tr>
<tr><td>Кристали</td><td><input name='crystal' value='0'></td></tr>
</table>
<br><input type='submit' name='submit' value='Видати всім'>
</form>
</div></div>
<? include './system/f.php'; break;

// ─── ПОШТА ВСІМ ──────────────────────────────────────────────────────────
case 'mail_all':
    adm_only();
    $title = 'Розсилка пошти';
    include './system/h.php';

    if(isset($_POST['submit'])) {
        $text = mysql_real_escape_string(trim($_POST['text']));
        $from = 2; $time = time(); $read = 0;
        if($text) {
            $uid_q = mysql_query('SELECT `id` FROM `users`');
            $sent = 0;
            while($row = mysql_fetch_array($uid_q)) {
                $to = $row['id'];
                if(!mysql_result(mysql_query('SELECT COUNT(*) FROM `dialog` WHERE `uid2`="'.$to.'" AND `uid1`="'.$from.'"'), 0)) {
                    mysql_query('INSERT INTO `dialog` (`uid2`,`uid1`,`time`) VALUES ("'.$to.'","'.$from.'","'.$time.'")');
                }
                mysql_query('INSERT INTO `mail` (`uid1`,`time`,`uid2`,`text`) VALUES ("'.$from.'","'.$time.'","'.$to.'","'.$text.'")');
                $sent++;
            }
            echo "<div class='block_zero center' style='color:#4f4'>✅ Відправлено: $sent гравцям!</div><div class='mini-line'></div>";
        }
    }
?>
<div class='main'><div class='block_zero'>
<form action='/adm/?action=mail_all' method='post'>
Текст листа (HTML дозволено):<br>
<textarea name='text' rows='5' style='width:100%'></textarea><br>
<input type='submit' name='submit' value='Відправити всім'>
</form>
</div></div>
<? include './system/f.php'; break;

// ─── КЕРУВАННЯ БОСАМИ ────────────────────────────────────────────────────
case 'boss':
    adm_only();
    $title = 'Керування босами';
    include './system/h.php';

    if(isset($_POST['reset_boss'])) {
        $boss_id = (int)$_POST['boss_id'];
        $new_hp  = (int)$_POST['new_hp'];
        mysql_query('UPDATE `boss` SET `hp`="'.$new_hp.'" WHERE `id`="'.$boss_id.'"');
        echo "<div class='block_zero center' style='color:#4f4'>✅ HP боса оновлено!</div><div class='mini-line'></div>";
    }
    if(isset($_POST['reset_dragon'])) {
        $hp = max(1, (int)$_POST['dragon_hp']);
        mysql_query('UPDATE `aluko` SET `health`="'.$hp.'"');
        echo "<div class='block_zero center' style='color:#4f4'>✅ Дракон оновлений!</div><div class='mini-line'></div>";
    }
?>
<div class='main'>
<div class='block_zero'><b>Боси кампанії</b><div class='separ'></div>
<form action='/adm/?action=boss' method='post'>
<?
$bq = mysql_query('SELECT * FROM `boss` ORDER BY `id`');
while($br = mysql_fetch_array($bq)) {
    echo "<b>ID:{$br['id']} {$br['name']}</b> HP:{$br['hp']}/{$br['maxhp']}<br>";
}
?>
<br>ID боса: <input name='boss_id' size='4'>
Новий HP: <input name='new_hp' size='8'>
<input type='submit' name='reset_boss' value='Оновити HP'>
</form>
</div>
<div class='mini-line'></div>
<div class='block_zero'><b>Дракон (aluko)</b><div class='separ'></div>
<?
$drag = mysql_fetch_array(mysql_query('SELECT * FROM `aluko` ORDER BY `id` LIMIT 1'));
if($drag) echo "Поточний HP: <b>{$drag['health']}</b><br><br>";
?>
<form action='/adm/?action=boss' method='post'>
Новий HP дракона: <input name='dragon_hp' value='<?=$drag['health']??1000?>'><br><br>
<input type='submit' name='reset_dragon' value='Оновити дракона'>
</form>
</div>
</div>
<? include './system/f.php'; break;

// ─── РЕЄСТРАЦІЯ ON/OFF ───────────────────────────────────────────────────
case 'reg':
    adm_only();
    $title = 'Реєстрація';
    include './system/h.php';
    if(isset($_POST['toggle'])) {
        $cur = mysql_result(mysql_query('SELECT `value` FROM `settings` WHERE `key`="reg"'), 0);
        $new = ($cur == '1') ? '0' : '1';
        mysql_query('UPDATE `settings` SET `value`="'.$new.'" WHERE `key`="reg"');
        echo "<div class='block_zero center'>Оновлено!</div>";
    }
    $reg_on = mysql_result(mysql_query('SELECT `value` FROM `settings` WHERE `key`="reg"'), 0);
?>
<div class='main'><div class='block_zero'>
Реєстрація: <b><?=($reg_on?'🟢 Увімкнена':'🔴 Вимкнена')?></b><br><br>
<form action='/adm/?action=reg' method='post'>
<input type='submit' name='toggle' value='Перемкнути'>
</form>
</div></div>
<? include './system/f.php'; break;

// ─── БАН ──────────────────────────────────────────────────────────────────
case 'ban':
    $title = 'Управление банами';
    include './system/h.php';
?>
<div class='main'><div class='mini-line'></div>
<?
if($_GET['list'] == true) {
    $max = 10;
    $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `time` > "'.time().'"'),0);
    $pages = ceil($count/$max); $page = max(1,(int)$_GET['page']);
    $start = $page * $max - $max;
    if($count > 0) {
        $id = (int)$_GET['id'];
        if($id) {
            if($_GET['delete'] == true) {
                mysql_query('DELETE FROM `ban` WHERE `id`="'.$id.'"');
                header('location: /adm/ban/list/?page='.$page); exit;
            }
        }
        echo "<div class='block_zero'>";
        $q = mysql_query('SELECT * FROM `ban` WHERE `time` > "'.time().'" ORDER BY `id` DESC LIMIT '.$start.','.$max);
        while($row = mysql_fetch_array($q)) {
            $u = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`="'.$row['user'].'"'));
            echo "<span style='float:right'><a href='/adm/ban/list/?id={$row['id']}&delete=true&page={$page}'>✕</a></span>";
            echo "<img src='/images/icon/race/{$u['r']}.png'> <a href='/user/{$u['id']}/'>{$u['login']}</a> — ".(_time($row['time']-time()))."<br>";
        }
        echo pages('/adm/ban/list/?')."</div>";
    }
} else {
    $id = (int)$_POST['id'];
    if($id) {
        $users = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`="'.$id.'"'));
        if(!$users OR $users['access'] >= $user['access']) { header('location:/adm/ban/'); exit; }
        $d=(int)$_POST['d']; $h=min(24,(int)$_POST['h']); $m=min(60,(int)$_POST['m']);
        $reason = mysql_real_escape_string(trim($_POST['reason']));
        $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `user`="'.$id.'"'),0);
        if($count == 0) {
            mysql_query('INSERT INTO `ban` (`user`,`time`,`ip`,`reason`,`cost`,`who`) VALUES ("'.$id.'","'.(time()+($d*86400)+($h*3600)+($m*60)).'","'.$users['ip'].'","'.$reason.'","0","'.$user['id'].'")');
            echo "<div class='block_zero center' style='color:#4f4'>✅ Забанено!</div>";
        } else {
            echo "<div class='block_zero center' style='color:#f44'>⛔ Вже забанений!</div>";
        }
    }
?>
<div class='block_zero'>
<form action='/adm/ban/' method='post'>
ID гравця: <input name='id'><br>
Причина: <input name='reason' placeholder='порушення правил'><br>
Д: <input name='d' size='2' value='0'>
Г: <input name='h' size='2' value='0'>
Хв: <input name='m' size='2' value='0'><br>
<input type='submit' value='Забанити'>
</form>
</div>
<div class='mini-line'></div>
<div class='menuList'>
<li><a href='/adm/ban/list/'> Список банів (<?=mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `time`>'.time()),0)?>)</a></li>
</div>
<? } ?>
</div>
<? include './system/f.php'; break;

// ─── ПЕРЕДАЧА ВАЛЮТИ (стара) ─────────────────────────────────────────────
case 'deposit':
    adm_only();
    $title = 'Передача средств';
    include './system/h.php';
    if($_POST['submit']) {
        $uid=(int)$_POST['id'];
        $users=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`="'.$uid.'"'));
        if($users) {
            $type = in_array($_POST['type'],['s','g']) ? $_POST['type'] : 'g';
            $count=(int)$_POST['count'];
            mysql_query('UPDATE `users` SET `'.$type.'`=`'.$type.'`+'.$count.' WHERE `id`="'.$uid.'"');
            echo "<div class='block_zero center'>Перевод виконано!</div>";
        }
    }
?>
<div class='main'><div class='block_zero'>
<form action='/adm/deposit/' method='post'>
ID: <input name='id'><br>
<select name='type'><option value='s'>Срібло</option><option value='g'>Золото</option></select><br>
<input name='count' value='0'><br>
<input type='submit' name='submit' value='Перевести'>
</form>
</div></div>
<? include './system/f.php'; break;

// ─── ПЕРЕДАЧА ПРЕДМЕТІВ (стара) ──────────────────────────────────────────
case 'trade':
    adm_only();
    $title = 'Передача вещей';
    include './system/h.php';
    if($_POST['submit']) {
        $uid=(int)$_POST['id'];
        $item_id=(int)$_POST['item'];
        $users=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`="'.$uid.'"'));
        $item=mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id`="'.$item_id.'"'));
        $qmap=[0=>[0,28,28,28,28],1=>[5,31,31,31,31],2=>[10,45,45,45,45],3=>[10,52,52,52,52],4=>[10,60,60,60,60],5=>[10,120,120,120,120],6=>[10,170,170,170,170]];
        $q=$qmap[$item['quality']]??[0,28,28,28,28];
        if($users && $item) {
            mysql_query('INSERT INTO `inv` (`user`,`item`,`bonus`,`_str`,`_vit`,`_agi`,`_def`) VALUES ("'.$users['id'].'","'.$item['id'].'","'.$q[0].'","'.$q[1].'","'.$q[2].'","'.$q[3].'","'.$q[4].'")');
            echo "<div class='block_zero center'>✅ Предмет передано!</div>";
        }
    }
    $qlabel=['П','О','Р','Е','Л','Б','СБ'];
?>
<div class='main'><div class='block_zero'>
<form action='/adm/?action=trade' method='post'>
ID гравця: <input name='id'><br>
<select name='item'>
<?
$q=mysql_query('SELECT * FROM `items` ORDER BY `id`');
while($r=mysql_fetch_array($q)) {
    echo "<option value='{$r['id']}'>{$r['id']} / ".($qlabel[$r['quality']]??'?')." / {$r['name']}</option>";
}
?>
</select><br>
<input type='submit' name='submit' value='Передати'>
</form>
</div></div>
<? include './system/f.php'; break;

// ─── МУЛЬТИ-АКАУНТИ ──────────────────────────────────────────────────────
case 'clon':
    adm_only();
    $title = 'Мульти-акаунти';
    include './system/h.php';
    $id=(int)$_POST['id'];
?>
<div class='main'><div class='block_zero'>
<?
if($id) {
    $users=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`="'.$id.'"'));
    if(!$users) { header('location:/adm/clon/'); exit; }
    $count=mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `ip`="'.$users['ip'].'" AND `id`!="'.$id.'"'),0);
    echo "IP: {$users['ip']}<br>";
    if($count>0) {
        $q=mysql_query('SELECT * FROM `users` WHERE `ip`="'.$users['ip'].'" AND `id`!="'.$id.'"');
        while($r=mysql_fetch_array($q)) echo "<img src='/images/icon/race/{$r['r']}.png'> <a href='/user/{$r['id']}/'>{$r['login']}</a><br>";
    } else echo "<font color='#999'>Мультів не знайдено!</font>";
} else {
?>
<form action='/adm/clon/' method='post'>
ID гравця: <input name='id'><br>
<input type='submit' value='Перевірити'>
</form>
<?
}
?>
</div></div>
<? include './system/f.php'; break;

// ─── РЕДАГУВАННЯ АКАУНТУ (стара) ─────────────────────────────────────────
case 'acc':
    adm_only();
    $title = 'Редагування';
    include './system/h.php';
    if(isset($_GET['yes'])) {
        $uid=(int)$_GET['yes'];
        mysql_query('UPDATE `users` SET `login`="'.mysql_real_escape_string($_POST['login']).'",`s`='.(int)$_POST['s'].',`g`='.(int)$_POST['g'].',`level`='.(int)$_POST['level'].',`exp`='.(int)$_POST['exp'].',`str`='.(int)$_POST['str'].',`vit`='.(int)$_POST['vit'].',`agi`='.(int)$_POST['agi'].',`def`='.(int)$_POST['def'].',`mana`='.(int)$_POST['mana'].',`skill`='.(int)$_POST['skill'].' WHERE `id`="'.$uid.'"');
        header('location:/adm/acc/'); exit;
    }
    if(isset($_POST['submit']) && !empty($_POST['id'])) {
        $acc=mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`='.(int)$_POST['id'].' LIMIT 1'));
?>
<div class='block_zero'>
<form action='/adm/acc/yes/<?=(int)$_POST['id']?>/' method='post'>
Нік: <input name='login' value='<?=$acc['login']?>'><br>
Срібло: <input name='s' value='<?=$acc['s']?>'><br>
Золото: <input name='g' value='<?=$acc['g']?>'><br>
Рівень: <input name='level' value='<?=$acc['level']?>'><br>
Досвід: <input name='exp' value='<?=$acc['exp']?>'><br>
Сила: <input name='str' value='<?=$acc['str']?>'><br>
Жизнь: <input name='vit' value='<?=$acc['vit']?>'><br>
Удача: <input name='agi' value='<?=$acc['agi']?>'><br>
Захист: <input name='def' value='<?=$acc['def']?>'><br>
Мана: <input name='mana' value='<?=$acc['mana']?>'><br>
Майст: <input name='skill' value='<?=$acc['skill']?>'><br>
<input type='submit' value='Зберегти'>
</form>
</div>
<?
    } else {
?>
<div class='block_zero'>
<form action='/adm/acc/' method='post'>
ID: <input name='id'><br>
<input type='submit' name='submit' value='Завантажити'>
</form>
</div>
<?
    }
    include './system/f.php'; break;
}
?>
