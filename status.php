<?
   include './system/common.php';
   include './system/functions.php';
   include './system/user.php';
  $title = 'Смена статуса';
	  include './system/h.php';

if(!$user) exit(header('Location: /'));

if(isset($_GET['StatusEdit'])) {
	
	if($user['g'] <= 150) exit(header('Location: /'));
	
$status = _string($_POST['status']);
$status_color = _string($_POST['status_color']);

mysql_query("UPDATE `users` SET `status` = '$status',`status_color` = '$status_color', `g` = `g` - 1500 WHERE `id` = '$user[id]'");
exit(header ('Location: /user/')); 

}

?>
<div class = 'main'>
<form action='?StatusEdit' method='post'>
Введите ваш статус: <br />
<input name="status" value="<?=$user['status']?>" style="width: 50%;"/><br />
  
<select name='status_color'>
<option selected="selected" value="#FF0000">Красный</option>
<option value="#00FFFF">Синий</option>
<option value="#3CB371">Зеленый</option>
<option value="#FFA500">Оранжевый</option>
<option value="#EE82EE">Фиолетовый</option>

</select>
<br/>
  <span class="btn"><span class="end"><input class="label" type="submit" value="Изменить"/>Изменить</span></span>
  </div>
  
  <div class = 'mini-line'></div>
   <div class = 'main'>
  * Услуга смены статуса платная стоимость 1500 золота.
  </div>
  
<?
include './system/f.php';
?>