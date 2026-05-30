<?
define('PROTECTOR', 1);

$headmod = 'train';//фикс. места

$textl='Таверна';
include('files/path.php');
include('files/db.php');
include('files/auth.php');
include('files/func.php');
include('files/core.php');
include('files/head.php');
include('files/zag.php');

    
if(!$user) {

  header('location: /');
    
exit;

}
    
    $title = 'Тренировка';



    function cost($i) {
        
        switch($i) {
          case 0:
           $cost = 200;
           break;
        
          case 1:
           $cost = 400;
           break;
        
          case 2:
           $cost = 600;
           break;
          
          case 3:
           $cost = 800;
           break;

          case 4:
           $cost = 1000;
           break;   
           
          case 5:
           $cost = 1;
           break;        

          case 6:
           $cost = 1600;
           break;   

          case 7:
           $cost = 3200;
           break;

          case 8:
           $cost = 4800;
           break;   
           
          case 9:
           $cost = 6400;
           break;   

          case 10:
           $cost = 8000;
           break;   

          case 11:
           $cost = 10;
           break;   

          case 12:
           $cost = 2400;
           break;   

          case 13:
           $cost = 4800;
           break;   

          case 14:
           $cost = 7200;
           break;   

          case 15:
           $cost = 9600;
           break;   

          case 16:
           $cost = 12000;
           break;   

          case 17:
           $cost = 20;
           break;   

          case 18:
           $cost = 3200;
           break;   

          case 19:
           $cost = 7200;
           break;   

          case 20:
           $cost = 10800;
           break;   

          case 21:
           $cost = 14400;
           break;   

          case 22:
           $cost = 18000;
           break;   

          case 23:
           $cost = 40;
           break;   

          case 24:
           $cost = 3600;
           break;   

          case 25:
           $cost = 7200;
           break;   

          case 26:
           $cost = 10800;
           break;   

          case 27:
           $cost = 14400;
           break;   

          case 28:
           $cost = 18000;
           break;   

          case 29:
           $cost = 80;
           break;   

          case 30:
           $cost = 4800;
           break;   

          case 31:
           $cost = 9600;
           break;   

          case 32:
           $cost = 14400;
           break;   

          case 33:
           $cost = 19200;
           break;   

          case 34:
           $cost = 24000;
           break;   

          case 35:
           $cost = 160;
           break;   

          case 36:
           $cost = 5600;
           break;   

          case 37:
           $cost = 11200;
           break;   

          case 38:
           $cost = 16800;
           break;   

          case 39:
           $cost = 22400;
           break;   

          case 40:
           $cost = 28000;
           break;   

          case 41:
           $cost = 320;
           break;   

          case 42:
           $cost = 6400;
           break;   

          case 43:
           $cost = 12800;
           break;   

          case 44:
           $cost = 19200;
           break;   

          case 45:
           $cost = 25600;
           break;   

          case 46:
           $cost = 32000;
           break;   

          case 47:
           $cost = 640;
           break;   

          case 48:
           $cost = 7200;
           break;   

          case 49:
           $cost = 14400;
           break;   

          case 50:
           $cost = 21600;
           break;   

          case 51:
           $cost = 28800;
           break;   

          case 52:
           $cost = 36000;
           break;   

          case 53:
           $cost = 1280;
           break;   

          case 54:
           $cost = 5000;
           break;   

          case 55:
           $cost = 16000;
           break;   

          case 56:
           $cost = 24000;
           break;   

          case 57:
           $cost = 32000;
           break;   

          case 58:
           $cost = 40000;
           break;   

          case 59:
           $cost = 2560;
           break;   

        }
        
    return $cost;
    
    }

    function value($i) {
        
        switch($i) {
          case 0:
           $value = 'money';
           break;
        
          case 1:
           $value = 'money';
           break;
        
          case 2:
           $value = 'money';
           break;
          
          case 3:
           $value = 'money';
           break;

          case 4:
           $value = 'money';
           break;        

          case 5:
           $value = 'money';
           break;        

          case 6:
           $value = 'money';
           break;        

          case 7:
           $value = 'money';
           break;        

          case 8:
           $value = 'money';
           break;        

          case 9:
           $value = 'money';
           break;        

          case 10:
           $value = 'money';
           break;        

          case 11:
           $value = 'money';
           break;        

          case 12:
           $value = 'money';
           break;        

          case 13:
           $value = 'money';
           break;        

          case 14:
           $value = 'money';
           break;        

          case 15:
           $value = 'money';
           break;        

          case 16:
           $value = 'money';
           break;        

          case 17:
           $value = 'money';
           break;        

          case 18:
           $value = 'money';
           break;        
        
          case 19:
           $value = 'money';
           break;        

          case 20:
           $value = 'money';
           break;        
          
          case 21:
           $value = 'money';
           break;        
          
          case 22:
           $value = 'money';
           break;     
              
          case 23:
           $value = 'money';
           break;        

          case 24:
           $value = 'money';
           break;     

          case 25:
           $value = 'money';
           break;     

          case 26:
           $value = 'money';
           break;     

          case 27:
           $value = 'money';
           break;     

          case 28:
           $value = 'money';
           break;     

          case 29:
           $value = 'money';
           break;     

          case 30:
           $value = 'money';
           break;     

          case 31:
           $value = 'money';
           break;     

          case 32:
           $value = 'money';
           break;     

          case 33:
           $value = 'money';
           break;     

          case 34:
           $value = 'money';
           break;     

          case 35:
           $value = 'money';
           break;     

          case 36:
           $value = 'money';
           break;     

          case 37:
           $value = 'money';
           break;     

          case 38:
           $value = 'money';
           break;     

          case 39:
           $value = 'money';
           break;     

          case 40:
           $value = 'money';
           break;     

          case 41:
           $value = 'money';
           break;     

          case 42:
           $value = 'money';
           break;     

          case 43:
           $value = 'money';
           break;     

          case 44:
           $value = 'money';
           break;     

          case 45:
           $value = 'money';
           break;     

          case 46:
           $value = 'money';
           break;     

          case 47:
           $value = 'money';
           break;     

          case 48:
           $value = 'money';
           break;     

          case 49:
           $value = 'money';
           break;     

          case 50:
           $value = 'money';
           break;     

          case 51:
           $value = 'money';
           break;     

          case 52:
           $value = 'money';
           break;     

          case 53:
           $value = 'money';
           break;     

          case 54:
           $value = 'money';
           break;     

          case 55:
           $value = 'money';
           break;     

          case 56:
           $value = 'money';
           break;     

          case 57:
           $value = 'money';
           break;     

          case 58:
           $value = 'money';
           break;     

          case 59:
           $value = 'money';
           break;     

        }
    
    return $value;
    
    }

if(isset($_GET['sila'])) {

if($user['_sila'] < 61) {

    if(value($user['_sila']) == 'money') {

      if($user['money'] < cost($user['_sila'])) {
      
        
      
      }
      else
      {
      
          mysql_query('UPDATE `users` SET `sila` =   `sila` + 1,
                                         `_sila` =  `_sila` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `money` = `money` - '.cost($user['_sila']).' WHERE `id` = "'.$user['id'].'"');
      
      }

    }
    else
    if(value($user['_sila'] == 'money')) {
      
      if($user['money'] < cost($user['_sila'])) {
      
        
      
      }
      else
      {
      

          mysql_query('UPDATE `users` SET `sila` =   `sila` + 1,
                                         `_sila` =  `_sila` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `money` = `money` - '.cost($user['_sila']).' WHERE `id` = "'.$user['id'].'"');
      
      }    
    
    }

}    
    header('location: /train.php');

}

if(isset($_GET['lovk'])) {

if($user['_lovk'] < 61) {

    if(value($user['_lovk']) == 'money') {

      if($user['money'] < cost($user['_lovk'])) {
      
        
      
      }
      else
      {
      
          mysql_query('UPDATE `users` SET `lovk` =   `lovk` + 1,
                                         `_lovk` =  `_lovk` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `money` = `money` - '.cost($user['_lovk']).' WHERE `id` = "'.$user['id'].'"');
      
      }

    }
    else
    if(value($user['_lovk'] == 'money')) {
      
      if($user['money'] < cost($user['_lovk'])) {
      
        
      
      }
      else
      {
      

          mysql_query('UPDATE `users` SET `lovk` =   `lovk` + 1,
                                         `_lovk` =  `_lovk` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `money` = `money` - '.cost($user['_lovk']).' WHERE `id` = "'.$user['id'].'"');
      
      }    
    
    }

}    
    header('location: /train.php');

}

if(isset($_GET['prot'])) {

if($user['_prot'] < 61) {

    if(value($user['_prot']) == 'money') {

      if($user['money'] < cost($user['_prot'])) {
      
        
      
      }
      else
      {
      
          mysql_query('UPDATE `users` SET `prot` =   `prot` + 1,
                                         `_prot` =  `_prot` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `money` = `money` - '.cost($user['_prot']).' WHERE `id` = "'.$user['id'].'"');
      
      }

    }
    else
    if(value($user['_prot'] == 'money')) {
      
      if($user['money'] < cost($user['_prot'])) {
      
        
      
      }
      else
      {
      

          mysql_query('UPDATE `users` SET `prot` =   `prot` + 1,
                                         `_prot` =  `_prot` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `money` = `money` - '.cost($user['_prot']).' WHERE `id` = "'.$user['id'].'"');
      
      }    
    
    }

}    
    header('location: /train.php');

}

if(isset($_GET['hpall'])) {

if($user['_hpall'] < 61) {

    if(value($user['_hpall']) == 'money') {

      if($user['money'] < cost($user['_hpall'])) {
      
        
      
      }
      else
      {
      
          mysql_query('UPDATE `users` SET `hpall` =   `hpall` + 1,
                                         `_hpall` =  `_hpall` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `money` = `money` - '.cost($user['_hpall']).' WHERE `id` = "'.$user['id'].'"');
      
      }

    }
    else
    if(value($user['_hpall'] == 'money')) {
      
      if($user['money'] < cost($user['_hpall'])) {
      
        
      
      }
      else
      {
      

          mysql_query('UPDATE `users` SET `hpall` =   `hpall` + 1,
                                         `_hpall` =  `_hpall` + 1,
                                        `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

            mysql_query('UPDATE `users` SET `money` = `money` - '.cost($user['_hpall']).' WHERE `id` = "'.$user['id'].'"');
      
      }    
    
    }

}    
    header('location: /train.php');

}

if(isset($_GET['mpall'])) {

if($user['_mpall'] < 61) {

    if(value($user['_mpall']) == 'money') {

      if($user['money'] < cost($user['_mpall'])) {
      
        
      
      }
      else
      {
      
          mysql_query('UPDATE `users` SET `mpall` =  `mpall` + 5,
                                         `_mpall` = `_mpall` + 1,
                                         `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

      mysql_query('UPDATE `users` SET `money` = `money` - '.cost($user['_mpall']).' WHERE `id` = "'.$user['id'].'"');
      
      }

    }
    else
    if(value($user['_mpall'] == 'money')) {
      
      if($user['money'] < cost($user['_mpall'])) {
      
        
      
      }
      else
      {
      

          mysql_query('UPDATE `users` SET `mpall` =  `mpall` + 5,
                                         `_mpall` = `_mpall` + 1,
                                         `skill` = `skill` + 1 WHERE `id` = "'.$user['id'].'"');

      mysql_query('UPDATE `users` SET `money` = `money` - '.cost($user['_mpall']).' WHERE `id` = "'.$user['id'].'"');
      
      }    
    
    }

}    
    header('location: /train.php');

}

?>
<div class="block_zero">
<div class='block_zero center blue'>Улучшай параметры своего героя!</div><div class='mini-line'></div><div class='center'><div class='block_zero'><img src='http://tiwar.ru/images/town/hd/train.jpg' width='100%' alt=''/></div></div><div class='mini-line'></div>

<img src='/images/icon/sila.png' alt='*'/> Сила: <?=$user['sila']?> <font color='#999'>(урон <?=round($user['sila']/6)?> -  <?=round($user['sila']/4)?>)</font><br/>
<small>+<?=$user['_sila']?> к мастерству</small>

<?

  $_sila_progress = round(100 / (60 / $user['_sila']));

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px;'>
<div style='background: #fc3; height: 4px; width: <?=$_sila_progress?>%;'></div>
</div><small>Чем больше сила, тем больше урона нанесёшь врагу!
</small>
<?

  if($user['_sila'] < 60) {

?>
<br/><br/>
<div align='center'>
<a class='btn' href='?sila'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($user['_sila']) == 'money' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['_sila'])?></span></span></a>
</div>

<?

  }

?>

</div>
 <div class='mini-line'></div>

<div class='block_zero'>

<img src='/images/icon/lovk.png' alt='*'/> Жизнь: <?=$user['lovk']?> <font color='#999'>(<?=($user['lovk']*2)?>)</font><br/>
<small>+<?=$user['_lovk']?> к мастерству</small>

<?

  $_lovk_progress = round(100 / (60 / $user['_lovk']));

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px;'>
<div style='background: #fc3; height: 4px; width: <?=$_lovk_progress?>%;'></div>
</div><small>Здоровья много не бывает
</small>

<?

  if($user['_lovk'] < 60) {

?>
<br/><br/>
<div align='center'>
<a class='btn' href='?lovk'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($user['_lovk']) == 'money' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['_lovk'])?></span></span></a>
</div>

<?

  }

?>


</div>
 <div class='mini-line'></div>

<div class='block_zero'>

<img src='/images/icon/prot.png' alt='*'/> Удача: <?=$user['prot']?> <font color='#999'>(<?=$user['prot']/100?> % крит/уклонение)</font><br/>
<small>+<?=$user['_prot']?> к мастерству</small>

<?

  $_prot_progress = round(100 / (60 / $user['_prot']));

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px;'>
<div style='background: #fc3; height: 4px; width: <?=$_prot_progress?>%;'></div>
</div><small>Увеличивает шанс на уворот и крит.удар
</small>

<?

  if($user['_prot'] < 60) {

?>
<br/><br/>
<div align='center'>
<a class='btn' href='?prot'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($user['_prot']) == 'money' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['_prot'])?></span></span></a>
</div>

<?

  }

?>

</div>
 <div class='mini-line'></div>


<div class='block_zero'>

<img src='/images/icon/hpall.png' alt='*'/> Защита: <?=$user['hpall']?> <font color='#999'>(поглощение урона <?=round($user['hpall']/12)?> - <?=round($user['hpall']/7)?>)</font><br/>
<small>+<?=$user['_hpall']?> к мастерству</small>

<?

  $_hpall_progress = round(100 / (60 / $user['_hpall']));

?>

<div style='border:1px solid #000; background: #ffffff; height: 4px;'>
<div style='background: #fc3; height: 4px; width: <?=$_hpall_progress?>%;'></div>
</div><small>Поглощает урон врага
</small>

<?

  if($user['_hpall'] < 60) {

?>
<br/><br/>
<div align='center'>
<a class='btn' href='?hpall'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($user['_hpall']) == 'money' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['_hpall'])?></span></span></a>
</div>

<?

  }

?>


</div>
 <div class='mini-line'></div>


<div class='block_zero'>

<img src='/images/icon/mpall.png' alt='*'/> Мана:  <?=$user['mpall']?><br/>
<small>+<?=$user['_mpall']?> к мастерству</small>

<?

  $_mpall_progress = round(100 / (60 / $user['_mpall']));

?>
<div style='border:1px solid #000; background: #ffffff; height: 4px;'>
<div style='background: #fc3; height: 4px; width: <?=$_mpall_progress?>%;'></div>
</div><small>Увеличивает запас маны
</small><br/>

<?

  if($user['_mpall'] < 60) {

?>
<div align='center'>
<a class='btn' href='?mpall'><span class='end'><span class='label'>Улучшить за <img src='/images/icon/<?=(value($user['_mpall']) == 'money' ? 'gold':'silver')?>.png' alt='*'/> <?=cost($user['_mpall'])?></span></span></a>
</div>

<?

  }

?>

</div>
 <div class='mini-line'></div>


<div class="block_zero">
<img src='/images/icon/skill.png' alt='*'/> Мастерство: <?=$user['skill']?>
<ul class='hint'><li>Прокачивая параметры, вы увеличиваете мастерство</li><li>Чем выше мастерство, тем более крутые вещи доступны в <img src='/images/icon/equip.png' alt=''/> <a href='/shop/'>Магазине снаряжения</a></li><li>Чем выше мастерство, тем больше параметров дают <img src='http://tiwar.ru/images/icon/potion.png' alt=''/> <a href='/lab/alchemy'>Эликсиры</a></li></ul>
</div>

<?
  
include './system/f.php';

?>