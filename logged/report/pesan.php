<?php 
mysql_select_db($database_olshop, $olshop);	
if (isset($_POST['button'])) {
	$ta1 = $_POST['tanggal1'];
	$ta2 = $_POST['tanggal2'];
	$query_rs_pesan_print = "SELECT * FROM hubungi, kustomer WHERE hubungi.id_kustomer = kustomer.id_kustomer AND hubungi.tanggal BETWEEN '".$ta1."' AND '".$ta2."'";
	$rs_pesan_print = mysql_query($query_rs_pesan_print, $olshop) or die(mysql_error());
	$row_rs_pesan_print = mysql_fetch_assoc($rs_pesan_print);
	$totalRows_rs_pesan_print = mysql_num_rows($rs_pesan_print);
}else{
	$query_rs_pesan_print = "SELECT * FROM hubungi, kustomer WHERE hubungi.id_kustomer = kustomer.id_kustomer LIMIT 10";
	$rs_pesan_print = mysql_query($query_rs_pesan_print, $olshop) or die(mysql_error());
	$row_rs_pesan_print = mysql_fetch_assoc($rs_pesan_print);
	$totalRows_rs_pesan_print = mysql_num_rows($rs_pesan_print);
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
  <h3>Print Laporan Pesan Masuk<strong></strong></h3>
</div>
<div class="well">
<form id="form1" name="form1" method="post" action="" class="form-inline">
  Laporan Pesan dari Tanggal 
  <input type="date" name="tanggal1" id="textfield1" class="form-control"/> 
  s/d 
  <input type="date" name="tanggal2" id="textfield2" class="form-control"/>
  <input type="submit" name="button" id="button" value="Submit" class="btn btn-warning"/>
</form>
</div>



<?php if ($totalRows_rs_pesan_print > 0) { // Show if recordset not empty ?>
<p><a href="print/pesan.php?tanggal1=<?php echo $ta1; ?>&tanggal2=<?php echo $ta2; ?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-print"></span> Print</a> <small>Lakukan Pencarian Sebelum melakukan Print</small></p>
<table width="100%" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th width="4%" height="41" bgcolor="#006633"><div align="center" class="style1 style1">No.</div></th>
                <th width="26%" bgcolor="#006633"><div align="center" class="style1">Nama Lengkap</div></th>
                <th width="19%" bgcolor="#006633"><div align="center" class="style1">Subjek</div></th>
                <th width="34%" bgcolor="#006633"><div align="center" class="style1">Pesan</div></th>
                <th width="11%" bgcolor="#006633"><div align="center" class="style1">Tanggal</div></th>
                <th width="6%" bgcolor="#006633"><span class="style1">Action</span></th>
              </tr>
          </thead>
              <tbody>
              <?php $no = 1; do { ?>
                <tr>
                  <td><div align="center"><?php echo $no++; ?></div></td>
                  <td><?php echo $row_rs_pesan_print['nama_lengkap']; ?></td>
                  <td><?php echo $row_rs_pesan_print['subjek']; ?></td>
                  <td><?php echo $row_rs_pesan_print['pesan']; ?></td>
                  <td><?php echo $row_rs_pesan_print['tanggal']; ?></td>
                  <td><div align="center">
                    <div align="center">
                      <div align="center"><a href="?page=delete&id_hubungi=<?php echo $row_rs_pesan_print['id_hubungi']; ?>"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;<a href="?page=update/pesan&v=<?php echo $row_rs_pesan_print['id_hubungi']; ?>"><span class="glyphicon glyphicon-edit"></span></a></div>
                    </div>
                  </div></td>
                </tr>
                <?php } while ($row_rs_pesan_print = mysql_fetch_assoc($rs_pesan_print)); ?>
              </tbody>
      </table>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rs_pesan_print == 0) { // Show if recordset empty ?>
  <p class="alert alert-danger">Data pesan tidak ditemukan!!</p>
  <?php } // Show if recordset empty ?>
