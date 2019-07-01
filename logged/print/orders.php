<?php require_once('../../Connections/olshop.php'); ?>
<?php 
mysql_select_db($database_olshop, $olshop);	
	$ta1 = $_GET['tanggal1'];
	$ta2 = $_GET['tanggal2'];
	$status = $_GET['status'];
	$query_rs_orders_print = "SELECT * FROM orders, kustomer, kota WHERE orders.id_kustomer = kustomer.id_kustomer AND kustomer.id_kota = kota.id_kota AND tgl_order BETWEEN '".$ta1."' AND '".$ta2."' AND status_order = '".$status."'";
	$rs_orders_print = mysql_query($query_rs_orders_print, $olshop) or die(mysql_error());
	$row_rs_orders_print = mysql_fetch_assoc($rs_orders_print);
	$totalRows_rs_orders_print = mysql_num_rows($rs_orders_print);
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
  <h3>Laporan <strong>Orders</strong></h3>
</div>
<p></p>
<p>Laporan Order berdasarkan status :  <?php echo $status; ?></p>
<table width="100%" class="table table-striped table-bordered">
        <thead>
              <tr>
                   <th bgcolor="#66CCCC"><div align="center" class="style3">NO.</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">STATUS</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">TGL. ORDER</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">PUKUL</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">PEMESAN</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">EMAIL</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">NO. REKENING</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">KOTA</div></th>
          </tr>
          </thead>
              <tbody>
              <?php $no = 1; do { ?>
                    <tr class="small">
                      <td><div align="center"><?php echo $no++; ?></div></td>
                      <td><?php echo $row_rs_orders_print['status_order']; ?></td>
                      <td><?php echo $row_rs_orders_print['tgl_order']; ?></td>
                      <td><?php echo $row_rs_orders_print['jam_order']; ?></td>
                      <td><?php echo $row_rs_orders_print['nama_lengkap']; ?></td>
                      <td><?php echo $row_rs_orders_print['email']; ?></td>
                      <td><?php echo $row_rs_orders_print['telpon']; ?></td>
                      <td><?php echo $row_rs_orders_print['nama_kota']; ?></td>
                    </tr>
                    <?php } while ($row_rs_orders_print = mysql_fetch_assoc($rs_orders_print)); ?>
              </tbody>
      </table>
      
      <div class="text-right">
        <p>Tanggal Cetak : <?php echo $tglsekarang; ?> </p>
      	<p><strong>Diketahui oleh,</strong></p>
      	<br />
        <br />
        <br />
		<p><strong>Pimpinan</strong></p>
      </div>
 </div>