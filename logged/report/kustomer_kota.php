<?php 
mysql_select_db($database_olshop, $olshop);
$query_rs_kota = "SELECT * FROM kota";
$rs_kota = mysql_query($query_rs_kota, $olshop) or die(mysql_error());
$row_rs_kota = mysql_fetch_assoc($rs_kota);
$totalRows_rs_kota = mysql_num_rows($rs_kota);

mysql_select_db($database_olshop, $olshop);	
if (isset($_POST['button'])) {
	$ta1 = $_POST['kota'];
	$query_rs_kustomer = "SELECT * FROM kustomer, kota WHERE kustomer.id_kota = kota.id_kota AND kustomer.id_kota = '".$ta1."'";
	$rs_kustomer = mysql_query($query_rs_kustomer, $olshop) or die(mysql_error());
	$row_rs_kustomer = mysql_fetch_assoc($rs_kustomer);
	$totalRows_rs_kustomer = mysql_num_rows($rs_kustomer);
}else{
	$query_rs_kustomer = "SELECT * FROM kustomer, kota WHERE kustomer.id_kota = kota.id_kota LIMIT 10";
	$rs_kustomer = mysql_query($query_rs_kustomer, $olshop) or die(mysql_error());
	$row_rs_kustomer = mysql_fetch_assoc($rs_kustomer);
	$totalRows_rs_kustomer = mysql_num_rows($rs_kustomer);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body>
<div class="list-group-item active">
  <h3>Print Laporan Data <strong>Customer</strong></h3>
</div>
<div class="well">
<a href="print/customer_kota1.php" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-print"></span> Cetak Keseluruhan</a><form id="form1" name="form1" method="post" action="" class="form-inline">
  Berdasarkan Nama Kota
    <select name="kota" id="kota" class="form-control">
      <?php
do {  
?>
      <option value="<?php echo $row_rs_kota['id_kota']?>"><?php echo $row_rs_kota['nama_kota']?></option>
      <?php
} while ($row_rs_kota = mysql_fetch_assoc($rs_kota));
  $rows = mysql_num_rows($rs_kota);
  if($rows > 0) {
      mysql_data_seek($rs_kota, 0);
	  $row_rs_kota = mysql_fetch_assoc($rs_kota);
  }
?>
    </select>
  <input type="submit" name="button" id="button" value="Search" class="btn btn-warning"/> 
</form>
</div>



<?php if ($totalRows_rs_kustomer > 0) { // Show if recordset not empty ?>
<p><a href="print/kustomer_kota.php?kota=<?php echo $ta1;?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-print"></span> Print</a> <small>Lakukan Pencarian Sebelum melakukan Print</small></p>
		<table width="100%" class="table table-striped" >
            <thead>
              <tr>
               <th width="4%" bgcolor="#6699FF"><div align="center" class="style1">NO.</div></th>
                <th width="18%" bgcolor="#6699FF"><div align="center" class="style1">NAMA</div></th>
                <th width="20%" bgcolor="#6699FF"><div align="center" class="style1">ALAMAT</div></th>
                <th width="17%" bgcolor="#6699FF"><div align="center" class="style1">EMAIL</div></th>
                <th width="15%" bgcolor="#6699FF"><div align="center" class="style1">NO. REKENING</div></th>
                <th width="16%" bgcolor="#6699FF"><div align="center" class="style1">KOTA</div></th>
                <th width="10%" bgcolor="#6699FF"><span class="style1">ACTION</span></th>
              </tr>
          </thead>
              <tbody>
              <?php $no = 1; do { ?>
                <tr>
                 <td valign="top"><small><div align="center"><?php echo $no++; ?></div></small></td>
                  <td valign="top"><small><?php echo $row_rs_kustomer['nama_lengkap']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_kustomer['alamat']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_kustomer['email']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_kustomer['telpon']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_kustomer['nama_kota']; ?></small></td>
                  <td valign="top"><small><div align="center">
                    <div align="center">
                      <div align="center"><a href="?page=delete&id_kustomer=<?php echo $row_rs_kustomer['id_kustomer']; ?>"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;<a href="?page=update/kustomer&v=<?php echo $row_rs_kustomer['id_kustomer']; ?>"><span class="glyphicon glyphicon-edit"></span></a></div>
                    </div>
                  </div>
                  </small></td>
                </tr>
                <?php } while ($row_rs_kustomer = mysql_fetch_assoc($rs_kustomer)); ?>
              </tbody>
      </table>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rs_kustomer == 0) { // Show if recordset empty ?>
  <p class="alert alert-danger">Data pesan tidak ditemukan!!</p>
  <?php } // Show if recordset empty ?>
