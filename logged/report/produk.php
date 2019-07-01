<?php 
mysql_select_db($database_olshop, $olshop);
$query_rs_kategori = "SELECT * FROM kategori";
$rs_kategori = mysql_query($query_rs_kategori, $olshop) or die(mysql_error());
$row_rs_kategori = mysql_fetch_assoc($rs_kategori);
$totalRows_rs_kategori = mysql_num_rows($rs_kategori);


mysql_select_db($database_olshop, $olshop);	
if (isset($_POST['button'])) {
	$ta1 = $_POST['kategori'];
	$query_rs_product_print = "SELECT * FROM produk WHERE id_kategori = $ta1";
	$rs_product_print = mysql_query($query_rs_product_print, $olshop) or die(mysql_error());
	$row_rs_product_print = mysql_fetch_assoc($rs_product_print);
	$totalRows_rs_product_print = mysql_num_rows($rs_product_print);
}else{
	$query_rs_product_print = "SELECT * FROM produk LIMIT 10";
	$rs_product_print = mysql_query($query_rs_product_print, $olshop) or die(mysql_error());
	$row_rs_product_print = mysql_fetch_assoc($rs_product_print);
	$totalRows_rs_product_print = mysql_num_rows($rs_product_print);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
  <h3>Print Laporan Produk<strong></strong></h3>
</div>
<div class="well">
<form id="form1" name="form1" method="post" action="" class="form-inline">
  <a href="print/produk1.php" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-print"></span> Cetak Keseluruhan</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cetak Berdasarkan Kategori Produk : 
  <select name="kategori" id="kategori" class="form-control">
    <?php
do {  
?>
    <option value="<?php echo $row_rs_kategori['id_kategori']?>"><?php echo $row_rs_kategori['nama_kategori']?></option>
    <?php
} while ($row_rs_kategori = mysql_fetch_assoc($rs_kategori));
  $rows = mysql_num_rows($rs_kategori);
  if($rows > 0) {
      mysql_data_seek($rs_kategori, 0);
	  $row_rs_kategori = mysql_fetch_assoc($rs_kategori);
  }
?>
  </select>
  <input type="submit" name="button" id="button" value="Search" class="btn btn-primary" />
  
</form>
</div>
<?php if ($totalRows_rs_product_print > 0) { // Show if recordset not empty ?>
<p><a href="print/produk.php?kategori=<?php echo $ta1; ?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-print"></span> Print</a> <small>Lakukan Pencarian Sebelum melakukan Print</small></p>
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
        <td><img src="gambar/<?php echo $row_rs_product_print['gambar']; ?>" width="78" height="78"/></td>
        <td><?php echo $f = $row_rs_product_print['diskon']; ?></td>
      </tr>
      <?php } while ($row_rs_product_print = mysql_fetch_assoc($rs_product_print)); ?>
    </tbody>
  </table>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rs_product_print == 0) { // Show if recordset empty ?>
  <p class="alert alert-danger">Data produk tidak ditemukan!!</p>
  <?php } // Show if recordset empty ?>
