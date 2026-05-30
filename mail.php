<?
include './system/common.php';  
include './system/functions.php';
include './system/user.php';
        
$title = 'Почта';
include './system/h.php'; 
        $guest_id1 = $db->prepare("SELECT * FROM users WHERE id=:id"); 
    $guest_id1->execute(array(":id" => $getid)); 
    $guest_id = $guest_id1->fetch(PDO::FETCH_BOTH);

switch($act){
  
  case 'dialog';
   $mail4 = $db -> prepare("SELECT * FROM mail WHERE uid2 = :uid2 AND uid1 = :uid1 AND proch = :proc ");
   $mail4 -> execute(array(":uid1" => $getid,":uid2" => $user['id'], ":proc" => '0'));
    $mail3 = $mail4 -> rowCount();
  if($mail3 != 0){
    $update_mail = $db->prepare("UPDATE  mail SET proch=:proc WHERE uid1=:uid1 AND uid2=:uid2"); 
    $update_mail->execute(array(":proc"=>'1',":uid1"=>$getid,":uid2"=>$user['id']));
    }
  echo '<div class="blok center">
  Диалог с '.$guest_id['login'].'
  </div>';
  if(!$_POST){
    echo '
    <div class="blok center">
    <form action="/mail/'.$getid.'" method="post">
    <textarea required placeholder="Введите сообщение от 3-1000" maxlenght="1000" rows="5" cols="30" type="text" name="text"></textarea>
               <div class="nav float_center">     
      <input class = "nav1 white submit" style="width: 35%;" type="submit" value="Отправить"/>
  <a class = "nav1 white" style="width: 35%;" style="width: 48%; display: block;" href="/mail/'.$getid.'">Обновить</a>
     <div style="clear:both;"> </div>
</div>

       <div class="spoiler">
';
?>
    <span class="submit" onclick="
        if (this.parentNode.getElementsByTagName('div')[0].style.display != '')
        {
            this.parentNode.getElementsByTagName('div')[0].style.display = '';
            this.innerText = 'свернуть';
        }
        else
        {
            this.parentNode.getElementsByTagName('div')[0].style.display = 'none';
            this.innerText = 'ББ-коды';
        }">
        ББ-коды
    </span>
<?php
echo '
    <div class="blok center" style="display: none;">
    [r]<span style="color:red">красный</span>[/r]<br/><br/>
[g]<span style="color:green">зеленый</span>[/g]<br/><br/>
[b]<span style="color:blue">синий</span>[/b]<br/><br/>
[o]<span style="color:orange">оранжевый</span>[/o]<br/><br/>
[y]<span style="color:yellow">жёлтый</span>[/y]<br/><br/>
[p]<span style="color:purple">фиолетовый</span>[/p]<br/><br/>
[l]<span style="color:lime">салатовый</span>[/l]<br/><br/>
[a]<span style="color:aqua">голубой</span>[/a]<br/><br/>
[m]<span style="color:magenta">розовый</span>[/m]<br/><br/>
Перенос строки[br/]<br/><br/>
[bo]<span style="font-weight: bold;">жирный текст</span>[/bo]<br/><br/>
    [it]<span style="font-style:italic;">наклонный текст</span>[/it]<br/><br/>
    [un]<span style="text-decoration:underline;">подчеркнутый текст</span>[/un]<br/><br/>
    [s]<span style="text-decoration: line-through;">зачеркнутый текст</span>[/s]<br/><br/>
</div></div>
    </form>
    </div>
    ';
    }else{
      if(mb_strlen(check($_POST['text'])) > 1000 OR mb_strlen(check($_POST['text'])) < 3){
    $error = $error . 'Текст не может быть короче 3 и длинее 1000 символов<br/>';
  }
    if(preg_match('/[^a-zA-Zа-яА-Я0-9]=+/',check($_POST['text'])))
{
$error = $error . 'Поле содержит запрещенные символы<br/>';    
}
if(empty($_POST['text'])){
  $error = $error . 'Вы не ввели текст';
}
     $user_check2 = $db->prepare("SELECT * FROM users WHERE id=:id"); 
    $user_check2->execute(array(":id"=>$getid)); 
    $user_check=$user_check2->rowCount();
if($user_check == '0'){
  $error = $error . 'Такого пользователя не существует';
  }
  if($getid == $user['id']){
    $error = $error . 'Вы пытаетесь написать самому себе';
    }
if(empty($error)){
           $dialog_check2 = $db->prepare("SELECT * FROM dialog WHERE uid1=:uid1 AND uid2=:uid2 OR uid2=:uid1 AND uid1=:uid2"); 
    $dialog_check2->execute(array(":uid1"=>$user['id'], ":uid2" => $getid)); 
    $dialog_check=$dialog_check2->rowCount();
if($dialog_check == 0){
   $insert_dialog = $db->prepare("INSERT INTO dialog (uid1,uid2,time) 
    VALUES (:uid1,:uid2,:time)"); 
    $insert_dialog->execute(array(
    ":uid1"=> $user['id'],
    ":uid2"=>$getid,
    ":time"=>time()));
  }
   $insert_dialog = $db->prepare("INSERT INTO mail (text,uid1,uid2,time) 
    VALUES (:text,:uid1,:uid2,:time)"); 
    $insert_dialog->execute(array(
    ":text" => check($_POST['text']),
    ":uid1"=>num($user['id']),
    ":uid2"=>num($getid),
    ":time"=>num(time())));
     $update_dialog = $db->prepare("UPDATE dialog SET time=:time WHERE uid1=:uid1 AND uid2=:uid2 OR uid1=:uid2 AND uid2=:uid1"); 
$update_dialog->execute(array(":time"=> time(),
            ":uid1"=> $user['id'], ":uid2" => $getid));
    header('location: /mail/'.$getid.'');
  }else{
  echo '<div class="block center">
  '.$error.'
  </div>';
  }
    }
$count1 = $db -> prepare("SELECT * FROM mail WHERE uid1 = :uid1 AND uid2 = :uid2 OR uid1 = :uid2 AND uid2 = :uid1 ORDER BY time DESC");
$count1 -> execute(array(":uid1" => $user['id'], ":uid2" => $getid));
$count = $count1->rowCount();
$k_page = k_page($count,10);
$page = page($k_page);
$start = 10*$page-10;
$sql  = $db -> prepare("SELECT * FROM `mail` WHERE `uid1` = :uid1 AND `uid2` = :uid2 OR `uid1` = :uid2 AND `uid2` = :uid1 ORDER BY `time` DESC LIMIT $start, 5");
$sql -> execute(array(":uid1" => $user['id'], ":uid2" => $getid));
foreach ($sql->fetchAll() as $array) {
        $select = $db->prepare("SELECT * FROM users WHERE id=:uid1"); 
    $select->execute(array(":uid1" => $array['uid2'])); 
    $select1 = $select->fetch(PDO::FETCH_BOTH);
    $select2 = $db->prepare("SELECT * FROM users WHERE id=:uid1"); 
    $select2->execute(array(":uid1" => $array['uid1'])); 
    $select3 = $select2->fetch(PDO::FETCH_BOTH);
  
echo '
<a style="text-decoration: none; "  href="/users/profile.php?id='.$select3['id'].'">'.$select3['login'].'</a><br/>
'.tags($array['text']).'<br/>
'.tl($array['time']).'
<div class = "mini-line"></div>
';
}
if($count < 1) echo '<div class = "block">Вы не начинали диалог с данным пользователем</div>';
if($count >= 10) echo str('/mail?'.$getid.'&',$k_page,$page);

  break;
  default:
echo '
<div class="menuList">';
$count1 = $db -> query("SELECT * FROM `dialog` WHERE `uid2` = ".$user['id']." OR `uid1` = ".$user['id']." ORDER BY `time` DESC");
$count = $count1->rowCount();
$k_page = k_page($count,10);
$page = page($k_page);
$start = 10*$page-10;
$sql  = $db -> query("SELECT * FROM `dialog` WHERE `uid2` = ".$user['id']." OR `uid1` = ".$user['id']." ORDER BY `time` DESC LIMIT $start, 5");
foreach ($sql->fetchAll() as $array) {

     
      $select = $db->prepare("SELECT * FROM users WHERE id=:uid1"); 
    $select->execute(array(":uid1" => $array['uid2'])); 
    $select1 = $select->fetch(PDO::FETCH_BOTH);
    $select2 = $db->prepare("SELECT * FROM users WHERE id=:uid1"); 
    $select2->execute(array(":uid1" => $array['uid1'])); 
    $select3 = $select2->fetch(PDO::FETCH_BOTH);
    
if($array['uid1'] == $user['id']){
   $mail3 = $db -> query("SELECT * FROM mail WHERE uid2 = ".$user['id']." AND uid1 = ".$array['uid2']." AND proch = 0");
    $mail2 = $mail3 -> rowCount();

echo'<li><a href="?act=dialog&id='.$array['uid2'].'" class="btnforall left">'.$select1['login'].'
';
    if($mail2 > 0){
      echo '<span class="side_img float_right">+'.$mail2.'</span>';
      }
echo '</a></li>';
}
if($array['uid2'] == $user['id']){
   $mail4 = $db -> query("SELECT * FROM mail WHERE uid2 = ".$user['id']." AND uid1 = '".$array['uid1']."' AND proch = 0");
    $mail5 = $mail4 -> rowCount();
   echo'<li><a href="/mail/'.$array['uid1'].'" class="btnforall left">'.$select3['login'].'
  ';
      if($mail5 > 0){
      echo ' <span class="side_img float_right"> +'.$mail5.'</span>';
      }
      echo '</a></li>';
  }
   
}
if($count < 1) echo '<div class = "block">У вас нету диалогов</div>';
if($count >= 10) echo str('?',$k_page,$page);
echo '</div>';
break;
}
  include './system/f.php';

?>