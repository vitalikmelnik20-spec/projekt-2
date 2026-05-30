<?php

$title = 'Трофеи';

foreach (array("/system/common.php",
				"/system/functions.php",
				"/system/user.php",
				"/system/h.php") as $include )
{
		require_once $_SERVER['DOCUMENT_ROOT'].$include;
}

 

/**
* Показ инфы о трофее
*/

if (isset($_GET['id']))
{
	$id = _num($_GET['id']);

	if ($id >0 && $id<10)
	{
		if ($user['troph'.$id] == 0)
		{
			?>
			<div class='block_zero center blue'>
			Собирай трофеи и становись сильнее<br/>
У Великого война должны быть все трофеи!
			</div>
			<?
		}
		else
		{
			?>
			<div class ='block_zero'/><center>
			<font color ='lime'/><img src='/images/icon/ok.png' alt=''/> Трофей  получен</font/>
</center>
			</div>
			<?
		}

		?>
		<div class ='mini-line '/></div>
		<div class ='block_zero'/>
		<center>
		<img src='/images/medals/50x50/<?=$id;?>.png' alt ='medal'> <br/>
</div><div class='dot-line'/>
</div><div class ='block_zero'/>
<center>
<span class='blue bold'><?=$names[$id];?></span>
		</center>
		</div>
		

		<?php

		if ($user['troph'.$id] == 0)
		{
			?>
			<div class='block_zero'/>
			<center>

            <b> Важно!</b></br>
<span class='quality-4'>
              Не будет писаться выполнено задания или нет</br>
             Просто если вы достигли свой цели она будет считаться выполненной</span>
			</center>
                  
			</div>
			<div class= 'mini-line'/></div>
			<div class ='block_zero'/>

                      <img src='/images/icon/quest.png' alt=''/><b class='dgreen'> Уровень персонажа должен быть <?=$level[$id];?> и выше </b><br/><div style='margin-bottom:3px;'></div>
<span class='blue'>Прогресс:</span> <?=$user['level'];?> из <?=$level[$id];?><br/>
<div class='stat_bar' style='margin:2px 0px 2px;'><div class='progress' style='<?=$progress?>%'></div></div><div class='mb10'></div>
<div class='center'>
<a class='btn' href='/fights/'>
<span class='end'>
<span class='label'>Перейти к выполнению</span></span></a></div>
<div class='dot-line'></div>

                      <img src='/images/icon/quest.png' alt=''/><b class='dgreen'> Рейтинг в дуэлях должен быть <?=$duel_rating[$id];?> и выше </b><br/><div style='margin-bottom:3px;'></div>
<span class='blue'>Прогресс:</span> <?=$user['duel_rating'];?> из <?=$duel_rating[$id];?><br/>
<div class='stat_bar' style='margin:2px 0px 2px;'><div class='progress' style='<?=$progress?>%'></div></div><div class='mb10'></div>
<div class='center'>
<a class='btn' href='/duel/'>
<span class='end'>
<span class='label'>Перейти к выполнению</span></span></a></div>
<div class='dot-line'></div>

                   

		

			<img src='/images/icon/quest.png' alt=''/> <b class='dgreen'>Мастерство персонажа должно быть <?=$skill[$id];?> и выше </b> <br/><div style='margin-bottom:3px;'></div>
<span class='blue'>Прогресс: </span><?=$user['skill'];?> из <?=$skill[$id];?><br/>
<div class='stat_bar' style='margin:2px 0px 2px;'><div class='progress' style='<?=$progress?>%'></div></div><div class='mb10'></div>
<div class='center'>
<a class='btn' href='/train/'>
<span class='end'>
<span class='label'>Перейти к выполнению</span></span></a></div>
<div class='dot-line'></div>

			

			</div>
			<div class='mini-line'/></div>
			<?
		}
	}else
	{
		header("Location:?");
		exit();
	}
	?>
<div class='menuList'/>
<li><a href='/medal.php/'><img src='/images/icon/arrow.png' alt=''/>Назад к трофеям</a></li>
	</div>
	<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/system/f.php';
	exit();
}

for ($i =1; $i<10;$i++)
{
	if ($user['troph'.$i] == 0 )
	{
		?>
		<div class = 'menuList'/>
		<li style='display:block;'>
			<a href = '/medal.php?id=<?=$i;?>'/> 
			<img src='/images/medals/50x50/<?=$i;?>.png' alt ='medal'> <?=$names[$i];?>
			</a>
		</li>
		</div>
		<?
		if ($i!=9)
		{
			?>
			<div class='mini-line'/>
			</div>
			<?
		}
	}
}

/**
* Вывод полученных трофеев!
*/

?>
<div class='mini-line'/>
</div>
<div class='block_zero'/>
<center>
<span class='blue'>
Мои трофеи:
</span>
</center>
</div>
<div class='separ'/>
</div>
<?

for ($i =1; $i<10;$i++)
{
	if ($user['troph'.$i] == 1 )
	{

		?>

		<div class = 'menuList'/>
		<li style='display:block;'>
			<a href = '/medal.php?id=<?=$i;?>'/> 
			<img src='/images/medals/50x50/<?=$i;?>.png' alt ='medal'> <?=$names[$i];?> (<font color ='lime'/> Трофей получен </font/>)
			</a>
		</li>
		</div>
		<?
		if ($i!=9)
		{
			?>
			<div class='dot-line'/>
			</div>
			<?
		}
	}
}

require_once $_SERVER['DOCUMENT_ROOT'].'/system/f.php';