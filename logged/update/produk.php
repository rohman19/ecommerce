<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE produk SET id_kategori=%s, nama_produk=%s, deskripsi=%s, harga=%s, stok=%s, berat=%s, tgl_masuk=%s,  dibeli=%s, diskon=%s WHERE produk_id=%s",
                       GetSQLValueString($_POST['id_kategori'], "int"),
                       GetSQLValueString($_POST['nama_produk'], "text"),
                       GetSQLValueString($_POST['deskripsi'], "text"),
                       GetSQLValueString($_POST['harga'], "int"),
                       GetSQLValueString($_POST['stok'], "int"),
                       GetSQLValueString($_POST['berat'], "double"),
                       GetSQLValueString($_POST['tgl_masuk'], "date"),
                       //GetSQLValueString($_POST['gambar'], "text"),
                       GetSQLValueString($_POST['dibeli'], "int"),
                       GetSQLValueString($_POST['diskon'], "int"),
                       GetSQLValueString($_POST['produk_id'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
}

mysql_select_db($database_olshop, $olshop);
$query_rs_kategori = "SELECT * FROM kategori";
$rs_kategori = mysql_query($query_rs_kategori, $olshop) or die(mysql_error());
$row_rs_kategori = mysql_fetch_assoc($rs_kategori);
$totalRows_rs_kategori = mysql_num_rows($rs_kategori);

$colname_rs_product_update = "-1";
if (isset($_GET['v'])) {
  $colname_rs_product_update = $_GET['v'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_product_update = sprintf("SELECT * FROM produk WHERE produk_id = %s", GetSQLValueString($colname_rs_product_update, "int"));
$rs_product_update = mysql_query($query_rs_product_update, $olshop) or die(mysql_error());
$row_rs_product_update = mysql_fetch_assoc($rs_product_update);
$totalRows_rs_product_update = mysql_num_rows($rs_product_update);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="page-header">
	<h3>Update <strong>Data Produk</strong></h3>
</div>
<div class="col-md-8">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" height="504">
    <tr valign="baseline">
      <td width="157" align="right" valign="top" nowrap="nowrap"><div align="left">Kategori Produk</div></td>
      <td width="852"><select name="id_kategori" class="form-control">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_kategori['id_kategori']?>" <?php if (!(strcmp($row_rs_kategori['id_kategori'], htmlentities($row_rs_product_update['id_kategori'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_rs_kategori['nama_kategori']?></option>
        <?php
} while ($row_rs_kategori = mysql_fetch_assoc($rs_kategori));
?>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Nama Produk</div></td>
      <td><input type="text" name="nama_produk" value="<?php echo htmlentities($row_rs_product_update['nama_produk'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"><div align="left">Deskripsi</div></td>
      <td><textarea name="deskripsi" cols="50" rows="5"  class="form-control"><?php echo htmlentities($row_rs_product_update['deskripsi'], ENT_COMPAT, 'utf-8'); ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Harga</div></td>
      <td><input type="text" name="harga" value="<?php echo htmlentities($row_rs_product_update['harga'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Stok</div></td>
      <td><input type="text" name="stok" value="<?php echo htmlentities($row_rs_product_update['stok'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Berat</div></td>
      <td><input type="text" name="berat" value="<?php echo htmlentities($row_rs_product_update['berat'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Tanggal dibeli</div></td>
      <td><input type="text" name="tgl_masuk" value="<?php echo htmlentities($row_rs_product_update['tgl_masuk'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Jumlah Beli</div></td>
      <td><input type="text" name="dibeli" value="<?php echo htmlentities($row_rs_product_update['dibeli'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Diskon</div></td>
      <td><input type="text" name="diskon" value="<?php echo htmlentities($row_rs_product_update['diskon'], ENT_COMPAT, 'utf-8'); ?>" size="32"  class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
      <td valign="bottom"><input type="submit" value="Simpan"  class="btn btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="produk_id" value="<?php echo $row_rs_product_update['produk_id']; ?>" />
</form>
</div>
<div class="col-md-4">
	<img src="gambar/<?php echo $row_rs_product_update['gambar']; ?>" alt="Image" width="44%" height="445" class="image-responsive"/>
	<hr />
    <p><a href="?page=update/gambar&v=<?php echo $row_rs_product_update['produk_id']; ?>">Ganti Gambar Produk</a></p>
</div>