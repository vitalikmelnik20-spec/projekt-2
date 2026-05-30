<? 
     
    include './system/common.php'; 
     
 include './system/functions.php'; 
         
      include './system/user.php'; 


 include './system/h.php';  
$ref = _string(_num($_GET['ref']));
if(!$_POST){
echo '
<div class = "center">
<form action = "" method = "post">
<input type = "text" name = "login" placeholder = "Введите логин" required pattern = "[A-Z,a-z,А-Я,а-я,0-9\s]{5,20}"/><br/>
<input type = "password" name = "password" placeholder = "Введите пароль" required pattern = "[A-Z,a-z,А-Я,а-я,0-9\s]{5,20}"/><br/>
<input type = "password" name = "re_password" placeholder = "Введите пароль ещё раз" required pattern = "[A-Z,a-z,А-Я,а-я,0-9\s]{5,20}"/><br/>
<input type = "submit" value = "Регистрация" />
</form>
</div>';
}else{

  $login = $_POST['login'];
  $password = $_POST['password'];
  $password_has = sha1(md5(md5(sha1(md5(sha1($password))))));	$check_user_1 = $db -> prepare("SELECT * FROM users WHERE login = :login");
	$check_user_1 -> execute(array("login" => $login));
	$check_user = $check_user_1 -> rowCount();
	if($check_user > 0){
		$error = $error . 'Данный логин уже занят';
	}
if(empty($error)){
if($ref > 0){
//Тут для тех кто от реферала зашол
}else{
  mysql_query("INSERT INTO `users` SET `login` = '".$login."', `password` = '".$password_has."'");

      echo '<span class = "lime center">Вы успешно зарегестрировались теперь войдите под своим Логином и Паролем</span>
      <div class = "center">
      <a href="/?sign_in" class="vhod_glavn">Войти</a>
      </div>';
}
}else{
echo $error;
}
}
include './system/f.php';
?>