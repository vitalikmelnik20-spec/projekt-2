<?php


include './system/common.php';
include './system/functions.php';
include './system/user.php';
    
if (!isset ($user)) {
    header('location: /');
    exit;
}

$title = 'Задания';
include './system/h.php';

$set = array (
    'max_active_q' => 10, // максимальное количество активных квестов 
    'time' => 3600 * 10   //  время обновления уже выполненых квестов (10 ч)
);


// Place
// 1 - Арена
// 2 - Задания
// 3 - Дуэли
// 4 - Поход
// 5 - Пещера
// 6 - Колизей
// 7 - Долина бессмертных



// Обновление неактивных квестов
$q = mysql_query ('select * from `user_q` WHERE (`user`="' . $user['id'] . '") AND (`complete`="1")');
if (mysql_num_rows ($q) < $set['max_active_q']) {
    $i = 0;
    while ($user_q = mysql_fetch_array ($q)) {
        
        if ($user_q['time']<time ()) {
            $i++;
            if ($i < 10) {
                mysql_query ('UPDATE `user_q` SET `complete`="0",`c`="0" WHERE (`user`="' . $user['id'] . '") AND (`q`="' . $user_q['q'] . '")');
            }
        }
        
    }

}




// Обновление новых квестов
$q = mysql_query ('select * from `user_q` WHERE (`user`="' . $user['id'] . '") AND (`complete`="0")');
if (mysql_num_rows ($q) < $set['max_active_q']) {
    // Обновление квестов
    $q = mysql_query ('select * from `quest`');
    
    $i = 0;
    while ($quest = mysql_fetch_array ($q)) {
        $q_ = mysql_query ('SELECT * FROM `user_q` WHERE (`user`="' . $user['id'] . '") AND (`q`="' . $quest['id'] . '")');
        if (mysql_num_rows ($q_)==0) {
            $i++;
            if ($i <10) {
                mysql_query ('INSERT INTO `user_q` (`user`, `q`) VALUES ("' . $user['id'] . '", "' . $quest['id'] . '")');
            }
        }
           
    }
    
}

echo '
<div class="main" align="center"><span style="color:#90b0c0;">Выполняй задания и получай отличную награду</span></div>
<div class="mini-line"></div>
<div class="menuList">
';

// Выполнение квеста
if (isset ($_GET['complete'])) {
    $_GET['complete'] = (int) $_GET['complete'];
    $q = mysql_query ('select * from `user_q` WHERE (`user`="' . $user['id'] . '") AND (`q`="' . $_GET['complete'] . '")');
    if (mysql_num_rows ($q)==0) {
        header ('location: /quest.php');
        exit;
    }
    $user_q = mysql_fetch_array ($q);
    if ($user_q['complete']==1) {
        header ('location: /quest.php');
        exit;
    }
    $q_ = mysql_query ('SELECT * FROM `quest` WHERE (`id`="' . $user_q['q'] . '")');
    $quest = mysql_fetch_array ($q_);
    
    if ($user_q['c']<$quest['c']) {
        header ('location: /quest.php');
        exit;
    }
    
    
    
    
    mysql_query ('UPDATE `user_q` SET `complete`="1", `time`="' . ( time () + $set['time'] ) . '" WHERE (`user`="' . $user['id'] . '") AND (`q`="' . $quest['id'] . '")');
    mysql_query ('UPDATE `users` SET `g`=`g`+' . $quest['_gold'] . ', `s`=`s`+' . $quest['_silver'] . ', `exp`=`exp`+' . $quest['_exp'] . ' WHERE (`id`="' . $user['id'] . '")');






    // Place
    // 2 - Задания
    // Type
    // 0 - Выполнить любые задания в хижине мудреца
    $q = mysql_query ('select * from `user_q` WHERE (`user`="' . $user['id'] . '") AND (`complete`="0")');
    if (mysql_num_rows ($q) != 0) {
        
        while ($user_q = mysql_fetch_array ($q)) {
                
            // 
            $q_ = mysql_query ('SELECT * FROM `quest` WHERE (`id`="' . $user_q['q'] . '")');
            $quest = mysql_fetch_array ($q_);
            
            
            if ($quest['place']=='2') {
            
            
                if ($quest['type']=='0') {
                    if ($user_q['c']<$quest['c']) {
                        mysql_query ('UPDATE `user_q` SET `c`=`c`+1 WHERE (`user`="' . $user['id'] . '") AND (`q`="' . $quest['id'] . '")');
                    }
                }            
                
            }

        }

    }


    header ('location: /quest.php');
    
}

// Список активных квестов
$q = mysql_query ('select * from `user_q` WHERE (`user`="' . $user['id'] . '") AND (`complete`="0")');
if (mysql_num_rows ($q) == 0) {
    
    echo '<div class=\'menuList\'>
    <center><li> Нет активных квестов</li></div></center>
    ';
    
}
else {

    while ($user_q = mysql_fetch_array ($q)) {
            
        // 
        $q_ = mysql_query ('SELECT * FROM `quest` WHERE (`id`="' . $user_q['q'] . '")');
        $quest = mysql_fetch_array ($q_);
        
        echo '
        <div class=\'menuList\'><li>
		    
            <b style="color:#90c090;">' . $quest['title'] . '</b><br/>
            <span style="font-size:12px;">' . $quest['description'] . '</span><br/>
            <span style="color:#90b0c0;">Прогресс:</span> ' . ($user_q['c'] == $quest['c'] ? '<span style="color:#30c030;">Задание выполнено!</span>':$user_q['c'] . ' из ' . $quest['c'] ). '<br/>
            <span style="color:#90b0c0;">Награда:</span> ' . ($quest['_gold'] != 0 ? ' <img src="/images/icon/gold.png" alt=""/> ' . $quest['_gold'] . ' золота' : '') . ($quest['_silver'] != 0 ? ' <img src="/images/icon/silver.png" alt=""/> ' . $quest['_silver'] . ' серебра' : '') . ($quest['_exp'] != 0 ? ' <img src="/images/icon/exp.png" alt=""/> ' . $quest['_exp'] . ' опыта' : '') . '
        <div style="text-align:center;">';
        
        if ($user_q['c']==$quest['c']) {
        
            echo '<a href="/quest.php?complete=' . $quest['id'] . '"><span class="btn"><span class="end"><span class="label">Завершить задание</a></span></span></span>';
        
        }
        else {
            switch ($quest['place']) {
                case 1:
                    $self = 'arena';
                break;
                case 2:
                    $self = 'quest';
                break;
                case 3:
                    $self = 'duel';
                break;
                case 4:
                    $self = 'farm';
                break;
                case 5:
                    $self = 'cave';
                break;
                case 6:
                    $self = 'coliseum';
                break;
                case 7:
                    $self = 'undying';
                break;
            }
            echo '<a href="/' . $self . '.php"><span class="btn"><span class="end"><span class="label">Перейти к выполнению</a></span></span></span>';
        
        }
        
        echo '
            </div>
        </li></div>
        ';

    }

}



// Список активных квестов
$q = mysql_query ('select * from `user_q` WHERE (`user`="' . $user['id'] . '") AND (`complete`="1")');
if (mysql_num_rows ($q) != 0) {

    while ($user_q = mysql_fetch_array ($q)) {
            
        // 
        $q_ = mysql_query ('SELECT * FROM `quest` WHERE (`id`="' . $user_q['q'] . '")');
        $quest = mysql_fetch_array ($q_);
        
        $t_wait = ceil ( ( $user_q['time']-time () ) / 3600);
        
        echo '
        <li>
            <span style="color:grey;"><b>' . $quest['title'] . '</b><br/>
            <span style="font-size:12px;">
            <span style="font-size:12px;">' . $quest['description'] . '</span><br/>
            Будет доступно через: ' . ( $t_wait < 1 ? $t_wait . ' мин' : $t_wait . ' час(а/ов)' ) . '</span></span>
        </li>
        ';

    }

}

echo '
</div>
';

include './system/f.php';