<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO modul (static_content, gambar) VALUES (%s, %s)",
                       GetSQLValueString($_POST['static_content'], "text"),
                       GetSQLValueString($gambar = $_FILES['gambar']['name'], "text"));

					if (is_uploaded_file($_FILES['gambar']['tmp_name'])){
							move_uploaded_file($_FILES['gambar']['tmp_name'],"gambar/".$gambar);
						}
  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());
}

mysql_select_db($database_olshop, $olshop);
$query_rs_modul = "SELECT * FROM modul";
$rs_modul = mysql_query($query_rs_modul, $olshop) or die(mysql_error());
$row_rs_modul = mysql_fetch_assoc($rs_modul);
$totalRows_rs_modul = mysql_num_rows($rs_modul);

?>
<style type="text/css">
<!--
.style2 {color: #FFFFFF; }
-->
</style>

<div class="list-group-item active">
		<h3>Halaman <strong>Modul</strong></h3>
</div>
<p></p>

<?php if ($totalRows_rs_modul  > 0) { ?>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Daftar Modul</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Add Modul</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home" >   
     <p></p>

    	<table width="100%" class="table table-striped"  id="data">
            <thead>
             	<tr><th width="4%" height="39" bgcolor="#003366"><div align="center" class="style2">NO.</div></th>
                <th width="86%" bgcolor="#003366"><div align="center" class="style2">KONTEN STATIK</div></th>
                <th width="10%" bgcolor="#003366"><div align="center" class="style2">IMAGE</div></th>
                <th width="10%" bgcolor="#003366"><div align="center"><span class="style2">ACTION</span></div></th>
                </thead>
              <tbody>
             <?php
				  $no = 1; do { ?>
					<tr>
					  <td valign="top"><div align="center"><?php echo $no++; ?></div></td>
					  <td valign="top"><?php echo $row_rs_modul['static_content']; ?></td>
					  <td><img src="gambar/<?php echo $row_rs_modul['gambar']; ?>" width="102" height="102" /></td>
					  <td valign="top"><div align="center">
                        <div align="center"><a href="?page=delete&id_modul=<?php echo $row_rs_modul['id_modul']; ?>"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;<a href="?page=update/modul&v=<?php echo $row_rs_modul['id_modul']; ?>"><span class="glyphicon glyphicon-edit"></span></a></div>
				      </div></td>
					</tr>
			  <?php } while ($row_rs_modul = mysql_fetch_assoc($rs_modul)); ?>
              </tbody>
      </table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
    	<br />
            <div class="well">
    	       <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <table width="100%">
                    <tr valign="baseline">
                      <td width="12%" height="128" align="right" valign="top" nowrap="nowrap"><div align="left">Konten Statik</div></td>
                      <td width="88%" valign="baseline"><textarea name="static_content" cols="50" rows="5" class="form-control" id="mytextarea"></textarea>                      </td>
                    </tr>
                    <tr valign="baseline">
                      <td height="39" align="right" valign="top" nowrap="nowrap"><div align="left">Gambar</div></td>
                      <td valign="baseline"><input name="gambar" type="file" class="form-control" size="32"/></td>
                    </tr>
                    <tr valign="baseline">
                      <td height="43" align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
                      <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_insert" value="form1" />
              </form>
      </div>
    </div>
</div>


<?php } ?>
<?php if ($totalRows_rs_modul  == 0) { ?>
	<div class="alert alert-danger">Belum ada data Modul, Silahkan Tambah </div>
    
     <div class="well">
    	       <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                  <table width="100%">
                    <tr valign="baseline">
                      <td width="12%" height="128" align="right" valign="top" nowrap="nowrap"><div align="left">Konten Statik</div></td>
                      <td width="88%" valign="baseline"><textarea name="static_content" cols="50" rows="5" class="form-control"></textarea>                      </td>
                    </tr>
                    <tr valign="baseline">
                      <td height="39" align="right" valign="top" nowrap="nowrap"><div align="left">Gambar</div></td>
                      <td valign="baseline"><input type="text" name="gambar" value="" size="32" class="form-control"/></td>
                    </tr>
                    <tr valign="baseline">
                      <td height="43" align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
                      <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_insert" value="form1" />
              </form>
	        </div>
<?php } ?>