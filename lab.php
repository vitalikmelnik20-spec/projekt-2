<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}

switch($_GET['action']) {
  default:
  
  $title = 'Лаборатория';    
  
  include './system/h.php';

?>

<div class='block_zero center'>
<img src='/images/town/sage.png' alt='*'/>
</div>
<div class='dot-line'></div>
<div class='block_zero center'>
<font color='#90b0c0'>В лаборатории можно усилить своего персонажа</font>
</div>
<div class='mini-line'></div>
<div class='menuList'>
<li><a href='/lab/wiz/'><img src='/images/icon/wiz.png' alt='*'/>Колдун</a></li>
<li><a href='/lab/premium/'><img src='/images/icon/premium.png' alt='*'/>Благословение</a></li>
</div>
<?

include './system/f.php';

  break;
  case 'wiz':

$title = 'Колдун';

include './system/h.php';

if($_GET['potion'] == true) {
    
  if($user['g'] < 50) $errors[] = 'Ошибка, нехватает <img src=\'/images/icon/gold.ng\' alt=\'*\'/> '.(50 - $user['g']).' золота<div class=\'separator\'></div><a href=\'/trade/\' class=\'button\'>Купить</a>';

  if($errors) {

    echo '<div class=\'error center\' align=\'center\'>';
    
    foreach($errors as $error) {
      
      echo '<img src="/images/icon/error.png"> '.$error.'<br/>';
      
    }
  

  }
  else
  {


    mysql_query('UPDATE `users` SET `g` = `g` - 50,
    
                                      `hp` = \''.($user['vit'] * 2).'\',
    
                                      `mp` = \''.$user['mana'].'\' WHERE `id` = \''.$user['id'].'\'');


    $referal = _string($_GET['referal']);
    
    if($referal) {
    
      header('location: '.$referal);

    }
    else
    {
    
      header('location: /lab/wiz/');
    
    }
  
  }

}


echo '<div class=\'block_zero\' align=\'center\'>
  <img src=\'/images/town/wizard.png\' alt=\'*\'/>
</div>
<div class=\'mini-line\'></div>
<div class=\'block_zero\'>
  <table cellpadding=\'0\' cellspacing=\'0\'>
  <tr>
  <td><img src=\'/images/alchemy/potion.png\' alt=\'*\'/></td>
  <td valign=\'top\' style=\'padding-left: 5px;\'><b>Настойка бодрости</b><br/>
  <small><small>+100% маны и жизни</small></small></td>
  </tr></table></div>
  <div class=\'block_zero center\'>
    <a href=\'/lab/wiz/?potion=true\' class=\'btn\'><span class="end"><span class="label">Купить</span></span></a><br/>
    <font color=\'#909090\'>Цена: <img src=\'/images/icon/g.png\' alt=\'*\'/> 50 золота</font></div>';

include './system/f.php';
       break;
  case 'premium':

$title = 'Благославение';

include './system/h.php';

if($_GET['buy'] == true) {
  
  if($premium) $errors[] = 'Вы уже активировали благославление';
  
  if($user['g'] < 1000) $errors[] = 'Не хватает <img src=\'/images/icon/g.png\' alt=\'*\'/> '.(1000 - $user['g']).' золота<div class=\'separator\'></div><a href=\'/trade/\' class=\'button\'>Купить</a>';
  
  if($errors) {
    
    echo '<div class=\'error center\' align=\'center\'>';
    
    foreach($errors as $error) {
      
      echo '<img src="/images/icon/error.png"> '.$error.'<br/>';
      
    }
  

  
  }
  else
  {

    mysql_query('UPDATE `users` SET `g` = `g` - 1000 WHERE `id` = \''.$user['id'].'\'');
      
    mysql_query('INSERT INTO `premium` (`user`,
                                        `time`) VALUES ("'.$user['id'].'",
                                            "'.(time() + (72 * 60* 60)).'")'); 

    mysql_query('UPDATE `users` SET `str` = `str` + 500,
                                    `vit` = `vit` + 500,
                                    `agi` = `agi` + 500,
                                    `def` = `def` + 500 
									WHERE `id` = \''.$user['id'].'\'');

    header('location: /lab/premium/');
  
  }

}

echo '<div class=\'block_zero\' align=\'center\'>
  <img src=\'/images/town/prem-'.($premium ? 'on':'off').'.png\' alt=\'*\'/></li>
</div>
<div class=\'mini-line\'></div>
<div class=\'block_zero center\'>
<font color=\'#90c090\'>+500</font> ко всем параметрам<br/>
  <font color=\'#90c090\'>+25%</font> к опыту<br/>
  <font color=\'#90c090\'>Время действия - 3 дня<br>Благословения работает только в боях</font> <br>
'.($premium ? 'Осталось: '._time($premium['time'] - time()):'<a href=\'/lab/premium/?buy=true\' class=\'btn\'><span class="end"><span class="label">Купить</span></span></a><br/>
  <font color=\'#909090\'>Цена: <img src=\'/images/icon/g.png\' alt=\'*\'/> 1000 золота</font>').'
</div>';

include './system/f.php';
       break;

}

?>