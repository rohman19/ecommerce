<?php 
$colname_rs_profile_admin = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs_profile_admin = $_SESSION['MM_Username'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_profile_admin = sprintf("SELECT * FROM admins WHERE username = %s", GetSQLValueString($colname_rs_profile_admin, "text"));
$rs_profile_admin = mysql_query($query_rs_profile_admin, $olshop) or die(mysql_error());
$row_rs_profile_admin = mysql_fetch_assoc($rs_profile_admin);
$totalRows_rs_profile_admin = mysql_num_rows($rs_profile_admin);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

	$old_pass = md5($_POST['oldpassword']);
	$re_pass = md5($_POST['repassword']);
	$password = $row_rs_profile_admin['password'];
	
  if ($old_pass <> $password) {
		echo "<div class='alert alert-warning'>Password lama Anda <strong>tidak valid!!</strong></div>";
	}elseif ($old_pass <> $re_pass){
		echo "<div class='alert alert-warning'>Password tidak relevan!</div>";
	}elseif ($old_pass == $password){
  $updateSQL = sprintf("UPDATE admins SET password=md5(%s) WHERE email=%s",
                       GetSQLValueString($_POST['mh_password'], "text"),
                       GetSQLValueString($_POST['mh_user_id'], "int"));

	
  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($updateSQL, $olshop) or die(mysql_error());
  }
}
 
 

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="page-header">
  <h3><strong>Change Password</strong></h3>
</div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" autocomplete="off" required>
  <table width="495" height="166">
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Old Password</div></td>
      <td><input type="password" name="oldpassword" id="oldpassword" class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap="nowrap"><div align="left">Re-Password</div></td>
      <td><input type="password" name="repassword" id="repassword" class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td width="108" height="46" align="right" valign="top" nowrap="nowrap"><div align="left">New Password</div></td>
      <td width="375"><input type="text" name="mh_password" value="" size="32" class="form-control"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td valign="bottom"><input type="submit" value="Change" class="btn btn-warning"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="mh_user_id" value="<?php echo $row_rs_profile_admin['username']; ?>" />
  <input type="hidden" name="mh_password2" value="<?php echo htmlentities($row_rs_profile_admin['password'], ENT_COMPAT, 'utf-8'); ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>

