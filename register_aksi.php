<?php
mysql_connect("localhost","root","");
mysql_select_db("olshop");

$sql = mysql_query("select * from kustomer where email='$_POST[email]'");
$jml = mysql_num_rows($sql);
echo $jml;

?>