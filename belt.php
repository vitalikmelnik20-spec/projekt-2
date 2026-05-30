<?
include'./system/common.php';	
include'./system/functions.php';
include'./system/user.php';
  $title = 'Мой пояс';
	  include'./system/h.php';
  
		 
     if(isSet($_GET['belt'])) {
     
	 if(15 >= $user['g']) $errors[] = 'Ошибка, у вас нет столько золота.';
     if(100 <= $user['belt']) $errors[] = 'Ошибка, у вас максимальное количество эликсиров.';		
	 if($errors) {
     echo '<div class=\'main\' align=\'center\'>';
        
        foreach($errors as $error) {
          
          echo $error.'<br/>';
          
        }
      
        echo '</div><div class=\'mini-line\'></div>';
        }else{
     mysql_query('UPDATE `users` SET `belt` = `belt` + 1, `g` = `g` - 20 WHERE `id` = "'.$user['id'].'"');
     exit(header('location: /belt'));
    }
    }
	
  if(isSet($_GET['belt_inv'])) {
  
  mysql_query('UPDATE `users` SET `belt_inv` = "'.($user['belt_inv'] ? '0' : '1').'" WHERE `id` = "'.$user['id'].'"');
    
	exit(header('location: /belt'));
  
  
  }
  
  ?>
	 <div class='main'>
	 <div class='menuList'>
	  
	  <li><table cellpadding='0' cellspacing='0'>
<tr><td>
  <img src='/images/alchemy/potion.png' alt='*'/></td>
  <td valign='top' style='padding-left: 5px;'> Зелья Алхимика
  <small><br/>
  <font color='#9bc'>Подробно:</font> Восстановляет здоровье на <font color='#90c090'>20%</font>.<br />
Эликсир используется только в бою. Откат: <font color='#90c090'>60</font> сек.<br/>
  <font color='#9bc'>Количество:</font> <font color='#9c9'><?=$user['belt']?> шт. <?=($user['belt_inv'] ? ' (Сняты)' : ' (Одеты)')?></font></small></td>
  </tr></table>
  <li>
</div><center>
<a href='?belt' class='btn'><span class='end'><span class='label'>Купить <img src='/images/icon/gold.png' alt='*'/> 15</a></span></span>
<a href='?belt_inv' class='btn'><span class='end'><span class='label'><?=($user['belt_inv'] ? ' Одеть на' : 'Снять с')?> пояса</a></span></span>
</div></center>


  
  
  </div></div>
  <?
  
  include './system/f.php';
  
?>