<?php require_once('Connections/olshop.php'); 

$maxRows_rs_product = 3;
$pageNum_rs_product = 0;
if (isset($_GET['pageNum_rs_product'])) {
  $pageNum_rs_product = $_GET['pageNum_rs_product'];
}
$startRow_rs_product = $pageNum_rs_product * $maxRows_rs_product;

mysql_select_db($database_olshop, $olshop);
if (isset($_POST['button'])) {
	$cari = $_POST['nama_produk'];
	$query_rs_product = "SELECT *, LEFT(produk.deskripsi, 250) as desk FROM produk WHERE produk.nama_produk LIKE '%".$cari."%'";
	$query_limit_rs_product = sprintf("%s LIMIT %d, %d", $query_rs_product, $startRow_rs_product, $maxRows_rs_product);
	$rs_product = mysql_query($query_limit_rs_product, $olshop) or die(mysql_error());
	$row_rs_product = mysql_fetch_assoc($rs_product);
}else{
	$query_rs_product = "SELECT *, LEFT(produk.deskripsi, 250) as desk FROM produk ORDER BY RAND()";
	$query_limit_rs_product = sprintf("%s LIMIT %d, %d", $query_rs_product, $startRow_rs_product, $maxRows_rs_product);
	$rs_product = mysql_query($query_limit_rs_product, $olshop) or die(mysql_error());
	$row_rs_product = mysql_fetch_assoc($rs_product);

}
if (isset($_GET['totalRows_rs_product'])) {
  $totalRows_rs_product = $_GET['totalRows_rs_product'];
} else {
  $all_rs_product = mysql_query($query_rs_product);
  $totalRows_rs_product = mysql_num_rows($all_rs_product);
}
$totalPages_rs_product = ceil($totalRows_rs_product/$maxRows_rs_product)-1;

//all produk
$currentPage = $_SERVER["PHP_SELF"];
$maxRows_rs_productx = 10;
$pageNum_rs_productx = 0;
if (isset($_GET['pageNum_rs_productx'])) {
  $pageNum_rs_productx = $_GET['pageNum_rs_productx'];
}
$startRow_rs_productx = $pageNum_rs_productx * $maxRows_rs_productx;

mysql_select_db($database_olshop, $olshop);
$query_rs_productx = "SELECT *, LEFT(produk.nama_produk, 25) as nama, LEFT(produk.deskripsi, 60) as desk FROM produk ORDER BY produk.nama_produk DESC";
$query_limit_rs_productx = sprintf("%s LIMIT %d, %d", $query_rs_productx, $startRow_rs_productx, $maxRows_rs_productx);
$rs_productx = mysql_query($query_limit_rs_productx, $olshop) or die(mysql_error());
$row_rs_productx = mysql_fetch_assoc($rs_productx);

if (isset($_GET['totalRows_rs_productx'])) {
  $totalRows_rs_productx = $_GET['totalRows_rs_productx'];
} else {
  $all_rs_productx = mysql_query($query_rs_productx);
  $totalRows_rs_productx = mysql_num_rows($all_rs_productx);
}
$totalPages_rs_productx = ceil($totalRows_rs_productx/$maxRows_rs_productx)-1;

//navigasi product x
if (isset($_GET['totalRows_rs_productx'])) {
  $totalRows_rs_productx = $_GET['totalRows_rs_productx'];
} else {
  $all_rs_productx = mysql_query($query_rs_productx);
  $totalRows_rs_productx = mysql_num_rows($all_rs_productx);
}
$totalPages_rs_productx = ceil($totalRows_rs_productx/$maxRows_rs_productx)-1;

$queryString_rs_productx = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_productx") == false && 
        stristr($param, "totalRows_rs_productx") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_productx = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_productx = sprintf("&totalRows_rs_productx=%d%s", $totalRows_rs_productx, $queryString_rs_productx);

//menampilkan data per kategori
$colname_rs_detail_kategori = "-1";
if (isset($_GET['id'])) {
  $colname_rs_detail_kategori = $_GET['id'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_detail_kategori = sprintf("SELECT *, LEFT(deskripsi, 70) as desk, LEFT(nama_produk, 20) as nama FROM produk WHERE id_kategori = %s", GetSQLValueString($colname_rs_detail_kategori, "int"));
$rs_detail_kategori = mysql_query($query_rs_detail_kategori, $olshop) or die(mysql_error());
$row_rs_detail_kategori = mysql_fetch_assoc($rs_detail_kategori);
$totalRows_rs_detail_kategori = mysql_num_rows($rs_detail_kategori);

//menampilkan judul kategori
$colname_rs_kategori_judul = "-1";
if (isset($_GET['id'])) {
  $colname_rs_kategori_judul = $_GET['id'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_kategori_judul = sprintf("SELECT * FROM kategori WHERE id_kategori = %s", GetSQLValueString($colname_rs_kategori_judul, "int"));
$rs_kategori_judul = mysql_query($query_rs_kategori_judul, $olshop) or die(mysql_error());
$row_rs_kategori_judul = mysql_fetch_assoc($rs_kategori_judul);
$totalRows_rs_kategori_judul = mysql_num_rows($rs_kategori_judul);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GLJ | Halaman Pengunjung</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/style_f.css" rel="stylesheet">
<link rel="shortcut icon" href="logged/gambar/glj.png" />
    <!-- Custom CSS -->
<link href="template/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style_a.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/3.css" />
    <link href="assets/css/shop-homepage.css" rel="stylesheet">
     <link href="assets/css/login.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/dist/sweetalert.css">
	<script type="text/javascript" src="assets/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/1.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="assets/js/jquery-2.0.2.min.js"></script>
	<script type="text/javascript">
        $('document').ready(function(){	
            $('email').after('<span class="status"></span>').css('margin-right','10px');
            $('email').keyup(function(){
                $(this).css({'border':'1px solid #ccc','background':'none'});
            });
            $('email').change(function(e){
                var email = $(this).val();
                if(email.length != 0){
                    $('.status').html('<img src="assets/js/loading.gif"><b> Chek ketersediaan ...</b>');
                    $.ajax({
                        type: "POST",
                        url: "register_aksi.php",
                        data: "email="+email,
                        success: function(data){
                            if(data == 0){
                                $('.status').html('<img src="assets/js/true.png"><b style="color:green;"> Email dapat diterima</b>');
                            }else{					
                                $('.status').html('<img src="assets/js/false.png"><b style="color:red;"> Email sudah digunakan</b>');
                                $('email').css({'border':'3px solid #f00','background':'yellow'});
                            }
                        }
                    });
                }else{
                    $('.status').html('');
                }
            });
        });
    </script>
</head>

<body>
<p></p>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
             <div class="navbar-header">
               <a class="navbar-brand" href="">
                
              </a>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                </button>
             <a class="navbar-brand" href="index.php"><center><img class="b" src="logged/gambar/glj.png"></center> CV GEMILANG LESTARI JAYA</a>
            </div>
            <p></p>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   <li class="green"><a  href="index.php" class="fa fa-home"> Beranda</a></li>
                    <li class="springgreen"><a href="?page=modul&v=1" class="fa fa-bookmark"> Tentang Kami</a></li>
                    <li class="yellow"><a href="?page=modul&v=2" class="fa fa-bar-chart-o"> Visi-Misi</a></li>
                    <li class="red"><a href="?page=modul&v=4" class="fa fa-question-circle"> Cara Pembelian</a></li>
      				<li class="orange"><a href="?page=modul&v=3" class="fa fa-phone-square"> Hubungi Kami</a></li>
                    <li class="grey"><a href="#" data-toggle="modal" data-target="#Register"><span class="glyphicon glyphicon-share"></span> &nbsp;&nbsp;Daftar</a></li>
      			</ul>	 
                     
                     <ul class="nav navbar-nav navbar-right">  
                       
                  <li class="blue"><a href="index.php" ><span class="glyphicon glyphicon-th-large"></span> All Products</a></li>
                  <li class="dropdown">
                    <li class="red">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" > Login <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="?page=login">Login Member</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="?page=log_in">Login Administrator </a></li>
                      </ul>
                    </li>
                  </li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <p>
    <div class="container">
    </p>

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Recent <strong>Product</strong></p>
                <form action="" method="post" >
                    <div class="input-group">
                      <input type="text" class="form-control" name="nama_produk" placeholder="Cari Produk ...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" name="button" type="submit">Go!</button>
                      </span>
                    </div><!-- /input-group -->
                </form>
                <hr />
               		<?php if ($totalRows_rs_product > 0) {?>
					<?php do { ?>
                      <div class="thumbnail well">
                        <img src="logged/gambar/<?php echo $row_rs_product['gambar']; ?>" alt="Image" class="img-thumbnails">
                        <div class="caption">
                          <h5><strong><?php echo $row_rs_product['nama_produk']; ?></strong></h5>
                          <p><small><?php echo nl2br($row_rs_product['desk']); ?></small> </p>
                        </div>
                        <hr>
                        <p>
                        <center><a href="?page=login" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Beli</a> <a href="?page=details&produk_id=<?php echo $row_rs_product['produk_id']; ?>" class="btn btn-default" role="button">Details</a></span>
                        </center>
                        </p>
                    </div>
                    <?php } while ($row_rs_product = mysql_fetch_assoc($rs_product)); ?>
                    <?php } ?>
                    <?php if ($totalRows_rs_product == 0) {?>
                    	<div class="alert alert-danger"><strong>Oops!! </strong>Barang tidak ada!</div>
                    <?php } ?>
                </div>
            <div class="col-md-9">
            	<div class="animated fadeIn">
                <p></p>
                <?php
				  //require_once('Connections/olshop_koneksi.php');
				  // *** Validate request to login to this site.
				   if(isset($_GET["page"]) && $_GET["page"] != "home"){
						if(file_exists(htmlentities($_GET["page"]).".php")){
							include(htmlentities($_GET["page"]).".php");
							}else{
							include("404.php");
							}
					   }else{
					  include("home.php");
					  }
				   ?>
                   
            	</div>
            </div>
</div><!-- /.container -->
 <!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "089602484584", // WhatsApp number
            email: "Rohman0105@bsi.ac.id", // Email
            call_to_action: "Message us", // Call to action
            button_color: "#FF6550", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "email,whatsapp", // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->
 
    </div><!--botnav-->
<div class="clr"></div>
    
    <div class="botnav clr">
        <div class="main">
        
            <div class="boxBottom first">
             
                  <h3>Hubungi Kami</h3>
                <hr></hr>
                <div class="inner" style="line-height:1.8";>
                <div style="font-size:18px;">CV GEMILANG LESTARI JAYA</div>
                    <p>
                <ul class="latest">
                     <p>
                    JL. Ciater Raya, Vila Dago Tol, D2/46, RT.002/019, Serua, Ciputat <br />
                    Tangerang Selatan, Banten</p>
                    <table width="200" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>Telp</td>
                        <td>:</td>
                        <td>+62217479503</td>
                      </tr>
                      <tr>
                        <td>Fax</td>
                        <td>:</td>
                        <td>+622174633811</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                       
                      </tr>
                    </table>
                            <li class="clr">
                                <span class="pic">
                                 
                                <div class="right">
                                  
                                </div> 
                                <div class="clr"></div>
                                
                            </li>
                            
                   
                    </ul>
                  </div>
                </div>
          </div>
            <div class="boxBottom second">
                <h3>BUKA</h3>
                <hr></hr>
                <div class="inner" style="line-height:1.8";>
                <div style="font-size:auto;">Senin - Jumat : 08.00 - 16.00</div>
                <div style="font-size:auto;">Sabtu - Minggu : LIBUR</div>
                  
                <ul class="latest">
                    
                   
                            <li class="clr">
                                <span class="pic">
                                 
                                <div class="right">
                                  
                                </div> 
                                <div class="clr"></div>
                            </li>
                            
                   
                    </ul>
                </div>
          </div>
            
            <div class="boxBottom last">
                <h3>Lokasi</h3>
                <hr></hr>
                <div class="inner" style="line-height:1.8;">
                    <div>Lokasi :</div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.623484559195!2d106.69014971431125!3d-6.313092063536059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e5465ffd1aaf%3A0xc6ec5913cec7aebe!2sJl.+Ciater+Raya%2C+Kota+Tangerang+Selatan%2C+Banten!5e0!3m2!1sid!2sid!4v1543674707515" width="auto" height="auto" frameborder="1" style="border:0" allowfullscreen></iframe>
                 

              </div>
            </div>
            <div class="clr"></div>
            
        
    <div class="footer clr">
            
        
     <div id="share-sossial-buttons">
    <center>Bagikan</center>
    <!-- Untuk Facebook -->
    <a href="http://www.facebook.com/sharer.php?u=https://cvglj.com" target="_blank">
        <img src="assets/images/6.png" alt="Facebook" width="50" height="50" />
    </a>
    
    <!-- Untuk Google+ -->
    <a href="https://plus.google.com/share?url=https://cvglj.com" target="_blank">
         <img src="assets/images/4.png" alt="google" width="50" height="50" />
    </a>
    
    <!-- Untuk Twitter -->
    <a  href="https://twitter.com/share?url=https://cvglj.com&text=Simple%20Share%20Buttons&hashtags=simplesharebuttons" target="_blank">
        <img src="assets/images/7.png" alt="Twitter" width="50" height="50" />
    </a>
    <div class="main">

</div>
          </div>
         
          <div class="footer clr">
            <center>Bank Transfer</center>
            <img src="logged/gambar/bank/bni.png" width="100">
            <img src="logged/gambar/bank/bri.png" width="100">
            <img src="logged/gambar/bank/mandiri.png" width="100">
        <div class="main">
        </div>
      </div>
          
   <div class="footer clr">
            <p>Copyright &copy; CV <strong>Gemilang Lestari Jaya</strong> Website 2019</p>
        <div class="main">
          </div>
        </footer>

    </div>
  </div>
  
        <!-- Modal Register-->
        <div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
              </div>
              <div class="modal-body">
                 <?php require_once('register.php'); ?> 
              </div>
           </div>
        </div>
        </div>
        <!-- tag penutup modal register -->
<?php 
if (isset($insertSQL)) {
echo "<script>
swal('Selamat!', 'Anda berhasil Register!', 'success');
</script>";									
}
?>
    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>
