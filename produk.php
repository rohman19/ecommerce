<div class="page-header">
		<h3 class="violet">All Product</h3>
</div>

<?php do { ?>
  <div class="col-md-6">
                <table width="301" height="128" class="table">
                          <tr>
                            <td width="32%" rowspan="3"><img src="logged/gambar/<?php echo $row_rs_productx['gambar']; ?>" alt="Image" width="124" height="124" class="img-thumbnails" /></td>
                            <td width="4%" rowspan="3">&nbsp;</td>
                            <td width="64%"><small class="text-uppercase"><strong><?php echo $row_rs_productx['nama']; ?></strong></small>                           </td>
                          </tr>
                          <tr>
                            <td><?php echo nl2br($row_rs_productx['desk']); ?> <small>
                               <div class="btn btn-xs btn-info">Disc. <?php echo $row_rs_productx['diskon']; ?> %</div>
                              <div class="btn btn-xs btn-warning">Harga Rp. <?php echo  '<del>'.$row_rs_productx['harga'] .'</div>'; ?></div>
                              <div class="btn btn-xs btn-danger">Harga Rp. <?php 
							  $dis = ($row_rs_productx['diskon'] / 100) *  $row_rs_productx['harga'];
							  $hasil =  $row_rs_productx['harga'] - $dis; 
							  echo $hasil; ?></div>
                              <div class="btn btn-xs btn-success">Stok : <?php echo $row_rs_productx['stok']; ?></div>
                              </small><br />                        </td>
                          </tr>
                          
                          <tr>
                            <td>
                            <?php if ($row_rs_productx['stok'] == 0) { ?>
									<a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-times"></span> <strong>Habis!!</strong></a>	
							<?php }	?>
                            <?php if ($row_rs_productx['stok'] > 0) { ?>
                            		<a href="?page=login&buy" class="btn btn-info"><span class="glyphicon glyphicon-shopping-cart"></span> Beli</a>	
                            <?php }	?>
                             <a href="?page=details&amp;produk_id=<?php echo $row_rs_productx['produk_id']; ?>" class="btn btn-default" role="button">Details</a></td>
                          </tr>
                          </table>
  </div>
   <?php } while ($row_rs_productx = mysql_fetch_assoc($rs_productx)); ?>
   
   <table class="table">
  <tr>
    <td><?php if ($pageNum_rs_productx > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs_productx=%d%s", $currentPage, 0, $queryString_rs_productx); ?>"><img src="logged/gambar/First.gif" border="0" /> Produk Awal</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rs_productx > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs_productx=%d%s", $currentPage, max(0, $pageNum_rs_productx - 1), $queryString_rs_productx); ?>"><img src="logged/gambar/Previous.gif" border="0" /> Produk Sebelumnya </a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rs_productx < $totalPages_rs_productx) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rs_productx=%d%s", $currentPage, min($totalPages_rs_productx, $pageNum_rs_productx + 1), $queryString_rs_productx); ?>">Produk Selanjutnya <img src="logged/gambar/Next.gif" border="0" /></a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rs_productx < $totalPages_rs_productx) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rs_productx=%d%s", $currentPage, $totalPages_rs_productx, $queryString_rs_productx); ?>"><img src="logged/gambar/Last.gif" border="0" /> Produk Awal</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>