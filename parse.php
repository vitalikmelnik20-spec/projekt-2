<?
    foreach(['common','functions','user','h'] as $head) {
		include './system/'.$head.'.php';
		    	$title = 'Уровень разбора';    
	}  
	     $id = _string(_num($_GET['id']));
         if($id) $i = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$id.'"')); else $i = $user;
				if(!$i) exit(header('location: /user'));
?>
<div class='title'><?=$title?> <?=$user['login']?></div>
     <div class='line'></div>
         <div class='content'>
         Каждый уровень разбора дает +10 к каждому параметру
</div>
     <div class='line'></div>
	  <div class='content'>
                 <table cellpadding='0' cellspacing='0'>
                 <tr>
                 <td><img src='/images/parse/1.png' alt='*'/></td>
                 <td valign='top' style='padding-left: 5px;'><?=$i['parse']?> Уровень
                 <br/>
				 <small><small>
                 Бонус ко всем параметрам <font color='#90c090'>+ <?=$i['parse'] * 10?> ко всем параметрам</font><br />
				 Прогресс <font color='#90c090'><?=$i['parse_exp']?>/<?=$ExpParse[$user['parse']]?></font> опыта.
<div class="clr"></div>
</div>
<div class="exp_bar"><div class="progress" style="width:<?=$ExpParse_progress?>%"></div></div>
				 </font>
                 </small></small></td></tr></table>
				 </center>
                 </small></small></td>
                 </tr></table>
                 </div>
<div class='line'></div>
<div class='content'>
* Разбирайте вещи и получайте за это + к параметрам персонажа.
</div>
<?

  
include './system/f.php';

?>