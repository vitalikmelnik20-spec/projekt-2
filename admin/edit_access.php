<? 

require_once '../system/common.php'; 
require_once '../system/functions.php';
require_once '../system/user.php'; 
if(!$user OR $user['access']!='2'){ 
    header("Location:/"); 
    exit; 
} 

$title='Редактор прав'; 
require_once '../system/h.php'; 

$acc = array("Пользователь","Модератор","Администратор");
$val=abs(intval($_GET['val'])); 
$edit=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='$val'"));

if($edit['id']==1){ 

    $_SESSION['light']="Нельзя редактировать гл.Администратора!";
    header("Location:/"); 
    exit; 

} 

if(isset($_GET['change']) && !empty($val) && isset($edit) ){ 

    $_access=_string(_num($_POST['access']));
    mysql_query("UPDATE `users` SET `access`='$_access' WHERE `id`='$val'");
    $_SESSION['light']="Права игрока успешно изменены.";
    header("Location:/user/".$edit['id']."");
    exit; 

} 

if(!$edit){ 
    $_SESSION['light']="Игрок не найден.";
    header("Location:/adm/"); 
    exit; 
} 



?> 
<div class='content'/> 
<form action='/admin/edit_access.php?val=<?=$edit['id'];?>&amp;change' method='post'/> 
    ID игрока: 
    <input type='text' value='<?=$edit['id'];?>' disabled/> 
    <br/> 
    <? 
    for($i=0;$i<3;$i++){ 
        ?> 
        <? 
    } 
    ?> 
    <span class='dred'/> Выдать права: </span>
    <select name='access'/> 
    <? 
    for($i=0;$i<3;$i++){ 
        ?> 
        <option value='<?=$i;?>'><?=$acc[$i];?></option> 

        <? 
    } 

    ?> 
    </select/> 
    <br/> 
    <input type='submit' value='Изменить'/>
    </form/> 
</div> 

<div class='menuList'/> 
<li> 
    <a href='/user/<?=$edit['id'];?>'/> Вернуться к профилю</a> 
</li> 
</div> 

<? 

require_once '../system/f.php'; 

?>