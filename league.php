<?
require_once './system/common.php';
require_once './system/functions.php';
require_once './system/user.php';
if(!$user){
header('location: /');
exit;
}
$league = array( '', 'новичков', 'опытных', 'претендентов', 'мастеров', 'титанов', 'избранных');
$title = 'Лига ' . $league[$user['league']];
require_once './system/h.php';  
echo '<div class=\'title\'><span style=\'float: right;\'> '.$user['league_place'].' место</span> Лига '.$league[$user['league']].'</div>
'; 
if(isset($user['id'])){
if (isset($_SESSION['light'])){
echo "$_SESSION[light]";
$_SESSION['light']=NULL;
}
}
if($user['league_fights']=='0'){
  if(isset($_GET['respawn'])){
    if($user['g']<'60'){
      $_SESSION['light']="У вас не достаточно золота.";
      header("location:/league/");
      exit;
    }else if ($user['g']>='60') {
      mysql_query("UPDATE `users` SET `league_fights`='25',`g`='".($user['g']-60)."' WHERE `id`='".$user['id']."'");
      $_SESSION['light']='<div class="content" align="center">Вы приобрели 25 боев в лиге!</div>';
      header("location:?");
      exit;
    }
  }
}
echo '<div class=\'content\'> <img src=\'/images/icon/2hit.png\' alt=\'\'/> Осталось боев: <b>' . $user['league_fights'] . '</b>
';
echo '</div>';
if($user['league_place'] == 1){
echo '<div class=\'block\'><img src=\'/images/league/' . $user['league_place'] . '.png\' width=\'50\' height=\'50\' style=\'float:left; margin-right:3px; margin-top:3px;\' alt=\'\'/> <span class=\'yellow\'>Поздравляем!</span><br/>';
if($user['league_place'] == 1) echo'Вы лучший в лиге '.$league[$user['league']].'';
echo '<div style=\'clear: both;\'></div>
</div>';
}
$mesto = ($user['league_place']); 
$kiek = array(8, 3, 1); //на сколько двигать мест при победе, где 8 это первый бот
$dmg = round(rand(($user['str']/2),($user['str']/4)));
$kiek2 = array(3, 2, 1); //на сколько умножаем параметры, первый бот самый сильный
if($mesto <= 10){
$mesto2 =1; //если место меньше 10 то выводим одного бота
$kiek = array(1);
}else{
$mesto2 = 3; //скольео выводить игроков, если меняем, то и сдвиг по местам добавляем, так же пораметры ботов.
}
/*создадим пораметры*/
for($y = 0; $y < $mesto2; $y++){
$opponent = array("str"=>"".($dmg*$kiek2[$y])."", "vit"=>"".($dmg*$kiek2[$y])."", "agi"=>"".($dmg*$kiek2[$y])."","def"=>"".($dmg*$kiek2[$y])."");	

/* создадим картинки ботов, можео дописать картинки из базы, идут простые веши в первой лиге, остальные свех божественные*/

if($user['league'] ==  1){
$w_items = array(
							array(17, 25, 9),
							array(26, 10, 18),
							array(27, 11, 19),
							array(12, 20, 28),
							array(13, 21, 29),
							array(30, 22, 14),
							array(23, 31, 15),
							array(16, 32, 24)
						);

}else{

$w_items = array(
							array(226, 234, 242),
							array(227, 235, 243),
							array(228, 236, 244),
							array(229, 237, 245),
							array(230, 238, 246),
							array(231, 239, 247),
							array(232, 240, 248),
							array(233, 241, 249)
						);
}
						$items = array();
for($a = 0; $a < 8; $a ++){
						
							$sk = rand(0, count($w_items[$a]) - 1);
							$items[$a + 1] = $w_items[$a][$sk];
						
						}
////////////атака/////////////
if(isset($_GET['attack']) && explode('^[0-9]', $_GET['attack'])){
if($_GET['attack']==$mesto - $kiek[$y]){
if($user['league_fights'] == 0){
$_SESSION ['light']= '<div class="content" align="center">У вас закончились бои.</br></br> 
 <a href="?respawn" class="button">Купить 25 боев за 60 <img src="/images/icon/gold.png" alt=""/> золота</a></br></br></div>';
header("Location:?".($mesto - $kiek[$y])."");
exit;
  }
   
if($user['mp'] < 50 OR $user['hp'] < ((($user['vit'] * 2) / 100 ) * 10)){
$_SESSION ['light']= '<div class="content" align="center">
<font color="#c06060">Для нападения надо минимум <img src="/images/icon/health.png" alt="*"/> 10% жизни и <img src="/images/icon/mana.png" alt="*"/> 50 маны</font><div class="separator"></div>
<table cellpadding="0" cellspacing="0"><tr>
  <td><img src="/images/alchemy/potion.png" alt="*"/></td>
  <td valign="top" style="padding-left: 5px;" align="left"><b>Настойка бодрости</b><br/>
  <small><small>+100% маны и жизни</small></small></td>
</tr></table></br>
<div align="center"><br><a href="/lab/wiz/?potion=true&referal=/league/" class="button">Купить</a><br/><br/>
<font color="#909090">Цена: <img src="/images/icon/gold.png" alt="*"/> 15 золота</font><br>
</div></div></div>';
header("Location:?".($mesto - $kiek[$y])."");
exit;
  }else{
  
    $dmg = 0;
    $opponent_dmg = 0;
    for($i = 1; $i < 2; $i++){
      $dmg += ceil(rand(($user['str'] / 6 ), ($user['str'] / 4 )));
      $crit = ((rand(1, 2) * ($user['agi'] / 100)) - (rand(1,2) * ($opponent['agi'] / 100)));
      if(mt_rand( 0, 100 ) <= $crit){
        $dmg *= 2;
      }
      $dodge = ((rand(1, 2) * ($opponent['agi'] / 100)) - (rand(1,2) * ($user['agi'] / 100)));
      if(mt_rand(0,100) <= $dodge){
        $dmg = 0;
      }
      $dmg -= ceil(rand(($opponent['def'] / 12 ),($opponent['def'] / 7)));
      $opponent_dmg += ceil(rand(($opponent['str'] / 6),($opponent['str'] / 4)));
      if($opponent_dmg < 0){
        $opponent_dmg = 0;
      }
      $opponent_crit = ((rand(1,2) * ($opponent['agi'] / 100)) - (rand(1,2) * ($user['agi'] / 100)));
      if(mt_rand(0,100) <= $opponent_crit){
        $opponent_dmg *= 2;
      }    
      $opponent_dodge = ((rand(1,2) * ($user['agi'] / 100 )) - (rand(1,2) * ($opponent['agi'] / 100)));
      if ( mt_rand(0,100) <= $opponent_dodge){
        $opponent_dmg = 0;
      }
      $opponent_dmg -= ceil(rand(($user['def'] / 12),($user['def'] / 7)));
    }
    if($dmg > $opponent_dmg){

      $_hp  -= ceil($opponent_dmg / 4);
    
    }else{

	$_hp  = ceil($opponent_dmg / 2);

    }

    mysql_query('UPDATE `users` SET `hp` = `hp` - "'.$_hp.'",
    
                                      `mp` = `mp` - 50 WHERE `id` = "'.$user['id'].'"');



echo'<div class=\'block\'>';
    
if($dmg > $opponent_dmg){
mysql_query('UPDATE `users` SET `league_place` = "'.($mesto - $kiek[$y]).'" WHERE `id` = "'.$user['id'] .'"');
/*простой расчет награды при победе, чем выше место тем больше награда, если меняете количество мест, то и отнимайте то количество*/
      $_silver = (rand(7,10)  * (1000 - $user['league_place']));         
      $_exp = (rand(5,7) * (1000 - $user['league_place']));
      
      
$_SESSION['light'] ='<div class="block"><img src=\'/images/icon/2hit.png\' alt=\'*\'/> <font color=\'#90c090\'><b>Победа!</b></font> <img src=\'/images/icon/2hit.png\' alt=\'*\'/><div class=\'separator\'></div>
<img src=\'/images/icon/silver.png\' alt=\'\'/> '.n_f($_silver).' серебра <img src=\'/images/icon/exp.png\' alt=\'\'/> '.n_f($_exp).' опыта</div></div>';

    }else{
/*простой расчет награды при поражение*/
$_silver = rand(1,100) + ((rand(1,100)));
 $_exp = 1;  
        
$_SESSION['light'] ='<div class="block"><img src=\'/images/icon/2hit.png\' alt=\'*\'/> <font color=\'#c06060\'><b>Поражение!</b></font> <img src=\'/images/icon/2hit.png\' alt=\'*\'/><div class=\'separator\'></div>
<img src=\'/images/icon/silver.png\' alt=\'\'/> '.n_f($_silver).' серебра <img src=\'/images/icon/exp.png\' alt=\'\'/> '.n_f($_exp).' опыта</div></div>';
}
if($clan_memb && $clan_memb['v'] > 0){
$_exp += round($_exp/1000) * $clan_memb['v'];
}
if($premium){
$_exp += ceil(($_exp / 100 ) * 25 );
}
if($clan){
mysql_query('UPDATE `clans` SET `exp` = `exp` + '.$_exp.' WHERE `id` = "'.$clan['id'].'"');
mysql_query('UPDATE `clan_memb` SET `exp` = `exp` + '.$_exp.' WHERE `clan` = "'.$clan['id'].'" AND `user` = "'.$user['id'].'"');
}
mysql_query('UPDATE `users` SET `exp`=`exp`+ '.$_exp.',
                                    `s`=`s` + '.$_silver.',
                                      `league_fights`= `league_fights` - 1 WHERE `id` = '.$user['id'].'');
header("Location:?".($mesto - $kiek[$y])."");
  }
  }
}

if($mesto != 1 ){

/*выведем всё*/

echo "<div class='content'>";
echo "<td valign='top' style='padding-left: 5px;'>";
echo '<span style=\'float: left;\'><a href=\'/league/?attack='.($mesto - $kiek[$y]).'\'><img src=\'/manekenImage/0/' . $w_1=$items[1] . '/' . $w_2=$items[2] . '/' . $w_3=$items[3] . '/' . $w_4=$items[4] . '/' . $w_5=$items[5] . '/' . $w_6=$items[6] . '/' . $w_7=$items[7] . '/' . $w_8=$items[8] . '/\' width=\'120\' height=\'160\' style=\'margin-right:10px; margin-top:3px;\' alt=\'\'></a></span>';
echo " ".(($mesto - $kiek[$y]))." ".NameBot($name)."<br/><br/>";
echo "<img src='/images/icon/str.png' alt='*'/> Сила:   ".$opponent['str']."<br/>";
echo "<img src='/images/icon/vit.png' alt='*'/> Жизнь:  ".$opponent['vit']."<br/>";
echo "<img src='/images/icon/agi.png' alt='*'/> Удача:  ".$opponent['agi']."<br/>";
echo "<img src='/images/icon/def.png' alt='*'/> Защита: ".$opponent['def']."<br/><br/>";
echo "<a href='/league/?attack=".($mesto - $kiek[$y])."' class='button'>Атаковать</a></br>";
echo "</td>";
echo "</tr></table></br></br>";
echo "</div>";
	}
	}
echo '<div class=\'content\'>';
echo "Ваши параметры:<br/>";
echo "<img src='/images/icon/str.png' alt='*'/> ".$user['str']." <img src='/images/icon/vit.png' alt='*'/> ".$user['vit']." <img src='/images/icon/agi.png' alt='*'/> ".$user['agi']." <img src='/images/icon/def.png' alt='*'/> ".$user['def']."";
echo "</div>";
echo '<div class=\'content\'>
<a href=\'/arena\'><img src=\'/images/icon/arrow.png\' alt=\'\'/> Арена</a></li>
</div>';
require_once './system/f.php';
?>