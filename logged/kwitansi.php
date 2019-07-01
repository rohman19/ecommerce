<?php 
mysql_select_db($database_olshop, $olshop);
$query_rs_kustomer = "SELECT * FROM kustomer, kota WHERE id_kustomer = $row_rs_login[id_kustomer] AND kustomer.id_kota = kota.id_kota";
$rs_kustomer = mysql_query($query_rs_kustomer, $olshop) or die(mysql_error());
$row_rs_kustomer = mysql_fetch_assoc($rs_kustomer);
$totalRows_rs_kustomer = mysql_num_rows($rs_kustomer);

mysql_select_db($database_olshop, $olshop);
$query_rs_detail = "SELECT * FROM orders_detail, orders, produk WHERE orders_detail.id_orders = orders.id_orders AND orders_detail.id_produk = produk.produk_id AND id_kustomer= $row_rs_login[id_kustomer] AND orders.id_orders = $_GET[v]";
$rs_detail = mysql_query($query_rs_detail, $olshop) or die(mysql_error());
$row_rs_detail = mysql_fetch_assoc($rs_detail);
$totalRows_rs_detail = mysql_num_rows($rs_detail);	
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>

				<div class="list-group">
                      <a href="#" class="list-group-item active">
                        <h3> Proses <strong>Transaksi Selesai</strong></h3>
                      </a>
      <div class="panel panel-default">
      		<div class="panel-heading">Data pemesan beserta ordernya adalah sebagai berikut: <span class="badge"> No. Order : <?php echo $o = $row_rs_detail['id_orders']; ?></span></div>
	            <div class="panel-body">
                      <table width="467" height="97" class="table table-striped">
                        <tbody>
                          <tr>
                            <td width="114">Nama Lengkap</td>
                            <td width="341">: <strong><?php echo $row_rs_kustomer['nama_lengkap']; ?></strong></td>
                          </tr>
                          <tr>
                            <td>Alamat Lengkap</td>
                            <td>: <?php echo $row_rs_kustomer['alamat']; ?></td>
                          </tr>
                          <tr>
                            <td>Nomor Rekening</td>
                            <td>: <?php echo $row_rs_kustomer['telpon']; ?></td>
                          </tr>
                          <tr>
                            <td>E-mail</td>
                            <td>: <?php echo $row_rs_kustomer['email']; ?></td>
                          </tr>
                        </tbody>
                      </table>
                </div>
</div>
				  <a href="print/kwitansi.php?v=<?php echo $row_rs_detail['id_orders']?>&x=<?php echo $row_rs_login['id_kustomer']?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-print"></span> Print</a>
                  <table class="table">
                      <tr bgcolor="#6da6b1">
                        <th><span class="style1">NO</span></th>
                        <th><span class="style1">NAMA PRODUK</span></th>
                        <th><span class="style1">BERAT(KG)</span></th>
                        <th><span class="style1">QTY</span></th>
                        <th><span class="style1">HARGA SATUAN</span></th>
                        <th><span class="style1">SUB TOTAL</span></th>
                      </tr>
                      <?php
                      $total = 0;
                      $no = 1;
                      $berat = 0;		
                      $grand_total = 0;	
                      $subtotal = 0;
                       do { ?>
                      <tr bgcolor="#dad0d0">
                        <td bgcolor="#CCCCCC"><?php echo $no++; ?></td>
                        <td bgcolor="#CCCCCC"><?php echo $row_rs_detail['nama_produk']; ?></td>
                        <td align="center" bgcolor="#CCCCCC"><?php echo $row_rs_detail['berat']; ?></td>
                        <td align="center" bgcolor="#CCCCCC"><?php echo $row_rs_detail['jumlah']; ?></td>
                        <td align="right" bgcolor="#CCCCCC">Rp. <?php 
							  $dis = ($row_rs_detail['diskon'] / 100) *  $row_rs_detail['harga'];
							  $hasil =  $row_rs_detail['harga'] - $dis; 
							  echo $hasil; ?></td>
                        <td align="right" bgcolor="#CCCCCC"><?php 
                            //menjumlahkan Harga dikalikan dengan Jumlah Produk
                            $subtotal = $hasil * $row_rs_detail['jumlah']; echo $subtotal;
                            $grand_total = $grand_total + $subtotal;
                            $berat = $berat + $row_rs_detail['berat'];					
                          ?></td>
                      </tr>
                      <?php } while ($row_rs_detail = mysql_fetch_assoc($rs_detail)); ?><hr />
                      <tr>
                        <td colspan="5" align="right">Total : Rp.</td>
                        <td align="right"><strong><?php echo $grand_total;?></strong></td>
                      </tr>
                      <tr>
                        <td colspan="5" align="right">Ongkos Kirim untuk Tujuan Kota Anda: Rp.</td>
                        <td align="right"><?php echo $ongkos = $row_rs_kustomer['ongkos_kirim']; ?>/Kg</td>
                    </tr>
                      <tr>
                        <td colspan="5" align="right">Total Berat :</td>
                        <td align="right"><strong><?php echo $berat; ?>/Kg</strong></td>
                      </tr>
                      <tr>
                        <td colspan="5" align="right">Total Ongkos Kirim :  </td>
                        <td align="right"><strong>Rp.<?php echo $tokir = $berat * $ongkos ?></strong></td>
                      </tr>
                      <tr>
                        <td colspan="5" align="right">Grand Total : Rp.</td>
                        <td align="right"><?php echo $gt = $tokir + $grand_total;?></td>
                      </tr>
                </table>

        <div class="col-md-6">
         <div class="page-header">
         	<h3>Cara Pembayaran</h3>
         </div>
         <p class="alert alert-warning">
              Silahkan Melakukan Pembayaran Pada Rekening dibawah ini, <br />
              Anda dapat melakukan Konfirmasi Pembayaran Melalui SMS Ke NO : <strong>089602484584</strong> <br />
              Dengan Format : <strong>#No Orders #Nominal Transfer # Bank Tujuan # Bank Pengirim</strong> <br />
              Contoh : <strong>#<?php echo $o; ?> #<?php echo $gt = $tokir + $grand_total;?> #Mandiri #Tangerang Selatan</strong>
              <br />---------------------------------------------------------------------------
              <br />Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka transaksi dianggap batal.
		 </p>
</div>
        <div class="col-md-6">
         <div class="page-header">
         	<h3>Layanan Bank</h3>
         </div>        
            <p>Pembayaran dilakukan Melalui Rekening Toko Kami di bawah ini :</p>
            <div class="row">
            	<div class="col-md-4"><img src="gambar/bank/bni.png" class="img-responsive" /><br /><strong>BNI <br />1909-8099-00-11</strong><br />A/n   : Rohman</div>
                <div class="col-md-4"><img src="gambar/bank/bri.png" class="img-responsive" /><br /><strong>BRI <br />503-0292-22</strong><br />A/n   : Rohman</div>
                <div class="col-md-4"><img src="gambar/bank/mandiri.png" class="img-responsive" /><br /><strong>Mandiri <br />155000-002-9394-06</strong><br />A/n   : Rohmad Safi'i</div>
            </div>
            
</div>
    </div>
