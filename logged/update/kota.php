<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE kota SET nama_kota=%s, ongkos_kirim=%s WHERE id_kota=%s",
                       GetSQLValueString($_POST['nama_kota'], "text"),
                       GetSQLValueString($_POST['ongkos_kirim'], "int"),
                       GetSQLValueString($_POST['id_kota'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
}

$colname_rs_kota = "-1";
if (isset($_GET['v'])) {
  $colname_rs_kota = $_GET['v'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_kota = sprintf("SELECT * FROM kota WHERE id_kota = %s", GetSQLValueString($colname_rs_kota, "int"));
$rs_kota = mysql_query($query_rs_kota, $olshop) or die(mysql_error());
$row_rs_kota = mysql_fetch_assoc($rs_kota);
$totalRows_rs_kota = mysql_num_rows($rs_kota);
?>


<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="443" height="118">
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Nama Kota</div></td>
      <td><input type="text" name="nama_kota" value="<?php echo htmlentities($row_rs_kota['nama_kota'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Ongkos Kirim</div></td>
      <td><input type="text" name="ongkos_kirim" value="<?php echo htmlentities($row_rs_kota['ongkos_kirim'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
      <td valign="bottom"><input type="submit" value="Ubah Record" class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_kota" value="<?php echo $row_rs_kota['id_kota']; ?>" />
</form>
