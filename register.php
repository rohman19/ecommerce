<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $cek = mysql_num_rows(mysql_query("SELECT * FROM kustomer WHERE email ='$_POST[email]'"));
  if ($cek > 0){
	 		echo "<script>
			alert('email telah dipakai!');
			</script>";  
  }else{
  $insertSQL = sprintf("INSERT INTO kustomer (password, nama_lengkap, alamat, email, telpon, id_kota, tanggal) VALUES (md5(%s), %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['telpon'], "text"),
                       GetSQLValueString($_POST['id_kota'], "int"),
                       GetSQLValueString($_POST['tanggal'], "date"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());
  }
}

mysql_select_db($database_olshop, $olshop);
$query_rs_kota = "SELECT * FROM kota";
$rs_kota = mysql_query($query_rs_kota, $olshop) or die(mysql_error());
$row_rs_kota = mysql_fetch_assoc($rs_kota);
$totalRows_rs_kota = mysql_num_rows($rs_kota);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

	<h3>Form <strong>Register</strong></h3>
	<small>Harap diisi dengan data Anda yang sebenarnya ..</small>
<hr />
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" height="393">
    <tr valign="baseline">
      <td width="20%" align="right" valign="top" nowrap="nowrap"><div align="left">Password</div></td>
      <td width="80%"><input type="password" name="password" value="" size="32" class="form-control" required/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Nama Lengkap</div></td>
      <td><input type="text" name="nama_lengkap" value="" size="32"  class="form-control"  required/></td>
    </tr>
    <tr valign="baseline">
      <td height="119" align="right" valign="top" nowrap="nowrap"><div align="left">Alamat:</div></td>
      <td><textarea name="alamat" cols="50" rows="5"  class="form-control"  required></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Email</div></td>
      <td><input type="email" name="email" value="" size="32"  class="form-contr\ol" id="email"  required/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">No. Rek</div></td>
      <td><input type="text" name="telpon" value="" size="32"  class="form-control"  required/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Kota</div></td>
      <td><select name="id_kota"  class="form-control"  required>
        <?php 
                    do {  
                    ?>
        <option value="<?php echo $row_rs_kota['id_kota']?>" ><?php echo $row_rs_kota['nama_kota']?></option>
        <?php
                    } while ($row_rs_kota = mysql_fetch_assoc($rs_kota));
                    ?>
      </select>
      </td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
      <td valign="bottom"><input type="submit" value=" Register"  class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="tanggal" value="<?php echo $tglsekarang; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
