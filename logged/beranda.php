<?php 
$maxRows_rs_all_produk = 6;
$pageNum_rs_all_produk = 0;
if (isset($_GET['pageNum_rs_all_produk'])) {
  $pageNum_rs_all_produk = $_GET['pageNum_rs_all_produk'];
}
$startRow_rs_all_produk = $pageNum_rs_all_produk * $maxRows_rs_all_produk;

mysql_select_db($database_olshop, $olshop);
if (isset($_POST['button'])) {
$cari = $_POST['nama_produk'];
$query_rs_all_produk = "SELECT *, LEFT(deskripsi, 70) as desk, LEFT(nama_produk, 20) as nama FROM produk WHERE produk.nama_produk LIKE '%".$cari."%'";
$query_limit_rs_all_produk = sprintf("%s LIMIT %d, %d", $query_rs_all_produk, $startRow_rs_all_produk, $maxRows_rs_all_produk);
$rs_all_produk = mysql_query($query_limit_rs_all_produk, $olshop) or die(mysql_error());
$row_rs_all_produk = mysql_fetch_assoc($rs_all_produk);
}else{
$query_rs_all_produk = "SELECT *, LEFT(deskripsi, 70) as desk, LEFT(nama_produk, 20) as nama FROM produk";
$query_limit_rs_all_produk = sprintf("%s LIMIT %d, %d", $query_rs_all_produk, $startRow_rs_all_produk, $maxRows_rs_all_produk);
$rs_all_produk = mysql_query($query_limit_rs_all_produk, $olshop) or die(mysql_error());
$row_rs_all_produk = mysql_fetch_assoc($rs_all_produk);
}
if (isset($_GET['totalRows_rs_all_produk'])) {
  $totalRows_rs_all_produk = $_GET['totalRows_rs_all_produk'];
} else {
  $all_rs_all_produk = mysql_query($query_rs_all_produk);
  $totalRows_rs_all_produk = mysql_num_rows($all_rs_all_produk);
}
$totalPages_rs_all_produk = ceil($totalRows_rs_all_produk/$maxRows_rs_all_produk)-1;

//input ke keranjang
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
	//cek nama produk yang sama, jika ada maka ditambahkan 1
	$cek = mysql_num_rows(mysql_query("SELECT * FROM orders_temp, produk WHERE orders_temp.id_produk = produk.produk_id  AND orders_temp.id_produk ='$_POST[id_produk]' AND orders_temp.id_session ='$_POST[id_session]'"));
  if ($cek > 0){
  		  
		  //eksekusi update jumlah	
	 	  $updateSQL = "UPDATE orders_temp SET jumlah = jumlah + $_POST[jumlah] WHERE id_produk='$_POST[id_produk]'";
		  mysql_select_db($database_olshop, $olshop);
		  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
		  if($updateSQL)  {
			echo "<script type='text/javascript'>
			document.location= '?page=keranjang';
			</script>";  
			}
  }else{
  $insertSQL = sprintf("INSERT INTO orders_temp (id_produk, id_session, jumlah, tgl_order_temp, jam_order_temp, stok_temp) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_produk'], "int"),
                       GetSQLValueString($_POST['id_session'], "text"),
                       GetSQLValueString($_POST['jumlah'], "int"),
                       GetSQLValueString($_POST['tgl_order_temp'], "date"),
                       GetSQLValueString($_POST['jam_order_temp'], "date"),
                       GetSQLValueString($_POST['stok_temp'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());

  	  
  if($insertSQL)  {
	echo "<script type='text/javascript'>
	document.location= '?page=keranjang';
	</script>";  
	}
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<p><div class="alert alert-info">Selamat Datang, <strong><?php echo $row_rs_login['nama_lengkap'];?></strong></div>
<div class="list-group"></p>
      <a href="#" class="list-group-item active">
        <h3> Recent <strong>Product  </strong></h3>
      </a>
</div>
<form action="" method="post" >
	<div class="input-group">
      <input type="text" class="form-control" name="nama_produk" placeholder="Cari Produk yang Anda butuhkan ...">
      <span class="input-group-btn">
        <button class="btn btn-default" name="button" type="submit">Go!</button>
      </span>
    </div><!-- /input-group -->
</form>
<hr />
<?php if ($totalRows_rs_all_produk > 0) {?>
<?php do { ?>
    <div class="col-md-4">
      <div class="thumbnail well">
        <img src="gambar/<?php echo $row_rs_all_produk['gambar']; ?>" alt="Image" class="img-thumbnails">
        <div class="caption">
          <h5 class="text-uppercase"><strong><?php echo $row_rs_all_produk['nama']; ?></strong></h5>
			<small><?php echo $row_rs_all_produk['desk']; ?></small><br />
		<small>
        <table width="208" height="60" cellpadding="2" cellspacing="2">
          <tr>
            <td>Harga <span class="btn btn-xs btn-danger">Rp.
                <?php 
							  $dis = ($row_rs_all_produk['diskon'] / 100) *  $row_rs_all_produk['harga'];
							  $hasil =  $row_rs_all_produk['harga'] - $dis; 
							  echo $hasil; ?>
            </span></td>
            <td>&nbsp;</td>
            <td><span class="btn btn-xs btn-info">Disc. <?php echo $row_rs_all_produk['diskon']; ?> %</span></td>
          </tr>
        </table>
		</small>
        <p></p>
        <p></p>          
        </div>
        <hr />
        <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
            <input type="hidden" name="id_produk" value="<?php echo $row_rs_all_produk['produk_id']; ?>" size="32" />
            <input type="hidden" name="id_session" value="<?php echo $row_rs_login['id_kustomer'] ?>" size="32" />
            <input type="hidden" name="jumlah" value="1" size="32" />
            <input type="hidden" name="tgl_order_temp" value="2018-12-25" size="32" />
            <input type="hidden" name="jam_order_temp" value="08:00:00" size="32" />
            <input type="hidden" name="stok_temp" value="<?php echo $row_rs_all_produk['stok']; ?>" size="32" />
          <p align="center"><span class="text-center">
           <?php if ($row_rs_all_produk['stok'] > 0) { ?>
          <a href="#" class="btn btn-success">Tersedia <?php echo $row_rs_all_produk['stok']; ?></a>
          <input type="submit" class="btn btn-primary" value="Beli" />
          <?php }	?>
          <?php if ($row_rs_all_produk['stok'] == 0) { ?>
          <a href="#" class="btn btn-danger"><strong>Habis</strong> terjual!</a>
		  <?php } ?>
			<a href="?page=details&produk_id=<?php echo $row_rs_all_produk['produk_id']; ?>" class="btn btn-default" role="button">Details</a><input type="hidden" name="MM_insert" value="form2" />
        </p>
          </form>
        </div>
    </div>
    <?php } while ($row_rs_all_produk = mysql_fetch_assoc($rs_all_produk)); ?>
    
    <?php } ?>
    <?php if ($totalRows_rs_all_produk == 0) {?>
         <div class="alert alert-danger"><strong>Oops!! </strong>Barang yang Anda cari tidak ditemukan</div>
     <?php } ?>
</body>
</html>
