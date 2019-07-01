<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE slider SET slider_link_image=%s, slider_caption=%s, slider_desc=%s WHERE slider_id=%s",
                       GetSQLValueString($_POST['slider_link_image'], "text"),
                       GetSQLValueString($_POST['slider_caption'], "text"),
                       GetSQLValueString($_POST['slider_desc'], "text"),
                       GetSQLValueString($_POST['slider_id'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
}

$colname_rs_slider = "-1";
if (isset($_GET['v'])) {
  $colname_rs_slider = $_GET['v'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_slider = sprintf("SELECT * FROM slider WHERE slider_id = %s", GetSQLValueString($colname_rs_slider, "int"));
$rs_slider = mysql_query($query_rs_slider, $olshop) or die(mysql_error());
$row_rs_slider = mysql_fetch_assoc($rs_slider);
$totalRows_rs_slider = mysql_num_rows($rs_slider);
?>


<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="595" height="276">
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Link of Image</div></td>
      <td><input type="text" name="slider_link_image" value="<?php echo htmlentities($row_rs_slider['slider_link_image'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Caption</div></td>
      <td><input type="text" name="slider_caption" value="<?php echo htmlentities($row_rs_slider['slider_caption'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><div align="left">Deskripsi</div></td>
      <td><textarea name="slider_desc" cols="50" rows="5" class="form-control"><?php echo htmlentities($row_rs_slider['slider_desc'], ENT_COMPAT, 'utf-8'); ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
      <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="slider_id" value="<?php echo $row_rs_slider['slider_id']; ?>" />
</form>
