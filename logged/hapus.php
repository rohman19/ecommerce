<?php require_once('../Connections/olshop.php'); ?>
<?php

if ((isset($_GET['id_orders_temp'])) && ($_GET['id_orders_temp'] != "")) {
  $deleteSQL = sprintf("DELETE FROM orders_temp WHERE id_produk=%s",
                       GetSQLValueString($_GET['id_orders_temp'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());

    if($deleteSQL)  {
	echo "<script type='text/javascript'>
	document.location= '?page=keranjang';
	</script>";  
	}
}
?>
