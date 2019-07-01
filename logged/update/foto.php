<?php  
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE admins SET foto=%s WHERE nama_lengkap=%s",
                       GetSQLValueString($gambar = $_FILES['gambar']['name'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "int"));
             
              if(is_uploaded_file($_FILES['gambar']['tmp_name'])){
              move_uploaded_file($_FILES['gambar']['tmp_name'],"gambar/".$gambar);
            }

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
}

$colname_rs_gambar = "-1";
if (isset($_GET['v'])) {
  $colname_rs_gambar = $_GET['v'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_gambar = sprintf("SELECT * FROM admins WHERE nama_lengkap = %s", GetSQLValueString($colname_rs_gambar, "int"));
$rs_gambar = mysql_query($query_rs_gambar, $olshop) or die(mysql_error());
$row_rs_gambar = mysql_fetch_assoc($rs_gambar);
$totalRows_rs_gambar = mysql_num_rows($rs_gambar);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="page-header">
  <h3>Update <strong>Gambar</strong></h3>
</div>
<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="100%" height="204">
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Pilih Gambar</div></td>
      <td><p>
        <input type="file" name="gambar" id="gambar" />
        </p>
        <p>
          <input type="submit" value="Ubah Gambar" class="btn btn-primary"/>
        </p></td>
    </tr>
    <tr valign="baseline">
      <td width="149" align="right" valign="top" nowrap="nowrap"><div align="left">Gambar Sebelumnya </div></td>
      <td width="860"><img src="gambar/<?php echo $row_rs_gambar['foto']; ?>" class="img-rounded img-thumbnail" alt="image" width="41%" height="234" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="nama_lengkap" value="<?php echo $row_rs_gambar['nama_lengkap']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rs_gambar);
?>
