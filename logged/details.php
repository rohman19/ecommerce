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

$maxRows_rs_detail_produk1 = 12;
$pageNum_rs_detail_produk1 = 0;
if (isset($_GET['pageNum_rs_detail_produk1'])) {
  $pageNum_rs_detail_produk1 = $_GET['pageNum_rs_detail_produk1'];
}
$startRow_rs_detail_produk1 = $pageNum_rs_detail_produk1 * $maxRows_rs_detail_produk1;

$colname_rs_detail_produk1 = "-1";
if (isset($_GET['produk_id'])) {
  $colname_rs_detail_produk1 = $_GET['produk_id'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_detail_produk1 = sprintf("SELECT * FROM produk WHERE produk_id = %s", GetSQLValueString($colname_rs_detail_produk1, "int"));
$query_limit_rs_detail_produk1 = sprintf("%s LIMIT %d, %d", $query_rs_detail_produk1, $startRow_rs_detail_produk1, $maxRows_rs_detail_produk1);
$rs_detail_produk1 = mysql_query($query_limit_rs_detail_produk1, $olshop) or die(mysql_error());
$row_rs_detail_produk1 = mysql_fetch_assoc($rs_detail_produk1);

if (isset($_GET['totalRows_rs_detail_produk1'])) {
  $totalRows_rs_detail_produk1 = $_GET['totalRows_rs_detail_produk1'];
} else {
  $all_rs_detail_produk1 = mysql_query($query_rs_detail_produk1);
  $totalRows_rs_detail_produk1 = mysql_num_rows($all_rs_detail_produk1);
}
$totalPages_rs_detail_produk1 = ceil($totalRows_rs_detail_produk1/$maxRows_rs_detail_produk1)-1;
?>

<div class="list-group">
      <a href="#" class="list-group-item active">
        <h3> Details <strong>Produk</strong></h3>
      </a>
</div>

	<div class="jumbotron">
          <div class="container">
          <div class="col-md-6">
	          <img src="gambar/<?php echo $row_rs_detail_produk1['gambar']; ?>" class="img-circle img-thumbnail" alt="Image" width="273" height="273" longdesc="http://#" />
          </div>
          <div class="col-md-6">
            <h4><strong><?php echo $row_rs_detail_produk1['nama_produk']; ?></strong></h4>
              <table class="table">
                <tr>
                  <td height="36"><strong>Harga (Rp)</strong></td>
                  <td>Rp. <?php echo $row_rs_detail_produk1['harga']; ?><br />
				                    </td>
                </tr>
                <tr>
                  <td height="31"><strong>Discount (%)</strong></td>
                  <td><?php echo $row_rs_detail_produk1['diskon']; ?>  %<br />
		Rp. 
		<?php 
							  $dis = ($row_rs_detail_produk1['diskon'] / 100) *  $row_rs_detail_produk1['harga'];
							  $hasil =  $row_rs_detail_produk1['harga'] - $dis; 
							  echo $hasil; 
				  ?></td>
                </tr>
                <tr>
                  <td height="31"><strong>Persediaan</strong></td>
                  <td><?php echo $row_rs_detail_produk1['stok']; ?></td>
                </tr>
                <tr>
                  <td height="32"><strong>Berat (Kg)</strong></td>
                  <td><?php echo $row_rs_detail_produk1['berat']; ?></td>
                </tr>
              </table>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
                <p>
                  <input type="hidden" name="id_produk" value="<?php echo  $row_rs_detail_produk1['produk_id']; ?>" size="32" />
                  <input type="hidden" name="id_session" value="<?php echo $row_rs_login['id_kustomer'] ?>" size="32" />
                  <input type="hidden" name="jumlah" value="1" size="32" />
                  <input type="hidden" name="tgl_order_temp" value="2017-08-05" size="32" />
                  <input type="hidden" name="jam_order_temp" value="08:00:00" size="32" />
                  <input type="hidden" name="stok_temp" value="<?php echo  $row_rs_detail_produk1['stok']; ?>" size="32" />
                </p>
                <p align="center"><span class="text-center">
                   <?php if ($row_rs_detail_produk1['stok'] > 0) { ?>
                          <input type="submit" class="btn btn-lg btn-primary" value="Masukkan ke dalam keranjang" />
                          <?php }	?>
                          <?php if ($row_rs_detail_produk1['stok'] == 0) { ?>
                          <a href="#" class="btn btn-lg btn-danger"><strong>Habis</strong> terjual!</a>
                   <?php } ?>
                  </span>
                    <input type="hidden" name="MM_insert" value="form2" />
                </p>
              </form>
               </div>
          </div>
	</div>
    
    <div class="page-header">
    	<h3>Deskripsi</h3>
    </div>
    <p>
		<?php echo $row_rs_detail_produk1['deskripsi']; ?>
    </p>
