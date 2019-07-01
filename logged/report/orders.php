<?php 
mysql_select_db($database_olshop, $olshop);	
if (isset($_POST['button'])) {
	$ta1 = $_POST['tanggal1'];
	$ta2 = $_POST['tanggal2'];
	$status = $_POST['status'];
	$query_rs_orders_print = "SELECT * FROM orders, kustomer, kota WHERE orders.id_kustomer = kustomer.id_kustomer AND kustomer.id_kota = kota.id_kota AND tgl_order BETWEEN '".$ta1."' AND '".$ta2."' AND status_order = '".$status."'";
	$rs_orders_print = mysql_query($query_rs_orders_print, $olshop) or die(mysql_error());
	$row_rs_orders_print = mysql_fetch_assoc($rs_orders_print);
	$totalRows_rs_orders_print = mysql_num_rows($rs_orders_print);
}else{
	$query_rs_orders_print = "SELECT * FROM orders, kustomer, kota WHERE orders.id_kustomer = kustomer.id_kustomer AND kustomer.id_kota = kota.id_kota LIMIT 10";
	$rs_orders_print = mysql_query($query_rs_orders_print, $olshop) or die(mysql_error());
	$row_rs_orders_print = mysql_fetch_assoc($rs_orders_print);
	$totalRows_rs_orders_print = mysql_num_rows($rs_orders_print);
}
?>

<div class="list-group-item active">
  <h3>Print Laporan <strong>Orders</strong></h3>
</div>
<div class="well">
<a href="print/orders1.php" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-print"></span> Cetak Keseluruhan</a><form id="form1" name="form1" method="post" action="" class="form-inline">
  Laporan Orders dari Tanggal 
  <input type="date" name="tanggal1" id="textfield1" class="form-control"/> 
  s/d 
  <input type="date" name="tanggal2" id="textfield2" class="form-control"/>
  <select name="status" id="status" class="form-control">
    <option value="Lunas">Lunas</option>
    <option value="Belum Lunas">Belum Lunas</option>
   
  </select>
   <input type="submit" name="button" id="button" value="Search" class="btn btn-warning"/>
</form>
</div>

<?php if ($totalRows_rs_orders_print > 0) { // Show if recordset not empty ?>
<p><a href="print/orders.php?tanggal1=<?php echo $ta1; ?>&tanggal2=<?php echo $ta2; ?>&status=<?php echo $status;?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-print"></span> Print</a> <small>Lakukan Pencarian Sebelum melakukan Print</small></p>
<table width="100%" class="table table-striped">
        <thead>
              <tr>
                   <th bgcolor="#66CCCC"><div align="center" class="style3">NO.</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">STATUS</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">TGL. ORDER</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">PUKUL</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">PEMESAN</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">EMAIL</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">NO. REKENING</div></th>
                <th bgcolor="#66CCCC"><div align="center" class="style3">KOTA</div></th>
          </tr>
          </thead>
              <tbody>
              <?php $no = 1; do { ?>
                    <tr class="small">
                      <td><div align="center"><?php echo $no++; ?></div></td>
                      <td><?php echo $row_rs_orders_print['status_order']; ?><br />
                        <small><a href="?page=update/status&id_orders=<?php echo $row_rs_orders_print['id_orders']; ?>" class="btn btn-xs btn-warning">Ubah Status </a> <a href="?page=delete&id_orders=<?php echo $row_rs_orders_print['id_orders']; ?>" class="btn btn-xs btn-danger">Hapus</a></small></td>
                      <td><?php echo $row_rs_orders_print['tgl_order']; ?></td>
                      <td><?php echo $row_rs_orders_print['jam_order']; ?></td>
                      <td><?php echo $row_rs_orders_print['nama_lengkap']; ?></td>
                      <td><?php echo $row_rs_orders_print['email']; ?></td>
                      <td><?php echo $row_rs_orders_print['telpon']; ?></td>
                      <td><?php echo $row_rs_orders_print['nama_kota']; ?></td>
                    </tr>
                    <?php } while ($row_rs_orders_print = mysql_fetch_assoc($rs_orders_print)); ?>
              </tbody>
      </table>
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_rs_orders_print == 0) { // Show if recordset empty ?>
  <p class="alert alert-danger">Data Orders tidak ditemukan!!</p>
  <?php } // Show if recordset empty ?>
