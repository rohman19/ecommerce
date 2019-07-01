<?php 

mysql_select_db($database_olshop, $olshop);
$query_rs_detail = "SELECT * FROM orders_detail, produk, orders WHERE orders_detail.id_produk = produk.produk_id AND orders_detail.id_orders = orders.id_orders GROUP BY orders_detail.id_orders";
$rs_detail = mysql_query($query_rs_detail, $olshop) or die(mysql_error());
$row_rs_detail = mysql_fetch_assoc($rs_detail);
$totalRows_rs_detail = mysql_num_rows($rs_detail);
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<?php if ($totalRows_rs_detail > 0) { ?>
<table class="table table-striped">
  
      <tr>
        <th height="23">NO.</th>
        <th colspan="2">DETAIL  ORDER</th>
      </tr>
      <?php $no = 1; do { ?>
    <tr>
      <th width="50" rowspan="2"><div align="center"><?php echo $no++; ?></div>        </th>
      <th width="789" height="23"><div align="right"></div></th>
      <th width="193"><div align="center">No. Order : <?php echo $row_rs_detail['id_orders']; ?></div></th>
    </tr>
    <tr>
      <td height="23" colspan="2" valign="top">
	  <?php
      	mysql_select_db($database_olshop, $olshop);
		$query_rs_detailx = "SELECT *, LEFT(produk.nama_produk, 20) as nama FROM orders_detail, produk, orders, kustomer WHERE orders_detail.id_produk = produk.produk_id AND orders_detail.id_orders = orders.id_orders AND orders.id_kustomer = kustomer.id_kustomer AND orders_detail.id_orders = $row_rs_detail[id_orders]";
		$rs_detailx = mysql_query($query_rs_detailx, $olshop) or die(mysql_error());
		$row_rs_detailx = mysql_fetch_assoc($rs_detailx);
		$totalRows_rs_detailx = mysql_num_rows($rs_detailx);
		
	  ?>
      <table width="100%" align="left" class="table table-bordered">
          <tr>
            <th width="4%"><div align="center">No.</div></th>
            <th width="22%"><div align="center">NAMA PRODUK</div></th>
            <th width="13%"><div align="center">JUMLAH</div></th>
            <th width="18%"><div align="center">HARGA</div></th>
            <th width="16%"><div align="center">STATUS</div></th>
            <th width="18%"><div align="center">KUSTOMER</div></th>
            <th width="9%">ACTION</th>
          </tr>
          <?php $nox = 1; do { ?>
            <tr class="small">
              <td><div align="center"><?php echo $nox++; ?></div></td>
              <td><?php echo $row_rs_detailx['nama']; ?></td>
              <td><?php echo $row_rs_detailx['jumlah']; ?></td>
              <td><?php echo $row_rs_detailx['harga']; ?></td>
              <td><?php echo $row_rs_detailx['status_order']; ?></td>
              <td><?php echo $row_rs_detailx['nama_lengkap']; ?></td>
              <td><div align="center">Update</div></td>
            </tr>
          <?php } while ($row_rs_detailx = mysql_fetch_assoc($rs_detailx)); ?>
    </table>      
    </tr>
    <?php } while ($row_rs_detail = mysql_fetch_assoc($rs_detail)); ?>
</table>

<?php } ?>
<?php if ($totalRows_rs_detail == 0) { ?>
	<div class="alert alert-danger">Belum ada order yang masuk </div>
<?php } ?>