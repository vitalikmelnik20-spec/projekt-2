<?php 

// Корооль Бессмертных 
// Специально для fallout3.mobi.ru,2015 



$token=uniqid(); 





// Установки 
// Путь 
$_path='./system'; 
// Заголовок 
$_title = 'Король Бессмертных'; 
// Период времени, через который будет обновляться мероприятие 
// 24 часа 3600 * 2 
$_event_period_time=3600 * 2; 
// Время проведения мероприятия 
// 10 минут 
$_event_time=60 * 30; 
// Задержка в ударах 
$_event_attack_delay=5; 
//  
$_event_dragon_parameters=array( 
    // Strength 
    1500000, 
    // Agility 
    15000, 
    // Protected 
    150000, 
    // Vitality 
    150000 
); 
// Награда за убийство дракона (золото и опыт) 
$_event_dragon_die_trophy=10000; 
$_event_dragon_die_exp=3000; 

// Получение параметров дракона 
list($dragon_str,$dragon_agi,$dragon_def,$dragon_vit)=$_event_dragon_parameters; 


// Вызов необходимых файлов 
// Общие настройки 
include $_path  . '/common.php'; 
// Функции 
include $_path  . '/functions.php'; 
// Пользователь 
include $_path  . '/user.php'; 

// Требование авторизациии 
if( ! is_array($user)) { 
    header(sprintf( 
        'location:%s', 
        '/' 
    )); 
    exit; 
} 

// Установка заголовка 
$title    =&$_title; 
// Вывод на экран HTML содержимого 
include $_path  . '/h.php'; 


// Тело 
// Устанавливаем содержимое (тело) документа как строку 
$body='<ul style="list-style:none;padding:0px;margin:0px;">'; 

// Поиск ближайшего мероприятия 
$query=mysql_query('SELECT * FROM `dragonEvent` ORDER BY `id` DESC LIMIT 1'); 
// Если ближайшее мероприятие найдено 
if(mysql_num_rows($query)!=0){ 
     
    // Мероприятие 
    $event    =mysql_fetch_assoc($query); 
     
    // Пользователь 
    $query    =mysql_query('SELECT * FROM `dragonEventMemb` WHERE (`user_id`="' . $user['id'] . '") ORDER BY `id` DESC LIMIT 1'); 
    $memb    =mysql_num_rows($query)!=0?mysql_fetch_assoc($query) : null; 
     
     
    // Если битва еще не началась, а время вышло 
    if($event['start']==0 and $event['time']<=time()){ 
        mysql_query('UPDATE `dragonEvent` SET `start`="1",`time`="' . (time()+$_event_time) . '" WHERE (`id`="' . $event['id'] . '")'); 
        header(sprintf( 
            'location:%s?%s', 
            '/king/', 
            $token 
        )); 
        exit; 
    } 

     
    // Если битва уже идет, а время вышло 
    if($event['start']==1 and $event['end']==0 and $event['time']<=time()){ 
        mysql_query('UPDATE `dragonEvent` SET `end`="1" WHERE (`id`="' . $event['id'] . '")'); 
        header(sprintf( 
            'location:%s?%s', 
            '/king/', 
            $token 
        )); 
        exit; 
    } 
     
    if($event['start']==1 and $event['end']==0 and $event['dragon']==0){ 
        mysql_query('UPDATE `dragonEvent` SET `end`="1" WHERE (`id`="' . $event['id'] . '")'); 
        header(sprintf( 
            'location:%s?%s', 
            '/king/', 
            $token 
        )); 
        exit; 
    } 

     
    // Если мероприятие началось 
    // Пользователь принимает участие в мероприятии 
    if($event['start']==1 and $event['end']==0 and  ! is_null($memb) and $memb['event_id']==$event['id']){ 

        $body.='<style="text-align:center;"><span style="float:right;">Время до конца битвы :' . _time($event['time']-time()) . '</span><b style="color:#f0c060;"><center>     Битва с Королем Бессмертных </center></b><span style="float:left;"></span></li>'; 
        $body.='< style="text-align:center;">'; 
        $body.='<img src="/images/town/hd/king.jpg" alt=""  width="260"/><br>'; 
         
        if($event['dragon']==0){ 
            mysql_query('UPDATE `dragonEvent` SET `end`="1" WHERE (`id`="' . $event['id'] . '")'); 
            header(sprintf( 
                'location:%s?%s', 
                '/king/', 
                $token 
            )); 
            exit; 
        } 
         
         
        if($event['dragon']!=0){ 
                 
                 
                 
                $_GET['attack'] = isset ($_GET['attack']) ? intval ($_GET['attack']) : 0; 
                if ($_GET['attack']==1) { 
                 
                 
                    if((time()-$memb['lastAttack'])<$_event_attack_delay){ 
                        header(sprintf( 
                            'location:%s?%s', 
                            '/king/', 
                            $token 
                        )); 
                        exit; 
                    } 
                     
                    $dmg = 0; 
                    $ability_1 = 0; 
                    $ability_2 = 0; 
                    $ability_3 = 0; 
                    $ability_4 = 0; 
                                                                 
                    if ($user['ability_1']!=0) { 
                        $ability_1_b = 20 + ($user['ability_1']*5) - 5; 
                        $ability_1_c = 5     + ($user['ability_1']*3) - 3; 
                     
                     
                    if (mt_rand(0, 100) <= $ability_1_c) 
                        $ability_1 = 1; 
                                                                         
                    } 
                                                                         
                    if ($user['ability_2']!=0) { 
                        $ability_2_b = 20 + ($user['ability_2']*5) - 5; 
                        $ability_2_c = 5     + ($user['ability_2']*3) - 3; 

                        if (mt_rand(0, 100) <= $ability_2_c) 
                            $ability_2 = 1; 
                                                                         
                    } 

                    if ($user['ability_3']!=0) { 
                        $ability_2_b   = 5 + ($user['ability_3']*3) - 3; 
                        $ability_2_c   = 5 + ($user['ability_3']*2) - 2; 
                        $ability_2_c_c = 20+ ($user['ability_3']*5) - 5; 

                        if (mt_rand(0, 100) <= $ability_3_c) 
                            $ability_3 = 1; 
                    } 
                                                                         
                    if ($user['ability_4']!=0) { 
                        $ability_2_b = 20 + ($user['ability_4']*2) - 2; 
                        $ability_2_c = 5     + ($user['ability_4']*5) - 5; 
                         
                        if (mt_rand(0, 100) <= $ability_4_c) 
                            $ability_4 = 1; 
                                                                         
                    } 
                     
                    $dmg += ceil (rand(($user['str']/6), ($user['str']/4))); 
                                                                         
                    if ($ability_1==1) { 
                        $dmg += ceil (($dmg / 100) * $ability_1_b); 
                    } 
                     
                    $dmg -= ceil (rand(($dragon_def/12), ($dragon_def/7)));         
                     
                    if ($dmg < 0) 
                        $dmg = 0; 

                         
                         
                    $crit = $ability_1==1?((rand (1,2)*($user['agi']/100)+$ability_3_c_c)-(rand (1,2)*($dragon_agi/100))):((rand (1,2)*($user['agi']/100))-(rand (1,2)*($dragon_agi/100))); 
                                                                         
                    if (mt_rand(0, 100) <= $crit) {    
                        $dmg *= 2; 

                        if($ability_3 == 1) {                              
                            $dmg += ceil (($dmg/100)*$ability_3_b);                                 
                        }     
                    } 

                    $dodge = ((rand (1,2)*($dragon_agi/100))-(rand (1,2)*($user['agi']/100))); 
                                                         
                    if(mt_rand(0, 100) <= $dodge) 
                        $dmg = 0; 
                     
                    if ($dmg>=$event['dragon']) { 
                         
                        $dmg = $event['dragon']; 
                         
                    } 
                     
                    mysql_query ('UPDATE `dragonEvent` SET `dragon`=`dragon`-' . $dmg . ' WHERE (`id`="' . $event['id'] . '")'); 
                    mysql_query ('UPDATE `dragonEventMemb` SET `lastAttack`="' . time () . '" WHERE (`id`="' . $memb['id'] . '")'); 
                     
                    $body.='<div style="text-align:center;">'; 
                     
                    $logString=''; 
                     
                    if ($dmg==0) { 
                        $logString='<img src=\"/images/icon/race/' . $user['r'] . '.png\" alt=\"\"/> ' . $user['login'] . ' попытался нанести урон королю.'; 
                        $body.='Вы промахнулись'; 
                    } 
                    else { 
                        $logString='<img src=\"/images/icon/race/' . $user['r'] . '.png\" alt=\"\"/> ' . $user['login'] . ' нанес ' . $dmg . ' урона.'; 
                        $body.='Вы нанесли <b>' . $dmg . '</b> урона'; 
                    } 
                     

                    if ($dmg>=$event['dragon']) { 
                        $logString='<img src=\"/images/icon/race/' . $user['r'] . '.png\" alt=\"\"/> ' . $user['login'] . ' убил короля!'; 
                        mysql_query('UPDATE `dragonEventMemb` SET `dragon`="1" WHERE (`id`="' . $memb['id'] . '")'); 
                        mysql_query('UPDATE `users` SET `g`=`g`+' . $_event_dragon_die_trophy . ' WHERE (`id`="' . $user['id'] . '")'); 
                        mysql_query('UPDATE `users` SET `exp`=`exp`+' . $_event_dragon_die_exp . ' WHERE (`id`="' . $user['id'] . '")'); 
                    } 
                     
                     
                    // 
                    if($ability_1==1) 
                        $logString.='<br/><img src=\"/images/icon/race/' . $user['r'] . '.png\" alt=\"\"/> ' . $user['login'] . ' применил <img src=\"/images/icon/quality/' . $user['ability_1_quality'] . '.png\" alt=\"\"/> Ярость титана'; 
                     
                    if($ability_2==1) 
                        $logString.='<br/><img src=\"/images/icon/race/' . $user['r'] . '.png\" alt=\"\"/> ' . $user['login'] . ' применил <img src=\"/images/icon/quality/' . $user['ability_2_quality'] . '.png\" alt=\"\"/> Крепкая броня'; 
                     
                    if($ability_3==1) 
                        $logString.='<br/><img src=\"/images/icon/race/' . $user['r'] . '.png\" alt=\"\"/> ' . $user['login'] . ' применил <img src=\"/images/icon/quality/' . $user['ability_3_quality'] . '.png\" alt=\"\"/> Вихрь критов'; 
                     
                    if($ability_4==1) 
                        $logString.='<br/><img src=\"/images/icon/race/' . $user['r'] . '.png\" alt=\"\"/> ' . $user['login'] . ' применил <img src=\"/images/icon/quality/' . $user['ability_4_quality'] . '.png\" alt=\"\"/> Защитная стойка'; 
                     
                         
                    mysql_query ('INSERT INTO `dragonEventLog` (`event_id`,`text`) VALUES ("' . $event['id'] . '","' . $logString . '")'); 
                     
                     
                     
                    if ($ability_1!=0 || $ability_2!=0 || $ability_3!=0 | $ability_4!=0) { 
                        $body.='<div class="separ"></div>'; 

                        if($ability_1==1) { 
                            $body.='<img src="/images/ability/1.' . $user['ability_1_quality'] . '.png" style="width:25px;height:25px;" alt=""/> '; 
                        } 
                        if($ability_2==1) { 
                            $body.='<img src="/images/ability/2.' . $user['ability_2_quality'] . '.png" style="width:25px;height:25px;" alt=""/> '; 
                        } 
                        if($ability_3==1) { 
                            $body.='<img src="/images/ability/3.' . $user['ability_3_quality'] . '.png" style="width:25px;height:25px;" alt=""/> '; 
                        } 
                        if($ability_4==1) { 
                            $body.='<img src="/images/ability/4.' . $user['ability_4_quality'] . '.png" style="width:25px;height:25px;" alt=""/> '; 
                        } 
                    } 
                    $body.='</div>'; 

                } 

            $body.='<b>Король Бессмертных</b>'; 
            $body.='<img src="/images/icon/health.png" alt=""/> ' . $event['dragon'] . '<br/>'; 
             
        } 
        else{ 
            $body.='<div style="border-left:2px solid #606060;border-right:2px solid #606060;">'; 
            $body.='<span style="color:#909090;">Король бессмертных повержен!</span><br/>'; 
            $body.='<span style="color:#c03030;">Уровень кровожадности: ' . $event['blood'] . '%</span><br/>'; 
            $body.='<span style="color:#909090;font-size:10px;">Чем больше уровень кровожадности, тем больше становится вами наносимый урон противнику.</span>'; 
            $body.='</div>'; 
        } 
         
        // Если пользователь мертв 
        if($memb['hp']==0){ 
            $body.='<div style="border-left:2px solid #606060;border-right:2px solid #606060;">'; 
            $body.='<span style="color:#909090;">Вы убиты.</span>'; 
            $body.='<a class="btn" href="/king" /><span class="end"><span class="label">Обновить</a></span></span>'; 
            $body.='</div>'; 
        } 
        // Если пользователь еще жив 
        else{ 
            if($event['dragon']!=0){ 
             
                if((time()-$memb['lastAttack'])<$_event_attack_delay){ 
                    $body.='До удара ' . ($_event_attack_delay-(time()-$memb['lastAttack'])) . ' сек..<br/>'; 
                    $body.='<a class="btn" href="/king/?' . $token . '" /><span class="end"><span class="label">Обновить</a></span></span>'; 

                } 
                else{ 
                    $body.='<a class="btn" href="/king/?attack=1" /><span class="end"><span class="label">Атаковать</a></span></span>'; 
                } 
                 
            } 
            else{ 
                 
                $_GET['target'] = isset($_GET['target']) ? (is_numeric ($_GET['target']) ? $_GET['target'] : 0) : 0; 
                if ($_GET['target']==1){ 
                    $query=mysql_query('SELECT * FROM `dragonEventMemb` WHERE (`event_id`="' . $event['id'] . '") AND (`id`!="' . $memb['id'] . '")'); 
                    if(mysql_num_rows($query)!=0){ 
                        $opponent=mysql_fetch_assoc($query); 
                        mysql_query('UPDATE `dragonEventMemb` SET `opponent`="' . $opponent['id'] . '" WHERE (`id`="' . $memb['id'] . '")');                     
                    } 
                    header (sprintf( 
                        'location:%s?%s', 
                        '/king/', 
                        $token 
                    )); 
                    exit; 
                } 
                 
                $body.='<a class="btn" href="/king/?attack=1" /><span class="end"><span class="label">Атаковатьlabel</a></span></span>'; 
                 
            }         
        } 
         

        $body.='</li>'; 
         
        // Log 
        $query=mysql_query('SELECT * FROM `dragonEventLog` WHERE (`event_id`="' . $event['id'] . '") ORDER BY `id` DESC LIMIT 10');         
        if(mysql_num_rows($query)!=0){ 
            while($log=mysql_fetch_assoc($query)){ 
                $body.=$log['text'] . '<br/>'; 
            } 
        } 

         
    } 
    // Если битва еще не началась 
    else{ 
         
         
        $body.='<li style="text-align:center;">'; 
         
        if($event['start']==1 and $event['end']==1){ 
             
             
            $query    =mysql_query('SELECT `users`.* FROM `dragonEventMemb` LEFT JOIN `users` ON `users`.`id`=`dragonEventMemb`.`user_id` WHERE (`dragonEventMemb`.`event_id`="' . $event['id'] . '") AND (`dragonEventMemb`.`dragon`="1")');
            if(mysql_num_rows($query)!=0){ 
                $winner    =mysql_fetch_assoc($query); 
                 
                $body.='<h3 style="color:#30f030;">Победитель Короля Бессмертных!</h3>'; 
                $body.='<img src="/images/town/hd/king.jpg" alt=""  width="260"/><br>'; 
                $body.='<img src="/images/icon/race/' . $winner['r'] . '.png" alt=""/> <a href="/user/' . $winner['id'] . '">' . $winner['login'] . '</a><br/>'; 
                $body.='<span style="color:#909090;font-size:12px;">Награда: <img src="/images/icon/gold.png" alt=""/> ' . $_event_dragon_die_trophy . ' золота <img src="/images/icon/exp.png" alt=""/> ' . $_event_dragon_die_exp . ' опыта</span><br/>'; 
             
            } 
             
            //  
             
            $body.='Следующая битва через ' . _time(($event['time']+$_event_period_time)-time()); 
             
            if(($event['time']+$_event_period_time)<=time()){ 
                mysql_query('INSERT INTO `dragonEvent` (`dragon`,`time`) VALUES ("' . ceil($dragon_vit * 100) . '","' . (time()+$_event_period_time) . '")'); 
                header(sprintf( 
                    'location:%s?%s', 
                    '/king/', 
                    $token 
                )); 
            } 
             
        } 
        else{ 
         
             
            // Если пользователь принимает участие в битве 
             
                 

                $body.='<img src="/images/town/hd/king.jpg" alt=""  width="260"/><br><div class="mini-line"></div>'; 
if( ! is_null($memb) and $memb['event_id']==$event['id']) 
            {                $body.='Битва с Королем Бессмертных начнется через: ' . _time($event['time']-time()) . '.<br/></br>';                $body.='<img src="/images/icon/race/0.png" alt=""/> <img src="/images/icon/race/1.png" alt=""/> Титаны: ' . mysql_result(mysql_query('SELECT COUNT(*) FROM `dragonEventMemb` WHERE (`event_id`="' . $event['id'] . '")'),0) . '<br/>';
                $body.='<a class="btn" href="/king/?' . $token . '" /><span class="end"><span class="label">Обновить</a></span></span>'; 
                 
            } 
            // Если пользователь не принимает участие в битве 
            else{ 
                 
                // Если мероприятие уже началось 
                if($event['start']==1){ 
                     
                    $body.='<span style="color:#909090;">Битва в самом разгаре..</span><br/>'; 
                    $body.='<img src="/images/icon/race/0.png" alt=""/> <img src="/images/icon/race/1.png" alt=""/> Титаны: ' . mysql_result(mysql_query('SELECT COUNT(*) FROM `dragonEventMemb` WHERE (`event_id`="' . $event['id'] . '")'),0) . '<br/>';
                    $body.='Битва закончится через: ' . _time($event['time']-time()) . '.<br/>'; 
                    $body.='<a class="btn" href="/king/?' . $token . '" /><span class="end"><span class="label">Обновить</a></span></span>'; 
                     
                } 
                // Если мероприятие еще не началось 
                else{ 
                     
                    $_GET['in']=isset($_GET['in']) ? (is_numeric($_GET['in']) ? $_GET['in'] : 0) : 0; 
                    if($_GET['in']==1){ 
                         
                        mysql_query('INSERT INTO `dragonEventMemb` (`event_id`,`user_id`,`hp`) VALUES ("' . $event['id'] . '","' . $user['id'] . '","' . ($user['vit']*2) . '")'); 
                        header(sprintf( 
                            'location:%s?%s', 
                            '/king/', 
                            $token 
                        )); 
                         
                    } 
                     
                    $body.='Битва с Королем Бессмертных начнется через: ' . _time($event['time']-time()) . '.<br/></br>'; 
                     
                    $body.='<img src="/images/icon/race/0.png" alt=""/> <img src="/images/icon/race/1.png" alt=""/> Титаны: ' . mysql_result(mysql_query('SELECT COUNT(*) FROM `dragonEventMemb` WHERE (`event_id`="' . $event['id'] . '")'),0) . '<br/>';
                    $body.='<a class="btn" href="/king/?in=1&amp;' . $token . '" /><span class="end"><span class="label">Подать заявку</a></span></span></br>'; 
                     
                } 
                 
            } 
         
        } 
     
    } 

    $body.='</li>'; 
     
} 
// Если ближайших мероприятий нет 
else{ 
     
     
    mysql_query('INSERT INTO `dragonEvent` (`dragon`,`time`) VALUES ("' . ceil($dragon_vit * 100) . '","' . (time()+$_event_period_time) . '")'); 
    header(sprintf( 
        'location:%s?%s', 
        '/king/', 
        $token 
    )); 
     
} 



$body.='</ul>'; 
// Вывод на экран содержимого (тела) 
print $body; 


// Вывод на экран HTML содержимого 
require $_path . '/f.php'; 


?>