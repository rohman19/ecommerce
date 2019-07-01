
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <a class="navbar-brand" href="#">
               
              </a>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
              <a class="navbar-brand" ></a>
              <i><h3 class="text"><img class="bulat1" src="../logged/gambar/glj.png"> CV GEMILANG LESTARI JAYA</h3></i>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
               <!--     <li><a href="../?page=about">About</a></li>
                  <li><a href="../?page=services">Services</a></li>
   				  <li><a href="../?page=contact">Contact</a></li> -->
                  </ul>
                  
                  <ul class="nav navbar-nav navbar-right">  
                  <li><a href="administrator.php" ><span class="glyphicon glyphicon-th-large"></span> Dashboard</a></li>
                   <li><a href="http://localhost/cvgemilang/" target="_blank" ><span class="fa fa-bar-chart-o"></span> Lihat Website Utama</a></li>
                  <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="bulat1" src="../logged/gambar/<?php echo $row_rs_profile_admin['foto']; ?>"> <?php echo $row_rs_profile_admin['nama_lengkap']; ?> <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <!--<li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>-->
                        <li><a href="<?php echo $logoutAction ?>">Log Out </a></li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>