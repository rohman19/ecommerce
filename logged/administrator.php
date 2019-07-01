<?php require_once('../Connections/olshop.php'); ?>
<?php
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

$MM_restrictGoTo = "../index.php";
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
$colname_rs_profile_admin = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs_profile_admin = $_SESSION['MM_Username'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_profile_admin = sprintf("SELECT * FROM admins WHERE username = %s", GetSQLValueString($colname_rs_profile_admin, "text"));
$rs_profile_admin = mysql_query($query_rs_profile_admin, $olshop) or die(mysql_error());
$row_rs_profile_admin = mysql_fetch_assoc($rs_profile_admin);
$totalRows_rs_profile_admin = mysql_num_rows($rs_profile_admin);


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
    <title>GLJ | Halaman Administrator</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/css/shop-homepage.css" rel="stylesheet">
    <link href="../assets/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/dist/sweetalert.css">
	<script type="text/javascript" src="../assets/dist/sweetalert.min.js"></script>

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

    <?php require_once('navbar_admin.php'); ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('menu/admin.php'); ?>
       	  </div>

			<div class="col-md-9">
            
              <div class="animated fadeIn">
						<?php
                           require_once('../Connections/olshop.php');
                           if(isset($_GET["page"]) && $_GET["page"] != "home"){
                                if(file_exists(htmlentities($_GET["page"]).".php")){
                                    require_once(htmlentities($_GET["page"]).".php");
                                    }else{
                                    require_once("404.php");
                                    }
                               }else{
                              require_once("home.php");
                              }
                           ?>
             </div>
			</div>
		</div>
    </div>
    <!-- /.container -->

    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                     <p>Copyright &copy; CV <strong>Gemilang Lestari Jaya</strong> Website 2019</p>
                </div>
          </div>
        </footer>

    </div>
    <!-- /.container -->

<?php 
if (isset($insertSQL)) {
echo "<script>
swal('Berhasil!', 'Data berhasil disimpan!', 'success');
</script>";									
}
										
if (isset($updateSQL)) {
echo "<script>
swal('Berhasil!', 'Data berhasil diubah!', 'success');
	</script>";								
}
									
if (isset($deleteSQL)) {
echo "<script>
swal('Berhasil!', 'Data berhasil dihapus!', 'warning');
</script>";								
}
?>
    <!-- jQuery -->
    <script src="../assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>
    
     <script src="../assets/table/js/jquery-1.11.0.js"></script>
        
        <script src="../assets/table/datatables/jquery.dataTables.js"></script>
        <script src="../assets/table/datatables/dataTables.bootstrap.js"></script>
         <script type="text/javascript">
            $(function() {
                $("#data").dataTable();
            });
        </script>

</body>

</html>
