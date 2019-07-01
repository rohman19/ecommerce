<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO kategori (nama_kategori) VALUES (%s)",
                       GetSQLValueString($_POST['nama_kategori'], "text"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());
}

mysql_select_db($database_olshop, $olshop);
$query_rs_kategori = "SELECT * FROM kategori";
$rs_kategori = mysql_query($query_rs_kategori, $olshop) or die(mysql_error());
$row_rs_kategori = mysql_fetch_assoc($rs_kategori);
$totalRows_rs_kategori = mysql_num_rows($rs_kategori);
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>

<div class="list-group-item active">
		<h3>Halaman <strong>Kategori</strong></h3>
</div>
<p></p>
<?php if ($totalRows_rs_kategori  > 0) { ?>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Daftar Kategori</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Add Kategori</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">

    <p></p>

    	<table width="100%" class="table table-striped"  id="data">
            <thead>
              <tr>
               <th width="3%" height="36" bgcolor="#663366"><div align="center" class="style1">No.</div></th>
   			   <th width="82%" bgcolor="#663366"><div align="center" class="style1">NAMA KATEGORI</div></th>
               <th width="15%" bgcolor="#663366"><div align="center"><span class="style1">ACTION</span></div></th>
              </tr>
          </thead>
              <tbody>
              <?php $no = 1; do { ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $row_rs_kategori['nama_kategori']; ?></td>
                  <td><div align="center">
                    <div align="center">
                      <div align="center"><a href="?page=delete&id_kategori=<?php echo $row_rs_kategori['id_kategori']; ?>"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;<a href="?page=update/kategori&v=<?php echo $row_rs_kategori['id_kategori']; ?>"><span class="glyphicon glyphicon-edit"></span></a></div>
                    </div>
                  </div></td>
                </tr>
                <?php } while ($row_rs_kategori = mysql_fetch_assoc($rs_kategori)); ?>
              </tbody>
      </table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
    	<br />
            <div class="well">
    	       <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                  <table width="100%" height="88">
                    <tr valign="baseline">
                      <td width="137" align="right" valign="top" nowrap="nowrap"><div align="left">Nama Kategori</div></td>
                      <td width="911"><input type="text" name="nama_kategori" value="" size="32" class="form-control"/></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
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
<?php if ($totalRows_rs_kategori  == 0) { ?>
	<div class="alert alert-danger">Belum ada data kategori, SIlahkan Tambahkan </div>
    
    <div class="well">
    	       <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                  <table width="100%" height="88">
                    <tr valign="baseline">
                      <td width="137" align="right" valign="top" nowrap="nowrap"><div align="left">Nama Kategori</div></td>
                      <td width="911"><input type="text" name="nama_kategori" value="" size="32" class="form-control"/></td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
                      <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_insert" value="form1" />
              </form>
	        </div>
<?php } ?>