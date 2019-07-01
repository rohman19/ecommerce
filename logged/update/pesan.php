<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE hubungi SET id_kustomer=%s, subjek=%s, pesan=%s, tanggal=%s WHERE id_hubungi=%s",
                       GetSQLValueString($_POST['id_kustomer'], "int"),
                       GetSQLValueString($_POST['subjek'], "text"),
                       GetSQLValueString($_POST['pesan'], "text"),
                       GetSQLValueString($_POST['tanggal'], "date"),
                       GetSQLValueString($_POST['id_hubungi'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
}

$colname_rs_pesan = "-1";
if (isset($_GET['v'])) {
  $colname_rs_pesan = $_GET['v'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_pesan = sprintf("SELECT * FROM hubungi, kustomer WHERE id_hubungi = %s AND hubungi.id_kustomer = kustomer.id_kustomer", GetSQLValueString($colname_rs_pesan, "int"));
$rs_pesan = mysql_query($query_rs_pesan, $olshop) or die(mysql_error());
$row_rs_pesan = mysql_fetch_assoc($rs_pesan);
$totalRows_rs_pesan = mysql_num_rows($rs_pesan);

mysql_select_db($database_olshop, $olshop);
$query_rs_kustomer = "SELECT * FROM kustomer";
$rs_kustomer = mysql_query($query_rs_kustomer, $olshop) or die(mysql_error());
$row_rs_kustomer = mysql_fetch_assoc($rs_kustomer);
$totalRows_rs_kustomer = mysql_num_rows($rs_kustomer);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="page-header">
	<h3>Form <strong>Halaman Pesan</strong></h3>
</div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" height="295">
    <tr valign="baseline">
      <td width="13%" height="41" align="right" valign="top" nowrap="nowrap"><div align="left">Nama Customer</div></td>
      <td width="87%"><input type="hidden" name="id_kustomer" id="id_kustomer" value="<?php echo htmlentities($row_rs_pesan['id_kustomer'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" readonly="readonly"/><div class="form-control"><?php echo htmlentities($row_rs_pesan['nama_lengkap'], ENT_COMPAT, 'utf-8'); ?></div></td>
    </tr>
    <tr valign="baseline">
      <td height="41" align="right" valign="top" nowrap="nowrap"><div align="left">Subjek</div></td>
      <td><input type="text" name="subjek" value="<?php echo htmlentities($row_rs_pesan['subjek'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td height="124" align="right" valign="top" nowrap="nowrap"><div align="left">Pesan</div></td>
      <td><textarea name="pesan" cols="50" rows="5"  class="form-control" id="mytextarea"><?php echo htmlentities($row_rs_pesan['pesan'], ENT_COMPAT, 'utf-8'); ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td height="40" align="right" valign="top" nowrap="nowrap"><div align="left">Tanggal</div></td>
      <td><input type="date" name="tanggal" value="<?php echo htmlentities($row_rs_pesan['tanggal'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
      <td valign="bottom"><input type="submit" value="Simpan"  class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_hubungi" value="<?php echo $row_rs_pesan['id_hubungi']; ?>" />
</form>
