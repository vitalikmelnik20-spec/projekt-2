<?

include $_SERVER['DOCUMENT_ROOT'].'/system/common.php';
include $_SERVER['DOCUMENT_ROOT'].'/system/functions.php';
include $_SERVER['DOCUMENT_ROOT'].'/system/user.php';
$title = 'Кузница. Перенести руну';
include $_SERVER['DOCUMENT_ROOT'].'/system/h.php';   

    if(!isset($user) OR !isset($_SESSION['item'])) {
		echo 'Ошибка';
		exit;
	 }
	 
	 $itemList = array(
	 
	 'quality' => array(0 => 'Простой', 1 => 'Обычный', 2 => 'Редкий', 3 => 'Эпический', 4 => 'Легенарный', 5 => 'Божественный', 6 => 'Сверх Божественный'),
	 'quality_color' => array(0 => '#986', 1 => '#6c3', 2 => '#69c', 3 => '#c6f', 4 => '#f60', 5 => '#999', 6 => '#999'),
	 'bonus' => array(0 => '0', 1 => '5', 2 => '10', 3 => '15', 4 => '20', 5 => '50', 6 => '65'),
	 'w' => array(1 => '_str', 2 => '_vit', 3 => '_def', 4 => '_agi', 5 => '_str', 6 => '_str', 7 => '_def', 8 => '_vit'),
	 'rune_name' => array(1 => 'силы', 2 => 'жизни', 3 => 'жизни', 4 => 'удачни', 5 => 'силы', 6 => 'силы', 7 => 'брони', 8 => 'жизни'),
	 'rune_stats' => array(1 => '75', 2 => '150', 3 => '250', 4 => '600', 5 => '1000', 6 => '2000', 7 => '3000'),
	 
	 
	 );
	 
  $inv = mysql_fetch_array(mysql_query("SELECT * FROM `inv` WHERE `id` = ".$_SESSION['item'].""));
  $item = mysql_fetch_array(mysql_query("SELECT * FROM `items` WHERE `id` = ".$inv['item'].""));
   
			  ?>
			  <div class='title'><?=$title?></div>
			  <div class='line'></div>
			  <div class='menu'>
			  
			  <li align='center'><img src='/images/town/rune.png' alt='*'/></li>
			  <li class='no_b' align='center'><font color='#9bc'>Выберете вещь на которую хотите перенести руну!</font></li>
			  </div><div class='line'></div>
			  
			  <div class='content'>
			  <font color='#90c090'>Выбраная вещь для переноса руны:</font>
			  </div>
			  <div class='line'></div>
			  
			  <div class='menu'>
			  <li><table cellpadding="0" cellspacing="0">
			  <tr><td><img src="/itemImage.php?id=<?=$item['id'];?>" alt="*"/></td>
			  <td valign="top" style="padding-left: 5px;"><img src="/images/icon/quality/<?=$item['quality'];?>.png" alt="*"/> 
			  <a href="/item/<?=$inv['id'];?>/"><?=$item['name'];?></a> <?=($inv['smith'] > 0 ? '<font color=\'#90c090\'>+'.$inv['smith'].'</font>':'');?>
			  <br/><small>
			  <font color="<?=$itemList['quality_color'][$item['quality']];?>"> <?=$itemList['quality'][$item['quality']];?>
			  [<?=$inv['bonus'];?>/<?=$itemList['bonus'][$item['quality']];?>]</font></small>
			  <?
			  if($inv['rune'] > 0) {
				 ?>
				   <br /><img src="/images/icon/quality/<?=$inv['rune'];?>.png" alt="*"/><font color="#9c9"> +<?=$itemList['rune_stats'][$inv['rune']];?></font> <?=$itemList['rune_name'][$item['w']];?>
                 <?				 
			  }
			  ?>
			  </td></tr></table>
			  </div>
			  </div>
			  <div class='line'></div><div class='content'>
			  <?=(isset($_GET['wiew']) ? 'Перенести на вешь' : 'Список вещей');?>:</div>
			  <div class='line'></div>
			  <?
			  if(isset($_GET['wiew'])) {
				  
				  $id = _string(_num($_GET['id']));
				  
				  	$wiew_inv = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$id.'" AND `user` = "'.$user['id'].'" AND `equip` = "0" AND `rune` = "0"'));
					$wiew_items = mysql_fetch_array(mysql_query("SELECT * FROM `items` WHERE `id` = ".$wiew_inv['item'].""));
   
					
					if(!$wiew_inv OR $wiew_items['quality'] < $item['quality']) {
						header('Location: /inv/bag/');
						exit;
					}
					
					if(isset($_GET['confirm'])) {
						
						if(isset($_GET['send'])) {
														
						mysql_query("UPDATE `inv` SET `rune` = '".$inv['rune']."', `{$itemList['w'][$wiew_items['w']]}` = `{$itemList['w'][$wiew_items['w']]}` + ".$itemList['rune_stats'][$inv['rune']]." WHERE `id` = ".$id."");
						
						mysql_query("DELETE FROM `inv` WHERE `id` = ".$_SESSION['item']."");
						unset($_SESSION['item']);
							
						header('Location: /inv/bag/');
						exit;
						

						}
						
						?>
						<div class='content'>
						Вы уверены что хотите перенести руну на <img src="/images/icon/quality/<?=$wiew_items['quality'];?>.png" alt="*"/> <?=$wiew_items['name'];?> ?
						<div class='separator'></div>
						<center>
						<a href='/SendRune/?wiew&id=<?=$wiew_inv['id'];?>&confirm&send' class='button'>Да</a> / <a href='/SendRune/?wiew&id=<?=$wiew_inv['id'];?>' class='button'>Нет</a>
						</center>
						</div><div class='line'></div>
						<div class='content'>* Вещь с которой вы сделаете перенос пропадёт.</div></div><div class='line'></div>
				        <div class='list'><li><a href='/SendRune/'><img src='/images/icon/arrow.png' alt='*'/> Списко вещей</a></li></div></div>
						<?
						include $_SERVER['DOCUMENT_ROOT'].'/system/f.php'; 
						exit;
					}
					
				  ?>
				  
			  <div class='menu'>
			  <li><table cellpadding="0" cellspacing="0">
			  <tr><td><img src="/itemImage.php?id=<?=$wiew_items['id'];?>" alt="*"/></td>
			  <td valign="top" style="padding-left: 5px;"><img src="/images/icon/quality/<?=$wiew_items['quality'];?>.png" alt="*"/> 
			  <a href="/item/<?=$wiew_inv['id'];?>/"><?=$wiew_items['name'];?></a> <?=($wiew_inv['smith'] > 0 ? '<font color=\'#90c090\'>+'.$wiew_inv['smith'].'</font>':'');?>
			  <br/><small>
			  <font color="<?=$itemList['quality_color'][$wiew_items['quality']];?>"> <?=$itemList['quality'][$wiew_items['quality']];?>
			  [<?=$inv['bonus'];?>/<?=$itemList['bonus'][$wiew_items['quality']];?>]</font></small>
			  <br /><img src="/images/icon/quality/<?=$inv['rune'];?>.png" alt="*"/><font color="#9c9"> +<?=$itemList['rune_stats'][$inv['rune']];?></font> <?=$itemList['rune_name'][$wiew_items['w']];?>
			  </td></tr></table>
			  </div>
			  </div>
			  <div class='line'></div>
			  <div class='content' align='center'><a href='/SendRune/?wiew&id=<?=$wiew_inv['id'];?>&confirm' class='button'>Перенести руну</a></div>
			  </div><div class='line'></div>
				 
				 <?
				  
			  }else{
			  $i = 0;
			  $q = mysql_query("SELECT `items`.*, `inv`.* FROM `inv` LEFT JOIN `items` ON `items`.`id` = `inv`.`item` WHERE `inv`.`user` = ".$user['id']." AND `inv`.`equip` = '0' AND `inv`.`rune` = '0' ORDER BY `inv`.`quality` DESC LIMIT 7");
			  while($row = mysql_fetch_array($q)) {
				  
				   		  
				  if($row['quality'] >= $item['quality']) {
					  
					  ++$i;
				  
				  ?>
			        <div class='menu'>
			        <li><table cellpadding="0" cellspacing="0">
			        <tr><td><img src="/itemImage.php?id=<?=$row['item'];?>" alt="*"/></td>
			        <td valign="top" style="padding-left: 5px;"><img src="/images/icon/quality/<?=$row['quality'];?>.png" alt="*"/> 
			        <a href="/item/<?=$row['id'];?>/"><?=$row['name'];?></a> <?=($row['smith'] > 0 ? '<font color=\'#90c090\'>+'.$row['smith'].'</font>':'');?>
			        <br/><small><font color="<?=$itemList['quality_color'][$row['quality']];?>"> <?=$itemList['quality'][$row['quality']];?>
					[<?=$row['bonus'];?>/<?=$itemList['bonus'][$row['quality']];?>]</font></small>
					</td></tr></table></div></div><div class='line'></div>
					<div class='content' align='center'><a href='/SendRune/?wiew&id=<?=$row['id'];?>' class='button'>Выбрать</a></div>
					</div><div class='line'></div>
				  <?
				  }
				  }
				  
				  if($i == false) {
					  ?>
					  <div class='content' align='center'>
					  У вас нет подходящих вещей для <img src='/images/icon/rune.png' alt='*'/> переноса рун<br/>
					  Вещи можно купить в <img src='/images/icon/equip.png' alt='*'/> <a href='/shop/'>Магазине</a><br/>
					  <div class='separator'></div>
					  <a href='/shop/' class='button'>Магазин снаряжения</a>
					  </div><div class='line'></div>
					  <?
				  }
			  }
				  
				  ?>
				  <div class='content'>* Вещь с которой вы сделаете перенос пропадёт.</div></div><div class='line'></div>
				  <div class='list'><li><a href='/smith/'><img src='/images/icon/arrow.png' alt='*'/> Вернуться</a></li></div></div>
				  <?
   
include $_SERVER['DOCUMENT_ROOT'].'/system/f.php'; 