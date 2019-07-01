<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO kustomer (password, nama_lengkap, alamat, email, telpon, id_kota, tanggal) VALUES (md5(%s), %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['telpon'], "text"),
                       GetSQLValueString($_POST['id_kota'], "int"),
					   GetSQLValueString($_POST['tanggal'], "date"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());
}

mysql_select_db($database_olshop, $olshop);
$query_rs_kota = "SELECT * FROM kota";
$rs_kota = mysql_query($query_rs_kota, $olshop) or die(mysql_error());
$row_rs_kota = mysql_fetch_assoc($rs_kota);
$totalRows_rs_kota = mysql_num_rows($rs_kota);

mysql_select_db($database_olshop, $olshop);
$query_rs_kustomer = "SELECT * FROM kustomer, kota WHERE kustomer.id_kota = kota.id_kota";
$rs_kustomer = mysql_query($query_rs_kustomer, $olshop) or die(mysql_error());
$row_rs_kustomer = mysql_fetch_assoc($rs_kustomer);
$totalRows_rs_kustomer = mysql_num_rows($rs_kustomer);
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>

<div class="list-group-item active">
		<h3>Halaman <strong>Customer</strong></h3>
</div>
<p></p>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Daftar Customer</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Add Customer</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">
    <p></p>


    	<table width="100%" class="table table-striped"  id="data">
            <thead>
              <tr>
               <th width="4%" bgcolor="#6699FF"><div align="center" class="style1">NO.</div></th>
                <th width="18%" bgcolor="#6699FF"><div align="center" class="style1">NAMA</div></th>
                <th width="20%" bgcolor="#6699FF"><div align="center" class="style1">ALAMAT</div></th>
                <th width="17%" bgcolor="#6699FF"><div align="center" class="style1">EMAIL</div></th>
                <th width="15%" bgcolor="#6699FF"><div align="center" class="style1">NO. REKENING</div></th>
                <th width="16%" bgcolor="#6699FF"><div align="center" class="style1">KOTA</div></th>
                <th width="10%" bgcolor="#6699FF"><span class="style1">ACTION</span></th>
              </tr>
          </thead>
              <tbody>
              <?php $no = 1; do { ?>
                <tr>
                 <td valign="top"><small><div align="center"><?php echo $no++; ?></div></small></td>
                  <td valign="top"><small><?php echo $row_rs_kustomer['nama_lengkap']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_kustomer['alamat']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_kustomer['email']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_kustomer['telpon']; ?></small></td>
                  <td valign="top"><small><?php echo $row_rs_kustomer['nama_kota']; ?></small></td>
                  <td valign="top"><small><div align="center">
                    <div align="center">
                      <div align="center"><a href="?page=delete&id_kustomer=<?php echo $row_rs_kustomer['id_kustomer']; ?>"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;<a href="?page=update/kustomer&v=<?php echo $row_rs_kustomer['id_kustomer']; ?>"><span class="glyphicon glyphicon-edit"></span></a></div>
                    </div>
                  </div>
                  </small></td>
                </tr>
                <?php } while ($row_rs_kustomer = mysql_fetch_assoc($rs_kustomer)); ?>
              </tbody>
      </table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
    	<br />
            <div class="well">
    	        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                      <table width="100%" height="393">
                        <tr valign="baseline">
                          <td width="14%" align="right" valign="top" nowrap="nowrap"><div align="left">Password</div></td>
                          <td width="86%"><input type="password" name="password" value="" size="32" class="form-control"/></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="right" valign="top" nowrap="nowrap"><div align="left">Nama Lengkap</div></td>
                          <td><input type="text" name="nama_lengkap" value="" size="32"  class="form-control"/></td>
                        </tr>
                        <tr valign="baseline">
                          <td height="119" align="right" valign="top" nowrap="nowrap"><div align="left">Alamat:</div></td>
                          <td><textarea name="alamat" cols="50" rows="5"  class="form-control"></textarea>      </td>
                        </tr>
                        <tr valign="baseline">
                          <td align="right" valign="top" nowrap="nowrap"><div align="left">Email</div></td>
                          <td><input type="text" name="email" value="" size="32"  class="form-control"/></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="right" valign="top" nowrap="nowrap"><div align="left">No. Rek</div></td>
                          <td><input type="text" name="telpon" value="" size="32"  class="form-control"/></td>
                        </tr>
                        <tr valign="baseline">
                          <td align="right" valign="top" nowrap="nowrap"><div align="left">Kota</div></td>
                          <td><select name="id_kota"  class="form-control">
                            <?php 
                    do {  
                    ?>
                            <option value="<?php echo $row_rs_kota['id_kota']?>" ><?php echo $row_rs_kota['nama_kota']?></option>
                            <?php
                    } while ($row_rs_kota = mysql_fetch_assoc($rs_kota));
                    ?>
                          </select>      </td>
                        </tr>
                        <tr> </tr>
                        <tr valign="baseline">
                          <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
                          <td valign="bottom"><input type="submit" value="Simpan"  class="btn btn-primary"/></td>
                        </tr>
                      </table>
                       <input type="hidden" name="tanggal" value="<?php echo $tglsekarang;  ?>" />
                      <input type="hidden" name="MM_insert" value="form1" />
              </form>
	        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="messages">...</div>
    <div role="tabpanel" class="tab-pane fade" id="settings">...</div>
  </div>

</div>