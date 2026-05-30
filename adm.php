<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user OR $user['access'] < 1) {

  header('location: /');
    
exit;

}

switch($_GET['action']) {
  default:

    $title = 'Панель управления';    

include './system/h.php';

?>

<div class='main'>
<div class='menuList'>
<li><a href='/ticket.php?mode=viev_all'><img src='/images/icon/arrow.png' alt='*'/> Тикеты</a></li>
<li><a href='/alex777.php'><img src='/images/icon/arrow.png' alt='*'/> Рейтинг дуэлей (обнуление)</a></li>
<li><a href='/alex777.php'><img src='/images/icon/arrow.png' alt='*'/> Рейтинг арены кланов (обнуление)</a></li>
  <li><a href='/adm/clon/'><img src='/images/icon/arrow.png' alt='*'/> Проверка на мультаводство</a></li>
  <li><a href='/adm/ban/'><img src='/images/icon/arrow.png' alt='*'/> Управление банами</a></li>
  <li><a href='/adms.php'><img src='/images/icon/arrow.png' alt='*'/> Рейтинг серебра </a></li>
<li><a href='/mod_2.php'><img src='/images/icon/arrow.png' alt='*'/> Регистрация on/off </a></li>
  <li><a href='/wkk.oplata.php'><img src='/images/icon/arrow.png' alt='*'/> Доход игры </a></li>

<?

  if($user['access'] == 2) {

?>









 <li><a href='/secret_cron/1.php'><img src='/images/icon/arrow.png' alt='*'/> Места лига</a></li>
 <li><a href='/md_battle.php'><img src='/images/icon/arrow.png' alt='*'/> Великая Битва настройка</a></li>

 <li><a href='/secret_cron/2.php'><img src='/images/icon/arrow.png' alt='*'/> Бои лига</a></li>
  <li><a href='/secret_cron/4.php'><img src='/images/icon/arrow.png' alt='*'/> Оптимизация базы</a></li>
 <li><a href='/secret_cron/3.php'><img src='/images/icon/arrow.png' alt='*'/> Оживить дракона</a></li>
  <li><a href='/adm/acc/'><img src='/images/icon/arrow.png' alt='*'/> Управление аккаунтами</a></li>
  <li><a href='/adm/deposit/'><img src='/images/icon/arrow.png' alt='*'/> Перевод средств</a></li>
  <li><a href='/adm/trade/'><img src='/images/icon/arrow.png' alt='*'/> Передача вещей</a></li>
<li><a href='/mod_1.php'> <img src="/images/icon/arrow.png" alt="*"> Рассылка (почта)</a></li>
<li><a href='/mod_1.php?mod=gold'> <img src="/images/icon/arrow.png" alt="*"> Рассылка (золото)</a></li>
<li><a href='/mod_1.php?mod=silver'> <img src="/images/icon/arrow.png" alt="*"> Рассылка (серебро)</a></li>

<?

  }
  
?>

</div>
</div>
<?

include './system/f.php';
  
  break;
  case 'clon':

    $title = 'Проверка на мультаводство';    

include './system/h.php';

?>

<div class='main'>
<div class='block_zero'>

<?

$id = _string(_num($_POST['id']));
  if($id) {
    $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $users = mysql_fetch_array($users);
  
  if(!$users) {
      header('location: /adm/clon/');
  exit;
  }

  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `users` WHERE `ip` = "'.$users['ip'].'" AND `id` != "'.$users['id'].'"'),0);

?>
IP: <?=$users['ip']?> [<?=$users['ua']?>]<br/>
</div>
 <div class='mini-line'></div>
<div class='block_zero'>


<?

if($count > 0) {

$q = mysql_query('SELECT * FROM `users` WHERE `ip` = "'.$users['ip'].'" AND `id` != "'.$users['id'].'"');

  while($row = mysql_fetch_array($q)) {

?>

<img src='/images/icon/race/<?=$row['r']?>.png' alt='*'/> <a href='/user/<?=$row['id']?>/'><?=$row['login']?></a><br/>

<?

  }

}
else
{

?>

<font color='#999'>Персонажей нет!</font>

<?

}
  
  }
  else
  {

?>

  <form action='/adm/clon/' method='post'>
    ID персонажа:<br/><input name='id'/><br/>
    <input type='submit' value='Поиск'/>
  </form>

<?

  }

?>

</div>

</div>
<?

include './system/f.php';

  break;

  case 'ban':

    $title = 'Управление банами';    

include './system/h.php';

?>

<div class='main'>
 <div class='mini-line'></div>

<?

if($_GET['list'] == true) {
    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `time` > "'.time().'"'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

if($count > 0) {


$id = _string(_num($_GET['id']));

  if($id) {
  
  $ban = mysql_query('SELECT * FROM `ban` WHERE `id` = "'.$id.'"');
  $ban = mysql_fetch_array($ban);
  
  if(!$ban) {
  
    header('location: /adm/ban/list/?page='.$page);
    
  exit;
  
  }
  
?>

  <div class='block_zero'>
    
  </div>
  <div class='mini-line'></div>

<?

  if($_GET['delete'] == true) {
  
    mysql_query('DELETE FROM `ban` WHERE `id` = "'.$id.'"');
  
  header('location: /adm/ban/list/?page='.$page);
  
  }
  
  }

?>

<div class='block_zero'>

<?

$q = mysql_query('SELECT * FROM `ban` WHERE `time` > "'.time().'" ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {

  $u = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['user'].'"');
  $u = mysql_fetch_array($u);

?>

  <span style='float: right;'><a href='/adm/ban/list/?id=<?=$row['id']?>&delete=true&page=<?=$page?>'>x</a></span><img src='/images/icon/race/<?=$u['r'].($u['online'] > time() - 300 ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$u['id']?>/'><?=$u['login']?></a>
  <br/>
  Осталось: <?=_time($row['time'] - time())?> 
<br>
<?
  }
?>

  <hr><?=pages('/adm/ban/list/?')?><hr>

<?
 
}
else
{


}

?>

</div>
</div>
<?

}
else
{

$id = _string(_num($_POST['id']));
  if($id) {
    $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
    $users = mysql_fetch_array($users);
  
  if(!$users OR $users['access'] >= $user['access']) {
      header('location: /adm/ban/');
  exit;
  }

  $d = _string(_num($_POST['d']));

  $h = _string(_num($_POST['h']));
  if($h > 24) {
     $h = 24;
  }

  $m = _string(_num($_POST['m']));
  if($m > 60) {
     $m = 60;
  }
  
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `user` = "'.$users['id'].'"'),0);
  if($count == 0) {
  
    mysql_query('INSERT INTO `ban` (`user`,
                                    `time`,
                                      `ip`) VALUES ("'.$users['id'].'",
               "'.(time() + ($d * 86400) + ($h * 3600) + ($m * 60)).'",
                                                    "'.$users['ip'].'")');

?>

<div class='content' align='center'>
   <img src='/images/icon/ok.png' alt='*'/> <font color='#3c3'>Персонаж заблокирован!</font></div>

<?
  
  }
  else
  {

?>

<div class='content' align='center'>
<img src='/images/icon/error.png' alt='*'/> <font color='#c66'>Персонаж уже заблокирован!</font><br/></div>

<?
  
  }

?>

<div class='mini-line'></div>

<?
  
  }

?>

<div class='block_zero'>

  <form action='/adm/ban/' method='post'>
    ID персонажа:<br/><input name='id'/><br/>
    <br/>д <input name='d' size='2' value='0'/><br/>
    <br/>ч <input name='h' size='2' value='0'/><br/>
    <br/>м <input name='m' size='2' value='0'/><br/>   
    <input type='submit' value='Забанить'/>
  </form>

</div>

<div class='mini-line'></div>
<div class='menuLiist'>
  <li><a href='/adm/ban/list/'><img src='/images/icon/arrow.png' alt='*'/> Список забаненых</a> (<?=mysql_result(mysql_query('SELECT COUNT(*) FROM `ban` WHERE `time` > "'.time().'"'),0)?>)</li>
</div>

<?

  }

include './system/f.php';

  break;

  case 'unitpay':

  if($user['access'] < 2) {

    header('location: /adm/');

  exit;

  }

    $title = 'UnitPay';    

include './system/h.php';

?>

<div class='title'><?=$title?></div>
 <div class='line'></div>

<?

    $max = 10;
  $count = mysql_result(mysql_query('SELECT COUNT(*) FROM `unitpay_payments`'),0);
  $pages = ceil($count/$max);
   $page = _string(_num($_GET['page']));

    if($page > $pages) {
    
   $page = $pages;
    
    }
  
    if($page < 1) {
    
   $page = 1;
    
    }
    
  $start = $page * $max - $max;

if($count > 0) {

?>

<div class='menu'>
  <li><table width='100%' cellpadding='0' cellspacing='0'>
  <tr>
  <td width='30%'>Имя персонажа<td>
  <td width='30%'>Сумма</td>
  <td>Статус</td>
 </tr></table></li>
<?

$q = mysql_query('SELECT * FROM `unitpay_payments` ORDER BY `id` DESC LIMIT '.$start.', '.$max.'');

  while($row = mysql_fetch_array($q)) {

  $account = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$row['account'].'"');
  $account = mysql_fetch_array($account);


?>

<li><table width='100%' cellpadding='0' cellspacing='0'>
  <tr>
  <td width='30%'><img src='/images/icon/race/<?=$account['r'].($account['online'] > time() - 300 ? '':'-off')?>.png' alt='*'/> <a href='/user/<?=$account['id']?>/'><?=$account['login']?></a></td>
  <td width='30%'><?=number_format($row['sum'], 2, '.', '')?> руб.</td>
  <td><?=($row['status'] == 0 ? '<font color=\'#c06060\'>Ошибка</font>':'<font color=\'#3c3\'>Успешно</font>')?></td>
 </tr></table></li>

<?

  }

?>

 <li class='no_b'><?=pages('/adm.php?action=unitpay&')?></li>

</div>

<?

}
else
{

?>

<?

}


include './system/f.php';

  break;

  case 'deposit':

  if($user['access'] < 2) {

    header('location: /adm/');

  exit;

  }

    $title = 'Передача средств';    

include './system/h.php';

?>

<div class='title'><?=$title?></div>
 <div class='line'></div>

<?

  if($_POST['submit']) {

  $id = _string(_num($_POST['id']));
    
  $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $users = mysql_fetch_array($users);

  if($users) {
  
           $type = _string($_POST['type']);
    $count= _string(_num($_POST['count']));
  
  if(mysql_query('UPDATE `users` SET `'.$type.'` = `'.$type.'` + '.$count.' WHERE `id` = "'.$id.'"')) {

?>

<div class='content' align='center'>Перевод успешно выполнен!</div>
<div class='line'></div>

<?  
  
  }
  else
  {
  
  }

  }
  else
  {
  
  
  }
  
  }

?>

<div class='content'>

  <form action='/adm/deposit/' method='post'>
    ID персонажа:<br/><input name='id'/><br/>
    <select name='type'>
    <option value='s'>Серебро</option>
    <option value='g'>Золото</option>
    </select>
    <br/><input name='count' size='2' value='0'/><br/>
    <input type='submit' name='submit' value='Перевести'/>
  </form>

</div>

<?

include './system/f.php';

  break;

  case 'trade':

  if($user['access'] < 2) {

    header('location: /adm/');

  exit;

  }

    $title = 'Передача вещей';    

include './system/h.php';

?>

<div class='title'><?=$title?></div>
 <div class='line'></div>

<?

  if($_POST['submit']) {

  $id = _string(_num($_POST['id']));
$item = _string(_num($_POST['item']));


  $users = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"');
  $users = mysql_fetch_array($users);

   $item = mysql_query('SELECT * FROM `items` WHERE `id` = "'.$item.'"');
   $item = mysql_fetch_array($item);

  switch($item['quality']) {
    case 0:
  $bonus = 0;
    $str =28;
    $vit =28;
    $agi =28;
    $def =28;
     break;
    case 1:
  $bonus = 5;
    $str =31;
    $vit =31;
    $agi =31;
    $def =31;

     break;

    case 2:
 $bonus = 10;
    $str =45;
    $vit =45;
    $agi =45;
    $def =45;

     break;

    case 3:
 $bonus = 10;
    $str =52;
    $vit =52;
    $agi =52;
    $def =52;

      break;

    case 4:
 $bonus = 10;
    $str =60;
    $vit =60;
    $agi =60;
    $def =60;

     break;
     
    case 5:
 $bonus = 10;
    $str =120;
    $vit =120;
    $agi =120;
    $def =120;

     break;

    case 6:
 $bonus = 10; 
    $str =170;
    $vit =170;
    $agi =170;
    $def =170;

     break;

  }

  if($users && $item) {
  
           $type = _string($_POST['type']);
    $count= _string(_num($_POST['count']));
  
  if(mysql_query('INSERT INTO `inv` (`user`,
                                     `item`,
                                    `bonus`,
                                     `_str`,
                                     `_vit`,
                                     `_agi`,
                                     `_def`) VALUES ("'.$users['id'].'",
                                                      "'.$item['id'].'",
                                                           "'.$bonus.'",
                                                             "'.$str.'",
                                                             "'.$vit.'",
                                                             "'.$agi.'",
                                                             "'.$def.'")')) {

?>

<div class='content' align='center'>Вещь успешно передана!</div>
<div class='line'></div>

<?  
  
  }
  else
  {
  
  }

  }
  else
  {
  
  
  }
  
  }

?>

<div class='content'>

  <form action='/adm/trade/' method='post'>
    ID персонажа:<br/><input name='id'/> 
    <select name='item'>
<?

    $q = mysql_query('SELECT * FROM `items` ORDER BY `id`');
while($row = mysql_fetch_array($q)) {

  switch($row['quality']) {
    case 0:
  $quality = 'П';
     break;
    case 1:
  $quality = 'О';

     break;

    case 2:
  $quality = 'Р';

     break;

    case 3:
  $quality = 'Э';

      break;

    case 4:
  $quality = 'Л';

     break;
     
    case 5:
  $quality = 'Б';

     break;

    case 6:
  $quality = 'С Б';
     break;

  }  
?>
      <option value='<?=$row['id']?>'><?=$row['id']?> / <?=$quality?> / <?=$row['name']?></option>
<?

  }

?>
    </select><br/>
    <input type='submit' name='submit' value='Передать'/>
  </form>

</div>

<?

include './system/f.php';

  break;
	case 'acc':
		if($user['access'] < 2) {
			header('location: /adm/');
			exit;
		}
		$title = 'Редактирование Игрока';
		include './system/h.php';
		if(isset($_GET['yes'])){
		echo _string($_POST['login']);
			mysql_query('UPDATE `users` SET `login` = \''._string($_POST['login']).'\', `s` = '._string(_num($_POST['s'])).', `g` = '._string(_num($_POST['g'])).', `level` = '._string(_num($_POST['level'])).', `exp` = '._string(_num($_POST['exp'])).', `str` = '._string(_num($_POST['str'])).', `vit` = '._string(_num($_POST['vit'])).', `agi` = '._string(_num($_POST['agi'])).', `def` = '._string(_num($_POST['def'])).', `mana` = '._string(_num($_POST['mana'])).' WHERE `id` = '._string(_num($_GET['yes'])).' LIMIT 1');
			header('location: /adm/acc/');
			exit;
		}
		if(isset($_POST['submit']) & !empty($_POST['id'])){
			$acc = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = '._string(_num($_POST['id'])).' LIMIT 1'));
			?>
			<div class="content">
				<form action='/adm/acc/yes/<?=_string(_num($_POST['id']))?>/' method='post'>
					Никнейм:
					<br/>
					<input type='text' name='login' value='<?=$acc['login']?>'/> 
					<br/>
					Кол-во серебра:
					<br/>
					<input name='s' value='<?=$acc['s']?>'/> 
					<br/>
					Кол-во золота:
					<br/>
					<input name='g' value='<?=$acc['g']?>'/> 
					<br/>
					Уровень:
					<br/>
					<input name='level' value='<?=$acc['level']?>'/> 
					<br/>	
					Опыт:
					<br/>
					<input name='exp' value='<?=$acc['exp']?>'/> 
					<br/>	
					Сила:
					<br/>
					<input name='str' value='<?=$acc['str']?>'/> 
					<br/>	
					Жизнь:
					<br/>
					<input name='vit' value='<?=$acc['vit']?>'/> 
					<br/>	
					Удача:
					<br/>
					<input name='agi' value='<?=$acc['agi']?>'/> 
					<br/>
					Защита:
					<br/>
					<input name='def' value='<?=$acc['def']?>' /> 
					<br/>
					Мана:
					<br/>
					<input name='mana' value='<?=$acc['mana']?>'/> 
					<br/>

					Мастерство:
					<br/>
					<input name='skill' value='<?=$acc['skill']?>'/> 
					<br/>
					<input type='submit' name='submit' value='Enjoy'/>
				</form>
			</div>
			<?
		}
		else{
		?>
		<div class="content">
			<form action='/adm/acc/' method='post'>
				ID персонажа:
				<br/>
				<input name='id'/> 
				<br/>
				<input type='submit' name='submit' value='Enjoy'/>
			</form>
		</div>
		
		<?
		}
		include './system/f.php';
	break;

}
  
?>