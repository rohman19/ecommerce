<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO kota (nama_kota, ongkos_kirim) VALUES (%s, %s)",
                       GetSQLValueString($_POST['nama_kota'], "text"),
                       GetSQLValueString($_POST['ongkos_kirim'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());
}
 
mysql_select_db($database_olshop, $olshop);
$query_rs_kota = "SELECT * FROM kota";
$rs_kota = mysql_query($query_rs_kota, $olshop) or die(mysql_error());
$row_rs_kota = mysql_fetch_assoc($rs_kota);
$totalRows_rs_kota = mysql_num_rows($rs_kota);
?><style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<div class="list-group-item active">
		<h3>Halaman <strong>Kota dan Ongkos Kirim</strong></h3>
</div>
<p></p>
<?php if ($totalRows_rs_kota  > 0) { ?>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Daftar Kota</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Tambah Kota</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">
    <p></p>


    	<table width="100%" class="table table-striped"  id="data">
            <thead>
              <tr>
                <th width="8%" bgcolor="#333399"><div align="center" class="style1">NO.</div></th>
                <th width="53%" bgcolor="#333399"><div align="center" class="style1">NAMA KOTA</div></th>
                <th width="31%" bgcolor="#333399"><div align="center" class="style1">ONGKOS KIRIM</div></th>
                <th width="8%" bgcolor="#333399"><div align="center"><span class="style1">ACTION</span></div></th>
              </tr>
          </thead>
              <tbody>
              <?php $no = 1; do { ?>
                <tr>
                  <td><div align="center"><?php echo $no++; ?></div></td>
                  <td><?php echo $row_rs_kota['nama_kota']; ?></td>
                  <td><?php echo $row_rs_kota['ongkos_kirim']; ?></td>
                  <td><div align="center"><a href="?page=delete&id_kota=<?php echo $row_rs_kota['id_kota']; ?>"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;<a href="?page=update/kota&v=<?php echo $row_rs_kota['id_kota']; ?>"><span class="glyphicon glyphicon-edit"></span></a></div></td>
                </tr>
                <?php } while ($row_rs_kota = mysql_fetch_assoc($rs_kota)); ?>
              </tbody>
      </table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
    	<br />
            <div class="well">
    	        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                  <table width="331" height="131">
                    <tr valign="baseline">
                      <td width="116" align="left" valign="top" nowrap="nowrap">Nama Kota</td>
                      <td width="203"><input type="text" name="nama_kota" value="" size="32" class="form-control"/></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="left" valign="top" nowrap="nowrap">Ongkos Kirim</td>
                      <td><input type="text" name="ongkos_kirim" value="" size="32"  class="form-control"/></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="left" valign="top" nowrap="nowrap">&nbsp;</td>
                      <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_insert" value="form1" />
                </form>
	        </div>
    </div>
  </div>

</div>


<?php } ?>
<?php if ($totalRows_rs_kota  == 0) { ?>
	<div class="alert alert-danger">Belum ada data Kota, SIlahkan Tambahkan </div>
    <div class="well">
    	        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                  <table width="331" height="131">
                    <tr valign="baseline">
                      <td width="116" align="left" valign="top" nowrap="nowrap">Nama Kota</td>
                      <td width="203"><input type="text" name="nama_kota" value="" size="32" class="form-control"/></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="left" valign="top" nowrap="nowrap">Ongkos Kirim</td>
                      <td><input type="text" name="ongkos_kirim" value="" size="32"  class="form-control"/></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="left" valign="top" nowrap="nowrap">&nbsp;</td>
                      <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_insert" value="form1" />
                </form>
	        </div>
<?php } ?>