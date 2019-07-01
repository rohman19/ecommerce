<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE orders SET status_order=%s WHERE id_orders=%s",
                       GetSQLValueString($_POST['status_order'], "text"),
                       GetSQLValueString($_POST['id_orders'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
}

$colname_rs_status = "-1";
if (isset($_GET['id_orders'])) {
  $colname_rs_status = $_GET['id_orders'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_status = sprintf("SELECT * FROM orders, kustomer WHERE id_orders = %s AND orders.id_kustomer = kustomer.id_kustomer", GetSQLValueString($colname_rs_status, "int"));
$rs_status = mysql_query($query_rs_status, $olshop) or die(mysql_error());
$row_rs_status = mysql_fetch_assoc($rs_status);
$totalRows_rs_status = mysql_num_rows($rs_status);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="page-header">
	<h4>Ubah<strong> Status</strong></h4>
</div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="473" height="158">
    <tr valign="baseline">
      <td height="70" colspan="2" align="right" valign="top" nowrap="nowrap"><div align="left">Transaksi pada tanggal : <?php echo $row_rs_status['tgl_order']; ?>, oleh <?php echo $row_rs_status['nama_lengkap']; ?><br />
      dengan Nomor Order <?php echo $row_rs_status['id_orders']; ?></div></td>
    </tr>
    <tr valign="baseline">
      <td width="149" align="right" valign="top" nowrap="nowrap"><div align="left">Status Pembayaran</div></td>
      <td width="319"><select name="status_order" class="form-control">
        <option value="Lunas" <?php if (!(strcmp("Lunas", htmlentities($row_rs_status['status_order'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Lunas</option>
        <option value="Belum Lunas" <?php if (!(strcmp("Belum Lunas", htmlentities($row_rs_status['status_order'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Belum Lunas</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td valign="bottom"><input type="submit" value="Ubah Status" class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_orders" value="<?php echo $row_rs_status['id_orders']; ?>" />
</form>
