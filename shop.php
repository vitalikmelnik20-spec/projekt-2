<?
include './system/common.php';
include './system/functions.php';
include './system/user.php';

if(!$user) {
header('location: /');
exit;
}

$title = 'Магазин снаряжения';    
include './system/h.php';  

$buy_complect = _string(_num($_GET['buy_complect']));

    if($buy_complect) {

    if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `place` = "0" AND `user` = "'.$user['id'].'" AND `equip` = "0"'),0) + 8 > 20) {
      header('location: /shop/');
    exit;
    }
    
    $complect = mysql_query('SELECT * FROM `complects` WHERE `id` = "'.$buy_complect.'"');
    $complect = mysql_fetch_array($complect);
    
    switch($complect['quality']) {
      case 1:
      $complect_quality_skill =   1;
       break;
      case 2:
      $complect_quality_skill =  10;
       break;
      case 3:
      $complect_quality_skill =  24;
       break;
      case 4:
      $complect_quality_skill =  48;
       break;
      case 5:
      $complect_quality_skill = 200;
       break;
      case 6:
      $complect_quality_skill = 250;
       break;
	case 7:
      $complect_quality_skill = 10;
       break;
	}
    
    if(!$complect OR $complect_quality_skill > $user['skill']) {
      header('location: /shop');
    exit;
    }
    
    $cost = 0;
    
    for($w = 1; $w < 9; $w++) {
      $shop = mysql_query('SELECT * FROM `shop` WHERE `id` = "'.$complect['w_'.$w].'"');
      $shop = mysql_fetch_array($shop);
    $cost +=$shop['cost'];
    }
    
    $cost -= round(($cost / 100) * 25);
    
    if($user['g'] < $cost) {
      header('location: /shop/');
    exit;
    }

    mysql_query('UPDATE `users` SET `g` = "'.($user['g'] - $cost).'" WHERE `id` = "'.$user['id'].'"');

    for($w = 1; $w < 9; $w++) {
    
      $shop = mysql_query('SELECT * FROM `shop` WHERE `id` = "'.$complect['w_'.$w].'"');
      $shop = mysql_fetch_array($shop);
    
    
      mysql_query('INSERT INTO `inv` (`user`,
                                      `item`,
                                     `bonus`,
                                      `_str`,
                                      `_vit`,
                                      `_agi`,
                                      `_def`) VALUES ("'.$user['id'].'",
                                                      "'.$shop['id'].'",
                                                   "'.$shop['bonus'].'",
                                                    "'.$shop['_str'].'",
                                                    "'.$shop['_vit'].'",
                                                    "'.$shop['_agi'].'",
                                                    "'.$shop['_def'].'")');
    
    }
    
      header('location: /inv/bag/');
    
    }






$buy_item = _string(_num($_GET['buy_item']));
if($buy_item) {

  $itemshop = mysql_fetch_array(mysql_query('SELECT * FROM `shop` WHERE `id` = \''.$buy_item.'\''));
  
  if(mysql_result(mysql_query('SELECT COUNT(*) FROM `inv` WHERE `place` = \'0\' AND `user` = \''.$user['id'].'\' AND `equip` = \'0\''),0) + 1 > 20) $errors[] = 'Ошибка, ваша сумка заполнена';
  
  if($itemshop['cost'] > $user['g']) $errors[] = 'Ошибка, не хватает <img src=\'/images/icon/g.png\' alt=\'*\'/> '.($itemshop['cost'] - $user['g']).' золота<div class=\'separator\'></div><a href=\'/trade/\' class=\'btn\'><span class=\'end\'><span class=\'label\'>Купить</a></span></span>';  
  
  if($errors) {
      
        echo '<div class=\'main\' align=\'center\'>';
        
        foreach($errors as $error) {
          
          echo $error.'<br/>';
          
        }
      
        echo '</div>
<div class=\'mini-line\'></div>';
      
  }
  else
  {

    mysql_query('UPDATE `users` SET `g` = `g` - '.$itemshop['cost'].' WHERE `id` = \''.$user['id'].'\'');
  
    mysql_query('INSERT INTO `inv` (`user`,
                                    `item`,
                                  `quality`,
                                   `bonus`,
                                    `_str`,
                                    `_vit`,
                                    `_agi`,
                                    `_def`,
                                   `place`) VALUES (\''.$user['id'].'\',
                                                \''.$itemshop['id'].'\',
                                           \''.$itemshop['quality'].'\',
                                             \''.$itemshop['bonus'].'\',
                                              \''.$itemshop['_str'].'\',
                                              \''.$itemshop['_vit'].'\',
                                              \''.$itemshop['_agi'].'\',
                                              \''.$itemshop['_def'].'\',
                                                                  \'0\')');

    header('location: /inv/bag/');
  
  }
  
}



$quality = _string(_num($_GET['quality']));
if($quality) {

  if($quality == 1 && $user['skill'] < 1 OR $quality == 2 && $user['skill'] < 10 OR $quality == 3 && $user['skill'] < 24 OR $quality == 4 && $user['skill'] < 48 OR $quality == 5 && $user['skill'] < 200 OR $quality == 6 && $user['skill'] < 250) {
    
      header('location: /shop/');
      exit;
    
  }

  $q = mysql_query('SELECT * FROM `complects` WHERE `quality` = \''.$quality.'\'');    
  while($row = mysql_fetch_array($q)) {
echo'<div class=\'main\'>';
    echo '<div class=\'menuList\'><li> <a href=\'/complect/'.$row['id'].'/\'><img src=\'/images/icon/quality/'.$row['quality'].'.png\' alt=\'*\'/>'.$row['name'].'</a></li></small>
 
 <div class=\'main\' align=\'center\'>
    <a href=\'/complect/'.$row['id'].'/\'><img src=\'/manekenImage/'.$user['sex'].'/'.$row['w_1'].'/'.$row['w_2'].'/'.$row['w_3'].'/'.$row['w_4'].'/'.$row['w_5'].'/'.$row['w_6'].'/'.$row['w_7'].'/'.$row['w_8'].'/\'/></a>
  
<div class=\'dot-line\'></div></div></div></div></div></div>';


      
  }

 echo'<div class=\'main\'><div class=\'menuList\'><li><a href=\'/shop/\'><img src=\'/images/icon/equip.png\' alt=\'\'/>Магазин снаряжения</a></li></div></div>'; 

}else{
?>

<div class="block_zero center blue">Лучшее снаряжение только тут!</div>
<div class="mini-line"></div>
<div class="center"><div class="block_zero"><img src="/images/town/hd/shop.jpg" alt="" width="100%"></div></div>

 <?
if($user['skill'] > 249) {
echo '
<div class="mini-line"></div>
<div class="menuList">
<li class="original">
<a class="white" href="/shop/6/"><img src="/images/icon/grade/big/6.png" alt="" style="float:left;margin-right:3px;margin-top:3px;" height="30" width="30"><img src="http://tiwar.ru/images/icon/grade/6.png" alt=""><span class="quality-6">Титанические вещи</span>
<br>
<span class="medium"><img src="/images/icon/skill.png" alt="">Мастерство: 250</span><div style="clear:both;"></div></a>
</li>
</div>
';
}

if($user['skill'] > 199) {
echo '
<div class="mini-line"></div>
<div class="menuList">
<li class="original">
<a class="white" href="/shop/5/"><img src="/images/icon/grade/big/5.png" alt="" style="float:left;margin-right:3px;margin-top:3px;" height="30" width="30"><img src="http://tiwar.ru/images/icon/grade/5.png" alt=""><span class="quality-5">Божественные вещи</span>
<br>
<span class="medium"><img src="/images/icon/skill.png" alt="">Мастерство: 200</span><div style="clear:both;"></div></a>
</li>
</div>
';
}

if($user['skill'] > 47) {
echo '
<div class="mini-line"></div>
<div class="menuList">
<li class="original">
<a class="white" href="/shop/4/"><img src="/images/icon/grade/big/4.png" alt="" style="float:left;margin-right:3px;margin-top:3px;" height="30" width="30"><img src="http://tiwar.ru/images/icon/grade/4.png" alt=""><span class="quality-4">Легендарные вещи</span>
<br>
<span class="medium"><img src="/images/icon/skill.png" alt="">Мастерство: 48</span><div style="clear:both;"></div></a></li>
</div>
';
}

if($user['skill'] > 23) {
echo '
<div class="mini-line"></div>
<div class="menuList">
<li class="original">
<a class="white" href="/shop/3/"><img src="/images/icon/grade/big/3.png" alt="" style="float:left;margin-right:3px;margin-top:3px;" height="30" width="30"><img src="http://tiwar.ru/images/icon/grade/3.png" alt=""><span class="quality-3">Эпические вещи</span>
<br>
<span class="medium"><img src="/images/icon/skill.png" alt="">Мастерство: 24</span><div style="clear:both;"></div></a></li>
</div>
';
}

if($user['skill'] > 9) {
echo '
<div class="mini-line"></div>
<div class="menuList">
<li class="original">
<a class="white" href="/shop/2/"><img src="/images/icon/grade/big/2.png" alt="" style="float:left;margin-right:3px;margin-top:3px;" height="30" width="30"><img src="http://tiwar.ru/images/icon/grade/2.png" alt=""><span class="quality-2">Редкие вещи</span>
<br>
<span class="medium"><img src="/images/icon/skill.png" alt="">Мастерство: 10</span><div style="clear:both;"></div></a></li>
</div>
';
}

if($user['skill'] > 0) {
echo '
<div class="mini-line"></div>
<div class="menuList">
<li class="original">
<a class="white" href="/shop/1/"><img src="/images/icon/grade/big/1.png" alt="" style="float:left;margin-right:3px;margin-top:3px;" height="30" width="30"><img src="http://tiwar.ru/images/icon/grade/1.png" alt=""><span class="quality-1">Обычные вещи</span>
<br>
<span class="medium"><img src="/images/icon/skill.png" alt="">Мастерство: 1</span><div style="clear:both;"></div></a></li>
</div>
';
}

echo '
<div class="mini-line"></div>
<div class="block_zero center">
<span class="dgreen">Собери свой уникальный комплект!</span>
<div class="mb10"></div>
<a class="btn" href="/maneken.php"><span class="end"><span class="label">Примерочная</span></span></a>
</div>
<div class="mini-line"></div>
';

echo '
<div class="block_zero">
<img src="/images/icon/skill.png" alt=""> Мастерство: <b>'.$user['skill'].'</b>
<ul class="hint">
<li>Мастерство можно повысить, прокачивая параметры в <img src="/images/icon/train.png" alt=""> <a href="/train/">Тренировке</a></li>
</ul>
</div>
';
}
include './system/f.php';
?>