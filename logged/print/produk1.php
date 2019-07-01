<?php require_once('../../Connections/olshop.php'); ?>
<?php 

	
	mysql_select_db($database_olshop, $olshop);	
	$query_rs_product_print = "SELECT * FROM produk WHERE id_kategori";
	$rs_product_print = mysql_query($query_rs_product_print, $olshop) or die(mysql_error());
	$row_rs_product_print = mysql_fetch_assoc($rs_product_print);
	$totalRows_rs_product_print = mysql_num_rows($rs_product_print);

mysql_select_db($database_olshop, $olshop);
$query_rs_kategori = "SELECT * FROM kategori WHERE id_kategori";
$rs_kategori = mysql_query($query_rs_kategori, $olshop) or die(mysql_error());
$row_rs_kategori = mysql_fetch_assoc($rs_kategori);
$totalRows_rs_kategori = mysql_num_rows($rs_kategori);

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
  <h3>Laporan <strong>Produk</strong></h3>
</div>
<p></p>
<h3>Daftar Laporan Produk Keseluruhan</h3>
<hr />
  <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th bgcolor="#333399"><span class="style1">NO.</span></th>
      <th height="33" bgcolor="#333399"><div align="center" class="style1">NAMA PRODUK</div></th>
      <th bgcolor="#333399"><div align="center" class="style1">HARGA</div></th>
      <th bgcolor="#333399"><div align="center" class="style1">STOK</div></th>
      <th bgcolor="#333399"><div align="center" class="style1">BERAT</div></th>
      <th bgcolor="#333399"><div align="center" class="style1">TGL. MASUK</div></th>
      <th bgcolor="#333399"><div align="center" class="style1">PRODUK</div></th>
      <th bgcolor="#333399"><div align="center" class="style1">DISC. %</div></th>
    </tr>
    </thead>
    <tbody>
    <?php $no = 1; do { ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $a = $row_rs_product_print['nama_produk']; ?></td>
        <td>Rp. <?php echo $row_rs_product_print['harga']; ?></td>
        <td><?php echo $b = $row_rs_product_print['stok']; ?></td>
        <td><?php echo $c = $row_rs_product_print['berat']; ?></td>
        <td><?php echo $d = $row_rs_product_print['tgl_masuk']; ?></td>
        <td><img src="../gambar/<?php echo $row_rs_product_print['gambar']; ?>" width="78" height="78"/></td>
        <td><?php echo $f = $row_rs_product_print['diskon']; ?></td>
      </tr>
      <?php } while ($row_rs_product_print = mysql_fetch_assoc($rs_product_print)); ?>
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
