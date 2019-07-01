<?php 
$colname_rs_detail_produk1 = "-1";
if (isset($_GET['produk_id'])) {
  $colname_rs_detail_produk1 = $_GET['produk_id'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_detail_produk1 = sprintf("SELECT * FROM produk, kategori WHERE produk_id = %s AND produk.id_kategori = kategori.id_kategori", GetSQLValueString($colname_rs_detail_produk1, "int"));
$rs_detail_produk1 = mysql_query($query_rs_detail_produk1, $olshop) or die(mysql_error());
$row_rs_detail_produk1 = mysql_fetch_assoc($rs_detail_produk1);
$totalRows_rs_detail_produk1 = mysql_num_rows($rs_detail_produk1);
?>
<div class="list-group">
      <a href="#" class="list-group-item active">
        <h3> Details <strong>Produk</strong></h3>
      </a>
</div>

	<div class="jumbotron">
          <div class="container">
          <div class="col-md-6">
	          <img src="logged/gambar/<?php echo $row_rs_detail_produk1['gambar']; ?>" class="img-rounded img-thumbnail" alt="Image" width="273" height="273" longdesc="http://#" />
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
                  <td><?php echo $row_rs_detail_produk1['diskon']; ?> %<br />
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
               <p align="center"><span class="text-center">
                   <?php if ($row_rs_detail_produk1['stok'] > 0) { ?>
                            <a href="?page=login" class="btn btn-lg btn-info"><span class="glyphicon glyphicon-shopping-cart"></span> Beli Sekarang</a>
                          <?php }	?>
                          <?php if ($row_rs_detail_produk1['stok'] == 0) { ?>
                          <a href="#" class="btn btn-lg btn-danger"><strong>Habis</strong> terjual!</a>
                   <?php } ?>
                  </span>
            
               </div>
          </div>
	</div>
    
    <div class="page-header">
    	<h3>Deskripsi</h3>
    </div>
    <p>
		<?php echo $row_rs_detail_produk1['deskripsi']; ?>
    </p>
