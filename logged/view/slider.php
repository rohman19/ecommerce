<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO slider (slider_link_image, slider_caption, slider_desc) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['slider_link_image'], "text"),
                       GetSQLValueString($_POST['slider_caption'], "text"),
                       GetSQLValueString($_POST['slider_desc'], "text"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());
}

mysql_select_db($database_olshop, $olshop);
$query_rs_sliderx = "SELECT * FROM slider";
$rs_sliderx = mysql_query($query_rs_sliderx, $olshop) or die(mysql_error());
$row_rs_sliderx = mysql_fetch_assoc($rs_sliderx);
$totalRows_rs_sliderx = mysql_num_rows($rs_sliderx);
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<div class="list-group-item active">
		<h3>Halaman <strong>Slider</strong></h3>
</div>
<p></p>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Daftar Slider</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Add Slider</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">   
     <p></p>

    	<table width="100%" class="table table-striped"  id="data">
            <thead>
              <tr valign="middle">
                 <th width="5%" bgcolor="#6633FF"><div align="center"><span class="style1">NO.</span></div></th>
                <th width="36%" bgcolor="#6633FF"><div align="center"><span class="style1">IMAGE</span></div></th>
                <th width="27%" bgcolor="#6633FF"><div align="center"><span class="style1">CAPTION</span></div></th>
                <th width="23%" bgcolor="#6633FF"><div align="center"><span class="style1">DESK</span></div></th>
                <th width="9%" bgcolor="#6633FF"><div align="center"><span class="style1">ACTION</span></div></th>
              </tr>
          </thead>
              <tbody>
             <?php $no = 1; do { ?>
                <tr>
                  <td><div align="center"><?php echo $no++; ?></div></td>
                  <td><?php echo $row_rs_sliderx['slider_link_image']; ?></td>
                  <td><?php echo $row_rs_sliderx['slider_caption']; ?></td>
                  <td><?php echo $row_rs_sliderx['slider_desc']; ?></td>
                  <td><div align="center">
                    <div align="center"><a href="?page=delete&slider_id=<?php echo $row_rs_sliderx['slider_id']; ?>"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;<a href="?page=update/slider&v=<?php echo $row_rs_sliderx['slider_id']; ?>"><span class="glyphicon glyphicon-edit"></span></a></div>
                  </div></td>
                </tr>
                <?php } while ($row_rs_sliderx = mysql_fetch_assoc($rs_sliderx)); ?>
              </tbody>
      </table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
    	<br />
            <div class="well">
    	      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
                  <table width="100%" height="270">
                    <tr valign="baseline">
                      <td width="12%" height="46" align="right" valign="top" nowrap="nowrap"><div align="left">Link for Image</div></td>
                      <td width="88%"><input type="text" name="slider_link_image" value="" size="32" class="form-control"/></td>
                    </tr>
                    <tr valign="baseline">
                      <td height="46" align="right" valign="top" nowrap="nowrap"><div align="left">Caption</div></td>
                      <td><input type="text" name="slider_caption" value="" size="32" class="form-control" /></td>
                    </tr>
                    <tr valign="baseline">
                      <td nowrap="nowrap" align="right" valign="top"><div align="left">Deskripsi</div></td>
                      <td><textarea name="slider_desc" cols="50" rows="5"  class="form-control"></textarea>      </td>
                    </tr>
                    <tr valign="baseline">
                      <td align="right" valign="top" nowrap="nowrap"><div align="left"></div></td>
                      <td valign="bottom"><input type="submit" value="Simpan" class="btn btn-primary"/></td>
                    </tr>
                  </table>
                  <input type="hidden" name="MM_insert" value="form1" />
              </form>
	        </div>
    </div>
</div>
