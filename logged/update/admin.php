<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE admins SET username=%s,  nama_lengkap=%s, no_telp=%s, `level`=%s, blokir=%s, foto =%s WHERE email=%s",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "text"),
                       GetSQLValueString($_POST['no_telp'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['blokir'], "text"),
                       GetSQLValueString($gambar = $_FILES['gambar']['name'], "text"),
                       GetSQLValueString($_POST['email'], "text"));

 if(is_uploaded_file($_FILES['gambar']['tmp_name'])){
              move_uploaded_file($_FILES['gambar']['tmp_name'],"gambar/".$gambar);
            }
  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
}

$colname_rs_admin_update = "-1";
if (isset($_GET['email'])) {
  $colname_rs_admin_update = $_GET['email'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_admin_update = sprintf("SELECT * FROM admins WHERE email = %s", GetSQLValueString($colname_rs_admin_update, "text"));
$rs_admin_update = mysql_query($query_rs_admin_update, $olshop) or die(mysql_error());
$row_rs_admin_update = mysql_fetch_assoc($rs_admin_update);
$totalRows_rs_admin_update = mysql_num_rows($rs_admin_update);
?>

<div class="page-header">
		<h3>Halaman <strong>Update Administrator</strong></h3>
</div>
<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="100%" height="306">
    <tr valign="baseline">
      <td width="15%" align="right" valign="top" nowrap="nowrap"><div align="left">Username</div></td>
      <td width="85%"><input type="text" name="username" value="<?php echo htmlentities($row_rs_admin_update['username'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Nama Lengkap</div></td>
      <td><input type="text" name="nama_lengkap" value="<?php echo htmlentities($row_rs_admin_update['nama_lengkap'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Email</div></td>
      <td><div class="form-control"><?php echo $row_rs_admin_update['email']; ?></div></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">No. Telp</div></td>
      <td><input type="text" name="no_telp" value="<?php echo htmlentities($row_rs_admin_update['no_telp'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Level</div></td>
      <td><select name="level"  class="form-control">
        <option value="admin" <?php if (!(strcmp("admin", htmlentities($row_rs_admin_update['level'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Administrator</option>
        <option value="user" <?php if (!(strcmp("user", htmlentities($row_rs_admin_update['level'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>User</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Blokir</div></td>
      <td valign="baseline"><table width="197" height="34">
        <tr>
          <td><input type="radio" name="blokir" value="Y" <?php if (!(strcmp(htmlentities($row_rs_admin_update['blokir'], ENT_COMPAT, 'utf-8'),"Y"))) {echo "CHECKED";} ?> />
            Yes</td>
          <td><input type="radio" name="blokir" value="N" <?php if (!(strcmp(htmlentities($row_rs_admin_update['blokir'], ENT_COMPAT, 'utf-8'),"N"))) {echo "CHECKED";} ?> />
No</td>
        </table></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Gambar</div></td>
      <td><p>
        <input type="file" name="gambar" id="gambar" />
        </p>
        <p>
          <input type="submit" value="Ubah Gambar" class="btn btn-primary"/>
        </p></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
      <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="email" value="<?php echo $row_rs_admin_update['email']; ?>" />
</form>
<p>&nbsp;</p>
