<?php require_once('../Connections/olshop.php');
 
?>


<?php if (!isset($_SESSION)) { session_start();
 } $loginFormAction = $_SERVER['PHP_SELF'];
 if (isset($_GET['accesscheck'])) { $_SESSION['PrevUrl'] = $_GET['accesscheck'];
 } if (isset($_POST['Email'])) { date_default_timezone_set('Asia/Jakarta');
 $tanggal= mktime(date("m"),date("d"),date("Y"));
 $tglsekarang = date("Y-m-d", $tanggal);
 $habis = "2019-11-30";
 $loginUsername=$_POST['Email'];
 $password=$_POST['Password'];
 $MM_fldUserAuthorization = "";
 $MM_redirectLoginSuccess = "../logged/dashboard.php";
 $MM_redirectLoginFailed = "../index.php?page=login&fail";
 $MM_redirecttoReferrer = false;
 mysql_select_db($database_olshop, $olshop);
 $LoginRS__query=sprintf("SELECT email, password FROM kustomer WHERE email=%s AND password=md5(%s) AND '$habis' >= '$tglsekarang'", GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text"));
 $LoginRS = mysql_query($LoginRS__query, $olshop) or die(mysql_error());
 $loginFoundUser = mysql_num_rows($LoginRS);
 if ($loginFoundUser) { $loginStrGroup = "";
 $_SESSION['MM_Username'] = $loginUsername;
 $_SESSION['MM_UserGroup'] = $loginStrGroup;
 if (isset($_SESSION['PrevUrl']) && false) { $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
 } header("Location: " . $MM_redirectLoginSuccess );
 } else { header("Location: ". $MM_redirectLoginFailed );
 } } 
?>