<?

include '/../system/common.php';  
include '/../system/functions.php';
include '/../system/user.php';
        
$title = 'Профессии';
include '../system/h.php';  

if($user['level'] < 5) {

  echo 'Профессии доступны с 5 уровня';
exit;

}
    
$prof = array (
              'prof_farm','prof_cave'
			            );
$cost = array (
              '500','1000'
                        );
$name = array (
               'Професия фермер',
			   'Професия шахтёр'
			            );
$prof_text = array (
                'Добыча ресурсов в походе на 10% больше.',
				'Время поиска и добычи ресурсов в пещере на 20% меньше.'
				 );
$var = 1;
# for prof_farm
if($_GET['prof_farm'] == true) {
  if($profesion) $errors[] = 'Ошибка, вы уже изучили "Професию фермера" ';
  if($profesion['prof_cave'] == 1) $errors[] = 'Ошибка, доступно иметь только одну професию.';
  if($user['g'] < 500) $errors[] = 'Ошибка, нехватает <img src=\'/images/icon/g.png\' alt=\'*\'/> '.(500 - $user['g']).' золота<div class=\'separator\'></div><a href=\'/trade/\' class=\'button\'>Купить</a>';
  
  if($errors) {
    
    echo '<div class=\'content\' align=\'center\'>';
    
    foreach($errors as $error) {
      
      echo $error.'<br/>';
      
    }
  
    echo '</div>
<div class=\'line\'></div>';
  
  }
  else
  {

   mysql_query('INSERT INTO `profesion` (`user`,
                                         `prof_farm`
                                        ) VALUES ("'.$user['id'].'",
										 "'.$var.'")');  
																								
   mysql_query('UPDATE `users` SET `g` = "'.($user['g']-500).'"
                                                            WHERE `id` = "'.$user['id'].'"');

   header('location: ?');
  
  }
  }

# for prof_cave
if($_GET['prof_cave'] == true) {
  if($profesion) $errors[] = 'Ошибка, вы уже изучили "Професию Шахтёра" ';
  if($profesion['prof_farm'] == 1) $errors[] = 'Ошибка, доступно иметь только одну професию.';
  if($user['g'] < 1000) $errors[] = 'Ошибка, нехватает <img src=\'/images/icon/g.png\' alt=\'*\'/> '.(1000 - $user['g']).' золота<div class=\'separator\'></div><a href=\'/trade/\' class=\'button\'>Купить</a>';
  
  if($errors) {
    
    echo '<div class=\'content\' align=\'center\'>';
    
    foreach($errors as $error) {
      
      echo $error.'<br/>';
      
    }
  
    echo '</div>
<div class=\'line\'></div>';
  
  }
  else
  {

   mysql_query('INSERT INTO `profesion` (`user`,
                                         `prof_cave`
                                        ) VALUES ("'.$user['id'].'",
										 "'.$var.'")');  
																								
   mysql_query('UPDATE `users` SET `g` = "'.($user['g']-1000).'"
                                                            WHERE `id` = "'.$user['id'].'"');
   
   header('location: ?');
  
  }
  }


	
echo '<div class=\'title\'>'.$title.'</div>
<div class=\'line\'></div>
<div class=\'content\'>
<center>Професии - помогут вам быстрее развиватся!</center></div>
<div class=\'line\'></div>';	
for ($i = 0; $i < 2; $i++)
{
?>
     <div class ='content'>
	 <img src='/images/profesion/<?=$prof[$i];?>.png'>
	 <?=$name[$i];?> 
	 <br />
	 <?=$prof_text[$i];?><br />
	 <a class='btn' href='?<?=$prof[$i];?>=true'>
	       <span class='end'>
	       <span class='label'>Изучить за <img src='/images/icon/gold.png'>
		   <?=$cost[$i];?></span></a>
		   <br/></div>
		   <div class ='line'></div>
	
<?
}
include '/../system/f.php';

?>