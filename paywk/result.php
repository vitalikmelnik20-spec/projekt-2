<?php
if (isset($_POST['WK_PAY_AMOUNT']) && isset($_POST['WK_PAY_TIME']) && isset($_POST['WK_PAY_HASH']))
{
include '../system/common.php';
include ('sett.php');

$common_string = wk_id.$_POST['WK_PAY_AMOUNT'].$_POST['WK_PAY_TIME'].wk_code;
$hash = strtoupper(hash("sha256",$common_string));
if($hash!=$_POST['WK_PAY_HASH']) exit('NO HACK!');

$summ = wk_summ($_POST['WK_PAY_AMOUNT']);
$id = abs(intval($_POST['WK_PAY_USER']));
$count = abs(intval($_POST['WK_PAY_COUNT']));
$type = $_POST['WK_PAY_TOVAR'];

if($type == 'gold' && isset($wk_cena_gold[$count]) && $wk_cena_gold[$count]==$summ)
{
mysql_query("UPDATE `users` SET `g` = `g` + '".$count."'  WHERE `id` = '".$id."'");


exit('YES');
}
}
?>
