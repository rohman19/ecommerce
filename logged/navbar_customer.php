<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
             <div class="navbar-header">
               <a class="navbar-brand">
               
              </a>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                </button>
              <a class="navbar-brand" href="dashboard.php"><i><h4 class="text"><img class="bulat" src="../logged/gambar/glj.png"> CV GEMILANG LESTARI JAYA</h4></i></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a></a></li>
                  <!--<li><a href="../?page=services">Services</a></li>
   				  <li><a href="../?page=contact">Contact</a></li> -->
                </ul>
                <ul class="nav navbar-nav navbar-right">  
                  <li class="blue"><a href="?page=view/riwayat" ><span class="glyphicon glyphicon-shopping-cart"></span> Riwayat Pemesanan</a></li>                       
                  <li class="red"><a href="?page=keranjang" ><span class="glyphicon glyphicon-shopping-cart"></span> MyCart</a></li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="bulat" src="../logged/gambar/user.png"> <?php echo $row_rs_login['nama_lengkap']; ?> <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <!--<li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>-->
                        <li><a href="<?php echo $logoutAction ?>">Log Out </a></li>
                      </ul>
                    </li>
              </ul>
   				 
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>