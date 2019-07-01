<?php 
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
 
 
$id = $_GET['id'];
mysql_select_db($database_olshop, $olshop);
if (isset($_POST['button'])) {
		$cari = $_POST['nama_produk'];
		$query_rs_detail_kategori = "SELECT *, LEFT(deskripsi, 70) as desk, LEFT(nama_produk, 20) as nama FROM produk WHERE id_kategori = $id AND produk.nama_produk LIKE '%".$cari."%'";
		$rs_detail_kategori = mysql_query($query_rs_detail_kategori, $olshop) or die(mysql_error());
		$row_rs_detail_kategori = mysql_fetch_assoc($rs_detail_kategori);
		$totalRows_rs_detail_kategori = mysql_num_rows($rs_detail_kategori);
}else{
		$query_rs_detail_kategori = "SELECT *, LEFT(deskripsi, 70) as desk, LEFT(nama_produk, 20) as nama FROM produk WHERE id_kategori = $id";
		$rs_detail_kategori = mysql_query($query_rs_detail_kategori, $olshop) or die(mysql_error());
		$row_rs_detail_kategori = mysql_fetch_assoc($rs_detail_kategori);
		$totalRows_rs_detail_kategori = mysql_num_rows($rs_detail_kategori);
}
$colname_rs_kategori_judul = "-1";
if (isset($_GET['id'])) {
  $colname_rs_kategori_judul = $_GET['id'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_kategori_judul = sprintf("SELECT * FROM kategori WHERE id_kategori = %s", GetSQLValueString($colname_rs_kategori_judul, "int"));
$rs_kategori_judul = mysql_query($query_rs_kategori_judul, $olshop) or die(mysql_error());
$row_rs_kategori_judul = mysql_fetch_assoc($rs_kategori_judul);
$totalRows_rs_kategori_judul = mysql_num_rows($rs_kategori_judul);


?>

<!-- -->
<div class="list-group">
      <a href="#" class="list-group-item active">
        <h3> Kategori Produk <strong><?php echo $row_rs_kategori_judul['nama_kategori']; ?> </strong></h3>
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

<?php if ($totalRows_rs_detail_kategori > 0) { ?>
<div class="row">
  <?php do { ?>
    <div class="col-md-4">
      <div class="thumbnail well">
        <img src="gambar/<?php echo $row_rs_detail_kategori['gambar']; ?>" alt="Image" class="img-thumbnails">
        <div class="caption">
          <h5 class="text-uppercase"><strong><?php echo $row_rs_detail_kategori['nama']; ?></strong></h5>
			<small><?php echo $row_rs_detail_kategori['desk']; ?></small><br />
		<small>
        <table width="208" height="60" cellpadding="2" cellspacing="2">
          <tr>
            <td>Harga <span class="btn btn-xs btn-danger">Rp.
                <?php 
							  $dis = ($row_rs_detail_kategori['diskon'] / 100) *  $row_rs_detail_kategori['harga'];
							  $hasil =  $row_rs_detail_kategori['harga'] - $dis; 
							  echo $hasil; ?>
            </span></td>
            <td>&nbsp;</td>
            <td><span class="btn btn-xs btn-info">Disc. <?php echo $row_rs_detail_kategori['diskon']; ?> %</span></td>
          </tr>
        </table>
		</small>
        <p></p>
        <p></p>          
        </div>
        <hr>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
          <p>
            <input type="hidden" name="id_produk" value="<?php echo  $row_rs_detail_kategori['produk_id']; ?>" size="32" />
            <input type="hidden" name="id_session" value="<?php echo $row_rs_login['id_kustomer'] ?>" size="32" />
            <input type="hidden" name="jumlah" value="1" size="32" />
            <input type="hidden" name="tgl_order_temp" value="2017-08-05" size="32" />
            <input type="hidden" name="jam_order_temp" value="08:00:00" size="32" />
            <input type="hidden" name="stok_temp" value="<?php echo  $row_rs_detail_kategori['stok']; ?>" size="32" />
          </p>
         <p align="center"><span class="text-center">
           <?php if ($row_rs_detail_kategori['stok'] > 0) { ?>
          <a href="#" class="btn btn-success">Tersedia <?php echo $row_rs_detail_kategori['stok']; ?></a>
          <input type="submit" class="btn btn-primary" value="Beli" />
          <?php }	?>
          <?php if ($row_rs_detail_kategori['stok'] == 0) { ?>
          <a href="#" class="btn btn-danger"><strong>Habis</strong> terjual!</a>
		  <?php } ?>
			<a href="?page=details&produk_id=<?php echo $row_rs_detail_kategori['produk_id']; ?>" class="btn btn-default" role="button">Details</a><input type="hidden" name="MM_insert" value="form2" />
        </p>
          </form>
      </div>
    </div>
    <?php } while ($row_rs_detail_kategori = mysql_fetch_assoc($rs_detail_kategori)); ?>
</div>
<?php } ?>

<?php if ($totalRows_rs_detail_kategori == 0) { ?>
	<div class="alert alert-warning">Produk belum tersedia</div>
<?php } ?>
