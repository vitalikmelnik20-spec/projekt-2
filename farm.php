<?
# All author: XxxDIABLOxxX
# Pabl modules
# farm.php
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Поход';    

include './system/h.php';

  $farm = mysql_query('SELECT * FROM `farm` WHERE `user` = "'.$user['id'].'"');  
  $farm = mysql_fetch_array($farm);
  
  if(!$farm) {
  
    mysql_query('INSERT INTO `farm` (`user`) VALUES ("'.$user['id'].'")');
  
  }

?>

<div class='title'><?=$title?></div>
 <div class='line'></div>

<?

if($user['level'] > 2) {


?>

<div class='menu'>
  <li align='center'><img src='/images/town/farm.png' alt='*'/></li>
  <li class='no_b' align='center'>

<?

  if($farm['h'] == 0 && $farm['time'] == 0) {
  
  $h = _string(_num($_POST['h']));
  
    if($h && $user['level'] >= $h * 3) {
    
      $hs = ($h * (60 * 60));
            
      mysql_query('UPDATE `farm` SET `h` = "'.$h.'", `time` = "'.(time() + $hs).'" WHERE `user` = "'.$user['id'].'"');


$q = mysql_query ('select * from `user_q` WHERE (`user`="' . $user['id'] . '") AND (`complete`="0")');
    if (mysql_num_rows ($q) != 0) {
        
        while ($user_q = mysql_fetch_array ($q)) {
                
            // 
            $q_ = mysql_query ('SELECT * FROM `quest` WHERE (`id`="' . $user_q['q'] . '")');
            $quest = mysql_fetch_array ($q_);
            
            if ($user_q['c']<$quest['c']) {
                if ($quest['place']=='4') {
                
                
                    if ($quest['type']=='0') {
                        mysql_query ('UPDATE `user_q` SET `c`=`c`+1 WHERE (`user`="' . $user['id'] . '") AND (`q`="' . $quest['id'] . '")');
                    }
                
                    if ($quest['type']=='1') {
                        
                        if($h >= $quest['c']) {
                            mysql_query ('UPDATE `user_q` SET `c`=`c`+1 WHERE (`user`="' . $user['id'] . '") AND (`q`="' . $quest['id'] . '")');
                        }
                    
                    }
                
                
                
                }
            
            }

        }

    }


    
    header('location: /farm/');
    
    }

?>

<font color='#90b0c0'>В походе ты получиш <img src='/images/icon/silver.png' alt='*'/> серебро. Чем дольше поход, тем больше награда!</font><br/>

<form action='/farm.php' method='post'>
  <select name='h'>

<?

   for($h = 1; $h < 6; $h++) {

if($user['level'] >= $h * 3) {

?>

<option value='<?=$h?>'><?=$h?> час<?=($h == 1 ? '':($h == 5 ? 'ов':'а'))?></option>

<?

    }

  }

?>

  </select><br/>
  <input type='submit' value='Отправиться в поход'/>

</form>

<?

  }
  else
  {


if($farm['time'] > time()) {

  if($_GET['end'] == true) {
    mysql_query('UPDATE `farm` SET `h` = "0", 
                                `time` = "0" WHERE `user` = "'.$user['id'].'"');
    header('location: /farm/');
  }
  

?>

<font color='#90b0c0'>Вы отправились в поход..</font><br/>
Осталось: <?=_time($farm['time'] - time())?><br/><br/>

<a href='/farm/?end=true' class='button'>Отменить</a>

<?

  }
  else
  {
# profesion
if ($profesion['prof_farm']==1){
mysql_query('UPDATE `users` SET `s` = `s` + '.($farm['h'] * 2000).' WHERE `id` = "'.$user['id'].'"'); 
}else{
mysql_query('UPDATE `users` SET `s` = `s` + '.($farm['h'] * 1000).' WHERE `id` = "'.$user['id'].'"'); 
}
      
      mysql_query('UPDATE `farm` SET `h` = "0",
                                  `time` = "0" WHERE `user` = "'.$user['id'].'"');
# profesion
if ($profesion['prof_cave']==1){   
?>

<font color='#90b0c0'>Вы вернулись из похода!</font><br/>
Вы нашли: <img src='/images/icon/silver.png' alt='*'/> <?=n_f($farm['h'] * 2000)?> серебра<br/><br/>

<a href='/farm/' class='button'>Обновить</a>


<?
}else{
?>

<font color='#90b0c0'>Вы вернулись из похода!</font><br/>
Вы нашли: <img src='/images/icon/silver.png' alt='*'/> <?=n_f($farm['h'] * 1000)?> серебра<br/><br/>

<a href='/farm/' class='button'>Обновить</a>
<?
}

  }

  }

?>
  </li>
</div>

<?

  }
  else
  {
  
?>

<div class='content' align='center'>
  <img src='/images/icon/farm.png' alt='*'/> Поход доступен с <img src='/images/icon/level.png' alt='*'/> 3 уровня<br/>
</div>

<?

  }
  
include './system/f.php';

?>