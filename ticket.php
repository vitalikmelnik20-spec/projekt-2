<?

  include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
  exit;

}
  $title = "Поддержка";

include './system/h.php';

switch ($_GET['mode'])
{
  default;
IF(isset($_get['COPY']))
{

}
if($_GET['create']=="true")
{
	
	$_title=_string($_POST['title']);

	$_sms=_string($_POST['sms']);

	if(empty($_title))$err="Пустой заголовок!";

	if(empty($_sms))$err="Пустой текст обращения!";

	if(strlen($_title)<5 OR strlen($_title)>24)$err="Длина заголовка должна быть в пределах 5-24 символов";

	if(strlen($_sms)<15 OR strlen($_sms)>1200)$err="Длина вопроса должна быть в пределах 15-1200 символов";

	if($err)
	{

		?>

		<div class="error center">
		<img src='/images/icon/error.png'> <?=$err;?>
		</div>

		<?

	}elseif(!$err){

			mysql_query("INSERT INTO `ticket` SET `user`='".$user['id']."',`text`='$_sms',`title`='$_title',`status`='new'")OR DIE(mysql_error());

			?>

		<div class="ok center">
		<img src='/images/icon/ok.png'>Тиккет успешно создан!</font>
		</div>

		<?

		



	}

	



}

?>
<div class='block_zero center'>
<Form action="?create=true" method="post"/>
 <input name="title" placeholder="Заголовок"/><br/>
<textarea name="sms" placeholder="Вопрос"/></textarea><br>
  <input type="submit" value="Создать тиккет"/>
</form>
</div>
<div class='mini-line'></div>
<div class='title' align='center' >
Мои обращения
</div>
<div class='mini-line'></div>
<div class='block_zero'>
<?

$my_requests=mysql_query("SELECT * FROM `ticket` WHERE `user`='".$user['id']."'");

if(mysql_num_rows($my_requests)==0)
{

?>

<font color='#999'>Нет обращений!</font>
</div>
<?

}elseif(mysql_num_rows($my_requests)>0)
{

	while ($req=mysql_fetch_array($my_requests))
	{
		
		switch ($req[status])
		{
			case 'new';

			$status="<font color='yellow'>Ожидание</font>";

			break;

			case 'read';

			$status="<font color='green'>Есть ответ</font>";

			break;

			case 'close';

			$status="<font color='red'>Закрыт</font>";

			break;

			case 'user';

			$status="<font color='red'>Ожидание</font>";

			break;

		}

		?>	  
			</div><div class='menuList'>
  			<li class='no_b'><a href='?mode=viev&id=<?=$req['id'];?>'><img src='/images/icon/arrow.png' alt='*'/><?=$req['title'];?>(<?=$status;?>)</a></li>
			</div>

		<?
	}



}


break;

case 'viev';

$id=trim(htmlspecialchars($_GET['id']));

	$tik=mysql_fetch_array(mysql_query("SELECT * FROM `ticket` WHERE `id`='$id'  and `user`='".mysql_real_escape_string($user['id'])."'"));

	if($tik){
		
				switch ($tik[status])
		{
			case 'new';

			$status="<font color='yellow'>Ожидание</font>";

			break;

			case 'read';

			$status="<font color='green'>Есть ответ</font>";

			break;

			case 'close';

			$status="<font color='red'>Закрыт</font>";

			break;

			case 'user';

			$status="<font color='red'>Ожидание</font>";

			break;
		}


if($_GET['close']=="true" && $tik['status']!="close")
{


mysql_query("UPDATE `ticket` SET `status`='close' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");


?>

<div class="ok center">
						<img src='/images/icon/ok.png'> <span>Тиккет закрыт</span>
						</div>
<?

}
		
		if($_GET['answer']=="true")
		{

				$sms=_string($_POST['sms']);
	
				if(strlen($sms)<5 OR strlen($sms)>2048)$err="Длина сообщения от 5 до 1200 символов";

				if($tik['status']=="close")$err="Тиккет закрыт";

				if($tik['status']=="user")$err="Анти-флуд.";

				if($err)
				{

					?>

						<div class="error center">
						<img src='/images/icon/error.png'> <span><?=$err;?></span>
						</div>
					
						<?
				}elseif(!$err)
				{

					mysql_query("INSERT INTO `ticket_answer` SET `text`='".mysql_real_escape_string($sms)."',`type`='user',`ticket`='".mysql_real_escape_string($tik['id'])."'");

					mysql_query("UPDATE `ticket` SET `status`='user' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");

					?>				
	
						<div class="ok center">
						<img src='/images/icon/ok.png'> Сообщение добавлено!
						</div>

					<?



				}



		}
	

		?>

			<div class='block_zero'>
			<div align="float-left"/>
			Название: <?=$tik['title'];?><br/>
			Статус: <?=$status;?><br/>
			Вопрос: <?echo "".nl2br($tik['text'])."";?><br/>
			</div></div>
			<div class="mini-line"></div>
			<div class="block_zero">
			<a href='?mode=viev&id=<?=$tik['id'];?>&close=true' class='button'>Закрыть тиккет</a>
			</div>
			<div class="mini-line"></div>
			
			<?

	if($tik['status']=="user" OR $tik['status']=="close"){
				?>
				<div class='block_zero'>
			<font color='#999'>Нельзя ответить</font>
			</div>
				<?
}else{
	?>
			<Form class='block_zero' action="?mode=viev&id=<?=$tik['id'];?>&answer=true" method="post"/>
			<textarea name="sms" rows="5" cols="55"placeholder="Дополнительный текст"/></textarea><br>
  			<input type="submit" value="Отправить"/>
			</form>

<?
}
?>
			
			<div class="mini-line">
			</div>


		
		<?

	$answer=mysql_query("SELECT  * FROM `ticket_answer` WHERE `ticket`='".$tik['id']."' ORDER BY `id` DESC");

	if(mysql_num_rows($answer)==0){

		?>

		<div class="block_zero">
		<font color='#999'>Сообщений не найдено</font>
		</div>
	
		<?
	
	}elseif(mysql_num_rows($answer)>0)
	{

			while ($feed=mysql_fetch_array($answer))
			{
			  
				if($feed['type']=="admin")
				{

					?>
					<div class="block_zero">
					<font color='#999'>Ответ администратора:</font><br>
					<?=$feed['text'];?>
					</div>
					<div class="dot-line">
			</div>
					<?

				}elseif($feed['type']=="user")
				{

					?>
					<div class="block_zero">
					<font color='#999'>Вы:</font><br>
					<?=$feed['text'];?>
					</div>
					<Div class="dot-line">
			</div>
					<?


				}

			}		

	}


	}elseif(!$tik)
	{

		header("Location:/ticket");

		exit;

	}


break;
case 'admin';

if($user['access']=="2")
{






$id=trim(htmlspecialchars($_GET['id']));

	$tik=mysql_fetch_array(mysql_query("SELECT * FROM `ticket` WHERE `id`='$id'"));

	if($tik){
		
				switch ($tik[status])
		{
			case 'new';

			$status="<font color='yellow'>Новый вопрос</font>";

			break;

			case 'read';

			$status="<font color='green'>Ожидание</font>";

			break;

			case 'close';

			$status="<font color='red'>Закрыт</font>";

			break;

			case 'user';

			$status="<font color='red'>Ответил пользователь</font>";

			break;
		}

if($_GET['open']=="true")
{

mysql_query("UPDATE `ticket` SET `status`='read' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");


}


if($_GET['delete']=="true")
{

mysql_query("DELETE FROM `ticket` WHERE `id`='".mysql_real_escape_string($tik['id'])."'");

mysql_query("DELETE FROM `ticket_answer` WHERE `ticket`='".mysql_real_escape_string($tik['id'])."'");



?>

<div class="ok center">
						<span>Тиккет удален</span>
						</div>
<?


}



if($_GET['close']=="true" && $tik['status']!="close")
{


mysql_query("UPDATE `ticket` SET `status`='close' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");




}
		
		if($_GET['answer']=="true")
		{

				$sms=_string($_POST['sms']);
	
				if(strlen($sms)<15 OR strlen($sms)>1200)$err="Длина сообщения от 15 до 1200 символов";

				if($tik['status']=="close")$err="Тикет закрыт.";

				

				if($err)
				{

					?>

						<div class="error center">
						<img src='/images/icon/error.png'> <span><?=$err;?></span>
						</div>
					
						<?
				}elseif(!$err)
				{

					mysql_query("INSERT INTO `ticket_answer` SET `text`='".mysql_real_escape_string($sms)."',`type`='admin',`ticket`='".mysql_real_escape_string($tik['id'])."'");

					mysql_query("UPDATE `ticket` SET `status`='read' WHERE `id`='".mysql_real_escape_string($tik['id'])."'");

					?>				
	
						<div class="ok center">
						<img src='/images/icon/ok.png'> Сообщение добавлено!
						</div>

					<?



				}



		}
	
$i = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$tik['user'].'"');
$i = mysql_fetch_array($i);
		?>

			<div class="block_zero">
			<div align="float-left"/>
			Игрок: <img src='/images/icon/race/<?=$i['r'].($i['online'] > (time() - 300) ? '':'-off')?>.png' alt='*'/> <b><?=$i['login']?></b><br>
			Тема: <?=$tik['title'];?><br/> 
			Статус: <?=$status;?><br/>
			Текст обращения: <?echo "".nl2br($tik['text'])."";?><br/>
			</div></div>
			<div class="mini-line"></div>
			<div class="block_zero">
			<a href='?mode=admin&id=<?=$tik['id'];?>&close=true' class='button'>Закрыть обращение</a>
			<a href='?mode=admin&id=<?=$tik['id'];?>&delete=true' class='button'>Удалить обращение</a>
			<a href='?mode=admin&id=<?=$tik['id'];?>&open=true' class='button'>Открыть</a>
			</div>
			<div class="mini-line"></div>

			<Form class='block_zero' action="?mode=admin&id=<?=$tik['id'];?>&answer=true" method="post"/>
			<textarea class='text large' name="sms"placeholder="Ваш ответ."/></textarea><br>
  			<input type="submit" value="Отправить"/>
			</form>


			
			<Div class="mini-line">
			</div>


		
		<?

	$answer=mysql_query("SELECT  * FROM `ticket_answer` WHERE `ticket`='".$tik['id']."' ORDER BY `id` DESC");

	if(mysql_num_rows($answer)==0){

		?>

		<div class="block_zero'">
		<font color='#999'>Сообщений не найдено.</font>
		</div>
	
		<?
	
	}elseif(mysql_num_rows($answer)>0)
	{

			while ($feed=mysql_fetch_array($answer))
			{
			  
				if($feed['type']=="admin")
				{

					?>
					<div class="block_zero">
					<font color='#999'>Вы (АДМИН):</font><br>
					<?=$feed['text'];?>
					</div>
					<Div class="dot-line">
			</div>
					<?

				}elseif($feed['type']=="user")
				{

					?>
					<div class="block_zero">
					<font color='#999'>Пользователь:</font><br>
					<?=$feed['text'];?>
					</div>
					<Div class="dot-line">
			</div>
					<?


				}

			}		

	}


	}elseif(!$tik)
	{

		header("Location:/ticket");

		exit;

	}








}

break;
case 'viev_all';

if($user['access']!="2")
{


	header("Location:/");

	exit;


}

$all=mysql_query("SELECT * FROM `ticket`  ORDER BY `id` DESC");

if(mysql_num_rows($all)==0)
{

?>

		<div class="block_zero">
		<font color='#999'>Заявок нету</font>
		</div>
	
		<?

}elseif(mysql_num_rows($all)>0)
{

echo "<div class='menuList'>";
	while ($at=mysql_fetch_array($all))
	{
	  
					switch ($at[status])
		{
			case 'new';

			$status="<font color='yellow'>Новый вопрос</font>";

			break;

			case 'read';

			$status="<font color='green'>Ожидание</font>";

			break;

			case 'close';

			$status="<font color='red'>Закрыт</font>";

			break;

			case 'user';

			$status="<font color='red'>Ответил пользователь</font>";

			break;
		}

				?>	  
			
  			<li><a href='?mode=admin&id=<?=$at['id'];?>'><img src='/images/icon/arrow.png' alt='*'/><?=$at['title'];?>(<?=$status;?>)</a></li>
		

		<?




	}
	echo "</div>";





}


break;


}

include './system/f.php';

?>