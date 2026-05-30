<?
# All author: XxxDIABLOxxX
# Pabl modules
# cave.php
   
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Пещера';    

include './system/h.php';

    $sack = mysql_query('SELECT * FROM `sack` WHERE `user` = "'.$user['id'].'"');      
    $sack = mysql_fetch_array($sack);

if(!$sack) {

  mysql_query('INSERT INTO `sack` (`user`) VALUES ("'.$user['id'].'")');

}


  $cave = mysql_query('SELECT * FROM `cave` WHERE `user` = "'.$user['id'].'"');
  $cave = mysql_fetch_array($cave);

       $res_1 = rand(1,9);
$res_1_chanse = rand(0,25);
  
       $res_2 = rand(1,9);
$res_2_chanse = rand(0,25);

       $res_3 = rand(1,9);
$res_3_chanse = rand(0,25);

  if($cave['dawn'] == 1 && $cave['gather'] == 0 && $cave['time'] <= time()) {

  if(!$cave['res_1'] && !$cave['res_2'] && !$cave['res_3']) {
  
    mysql_query('UPDATE `cave` SET `res_1` = "'.$res_1.'",
                            `res_1_chanse` = "'.$res_1_chanse.'",
                                   `res_2` = "'.$res_2.'",
                            `res_2_chanse` = "'.$res_2.'",
                                   `res_3` = "'.$res_3.'",
                            `res_3_chanse` = "'.$res_3_chanse.'" WHERE `user` = "'.$user['id'].'"');
  
  }
  
  }


  $cave = mysql_query('SELECT * FROM `cave` WHERE `user` = "'.$user['id'].'"');
  $cave = mysql_fetch_array($cave);

  if(!$cave) {
  
    mysql_query('INSERT INTO `cave` (`user`) VALUES ("'.$user['id'].'")');
  
  }

   function res($i) {
  
    switch($i) {
    case 1:
    $name = 'Алмаз';
     break;
    case 2:
    $name = 'Корунд';
     break;
    case 3:
    $name = 'Обсидиан';
     break;
    case 4:
    $name = 'Графит';
     break;
    case 5:
    $name = 'Оникс';
     break;
    case 6:
    $name = 'Амброзия';
     break;
    case 7:
    $name = 'Мята';
     break;
    case 8:
    $name = 'Аир';
     break;
    case 9:
    $name = 'Рябина';
     break;
  }

    return $name;
  
  }

  
?>

<div class='title'><?=$title?></div>
 <div class='line'></div>

<?

  if($cave['dawn'] == 1 && $cave['time'] <= time()) {
  
if($cave['gather'] == 0) {

?>

<div class='content' align='center'><font color='#90b0c0'>Осмотр пещеры завершен<br/>
  Вы нашли место с ресурсами:</font>
</div>
 <div class='line'></div>
<div class='content'>

  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_1']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_1'])?><br/><small>
  Шанс добыть: <?=$cave['res_1_chanse']?>%
  </small></td></tr></table><br/>

  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_2']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_2'])?><br/><small>
  Шанс добыть: <?=$cave['res_2_chanse']?>%
  </small></td></tr></table><br/>

  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_3']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_3'])?><br/><small>
  Шанс добыть: <?=$cave['res_3_chanse']?>%
  </small></td></tr></table>

</div>
<div class='line'></div>
<div class='content' align='center'>
<a href='/cave/?gather=true' class='button'>Начать добычу</a><br/><br/>
  <a href='/cave/?dawn=true'><font color='#909090'>Новый поиск</font></a>
</div>

<?

if($_GET['gather'] == true) {

               if($premium) {

$time-= round( $time / 100 ) * 10;
    
             }
			 
# profesion
if ($profesion['prof_cave']==1){
$time = (100 * 10);
}else{
$time = (100 * 15);
}

    
    mysql_query('UPDATE `cave` SET `gather` = "1",
                                     `time` = "'.(time() + $time).'" WHERE `user` = "'.$user['id'].'"');
  
  header('location: /cave/');
  
  }


if($_GET['dawn'] == true) {
  
             if($premium) {

$time-= round( $time / 100 ) * 10;
    }

# profesion
if ($profesion['prof_cave']==1){
$time = (100 * 10);
}else{
$time = (100 * 15);
}


    mysql_query('UPDATE `cave` SET `dawn` = "1",
                                   `time` = "'.(time() + $time).'",
                                   `res_1`= "0",
                                   `res_2`= "0",
                                   `res_3`= "0"  WHERE `user` = "'.$user['id'].'"');
  
  header('location: /cave/');
  
  }


  }
  else
  {

?>

<div class='content' align='center'><font color='#90b0c0'>Работа завершена<br/>
Вы пытались добыть следующие ресурсы:</font>
</div>
 <div class='line'></div>

<?
  
  $res_1 = rand(0,100);
  $res_2 = rand(0,100);
  $res_2 = rand(0,100);
  
?>

<div class='content'>

  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_1']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_1'])?><br/><small>
  <?=($res_1 <= $cave['res_1_chanse'] ? '<font color=\'#30c030\'>Ресурс добыт!</font>':'<font color=\'#c06060\'>Ресурс не добыт!</font>')?>
  </small></td></tr></table><br/>

  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_2']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_2'])?><br/><small>
  <?=($res_2 <= $cave['res_2_chanse'] ? '<font color=\'#30c030\'>Ресурс добыт!</font>':'<font color=\'#c06060\'>Ресурс не добыт!</font>')?>
  </small></td></tr></table><br/>


  <table cellpadding='0' cellspacing='0'>
<tr>
  

  <td><img src='/images/res/<?=$cave['res_3']?>.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'><?=res($cave['res_3'])?><br/><small>
  <?=($res_3 <= $cave['res_3_chanse'] ? '<font color=\'#30c030\'>Ресурс добыт!</font>':'<font color=\'#c06060\'>Ресурс не добыт!</font>')?>
  </small></td></tr></table>

</div></div><div class='line'></div>
<div class='content' align='center'>
<a href='/cave/' class='button'>Обновить</a>
</div>
<?
  
  if($res_1 <= $cave['res_1_chanse']) {

    mysql_query('UPDATE `sack` SET `'.$cave['res_1'].'` = `'.$cave['res_1'].'` + 1 WHERE `user` = "'.$user['id'].'"');  
  
  }

  if($res_2 <= $cave['res_2_chanse']) {

    mysql_query('UPDATE `sack` SET `'.$cave['res_2'].'` = `'.$cave['res_2'].'` + 1 WHERE `user` = "'.$user['id'].'"');  
  
  }

  if($res_3 <= $cave['res_3_chanse']) {

    mysql_query('UPDATE `sack` SET `'.$cave['res_3'].'` = `'.$cave['res_3'].'` + 1 WHERE `user` = "'.$user['id'].'"');  
  
  }

// Place
    // 5 - Пещера
    // Type
    // 0 - Спуститься в пещеру
    // 1 - Найти n-е кол-во ресурсов
    $q = mysql_query ('select * from `user_q` WHERE (`user`="' . $user['id'] . '") AND (`complete`="0")');
    if (mysql_num_rows ($q) != 0) {
        
        while ($user_q = mysql_fetch_array ($q)) {
                
            // 
            $q_ = mysql_query ('SELECT * FROM `quest` WHERE (`id`="' . $user_q['q'] . '")');
            $quest = mysql_fetch_array ($q_);
            
            
            if ($quest['place']=='5') {
            
            
                if ($quest['type']=='1') {
                    if ($c>= $quest['c']) {
                        mysql_query ('UPDATE `user_q` SET `c`=`c`+1 WHERE (`user`="' . $user['id'] . '") AND (`q`="' . $quest['id'] . '")');
                    }
                }
            
            
            
            
            }

        }

    }


    mysql_query('UPDATE `cave` SET `dawn` = "0",
                                 `gather` = "0",
                                   `time` = "0",
                                   `res_1`= "0",
                                   `res_2`= "0",
                                   `res_3`= "0"  WHERE `user` = "'.$user['id'].'"');


  }

  }
  else
  {

?>

<div class='content' align='center'><font color='#90b0c0'>В пещере можно найти камни и травы</font></div>
 <div class='line'></div>

<div class='menu'>
  <li align='center'><img src='/images/town/cave.png' alt='*'/></li>
  <li class='no_b' align='center'>

<?

    if($cave['dawn'] == 1) {
    
  if($cave['gather'] == 0) {

if($cave['time'] > time()) {
  
?>

<font color='#90b0c0'>Вы осматриваете пещеру</font><br/>
Осталось: <?=_time($cave['time'] - time())?>

<?
  
  }
  else
  {
  
  
  }
  
  }
  else
  {

?>

<font color='#90b0c0'>Вы занимаетесь добычей ресурсов..</font><br/>
Осталось: <?=_time($cave['time'] - time())?>

<?
  
  }
  
  }
  else
  {
  
if($_GET['dawn'] == true) {

             if($premium) {

$time-= round( $time / 100 ) * 10;
    
             }
# profesion
if ($profesion['prof_cave']==1){
$time = (100 * 10);
}else{
$time = (100 * 15);
}
  
    mysql_query('UPDATE `cave` SET `dawn` = "1",
                                   `time` = "'.(time() + $time).'" WHERE `user` = "'.$user['id'].'"');
  
  header('location: /cave/');
  
  }

?>

  <a href='/cave/?dawn=true' class='button'>Спуститься в пещеру</a>

<?
  
  }

?>

  </li>
</div>

<?
  
  }
    
include './system/f.php';

?>