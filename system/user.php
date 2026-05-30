<?

      $id = $_COOKIE['id'];
$password = $_COOKIE['password'];


    
       $q = mysql_query('SELECT * FROM `users` WHERE `id` = "'.base64_decode($id).'" AND `password` = "'.$password.'"');
    $user = mysql_fetch_array($q);


      mysql_query('UPDATE `users` SET `online` = "'.time().'",
                                          `ip` = "'.$_SERVER['REMOTE_ADDR'].'",
                                          `ua` = "'.$_SERVER['HTTP_USER_AGENT'].'",
                                        `self` = "'.$_SERVER['PHP_SELF'].'" WHERE `id` = "'.$user['id'].'"');

      $_time = 2;

       if($user['last_update'] < (time() - $_time)){

        mysql_query('UPDATE `users` SET `last_update` = "'.time().'" WHERE `id` = "'.$user['id'].'"');

      }


      if((time() - $user['last_update']) > $_time) {

        mysql_query('UPDATE `users` SET `last_update` = "'.time().'" WHERE `id` = "'.$user['id'].'"');

        if($user['self'] != '/coliseum.php') {

          $hp = $user['vit'] * 2;
          
          if($user['hp'] < $hp) {
              $_hp = (((time() - $user['last_update']) / $_time) - 1 );
           if($_hp > $hp) {
              $_hp = $hp - $user['hp'];
              }
            mysql_query('UPDATE `users` SET `hp` = "'.($user['hp'] + $_hp ).'"  WHERE `id` = "'.$user['id'].'"');
          
          }    
        

          if($user['mp'] < $user['mana']) {

              $_mp = (((time() - $user['last_update']) / $_time) - 1 );
           if($_mp > $user['mana']) {
              $_mp = $user['mana'] - $user['mp'];
              }
            mysql_query('UPDATE `users` SET `mp` = "'.($user['mp'] +$_mp ).'" WHERE `id` = "'.$user['id'].'"');
          
          }
      
        }    
    
      }


     if($user['essence'] > 0) {

    

      $user['str'] += $user['essence'];

      $user['vit'] += $user['essence'];

      $user['agi'] += $user['essence'];

      $user['def'] += $user['essence'];
}

    if($user['last_update'] - $user['duel_last_update'] > (60 * 30)) {

        mysql_query('UPDATE `users` SET `duel_last_update` = "'.($user['duel_last_update'] + (60 * 30)).'",
                                             `duel_fights` = "'.($user['duel_fights']  + (($user['duel_fights'] < 11) ? 1:0)).'",
                                            `duel_changes` = "'.($user['duel_changes'] + (($user['duel_changes'] < 11) ? 1:0)).'" WHERE `id` = "'.$user['id'].'"');

    }

  if($user['hp'] > $user['vit'] * 2) {
    mysql_query('UPDATE `users` SET `hp` = "'.($user['vit'] * 2).'" WHERE `id` = "'.$user['id'].'"');
  }
  
  if($user['hp'] < 0) {
    mysql_query('UPDATE `users` SET `hp` = "0" WHERE `id` = "'.$user['id'].'"');
  }

  if($user['mp'] > $user['mana']) {
    mysql_query('UPDATE `users` SET `mp` = "'.$user['mana'].'" WHERE `id` = "'.$user['id'].'"');
  }

  if($user['mp'] < 0) {
    mysql_query('UPDATE `users` SET `mp` = "0" WHERE `id` = "'.$user['id'].'"');
  }





  $clan_memb = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"');
  $clan_memb = mysql_fetch_array($clan_memb);
function clan_buff($i){
$buff_1 = mysql_query("SELECT * FROM `clan_buff` WHERE `level` = '".$i."'");
$buff_2 = mysql_fetch_array($buff_1);
      $buff = $buff_2['buff'];
      return $buff;
      } 


    if($clan_memb) {

       $clan = mysql_fetch_array(mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$clan_memb['clan'].'"'));

    if($clan_memb['last_update'] <= time()) {
        
      mysql_query('UPDATE `clan_memb` SET `last_update` = "'.($clan_memb['last_update'] + ((60 * 60) * 24 )).'",
                                                    `v` = `v` + 3 WHERE `id` = "'.$clan_memb['id'].'"');

    }
    
    $clan_buff = clan_buff($clan['built_1']);
    
    if($clan['built_1'] > 0 && $clan_buff) {
    
      $user['str'] += $clan_buff;
      $user['vit'] += $clan_buff;
      $user['agi'] += $clan_buff;
      $user['def'] += $clan_buff;

    }
    

  }











    $ban = mysql_fetch_array(mysql_query('SELECT * FROM `ban` WHERE `user` = "'.$user['id'].'"'));
if($ban) {
  if($ban['time'] <=time()) {
      mysql_query('DELETE FROM `ban` WHERE `user` = "'.$user['id'].'"');
  }
  if($ban['time'] > time() && $_SERVER['PHP_SELF'] != '/ban.php') {
    header('location: /ban.php');
    exit;
  }
}
  $elikstr= mysql_fetch_array(mysql_query('SELECT * FROM `elikstr` WHERE `user` = "'.$user['id'].'"'));
  
  if($elikstr) {
  
    if($elikstr['time'] <= time()) {
    
mysql_query('UPDATE `users` SET `str` = `str` - 0 WHERE `id` = \''.$user['id'].'\'');

      mysql_query('DELETE FROM `elikstr` WHERE `user` = \''.$user['id'].'\'');
  
    }
  
  }
  $elikdef= mysql_fetch_array(mysql_query('SELECT * FROM `elikdef` WHERE `user` = "'.$user['id'].'"'));
  
  if($elikdef) {
  
    if($elikdef['time'] <= time()) {
    
mysql_query('UPDATE `users` SET `def` = `def` - 0 WHERE `id` = \''.$user['id'].'\'');

      mysql_query('DELETE FROM `elikdef` WHERE `user` = \''.$user['id'].'\'');
  
    }
  
  }
  $elikvit= mysql_fetch_array(mysql_query('SELECT * FROM `elikvit` WHERE `user` = "'.$user['id'].'"'));
  
  if($elikvit) {
  
    if($elikvit['time'] <= time()) {
    
mysql_query('UPDATE `users` SET `vit` = `vit` - 0 WHERE `id` = \''.$user['id'].'\'');

      mysql_query('DELETE FROM `elikvit` WHERE `user` = \''.$user['id'].'\'');
  
    }
  
  }
  $elikagi= mysql_fetch_array(mysql_query('SELECT * FROM `elikagi` WHERE `user` = "'.$user['id'].'"'));
  
  if($elikagi) {
  
    if($elikagi['time'] <= time()) {
    
mysql_query('UPDATE `users` SET `agi` = `agi` - 0 WHERE `id` = \''.$user['id'].'\'');

      mysql_query('DELETE FROM `elikagi` WHERE `user` = \''.$user['id'].'\'');
  
    }
  
  }    
  $premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `user` = "'.$user['id'].'"'));
  
  if($premium) {
  
    if($premium['time'] <= time()) {
    
mysql_query('UPDATE `users` SET `str` = `str` - 500,
                                     
`vit` = `vit` - 500,
                                     
`agi` = `agi` - 500,
                                    
`def` = `def` - 500 WHERE `id` = \''.$user['id'].'\'');

      mysql_query('DELETE FROM `premium` WHERE `user` = \''.$user['id'].'\'');
  
    }
  
  }





//Если расса инрока не совподает с рассой клана, то удоляем игрока из клана
$clan_memb = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$user['id'].'"');
$clan_memb = mysql_fetch_array($clan_memb);
if($clan_memb){
$clan = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$clan_memb['clan'].'"');
$clan = mysql_fetch_array($clan);
if($user['r'] != $clan['r']){
mysql_query('DELETE FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');
}
}



/** 
 Трофеи  
**/ 

$names = array (0,'Трофей бойца','Трофей воина','Трофей избранного','Трофей идущего к славе','Трофей несокрушимогo',
        'Трофей силы','Трофей могущества','Трофей титана','Трофей полубога');

$skill = array (0,10,24,35,50,100,185,190,200,230);
$level = array (1,10,20,35,50,51,51,53,54,55);
$duel_rating = array (1,10,20,35,50,51,51,53,54,55);
if (isset($user)) 
{ 

    $qquj = mysql_query("SELECT * FROM `chest` WHERE `user`='".$user['id']."'");
    $q1234556= mysql_fetch_array($qquj);

    if ( !$q1234556) 
    { 
            mysql_query("INSERT INTO `chest` 
                SET `user`='".$user['id']."' ")or die (mysql_error());
             
    } 

  for ($i =1;$i<10;$i++) 
  { 
    if ($user['troph'.$i] == 0) 
    { 
      if ($user['undying']>= $undying_kills[$i] && $user['quests']>=$quests[$i] &&  $user['skill']>=$skill[$i] && $user['troph'.$i] == 0)
      { 
        mysql_query("UPDATE `users` SET `troph$i` = '1' WHERE `id`='".$user['id']."' ")or die (mysql_error());
        
        echo"<div class ='block'/> 
        <center> 
          <img src='/images/medals/50x50/<?=$i;?>.png'/><br/> 
          <?=$names[$i];?> 
          <br/> 
          Трофей получен! 
        </center> 
        </div>";
        

      } 
    } 
} 



$stats = array (0,'str','vit','agi','def');
$costs = 1000;
$value = 'g';
$namesT = array (0,"Эликсир силы","Эликсир выносливости","Эликсир ловкости",
"Эликсир защиты");
$params = 1000;
$suffix = array (0,"к силе","к жизням","к удаче","к броне");
}


	
	$stone = mysql_fetch_array(mysql_query('SELECT * FROM `stone` WHERE `user` = "'.$user['id'].'"'));
  
	if($stone) {
  
    if($stone['time'] < time()) {
    
mysql_query('UPDATE `users` SET `str` = `str` - 0,
                                     
`vit` = `vit` - 0,
                                     
`agi` = `agi` - 0,
                                    
`def` = `def` - 0 WHERE `id` = \''.$user['id'].'\'');

      mysql_query('DELETE FROM `stone` WHERE `user` = \''.$user['id'].'\'');
  
    }
  
}
$sng = mysql_fetch_array(mysql_query('SELECT * FROM `snegovik` WHERE `id` = "1"'));
if($sng['kill']=='1' && $sng['time'] < time()) {
mysql_query('update `snegovik` set `hp`="10000", `kill`="0" where `id` ="1"');
mysql_query('DELETE FROM `snegovik_top`');
mysql_query('DELETE FROM `snegovik_log`');
}	

//конфета 1
$sng_stat1 = mysql_fetch_array(mysql_query('SELECT * FROM `snegovik_shop` WHERE `user` = "'.$user['id'].'" AND `konfeta`="1"'));
$b1 = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$sng_stat1[user]' LIMIT 1"));
if($sng_stat1){
if($sng_stat1['time'] < time()) {
$textg = 'У вас закончилось конфета 1-го уровня';
$con = mysql_result(mysql_query("SELECT COUNT(id) FROM `contacts` WHERE `user` = '".$b1['id']."' and `ho` = '2' LIMIT 1"),0);
if($con == 0){
mysql_query("INSERT INTO `contacts` SET `ho` = '2', `user` = '".$b1['id']."', `time` = '".time()."'");
mysql_query("INSERT INTO `contacts` SET `ho` = '".$b1['id']."', `user` = '2', `time` = '".time()."'");
}
mysql_query("UPDATE `contacts` SET `time`='".time()."' WHERE `ho` = '2' and `user`='".$b1['id']."' limit 1");
mysql_query("UPDATE `contacts` SET `time`='".time()."' WHERE `user` = '2' and `ho`='".$b1['id']."' limit 1");
mysql_query("INSERT INTO `mail` SET `text` = '".$textg."', `from` = '2', `to` = '".$b1['id']."', `time` = '".time()."', `read` = '0'");

mysql_query('delete  from `snegovik_shop` where `user` = "'.$sng_stat1['user'].'" AND `konfeta` = "1"');
mysql_query('update `users` set `str`="'.($user['str']-$sng_stat1['stats']).'", `agi`="'.($user['agi']-$sng_stat1['stats']).'", `def`="'.($user['def']-$sng_stat1['stats']).'", `vit`="'.($user['vit']-$sng_stat1['stats']).'" where `id` = "'.$user['id'].'"');
}}

//конфета 2
$sng_stat2 = mysql_fetch_array(mysql_query('SELECT * FROM `snegovik_shop` WHERE `user` = "'.$user['id'].'" AND `konfeta`="2"'));
$b2 = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$sng_stat2[user]' LIMIT 1"));
if($sng_stat2){
if($sng_stat2['time'] < time()) {
$textg = 'У вас закончилось конфета 2-го уровня';
$con = mysql_result(mysql_query("SELECT COUNT(id) FROM `contacts` WHERE `user` = '".$b2['id']."' and `ho` = '2' LIMIT 1"),0);
if($con == 0){
mysql_query("INSERT INTO `contacts` SET `ho` = '2', `user` = '".$b2['id']."', `time` = '".time()."'");
mysql_query("INSERT INTO `contacts` SET `ho` = '".$b2['id']."', `user` = '2', `time` = '".time()."'");
}
mysql_query("UPDATE `contacts` SET `time`='".time()."' WHERE `ho` = '2' and `user`='".$b2['id']."' limit 1");
mysql_query("UPDATE `contacts` SET `time`='".time()."' WHERE `user` = '2' and `ho`='".$b2['id']."' limit 1");
mysql_query("INSERT INTO `mail` SET `text` = '".$textg."', `from` = '2', `to` = '".$b2['id']."', `time` = '".time()."', `read` = '0'");

mysql_query('delete  from `snegovik_shop` where `user` = "'.$sng_stat2['user'].'" AND `konfeta` = "2"');
mysql_query('update `users` set `str`="'.($user['str']-$sng_stat2['stats']).'", `agi`="'.($user['agi']-$sng_stat2['stats']).'", `def`="'.($user['def']-$sng_stat2['stats']).'", `vit`="'.($user['vit']-$sng_stat2['stats']).'" where `id` = "'.$user['id'].'"');
}}	

//конфета 3
$sng_stat3 = mysql_fetch_array(mysql_query('SELECT * FROM `snegovik_shop` WHERE `user` = "'.$user['id'].'" AND `konfeta`="3"'));
$b3 = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$sng_stat3[user]' LIMIT 1"));
if($sng_stat3){
if($sng_stat3['time'] < time()) {
$textg = 'У вас закончилось конфета 3-го уровня';
$con = mysql_result(mysql_query("SELECT COUNT(id) FROM `contacts` WHERE `user` = '".$b3['id']."' and `ho` = '2' LIMIT 1"),0);
if($con == 0){
mysql_query("INSERT INTO `contacts` SET `ho` = '2', `user` = '".$b3['id']."', `time` = '".time()."'");
mysql_query("INSERT INTO `contacts` SET `ho` = '".$b3['id']."', `user` = '2', `time` = '".time()."'");
}
mysql_query("UPDATE `contacts` SET `time`='".time()."' WHERE `ho` = '2' and `user`='".$b3['id']."' limit 1");
mysql_query("UPDATE `contacts` SET `time`='".time()."' WHERE `
 `user` = '2' and `ho`='".$b3['id']."' limit 1");
mysql_query("INSERT INTO `mail` SET `text` = '".$textg."', `from` = '2', `to` = '".$b3['id']."', `time` = '".time()."', `read` = '0'");

mysql_query('delete  from `snegovik_shop` where `user` = "'.$sng_stat3['user'].'" AND `konfeta` = "3"');
mysql_query('update `users` set `str`="'.($user['str']-$sng_stat3['stats']).'", `agi`="'.($user['agi']-$sng_stat3['stats']).'", `def`="'.($user['def']-$sng_stat3['stats']).'", `vit`="'.($user['vit']-$sng_stat3['stats']).'" where `id` = "'.$user['id'].'"');
}}	

//конфета 4
$sng_stat4 = mysql_fetch_array(mysql_query('SELECT * FROM `snegovik_shop` WHERE `user` = "'.$user['id'].'" AND `konfeta`="4"'));
$b4 = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$sng_stat4[user]' LIMIT 1"));
if($sng_stat4){
if($sng_stat4['time'] < time()) {
$textg = 'У вас закончилось конфета 4-го уровня';
$con = mysql_result(mysql_query("SELECT COUNT(id) FROM `contacts` WHERE `user` = '".$b4['id']."' and `ho` = '2' LIMIT 1"),0);
if($con == 0){
mysql_query("INSERT INTO `contacts` SET `ho` = '2', `user` = '".$b4['id']."', `time` = '".time()."'");
mysql_query("INSERT INTO `contacts` SET `ho` = '".$b4['id']."', `user` = '2', `time` = '".time()."'");
}
mysql_query("UPDATE `contacts` SET `time`='".time()."' WHERE `ho` = '2' and `user`='".$b4['id']."' limit 1");
mysql_query("UPDATE `contacts` SET `time`='".time()."' WHERE `user` = '2' and `ho`='".$b4['id']."' limit 1");
mysql_query("INSERT INTO `mail` SET `text` = '".$textg."', `from` = '2', `to` = '".$b4['id']."', `time` = '".time()."', `read` = '0'");

mysql_query('delete  from `snegovik_shop` where `user` = "'.$sng_stat4['user'].'" AND `konfeta` = "4"');
mysql_query('update `users` set `str`="'.($user['str']-$sng_stat4['stats']).'", `agi`="'.($user['agi']-$sng_stat4['stats']).'", `def`="'.($user['def']-$sng_stat4['stats']).'", `vit`="'.($user['vit']-$sng_stat4['stats']).'" where `id` = "'.$user['id'].'"');
}	}
$clan_rud = mysql_fetch_array(mysql_query('SELECT * FROM `clan_rud` WHERE `clan` = "'.$clan['id'].'"'));
if($clan_rud) {
if($clan_rud['time'] < time()) {
mysql_query('UPDATE `clan_rud` SET `g` =  "0",`time` = "'.(time()+(20*3600)).'" WHERE `clan` = "'.$clan['id'].'"');
}}