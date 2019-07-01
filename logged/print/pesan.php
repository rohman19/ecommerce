<?php require_once('../../Connections/olshop.php'); ?>
<?php 
	$ta1 = $_GET['tanggal1'];
	$ta2 = $_GET['tanggal2'];
mysql_select_db($database_olshop, $olshop);	
	$query_rs_pesan_print = "SELECT * FROM hubungi, kustomer WHERE hubungi.id_kustomer = kustomer.id_kustomer AND hubungi.tanggal BETWEEN '".$ta1."' AND '".$ta2."'";
	$rs_pesan_print = mysql_query($query_rs_pesan_print, $olshop) or die(mysql_error());
	$row_rs_pesan_print = mysql_fetch_assoc($rs_pesan_print);
	$totalRows_rs_pesan_print = mysql_num_rows($rs_pesan_print);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>
 <img src="cv gemilang.png" width="1100">
<body onload="window.print()">
<div class="container">
<div class="list-group-item active">
  <h3>Laporan <strong>Pesan Masuk</strong></h3>
</div>

<p></p>
<p>Daftar Laporan Pesan berdasarkan tanggal: <?php echo $ta1; ?> sampai dengan <?php echo $ta2; ?></p>
<hr />
<table width="100%" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th width="4%" height="41" bgcolor="#006633"><div align="center" class="style1 style1">No.</div></th>
                <th width="26%" bgcolor="#006633"><div align="center" class="style1">Nama Lengkap</div></th>
                <th width="19%" bgcolor="#006633"><div align="center" class="style1">Subjek</div></th>
                <th width="34%" bgcolor="#006633"><div align="center" class="style1">Pesan</div></th>
                <th width="11%" bgcolor="#006633"><div align="center" class="style1">Tanggal</div></th>
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
                </tr>
                <?php } while ($row_rs_pesan_print = mysql_fetch_assoc($rs_pesan_print)); ?>
              </tbody>
      </table>
      
      <div class="text-right">
        <p>Tanggal Cetak : <?php echo $tglsekarang; ?></p>
      	<p><strong>Diketahui oleh,</strong></p>
      	<br />
        <br />
        <br />
		<p><strong>Pimpinan</strong></p>
      </div>
</div>
