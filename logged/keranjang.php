<?php 


//mengubah jumlah dengan menggunakan combobox
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
  $updateSQL = sprintf("UPDATE orders_temp SET jumlah=%s WHERE id_orders_temp=%s",
                       GetSQLValueString($_POST['jumlah'], "int"),
                       GetSQLValueString($_POST['id_orders_temp'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
  	
}
//--------------
//menampilkan daftar barang yang ada di keranjang berdasarkan id_kustomer
mysql_select_db($database_olshop, $olshop);
$sesi = $row_rs_login['id_kustomer'];
$query_rs_isi_cart = "SELECT * FROM orders_temp, produk WHERE id_session = $sesi AND orders_temp.id_produk = produk.produk_id GROUP BY produk.produk_id";
$rs_isi_cart = mysql_query($query_rs_isi_cart, $olshop) or die(mysql_error());
$row_rs_isi_cart = mysql_fetch_assoc($rs_isi_cart);
$totalRows_rs_isi_cart = mysql_num_rows($rs_isi_cart);

//menampilkan ongkos kirim per user
mysql_select_db($database_olshop, $olshop);
$query_rs_kota = "SELECT * FROM kota, kustomer WHERE kota.id_kota = kustomer.id_kota AND kustomer.id_kustomer = $row_rs_login[id_kustomer]";
$rs_kota = mysql_query($query_rs_kota, $olshop) or die(mysql_error());
$row_rs_kota = mysql_fetch_assoc($rs_kota);
$totalRows_rs_kota = mysql_num_rows($rs_kota);

//menampilkan data orders
mysql_select_db($database_olshop, $olshop);
$query_rs_orders1 = "SELECT * FROM orders";
$rs_orders1 = mysql_query($query_rs_orders1, $olshop) or die(mysql_error());
$row_rs_orders1 = mysql_fetch_assoc($rs_orders1);
$totalRows_rs_orders1 = mysql_num_rows($rs_orders1);

//menampilankan data order_temp yang kedua agar bisa diinput ke order_detail
mysql_select_db($database_olshop, $olshop);
$query_rs_orders_temp1 = "SELECT * FROM orders_temp, produk WHERE id_session = $sesi AND orders_temp.id_produk = produk.produk_id GROUP BY produk.produk_id";
$rs_orders_temp1 = mysql_query($query_rs_orders_temp1, $olshop) or die(mysql_error());
$row_rs_orders_temp1 = mysql_fetch_assoc($rs_orders_temp1);
$totalRows_rs_orders_temp1 = mysql_num_rows($rs_orders_temp1);

//menampilankan data order_temp yang kedua agar bisa diinput ke order_detail
mysql_select_db($database_olshop, $olshop);
$query_rs_orders_temp2 = "SELECT * FROM orders_temp, produk WHERE id_session = $sesi AND orders_temp.id_produk = produk.produk_id GROUP BY produk.produk_id";
$rs_orders_temp2 = mysql_query($query_rs_orders_temp2, $olshop) or die(mysql_error());
$row_rs_orders_temp2 = mysql_fetch_assoc($rs_orders_temp2);
$totalRows_rs_orders_temp2 = mysql_num_rows($rs_orders_temp2);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

//input dari keranjang belanja ke orders
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "detail")) {
  
  //input dari keranjang belanja ke tabel orders
  $insertSQL = sprintf("INSERT INTO orders (status_order, tgl_order, jam_order, id_kustomer) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['status_order'], "text"),
                       GetSQLValueString($_POST['tgl_order'], "date"),
                       GetSQLValueString($_POST['jam_order'], "date"),
                       GetSQLValueString($_POST['id_kustomer'], "int"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());
  
  //input dari keranjang belanja ke tabel details	
    			$id = 0;  
			$produk = 0; 
  			$jumlah = 0; 
			$produkx = 0;
			$jumlahx = 0;
			do {   
			$produkz = $_POST['id_produk'.$produkx++];				
			$jumlahy = $_POST['jumlah'.$jumlahx++];	  
			$details = sprintf("INSERT INTO orders_detail (id_orders, id_produk, jumlah) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['id_orders'.$id++], "int"),
                       GetSQLValueString($_POST['id_produk'.$produk++], "int"),
                       GetSQLValueString($_POST['jumlah'.$jumlah++], "int"));
  					   

					  mysql_select_db($database_olshop, $olshop);
					  $Result1 = mysql_query($details, $olshop) or die(mysql_error());
			
			$stok = "UPDATE produk SET stok = stok - '$jumlahy' WHERE produk_id='$produkz'";
                       
			  mysql_select_db($database_olshop, $olshop);
			  $hasilstok = mysql_query($stok, $olshop) or die(mysql_error());  
					  
  			//batas perulangan				  
			 } while ($row_rs_orders_temp2 = mysql_fetch_assoc($rs_orders_temp2));
  
  //hapus data temp berdasarkan id_kustomer
  $deleteSQL = "DELETE FROM orders_temp WHERE id_session=$row_rs_login[id_kustomer]";

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($deleteSQL, $olshop) or die(mysql_error());
  
  if ($deleteSQL) {
	  echo "<script type='text/javascript'>
			document.location= '?page=kwitansi&v=$_POST[x]';
			</script>";  
  }
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #FFFFFF}
.style3 {color: #000000}
-->
</style>
</head>

<body>
<div class="list-group">
      <a href="#" class="list-group-item active">
        <h3> Keranjang <strong>Belanja</strong></h3>
      </a>
<?php if ($totalRows_rs_isi_cart > 0) { ?>      
<table width="100%" height="296" class="table table-striped">
<thead>
  <tr>
    <th width="3%" height="37" bgcolor="#006699"><div align="center" class="style1">No.</div></th>
    <th width="10%" bgcolor="#006699"><div align="center" class="style2">Produk</div></th>
    <th width="20%" bgcolor="#006699"><div align="center" class="style2"><strong>Nama Produk</strong></div></th>
    <th width="11%" bgcolor="#006699"><div align="center" class="style2"><strong>Berat</strong></div></th>
    <th width="17%" bgcolor="#006699"><div align="center" class="style2"><strong>Harga</strong></div></th>
    <th width="10%" bgcolor="#006699"><div align="center" class="style2"><strong>Qty</strong></div></th>
    <th width="15%" bgcolor="#006699"><div align="center" class="style2"><strong>Sub Total</strong></div></th>
    <th width="14%" bgcolor="#006699"><div align="center" class="style2"><strong>Batalkan</strong></div></th>
  </tr>
  </thead>
  <?php 
		  	  $total = 0;	
			  $no = 1;
			  $berat = 0;		
	  		  $grand_total = 0;	
			  $subtotal = 0;
   do { ?>
    <tr valign="top">
      <td height="101"><?php echo $no++; ?></td>
      <td><img src="gambar/<?php echo $row_rs_isi_cart['gambar']; ?>" width="99" height="99" class="img-responsive"/></td>
      <td><?php echo $row_rs_isi_cart['nama_produk']; ?> <br />
		<small>( Disc. <?php echo $row_rs_isi_cart['diskon']; ?> %)</small></td>
      <td><div align="center"><?php echo $row_rs_isi_cart['berat']; ?> Kg</div></td>
      <td><div align="right">Rp. <?php 
							  $dis = ($row_rs_isi_cart['diskon'] / 100) *  $row_rs_isi_cart['harga'];
							  $hasil =  $row_rs_isi_cart['harga'] - $dis; 
							  echo $hasil; ?></div>
      </td>
      <td><form action="<?php echo $editFormAction; ?>" method="post" name="form3" id="form3"><select name="jumlah" onChange="this.form.submit()" value="<?php echo $row_rs_isi_cart['jumlah'];?>" class="form-control">
              <?php
              for ($j=1;$j <= $row_rs_isi_cart['stok_temp'];$j++){
                  if($j == $row_rs_isi_cart['jumlah']){
                   echo "<option selected>$j</option>";
                  }else{
                   echo "<option>$j</option>";
                  }
              }
			  ?>
   		 </select>

          <input type="hidden" name="id_orders_temp" value="<?php echo $row_rs_isi_cart['id_orders_temp']; ?>" />
          <input type="hidden" name="MM_update" value="form3" />
        </form> 
          
        </p></td>
      <td><div align="right">Rp. 
	  <?php 
	  	//menjumlahkan Harga dikalikan dengan Jumlah Produk
			echo $subtotal = $hasil * $row_rs_isi_cart['jumlah'];
 				 $grand_total = $grand_total + $subtotal;
	  			 $berat = $berat + $row_rs_isi_cart['berat'];
	   ?></div></td>
      <td> <div align="center"><a href="?page=hapus&id_orders_temp=<?php echo $row_rs_isi_cart['id_produk']; ?>">x</a></div></td>
    </tr>
    <?php } while ($row_rs_isi_cart = mysql_fetch_assoc($rs_isi_cart)); ?>
    
    <tr valign="top" bgcolor="#FF9933">
      <td height="28" bgcolor="#006699"><div align="right" class="style2"></div></td>
      <td height="28" bgcolor="#006699">&nbsp;</td>
      <td height="28" bgcolor="#006699">&nbsp;</td>
      <td height="28" bgcolor="#006699">&nbsp;</td>
      <td height="28" bgcolor="#006699">&nbsp;</td>
      <td height="28" colspan="2" bgcolor="#006699"><div align="left"><strong><span class="style2"> TOTAL</span></strong></div></td>
      <td bgcolor="#006699"><div align="left"><strong><span class="style2">Rp. <?php echo $grand_total;?></span></strong></div></td>
    </tr>
    <tr valign="top" bgcolor="#FF9933">
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" colspan="2" bgcolor="#BFEAEA"><div align="left" class="style3">TOTAL BERAT</div></td>
      <td bgcolor="#BFEAEA"><div align="left" class="style3"><?php echo $berat;?> Kg</div></td>
    </tr>
    <tr valign="top" bgcolor="#FF9933">
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" colspan="2" bgcolor="#BFEAEA"><span class="style3">ONGKOS KIRIM ( / Kg )</span><br />
		<small>Diperoleh dari kota Anda</small></td>
      <td bgcolor="#BFEAEA"><div align="left" class="style3">Rp. <?php echo $ongkir = $row_rs_kota['ongkos_kirim'];?></div></td>
    </tr>
    <tr valign="top" bgcolor="#FF9933">
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" bgcolor="#BFEAEA">&nbsp;</td>
      <td height="28" colspan="2" bgcolor="#BFEAEA">TOTAL ONGKOS KIRIM</td>
      <td bgcolor="#BFEAEA">Rp. <?php echo $tokir = $berat * $ongkir;?></td>
    </tr>
    <tr valign="top" bgcolor="#FF9933">
      <td height="28" bgcolor="#993300">&nbsp;</td>
      <td height="28" bgcolor="#993300">&nbsp;</td>
      <td height="28" bgcolor="#993300">&nbsp;</td>
      <td height="28" bgcolor="#993300">&nbsp;</td>
      <td height="28" bgcolor="#993300">&nbsp;</td>
      <td height="28" colspan="2" bgcolor="#993300"><span class="style1">GRAND TOTAL</span></td>
      <td bgcolor="#993300"><span class="style1">Rp. <?php echo $gt = $tokir + $grand_total;?></span></td>
    </tr>
</table>
<!-- form untuk menginputkan record ke tabel order_detail -->     
<form action="<?php echo $editFormAction; ?>" method="post" name="detail" id="detail">    
  <?php 
  //input data order_detail
  //untuk perulangan
		  $id = 0; 
		  $produk = 0; 
		  $jumlah = 0; 
		  
		  do {   
  ?>
  
      <input type="hidden" name="id_orders<?php echo $id++; ?>" value="<?php  echo $x = $totalRows_rs_orders1 + 1; ?>" size="5" />     
      <input type="hidden" name="id_produk<?php echo $produk++; ?>" value="<?php  echo $row_rs_orders_temp1['produk_id']; ?>" size="5" />
      <input type="hidden" name="jumlah<?php echo $jumlah++; ?>" value="<?php echo $row_rs_orders_temp1['jumlah']; ?>" size="5" /><br />

 <?php  } while ($row_rs_orders_temp1 = mysql_fetch_assoc($rs_orders_temp1)); 
$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

 ?>      
 
 <!-- input data orders-->
        <input type="hidden" name="status_order" value="Belum Lunas" size="32" />
        <input type="hidden" name="tgl_order" value="<?php echo $tgl_skrg; ?>" size="32" />
        <input type="hidden" name="jam_order" value="<?php echo $jam_skrg; 	?>" size="32" />
        <input type="hidden" name="x" value="<?php  echo $x = $totalRows_rs_orders1 + 1; ?>" size="5" /> 
        <input type="hidden" name="id_kustomer" value="<?php echo $row_rs_login['id_kustomer'] ?>" size="32" />
        <a href="?page=beranda" class="btn btn-success">Belanja Lagi</a>   
		<input type="submit" value="Selesai Belanja" class="btn btn-danger navbar-right " />
      <input type="hidden" name="MM_insert" value="detail" />
</form>

</div>
<?php } ?>
<?php if ($totalRows_rs_isi_cart == 0) { ?>
	<div class="alert alert-danger">Belum ada isi keranjang, <a href="?page=beranda">Ayo belanja!!</a></div>
<?php } ?>
