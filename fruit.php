<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dinhdang1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="responsive.css">
    <title>NTdisbutor</title>
    <script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    
  </head>
    <body>
    <div class="container">
                <div class="col-md-12">
                    <div class="latest-product">
                        <div class="product-carousel"> 
                        <div class="normal-wrapper">
            <div class="category-1">
                <h1 class="no-margin-top"><b>|</b> Account off User</h1>
            </div>
                           <?php
						  include_once("connection.php");
		  				   	$result = pg_query($conn, "SELECT * FROM public.product where idcate='F01'");
			
			                if (!$result) { //add this check.
                                die('Invalid query: ' . pg_error($conn));
                            }
		
			            
			                while($row = pg_fetch_array($result,NULL, PGSQL_ASSOC)){
				            ?>
  
            <div class="icon-outer">
                <div class="icon-circle" align="center">
                <img src="image/<?php echo $row['productimage']?>" width="150" height="150">
                </div>
                <h5><a><?php echo  $row['productname']?></a></h5>
                <p><a>price: <?php echo  $row['price']?> VND/kg</a></p>
                <button class="btn1 btn-primary" >Add to cart</button>
            </div>
                <?php
                }
                ?>

        </div>
    </div>

    </body>
</html>