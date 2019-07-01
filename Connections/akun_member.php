<?php
//sesi dari hak akses member
$colname_rs_login = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs_login = $_SESSION['MM_Username'];
}
mysql_select_db($database_olshop, $olshop);
$query_rs_login = sprintf("SELECT * FROM kustomer WHERE email = %s", GetSQLValueString($colname_rs_login, "text"));
$rs_login = mysql_query($query_rs_login, $olshop) or die(mysql_error());
$row_rs_login = mysql_fetch_assoc($rs_login);
$totalRows_rs_login = mysql_num_rows($rs_login);

?>