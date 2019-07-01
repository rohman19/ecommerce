<?php

mysql_select_db($database_olshop, $olshop);
$query_rs_pesan = "SELECT * FROM hubungi, kustomer WHERE hubungi.id_kustomer = kustomer.id_kustomer";
$rs_pesan = mysql_query($query_rs_pesan, $olshop) or die(mysql_error());
$row_rs_pesan = mysql_fetch_assoc($rs_pesan);
$totalRows_rs_pesan = mysql_num_rows($rs_pesan);
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>

<div class="list-group-item active">
		<h3>Halaman <strong>Pesan Masuk</strong></h3>
</div>
<p></p>

<?php if ($totalRows_rs_pesan  > 0) { ?>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Daftar Pesan</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">
    <br>
    <p></p>


    	<table width="100%" class="table table-striped"  id="data">
            <thead>
              <tr>
                <th width="4%" height="41" bgcolor="#006633"><div align="center" class="style1">No.</div></th>
                <th width="26%" bgcolor="#006633"><div align="center" class="style1">Nama Lengkap</div></th>
                <th width="13%" bgcolor="#006633"><div align="center" class="style1">NO. ORDER</div></th>
                <th width="40%" bgcolor="#006633"><div align="center" class="style1">Pesan</div></th>
                <th width="12%" bgcolor="#006633"><div align="center" class="style1">Tanggal</div></th>
                <th width="5%" bgcolor="#006633"><span class="style1">Action</span></th>
              </tr>
          </thead>
              <tbody>
              <?php $no = 1; do { ?>
                <tr>
                  <td><div align="center"><?php echo $no++; ?></div></td>
                  <td><?php echo $row_rs_pesan['nama_lengkap']; ?></td>
                  <td><div align="center"><?php echo $row_rs_pesan['subjek']; ?></div></td>
                  <td><?php echo $row_rs_pesan['pesan']; ?></td>
                  <td><?php echo $row_rs_pesan['tanggal']; ?></td>
                  <td><div align="center">
                    <div align="center">
                      <div align="center"><a href="?page=delete&id_hubungi=<?php echo $row_rs_pesan['id_hubungi']; ?>"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;<a href="?page=update/pesan&v=<?php echo $row_rs_pesan['id_hubungi']; ?>"><span class="glyphicon glyphicon-edit"></span></a></div>
                    </div>
                  </div></td>
                </tr>
                <?php } while ($row_rs_pesan = mysql_fetch_assoc($rs_pesan)); ?>
              </tbody>
      </table>
    </div>
    
  </div>

</div>

<?php } ?>
<?php if ($totalRows_rs_pesan  == 0) { ?>
	<div class="alert alert-danger">Belum ada pesan yang masuk </div>
<?php } ?>