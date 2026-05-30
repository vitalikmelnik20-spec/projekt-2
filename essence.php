<?
   include './system/common.php';
   include './system/functions.php';
   include './system/user.php';
 $title = 'Сущности';
	  include './system/h.php';

if(!$user) exit(header('Location: /'));




?>


         <div class='main' align='center'>
         Каждая сущность дает <font color='#90c090'>+3</font> к каждому параметру
</div>
     <div class='mini-line'></div>
	  <div class='main'>
                 <table cellpadding='0' cellspacing='0'>
                 <tr>
                 <td><img src='/images/essence2.png' alt='*'/></td>
                 <td valign='top' style='padding-left: 5px;'> Сущности - души Богов запечатанные и разбросаные по всему миру, найти которые вы сможете сражаясь в дуэлях
				 </td></tr></table>
                 </div>
<div class='mini-line'></div>
<div class='main' align='center'>
Собрано сущностей: <?=$user['essence']?> из 200 <br />
Бонус ко всем параметрам <font color='#90c090'>+<?=$user['essence'] * 3?></font>
</div>


<?
      
	  
	  include './system/f.php';

?>