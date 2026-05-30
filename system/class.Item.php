<?
/**
 * @ XxxDIABLOxxX
 *
 * @ Create class Item 
 * 
 * @ Date 13.02.2017 15:03 
 */

class Item {
	
	 /**
     * Item array
     *
     * @param string $ItemArray
     * @return none
     */
	
	private $ItemArray = array (
	
                  'quality' => array(0 => 'Простой', 1 => 'Обычный', 2 => 'Редкий', 3 => 'Эпический', 4 => 'Легенарный', 5 => 'Божественный', 6 => 'Сверх Божественный'),
				  'quality_color' => array(0 => '#986', 1 => '#6c3', 2 => '#69c', 3 => '#c6f', 4 => '#f60', 5 => '#999', 6 => '#999'),
				  'bonus' => array(0 => '0', 1 => '5', 2 => '10', 3 => '15', 4 => '20', 5 => '50', 6 => '65'),
				  'w' => array(1 => '_str', 2 => '_vit', 3 => '_def', 4 => '_agi', 5 => '_str', 6 => '_str', 7 => '_def', 8 => '_vit'),
				  'rune_name' => array(1 => 'силы', 2 => 'жизни', 3 => 'жизни', 4 => 'удачни', 5 => 'силы', 6 => 'силы', 7 => 'брони', 8 => 'жизни'),
				  'rune_stats' => array(1 => '75', 2 => '150', 3 => '250', 4 => '600', 5 => '1000')
                 
				 ) ;
				  
				  private $ItemParam = array(
				  
				  'bonusItem' => array(1 => '6', 2 => '15', 3 => '25', 4 => '40', 5 => '200', 6 => '260'),
				  'smithItem' => array(1 => '24', 2 => '28', 3 => '32', 4 => '36', 5 => '40', 6 => '44',7 => '52', 8 => '56', 9 => '60', 10 => '64', 11 => '68', 12 => '72',13 => '76', 14 => '80', 15 => '84', 16 => '88', 17 => '92', 18 => '96', 19 => '98', 20 => '100')
				  
				  );
				  
	
	 /**
     * Class constructor. Create a new Item
     *
     * @param array none
     * @return bool
     */
				  public function __construct() {
					  
					  if(!$_SESSION['item']) {
						  exit(header('Location: /'));
					  }
					  
				  }
	
     /**
     * Item wiew list shop 
     *
     * @param string $item, $smith, $quality, $id, $name, $bonus,$rune
     * @return none
     */
	 
public function ItemList($item, $smith, $quality, $id, $name, $bonus,$rune,$smith) {
  
  echo '<li><table cellpadding="0" cellspacing="0">
  <tr>
  <td><img src="/itemImage.php?id='.$item.'&smith='.$smith.'" alt="*"/></td>
  <td valign="top" style="padding-left: 5px;"><img src="/images/icon/quality/'.$quality.'.png" alt="*"/> 
  <a href="/item/'.$id.'/">'.$name.'</a> '.($smith > 0 ? '<font color=\'#90c090\'>+'.$smith.'</font>':'').'
  <br/><small>
  <font color="'.$this->ItemArray['quality_color'][$quality].'">'.$this->ItemArray['quality'][$quality].' ['.$bonus.'/'.$this->ItemArray['bonus'][$quality].']</font></small>';
  
  if($rune > 0) {
	  
	  echo '<br /><img src="/images/icon/quality/'.$quality.'.png" alt="*"/><font color="#9c9"> +'.$this->ItemArray['rune_stats'][$rune].'</font> '.$this->ItemArray['rune_name'][$rune].'';
  }
  
  echo '</td></tr></table>';	
}
	
	
	 /**
     * Wiew id shop item
     *
     * @param string $ItemID
     * @return self::ItemArray
     */
	
public function ItemWiew($ItemID) {
	
  $inv = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$ItemID.'"'));
  $item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = "'.$inv['item'].'"'));
 
	  
	  return self::ItemList($item['id'],$inv['smith'],$item['quality'],$inv['id'],$item['name'],$inv['bonus'],$inv['rune'],$inv['smith']);

}

	 /**
     * Send rune function
     *
     * @param string $id,$user
     * @return nome
     */
	 
public function SendRune ($id,$user) {
	

	 $InventoryUser = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$_SESSION['item'].'" AND `user` = "'.$user.'"'));
	 $InvUser = mysql_fetch_array(mysql_query('SELECT * FROM `inv` WHERE `id` = "'.$id.'" AND `user` = "'.$user.'"'));
	 
	 $item = mysql_fetch_array(mysql_query('SELECT * FROM `items` WHERE `id` = "'.$InventoryUser['item'].'"'));    
	 
	 $Clone = $this->ItemArray['w'][$item['w']];
	 $CloneParam = $this->ItemParam['bonusItem'][$InventoryUser['quality']];
	 $CloneSmith = $this->ItemParam['smithItem'][$InventoryUser['smith']];
	 
	 if($InventoryUser['smith'] >= 19) {
		 $CreateSmith = '21'; 
		 }else{
			  $CreateSmith = $InvUser['smith'] + $InventoryUser['smith'];  
		 }
		 
		 
	   $_quality = array(0, 5, 10, 15, 20, 50, 65);
	   $__quality = $_quality[$InventoryUser['quality']];

	    if($InventoryUser['bonus'] >= $__quality) {
			$CreateBonus = $__quality; 
			}else{
				$CreateBonus = $InvUser['bonus'] + $InventoryUser['bonus'];  
				}
	 
	 mysql_query("UPDATE `inv` SET  `$Clone` = '".($InvUser[$Clone] + $this->ItemArray['rune_stats'][$InventoryUser['rune']])."', 
	 `rune` = '".$InventoryUser['rune']."',
	 `smith` = '".($CreateSmith)."',
	 `bonus` = '".($CreateBonus)."',
	 `_str` = '".($InventoryUser['_str'] + $CloneParam + $CloneSmith)."',
     `_vit` = '".($InventoryUser['_vit'] + $CloneParam + $CloneSmith)."',
     `_agi` = '".($InventoryUser['_agi'] + $CloneParam + $CloneSmith)."',
     `_def` = '".($InventoryUser['_def'] + $CloneParam + $CloneSmith)."' WHERE `id`='$id'");	
	 
	 mysql_query("DELETE FROM `inv` WHERE `id` = '$_SESSION[item]'");
	 
		   
		   unset($_SESSION['item']);
	 	
}

}

?>