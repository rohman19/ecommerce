<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE kustomer SET password=%s, nama_lengkap=%s, alamat=%s, email=%s, telpon=%s, id_kota=%s WHERE id_kustomer=%s",
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['telpon'], "text"),
                       GetSQLValueString($_POST['id_kota'], "int"),
                       GetSQLValueString($_POST['id_kustomer'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
}

mysql_select_db($database_olshop, $olshop);
$query_rs_kota = "SELECT * FROM kota";
$rs_kota = mysql_query($query_rs_kota, $olshop) or die(mysql_error());
$row_rs_kota = mysql_fetch_assoc($rs_kota);
$totalRows_rs_kota = mysql_num_rows($rs_kota);

$colname_rs_kustomer = "-1";
if (isset($_GET['v'])) {
  $colname_rs_kustomer = $_GET['v'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_kustomer = sprintf("SELECT * FROM kustomer WHERE id_kustomer = %s", GetSQLValueString($colname_rs_kustomer, "int"));
$rs_kustomer = mysql_query($query_rs_kustomer, $olshop) or die(mysql_error());
$row_rs_kustomer = mysql_fetch_assoc($rs_kustomer);
$totalRows_rs_kustomer = mysql_num_rows($rs_kustomer);
?>


<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="577" height="369">
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Password</div></td>
      <td><input type="password" name="password" value="<?php echo htmlentities($row_rs_kustomer['password'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Nama Lengkap </div></td>
      <td><input type="text" name="nama_lengkap" value="<?php echo htmlentities($row_rs_kustomer['nama_lengkap'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><div align="left">Alamat</div></td>
      <td><textarea name="alamat" cols="50" rows="5"  class="form-control"><?php echo htmlentities($row_rs_kustomer['alamat'], ENT_COMPAT, 'utf-8'); ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Email</div></td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_rs_kustomer['email'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">No. Rekenings</div></td>
      <td><input type="text" name="telpon" value="<?php echo htmlentities($row_rs_kustomer['telpon'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Nama Kota</div></td>
      <td><select name="id_kota"  class="form-control">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_kota['id_kota']?>" <?php if (!(strcmp($row_rs_kota['id_kota'], htmlentities($row_rs_kustomer['id_kota'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_rs_kota['nama_kota']?></option>
        <?php
} while ($row_rs_kota = mysql_fetch_assoc($rs_kota));
?>
      </select>      </td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
      <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_kustomer" value="<?php echo $row_rs_kustomer['id_kustomer']; ?>" />
</form>

