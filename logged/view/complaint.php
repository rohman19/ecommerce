<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO hubungi (id_kustomer, subjek, pesan, tanggal) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_kustomer'], "int"),
                       GetSQLValueString($_POST['subjek'], "text"),
                       GetSQLValueString($_POST['pesan'], "text"),
                       GetSQLValueString($_POST['tanggal'], "date"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());
}
if (isset($insertSQL)) {
echo "<script>
swal('Terkirim!', 'Pesan Berhasil dikirim!', 'success');
</script>";									
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="page-header">
	<h3>Form <strong>Pesan</strong></h3>
</div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="874" height="317">
    <tr valign="baseline">
      <td width="133" height="37" align="right" valign="top" nowrap="nowrap"><div align="left">NOMOR ORDER</div></td>
      <td width="192"><input type="text" name="subjek" value="<?php echo $_GET['v']; ?>" size="32" class="form-control"/> </td>
      <td width="533" valign="top"> <div class="form-inline">
        TANGGAL PENGIRIMAN PESAN
            <input type="date" name="tanggal" value="<?php echo $tglsekarang; ?>" class="form-control" readonly/>
      </div></td>
    </tr>
    <tr valign="baseline">
      <td height="209" align="right" valign="top" nowrap="nowrap"><div align="left">ISI PESAN</div></td>
      <td colspan="2"><textarea name="pesan" cols="50" rows="5"  class="form-control" id="mytextarea"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
      <td colspan="2" valign="bottom"><input type="submit" value="Kirim Pesan" class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="id_kustomer" value="<?php echo $row_rs_login['id_kustomer']; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
