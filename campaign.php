<?php
include_once './system/common.php';
include_once './system/functions.php';
include_once './system/user.php';
include_once './system/h.php';
$_GET['action']=isset($_GET['action'])?htmlspecialchars($_GET['action']):NULL;

if(!$user){
header('Location: /');
exit();
}

if($_GET['action']=='sent'){
    $title='Камень и трава';
}else{
    $title='Поход';
}

if (isset($_SESSION['err'])) {
?><div class="error center"><img src="/images/icon/error.png"><?=$_SESSION['err']?></div><?
    $_SESSION['err'] = NULL;
                             }
if (isset($_SESSION['ok'])) {
?><div class="ok center"><img src="/images/icon/ok.png"><?=$_SESSION['ok']?></div><?
    $_SESSION['ok'] = NULL;
                            }

$camp=mysql_fetch_assoc(mysql_query("SELECT * FROM `campaign` WHERE `id_user`='".$user['id']."' LIMIT 1"));

if(!$camp){
    mysql_query("INSERT INTO `campaign` SET `id_user`='".$user['id']."'");
    header('Location: /campaign');
    exit();
}

$camp_boss=mysql_fetch_assoc(mysql_query("SELECT * FROM `campaign_boss` WHERE `id`='".$camp['boss']."' LIMIT 1"));

$green=$camp['boss_hp']/($camp['boss']*10);
$user_hp=$camp['user_hp']/($user['vit']*2/100);

if($camp['time']<=time() AND $camp['status']=='2' AND $camp['user_hp']!='0' AND $camp['boss_hp']!=0){
    mysql_query("UPDATE `campaign` SET `status`='3', `udar`='9' WHERE `id_user`='".$user['id']."' LIMIT 1");
    mysql_query("UPDATE `users` SET `exp`=`exp`+'".($camp['boss']*10)."' WHERE `id`='".$user['id']."' LIMIT 1");
    header('Location: /campaign');
    exit();
}

if($camp['limit']<=time() AND $camp['status']=='4'){
    mysql_query("UPDATE `campaign` SET `status`='0', `udar`='9', `kol`='3' WHERE `id_user`='".$user['id']."' LIMIT 1");
    header('Location: /campaign');
    exit();
}

if(($_GET['action']!='' AND $_GET['action']!='sent') AND ($camp['status']=='0' OR $camp['status']=='4')){
    header('Location: /campaign');
    exit();
}

if($_GET['action']!='find' AND $camp['status']=='1'){
    header('Location: /campaign/find');
    exit();
}

if($_GET['action']!='lose' AND $camp['status']=='3'){
    header('Location: /campaign/lose');
    exit();
}

if($_GET['action']!='fight' AND $camp['status']=='2' AND $_GET['action']!='exit'){
    header('Location: /campaign/fight');
    exit();
}

switch($_GET['action']){

default:
        if(isset($_GET['go'])){
            $boss_id=mt_rand(1,18);
            mysql_query("UPDATE `campaign` SET `kol`=`kol`-'1', `status`='1', `boss`='".$boss_id."', `boss_stat`='1', `boss_hp`='".($boss_id*1000)."', `agi`='".round(($boss_id*1000/8)*0.9)."', `def`='".round(($boss_id*1000/8)*1.1)."', `user_hp`='".($user['vit']*2)."' WHERE `id_user`='".$user['id']."' LIMIT 1");
            header('Location: /campaign');
            exit();
        }
        if($camp['kol']==0 AND $camp['status']!='4'){
            mysql_query("UPDATE `campaign` SET `limit`='".(time()+21600)."', `status`='4' WHERE `id_user`='".$user['id']."' LIMIT 1");
            header('Location: /campaign');
            exit();
        }
?><div class='main'>
<div class='center'>
    <div class='block_zero'>
        <img src='/images/campaign/meadow.jpg' width='100%' alt='*'>
    </div>
    <div class='dot-line'></div>
    <div class='block_zero'>
        <span class='blue'>
            На своем пути ты встретишь множество опасных существ!
        </span>
    </div>
    <div class='dot-line'></div>
    <div class='block_zero center'><?
        if($camp['status']=='4'){
            ?><img src='/images/campaign/2hit.png' alt='*'>
        До следующего похода: <?=_time($camp['limit']-time())?>
        <?
        }else{
        ?><img src='/images/campaign/2hit.png' alt='*'>
        Осталось походов: <?=$camp['kol']?>
    </div>
    <div class='dot-line'></div>
    <div class='block_zero center'>
        <a class='btn' href='/campaign/go/'>
            <span class='end'>
                <span class='label'>
                    Отправиться в поход
                </span>
            </span>
        </a><?
        }
    ?></div>
</div>
<div class='mini-line'></div>
<ul class='hint'>
    <li>Убить монстра нужно максимум за 9 ударов и 5 минут</li>
    <li>Камень - увеличивает урон персонажа на 35%</li>
    <li>Трава - увеличивает броню персонажа на 35%</li>
    <li>Камень и Трава действуют весь бой</li>
    <li>Чем выше у тебя параметры, тем больше награда</li>
</ul>
<div class='mini-line'></div>
<table border='0' cellpadding='0' cellspacing='0' align='center'>
    <tr>
        <td colspan='2' style='padding:0px 0px 5px 18px;' align='center'>
            <span class='blue'>
                Усиления в бою:
            </span>
        </td>
    </tr>
    <tr align='center'>
        <td style='border-right:1px solid #3e3d36;padding:0px 10px;'>
            <img src='/images/campaign/stone.png' alt='*'>
            Камень
            <br>
            <span class='medium grey'>
                <?=$camp['stone']?> штук
            </span>
        </td>
        <td style='border-left:1px solid #1f1f1a;padding:0px 0px 0px 10px;'>
            <img src='/images/campaign/grass.png' alt='*'>
            Трава
            <br>
            <span class='medium grey'>
                <?=$camp['grass']?> штук
            </span>
        </td>
    </tr>
    <tr>
        <td colspan='2' style='padding:10px 0px 0px 18px;' align='center'>
            <a class='btn' href='/campaign/sent/'>
                <span class='end'>
                    <span class='label'>
                        Купить еще
                    </span>
                </span>
            </a>
        </td>
    </tr>
</table>
</div><?
break;
                        
case 'sent':
    if((isset($_GET['stone']) OR isset($_GET['grass'])) AND $user['g']<10){
        $_SESSION['err'] = 'Не хватает <img src="/images/campaign/gold.png" alt="*"> золота!';
        header('Location: /campaign/sent');
        exit();
    }
    if(isset($_GET['stone'])){
        mysql_query("UPDATE `campaign` SET `stone`=`stone`+'1' WHERE `id_user`='".$user['id']."' LIMIT 1");
        mysql_query("UPDATE `users` SET `g`=`g`-'5' WHERE `id`='".$user['id']."' LIMIT 1");
        $_SESSION['ok'] = 'Вы изготовили <img src="/images/campaign/stone.png" alt="*"> камень!';
        header('Location: /campaign/sent');
        exit();
    }
    if(isset($_GET['grass'])){
        mysql_query("UPDATE `campaign` SET `grass`=`grass`+'1' WHERE `id_user`='".$user['id']."' LIMIT 1");
        mysql_query("UPDATE `users` SET `g`=`g`-'5' WHERE `id`='".$user['id']."' LIMIT 1");
        $_SESSION['ok'] = 'Вы изготовили <img src="/images/campaign/grass.png" alt="*"> траву!';
        header('Location: /campaign/sent');
        exit();
    }
?><div class="main">
<div class='center'>
<div class='block_zero blue'>
    Камень и трава - самые мощные усиления в бою
</div>
</div>
<div class='mini-line'></div>
<div class='block_zero'>
    <img src='/images/campaign/big_stone.png' alt='*' style='float:left;margin-right:3px;margin-top:3px;'>
    <span class='medium'>
        <img src='/images/campaign/stone.png' alt='*'>
        Камень, <?=$camp['stone']?>
        <span class='white'>
            штук
        </span>
        <br>
        <span class='blue'>
            <img src='/images/campaign/2hit.png' alt='*'>
            Увеличивает урон на 35%
        </span>
        <br>
        <span class='grey'>
            Действует до окончания боя в походе
        </span>
    </span>
    <div style='clear:both;'></div>
</div>
<div class='dot-line'></div>
<div class='block_zero'>
    <div class='center'>
        <a class='btn' href='/campaign/sent/stone'>
            <span class='end'>
                <span class='label'>
                    Изготовить за 5
                    <img src='/images/campaign/gold.png' alt='*'>
                    золота
                </span>
            </span>
        </a>
    </div>
</div>
<div class='mini-line'></div>
<div class='block_zero'>
    <img src='/images/campaign/big_grass.png' alt='*' style='float:left;margin-right:3px;margin-top:3px;'>
    <span class='medium'>
        <img src='/images/campaign/grass.png' alt='*'>
        Трава, <?=$camp['grass']?>
        <span class='white'>
            штук
        </span>
        <br>
        <span class='blue'>
            <img src='/images/campaign/helm.png' alt='*'>
            Поглощает 35% урона
        </span>
        <br>
        <span class='grey'>
            Действует до окончания боя в походе
        </span>
    </span>
    <div style='clear:both;'>
    </div>
</div>
<div class='dot-line'></div>
<div class='block_zero'>
    <div class='center'>
        <a class='btn' href='/campaign/sent/grass'>
            <span class='end'>
                <span class='label'>
                    Изготовить за 5
                    <img src='/images/campaign/gold.png' alt='*'>
                    золота
                </span>
            </span>
        </a>
    </div>
</div>
<div class='mini-line'></div>
<div class='menuList'>
    <li>
        <a href='/campaign/'>
            <img src='/images/campaign/arrow.png' alt='*'>
            Вернуться в поход
        </a>
    </li>
</div>
</div><?
break;

case 'find':
        if(isset($_GET['fight'])){
            mysql_query("UPDATE `campaign` SET `status`='2', `stone_stat`='0', `grass_stat`='0', `time`='".(time()+300)."' WHERE `id_user`='".$user['id']."' LIMIT 1");
            mysql_query("DELETE FROM `campaign_log` WHERE `id_user`='".$user['id']."'");
            header('Location: /campaign');
            exit();
        }
?><div class="main">
<div class='center'>
    <div class='block_zero'>
        Вы обнаружили
        <img src='/images/campaign/bot.png' alt='*'>
        <b><?=$camp_boss['name']?></b>
        <img src='/images/campaign/health.png' alt='hp'>
        <?=$camp['boss_hp']?>
    </div>
    <div class='dot-line'></div>
    <div class='block_zero'>
        <a href='/campaign/find/fight'>
            <img src='/images/campaign/boss/<?=$camp['boss']?>/1.jpg' alt='*' width='180' height='112'>
        </a>
        <br>
        <div class='separ'></div>
        <a class='btn' href='/campaign/find/fight'>
            <span class='end'>
                <span class='label'>
                    Начать бой
                </span>
            </span>
        </a>
    </div>
</div>
</div><?
break;
        
case 'fight':
        
if(isset($_GET['win'])){
    mysql_query("UPDATE `campaign` SET `status`='3', `udar`='9' WHERE `id_user`='".$user['id']."' LIMIT 1");
    mysql_query("UPDATE `users` SET `g`=`g`+'".$camp['boss']."' WHERE `id`='".$user['id']."' LIMIT 1");
    header('Location: /campaign');
    exit();
}
        
if(isset($_GET['lose'])){
    mysql_query("UPDATE `campaign` SET `status`='3', `udar`='9' WHERE `id_user`='".$user['id']."' LIMIT 1");
    mysql_query("UPDATE `users` SET `exp`=`exp`+'".($camp['boss']*10)."' WHERE `id`='".$user['id']."' LIMIT 1");
    header('Location: /campaign');
    exit();
}
        
if(isset($_GET['stone'])){ 
    mysql_query("UPDATE `campaign` SET `stone_stat`='1', `stone`=`stone`-'1' WHERE `id_user`='".$user['id']."' LIMIT 1");
    $stone_log='<span class="dgreen">Вы применили <img src="/images/icon/stone.png" alt="*"> камень<br>Увеличивает наносимый урон на 35%</span>';
    mysql_query("INSERT INTO `campaign_log` SET `id_user`='".$user['id']."', `text`='".$stone_log."'");
    header('Location: /campaign');
    exit();
}
        
if(isset($_GET['grass'])){ 
    mysql_query("UPDATE `campaign` SET `grass_stat`='1', `grass`=`grass`-'1' WHERE `id_user`='".$user['id']."' LIMIT 1");
    $grass_log='<span class="dgreen">Вы применили <img src="/images/icon/grass.png" alt="*"> траву<br>Уменьшает получаемый урон на 35%</span>';
    mysql_query("INSERT INTO `campaign_log` SET `id_user`='".$user['id']."', `text`='".$grass_log."'");
    header('Location: /campaign');
    exit();
}
        
if(isset($_GET['attack'])){
    
    if($camp['udar']<1){
        header('Location: /campaign');
        exit();
    }
    
    if($user['ability_1'] > 0){
        switch($user['ability_1']){
            case 0:$a_1_bonus = 25;$a_1_chanse = 5;break;
            case 1:$a_1_bonus = 25;$a_1_chanse = 5;break;
            case 2:$a_1_bonus = 30;$a_1_chanse = 5;break;
            case 3:$a_1_bonus = 35;$a_1_chanse = 5;break;
            case 4:$a_1_bonus = 40;$a_1_chanse = 5;break;
            case 5:$a_1_bonus = 45;$a_1_chanse = 5;break;
            case 6:$a_1_bonus = 45;$a_1_chanse = 8;break;
            case 7:$a_1_bonus = 50;$a_1_chanse = 8;break;
            case 8:$a_1_bonus = 55;$a_1_chanse = 8;break;
            case 9:$a_1_bonus = 60;$a_1_chanse = 8;break;
            case 10:$a_1_bonus = 65;$a_1_chanse = 8;break;
            case 11:$a_1_bonus = 65;$a_1_chanse = 11;break;
            case 12:$a_1_bonus = 70;$a_1_chanse = 11;break;
            case 13:$a_1_bonus = 75;$a_1_chanse = 11;break;
            case 14:$a_1_bonus = 80;$a_1_chanse = 11;break;
            case 15:$a_1_bonus = 85;$a_1_chanse = 11;break;
            case 16:$a_1_bonus = 85;$a_1_chanse = 14;break;
            case 17:$a_1_bonus = 90;$a_1_chanse = 14;break;
            case 18:$a_1_bonus = 95;$a_1_chanse = 14;break;
            case 19:$a_1_bonus = 100;$a_1_chanse = 14;break;
            case 20:$a_1_bonus = 105;$a_1_chanse = 14;break;
            case 21:$a_1_bonus = 105;$a_1_chanse = 17;break;
            case 22:$a_1_bonus = 145;$a_1_chanse = 20;break;
            case 23:$a_1_bonus = 165;$a_1_chanse = 23;break;
            case 24:$a_1_bonus = 165;$a_1_chanse = 23;break;
        }
        if(mt_rand(0,100) <= $a_1_chanse){
            $a_1 = TRUE;
        }
    }
    if($user['ability_2'] > 0){
        switch($user['ability_2']){
            case 0:$a_2_bonus = 25;$a_2_chanse = 5;break;
            case 1:$a_2_bonus = 25;$a_2_chanse = 5;break;
            case 2:$a_2_bonus = 30;$a_2_chanse = 5;break;
            case 3:$a_2_bonus = 30;$a_2_chanse = 5;break;
            case 4:$a_2_bonus = 35;$a_2_chanse = 5;break;
            case 5:$a_2_bonus = 35;$a_2_chanse = 5;break;
            case 6:$a_2_bonus = 40;$a_2_chanse = 8;break;
            case 7:$a_2_bonus = 40;$a_2_chanse = 8;break;
            case 8:$a_2_bonus = 45;$a_2_chanse = 8;break;
            case 9:$a_2_bonus = 45;$a_2_chanse = 8;break;
            case 10:$a_2_bonus = 50;$a_2_chanse = 8;break;
            case 11:$a_2_bonus = 50;$a_2_chanse = 11;break;
            case 12:$a_2_bonus = 55;$a_2_chanse = 11;break;
            case 13:$a_2_bonus = 55;$a_2_chanse = 11;break;
            case 14:$a_2_bonus = 60;$a_2_chanse = 11;break;
            case 15:$a_2_bonus = 60;$a_2_chanse = 11;break;
            case 16:$a_2_bonus = 65;$a_2_chanse = 14;break;
            case 17:$a_2_bonus = 65;$a_2_chanse = 14;break;
            case 18:$a_2_bonus = 70;$a_2_chanse = 14;break;
            case 19:$a_2_bonus = 70;$a_2_chanse = 14;break;
            case 20:$a_2_bonus = 75;$a_2_chanse = 14;break;
            case 21:$a_2_bonus = 75;$a_2_chanse = 17;break;
            case 22:$a_2_bonus = 80;$a_2_chanse = 20;break;
            case 23:$a_2_bonus = 80;$a_2_chanse = 23;break;
            case 24:$a_2_bonus = 85;$a_2_chanse = 23;break;
        }
        if(mt_rand(0,100) <= $a_2_chanse){
            $a_2 = TRUE;
        }
    }
    if($user['ability_3'] > 0){
        switch($user['ability_3']){
            case 0:$a_3_bonus = 5;$a_3_crit_chanse = 5;$a_3_chanse = 20;break;
            case 1:$a_3_bonus = 5;$a_3_crit_chanse = 5;$a_3_chanse = 20;break;
            case 2:$a_3_bonus = 8;$a_3_crit_chanse = 5;$a_3_chanse = 20;break;
            case 3:$a_3_bonus = 11;$a_3_crit_chanse = 5;$a_3_chanse = 20;break;
            case 4:$a_3_bonus = 14;$a_3_crit_chanse = 5;$a_3_chanse = 20;break;
            case 5:$a_3_bonus = 17;$a_3_crit_chanse = 5;$a_3_chanse = 20;break;
            case 6:$a_3_bonus = 17;$a_3_crit_chanse = 7;$a_3_chanse = 25;break;
            case 7:$a_3_bonus = 20;$a_3_crit_chanse = 7;$a_3_chanse = 25;break;
            case 8:$a_3_bonus = 23;$a_3_crit_chanse = 7;$a_3_chanse = 25;break;
            case 9:$a_3_bonus = 26;$a_3_crit_chanse = 7;$a_3_chanse = 25;break;
            case 10:$a_3_bonus = 29;$a_3_crit_chanse = 7;$a_3_chanse = 25;break;
            case 11:$a_3_bonus = 29;$a_3_crit_chanse = 9;$a_3_chanse = 30;break;
            case 12:$a_3_bonus = 32;$a_3_crit_chanse = 9;$a_3_chanse = 30;break;
            case 13:$a_3_bonus = 35;$a_3_crit_chanse = 9;$a_3_chanse = 30;break;
            case 14:$a_3_bonus = 38;$a_3_crit_chanse = 9;$a_3_chanse = 30;break;
            case 15:$a_3_bonus = 41;$a_3_crit_chanse = 9;$a_3_chanse = 30;break;
            case 16:$a_3_bonus = 41;$a_3_crit_chanse = 11;$a_3_chanse = 35;break;
            case 17:$a_3_bonus = 44;$a_3_crit_chanse = 11;$a_3_chanse = 35;break;
            case 18:$a_3_bonus = 47;$a_3_crit_chanse = 11;$a_3_chanse = 35;break;
            case 19:$a_3_bonus = 50;$a_3_crit_chanse = 11;$a_3_chanse = 35;break;
            case 20:$a_3_bonus = 53;$a_3_crit_chanse = 11;$a_3_chanse = 35;break;
            case 21:$a_3_bonus = 53;$a_3_crit_chanse = 13;$a_3_chanse = 40;break;
            case 22:$a_3_bonus = 77;$a_3_crit_chanse = 15;$a_3_chanse = 45;break;
            case 23:$a_3_bonus = 89;$a_3_crit_chanse = 17;$a_3_chanse = 50;break;
            case 24:$a_3_bonus = 89;$a_3_crit_chanse = 17;$a_3_chanse = 50;break;
        }
        if(mt_rand(0,100) <= $a_3_chanse){
            $a_3 = TRUE;
        }
    }
    if($user['ability_4'] > 0){
        switch($user['ability_4']){
            case 0:$a_4_bonus = 20;$a_4_chanse = 5;break;
            case 1:$a_4_bonus = 20;$a_4_chanse = 5;break;
            case 2:$a_4_bonus = 22;$a_4_chanse = 5;break;
            case 3:$a_4_bonus = 24;$a_4_chanse = 5;break;
            case 4:$a_4_bonus = 26;$a_4_chanse = 5;break;
            case 5:$a_4_bonus = 28;$a_4_chanse = 5;break;
            case 6:$a_4_bonus = 28;$a_4_chanse = 10;break;
            case 7:$a_4_bonus = 30;$a_4_chanse = 10;break;
            case 8:$a_4_bonus = 32;$a_4_chanse = 10;break;
            case 9:$a_4_bonus = 34;$a_4_chanse = 10;break;
            case 10:$a_4_bonus = 36;$a_4_chanse = 10;break;
            case 11:$a_4_bonus = 36;$a_4_chanse = 15;break;
            case 12:$a_4_bonus = 38;$a_4_chanse = 15;break;
            case 13:$a_4_bonus = 40;$a_4_chanse = 15;break;
            case 14:$a_4_bonus = 42;$a_4_chanse = 15;break;
            case 15:$a_4_bonus = 44;$a_4_chanse = 15;break;
            case 16:$a_4_bonus = 44;$a_4_chanse = 20;break;
            case 17:$a_4_bonus = 46;$a_4_chanse = 20;break;
            case 18:$a_4_bonus = 48;$a_4_chanse = 20;break;
            case 19:$a_4_bonus = 50;$a_4_chanse = 20;break;
            case 20:$a_4_bonus = 52;$a_4_chanse = 20;break;
            case 21:$a_4_bonus = 52;$a_4_chanse = 25;break;
            case 22:$a_4_bonus = 68;$a_4_chanse = 30;break;
            case 23:$a_4_bonus = 76;$a_4_chanse = 35;break;
            case 24:$a_4_bonus = 76;$a_4_chanse = 35;break;
        }
        if(mt_rand(0, 100) <= $a_4_chanse){
            $a_4 = TRUE;
        }
    }
    function quality_color($i){
        switch($i){
            case 0:$color = "#908060";break;
            case 1:$color = "#60c030";break;
            case 2:$color = "#6090c0";break;
            case 3:$color = "#c060f0";break;
            case 4:$color = "#f06000";break;
            case 5:$color = "#909090";break;
            case 6:$color = "#909090";break;
        }
        return $color;
    }
    
   
    if($a_1){
        $user_udar=round(rand($user['str']*0.9,$user['str'])*(1+$a_1_bonus/100));
        $skill = '<br>Вы применили <img src="/images/campaign/'.$user['ability_1_quality'].'.png"> <font color="'.quality_color($user['ability_1_quality']).'">Ярость титана</font>';
    }elseif($a_3){
        $user_udar=round(rand($user['str']*0.9,$user['str'])*(1+$a_3_bonus/100));
        $skill = ' <font color="'.quality_color($user['ability_3_quality']).'">Крит</font><br>Вы применили <img src="/images/campaign/'.$user['ability_3_quality'].'.png"> <font color="'.quality_color($user['ability_3_quality']).'">Вихрь критов</font>';
    }else{
        $user_udar=round(rand($user['str']*0.9,$user['str']));
        $skill = FALSE;
    }
    
    if($camp['stone_stat']=='1'){
        $user_udar=round($user_udar*1.35);
    }
    
    mysql_query("UPDATE `campaign` SET `boss_hp`=`boss_hp`-'".$user_udar."', `udar`=`udar`-'1' WHERE `id_user`='".$user['id']."' LIMIT 1");
    $camp=mysql_fetch_assoc(mysql_query("SELECT * FROM `campaign` WHERE `id_user`='".$user['id']."' LIMIT 1"));
    if($camp['boss_hp']<=0){
        mysql_query("UPDATE `campaign` SET `boss_hp`='0', `boss_stat`='4' WHERE `id_user`='".$user['id']."' LIMIT 1");
        $log='Вы ударили <img src="/images/campaign/bot.png" alt="Босс"> '.$camp_boss['name'].' на '.$user_udar.''.$skill.'';
        $kill_boss_log='<img src="/images/campaign/rip.png" alt="Труп"> Вы убили <img src="/images/campaign/bot.png" alt="Босс"> '.$camp_boss['name'].'';
    mysql_query("INSERT INTO `campaign_log` SET `id_user`='".$user['id']."', `text`='".$log."'");
    mysql_query("INSERT INTO `campaign_log` SET `id_user`='".$user['id']."', `text`='".$kill_boss_log."'");
    }else{
        if($camp['udar']>0){
        $boss_hp_1=$camp['boss']*660;
        $boss_hp_2=$camp['boss']*330;
        if($camp['boss_hp']<$boss_hp_1){
            mysql_query("UPDATE `campaign` SET `boss_stat`='2' WHERE `id_user`='".$user['id']."' LIMIT 1");
        }
        if($camp['boss_hp']<$boss_hp_2){
            mysql_query("UPDATE `campaign` SET `boss_stat`='3' WHERE `id_user`='".$user['id']."' LIMIT 1");
        }
        $log='Вы ударили <img src="/images/campaign/bot.png" alt="Босс"> '.$camp_boss['name'].' на '.$user_udar.''.$skill.'';
        mysql_query("INSERT INTO `campaign_log` SET `id_user`='".$user['id']."', `text`='".$log."'");
        }else{
            mysql_query("UPDATE `campaign` SET `status`='3', `udar`='9' WHERE `id_user`='".$user['id']."' LIMIT 1");
            mysql_query("UPDATE `users` SET `exp`=`exp`+'".($camp['boss']*10)."' WHERE `id`='".$user['id']."' LIMIT 1");
        }
    }
    if($a_2){
        $boss_udar=round(rand($camp['agi'],$camp['def'])*(1-$a_2_bonus/100));
        $skill = '<br>Вы применили <img src="/images/campaign/'.$user['ability_1_quality'].'.png"> <font color="'.quality_color($user['ability_1_quality']).'">Крепкая броня</font>';
    }elseif($a_4){
        $boss_udar=round(rand($camp['agi'],$camp['def'])*(1-$a_4_bonus/100));
        $skill = '<br>Вы применили <img src="/images/campaign/'.$user['ability_4_quality'].'.png"> <font color="'.quality_color($user['ability_4_quality']).'">Защитная стойка</font>';
    }else{
        $boss_udar=rand($camp['agi'],$camp['def']);
        $skill = FALSE;
    }
    
    if($camp['grass_stat']=='1'){
        $boss_udar=round($boss_udar*0.65);
    }
    
    mysql_query("UPDATE `campaign` SET `user_hp`=`user_hp`-'".$boss_udar."' WHERE `id_user`='".$user['id']."' LIMIT 1");
    $camp=mysql_fetch_assoc(mysql_query("SELECT * FROM `campaign` WHERE `id_user`='".$user['id']."' LIMIT 1"));
    if($camp['boss_stat']!=4){
    if($camp['user_hp']<=0){
        mysql_query("UPDATE `campaign` SET `user_hp`='0' WHERE `id_user`='".$user['id']."' LIMIT 1");
        $boss_log='<img src="/images/campaign/bot.png" alt="Босс"><span class="dred"> '.$camp_boss['name'].' ударил Вас на '.$boss_udar.'</span>'.$skill.'';
        $kill_user_boss_log='<img src="/images/campaign/rip.png" alt="Труп"> <img src="/images/campaign/bot.png" alt="Босс"><span class="dred"> '.$camp_boss['name'].' убил Вас</span>';
        mysql_query("INSERT INTO `campaign_log` SET `id_user`='".$user['id']."', `text`='".$boss_log."'");
        mysql_query("INSERT INTO `campaign_log` SET `id_user`='".$user['id']."', `text`='".$kill_user_boss_log."'");
    }else{
        $boss_log='<img src="/images/campaign/bot.png" alt="Босс"><span class="dred"> '.$camp_boss['name'].' ударил Вас на '.$boss_udar.'</span>'.$skill.'';
        mysql_query("INSERT INTO `campaign_log` SET `id_user`='".$user['id']."', `text`='".$boss_log."'");
    }
    }

    header('Location: /campaign');
    exit();
}

        if($camp['boss_hp']=='0' OR $camp['user_hp']=='0'){
            include_once'./system/h.php';
        }else{
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <link rel='shortcut icon' href='/favicon.ico'/>
    <meta name="viewport" content="width=device-width; minimum-scale=1; maximum-scale=1">
    <link rel='stylesheet' href='/style.css'/>
</head>
<body>
    <div class='main' style='word-wrap:break-word;'>
    <span style='text-shadow:none;'></span>
        <div class='head cntr' style='position:relative;'>
            <span>
                <img src='/images/icon/health.png' alt='hp'>
                <span class='white'>
                <?=$camp['user_hp']?>
                </span>
            </span>
            <span name='timer' style='position:absolute; right:4px;'>
                <?=_time($camp['time']-time())?>
            </span>
            <div class='clr'></div>
        </div>
        <div class='exp_bar'>
            <div class='progress_life' style='width:<?=$user_hp?>%'>
            </div>
        </div><?
             }
        ?><div class="main">
        <div class='center'>
            <div class='block_zero'>
                <div style='max-width:360px;display:inline-block;'>
                    <a href='/campaign/fight/attack'>
                        <img src='/images/campaign/boss/<?=$camp['boss']?>/<?=$camp['boss_stat']?>.jpg' alt='*' width='100%'>
                    </a>
                </div>
                <br>
                Цель:
                <img src='/images/icon/race/bot.png' alt='*'>
                <b><?=$camp_boss['name']?></b>
                <img src='/images/icon/health.png' alt='hp'>
                <?=$camp['boss_hp']?>
                <br>
                <div class='life_bar'>
                    <div class='life_bar-green fl' style='width:<?=$green?>%'></div>
                </div>
                <div style='clear:both;'></div>
            </div>
            <div class='mini-line'></div>
            <div class='block_zero'>
                <div class='mb5'><?
            if($camp['boss_stat']==4){
                ?><a class='btn' href='/campaign/fight/win'>
                        <span class='end'>
                            <span class='label'>
                                <span class="dgreen">
                                    Получить награду
                                </span>
                            </span>
                        </span>
                    </a><?
            }elseif($camp['user_hp']=='0'){
                ?><img src='/images/campaign/rip.png' alt='*'>
                    <span class="grey">
                        Вы были убиты во время боя
                    </span>
                    <br>
                    <a class='btn' href='/campaign/fight/lose'>
                        <span class='end'>
                            <span class='label'>
                                Закончить бой
                            </span>
                        </span>
                    </a><?
            }else{
                    ?><a class='btn' href='/campaign/fight/attack'>
                        <span class='end'>
                            <span class='label'>
                                Атаковать монстра
                            </span>
                        </span>
                    </a>
                </div>
                <div class='separ'></div>
                <table border='0' cellpadding='0' cellspacing='0' align='center'>
                    <tr>
                        <td style='border-right:1px solid #3e3d36;padding:0px 10px;'><?
            if($camp['stone_stat']=='0' AND $camp['stone']>0){
                            ?><a class='btn' href='/campaign/fight/stone'>
                                <span class='end'>
                                    <span class='label'>
                                        <img src='/images/icon/stone.png' alt='*'>
                                        Камень
                                    </span>
                                </span>
                            </a>
                            <br>
                            <span class='medium'>
                                +35% урон
                            </span><?
            }elseif($camp['stone_stat']=='1'){
                ?><a class='btn' href=''>
                                <span class='end'>
                                    <span class='label'>
                                        <span class='grey'>
                                            <img src='/images/icon/stone.png' alt='*'>
                                            Камень
                                        </span>
                                    </span>
                                </span>
                            </a>
                            <br>
                            <span class='small dgreen'>
                                Активно
                            </span><?
            }else{
                ?><a class='btn' href=''>
                                <span class='end'>
                                    <span class='label'>
                                        <span class='grey'>
                                            <img src='/images/icon/stone.png' alt='*'>
                                            Камень
                                        </span>
                                    </span>
                                </span>
                            </a>
                            <br>
                            <span class='medium grey'>
                                0 штук
                            </span><?
            }
                        ?></td>
                        <td style='border-left:1px solid #1f1f1a;padding:0px 0px 0px 10px;'><?
            if($camp['grass_stat']=='0' AND $camp['grass']>0){
                            ?><a class='btn' href='/campaign/fight/grass'>
                                <span class='end'>
                                    <span class='label'>
                                        <img src='/images/icon/grass.png' alt='*'>
                                        Трава
                                    </span>
                                </span>
                            </a>
                            <br>
                            <span class='medium'>
                                -35% урон
                            </span><?
            }elseif($camp['grass_stat']=='1'){
                ?><a class='btn' href=''>
                                <span class='end'>
                                    <span class='label'>
                                        <span class='grey'>
                                            <img src='/images/icon/grass.png' alt='*'>
                                            Трава
                                        </span>
                                    </span>
                                </span>
                            </a>
                            <br>
                            <span class='small dgreen'>
                                Активно
                            </span><?
            }else{
                ?><a class='btn' href=''>
                                <span class='end'>
                                    <span class='label'>
                                        <span class='grey'>
                                            <img src='/images/icon/grass.png' alt='*'>
                                            Трава
                                        </span>
                                    </span>
                                </span>
                            </a>
                            <br>
                            <span class='medium grey'>
                                0 штук
                            </span><?
            }
                        ?></td>
                    </tr>
                </table><?
            }
            ?></div>
        </div>
    </div>
        <div class="main">
        </div><?
            $data_log_open=mysql_fetch_assoc(mysql_query("SELECT * FROM `campaign_log` WHERE `id_user`='".$user['id']."' LIMIT 1"));
        if($data_log_open){
        ?><div class='mini-line'></div>
    <div class="main">
        <div class="block_zero"><?
        }
            $data_log=mysql_query("SELECT `text` FROM `campaign_log` WHERE `id_user`='".$user['id']."' ORDER BY(`id`) DESC LIMIT 16");
        while($camp_log=mysql_fetch_assoc($data_log)){
            ?><?=$camp_log['text']?><br><?
        }
            ?></div>
        <div class="main">
            <div class="mini-line"></div>
            <div class='block_zero center'>
            <img src='/images/icon/2hit.png' alt='*'>
            Осталось <?=$camp['udar']?> ходов
        </div><?
                if($camp['boss_hp']=='0' OR $camp['user_hp']=='0'){
            ?></div></div></div><?
                    include_once('/system/f.php');
                }else{
        ?><div class='line'></div>
        <div class='foot'>
            <div>
                <img src='/images/icon/race/1.png' alt='Борея'>
                <?=$user['login']?>
            </div>
            <div class='center'>
                <img src='/images/icon/level.png' alt='lvl'>
                <?=$user['level']?>
                |
                <img src='/images/icon/silver.png' alt='g'>
                <?=n_f($user['s'])?>
                |
                <img src='/images/icon/gold.png' alt='s'>
                <?=n_f($user['g'])?>
            </div>
        </div>
    </div>
    </div>
    </div>
    <span style='text-shadow:none;'></span>
    <div class='block_zero center'>
        <a class='grey' href='/campaign/fight/exit'>
            Покинуть бой
        </a>
    </div>
    </div>
</body>
</html>
<?
                }
        
break;
        
case 'exit':
        if(isset($_GET['exit'])){
            header('Location: /');
            exit();
        }
?><div class='main'>
<div class='block_zero center'>
    Ваш персонаж сейчас находится в бою, хотите туда вернуться?
    <div class='mb5'></div>
    <div class='center'>
        <a class='btn' href='/campaign'>
            <span class='end'>
                <span class='label'>
                    <span class='dgreen'>
                        <img src='/images/icon/2hit.png' alt='*'>
                        Вернуться в бой!
                    </span>
                </span>
            </span>
        </a>
        <div class='mb10'>
        </div>
        <a class='grey' href='/campaign/exit/exit'>
            выйти из боя
        </a>
    </div>
</div>
</div><?
break;
        
case 'lose':
        if(isset($_GET['end'])){
            mysql_query("UPDATE `campaign` SET `status`='0' WHERE `id_user`='".$user['id']."' LIMIT 1");
            header('Location: /campaign');
            exit();
        }
?><div class='center'>
    <div class='block_light'><?
        if($camp['boss_hp']=='0'){
            ?><h2 class='dgreen' style='font-weight:bold;'><img src='/images/icon/2hit.png' alt=''/>
            Победа
            <img src='/images/icon/2hit.png' alt='*'><?
        }else{
            ?><h2 class='dred' style='font-weight:bold;'><img src='/images/icon/2hit.png' alt=''/>
            Поражение
            <img src='/images/icon/2hit.png' alt='*'><?
        }
        ?></h2>
        <div class='separ'></div>
        <span class='blue'>
            Награда:
        </span><?
        if($camp['boss_hp']=='0'){
        ?><img src='/images/icon/gold.png' alt='*'>
        <?=$camp['boss']?> золота<?
        }else{
             ?><img src='/images/icon/exp.png' alt='*'>
        <?=($camp['boss']*10)?>
        опыта<?
        }
        ?><span class='medium'>
        </span>
        <div class='separ'></div>
        <div style='max-width:360px;display:inline-block;'>
            <a href='/campaign/end/54905963'>
                <img src='/images/campaign/boss/<?=$camp['boss']?>/<?=$camp['boss_stat']?>.jpg?v=1' alt='*' width='100%'>
            </a>
        </div>
        <br>
        <div class='life_bar'>
            <div class='life_bar-green fl' style='width:<?=$green?>%'></div>
        </div>
        <div style='clear:both;'></div>
        <div class='separ'></div>
        <a class='btn' href='/campaign/lose/end/'>
            <span class='end'>
                <span class='label'>
                    Вернуться в поход
                </span>
            </span>
        </a>
    </div>
</div>
</div><?
break;
        


}
if($_GET['action']!='fight'){
    include_once './system/f.php';
}
?>