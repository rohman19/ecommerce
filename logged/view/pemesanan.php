<?php
mysql_select_db($database_olshop, $olshop);
$query_rs_pemesanan = "SELECT * FROM orders, kustomer, kota WHERE orders.id_kustomer = kustomer.id_kustomer AND kustomer.id_kota = kota.id_kota";
$rs_pemesanan = mysql_query($query_rs_pemesanan, $olshop) or die(mysql_error());
$row_rs_pemesanan = mysql_fetch_assoc($rs_pemesanan);
$totalRows_rs_pemesanan = mysql_num_rows($rs_pemesanan);
?>
<style type="text/css">
<!--
.style3 {color: #FFFFFF; }
-->
</style>

<div class="list-group-item active">
		<h3>Halaman <strong>Pemesanan</strong></h3>
</div>
<p></p>

<?php if ($totalRows_rs_pemesanan  > 0) { ?>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Daftar Pemesanan</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">
    <p></p>
    	<table width="100%" class="table table-striped"  id="data">
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
                      <td><?php echo $row_rs_pemesanan['status_order']; ?><br />
                        <small><a href="?page=update/status&id_orders=<?php echo $row_rs_pemesanan['id_orders']; ?>" class="btn btn-xs btn-warning">Ubah Status </a> <a href="?page=delete&id_orders=<?php echo $row_rs_pemesanan['id_orders']; ?>" class="btn btn-xs btn-danger">Hapus</a></small></td>
                      <td><?php echo $row_rs_pemesanan['tgl_order']; ?></td>
                      <td><?php echo $row_rs_pemesanan['jam_order']; ?></td>
                      <td><?php echo $row_rs_pemesanan['nama_lengkap']; ?></td>
                      <td><?php echo $row_rs_pemesanan['email']; ?></td>
                      <td><?php echo $row_rs_pemesanan['telpon']; ?></td>
                      <td><?php echo $row_rs_pemesanan['nama_kota']; ?></td>
                    </tr>
                    <?php } while ($row_rs_pemesanan = mysql_fetch_assoc($rs_pemesanan)); ?>
              </tbody>
      </table>
    </div>
  <div role="tabpanel" class="tab-pane fade" id="profile">
    	<br />
            <div class="well">
    	        Pemesanan
	        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="messages">...</div>
    <div role="tabpanel" class="tab-pane fade" id="settings">...</div>
  </div>

</div>


<?php } ?>
<?php if ($totalRows_rs_pemesanan  == 0) { ?>
	<div class="alert alert-danger">Belum ada order yang masuk </div>
<?php } ?>