<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO produk (id_kategori, nama_produk, deskripsi, harga, stok, berat, tgl_masuk, gambar, dibeli, diskon) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_kategori'], "int"),
                       GetSQLValueString($_POST['nama_produk'], "text"),
                       GetSQLValueString($_POST['deskripsi'], "text"),
                       GetSQLValueString($_POST['harga'], "int"),
                       GetSQLValueString($_POST['stok'], "int"),
                       GetSQLValueString($_POST['berat'], "double"),
                       GetSQLValueString($_POST['tgl_masuk'], "date"),
                      GetSQLValueString($gambar = $_FILES['gambar']['name'], "text"),
                       GetSQLValueString($_POST['dibeli'], "int"),
                       GetSQLValueString($_POST['diskon'], "int"));
					   
					   if(is_uploaded_file($_FILES['gambar']['tmp_name'])){
							move_uploaded_file($_FILES['gambar']['tmp_name'],"gambar/".$gambar);
						}

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());
}

mysql_select_db($database_olshop, $olshop);
$query_rs_produk = "SELECT *, LEFT(produk.deskripsi, 60) as desk FROM produk, kategori WHERE produk.id_kategori = kategori.id_kategori";
$rs_produk = mysql_query($query_rs_produk, $olshop) or die(mysql_error());
$row_rs_produk = mysql_fetch_assoc($rs_produk);
$totalRows_rs_produk = mysql_num_rows($rs_produk);

mysql_select_db($database_olshop, $olshop);
$query_rs_kategorix = "SELECT * FROM kategori";
$rs_kategorix = mysql_query($query_rs_kategorix, $olshop) or die(mysql_error());
$row_rs_kategorix = mysql_fetch_assoc($rs_kategorix);
$totalRows_rs_kategorix = mysql_num_rows($rs_kategorix);
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<div class="list-group-item active">
		<h3>Halaman <strong>Produk</strong></h3>
</div>
<p></p>
<?php if ($totalRows_rs_produk  > 0) { ?>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Daftar Produk</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Add Produk</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">   
     <p></p>

    	<table width="100%" class="table table-striped"  id="data">
            <thead>
              <tr valign="middle">
               <th width="4%" height="31" bgcolor="#666699"><div align="center" class="style1 style1">NO.</div></th>
                <th width="9%" bgcolor="#666699"><div align="center" class="style1">PRODUK</div></th>
                <th width="30%" bgcolor="#666699"><span class="style1">NAMA PRODUK
                </span>                  <div align="center" class="style1"></div></th>
                <th width="23%" bgcolor="#666699"><div align="center" class="style1">DESK</div></th>
                <th width="10%" bgcolor="#666699"><div align="center" class="style1">TGL. MASUK</div></th>
                <th width="6%" bgcolor="#666699"><div align="center" class="style1">DIBELI</div></th>
                <th width="5%" bgcolor="#666699"><div align="center" class="style1">DISC.</div></th>
                <th width="7%" bgcolor="#666699"><div align="center" class="style1">KATEGORI</div></th>
                <th width="6%" bgcolor="#666699">&nbsp;</th>
              </tr>
          </thead>
              <tbody>
             <?php $no = 1; do { ?>
                <tr valign="top">
                  <td><div align="center"><?php echo $no++; ?></div></td>
                  <td><img src="gambar/<?php echo $row_rs_produk['gambar']; ?>" width="74" height="74"/></td>
                  <td><small><?php echo $row_rs_produk['nama_produk']; ?></small><br />
                    <small><div class="btn btn-xs btn-warning">Rp. <?php echo $row_rs_produk['harga']; ?></div> <div class="btn btn-xs btn-info">Berat <?php echo $row_rs_produk['berat']; ?> Kg</div> <br>
Persediaan Barang : <?php echo $row_rs_produk['stok']; ?></small></td>
                  <td><small><?php echo $d = $row_rs_produk['desk']; ?></small></td>
                  <td><small><?php echo $t = $row_rs_produk['tgl_masuk']; ?></small></td>
                  <td><small><?php echo $b = $row_rs_produk['dibeli']; ?></small></td>
                  <td><small><?php echo $dc = $row_rs_produk['diskon']; ?> %</small></td>
                  <td><small><?php echo $n = $row_rs_produk['nama_kategori']; ?></small></td>
                  <td><div align="center"><a href="?page=delete&produk_id=<?php echo $row_rs_produk['produk_id']; ?>"><span class="glyphicon glyphicon-trash"></span></a>
<a href="?page=update/produk&v=<?php echo $row_rs_produk['produk_id']; ?>"><span class="glyphicon glyphicon-edit"></span></a></div></td>
                </tr>
                <?php } while ($row_rs_produk = mysql_fetch_assoc($rs_produk)); ?>
              </tbody>
      </table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
    	<br />
            <div class="well">
    	       <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table width="100%" height="584">
<tr valign="baseline">
                            <td width="16%" align="left" valign="top" nowrap="nowrap"><div align="left">Produk Kategori</div></td>
                          <td width="84%"><select name="id_kategori" class="form-control">
                                <?php 
                do {  
                ?>
                                <option value="<?php echo $row_rs_kategorix['id_kategori']?>" ><?php echo $row_rs_kategorix['nama_kategori']?></option>
                                <?php
                } while ($row_rs_kategorix = mysql_fetch_assoc($rs_kategorix));
                ?>
                              </select>            </td>
                          </tr>
                          <tr> </tr>
                          <tr valign="baseline">
                            <td align="left" valign="top" nowrap="nowrap"><div align="left">Nama Produk</div></td>
                            <td><input type="text" name="nama_produk" value="" size="32" class="form-control"/></td>
                          </tr>
                          <tr valign="baseline">
                            <td nowrap="nowrap" align="left" valign="top"><div align="left">Deskripsi</div></td>
                            <td><textarea name="deskripsi" cols="50" rows="5" class="form-control" id="mytextarea"></textarea>            </td>
                          </tr>
                          <tr valign="baseline">
                            <td align="left" valign="top" nowrap="nowrap"><div align="left">Harga</div></td>
                            <td><input type="text" name="harga" value="" size="32" class="form-control"/></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="left" valign="top" nowrap="nowrap"><div align="left">Stok</div></td>
                            <td><input type="text" name="stok" value="" size="32" class="form-control"/></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="left" valign="top" nowrap="nowrap"><div align="left">Berat</div></td>
                            <td><input type="text" name="berat" value="" size="32" class="form-control" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="left" valign="top" nowrap="nowrap"><div align="left">Tanggal Pembelian</div></td>
                            <td><input type="text" name="tgl_masuk" value="" size="32" class="form-control"/></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="left" valign="top" nowrap="nowrap"><div align="left">Gambar:</div></td>
                            <td><input name="gambar" type="file" size="32" /></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="left" valign="top" nowrap="nowrap"><div align="left">Jumlah dibeli</div></td>
                            <td><input type="text" name="dibeli" value="" size="32" class="form-control"/></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="left" valign="top" nowrap="nowrap"><div align="left">Diskon</div></td>
                            <td><input type="text" name="diskon" value="" size="32" class="form-control"/></td>
                          </tr>
                          <tr valign="baseline">
                            <td align="left" valign="top" nowrap="nowrap"><div align="left"></div></td>
                            <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
                          </tr>
                        </table>
                 <input type="hidden" name="MM_insert" value="form1" />
              </form>
      </div>
    </div>
</div>

<?php } ?>
<?php if ($totalRows_rs_produk  == 0) { ?>
	<div class="alert alert-danger">Belum ada Produk, Silahkan tambahkan produk : </div>
    
    <div class="well">
    	       <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table width="100%" height="584">
  <tr valign="baseline">
    <td width="16%" align="left" valign="top" nowrap="nowrap"><div align="left">Produk Kategori</div></td>
    <td width="84%"><select name="id_kategori2" class="form-control">
      <?php 
                do {  
                ?>
      <option value="<?php echo $row_rs_kategorix['id_kategori']?>" ><?php echo $row_rs_kategorix['nama_kategori']?></option>
      <?php
                } while ($row_rs_kategorix = mysql_fetch_assoc($rs_kategorix));
                ?>
    </select>
    </td>
  </tr>
  <tr> </tr>
  <tr valign="baseline">
    <td align="left" valign="top" nowrap="nowrap"><div align="left">Nama Produk</div></td>
    <td><input type="text" name="nama_produk2" value="" size="32" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left" valign="top"><div align="left">Deskripsi</div></td>
    <td><textarea name="deskripsi2" cols="50" rows="5" class="form-control"  id="mytextarea"></textarea>
    </td>
  </tr>
  <tr valign="baseline">
    <td align="left" valign="top" nowrap="nowrap"><div align="left">Harga</div></td>
    <td><input type="text" name="harga2" value="" size="32" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <td align="left" valign="top" nowrap="nowrap"><div align="left">Stok</div></td>
    <td><input type="text" name="stok2" value="" size="32" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <td align="left" valign="top" nowrap="nowrap"><div align="left">Berat</div></td>
    <td><input type="text" name="berat2" value="" size="32" class="form-control" /></td>
  </tr>
  <tr valign="baseline">
    <td align="left" valign="top" nowrap="nowrap"><div align="left">Tanggal Pembelian</div></td>
    <td><input type="text" name="tgl_masuk2" value="" size="32" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <td align="left" valign="top" nowrap="nowrap"><div align="left">Gambar:</div></td>
    <td><input name="gambar2" type="file" size="32" /></td>
  </tr>
  <tr valign="baseline">
    <td align="left" valign="top" nowrap="nowrap"><div align="left">Jumlah dibeli</div></td>
    <td><input type="text" name="dibeli2" value="" size="32" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <td align="left" valign="top" nowrap="nowrap"><div align="left">Diskon</div></td>
    <td><input type="text" name="diskon2" value="" size="32" class="form-control"/></td>
  </tr>
  <tr valign="baseline">
    <td align="left" valign="top" nowrap="nowrap"><div align="left"></div></td>
    <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
  </tr>
</table>
<input type="hidden" name="MM_insert" value="form1" />
              </form>
      </div>
<?php } ?>