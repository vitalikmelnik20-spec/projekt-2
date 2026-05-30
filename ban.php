<?
    
    include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user OR !$ban) {


  header('location: /');
    
exit;

}

    $title = 'Бан';    

include './system/h.php';

mysql_query('DELETE FROM `ban`  WHERE `user` = "10305"'); 
?>

<div class='main'>
  <div class='block_zero' align='center'>Вы заблокированы!
<br>Осталось: <?=_time($ban['time'] - time())?><br/>
Дождитесь окончания бана.
  </div>
</div>

<?

include './system/f.php';
  
?>