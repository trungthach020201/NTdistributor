<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dinhdang1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <title>ATN shop</title>
    <script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    
  </head>
  <body>
  <?php
  session_start();
  include_once("connection.php");
  ?>
      <div id="homepage">
        <header id="header">
            <div id="welcome">
                <marquee direction="left" behavior="scroll" scrollamount="6">
                    Welcome to the website of ATN selling toy company - the best selling toys of domestic and foreign in Vietnam.
                </marquee>
            </div>
            <!--slideshow-->
            <div id="slideshow">
                <div class="slide-wrapper">
                    <div class="slide"><img src="image/head2.png" width ="900px" height="560px"></div>
                    <div class="slide"><img src="image/head1.png" width ="900px" height="590px"></div>
                    <div class="slide"><img src="image/head3.png" width ="900px" height="620px"></div>
                </div>
            </div>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
         <!-- Toggler/collapsibe Button -->
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
         </button>
        
         <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
               <div id="sear">
                    <li class="nav-item">
                    <a class="nav-link" href="?page=index">Home</a>
                    </li>
               </div>
               <div id="sear">
                    <li class="nav-item">
                    <a class="nav-link" href="?page=fruit">Manage Account</a>
                    </li>
               </div>
               <div id="sear">
                    <li class="nav-item">
                    <a class="nav-link" href="?page=vegetable">Manage product</a>
                    </li>
               </div>
               <!-- <div id="sear">
                    <li class="nav-item">
                    <a class="nav-link" href="?page=tubers">Tubers</a>
                    </li>
               </div> -->
               <div id="sear">
                    <li class="nav-item">
                    <a class="nav-link" href="?page=cate">Manegement category</a>
                    </li>
                </div>
                <div id="sear">
                    <li class="nav-item">
                    <a class="nav-link" href="?page=addtocart">Profit Report</a>
                    </li>
               </div>
        <div>
               <?php
               
            if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
            ?>
              <li><a style="color:#fff" href="?page=updateprofie">
                  <i class="fa fa-lock"></i>Hi, <?php echo $_SESSION['us']?>&nbsp;&nbsp;&nbsp;</a></li>
                  
              <li><a href="?page=logout" style="color: #fff;">
                  <i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
            <?php
            } else {
            ?>
                   <div id="sear">
                        <li class="nav-item">
                        <a class="nav-link" href="?page=login">Log-in</a>
                        </li>
                    </div>
            <?php
            }
            ?>
        </div>
    
            </ul>
         
    </nav>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 
</header>

<?php
if(isset($_GET['page']))
{
    $page = $_GET['page'];
    if($page=="index"){
        include_once("home.php");
    }
    elseif($page=="fruit"){
        include_once("fruit.php");
    }
    elseif($page=="vegetable"){
        include_once("vegetable.php");
    }
    elseif($page=="tubers"){
        include_once("tubers.php");
    }
    elseif($page=="login"){
        include_once("login.php");
    }
    elseif($page=="cart"){
        include_once("cart.php");
    }
    elseif($page=="register"){
        include_once("register.php");
    }
    elseif($page=="addfruit"){
        include_once("addfruit.php");
    }
    elseif($page=="editfruit"){
        include_once("edit.php");
    }
    elseif($page=="cate"){
        include_once("Category_manegement.php");
    }
    elseif($page=="addcate"){
        include_once("addcate.php");
    }
    elseif($page=="addpro"){
        include_once("addproduct.php");
    }
    elseif($page=="logout"){
        include_once("logout.php");
    }
    elseif($page=="updateprofie"){
        include_once("updateprofie.php");
    }
    elseif($page=="updatecate"){
        include_once("updatecate.php");
    }
    elseif($page=="updateprod"){
        include_once("updateprod.php");
    }
    elseif($page=="addtocart"){
        include_once("addtocart.php");
    }
}
else{
    include("home.php");
}

?>
        <div style="clear: left;"></div>
        <footer id="footer">
            <div class="footerleft">
                <a href="?page=index">
                <img src="image/logo-removebg-preview (2).png" width="70" height="70" />
                </a>
            </div>
            <div class="left"> NT distributor Co., Ltd - Vietnam Branch
                <br /> Address: 22A, Duong Quang Dong street, 5 ward ,Tra Vinh City
                <br /> Tel: 0865894853
            </div>

            <div class="right">
                <a href="https://id.zalo.me/account?continue=https%3A%2F%2Fchat.zalo.me%2F">
                <img src="image/zalo.png" width="70" height="70" /></a>
            
                <a href="https://www.facebook.com/wendythach.02022001">
                <img src="image/face.png" width="50" height="50" /></a>
            
               <a href="https://mail.google.com/mail/u/0/#inbox" >
               <img src="image/mail.png" width="50" height="50" /></a>
            </div>
        </footer>
    </div>
  </body>
  </html>