<? 
     
    include './system/common.php'; 
     
 include './system/functions.php'; 
         
      include './system/user.php'; 
     
auth();

$id = _string(_num($_GET['id'])); 
  if($id) { 
    $i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"'); 
    $i = mysql_fetch_array($i); 
     
    if(!$i) { 
      header('location: /user/'); 
      exit; 
    } 

    } 
    else 
    {  
      $i = $user; 
    } 
     
    $title = $i['login']; 


include './system/h.php'; 


$w_1 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_1'].'"'); 
$w_1 = mysql_fetch_array($w_1); 
if(!$w_1) { 
  $w_1['item'] = 0; 
} 
$w_1_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_1['item'].'"'); 
$w_1_item = mysql_fetch_array($w_1_item); 

$w_2 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_2'].'"'); 
$w_2 = mysql_fetch_array($w_2); 
if(!$w_2) { 
  $w_2['item'] = 0; 
} 

$w_2_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_2['item'].'"'); 
$w_2_item = mysql_fetch_array($w_2_item); 

$w_3 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_3'].'"'); 
$w_3 = mysql_fetch_array($w_3); 
if(!$w_3) { 
  $w_3['item'] = 0; 
} 

$w_3_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_3['item'].'"'); 
$w_3_item = mysql_fetch_array($w_3_item); 


$w_4 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_4'].'"'); 
$w_4 = mysql_fetch_array($w_4); 

if(!$w_4) { 
  $w_4['item'] = 0; 
} 

$w_4_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_4['item'].'"'); 
$w_4_item = mysql_fetch_array($w_4_item); 

$w_5 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_5'].'"'); 
$w_5 = mysql_fetch_array($w_5); 
if(!$w_5) { 
  $w_5['item'] = 0; 
} 
$w_5_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_5['item'].'"'); 
$w_5_item = mysql_fetch_array($w_5_item); 

$w_6 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_6'].'"'); 
$w_6 = mysql_fetch_array($w_6); 
if(!$w_6) { 
  $w_6['item'] = 0; 
} 
$w_6_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_6['item'].'"'); 
$w_6_item = mysql_fetch_array($w_6_item); 

$w_7 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_7'].'"'); 
$w_7 = mysql_fetch_array($w_7); 
if(!$w_7) { 
  $w_7['item'] = 0; 
} 
$w_7_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_7['item'].'"'); 
$w_7_item = mysql_fetch_array($w_7_item); 

$w_8 = mysql_query('SELECT * FROM `inv` WHERE `user` = "'.$i['id'].'" AND `id` = "'.$i['w_8'].'"'); 
$w_8 = mysql_fetch_array($w_8); 
if(!$w_8) { 
  $w_8['item'] = 0; 
} 
$w_8_item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$w_8['item'].'"'); 
$w_8_item = mysql_fetch_array($w_8_item); 


  $i_clan_memb = mysql_query('SELECT * FROM `clan_memb` WHERE `user` = "'.$i['id'].'"'); 
  $i_clan_memb = mysql_fetch_array($i_clan_memb); 
   
    if(!$i_clan_memb) { 
     
    if($clan && $clan_memb['rank'] >= $clan['rank_for_invite'] && $clan['r'] == $i['r'] && $_GET['clan_invite'] == true) { 
     
    if(mysql_result(mysql_query('SELECT COUNT(`id`) FROM `clan_invite` WHERE `user` = "'.$i['id'].'" AND `clan` = "'.$clan['id'].'"'),0) == 0) { 
        if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_memb` WHERE `clan` = "'.$clan['id'].'"'),0) + 1 <= $clan['barrack']) { 
      mysql_query('INSERT INTO `clan_invite` (`clan`, 
                                              `user`) VALUES ("'.$clan['id'].'", 
                                                                 "'.$i['id'].'")'); 
?> 

<div class='content' align='center'><img src='/images/icon/ok.png' alt='*'/> <font color='#30c030'>Приглашение отправлено!</font></div><div class='line'></div> 

<? 
        }else{ 
?> 
        <div class='content' align='center'><img src='/images/icon/error.png' alt='*'/> <font color='red'>Ошибка, в клане нет свободных мест!</font></div><div class='line'></div> 
        <? 
        } 

    } 
    else 
    { 
     
    } 

   
    } 
   
  } 
   
?> 


<div class='main'> 
<img src='/images/icon/race/<?=$i['r'].($i['online'] > (time() - 300) ? '':'-off')?>.png' alt='*'/> <b><?=$i['login']?></b> <img src='/images/icon/level.png' alt='*'/> <?=$i['level']?> ур, <?=($i['r'] == 0 ? 'Асура':'Борея')?><br/> 
<div class='line'></div>
<div class='content'>
<font color='<?=$i['status_color']?>'><?=smiles($i['status'])?></font>  <?php if($i['id'] == $user['id']) echo "<a href='/status.php'>[изменить]</a>"; ?>
</div>
<div class='line'></div>

<? 
echo '
</center></div>
';
if($w_9['item'] > 0) {
    echo '
    <div class="b-maneken" style="background: url(/images_i/skin/'.$w_9['item'].'.png) no-repeat center 0;">
    ';
}
if($w_9['item'] == 0  && $_user['class'] == 1 && $_user['sex'] == 0) {
    echo '
    <div class="b-maneken" style="background: url(/images_i/bodyuser6.png) no-repeat center 0;">
    ';
}
if($w_9['item'] == 0  && $_user['class'] == 0 && $_user['sex'] == 0) {
    echo '
    <div class="b-maneken" style="background: url(/images_i/bodyuser7.png) no-repeat center 0;">
    ';
}
if($w_9['item'] == 0  && $_user['class'] == 0 && $_user['sex'] == 1) {
    echo '
    <div class="b-maneken" style="background: url(/images_i/bodyuser8.png) no-repeat center 0;">
    ';
}
if($w_9['item'] == 0  && $_user['class'] == 1 && $_user['sex'] == 1) {
    echo '
    <div class="b-maneken" style="background: url(/images_i/bodyuser9.png) no-repeat center 0;">
    ';
}
echo '
<table class="maneken-equip" width="100%">
<tbody><tr valign="middle">
<td align="left" width="75">
<div class="mt5">
';
if($w_1['item'] >= 1 && $user['class'] == 0) {
    echo '
    <a title="Оружие 1"><img alt="." src="/images_i/items/'.$w_1['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_1['item'] == 0 && $user['class'] == 0) {
    echo '
    <a title="Оружие 1"><img alt="." src="/images_i/slot/1.png" border="0" height="40" width="40"></a>
    ';
}
if($w_1['item'] >= 1 && $user['class'] == 1) {
    echo '
    <a title="Оружие 1"><img alt="." src="/images_i/items/'.$w_1['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_1['item'] == 0 && $user['class'] == 1) {
    echo '
    <a title="Оружие 1"><img alt="." src="/images_i/item1.png" border="0" height="40" width="40"></a>
    ';
}
echo '
</div>
<div class="mt5">
';

if($w_2['item'] >= 1 && $user['class'] == 0) {
    echo '
    <a title="Оружие 2"><img alt="." src="/images_i/items/'.$w_2['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_2['item'] == 0 && $user['class'] == 0) {
    echo '
    <a title="Оружие 2"><img alt="." src="/images_i/slot/2.png" border="0" height="40" width="40"></a>
    ';
}
if($w_2['item'] >= 1 && $user['class'] == 1) {
    echo '
    <a title="Оружие 2"><img alt="." src="/images_i/items/'.$w_2['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_2['item'] == 0 && $user['class'] == 1) {
    echo '
    <a title="Оружие 2"><img alt="." src="/images_i/item2.png" border="0" height="40" width="40"></a>
    ';
}
echo '
</div>
<div class="mt5">
';

if($w_3['item'] >= 1) {
    echo '
    <a title="Перчатки"><img alt="." src="/images_i/items/'.$w_3['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_3['item'] == 0) {
    echo '
    <a title="Перчатки"><img alt="." src="/images_i/slot/3.png" border="0" height="40" width="40"></a>
    ';
}
echo '
</div>
<div class="mt5">
';
if($w_4['item'] >= 1) {
    echo '
    <a title="Кольцо"><img alt="." src="/images_i/items/'.$w_4['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_4['item'] == 0) {
    echo '
    <a title="Кольцо"><img alt="." src="/images_i/slot/4.png" border="0" height="40" width="40"></a>
    ';
}
echo '
</div>
<div class="mt5">
<span class="mr3">
';
if($w_11['item'] >= 1) {
    echo '
    <a title="Амулет"><img alt="." src="/images_i/items/'.$w_11['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_11['item'] == 0) {
    echo '
    <a title="Амулет"><img alt="." src="/images_i/slot/11.png" border="0" height="40" width="40"></a>
    ';
}

echo '
</span>
</div>
</td>
<td align="right" width="40">
<div class="mt5">
';
if($w_5['item'] >= 1 && $user['class'] == 0) {
    echo '
    <a title="Шлем"><img alt="." src="/images_i/items/'.$w_5['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_5['item'] == 0 && $user['class'] == 0) {
    echo '
    <a title="Шлем"><img alt="." src="/images_i/slot/5.png" border="0" height="40" width="40"></a>
    ';
}
if($w_5['item'] >= 1 && $user['class'] == 1) {
    echo '
    <a title="Шлем"><img alt="." src="/images_i/items/'.$w_5['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_5['item'] == 0 && $user['class'] == 1) {
    echo '
    <a title="Шлем"><img alt="." src="/images_i/item5.png" border="0" height="40" width="40"></a>
    ';
}
echo '
</div>
<div class="mt5">
';
if($w_6['item'] >= 1 && $user['class'] == 0) {
    echo '
    <a title="Доспехи"><img alt="." src="/images_i/items/'.$w_6['item'].'.png" border="0" height="40" width="40"></a>
    ';
}

if($w_6['item'] == 0 && $user['class'] == 0) {
    echo '
    <a title="Доспехи"><img alt="." src="/images_i/slot/6.png" border="0" height="40" width="40"></a>
    ';
}
if($w_6['item'] >= 1 && $user['class'] == 1) {
    echo '
    <a title="Доспехи"><img alt="." src="/images_i/items/'.$w_6['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_6['item'] == 0 && $user['class'] == 1) {
    echo '
    <a title="Доспехи"><img alt="." src="/images_i/item6.png" border="0" height="40" width="40"></a>
    ';
}
echo '
</div>
<div class="mt5">
';
if($w_7['item'] >= 1) {
    echo '
    <a title="Поноши"><img alt="." src="/images_i/items/'.$w_7['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_7['item'] == 0) {
    echo '
    <a title="Поноши"><img alt="." src="/images_i/slot/7.png" border="0" height="40" width="40"></a>
    ';
}
echo '
</div>
<div class="mt5">
';

if($w_10['item'] >= 1) {
    echo '
    <a title="Пояс"><img alt="." src="/images_i/items/'.$w_10['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_10['item'] == 0) {
    echo '
    <a title="Пояс"><img alt="." src="/images_i/slot/10.png" border="0" height="40" width="40"></a>
    ';
}
echo '
</div>
<div class="mt5">
';
if($w_8['item'] >= 1) {
    echo '
    <a title="Сапоги"><img alt="." src="/images_i/items/'.$w_8['item'].'.png" border="0" height="40" width="40"></a>
    ';
}
if($w_8['item'] == 0) {
    echo '
    <a title="Сапоги"><img alt="." src="/images_i/slot/8.png" border="0" height="40" width="40"></a>
    ';
}
echo '
</div>
</td>
</tr></tbody>
</table>
</div>
';
  if($i_clan_memb) { 

    $i_clan = mysql_query('SELECT * FROM `clans` WHERE `id` = "'.$i_clan_memb['clan'].'"'); 
    $i_clan = mysql_fetch_array($i_clan); 

  switch($i_clan_memb['rank']) { 
   
    case 0: 
    $rank = 'Новобранец'; 
     break; 
    case 1: 
    $rank = 'Боец'; 
     break; 
    case 2: 
    $rank = 'Офицер'; 
     break; 
    case 3: 
    $rank = 'Генерал'; 
     break; 
    case 4: 
    $rank = '<font color=\'#30c030\'>Лидер клана</font>'; 
     break; 
     
  } 

?> 

<img src='/images/icon/clan/<?=$i_clan['r']?>.png' alt='*'/> <a href='/clan/<?=$i_clan['id']?>/'><?=$i_clan['name']?></a>, <?=$rank?><br/> 

<? 
$zags = mysql_query('SELECT * FROM `zags` WHERE `id_0` = "'.$i['id'].'" AND `status` = "da" OR `id_1` = "'.$i['id'].'" AND `status` = "da"'); 
$zags = mysql_fetch_array($zags); 
$w_zags = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$zags['id_1'].'"'); 
$w_zags = mysql_fetch_array($w_zags); 
$m_zags = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$zags['id_0'].'"'); 
$m_zags = mysql_fetch_array($m_zags); 
?> 
<? 
if($zags){ 
if($i['sex'] == 0){ 
echo "<img src='/images/icon/zags.png' width='16px' height='16px' alt='*'/> Женат на <a href='/user/$w_zags[id]/'>$w_zags[login]</a> 
"; 
}else{ 
echo "<img src='/images/icon/zags.png' width='16px' height='16px' alt='*'/> Замужем за <a href='/user/$m_zags[id]/'>$m_zags[login]</a> 
"; 
} 
} 
?> 
<? 

  } 



?> 































  <table cellpadding='0' cellspacing='0'> 
  <tr> 
  <td><div class="brd"></div><a href='/avatar/?id=<?=$i['id']?>'><div class='p_dummy' style='background-image:url("/manekenImage/<?=$i['sex']?>/<?=$w_1['item']?>/<?=$w_2['item']?>/<?=$w_3['item']?>/<?=$w_4['item']?>/<?=$w_5['item']?>/<?=$w_6['item']?>/<?=$w_7['item']?>/<?=$w_8['item']?>/");'>
 </td></a> 
  <td valign='top' style='padding: 5px 0px 0px 5px;'> 

    <img src='/images/icon/str.png' alt='*'/>   Сила: <?=$i['str']?><br/> 
    <img src='/images/icon/vit.png' alt='*'/>  Жизнь: <?=$i['vit']?><br/> 
    <img src='/images/icon/agi.png' alt='*'/>  Удача: <?=$i['agi']?><br/> 
    <img src='/images/icon/def.png' alt='*'/> Защита: <?=$i['def']?><br/> 
    <img src='/images/icon/mana.png' alt='*'/>  Мана: <?=$i['mana']?> 
  
  
 </td> 
 </tr></table> 

<? 

  $all_ability = 0; 

  if($i['ability_1'] > 0) { 
    $all_ability += 1; 
?> 
  <img src='/images/ability/1.<?=$i['ability_1_quality']?>.png' width='25px' height='25px' alt='*'/> 
<? 
  } 
  if($i['ability_2'] > 0) { 
    $all_ability += 1; 
?> 
  <img src='/images/ability/2.<?=$i['ability_2_quality']?>.png' width='25px' height='25px' alt='*'/> 
<? 
  } 
  if($i['ability_3'] > 0) { 
    $all_ability += 1; 
?> 
  <img src='/images/ability/3.<?=$i['ability_3_quality']?>.png' width='25px' height='25px' alt='*'/> 
<? 
  } 
  if($i['ability_4'] > 0) { 
    $all_ability += 1; 
?> 
  <img src='/images/ability/4.<?=$i['ability_4_quality']?>.png' width='25px' height='25px' alt='*'/> 
<? 
  } 
  if($i['ability_5'] > 0) { 
    $all_ability += 1; 
?> 
  <img src='/images/ability/5.<?=$i['ability_5_quality']?>.png' width='25px' height='25px' alt='*'/> 
<? 
  } 
?> 
</div> 
<div class='list'> 
<div class=content> 

<? 
for ($q = 1; $q<10;$q++) 
{ 
  if ($i['troph'.$q] ==1) 
{ 
?> 
<a href= '/medal.php?id=<?=$q;?>'/><img src=/images/medals/24x24/<?=$q;?>.png></a> 
<? 
  }elseif ($i['troph'.$q] == 0) 
{ 
?> 
<a href= '/medal.php?id=<?=$q;?>'/><img style ='opacity:0.4;' src=/images/medals/24x24/<?=$q;?>.png></a> 
<? 
} 
} 
?> 
</div> 
<div class='mini-line'></div> 

<? 

  $equips = 0; 

  if($i['w_1']) { 
    $equips++; 
  } 
  if($i['w_2']) { 
    $equips++; 
  } 
  if($i['w_3']) { 
    $equips++; 
  } 
  if($i['w_4']) { 
    $equips++; 
  } 
  if($i['w_5']) { 
    $equips++; 
  } 
  if($i['w_6']) { 
    $equips++; 
  } 
  if($i['w_7']) { 
    $equips++; 
  } 
  if($i['w_8']) { 
    $equips++; 
  } 

?> 

<div class='list'> 
  <a href='/equip/<?=$i['id']?>/'><img src='/images/icon/equip.png' alt='*'/> Снаряжение</a> (<?=$equips?>/8)<br/> 

<? 
   
  if($i['w_1'] OR $i['w_2'] OR $i['w_3'] OR $i['w_4'] OR $i['w_5'] OR $i['w_6'] OR $i['w_7'] OR $i['w_8']) { 
   
  $runes = 0; 
   
  if($w_1['rune'] != 0) { 
    $rune .= '<img src="/images/icon/quality/'.$w_1['rune'].'.png" alt="*"/> ';   
    $runes ++; 
  } 
   
  if($w_2['rune'] != 0) { 
    $rune .= '<img src="/images/icon/quality/'.$w_2['rune'].'.png" alt="*"/> ';   
    $runes ++; 
  } 

  if($w_3['rune'] != 0) { 
    $rune .= '<img src="/images/icon/quality/'.$w_3['rune'].'.png" alt="*"/> ';     
    $runes ++; 
  } 
  if($w_4['rune'] != 0) { 
    $rune .= '<img src="/images/icon/quality/'.$w_4['rune'].'.png" alt="*"/> ';   
    $runes ++; 
  } 
  if($w_5['rune'] != 0) { 
    $rune .= '<img src="/images/icon/quality/'.$w_5['rune'].'.png" alt="*"/> ';   
    $runes ++; 
  } 
  if($w_6['rune'] != 0) { 
    $rune .= '<img src="/images/icon/quality/'.$w_6['rune'].'.png" alt="*"/> ';   
    $runes ++; 
  } 
  if($w_7['rune'] != 0) { 
    $rune .= '<img src="/images/icon/quality/'.$w_7['rune'].'.png" alt="*"/> ';   
    $all_runes ++; 
  } 
  if($w_8['rune'] != 0) { 
    $rune .= '<img src="/images/icon/quality/'.$w_8['rune'].'.png" alt="*"/> ';   
    $runes++; 
  } 
   
  if($runes > 0) { 

?> 

<img src='/images/icon/rune.png' alt='*'/> Руны: <?=$rune?><br/> 

<? 

  } 
   
      $smith = 0; 
       
      $bonus = 0; 
  $all_bonus = 0; 

  function bonus($_i) { 

    switch($_i) { 
      case 0: 
    $bonus = 0; 
       break; 
      case 1: 
    $bonus = 5; 
       break; 
      case 2: 
   $bonus = 10; 
       break; 
      case 3: 
   $bonus = 20; 
        break; 
      case 4: 
   $bonus = 35; 
       break; 
      case 5: 
   $bonus = 75; 
     break; 
      
    } 
   
  return $bonus; 
   
  } 

  if($i['w_1']) { 
    if($w_1['smith'] > 0) { 
    $smith +=$w_1['smith']; 
    } 
    $bonus += $w_1['bonus']; 
$all_bonus += bonus($w_1_item['quality']);   
  } 
  if($i['w_2']) { 
    if($w_2['smith'] > 0) { 
      $smith +=$w_2['smith']; 
    } 
    $bonus += $w_2['bonus']; 
$all_bonus += bonus($w_2_item['quality']);   
  } 

  if($i['w_3']) { 

  if($w_3['smith'] > 0) { 
   
  $smith +=$w_3['smith']; 
   
  } 

  $bonus += $w_3['bonus']; 
   
    $all_bonus += bonus($w_3_item['quality']); 
   
  } 

  if($i['w_4']) { 

  if($w_4['smith'] > 0) { 
   
  $smith +=$w_4['smith']; 
   
  } 

  $bonus += $w_4['bonus']; 
   
    $all_bonus += bonus($w_4_item['quality']); 
   
  } 

  if($i['w_5']) { 

  if($w_5['smith'] > 0) { 
   
  $smith +=$w_5['smith']; 
   
  } 

  $bonus += $w_5['bonus']; 
   
    $all_bonus += bonus($w_5_item['quality']); 
   
  } 

  if($i['w_6']) { 

  if($w_6['smith'] > 0) { 
   
  $smith +=$w_6['smith']; 
   
  } 

  $bonus += $w_6['bonus']; 
    $all_bonus += bonus($w_6_item['quality']);   
  } 
  if($i['w_7']) { 
    if($w_7['smith'] > 0) { 
    $smith +=$w_7['smith']; 
    } 
    $bonus += $w_7['bonus']; 
$all_bonus += bonus($w_7_item['quality']);   
  } 
  if($i['w_8']) { 
    if($w_8['smith'] > 0) { 
    $smith +=$w_8['smith'];     
    } 
    $bonus += $w_8['bonus']; 
$all_bonus += bonus($w_8_item['quality']);  
  } 
  if($smith > 0) { 
?> 
<img src='/images/icon/smith.png' alt='*'/> Заточка: <font color='#90c090'>+<?=$smith?></font><br/> 
<? 
  } 
?> 
<img src='/images/icon/smith.png' alt='*'/> Бонус: <font color='#90c090'><?=$bonus?></font> </font><br/> 

<? 

  } 

?> 
  </li> 
</div> 
<div class='mini-line'></div> 
<? 
  if($i['id'] == $user['id']) { 
?><?  
} 
?> 
</a></li> 
</div> 
<? 
?><div class='main'> 

<? 
if ($i['id'] == $user['id']) { 
$pet_u = mysql_query('SELECT * FROM `pet_u` WHERE `user_id` = "'.$user['id'].'"'); 
$pet_u = mysql_fetch_array($pet_u); 
if ($pet_u!=0) {?><div class='list'><img src='/images/pet/icon/<?=$pet_u['screen'];?>' alt=''/> <a href='/petshop/<?=$pet_u['pet_id'];?>/'><?=$pet_u['name'];?></a><br/> 
<img src='/petImage.php?sex=<?=$i['sex'];?>&w_1=<?=$w_1['item']?>&w_2=<?=$w_2['item']?>&w_3=<?=$w_3['item']?>&w_4=<?=$w_4['item']?>&w_5=<?=$w_5['item']?>&w_6=<?=$w_6['item']?>&w_7=<?=$w_7['item']?>&w_8=<?=$w_8['item']?>&pet=<?=$pet_u['screen'];?>' alt=''/> 
<?} 
else{echo "<div class='list'>У вас нет питомцев! 
<p><a href='/petshop/'><img src='/images/pet/icon.gif' alt='*'/> Питомцы</a></div>";} 
}elseif ($i['id'] != $user['id']) {  
$pet_u = mysql_query('SELECT * FROM `pet_u` WHERE `user_id` = "'.$id.'"'); 
$pet_u = mysql_fetch_array($pet_u); 
if ($pet_u!=0){?><img src='/images/pet/icon/<?=$pet_u['screen'];?>' alt=''/> <a href='/pet/<?=$pet_u['id'];?>/'><?=$pet_u['name'];?></a><br/> 
<img src='/petImage.php?sex=<?=$i['sex'];?>&w_1=<?=$w_1['item']?>&w_2=<?=$w_2['item']?>&w_3=<?=$w_3['item']?>&w_4=<?=$w_4['item']?>&w_5=<?=$w_5['item']?>&w_6=<?=$w_6['item']?>&w_7=<?=$w_7['item']?>&w_8=<?=$w_8['item']?>&pet=<?=$pet_u['screen'];?>' alt=''/> 
</div><?} 
else{echo "<div class='list'><img src='/images/pet/icon.gif' alt=''/> <a href='/petshop/'>Питомцы</a><br/>У игрока нет питомца</div>";} 
} 
?></div> 
<div class='main'> 
<? 
if($i['id'] == $user['id']) { 
?><div class='mini-line'></div></div> 
<div class='menuList'> 
<? 
if($user['level'] > 4) { 
?><div class='menuList'> 
<li><a href='/ability/<?=$i['id']?>/'><img src='/images/icon/seif.png'> Умения (<?=$all_ability?>/5) </a> 


<? 
  } 
?> 
<li><a href='/inv/bag/'><img src='/images/icon/bag.png' alt=''/>Сумка <span class='white'>(<?=intval(mysql_result(mysql_query('SELECT COUNT(`id`) FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0" AND `place` = "0"'),0)+intval($user['es']/$user['es']))?>/20) <?=(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0" AND `place` = "0" AND `new` = "0"'),0) > 0 ? '<font color=\'#30c030\'>(+)</font>':'')?></span></a></li> 
<? 
  if($user['chest'] == 1) { 
?> 
<li><a href='/inv/chest/'><img src='/images/icon/bag.png' alt=''/>Сундук <span class='white'>(<?=mysql_result(mysql_query('SELECT COUNT(`id`) FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0" AND `place` = "1"'),0)?>/20) <?=(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `user` = "'.$user['id'].'" AND `equip` = "0" AND `place` = "1" AND `new` = "0"'),0) > 0 ? '<font color=\'#30c030\'>(+)</font>':'')?></span></a></li> 
<? 
  } 

  $sack = mysql_query('SELECT * FROM `sack` WHERE `user` = "'.$user['id'].'"');       
  $sack = mysql_fetch_array($sack); 
   
  $resources = 0; 
   
  for($resource = 1; $resource < 10; $resource++) { 

    if($sack[$resource] > 0) { 

      $resources++; 

    } 

  } 
?> 

<li><a href='/essence.php'> <img src='/images/icon/bag.png' alt='*'/> Сущности (<?=$user['essence']?>)
<li><a href='/belt.php'> <img src='/images/icon/bag.png' alt='*'/> Мой пояс (<?=$user['belt']?>)
<li><a href='/sack/'><img src='/images/icon/res.png' alt=''/>Ресурсы <span class='white'>(<?=$resources?>/9)</span></a></li> 
  <li><a href='/mail/'><img src='/images/icon/mail.png' alt=''/>Почта</a></li></div><div class='mini-line'></div><div class='menuList'><li><a href='/train/'><img src='/images/icon/train.png' alt=''/>Тренировка</a></li></a></li></div> 

<div class='mini-line'></div> 



<? 

  } 
  else 
  { 

?> 
<div class='menuList'> 
<? 
  if(!$i_clan_memb && $clan && $clan_memb['rank'] >= $clan['rank_for_invite'] && $clan['r'] == $i['r']) { 

    if(mysql_result(mysql_query('SELECT COUNT(*) FROM `clan_invite` WHERE `user` = "'.$i['id'].'" AND `clan` = "'.$clan['id'].'"'),0) == 0) { 

?> 
 <li> <a href='/user/<?=$i['id']?>/?clan_invite=true'><img src='/images/icon/clan.png' alt='*'/> Пригласить в Клан</a></li> 
<? 

  } 

  } 

?><div class='dot-line'></div><?  
if($user['access']>1) 
{ 
?> 
<?}?> 

<li> 
  <a href='/mail/<?=$i['id']?>/'><img src='/images/icon/mail.png' alt='*'/> Отправить почту</a></li> 
   <a href='/gifts.php?p=send_gifts&id=<?=$i['id']?>&pod=1'><img src='http://tjwar.ru/images/icon/podarok.png'> Сделать Подарок</a></li>
</div> 
  <div class='mini-line'></div> 
<? 

    } 

  if($i_clan_memb) { 

?> 

<?$V_C = mysql_fetch_array(mysql_query('SELECT * FROM `v_clan` WHERE `user` = '.$i['id'].''));

	?>
<div class='menuList'><li><a href='/v_clan.php'><img src='/images/icon/clan.png' alt=''/><span class='dgreen'>Бонус клан опыта: <?=$i_clan_memb['v'] + $V_C['v']?>%</span></a></li></div><div class='mini-line'></div> 
<? 

  } 

    if($user['id'] == $i['id'] OR !$i['id']) { 

?> 
<div class='block_zero'><img src='/images/icon/exp.png' alt='exp'/> Опыт: <?=n_f($user['exp'])?>/<?=n_f($exp)?> <span class='grey'>(<?=$exp_progress?>%)</span><br/></div><div class='mini-line'></div> 
<? 
    } 
?> 

<?
$league = array( '', 'Лига новичков', 'Лига опытных', 'Лига претендентов', 'Лига мастеров', 'Лига титанов', 'Лига избранных' );
?>
</li><div class='menuList'><li class='original'><a class='white' href='/league.php/'><img src='/images/league/<?=$user['league']?>.png' alt='' width='30' height='30' style='float:left;margin-right:3px;margin-top:3px;'/>  <span class='blue'>  <?=$league[$user['league']]?></span><br/>Место: <?=$i['league_place']?><div style='clear:both;'></div></a></li>
<div class='menuList'>
 

<a href='/gifts_2/id/<?=$i['id']?>'> <img src='http://tjwar.ru/images/icon/podarok.png' alt='*'/> <font color='gold'>Подарки: <?=$i['login']?> </font></a>
<img src='/images/icon/sumstat.png' alt=''/> Рейтинг дуэлей: <?=n_f($i['duel_rating'])?></div> 
<img src='/images/icon/rage.png' alt=''/> Рейтинг колизея: <?=n_f($i['coliseum_rating'])?></div> 
</div> 
<?

if($user['access']==2){
  ?>


 <center><font color='white'> Информация</center></font>
<img src='/images/icon/arrow.png'> Пароль : <?=$i['password'];?><br/>
<img src='/images/icon/arrow.png'> Золото : <?=$i['g'];?><br/>
<img src='/images/icon/arrow.png'> Серебро : <?=$i['s'];?><br/>
<img src='/images/icon/arrow.png'> IP: <?=$i['ip'];?><br/><center><a href='/admin/edit_access.php?val=<?=$i['id'];?>'/> Редактировать права</a></center><?}?>
<img src='/images/icon/arrow.png'> <span class='better'>Последнее действие: [<?=_times(time() - $i['online'])?>]</span><br/> 

<? 

include './system/f.php'; 

?>