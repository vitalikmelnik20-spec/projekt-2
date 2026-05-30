<?php
/**
 * Мятеж
 * Битва начинаеться в 11:00\13:30\16:30\19:30\22:00 часа по серверу
 * 
 */

/**
 * Количество демонов
 * @var integer
 */
$demons = 25;

/**
 * Статы демона
 */
$demonsParam = ['str'=>250,
				'vit'=>1500,
				'agi'=>1500,
				'def'=>10000];
/**
 * Время на проведение мятежа минут
 * 
 */
$revoltTime = 15;


/**
 * Босс статы
 */

$boss = [	'name'=>'Demon',
			'str'=>500,
			'vit'=>36000,
			'agi'=>30000,
			'def'=>13000
		];



/**
 * Время стартов мятежа.
 */
 
		$date1 =  strtotime('11:00');
		$date2 =  strtotime('13:30');
		$date3 =  strtotime('16:30');
		$date4 =  strtotime('19:30');
		$date5 =  strtotime('22:00');
	
	if(time() <= $date1){
	$dateStart =  strtotime('11:00');
	}elseif(time() <= $date2){
	$dateStart =  strtotime('13:30');
	}elseif(time() <= $date3){
	$dateStart =  strtotime('16:30');
	}elseif(time() <= $date4){
	$dateStart =  strtotime('19:30');
	}elseif(time() <= $date5){
	$dateStart =  strtotime('22:00');
	}else{
	$dateStart = strtotime('next day 11:00');
	}



$path =  __DIR__ . '/system/';
$files =  ['common.php','functions.php','user.php','h.php'];

$title = 'Мятеж';

foreach ($files as $file)
{
	require_once $path.$file;
}




if (isset($_SESSION['m']))
{
	echo $_SESSION['m'];
	unset($_SESSION['m']);
}





$revolt = mysql_query("
		SELECT * FROM `revolt` ORDER BY `id` DESC LIMIT 1
	");
$revolt = mysql_fetch_assoc($revolt);

$revoltMember =  mysql_query("
		SELECT * FROM  `revolt_member` WHERE `revolt`='".$revolt['id']."' and `user`='".$user['id']."'
	");
$revoltMember = mysql_fetch_assoc($revoltMember);



/**
 * Старт мятежей...
 */

/**
 * Костыль для рестарта
 */
#mysql_query("TRUNCATE `revolt`");




if ($revolt['time_left'] < time())
{

	mysql_query("INSERT INTO `revolt` SET `time_start`='$dateStart',`start`='0',`time_left`='".($dateStart+(60*$revoltTime))."'");
	mysql_query("INSERT INTO `time_jurnal` SET `time`='$dateStart',`name`='revolt'");
	header("Location:/revolt/?__".uniqid());
	exit;
}



/**
 * Считаем игроков участников...
 */



$membersCounter = mysql_num_rows(mysql_query("SELECT `id` FROM `revolt_member` 
			WHERE `revolt`='".$revolt['id']."' and `dead`='0'
	"));






/**
 * Если мятеж еще не начат..
 */
if ($revolt['start'] == 0 && $revolt['time_start'] > time() && $revolt['end'] == 0 )
{

	$h =  ($revolt['time_start']-time())/3600%60;
	$m = ($revolt['time_start']-time())/60%60;
	$s = ($revolt['time_start']-time())%60;

	?>
			<div class="dot-line"></div><div class="center">
<div class="block_zero center"><img src="/images/met.gif" alt="" width="100%"></div>
			
			<br/>
			Время старта следующего мятежа: <?echo date("H:i:s ",$revolt['time_start']);?>	<br>
			На след. битву зарегистрировано игроков: <?php echo $membersCounter;?><br/>		
			Битва начнется через: <?php echo $h.':'.$m.':'.$s;?>ч.
			
			

	<?php

	if ($revoltMember)
	{

		/**
		 * Выйти из очереди мятежа.
		 */

		if (isset($_GET['exit']))
		{

			mysql_query("DELETE FROM `revolt_member` WHERE `id`='".$revoltMember['id']."'");
			header("Location:/revolt/");
			exit;


		}


		?>
		
		<div class="dot-line"></div><a class="btn" href = "?exit">
			<span class="end"><span class="label">Покинуть мятеж</a></span>
		</span><div class="dot-line"></div>
		<?php
	} else {


		/**
		 * Встать в очередь
		 */
		
		if (isset($_GET['enter']) ) 
		{
			mysql_query("INSERT INTO `revolt_member` SET `user`='".$user['id']."',
															`revolt`='".$revolt['id']."'")or die (mysql_error());

			header("Location:/revolt/?");
			exit;		



		}

		?>
		<div class="dot-line"></div><a class="btn" href = "?enter">
			<span class="end"><span class="label">Учавствовать в мятеже</a></span></span>
		<div class="dot-line"></div>
		<?php

	}


	?>

	<a class="btn" href ="/revolt/?<?php echo uniqid();?>">
		<span class="end"><span class="label">Обновить</a></span>
	</span></div>
	
	
	<div class="dot-line"></div><div class="center juosta2 tr">
	<span class="lime">Последний победитель:</span>
	<?
	$q = mysql_query('SELECT * FROM `stone` ORDER BY `id` DESC');
	if(mysql_num_rows($q)=='0'){
		
		?><span class='grey'>Нет победителей.</span><?
		
		
	}elseif (mysql_num_rows($q)>0) {
	
		while ($q=mysql_fetch_array($q)) {
			$user_li = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$q['user'].'"'));
			
			?><div class="dot-line"></div><span class="white"><?=$user_li['login']?></span><?
			}
		}
	?>
	</div>
	
	<div class="dot-line"></div>
	<div class="left juosta2 tr">
		<ul class="hint">
		<li><span class="small">Мятеж начинается в 11:00, 13:30, 16:30, 19:30, 22:00;</span></li>
		<li><span class="small">В начале мятежа на всех игроков нападает 25 Духов;</span></li>
		<li><span class="small">После того, как игроки убьют духов, появляется новый общий враг: Демон;</span></li>
		<li><span class="small">Игрок, который своим последним ударом убьет Демона, получает Чудесный камень;</span></li>
		<li><span class="small">Игрок, убивший героя с Чудесным камнем, получает Чудесный камень;</span></li>
		<li><span class="small">Бой длится до последнего выжившего игрока. Именно он и получает Чудесный камень;</span></li>
		<li><span class="small">Чудесный камень: +250 ко всем параметрам на 12 часов</span></li>
		<li><span class="small">За каждое убийство другого игрока, духа или демона игрок получает <img src="/images/icon/gold.png" alt="*"/> 2;</span></li>
		<li><span class="small">Победитель мятежа получает <img src="/images/icon/gold.png" alt="*"/> 150;</span></li>
		<li><span class="small">Бой заканчивается тогда, когда в бою остается 1 игрок или после 15 мин.</span></li>
		</ul></div>

	
	

	<?php


} 
/**
 * Начинаем мятеж если время до начала истекло.
 */
elseif ($revolt['time_start'] <=  time() && $revolt['start'] == 0 )
{
	/*
	* Удаляем запись с журнала.
	*/
	mysql_query("DELETE FROM `time_jurnal` WHERE `name`='revolt'");

	mysql_query("UPDATE `revolt` SET `start`='1' WHERE `id`='".$revolt['id']."'");

	/**
	 * Создаем демонов...
	 */
	
	for ($i = 0; $i<$demons; $i++)
	{

		mysql_query("INSERT INTO `revolt_mobs` SET `type`='demon',
													`str`='".$demonsParam['str']."',
													`agi`='".$demonsParam['agi']."',
													`def`='".$demonsParam['def']."',
													`max_hp`='".($demonsParam['vit']*2)."',
													`hp`='".($demonsParam['vit']*2)."',
													`revolt`='".$revolt['id']."'");

	}



	header("Location:/revolt/?".uniqid());
	exit;


} 
elseif ($revolt['time_start'] <= time()  && $revolt['start']  == 1 && $revolt['end'] == 0 && $revolt['time_left'] >  time()) 
{

	/**
	 * Если мятеж начат...
	 */

	/**
	 * Посчитаем время до конца...
	 * @var [type]
	 */
	$to_end = ($revolt['time_left']-time())/60%60;
	$to_ends = ($revolt['time_left']-time())%60;

	
	/**
	 * Если юзверь участвует в битве и она началась
	 */
	



	if (mysql_num_rows(mysql_query("SELECT `id` FROM `revolt_mobs` WHERE `dead`='0' and `revolt`='".$revolt['id']."'")) == 0 &&
			$membersCounter == 1 && $revolt['kill_boss'] == 1)
	{
	 /**
	 * Раздаём награду только в том случае если все духи и демон мертвы и в мятеже остался 1 игрок, иначе никто ничего не получит.
	 */  
	$v = mysql_query("SELECT * FROM `revolt_member` WHERE `revolt`='".$revolt['id']."'");
	
        while($row = mysql_fetch_array($v)) {
		
		  $users = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$row['user']."'"));
		  $g = ($row['kill']*2);
		  $s = ($row['kill']*500);
		  $exp = ($row['kill']*500);
		  mysql_query("UPDATE `users` SET `g` = `g` + '".$g."', `s`= `s` + '".$s."', `exp` = `exp` + '".$exp."' WHERE `id`='".$row['user']."'");
		  mysql_query("UPDATE `revolt_member` SET `nagrada`='1' WHERE `id`='".$row['id']."'");
        }
        
		$pobeda =  mysql_fetch_assoc(
				mysql_query(
						"SELECT * FROM `revolt_member` WHERE `dead`='0' and `revolt`='".$revolt['id']."'"
					)
			);
			
			
			$lider = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$pobeda['user']."'"));
			$s = $pobeda['kill']*700;
			$g = $pobeda['kill']*2 + 150;
			$exp = $pobeda['kill']*500;
			?>
			
			<div class="dot-line"></div><div class="left juosta2 tr">
			<span class="small yellow"> Победитель:</span> <span class="lime"><?=$lider['login']?></span></br>
			<span class="small yellow">За победу получаете 150 золота.</span></br>
			<span class="small yellow"><span class="lime"> <?=$pobeda['kill']?></span> Убито противников.</span></br>
			<span class="lime"><b>Всего вы получаете:</b></span></br>
			<span class="small yellow"><?=$s?> Серебра, <?=$g?> Золота, <?=$exp?> Опыта.</span></br>
			</div>
			<?

		
		mysql_query("UPDATE `users` SET `g` = `g` + '".$g."' WHERE `id`='".$pobeda['user']."'");
		mysql_query("TRUNCATE `revolt`");
		mysql_query("TRUNCATE `revolt_mobs`");
		mysql_query("TRUNCATE `revolt_logs`");
		mysql_query("TRUNCATE `revolt_member`");
			
		
		//header("Location:/revolt/");
		
		
	require_once $path.'f.php';
	exit;
	}

	if ($revoltMember)
	{

		$mobsCounter = mysql_num_rows(mysql_query("
				SELECT `id` FROM `revolt_mobs`
				WHERE `revolt`='".$revolt['id']."'
				and `type`= 'demon' and `dead`='0'

			"));






		?>
	<div class="dot-line"></div><div class="center">

		Духи:
		<?
		if($mobsCounter == 0) {
		?> <span class="bold lime"> <?=$mobsCounter?> </span><?
		}else{
		?> <span class="bold red"> <?=$mobsCounter?> </span><?
		}
		?> 
		  Демон:
		<?
		if($revolt['kill_boss'] == 1) {
		?> <span class="bold lime"> Мёртв </span><?
		}else{
		?> <span class="bold red"> Жив </span><?
		}?> 
		  Игроки: <span class="bold lime"> <?=$membersCounter?> </span> 
		
		<img src="/images/icon/arrow.png" alt="*"/> <span class="bold"><?php echo $to_end.':'.$to_ends;?>ч.</span>
		
		</div><?

		







		



		/**
		 * Бой...
		 */
		


		if ($revoltMember['dead'] == 1)
		{
			?>


			<center>
				
					Вас убили! Дождитесь окончания.
			</center>
			<?
			$nag = mysql_fetch_assoc(mysql_query("SELECT * FROM `revolt_member` WHERE `revolt`='".$revolt['id']."' and `user`='".$user['id']."'"));
			$s = $nag['kill']*700;
			$g = $nag['kill']*3;
			$exp = $nag['kill']*500;
			
			?>
			
			<div class="dot-line"></div><div class="left juosta2 tr">
			<span class="small yellow"><span class="lime"> <?=$nag['kill']?></span> Убито противников.</span></br>
			<span class="lime"><b>Вы получете:</b></span></br>
			<span class="small yellow"><img class="icon" src="/images/icon/silver.png" /><?=$s?> Серебра, <img class="icon" src="/images/icon/gold.png" /> <?=$g?> Золота, <?=$exp?> Опыта.</span></br>
			</div>
			
			
			
			
			<?php
		} else {

			/**
			 * Определяем есть ли демон
			 */
			

			if ($mobsCounter == 0)
			{

				if (mysql_num_rows(mysql_query("
						SELECT * FROM `revolt_mobs` WHERE `type`='boss'
							and `revolt`='".$revolt['id']."' and `dead`='0'
					")) == 0 && $revolt['kill_boss'] == 0)
				{

					/**
					 * Выпускаем демона...
					 */
					

					mysql_query("INSERT INTO `revolt_mobs` SET `revolt`='".$revolt['id']."',
																`str`='".$boss['str']."',
																`def`='".$boss['def']."',
																`agi`='".$boss['agi']."',
																`max_hp`='".($boss['vit']*2)."',
																`hp`='".($boss['vit']*2)."',
																`type`='boss'

						");

					echo 'Демон вышел!';

				}

			}


			$boss = mysql_fetch_assoc(mysql_query(
				"SELECT * FROM `revolt_mobs` WHERE `revolt`='".$revolt['id']."' and `dead`='0' and `type`='boss'"

				));
				
		

            /**
			 * Атака
			 */
			


			if (isset($_GET['attack']))
			{
				$attack = htmlspecialchars(trim($_GET['attack']));
				
				if($revoltMember['cooldown'] < time()){

				/**
				 * Мочим духов!
				 */
				if ($attack == 'mob')
				{
					if ($mobsCounter > 0)
					{
						if($revoltMember['target'] == 0){

								$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `revolt_mobs` 
																	WHERE `dead`='0' and `revolt`='".$revolt['id']."' ORDER BY RAND()"));						
								mysql_query("UPDATE `revolt_member` SET `target`='".$enemy['id']."' WHERE `user`='".$user['id']."'");
								header("Location:/revolt/");
						
						}else{
						
								$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `revolt_mobs` 
																				WHERE `id`='".$revoltMember['target']."' and `revolt`='".$revolt['id']."'
																"));													
						}
						
					} else {
					}
                    
                /**
				 * Мочим Демона!
				 */
				}elseif ($attack == 'boss') {

					if ($boss)
					{
						$enemy =&$boss;
					} else {
					}
                /**
				 * Мочим игроков!
				 */
				} elseif ($attack == 'user'){
						
						if($revoltMember['target'] == 0){
								$q = mysql_query("SELECT * FROM `revolt_member` WHERE `dead`='0' and `revolt`='".$revolt['id']."' and `user` != '".$user['id']."' ORDER BY RAND()");
								$q = mysql_fetch_array($q);
	
								/**
								* Если нету врага, обновляем, даем награду и заканчиваем мятеж...
								*/

						if (!$q)
							{
								header("Location:/revolt/");
								exit;
							}
						

								$enemy = mysql_fetch_assoc(mysql_query(
										"SELECT * FROM `users` WHERE `id`='".$q['user']."'"));
								mysql_query("UPDATE `revolt_member` SET `target`='".$enemy['id']."' WHERE `user`='".$user['id']."' and `revolt`='".$revolt['id']."'");
								header("Location:/revolt/");
						}else{
						
						$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` 
																	WHERE `id`='".$revoltMember['target']."'
															"));
						
						}
					
				}
			

	
				$admg = 0;
				$dmg = 0;
	
		$ran = rand(30,45);
		$otbil = round(100 / ( 32000 / $enemy['def']));
        $otbil +=$ran;
		$otbil = 100 - $otbil;
		$uda=$user['str']/100*70;		
		$dmg=round((rand($uda,$user['str'])) / 100 * $otbil);
	#Атака моба.
			$chase_attack = rand(0,23);
			$chase_attack2 = rand(0,100);
		
		if($chase_attack >= $chase_attack2){
			
			$ran = rand(30,35);
			$otbil2 = round(100 / ( 30000 / $user['def']));
			$otbil2 +=$ran;
			$otbil2 = 100 - $otbil2;
			$udar2=$enemy['str']/100*70;		
			$admg=round((rand($udar2,$enemy['str'])) / 100 * $otbil2);
			$admg = $admg + ($user['str']/10); // Чем сильнее игрок, тем сильнее удары мобов.
		
			if ($admg>=$user['hp']) {
					
					$admg = $user['hp'];
                    
					if ($attack == 'mob')
					{
						mysql_query("UPDATE `revolt_member` SET `dead`='1' WHERE `user`='".$user['id']."' and `revolt`='".$revolt['id']."'");				
						$log = '<span class="small yellow"><span class="red"> Дух</span> убил игрока <span class="lime">'.$user['login'].'!</span></span>';
						mysql_query("INSERT INTO `revolt_logs` SET `time`='".time()."',`text`='$log',`revolt`='".$revolt['id']."',`user`='".$user['id']."'");
						header("Location:/revolt/");
					} elseif ($attack == 'boss') {
					
						mysql_query("UPDATE `revolt_member` SET `dead`='1' WHERE `user`='".$user['id']."' and `revolt`='".$revolt['id']."'");				
						$log = '<span class="small yellow"><span class="red"> Демон</span> убил игрока <span class="lime">'.$user['login'].'!</span></span>';
						mysql_query("INSERT INTO `revolt_logs` SET `time`='".time()."',`text`='$log',`revolt`='".$revolt['id']."',`user`='".$user['id']."'");
						header("Location:/revolt/");
					}
					
					}else{
					
					
					if ($attack == 'mob'  && $mobsCounter > 0)
					{
						mysql_query("UPDATE `users` SET `hp`=`hp`-'$admg' WHERE `id`='".$user['id']."'");
						$log = '<span class="small yellow"><span class="red">Дух</span> ударил <span class="lime">'.$user['login'].'</span> на '.$admg.'!</span>';
						mysql_query("INSERT INTO `revolt_logs` SET `time`='".time()."',`text`='$log',`revolt`='".$revolt['id']."',`user`='".$user['id']."'");
					} elseif ($attack == 'boss' && $revolt['kill_boss'] == 0) {
						# code...
						mysql_query("UPDATE `users` SET `hp`=`hp`-'$admg' WHERE `id`='".$user['id']."'");
						$log = '<span class="small yellow"><span class="red">Демон</span> ударил <span class="lime">'.$user['login'].'</span> нанеся'.$admg.'!</span>';
						mysql_query("INSERT INTO `revolt_logs` SET `time`='".time()."',`text`='$log',`revolt`='".$revolt['id']."',`user`='".$user['id']."'");
					}
					
					
					
					}
		
		}
		if($dmg<=0) {$dmg = rand(5,10);}
				
				if ($dmg>=$enemy['hp']) {
					
					$dmg = $enemy['hp'];

					if ($attack == 'mob'  && $mobsCounter > 0)
					{
						$kill = $revoltMember['kill'] + 1;
						mysql_query("UPDATE `revolt_member` SET `target`='0', `kill`='".$kill."' WHERE `user`='".$user['id']."' and `revolt`='".$revolt['id']."'");
						mysql_query("UPDATE `revolt_mobs` SET `dead`='1',`hp`=0 WHERE `id`='".$enemy['id']."'");
						$log = ' <span class="small yellow"><span class="lime">'.$user['login'].'</span> убил <span class="red">Духа!</span></span>';
						mysql_query("INSERT INTO `revolt_logs` SET `time`='".time()."',`text`='$log',`revolt`='".$revolt['id']."',`user`='".$user['id']."'");
						header("Location:/revolt/");
                        
					} elseif ($attack == 'boss' && $revolt['kill_boss'] == 0) {
			
						$log = '<span class="small yellow"><span class="lime"> '.$user['login'].'</span> убил <span class="red">Демона!</span></span>';						
						
						/*
                         * Выдаём камень на 12 часов тому кто убил Демона, и сразу начисляем параметры.
                         */
						mysql_query("UPDATE `revolt_member` SET `nagrada`='1' WHERE `user`='".$user['id']."' and `revolt`='".$revolt['id']."'");
						
                        if($stone){
						  
                          mysql_query("UPDATE `stone` SET `time`='".(time() + (3600 * 12))."' WHERE `user`='".$user['id']."'");
						
                        }else{
						
                        mysql_query("INSERT INTO `stone` SET `user`='".$user['id']."',`time`='".(time() + (3600 * 12))."'");
						mysql_query('UPDATE `users` SET `str` = `str` + 250,
                                    `vit` = `vit` + 250,
                                    `agi` = `agi` + 250,
                                    `def` = `def` + 250 
									WHERE `id` = \''.$user['id'].'\'');
						}
						mysql_query("UPDATE `revolt_mobs` SET `dead`='1',`hp`=0 WHERE `type`='boss'");
						mysql_query("UPDATE `revolt` SET `kill_boss`='1' WHERE `id`='".$revolt['id']."'");
						mysql_query("INSERT INTO `revolt_logs` SET `time`='".time()."',`text`='$log',`revolt`='".$revolt['id']."',`user`='".$user['id']."'");
						header("Location:/revolt/");
					
                    } elseif ($attack == 'user') {
						
                        $kill = $revoltMember['kill'] + 1;
						
						/*
                         * Проверяем есть ли у юзера камень, если да то забераем его и переписываем параметры другому.
                         */
						if(mysql_num_rows(mysql_query("SELECT * FROM `revolt_member` WHERE `nagrada`='1' and `user`='".$enemy['id']."' and `revolt`='".$revolt['id']."'")) == 1)
						{
					
						mysql_query("UPDATE `revolt_member` SET `nagrada`='0' WHERE `user`='".$enemy['id']."' and `revolt`='".$revolt['id']."'");
						mysql_query("UPDATE `revolt_member` SET `nagrada`='1' WHERE `user`='".$user['id']."' and `revolt`='".$revolt['id']."'");
						
                        if($stone){
						  
                          mysql_query("UPDATE `stone` SET `time`='".(time() + (3600 * 12))."' WHERE `user`='".$user['id']."'");
						
                        }else{
						
                        mysql_query("INSERT INTO `stone` SET `user`='".$user['id']."',`time`='".(time() + (3600 * 12))."'");
						mysql_query('UPDATE `users` SET `str` = `str` + 250,
                                    `vit` = `vit` + 250,
                                    `agi` = `agi` + 250,
                                    `def` = `def` + 250 
									WHERE `id` = \''.$user['id'].'\'');
									}
						//Забираем камень
						mysql_query('UPDATE `users` SET `str` = `str` - 250,
                                     
                                      `vit` = `vit` - 250,
                                     
                                      `agi` = `agi` - 250,
                                    
                                      `def` = `def` - 250 WHERE `id` = \''.$enemy['id'].'\'');

						mysql_query('DELETE FROM `stone` WHERE `user` = \''.$enemy['id'].'\'');			
						
						}
						
						mysql_query("UPDATE `revolt_member` SET `target`='0', `kill`='".$kill."' WHERE `user`='".$user['id']."' and `revolt`='".$revolt['id']."'");					
						mysql_query("UPDATE `revolt_member` SET `dead`='1' WHERE `user`='".$enemy['id']."' and `revolt`='".$revolt['id']."'");
						$log = '<span class="small yellow"><span class="lime"> '.$user['login'].'</span> убил игрока <span class="red">'.$enemy['login'].'!</span></span>';
						mysql_query("INSERT INTO `revolt_logs` SET `time`='".time()."',`text`='$log',`revolt`='".$revolt['id']."',`user`='".$user['id']."'");
						header("Location:/revolt/");

					}


					
				} else {


					if ($attack == 'mob')
					{
						mysql_query("UPDATE `revolt_mobs` SET `hp`=`hp`-'$dmg' WHERE `id`='".$enemy['id']."'");
						$log = '<span class="small yellow"><span class="lime">'.$user['login'].'</span> ударил <span class="red">Духа</span> на '.$dmg.'!</span>';
						mysql_query("INSERT INTO `revolt_logs` SET `time`='".time()."',`text`='$log',`revolt`='".$revolt['id']."',`user`='".$user['id']."'");
					} elseif ($attack == 'boss') {
						# code...
						mysql_query("UPDATE `revolt_mobs` SET `hp`=`hp`-'$dmg' WHERE `type`='boss'");
						$log = '<span class="small yellow"><span class="lime">'.$user['login'].'</span> ударил <span class="red">Демона</span> нанеся'.$dmg.'!</span>';
						mysql_query("INSERT INTO `revolt_logs` SET `time`='".time()."',`text`='$log',`revolt`='".$revolt['id']."',`user`='".$user['id']."'");
					} elseif ($attack == 'user') {

						mysql_query("UPDATE `users` SET `hp`=`hp`-'$dmg' WHERE `id`='".$enemy['id']."'");
						$log = '<span class="small yellow">Игрок <span class="lime"> '.$user['login'].'</span> ударил игрока <span class="red">'.$enemy['login'].' </span>на '.$dmg.'!</span>';
						mysql_query("INSERT INTO `revolt_logs` SET `time`='".time()."',`text`='$log',`revolt`='".$revolt['id']."',`user`='".$user['id']."'");

					}



				}

				
				/**
				 * UPD cooldown
				 */
				

				mysql_query("UPDATE `revolt_member` SET `cooldown`='".(time()+1)."' WHERE `user`='".$user['id']."'");


				/**
				 * Если игрок жахает по кнопкам со скоростью Formula-1
				 */
				}else{
						$log = '<span class="small yellow">Игрок <span class="lime"> '.$user['login'].'</span><span class="white">Промахнулся</span></span>';
						mysql_query("INSERT INTO `revolt_logs` SET `time`='".time()."',`text`='$log',`revolt`='".$revolt['id']."',`user`='".$user['id']."'");

				header("Location:/revolt/");
				}
				

			}

		/*
         * Интерфейс боя.
         */

			if ($mobsCounter > 0)
			{
			
				if($revoltMember['target'] == 0){

						$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `revolt_mobs` 
																	WHERE `dead`='0' and `revolt`='".$revolt['id']."' ORDER BY RAND()"));						
						mysql_query("UPDATE `revolt_member` SET `target`='".$enemy['id']."' WHERE `user`='".$user['id']."'");
						header("Location:/revolt/");
						
				}
				
			
	$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `revolt_mobs` WHERE `id`='".$revoltMember['target']."' and `revolt`='".$revolt['id']."'"));
	$hp_progress_bot = round(100 / ($enemy['max_hp'] / $enemy['hp']));
	$hp_progress_user = round(100/(($user['vit']*4)/$user['hp']));


				?>
				
			<div class="dot-line"></div><div class="left juosta2 tr">
			<span class="yellow bold"><img src ="/images/icon/race/<?=$user['r']?>.png"> <?=$user['login']?><img src="/images/icon/vit.png" alt="*"/> <?=$user['hp']?></span><div class="fr bold"> </div>
			<div class="dot-line"></div>
			<span class="bl prg-bar border1">
			<span class="bl fl prg-blue" style="width: <?=$hp_progress_user?>%"> </span>
			<span class="bl fl prg-red" style="width: 0%"> </span>
			</span>
			<div class="dot-line"></div>
			<span class="ml5 yellow bold"><img src="/images/icon/race/bot.png" alt="*"/> Дух<?=$enemy['id']?><img src="/images/icon/vit.png" alt="*"/> <?=$enemy['hp']?></span><div class="fr bold"> </div>
			<div class="dot-line"></div>
			<span class="bl prg-bar border1">
			<span class="bl fl prg-blue" style="width: <?=$hp_progress_bot?>%"> </span>
			<span class="bl fl prg-red" style="width: 0%"> </span>
			</span></div>
				
				<div class="dot-line"></div>
				<div class="center">
				<a class="btn" href="?attack=mob"><span class="end"><span class="label">Атаковать</a></span></span>
				</div>
				<div class="dot-line"></div>
				<div class="center">
				<a class="btn" href="?last=mob"><span class="end"><span class="label">Другой дух</a></span></span>
				</div>

				<?php

			}


			if ($boss)
			{
	$enemy =&$boss;
	$hp_progress_bot = round(100 / ($enemy['max_hp'] / $enemy['hp']));
	$hp_progress_user = round(100/(($user['vit']*4)/$user['hp']));

				?>
				
			<div class="dot-line"></div><div class="left juosta2 tr">
			<span class="yellow bold"><img src="/images/icon/race/<?=$user['r']?>.png" alt="*"/><?=$user['login']?><img src="/images/icon/vit.png" alt="*"/> <?=$user['hp']?></span><div class="fr bold"> </div>
			<div class="dot-line"></div>
			<span class="bl prg-bar border1">
			<span class="bl fl prg-blue" style="width: <?=$hp_progress_user?>%"> </span>
			<span class="bl fl prg-red" style="width: 0%"> </span>
			</span>
			<div class="dot-line"></div>
			<span class="ml5 yellow bold"><img src="/images/icon/race/bot.png" alt="*"/> Демон <img src="/images/icon/vit.png" alt="*"/> <?=$enemy['hp']?></span><div class="fr bold"> </div>
			<div class="dot-line"></div>
			<span class="bl prg-bar border1">
			<span class="bl fl prg-blue" style="width: <?=$hp_progress_bot?>%"> </span>
			<span class="bl fl prg-red" style="width: 0%"> </span>
			</span></div>
				
				<div class="dot-line"></div>
				<div class="center">
				<a class="btn" href="?attack=boss"><span class="end"><span class="label">Атаковать босса</a></span></span>
				</div>
				

				<?php
			}




			if ($membersCounter > 1 && $revolt['kill_boss'] == 1)
			{
			
				if($revoltMember['target'] == 0){

						$q = mysql_query("SELECT * FROM `revolt_member` WHERE `dead`='0' and `revolt`='".$revolt['id']."' and `user` != '".$user['id']."' ORDER BY RAND()");
						$q = mysql_fetch_array($q);
	
					
						/* Если не ту врага...
						*/

				if (!$q)
					{
					header("Location:/revolt/");
					exit;
					}
						

					$enemy = mysql_fetch_assoc(mysql_query(
								"SELECT * FROM `users` WHERE `id`='".$q['user']."'"));
					mysql_query("UPDATE `revolt_member` SET `target`='".$enemy['id']."' WHERE `user`='".$user['id']."' and `revolt`='".$revolt['id']."'");
					header("Location:/revolt/");
						
				}
			
	$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$revoltMember['target']."'"));
	$hp_progress_bot = round(100 / (($enemy['vit']*4) / $enemy['hp'])); 
	$hp_progress_user = round(100/(($user['vit']*4)/$user['hp'])); // Обратите внимание здесь $enemy['vit']*4 жизни умнажаются на 4 а не на 2(поставте 2)
				?>
				
			<div class="dot-line"></div><div class="left juosta2 tr">
			<span class="yellow bold"><img src="/images/icon/race/<?=$user['r']?>.png" alt="*"/><?=$user['login']?><img src="/images/icon/vit.png" alt="*"/> <?=$user['hp']?></span><div class="fr bold"> </div>
			<div class="dot-line"></div>
			<span class="bl prg-bar border1">
			<span class="bl fl prg-blue" style="width: <?=$hp_progress_user?>%"> </span>
			<span class="bl fl prg-red" style="width: 0%"> </span>
			</span>
			<div class="dot-line"></div>
			<span class="ml5 yellow bold"><img src="/images/icon/race/bot.png" alt="*"/> <?=$enemy['login']?> <img src="/images/icon/vit.png" alt="*"/> <?=$enemy['hp']?></span><div class="fr bold"> </div>
			<div class="dot-line"></div>
			<span class="bl prg-bar border1">
			<span class="bl fl prg-blue" style="width: <?=$hp_progress_bot?>%"> </span>
			<span class="bl fl prg-red" style="width: 0%"> </span>
			</span></div>
				
				<div class="dot-line"></div>
				<div class="center">
				<a class="btn" href="?attack=user"><span class="end"><span class="label">Атаковать</a></span></span>
				</div>
				
				<div class="dot-line"></div>
				<div class="center">
				<a class="btn" href="?last=user"><span class="end"><span class="label">Другой игрок</a></span></span>
				</div>
				
				<?php


			}

			?><div class="dot-line"></div><div class="left juosta2 tr"><?

				$logs=mysql_query("SELECT * FROM `revolt_logs` WHERE `revolt`='".$revolt['id']."' ORDER BY `id` DESC LIMIT 16");

			if(mysql_num_rows($logs)=='0'){
			
			?><span class='grey'>Мятеж начался.</span><?
			
			}elseif (mysql_num_rows($logs)>0) {
			
					while ($log=mysql_fetch_array($logs)) {
					
					?><span><?=$log['text'];?></span></br><?
			}	
	}
	?></div><?
			
		
			// Если мы хотим поменять цель.
			if (isset($_GET['last']))
			{
				$last = htmlspecialchars(trim($_GET['last']));

				/**
				 * Attack mob!
				 * @var [type]
				 */
				if ($last == 'mob'){
				
					$enemy = mysql_fetch_assoc(mysql_query("SELECT * FROM `revolt_mobs` 
																	WHERE `dead`='0' and `revolt`='".$revolt['id']."' ORDER BY RAND()"));		
					mysql_query("UPDATE `revolt_member` SET `target`='".$enemy['id']."' WHERE `user`='".$user['id']."'");
						
				}elseif ($last == 'user') {
				
						$q = mysql_query("SELECT * FROM `revolt_member` WHERE `dead`='0' and `revolt`='".$revolt['id']."' and `user` != '".$user['id']."' ORDER BY RAND()");
						$q = mysql_fetch_array($q);
						/**
						* Если не ту врага...
						*/

					if (!$q)
					{
					header("Location:/revolt.php");
					exit;
					}
						$enemy = mysql_fetch_assoc(mysql_query(
							"SELECT * FROM `users` WHERE `id`='".$q['user']."'"
						));
						mysql_query("UPDATE `revolt_member` SET `target`='".$enemy['id']."' WHERE `user`='".$user['id']."'");
				
				
					}
					header("Location:/revolt.php?__".uniqid());
				}
		
		
			


		}







	} else {

		/**
		 * Если не участвует и она началась
		 */
		

		?>
		
		<div class="dot-line"></div><div class="center juosta2 tr">
		Вы опоздали, мятеж уже идёт! До окончания:  </br>
		<img src="/img/icons/clock.png" alt="*"/>
		<span class="bold"><?php echo $to_end.':'.$to_ends;?>ч.</span>
			</div>

		

		<div class="dot-line"></div><div class="left juosta2 tr"><?

				$logs=mysql_query("SELECT * FROM `revolt_logs` WHERE `revolt`='".$revolt['id']."' ORDER BY `id` DESC LIMIT 16");

			if(mysql_num_rows($logs)=='0'){
			
			?><span class='yellow'>Мятеж начался.</span><?
			
			}elseif (mysql_num_rows($logs)>0) {
			
					while ($log=mysql_fetch_array($logs)) {
					
					?><span><?=$log['text'];?></span></br><?
			}	
	}
	?></div>
		
		<?php


	}





}
elseif ($revolt['time_left'] < time() && $revolt['start'] == 1 && $revolt['time_start'] < time())
{

	/**
	 * Если закончилось время для провведения мятежа 
	 */
	
	mysql_query("TRUNCATE `revolt`");
	mysql_query("TRUNCATE `revolt_mobs`");
	mysql_query("TRUNCATE `revolt_member`");
	
	header("Location:/revolt.php?__".uniqid());
	
exit;

}


require_once $path.'f.php';