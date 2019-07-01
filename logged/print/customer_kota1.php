<?php require_once('../../Connections/olshop.php'); ?>
<?php 
	
	mysql_select_db($database_olshop, $olshop);	
	$query_rs_customer = "SELECT * FROM kustomer, kota WHERE kustomer.id_kota = kota.id_kota AND kustomer.id_kota";
	$rs_customer = mysql_query($query_rs_customer, $olshop) or die(mysql_error());
	$row_rs_customer = mysql_fetch_assoc($rs_customer);
	$totalRows_rs_kustomer = mysql_num_rows($rs_customer);
	
	mysql_select_db($database_olshop, $olshop);
$query_rs_kota = "SELECT * FROM kota WHERE id_kota";
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
    <h3>Laporan Data <strong>Customer</strong></h3>
    </div>

    <div class="well">
        Laporan berdasarkan nama kota keseluruhan.
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
                  <td valign="top"><small><?php echo $row_rs_customer['nama_lengkap']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_customer['alamat']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_customer['email']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_customer['telpon']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_customer['nama_kota']; ?></small></td>
                </tr>
                <?php } while ($row_rs_customer = mysql_fetch_assoc($rs_customer)); ?>
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