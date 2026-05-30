
<?php

include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';
    
if(!$user) {

  header('location: /');
    
exit;

}


    $title = 'Найденные Артефакты';    




include './system/h.php';



?><div class='line'></div><div class='verx'>    <table>

        <tr>
            <td style="width: 45px;"><img src="azart/hp.png" style="box-shadow: 0px 0px 20px green; margin: 10px;"></td>





<td>
Полюс Титана(<img src="images/icon/health.png">+ <?=$user['azart_1']?>)</br></br></br>


























                </div>
            </td>
        </tr>
</table><? 


?><div class='line'></div><?




?><div class='line'></div><div class='verx'>    <table>

        <tr>
            <td style="width: 45px;"><img src="azart/def.png" style="box-shadow: 0px 0px 20px blue; margin: 10px;"></td>





<td>
Осколок Луны (<img src="images/icon/def.png">+<?=$user['azart_2']?>) </br>



</div>
            </td>
        </tr>
</table><? 

?><div class='line'></div><?


?><div class='line'></div><div class='verx'>    <table>

        <tr>
            <td style="width: 45px;"><img src="azart/str.png" style="box-shadow: 0px 0px 20px violet; margin: 10px;"></td>





<td>
Перо Солнца(<img src="images/icon/str.png">+<?=$user['azart_3']?>) </br>


</div>
            </td>
        </tr>
</table><? 



include './system/f.php';
