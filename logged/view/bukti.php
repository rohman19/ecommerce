<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO konfirmasi (id_kustomer, subjek, pesan, tanggal, gambar) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_kustomer'], "int"),
                       GetSQLValueString($_POST['subjek'], "text"),
                       GetSQLValueString($_POST['pesan'], "text"),
                       GetSQLValueString($_POST['tanggal'], "date"),
                      GetSQLValueString($gambar = $_FILES['gambar']['name'], "text"));
             
             if(is_uploaded_file($_FILES['gambar']['tmp_name'])){
              move_uploaded_file($_FILES['gambar']['tmp_name'],"gambar/".$gambar);
            }

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());
}

mysql_select_db($database_olshop, $olshop);
$query_rs_pesan = "SELECT * FROM konfirmasi, kustomer WHERE id_konfirmasi =konfirmasi.id_kustomer = kustomer.id_kustomer";
$rs_pesan = mysql_query($query_rs_pesan, $olshop) or die(mysql_error());
$row_rs_pesan = mysql_fetch_assoc($rs_pesan);
$totalRows_rs_pesan = mysql_num_rows($rs_pesan);

mysql_select_db($database_olshop, $olshop);
$query_rs_kustomer = "SELECT * FROM kustomer";
$rs_kustomer = mysql_query($query_rs_kustomer, $olshop) or die(mysql_error());
$row_rs_kustomer = mysql_fetch_assoc($rs_kustomer);
$totalRows_rs_kustomer = mysql_num_rows($rs_kustomer);
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<div class="list-group-item active">
    <h3>Halaman <strong>Konfirmasi</strong></h3>
</div>
<p></p>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Add Konfirmasi</a></li>
  </ul>

  <!-- Tab panes -->
    <div role="tabpanel" class="tab-pane fade" id="profile">
      <br />
            <div class="well">
             <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table width="100%" height="584">
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
                            <td align="left" valign="top" nowrap="nowrap"><div align="left">Gambar:</div></td>
                            <td><input name="gambar" type="file" size="32" /></td>
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
</div>
</div>
</div>