<?php require_once('../Connections/olshop.php'); ?><?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php?page=login";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

require_once('../Connections/akun_member.php');

//data list produk (Produk Terbaru)
$maxRows_rs_list_produk = 6;
$pageNum_rs_list_produk = 0;
if (isset($_GET['pageNum_rs_list_produk'])) {
  $pageNum_rs_list_produk = $_GET['pageNum_rs_list_produk'];
}
$startRow_rs_list_produk = $pageNum_rs_list_produk * $maxRows_rs_list_produk;

mysql_select_db($database_olshop, $olshop);
$query_rs_list_produk = "SELECT * FROM produk";
$query_limit_rs_list_produk = sprintf("%s LIMIT %d, %d", $query_rs_list_produk, $startRow_rs_list_produk, $maxRows_rs_list_produk);
$rs_list_produk = mysql_query($query_limit_rs_list_produk, $olshop) or die(mysql_error());
$row_rs_list_produk = mysql_fetch_assoc($rs_list_produk);

if (isset($_GET['totalRows_rs_list_produk'])) {
  $totalRows_rs_list_produk = $_GET['totalRows_rs_list_produk'];
} else {
  $all_rs_list_produk = mysql_query($query_rs_list_produk);
  $totalRows_rs_list_produk = mysql_num_rows($all_rs_list_produk);
}
$totalPages_rs_list_produk = ceil($totalRows_rs_list_produk/$maxRows_rs_list_produk)-1;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<link rel="shortcut icon" href="gambar/glj.png" />
    <title>GLJ | Halaman Member</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/style_f.css" rel="stylesheet">
<link href="https://localhost/cvgemilang/template/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link href="../assets/css/shop-homepage.css" rel="stylesheet">
    <link href="../assets/css/animate.css" rel="stylesheet">
    <link href="../assets/css/1.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/style_a.css" />
    <link href="../template/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../assets/dist/sweetalert.css">
	<script type="text/javascript" src="../assets/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/1.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="../assets/tinymce/tinymce.min.js"></script>
	<script>
      tinymce.init({
        selector: '#mytextarea'
      });
      </script>
      
</head>

<body>

    <!-- Navigation -->
    <?php require_once('navbar_customer.php'); ?>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
  		<div class="col-md-3">
        <div class="animated fadeIn">
               <div class="list-group">
                <p>
                      <a href="#" class="list-group-item active">
                      </p>
                        <h3 class=" fa fa-folder"><strong> Produk Terbaru</strong></h3>
                      </a>
                
				<?php do { ?>
	                   <a href="?page=details&produk_id=<?php echo $row_rs_list_produk['produk_id']; ?>" class="list-group-item text-uppercase"><?php echo $row_rs_list_produk['nama_produk']; ?></a>
                <?php } while ($row_rs_list_produk = mysql_fetch_assoc($rs_list_produk)); ?>            
	  </div>                
                
                <div class="list-group">
                      <a href="#" class="list-group-item active">
                        <h3 class="fa fa-folder"> Kategori <strong>Produk</strong></h3>
                      </a>

                <?php
			              $kategori=mysql_query("select nama_kategori, kategori.id_kategori, 
                                  count(produk.produk_id) as jml 
                                  from kategori left join produk 
                                  on produk.id_kategori=kategori.id_kategori 
                                  group by nama_kategori");
							$no=1;

							while($k=mysql_fetch_array($kategori)){
								echo "<a href='?page=kategori&id=$k[id_kategori]' class='list-group-item'> $k[nama_kategori] <span class='badge'> $k[jml] </span></a>";
							  $no++;
							}
							?>
            
              <div class="list-group">
                      <a href="#" class="list-group-item active">
                        <h3 class="fa fa-users"> Layanan <strong>Pelanggan</strong></h3>
                      </a>
                       <p class="list-group-item">
                                Rohman<br />
                                 <a href="https://wa.me/6289602484584?text=Nama%3A%0ANo.%20HP%3A%0AAlamat%3A%0APesanan%3A%0AJumlah%3A" target="_blank"><img src="gambar/9.png" alt="WhatsApp" width="20" /></a><a> 089602484584
                                </a>
                            </p>
                            <p class="list-group-item">
                                                    Rohmad Safi'i<br />
                                <a href="https://wa.me/6281282060615?text=Nama%3A%0ANo.%20HP%3A%0AAlamat%3A%0APesanan%3A%0AJumlah%3A" target="_blank"><img src="gambar/9.png" alt="WhatsApp" width="20" /></a><a> 081282060615
                                </a>
                            </p>
            </div>
	  </div>
      </div>
          	</div>

			<div class="col-md-9">
            <div class="animated fadeIn">
			  <?php
				   require_once('../Connections/olshop.php');
				   if(isset($_GET["page"]) && $_GET["page"] != "beranda"){
						if(file_exists(htmlentities($_GET["page"]).".php")){
							require_once(htmlentities($_GET["page"]).".php");
							}else{
							require_once("404.php");
							}
					   }else{
					  require_once("beranda.php");
					  }
				   ?>
             </div>      
			</div>
	  </div>
    </div>
<!-- /.container -->

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
                    </table>

              </div>
            </div>
            <div class="clr"></div>
            
        
    <div class="footer clr">
            
        
     <div id="share-sossial-buttons">
    <center>Bagikan</center>
    <!-- Untuk Facebook -->
    <a href="http://www.facebook.com/sharer.php?u=https://cvglj.com" target="_blank">
        <img src="../assets/images/6.png" alt="Facebook" width="50" />
    </a>
    
    <!-- Untuk Google+ -->
    <a href="https://plus.google.com/share?url=https://cvglj.com" target="_blank">
         <img src="../assets/images/4.png" alt="google" width="50" />
    </a>
    
    <!-- Untuk Twitter -->
    <a href="https://twitter.com/share?url=https://cvglj.com&text=Simple%20Share%20Buttons&hashtags=simplesharebuttons" target="_blank">
        <img src="../assets/images/7.png" alt="Twitter" width="50" />
    </a>
    <div class="main">

</div>
          </div>
         
          <div class="footer clr">
            <center>Bank Transfer</center>
            <img src="../logged/gambar/bank/bni.png" width="100">
            <img src="../logged/gambar/bank/bri.png" width="100">
            <img src="../logged/gambar/bank/mandiri.png" width="100">
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

    </div>

    <!-- jQuery -->
    <script src="../assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>

</body>

</html>
