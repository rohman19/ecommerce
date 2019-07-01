<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE modul SET gambar=%s, static_content=%s WHERE id_modul=%s",
                       GetSQLValueString($gambar = $_FILES['gambar']['name'], "text"),
                       GetSQLValueString($_POST['static_content'], "text"),
                       GetSQLValueString($_POST['id_modul'], "int"));

	 				if (is_uploaded_file($_FILES['gambar']['tmp_name'])){
							move_uploaded_file($_FILES['gambar']['tmp_name'],"gambar/".$gambar);
						}
  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
}

$colname_rs_modul = "-1";
if (isset($_GET['v'])) {
  $colname_rs_modul = $_GET['v'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_modul = sprintf("SELECT * FROM modul WHERE id_modul = %s", GetSQLValueString($colname_rs_modul, "int"));
$rs_modul = mysql_query($query_rs_modul, $olshop) or die(mysql_error());
$row_rs_modul = mysql_fetch_assoc($rs_modul);
$totalRows_rs_modul = mysql_num_rows($rs_modul);
?>

<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="100%" height="447">
    <tr valign="baseline">
      <td align="left" valign="top" nowrap="nowrap">&nbsp;</td>
      <td><p><img src="gambar/<?php echo $row_rs_modul['gambar']; ?>" width="368" height="368" class="img-thumbnail img-responsive"/></p>
      <p>&nbsp;</p></td>
    </tr>
    <tr valign="baseline">
      <td width="11%" height="53" align="left" valign="top" nowrap="nowrap"><div align="left">Gambar</div></td>
      <td width="89%"><input name="gambar" type="file" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td height="103" align="left" valign="top" nowrap="nowrap"><div align="left">Konten Statik</div></td>
      <td><textarea name="static_content" cols="50" rows="5" class="form-control" id="mytextarea"><?php echo htmlentities($row_rs_modul['static_content'], ENT_COMPAT, 'utf-8'); ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td height="39" align="left" valign="top" nowrap="nowrap"><div align="left"></div></td>
      <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_modul" value="<?php echo $row_rs_modul['id_modul']; ?>" />
</form>
