<!-- -->
<div class="list-group">
      <a href="#" class="list-group-item active">
        <h3> Kategori Produk <strong><?php echo $row_rs_kategori_judul['nama_kategori']; ?> </strong></h3>
      </a>
</div>
<?php if ($totalRows_rs_detail_kategori > 0) { ?>
<div class="row">
  <?php do { ?>
    <div class="col-md-4">
      <div class="thumbnail well">
        <img src="logged/gambar/<?php echo $row_rs_detail_kategori['gambar']; ?>" alt="Image" class="img-thumbnails">
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
                            <a href="?page=login" class="btn btn-info"><span class="glyphicon glyphicon-shopping-cart"></span> Beli Sekarang</a>
                          <?php }	?>
                          <?php if ($row_rs_detail_kategori['stok'] == 0) { ?>
                          <a href="#" class="btn  btn-danger"><strong>Habis</strong> terjual!</a>
                   <?php } ?>
                  </span>
        
          </a> <a href="?page=details&produk_id=<?php echo $row_rs_detail_kategori['produk_id']; ?>" class="btn btn-default" role="button">Details</a></span><input type="hidden" name="MM_insert" value="form2" />
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