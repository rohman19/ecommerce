<?php require_once('../../Connections/olshop.php'); ?>
<?php 
	$ta1 = $_GET['kota'];
	mysql_select_db($database_olshop, $olshop);	
	$query_rs_kustomer = "SELECT * FROM kustomer, kota WHERE kustomer.id_kota = kota.id_kota AND kustomer.id_kota = $ta1";
	$rs_kustomer = mysql_query($query_rs_kustomer, $olshop) or die(mysql_error());
	$row_rs_kustomer = mysql_fetch_assoc($rs_kustomer);
	$totalRows_rs_kustomer = mysql_num_rows($rs_kustomer);
	
	mysql_select_db($database_olshop, $olshop);
$query_rs_kota = "SELECT * FROM kota WHERE id_kota = $ta1";
$rs_kota = mysql_query($query_rs_kota, $olshop) or die(mysql_error());
$row_rs_kota = mysql_fetch_assoc($rs_kota);
$totalRows_rs_kota = mysql_num_rows($rs_kota);
?>
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>
 <img src="cv gemilang.png" width="1100">
<body onLoad="window.print()">
<div class="container">
  <div class="list-group-item active">
    <h3>Laporan Data <strong>Kustomer</strong></h3>
    </div>

    <div class="well">
        Laporan berdasarkan nama kota: <?php echo $row_rs_kota['nama_kota']; ?> 
  </div>
<p>&nbsp;</p>
		<table width="100%" class="table table-striped table-bordered"  id="data">
            <thead>
              <tr>
               <th width="4%" bgcolor="#6699FF"><div align="center" class="style1">NO.</div></th>
                <th width="18%" bgcolor="#6699FF"><div align="center" class="style1">NAMA</div></th>
                <th width="20%" bgcolor="#6699FF"><div align="center" class="style1">ALAMAT</div></th>
                <th width="17%" bgcolor="#6699FF"><div align="center" class="style1">EMAIL</div></th>
                <th width="15%" bgcolor="#6699FF"><div align="center" class="style1">NO. REKENING</div></th>
                <th width="16%" bgcolor="#6699FF"><div align="center" class="style1">KOTA</div></th>
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
                </tr>
                <?php } while ($row_rs_kustomer = mysql_fetch_assoc($rs_kustomer)); ?>
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