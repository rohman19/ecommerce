<?php  

mysql_select_db($database_olshop, $olshop);
$query_rs_riwayat = "SELECT * FROM orders_detail, orders WHERE orders.id_kustomer = $row_rs_login[id_kustomer] AND orders_detail.id_orders = orders.id_orders GROUP BY orders.id_orders";
$rs_riwayat = mysql_query($query_rs_riwayat, $olshop) or die(mysql_error());
$row_rs_riwayat = mysql_fetch_assoc($rs_riwayat);
$totalRows_rs_riwayat = mysql_num_rows($rs_riwayat);
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>

<div class="list-group-item active">
		<h3><span class="glyphicon glyphicon-shopping-cart"></span> Riwayat <strong>Pembelian</strong></h3>
</div>
<p></p>

<?php if ($totalRows_rs_riwayat > 0) { ?>
<table width="100%" class="table table-striped table-bordered table-hovered"  id="data">
<thead>
  <tr>
    <th height="33" bgcolor="#006699"><div align="center"><span class="style1">NO.</span></div></th>
    <th bgcolor="#006699"><div align="center"><span class="style1">NO. ORDER</span></div></th>
    <th bgcolor="#006699"><div align="center"><span class="style1">STATUS ORDER</span></div></th>
    <th bgcolor="#006699"><div align="center"><span class="style1">TGL. ORDER</span></div></th>
    <th bgcolor="#006699"><div align="center"><span class="style1">JAM ORDER</span></div></th>
    <th bgcolor="#006699"><div align="center"></div></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $no = 1;
   do { ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><div align="center"><?php echo $row_rs_riwayat['id_orders']; ?></div></td>
      <td><?php echo $row_rs_riwayat['status_order']; ?> - <a href="?page=view/complaint&v=<?php echo $row_rs_riwayat['id_orders']; ?>">Kirim Komentar</a> - <a href="?page=view/bukti&v=<?php echo $row_rs_riwayat['id_orders']; ?>">Konfirmasi</a></td>
      <td><div align="center"><?php echo $row_rs_riwayat['tgl_order']; ?></div></td>
      <td><div align="center"><?php echo $row_rs_riwayat['jam_order']; ?></div></td>
      <td><a href="?page=riwayat_kwitansi&v=<?php echo $row_rs_riwayat['id_orders']; ?>"><span class="glyphicon glyphicon-search"></span> Show</a></td>
    </tr>
    <?php } while ($row_rs_riwayat = mysql_fetch_assoc($rs_riwayat)); ?>
  </tbody>
</table>
<?php } ?>
<?php if ($totalRows_rs_riwayat == 0) { ?>
	<div class="alert alert-danger">Belum ada riwayat belanja, <a href="?page=beranda">Ayo belanja!!</a></div>
<?php } ?>