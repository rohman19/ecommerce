<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE kategori SET nama_kategori=%s WHERE id_kategori=%s",
                       GetSQLValueString($_POST['nama_kategori'], "text"),
                       GetSQLValueString($_POST['id_kategori'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
}

$colname_rs_kategori = "-1";
if (isset($_GET['v'])) {
  $colname_rs_kategori = $_GET['v'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_kategori = sprintf("SELECT * FROM kategori WHERE id_kategori = %s", GetSQLValueString($colname_rs_kategori, "int"));
$rs_kategori = mysql_query($query_rs_kategori, $olshop) or die(mysql_error());
$row_rs_kategori = mysql_fetch_assoc($rs_kategori);
$totalRows_rs_kategori = mysql_num_rows($rs_kategori);
?> 


<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="493" height="78">
    <tr valign="baseline">
      <td height="37" align="right" valign="top" nowrap="nowrap"><div align="left">Nama Kategori</div></td>
      <td><input type="text" name="nama_kategori" value="<?php echo htmlentities($row_rs_kategori['nama_kategori'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
      <td valign="bottom"><input type="submit" value="Ubah Kategori" class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_kategori" value="<?php echo $row_rs_kategori['id_kategori']; ?>" />
</form>


