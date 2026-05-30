<?
define('wk_id', '398'); //id площадки
define('wk_code', 'XPpEv8NC6PSruUBf'); //секретный код

//цена на золото количество=>цена
$wk_cena_gold=array('6500'=>'10.50',  '18000'=>'23.50', '40500'=>'55.00', '89000'=>'100.50'  , '100400'=>'150.50' ,'600000'=>'720.50' );

function wk_summ($summ)
{
return number_format(floatval($summ), 2, '.', '');
}
?>