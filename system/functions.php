<?php
session_name("SESID");
session_start();
ob_start();
date_default_timezone_set('Europe/Moscow');
##############################
##### ПОДКЛЮЧЕНИЕ К БАЗЕ #####
##############################  
mb_internal_encoding('UTF-8');
@ ini_set('arg_separator.output', '&amp;');
@ ini_set('output_buffering', 'on');
@ ini_set('output_buffering', '4096');
@ ini_get('register_globals', 'off');
@ ini_set('session.use_trans_sid', '1'); 
@ ini_set('session.gc_maxlifetime', 7200); 
@ ini_set('session.cookie_lifetime', 7200);
require_once 'db.php';
$mc = @mysql_connect($db_host, $db_user, $db_password) or die('Невозможно подключиться к MySQL');
@mysql_query("SET NAMES 'utf8'", $mc);
@mysql_select_db($db_name, $mc) or die('Указаная таблица не найдена');
try {
$db = new PDO('sqlite:' . ($GLOBALS['__sqlite_path'] ?? '/data/game.db'));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
echo 'Database connection error: ' . $e->getMessage();
}




/*
if (isset($_SESSION['id']) && isset($_SESSION['password']))
  {
    $use_id = $_SESSION['id'];
    $pass = $_SESSION['password'];
  }
  elseif (isset ($_COOKIE['id']) && isset ($_COOKIE['password']))
  {
    $use_id = $_COOKIE['id'];
    $_SESSION['id'] = $use_id;
    $pass = $_COOKIE['password'];
    $_SESSION['password'] = $pass;
    $cookauth = true;
  }
  if ($use_id AND $pass)
  {
      $req = $db->prepare("SELECT * FROM users WHERE id = :id AND password = :pas LIMIT 1"); 
    $req->execute(array(":id" => base64_decode($use_id), ":pas" => $pass)); 
    if($req->fetchColumn())
    {
      $data1 = $db->prepare("SELECT * FROM users WHERE id=:id AND password = :pass LIMIT 1"); 
      $data1->execute(array(":id" => base64_decode($use_id),":pass" => $pass)); 
    $data = $data1->fetch(PDO::FETCH_BOTH);
      if ($pass === $data['password'])
      { 
        $user_id = $data['id'];
        $user_password = $data['password'];
        $user_key = check(num($data['key']));
        /*
        $user_ = check(num($data['']));
        $user_ = check(text($data['']));
        
        $data1->closeCursor();
      }
      
    }else{
session_name("SESID");
session_start();
setcookie('id', '');
setcookie('password', '');
session_destroy();
    }
 
    ///////////////


  }else{
    session_name("SESID");
session_start();
setcookie('id', '');
setcookie('password', '');
session_destroy();
  }
*/
  //Проверка прав пользователя
  function access($min_access = 0, $max_access = 4) {
    global $user_access;
    if ($user_access < $min_access OR $user_access > $max_access) {
        header('Location: /error404.php');
        exit;
    }
}
function noauth(){
  global $user;
  if(isset($user['id'])) header('Location: /menu');
}

function auth(){
  global $user;
  if(!isset($user['id'])) header('Location: /');

}
function num($m){
  $m = intval($m);
  $m = abs($m);
  return $m;
} /* Фильтрует цифры */
//Функция обработки переменных
  function check($str)
  {
    $str = htmlentities($str, ENT_QUOTES, 'UTF-8');
    $str = str_replace("\'", "&#39;", $str);
    $str = str_replace("\r\n", "<br/>", $str);
    $str = strtr($str, array(chr("0") => "", chr("1") => "", chr("2") => "", chr("3") => "", chr("4") => "", chr("5") => "", chr("6") => "", chr("7") => "", chr("8") => "", chr("9") => "", chr("10") => "", chr("11") => "", chr("12") => "", chr
    ("13") => "", chr("14") => "", chr("15") => "", chr("16") => "", chr("17") => "", chr("18") => "", chr("19") => "", chr("20") => "", chr("21") => "", chr("22") => "", chr("23") => "", chr("24") => "", chr("25") => "", chr("26") => "", chr("27") =>
    "", chr("28") => "", chr("29") => "", chr("30") => "", chr("31") => ""));
    $str = str_replace('\\', "&#92;", $str);
    $str = str_replace("|", "I", $str);
    $str = str_replace("||", "I", $str);
    $str = str_replace("/\\\$/", "&#36;", $str);
    $str = str_replace("[l]http://", "[l]", $str);
    $str = str_replace("[l] http://", "[l]", $str);
    $str = htmlentities($str);
    $str = strip_tags($str);
    $str = stripslashes($str);
    $str = addslashes($str);
    //$str = mysql_real_escape_string($str);
    return $str;
  } 
//Построчная навигация
function page($k_page=1){ // Выдает текущую страницу
    $page_1=1;
    if (isset($_GET['page'])){
    if ($_GET['page']=='end')$page_1=intval($k_page);elseif(is_numeric($_GET['page'])) $page_1=intval($_GET['page']);
}
    if ($page_1<1)$page_1=1;
    if ($page_1>$k_page)$page_1=$k_page;
    return $page_1;
}
function k_page($k_post=0,$k_p_str=10){ // Высчитывает количество страниц
    if ($k_post!=0) {
      $v_pages = ceil($k_post/$k_p_str);
      return $v_pages;
    }
    if($k_post == 0){
     return 1;
    }
}
function str($link='?',$k_page=1,$page=1){ // Вывод номеров страниц (только на первый взгляд кажется сложно ;))
    echo '<center><div class="b">';
    if ($page<1)$page=1;
    //if ($page!=1)echo "<a class='btn _green' href="".$link."page=1" title='Первая страница'><<</a> ";
    if ($page!=1)echo '<a class="side_img" href="'.$link.'page=1" title="Страница №1">1</a> ';
    else echo "<span class='btn _dark'>1</span> ";
    for ($ot=-3; $ot<=3; $ot++){
    if ($page+$ot>1 && $page+$ot<$k_page){
    if ($ot==-3 && $page+$ot>2)echo " ";
    if ($ot!=0)echo '<a class="side_img" href="'.$link.'page='.($page+$ot).'" title="Страница №'.($page+$ot).'"">'.($page+$ot).'</a> ';
    else echo "<span class='btn _dark'>".($page+$ot)."</span> ";
    if ($ot==3 && $page+$ot<$k_page-1)echo " ";
}}
    if ($page!=$k_page)echo '<a class="side_img" href="'.$link.'page=end" title="Страница №'.$k_page.'">'.$k_page.'</a> ';
    elseif ($k_page>1)echo $k_page;
    //if ($page!=$k_page)echo "<a class="btn _blue' href="".$link."page=end" title='Последняя страница'>></a> ";
    echo '</div></center>';
}
function _string($string) {
$string = trim($string);
$string = mysql_escape_string($string);
$string = htmlspecialchars($string);
return $string;
}
    
function _num($i) {
$i = (int) abs($i);
return $i;
}

 function NameBot(){
$array = array('q','w','r','t','p','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m');
			$array2 = array('e','y','u','i','o','a');
			$strlen = rand(5,6);
			$name 	= '';			
for($i = 1; $i <= $strlen; $i ++) {
				if ($i == 1) {
					$key = array_rand($array);
					$name .= $array[$key];
				}
				elseif ($i == 2) {
					$key = array_rand($array2);
					$name .= $array2[$key];
				}
				elseif ($i <= 3) {
					$key = array_rand($array);
					$name .= $array[$key];
				}
				else
				{
				
					$key = array_rand($array);
					$name .= $array[$key];
				}
			}
			$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
			return $name;
		
		}

 function time_count($timediff , $as = 0 , $ass = 0, $asss = 0, $assss = 0 , $text_view = 0, $text ='')	{
$oneMinute=60;
$oneHour=60*60;
$oneDay=60*60*24;
$dayfield=floor($timediff/$oneDay);
$hourfield=floor(($timediff-$dayfield*$oneDay)/$oneHour);
$minutefield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour)/$oneMinute);
$secondfield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour-$minutefield*$oneMinute));
		
		if ($as == true && $dayfield != 0)
		{
			$d="$dayfield д.";
		}else{
			$d= NULL;	
		}
		if ($ass == true  && $hourfield != 0)
		{
			$h=" $hourfield ч. ";
		}else{
			$h= NULL;
		}
		if ($asss == true && $minutefield != 0)
		{
			$m=" $minutefield м. ";
		}else{
	        $m= NULL;
		}
		if ($assss == true && $secondfield != 0)
		{
			$s="	 ".$secondfield." с.";
		}else{
			$s= NULL;	
		}
		
       if ($d <0 || $h < 0 || $m < 0 || $s < 0){
		   if ($text_view == true ){
		   if ($text == NULL)
			$view= 'Время истекло';
		else
			$view= $text;	
		   }else{
			   $view = NULL;
		   }
	   }else{
	 $view = $d . $h . $m . $s;	 
	   }
return  $view;
}

function n_f($i) {
if($i >= 99999 && $i < 1000000) {
$i = number_format($i, 0, '', '.');
$i = round($i,1).'k';
}
elseif($i >= 999999 && $i < 1000000000) {
$i = number_format($i, 0, '', '.');
$i = round($i,1).'m';
}
elseif($i >= 999999999 && $i < 1000000000000) {
$i = number_format($i, 0, '', '.');
$i = round($i,1).'b';
}
elseif($i >= 999999999999 && $i < 1000000000000000) {
$i = number_format($i, 0, '', '.');
$i = round($i,1).'t';
}
elseif($i >= 999999999999999 && $i < 1000000000000000000) {
$i = number_format($i, 0, '', '.');
$i = round($i,1).'q';
}
elseif($i >= 999999999999999999) {
$i = number_format($i, 0, '', '.');
$i = round($i,1).'u';
}else{
$i = number_format($i, 0, '', '\'');
}
return $i;
}


function pages($path) {
global $page, $pages;
if(($page - 1) > 0) {
echo ' <a href="'.$path.'page=1">&lt;&lt;</a> ';
}else{
echo '&lt;&lt;';
}
if($page - 1 > 0) {
echo ' <a href="'.$path.'page='.($page - 1).'">&lt;</a> ';
} else{
echo ' &lt; ';
}
if($page == $pages && $page - 4 > 0) {
echo ' <a href="'.$path.'page='.($page - 4).'">'.($page - 4).'</a> ';
}
if($page == $pages && $page - 3 > 0) {
echo ' <a href="'.$path.'page='.($page - 3).'">'.($page - 3).'</a> ';
}
if($page - 2 > 0) {
echo ' <a href="'.$path.'page='.($page - 2).'">'.($page - 2).'</a> ';
}
if($page - 1 > 0) {
echo ' <a href="'.$path.'page='.($page - 1).'">'.($page - 1).'</a> ';
}
echo $page;
if($page + 1 <= $pages) {
echo ' <a href="'.$path.'page='.($page + 1).'">'.($page + 1).'</a> ';
}
if($page + 2 <= $pages) {
echo ' <a href="'.$path.'page='.($page + 2).'">'.($page + 2).'</a> ';
}
if($page == 1 && $page + 3 <= $pages) {
echo ' <a href="'.$path.'page='.($page + 3).'">'.($page + 3).'</a> ';
}
if($page == 1 && $page + 4 <= $pages) {
echo ' <a href="'.$path.'page='.($page + 4).'">'.($page + 4).'</a> ';
}
if($page + 1 <= $pages) {
echo ' <a href="'.$path.'page='.($page + 1).'">&gt;</a> ';
}else{
echo ' &gt; ';
}
if(($page + 1) <= $pages) {
echo ' <a href="'.$path.'page='.$pages.'">&gt;&gt;</a> ';
}else{
echo ' &gt;&gt; ';
}
}

function bbcode($str)
{

//$str = strip_tags($str);
//$str=preg_replace("/@(.+)\@/Usi","<a href='/site.php?nick=\\1'>\\1</a>",$str);
//$str = preg_replace("/@(. )/si","<a href='/site.php?nick=\\1'>\\1</a>",$str);
$str=preg_replace("/\[b\](.+)\[\/b\]/Usi","<strong>\\1</strong>",$str);
$str=preg_replace("/\[i\](.+)\[\/i\]/Usi","<em>\\1</em>",$str);
$str=preg_replace("/\[u\](.+)\[\/u\]/Usi","<u>\\1</u>",$str);
$str=preg_replace("/\[s\](.+)\[\/s\]/Usi","<s>\\1</s>",$str);
//$str=preg_replace("/\[b\](.+)\[\/b\]/Usi","<big>\\1</big>",$str);
$str=preg_replace("/\[small\](.+)\[\/small\]/Usi","<small>\\1</small>",$str);
$str=preg_replace("/\[sup\](.+)\[\/sup\]/Usi","<sup>\\1</sup>",$str);
$str=preg_replace("/\[sub\](.+)\[\/sub\]/Usi","<sub>\\1</sub>",$str);
$str=preg_replace("/\[code\](.+)\[\/code\]/Usi","<code>\\1</code>",$str);
$str=preg_replace("/\[color=(.*)](.*)\[\/color\]/Usi", "<font color='\\1'>\\2</font>", $str);
$str=preg_replace("/\[rang=(.*)](.*)\[\/rang\]/Usi", "<div style='background-color:\\1'>\\2</div>", $str);
$str=preg_replace("/\[size=(.*)\](.*)\[\/size\]/Usi", "<span style=\"font-size:\\1\">\\2</span>", $str);
$str=preg_replace("/\[img=(.*)\]/Usi","<img src='\\1' border=\"0\"/>",$str);
$str=preg_replace("/\[br]/Usi","<br>",$str);
$str=preg_replace("/\[hr]/Usi","<hr>",$str);
//$str = preg_replace("/@(.*)/si","<a href='/site.php?nick=\\1'>$1</a>",$str);
$str=preg_replace("/\[url=(.*)\](.*)\[\/url\]/Usi","<a href='\\1'>\\2</a>",$str);
$str=preg_replace("/\[center](.*)\[\/center\]/Usi","<div align=center>\\1</div>",$str);
$str=preg_replace("/\[right](.*)\[\/right\]/Usi","<div align=right>\\1</div>",$str);
$str=preg_replace("/\[left](.*)\[\/left\]/Usi","<div align=left>\\1</div>",$str);
$str=str_replace("\r\n","<br/>",$str);
return $str;
}

function bbfunc($str)
{

$str=preg_replace("/\<strong\>(. )\<\/strong\>/Usi","[b]\\1[/b]",$str);
$str=preg_replace("/\<em\>(. )\<\/em\>/Usi","[i]\\1[/i]",$str);
$str=preg_replace("/\<u\>(. )\<\/u\>/Usi","[u]\\1[/u]",$str);
$str=preg_replace("/\<s\>(. )\<\/s\>/Usi","[s]\\1[/s]",$str);
$str=preg_replace("/\<big\>(. )\<\/big\>/Usi","[big]\\1[/big]",$str);
$str=preg_replace("/\<small\>(. )\<\/small\>/Usi","[small]\\1[/small]",$str);
$str=preg_replace("/\<sup\>(. )\<\/sup\>/Usi","[sup]\\1[/sup]",$str);
$str=preg_replace("/\<sub\>(. )\<\/sub\>/Usi","[sub]\\1[/sub]",$str);
$str=preg_replace("/\<code\>(. )\<\/code\>/Usi","[code]\\1[/code]",$str);
$str=preg_replace("/\<br\/>/Usi", "\n", $str);
$str=preg_replace("/\<span style=\"color:(.*)\">(.*)\<\/span\>/Usi","[color=\\1]\\2[/color]", $str);
$str=preg_replace("/\<span style=\"font-size:(.*)\">(.*)\<\/span\>/Usi", "[size=\\1]\\2[/size]", $str);
$str=preg_replace("/\<img src='(.*)'\ alt='(.*)'\ border=\"0\"\/>/Usi","[img=\\1]\\2[/img]",$str);

//$str = strip_tags($str);

return $str;
}

	
    function smiles($string) {
    
      $string = str_replace(array(':@)',':ded'), '<img src="/images/smiles/mini_ded.gif" alt="*"/>',      $string);

      $string = str_replace(array('O:-)','o:-)'),'<img src="/images/smiles/mini_angel.gif" alt="*"/>',      $string);

      $string = str_replace(array(']:-)',']:-]'),'<img src="/images/smiles/mini_diablo.gif" alt="*"/>',     $string);

      $string = str_replace(array(':$',':-$',':-['),'<img src="/images/smiles/mini_blush.gif" alt="*"/>',        $string);

      $string = str_replace(array(':))',':-))','-))','=))'),'<img src="/images/smiles/mini_lol.gif" alt="*"/>',         $string);

      $string = str_replace(array(':)',':-)','=)'),'<img src="/images/smiles/mini_ulibka.gif" alt="*"/>',       $string);

      $string = str_replace(array(';)',';-)'),'<img src="/images/smiles/mini_podmigivanie.gif" alt="*"/>', $string);

      $string = str_replace(array(':-D',':-d',':D',')))'),'<img src="/images/smiles/mini_spin.gif" alt="*"/>',        $string);

      $string = str_replace(array(':-P',':-p',':-Р',':-р',':P',':p'),'<img src="/images/smiles/mini_yazyk.gif" alt="*"/>', $string);

      $string = str_replace(array(':(',':-('),'<img src="/images/smiles/mini_sad.gif" alt="*"/>',        $string);

      $string = str_replace(array(':\'(',':\'-('),'<img src="/images/smiles/mini_cry.gif" alt="*"/>',        $string);

      $string = str_replace(array(':354',':354:'),'<img src="/images/smiles/354.gif" alt="*"/>',        $string);

      $string = str_replace(array(':]',':-]'),'<img src="/images/smiles/mini_dovolen.gif" alt="*"/>',        $string);

      $string = str_replace(array(':-/',':-\\'),'<img src="/images/smiles/mini_hm.gif" alt="*"/>',        $string);

      $string = str_replace(array('8-)','%-)'),'<img src="/images/smiles/mini_krut.gif" alt="*"/>',        $string);

      $string = str_replace(array(':*',':-*'),'<img src="/images/smiles/mini_kiss.gif" alt="*"/>',        $string);

      $string = str_replace(array('%)','%-)'),'<img src="/images/smiles/mini_crazy.gif" alt="*"/>',        $string);

      $string = str_replace(array(':-o',':-O',':-о',':-О','O.o','О.о','O_o','o_O'),'<img src="/images/smiles/mini_chok.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1004'),'<img src="/images/smiles/1004.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1005'),'<img src="/images/smiles/1005.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1006'),'<img src="/images/smiles/1006.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1007'),'<img src="/images/smiles/1007.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1008'),'<img src="/images/smiles/1008.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1009'),'<img src="/images/smiles/1009.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1010'),'<img src="/images/smiles/1010.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1011'),'<img src="/images/smiles/1011.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1012'),'<img src="/images/smiles/1012.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1013'),'<img src="/images/smiles/1013.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1014'),'<img src="/images/smiles/1014.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1015'),'<img src="/images/smiles/1015.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1016'),'<img src="/images/smiles/1016.gif" alt="*"/>',        $string);




    $string = str_replace(array(':da',':да'),'<img src="/images/smiles/agree.gif" alt="*"/>',        $string);
      $string = str_replace(array(':привет',':ку'),'<img src="/images/smiles/mini_bye.gif" alt="*"/>',        $string);

      $string = str_replace(array(':Ob',':ob'),'<img src="/images/smiles/mini_good.gif" alt="*"/>',        $string);

      $string = str_replace(array('6-(','%-E',':gigi'),'<img src="/images/smiles/mini_fingal.gif" alt="*"/>',        $string);
      
      $string = str_replace(array(':bravo',':браво'),'<img src="/images/smiles/mini_bravo.gif" alt="*"/>',        $string);
      
      $string = str_replace(array(':heart',':сердце'),'<img src="/images/smiles/mini_heart.gif" alt="*"/>',        $string);
      
      $string = str_replace(array(':fig',':фиг'),'<img src="/images/smiles/mini_fig.gif" alt="*"/>',          $string);
      
      $string = str_replace(array(':rose',':роза','@--'),'<img src="/images/smiles/mini_rose.gif" alt="*"/>',        $string);
      
      $string = str_replace(array(':krut',':крут'),'<img src="/images/smiles/mini_krut.gif" alt="*"/>',        $string);
      $string = str_replace(array(':ban',':банька'),'<img src="/images/smiles/mini_ban.gif" alt="*"/>',        $string);
      $string = str_replace(array(':clos',':закрыто'),'<img src="/images/smiles/mini_closed.gif" alt="*"/>',        $string);
$string = str_replace(array('flyd',':флуд'),'<img src="http://tiwar.ru/images/smiles/mini_flood.gif" alt="*"/>',        $string);
      $string = str_replace(array(':bg','бедный'),'<img src="/images/smiles/mini_bg.gif" alt="*"/>',        $string);
      $string = str_replace(array(':az',':выпьем'),'<img src="/images/smiles/mini_az.gif" alt="*"/>',        $string);
      $string = str_replace(array(':bc',':сос'),'<img src="/images/smiles/mini_bc.gif" alt="*"/>',        $string);
      $string = str_replace(array(':bi'),'<img src="/images/smiles/mini_bi.gif" alt="*"/>',        $string);
      $string = str_replace(array(':904'),'<img src="/images/smiles/904.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1000'),'<img src="/images/smiles/1000.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1001'),'<img src="/images/smiles/1001.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1002'),'<img src="/images/smiles/1002.gif" alt="*"/>',        $string);
      $string = str_replace(array(':1003'),'<img src="/images/smiles/1003.gif" alt="*"/>',        $string);
     $string = str_replace(array(':splat'),'<img src="/images/icon/plat.png" alt="*"/>',        $string);

     $string = str_replace(array(':m'),'<img src="/images/icon/mana.png" alt="*"/>',        $string);
      $string = str_replace(array(':g'),'<img src="/images/icon/gold.png" alt="*"/>',        $string);
    $string = str_replace(array(':s'),'<img src="/images/icon/silver.png" alt="*"/>',        $string);
    $string = str_replace(array(':a'),'<img src="/images/icon/arena.png" alt="*">[url=/arena]Aрена<img src="/images/icon/arena.png" alt="*"/>[/url]',        $string);
      $string = str_replace(array('dOOb','doob','d00b'),'<img src="/images/smiles/mini_friends.gif" alt="*"/>',        $string);
$string=bbcode($string);
    return $string;
    
    }





    function _time($i) {

      $h  = floor(($i / 3600) - $d * 24); 
      
      $m  = floor(($i - $h * 3600 - $d * 86400) / 60); 
      
      $s  = $i - ($m * 60 + $h * 3600 + $d * 86400);
    
      
    return ($h > 0 ? ($h < 10 ? '0':'').$h.':':'').($m > 0 ? ($m < 10 ? '0':'').$m.':':'00:').($s > 0 ? ($s < 10 ? '0':'').$s:'00');
    
    }
    
    function bb($string) {
      
      $string = str_replace("\r\n","<br/>",$string);

    
    return $string;
    
    }
    



   function _timeban($i) {

      $d  = floor($i / 86400); 
      
      $h  = floor(($i / 3600) - $d * 24); 
      
      $m  = floor(($i - $h * 3600 - $d * 86400) / 60); 
      
      $s  = $i - ($m * 60 + $h * 3600 + $d * 86400);

    
      if($d > 0) {
      
        $result = $d.' дней';
       
      }
      elseif($h > 0)
                 {
       
        $result = $h.' ч.';
                
      }elseif($m > 0)
                 {
       
      $result = $m.' мин.';
                
      }elseif($s >= 0)
                 {
       
      $result = $s.' сек.';
                
      }

  return $result.' до окончания бана.';
  
  }





    function _times($i) {

      $d  = floor($i / 86400); 
      
      $h  = floor(($i / 3600) - $d * 24); 
      
      $m  = floor(($i - $h * 3600 - $d * 86400) / 60); 
      
      $s  = $i - ($m * 60 + $h * 3600 + $d * 86400);

    
      if($d > 0) {
      
        $result = $d.' д';
       
      }
      elseif($h > 0)
                 {
       
        $result = $h.' ч';
                
      }elseif($m > 0)
                 {
       
      $result = $m.' мин';
                
      }elseif($s >= 0)
                 {
       
      $result = $s.' сек';
                
      }

  return $result.' назад';
  
  }

function vremja($time=NULL)
{
global $user;
if ($time==NULL)$time=time();
if (isset($user))$time=$time+$user['set_timesdvig']*60*60;
$timep="".date("j M Y в H:i", $time)."";
$time_p[0]=date("j n Y", $time);
$time_p[1]=date("H:i", $time);
if ($time_p[0]==date("j n Y"))$timep=date("H:i:s", $time);
if (isset($user)){
if ($time_p[0]==date("j n Y", time()+$user['set_timesdvig']*60*60))$timep=date("H:i:s", $time);
if ($time_p[0]==date("j n Y", time()-60*60*(24-$user['set_timesdvig'])))$timep="Вчера в $time_p[1]";}
else{

if ($time_p[0]==date("j n Y"))$timep=date("H:i:s", $time);
if ($time_p[0]==date("j n Y", time()-60*60*24))$timep="Вчера в $time_p[1]";}
$timep=str_replace("Jan","Янв",$timep);
$timep=str_replace("Feb","Фев",$timep);
$timep=str_replace("Mar","Марта",$timep);
$timep=str_replace("May","Мая",$timep);
$timep=str_replace("Apr","Апр",$timep);
$timep=str_replace("Jun","Июня",$timep);
$timep=str_replace("Jul","Июля",$timep);
$timep=str_replace("Aug","Авг",$timep);
$timep=str_replace("Sep","Сент",$timep);
$timep=str_replace("Oct","Окт",$timep);
$timep=str_replace("Nov","Ноября",$timep);
$timep=str_replace("Dec","Дек",$timep);
return $timep;
}
  
  
function p_1($l){ if($l == 1){ $result = 13400; } elseif($l == 2) { $result = 21700; } elseif($l == 3) { $result = 36100; } elseif($l == 4) { $result = 56000; } elseif($l == 5) { $result = 72000; } elseif($l == 6) { $result = 500; } elseif($l == 7) { $result = 1000; } elseif($l == 8) { $result = 1400; } elseif($l == 9) { $result = 2500; } elseif($l == 10) { $result = 1800; } elseif($l == 11) { $result = 2100; } return $result; } function p_2($l){ if($l == 1){ $result = 9200; } elseif($l == 2) { $result = 11760; } elseif($l == 3) { $result = 22640; } elseif($l == 4) { $result = 35450; } elseif($l == 5) { $result = 56430; } elseif($l == 6) { $result = 500; } elseif($l == 7) { $result = 1000; } elseif($l == 8) { $result = 1400; } elseif($l == 9) { $result = 2500; } elseif($l == 10) { $result = 1800; } return $result; } function p_3($l){ if($l == 1){ $result = 11000; } elseif($l == 2) { $result = 22000; } elseif($l == 3) { $result = 33000; } elseif($l == 4) { $result = 44000; } elseif($l == 5) { $result = 55000; } elseif($l == 6) { $result = 500; } elseif($l == 7) { $result = 1000; } elseif($l == 8) { $result = 1400; } elseif($l == 9) { $result = 2500; } elseif($l == 10) { $result = 1800; } return $result; } function p_4($l){ if($l == 1){ $result = 5000; } elseif($l == 2) { $result = 10000; } elseif($l == 3) { $result = 15000; } elseif($l == 4) { $result = 20000; } elseif($l == 5) { $result = 30000; } elseif($l == 6) { $result = 500; } elseif($l == 7) { $result = 1000; } elseif($l == 8) { $result = 1400; } elseif($l == 9) { $result = 2500; } elseif($l == 10) { $result = 1800; } return $result; } function up_1($l){ if($l == 1){ $result = 10; } elseif($l == 2) { $result = 15; } elseif($l == 3) { $result = 20; } elseif($l == 4) { $result = 25; } elseif($l == 5) { $result = 30; } elseif($l == 6) { $result = 35; } elseif($l == 7) { $result = 40; } elseif($l == 8) { $result = 45; } elseif($l == 9) { $result = 50; } elseif($l == 10) { $result = 55; } return $result; } function up_2($l){ if($l == 1){ $result = 11; } elseif($l == 2) { $result = 13; } elseif($l == 3) { $result = 15; } elseif($l == 4) { $result = 20; } elseif($l == 5) { $result = 25; } elseif($l == 6) { $result = 30; } elseif($l == 7) { $result = 35; } elseif($l == 8) { $result = 40; } elseif($l == 9) { $result = 45; } elseif($l == 10) { $result = 50; } return $result; } function up_3($l){ if($l == 1){ $result = 12; } elseif($l == 2) { $result = 18; } elseif($l == 3) { $result = 36; } elseif($l == 4) { $result = 48; } elseif($l == 5) { $result = 52; } elseif($l == 6) { $result = 66; } elseif($l == 7) { $result = 72; } elseif($l == 8) { $result = 18; } elseif($l == 9) { $result = 84; } elseif($l == 10) { $result = 90; } return $result; } function up_4($l){ if($l == 1){ $result = 4; } elseif($l == 2) { $result = 8; } elseif($l == 3) { $result = 12; } elseif($l == 4) { $result = 16; } elseif($l == 5) { $result = 20; } elseif($l == 6) { $result = 24; } elseif($l == 7) { $result = 28; } elseif($l == 8) { $result = 32; } elseif($l == 9) { $result = 36; } elseif($l == 10) { $result = 40; } return $result; } function cena_m2($id = 0){ $sell = mysql_fetch_array (mysql_query("SELECT * FROM `user_pets` WHERE `id` = '".$id."'")); $cena = mysql_fetch_array (mysql_query("SELECT * FROM `pets_tj` WHERE `name` = '".$sell ['name']."'")); $st = $cena['g']; if($cena['g'] != '0') { $default_money2 = $st / 2; } else { $default_money2 = '0'; } if($sell['tune_1'] < '6') { $tune_1_money2 = '0'; } elseif($sell['tune_1'] == '6') { $tune_1_money2 = '20'; } elseif($sell['tune_1'] == '7') { $tune_1_money2 = '70';
} elseif($sell['tune_1'] == '8') { $tune_1_money2 = '140'; } elseif($sell['tune_1'] == '9') { $tune_1_money2 = '280'; } elseif($sell['tune_1'] == '10') { $tune_1_money2 = '370'; } if($sell['tune_2'] < '6') { $tune_2_money2 = '0'; } elseif($sell['tune_2'] == '6') { $tune_2_money2 = '20'; } elseif($sell['tune_2'] == '7') { $tune_2_money2 = '70'; } elseif($sell['tune_2'] == '8') { $tune_2_money2 = '140'; } elseif($sell['tune_2'] == '9') { $tune_2_money2 = '280'; } elseif($sell['tune_2'] == '10') { $tune_2_money2 = '370'; } if($sell['tune_3'] < '6') { $tune_3_money2 = '0'; } elseif($sell['tune_3'] == '6') { $tune_3_money2 = '20'; } elseif($sell['tune_3'] == '7') { $tune_3_money2 = '70'; } elseif($sell['tune_3'] == '8') { $tune_3_money2 = '140'; } elseif($sell['tune_3'] == '9') { $tune_3_money2 = '280'; } elseif($sell['tune_3'] == '10') { $tune_3_money2 = '370'; } if($sell['tune_4'] < '6') { $tune_4_money2 = '0'; } elseif($sell['tune_4'] == '6') { $tune_4_money2 = '20'; } elseif($sell['tune_4'] == '7') { $tune_4_money2 = '70'; } elseif($sell['tune_4'] == '8') { $tune_4_money2 = '140'; } elseif($sell['tune_4'] == '9') { $tune_4_money2 = '280'; } elseif($sell['tune_4'] == '10') { $tune_4_money2 = '370'; } $count = $default_money2 + $tune_1_money2 + $tune_2_money2 + $tune_3_money2 + $tune_4_money2 ; if($count != 0) { $cnt = $count; } else { $cnt = '0'; } return intval($cnt); } function cena_m($id = 0){ $sell = mysql_fetch_array (mysql_query("SELECT * FROM `user_pets` WHERE `id` = '".$id."'")); $cena = mysql_fetch_array (mysql_query("SELECT * FROM `pets_tj` WHERE `name` = '".$sell ['name']."'")); $st = $cena['rubins']; if($cena['rubins'] != '0') { $default_money = $st / 2; } else { $default_money = '0'; } if($sell['tune_1'] == '2') { $tune_1_money = '670'; } elseif($sell['tune_1'] == '3') { $tune_1_money = '1755'; } elseif($sell['tune_1'] == '4') { $tune_1_money = '3560'; } elseif($sell['tune_1'] == '5') { $tune_1_money = '6360'; } elseif($sell['tune_1'] >= '6') { $tune_1_money = '9960'; } if($sell['tune_2'] == '2') { $tune_2_money = '4600'; } elseif($sell['tune_2'] == '3') { $tune_2_money = '1048'; } elseif($sell['tune_2'] == '4') { $tune_2_money = '2180'; } elseif($sell['tune_2'] == '5') { $tune_2_money = '3952'; } elseif($sell['tune_2'] >= '6') { $tune_2_money = '6773'; } if($sell['tune_3'] == '2') { $tune_3_money = '550'; } elseif($sell['tune_3'] == '3') { $tune_3_money = '1650'; } elseif($sell['tune_3'] == '4') { $tune_3_money = '3300'; } elseif($sell['tune_3'] == '5') { $tune_3_money = '5500'; } elseif($sell['tune_3'] >= '6') { $tune_3_money = '8250'; } if($sell['tune_4'] == '2') { $tune_4_money = '250'; } elseif($sell['tune_4'] == '3') { $tune_4_money = '750'; } elseif($sell['tune_4'] == '4') { $tune_4_money = '1500'; } elseif($sell['tune_4'] == '5') { $tune_4_money = '2500'; } elseif($sell['tune_4'] >= '6') { $tune_4_money = '4000'; } $count = $default_money + $tune_1_money + $tune_2_money + $tune_3_money + $tune_4_money; if($count != 0) { $cnt = $count; } else { $cnt = '0'; } return intval($cnt); }
function tags($var = '') {
    ////////////////////////////////////////////////////////////
    // Обработка ссылок и тэгов BBCODE в тексте               //
    ////////////////////////////////////////////////////////////
   
    $var = preg_replace('#\[bo\](.*?)\[/bo\]#si', '<span style="font-weight: bold;">\1</span>', $var);
    $var = preg_replace('#\[it\](.*?)\[/it\]#si', '<span style="font-style:italic;">\1</span>', $var);
    $var = preg_replace('#\[un\](.*?)\[/un\]#si', '<span style="text-decoration:underline;">\1</span>', $var);
    $var = preg_replace('#\[s\](.*?)\[/s\]#si', '<span style="text-decoration: line-through;">\1</span>', $var);
    $var = preg_replace('#\[r\](.*?)\[/r\]#si', '<span style="color:red;">\1</span>', $var);
    $var = preg_replace('#\[g\](.*?)\[/g\]#si', '<span style="color:green;">\1</span>', $var);
    $var = preg_replace('#\[b\](.*?)\[/b\]#si', '<span style="color:blue;">\1</span>', $var);
    $var = preg_replace('#\[o\](.*?)\[/o\]#si', '<span style="color:#FFA500;">\1</span>', $var);
    $var = preg_replace('#\[y\](.*?)\[/y\]#si', '<span style="color:yellow;">\1</span>', $var);
    $var = preg_replace('#\[p\](.*?)\[/p\]#si', '<span style="color:purple;">\1</span>', $var);
     $var = preg_replace('#\[l\](.*?)\[/l\]#si', '<span style="color:lime;">\1</span>', $var);
      $var = preg_replace('#\[a\](.*?)\[/a\]#si', '<span style="color:aqua;">\1</span>', $var);
       $var = preg_replace('#\[m\](.*?)\[/m\]#si', '<span style="color:#E9967A;">\1</span>', $var);
        $var = preg_replace('#(.*?)\[br/\]#si', '\1<br/>', $var);
  $var = preg_replace('#\[q\](.*?)\[/q\]#si', '<div class="quote">\1</div>', $var);
    return $var;
}
/* Вывод оставшегося времени */
function tl($tl1) {
     $tl = time() - $tl1;
    $d = 3600 * 24;
    $day = floor($tl / $d);
    $tl = $tl - ($d * $day);
    $hour = floor($tl / 3600);
    $tl = $tl - (3600 * $hour);
    $minute = floor($tl / 60);
    $tl = $tl - (60 * $minute);
    $second = floor($tl);
    $dayt = "" . ($day > 0 ? "$day д. " : null) . "";
    $hourt = "" . ($hour > 0 ? "$hour ч. " : null) . "";
    $minutet = "" . ($minute > 0 ? "$minute м. " : null) . "";
    $secondt = "" . ($second > 0 ? "$second с. " : null) . "";
    if ($day > 0) {
        $minutet = NULL;
        $secondt = NULL;
    }
    if ($hour > 0 && $day == 0) {
        $secondt = NULL;
        $dayt = NULL;
    }

    return "$dayt$hourt$minutet$secondt";
}

$act = isset ($_GET['act']) ? htmlspecialchars(stripslashes(trim($_GET['act']))) : '';
$getid = isset ($_GET['id']) ? htmlspecialchars(stripslashes(trim($_GET['id']))) : '';
$error = false;
?>
