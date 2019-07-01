<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

	<script src="../assets/js/jquery-1.10.1.min.js" type="text/javascript"></script>
 	<script src="../assets/js/highcharts.js" type="text/javascript"></script>
    
    <script>
		var chart1; 
		$(document).ready(function() {
			  chart1 = new Highcharts.Chart({
				 chart: {
					renderTo: 'mygraph',
					type: 'column'
				 },   
				 title: {
					text: 'Grafik Daftar Produk per Kategori'
				 },
				 xAxis: {
					categories: ['Kode Kategori']
				 },
				 yAxis: {
					title: {
					   text: 'Jumlah Produk'
					}
				 },
				 	
				 series:             
						   

					 
					[	   
					 <?php 
									mysql_select_db($database_olshop, $olshop);
									$query_rs_kategori = "select nama_kategori, kategori.id_kategori, 
									  count(produk.produk_id) as jml 
									  from kategori left join produk 
									  on produk.id_kategori=kategori.id_kategori 
									  group by nama_kategori";
									$rs_kategori = mysql_query($query_rs_kategori, $olshop) or die(mysql_error());
									$row_rs_kategori = mysql_fetch_assoc($rs_kategori);
									$totalRows_rs_kategori = mysql_num_rows($rs_kategori);
					 do { 
					 
					 $nama = $row_rs_kategori['nama_kategori'];
					 $nama2 = $row_rs_kategori['jml'];
					 ?>
					 
							{
							  name: '<?php echo $nama; ?>',
							  data: [<?php echo $nama2; ?>]
							},
				    <?php } while ($row_rs_kategori = mysql_fetch_assoc($rs_kategori)); ?>	
					]
			  });
		   });	
	</script>
<body>
<div class="list-group">
                  <a href="#" class="list-group-item active">
                    <h4>Selamat Datang<strong> <?php echo $row_rs_profile_admin['nama_lengkap']; ?></strong></h4>
                  </a>
        <a href="#" class="list-group-item">          
		
          <div id ="mygraph"></div>
        
        </a>
</div>        
</body>
</html>
