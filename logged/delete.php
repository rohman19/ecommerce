<?php 

if ((isset($_GET['email'])) && ($_GET['email'] != "")) {
  $deleteSQL = sprintf("DELETE FROM admins WHERE email=%s",
                       GetSQLValueString($_GET['email'], "text"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());
}

if ((isset($_GET['id_hubungi'])) && ($_GET['id_hubungi'] != "")) {
  $deleteSQL = sprintf("DELETE FROM hubungi WHERE id_hubungi=%s",
                       GetSQLValueString($_GET['id_hubungi'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());
}

if ((isset($_GET['id_kategori'])) && ($_GET['id_kategori'] != "")) {
  $deleteSQL = sprintf("DELETE FROM kategori WHERE id_kategori=%s",
                       GetSQLValueString($_GET['id_kategori'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());
}

if ((isset($_GET['id_kota'])) && ($_GET['id_kota'] != "")) {
  $deleteSQL = sprintf("DELETE FROM kota WHERE id_kota=%s",
                       GetSQLValueString($_GET['id_kota'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());
}

if ((isset($_GET['id_kustomer'])) && ($_GET['id_kustomer'] != "")) {
  $deleteSQL = sprintf("DELETE FROM kustomer WHERE id_kustomer=%s",
                       GetSQLValueString($_GET['id_kustomer'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());
}

if ((isset($_GET['id_modul'])) && ($_GET['id_modul'] != "")) {
  $deleteSQL = sprintf("DELETE FROM modul WHERE id_modul=%s",
                       GetSQLValueString($_GET['id_modul'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());
}

if ((isset($_GET['id_orders'])) && ($_GET['id_orders'] != "")) {
  $deleteSQL = sprintf("DELETE FROM orders WHERE id_orders=%s",
                       GetSQLValueString($_GET['id_orders'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());
}

if ((isset($_GET['id_orders'])) && ($_GET['id_orders'] != "")) {
  $deleteSQL = sprintf("DELETE FROM orders_detail WHERE id_orders=%s",
                       GetSQLValueString($_GET['id_orders'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());
}

if ((isset($_GET['produk_id'])) && ($_GET['produk_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM produk WHERE produk_id=%s",
                       GetSQLValueString($_GET['produk_id'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());
}

if ((isset($_GET['slider_id'])) && ($_GET['slider_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM slider WHERE slider_id=%s",
                       GetSQLValueString($_GET['slider_id'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());
}
?>
<div class="alert alert-danger animated flash">Data berhasil dihapus!!
<?php
  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
?>
<a href="<?=$url?>">Kembali</a></div>
