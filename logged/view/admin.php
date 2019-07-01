
<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO admins (username, password, nama_lengkap, email, no_telp, `level`, blokir) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['no_telp'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['blokir'], "text"));

  mysql_select_db($database_olshop, $olshop);
  $Result1 = mysql_query($insertSQL, $olshop) or die(mysql_error());
}

mysql_select_db($database_olshop, $olshop);
$query_rs_admin_view = "SELECT * FROM admins";
$rs_admin_view = mysql_query($query_rs_admin_view, $olshop) or die(mysql_error());
$row_rs_admin_view = mysql_fetch_assoc($rs_admin_view);
$totalRows_rs_admin_view = mysql_num_rows($rs_admin_view);
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>


<div class="list-group-item active">
		<h3>Halaman <strong>Administrator</strong></h3>
</div>
<p></p>
<?php if ($totalRows_rs_admin_view  > 0) { ?>
<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">
    <p></p>
    	<table width="100%" class="table table-striped"  id="data">
            <thead>
              <tr>
                <th height="40" bgcolor="#006699"><span class="style1">No.</span></th>
                <th bgcolor="#006699"><div align="center" class="style1">USERNAME</div></th>
                <th bgcolor="#006699"><div align="center" class="style1">PASSWORD</div></th>
                <th bgcolor="#006699"><div align="center" class="style1">NAMA LENGKAP</div></th>
                <th bgcolor="#006699"><div align="center" class="style1">EMAIL</div></th>
                <th bgcolor="#006699"><div align="center" class="style1">TELP</div></th>
                <th bgcolor="#006699"><div align="center" class="style1">LEVEL</div></th>
                <th bgcolor="#006699"><div align="center" class="style1">GAMBAR</div></th>
                <th bgcolor="#006699"><div align="center" class="style1">ACTION</div></th>
              </tr>
          </thead>
              <tbody>
              <?php $no = 1; do { ?>
                <tr>
                  <td><div align="center"><?php echo $no++; ?></div></td>
                  <td><?php echo $row_rs_admin_view['username']; ?></td>
                  <td><a href="?page=update/password">Ganti Password</a></td>
                  <td><?php echo $row_rs_admin_view['nama_lengkap']; ?></td>
                  <td><?php echo $row_rs_admin_view['email']; ?></td>
                  <td><?php echo $row_rs_admin_view['no_telp']; ?></td>
                  <td><?php echo $row_rs_admin_view['level']; ?></td>
                  <td><img src="../logged/gambar/<?php echo $row_rs_admin_view['foto']; ?>" alt="Image" width="50px" height="50" class="image-responsive"/></td>
                  <td><div align="center">
                    <div align="center"><a href="?page=delete&email=<?php echo $row_rs_admin_view['email']; ?>"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;<a href="?page=update/admin&email=<?php echo $row_rs_admin_view['email']; ?>"><span class="glyphicon glyphicon-edit"></span></a></div>
                  </div></td>
                </tr>
                <?php } while ($row_rs_admin_view = mysql_fetch_assoc($rs_admin_view)); ?>
          </tbody>
      </table>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
    	<br />
       <div class="list-group-item">
             <img src="../logged/gambar/<?php echo $row_rs_profile_admin['foto']; ?>">
          </div>
            <div class="list-group-item">
    	        Nama : <?php echo $row_rs_profile_admin['nama_lengkap']; ?>
	        </div>
          <div class="list-group-item">
              Email : <?php echo $row_rs_profile_admin['email']; ?>
          </div>
           <div class="list-group-item">
              No Telepon : <?php echo $row_rs_profile_admin['no_telp']; ?>
          </div>
          <div class="list-group-item">
              Level : <?php echo $row_rs_profile_admin['level']; ?>
          </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="messages">
    <p></p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table width="100%" height="331">
        <tr valign="baseline">
          <td width="111" align="left" valign="top" nowrap="nowrap"><div align="left">Username</div></td>
          <td width="920"><input type="text" name="username" value="" size="32" class="form-control"/></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">Password</div></td>
          <td><input type="password" name="password" value="" size="32" class="form-control" /></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">Nama Lengkap</div></td>
          <td><input type="text" name="nama_lengkap" value="" size="32"  class="form-control"/></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">Email</div></td>
          <td><input type="text" name="email" value="" size="32" class="form-control" /></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">No. Telepon</div></td>
          <td><input type="text" name="no_telp" value="" size="32" class="form-control" /></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">Level</div></td>
          <td><select name="level"  class="form-control">
            <option value="admin" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Administrator</option>
            <option value="user" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>User</option>
          </select>      </td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">Blokir</div></td>
          <td valign="baseline"><table width="227">
            <tr>
              <td width="90"><input name="blokir" type="radio" value="Y" />
                Yes</td>
              <td width="125"><input name="blokir" type="radio" value="N" checked="checked" />
    No</td>
            </tr>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left"></div></td>
          <td valign="bottom"><input type="submit" value="Simpan"  class="btn btn-primary" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form>

    </div>
    <div role="tabpanel" class="tab-pane fade" id="settings">...</div>
  </div>

</div>

<?php } ?>
<?php if ($totalRows_rs_admin_view  == 0) { ?>
	<div class="alert alert-danger">Belum ada data admin, Silahkan Tambahkan </div>
    
    <div class="well">
    	<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table width="100%" height="331">
        <tr valign="baseline">
          <td width="111" align="left" valign="top" nowrap="nowrap"><div align="left">Username</div></td>
          <td width="920"><input type="text" name="username" value="" size="32" class="form-control"/></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">Password</div></td>
          <td><input type="password" name="password" value="" size="32" class="form-control" /></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">Nama Lengkap</div></td>
          <td><input type="text" name="nama_lengkap" value="" size="32"  class="form-control"/></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">Email</div></td>
          <td><input type="text" name="email" value="" size="32" class="form-control" /></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">No. Telepon</div></td>
          <td><input type="text" name="no_telp" value="" size="32" class="form-control" /></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">Level</div></td>
          <td><select name="level"  class="form-control">
            <option value="admin" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Administrator</option>
            <option value="user" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>User</option>
          </select>      </td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left">Blokir</div></td>
          <td valign="baseline"><table width="227">
            <tr>
              <td width="90"><input name="blokir" type="radio" value="Y" />
                Yes</td>
              <td width="125"><input name="blokir" type="radio" value="N" checked="checked" />
    No</td>
            </tr>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap"><div align="left"></div></td>
          <td valign="bottom"><input type="submit" value="Simpan"  class="btn btn-primary" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    </div>
<?php } ?>