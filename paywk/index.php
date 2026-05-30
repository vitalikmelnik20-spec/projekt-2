<?
include '../system/common.php';
include '../system/functions.php';
include '../system/user.php';
if(!isset($user)){header('location: /');exit;}
$title = 'Покупка золота';
include '../system/h.php';
include 'sett.php';
?>
<div class="title">Покупка золота </div>
<div class="content">У вас: <img src="/images/icon/gold.png"> <?=$user['g'];?></div>
<div class="line"></div>
<?
if(isset($_GET['gold']))
{
$gold = intval($_GET['gold']);
if (isset($wk_cena_gold[$gold]))
{?>
<form method="POST" action="https://wapkassa.ru/merchant/oplata.php">
<input type="hidden" name="WK_PAYMENT_SITE" value="<?=wk_id?>">
<input type="hidden" name="WK_PAYMENT_AMOUNT" value="<?=wk_summ($wk_cena_gold[$gold])?>">
<input type="hidden" name="WK_PAYMENT_COMM" value="Покупка золота ID <?=$user['id']?>">
<input type="hidden" name="WK_PAYMENT_HASH" value="<?=strtoupper(hash("sha256",wk_id.wk_summ($wk_cena_gold[$gold]).wk_code))?>">
<input type="hidden" name="WK_PAYMENT_USER" value="<?=$user['id']?>">
<input type="hidden" name="WK_PAYMENT_TOVAR" value="gold">
<input type="hidden" name="WK_PAYMENT_COUNT" value="<?=$gold?>">
<input type="submit" value="Перейти к оплате">
</form>
<?
include '../system/f.php';
exit;
}
}

foreach($wk_cena_gold as $key => $value)
{
echo "<a href='/paywk/?gold=$key'>Купить $key золота</a><br>";
}

include '../system/f.php';
?>
