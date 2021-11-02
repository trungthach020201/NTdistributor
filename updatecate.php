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
    <title>ATN shop</title>
    <script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    </head>
<br>   
<body>
<?php
    	include_once("connection.php");
		if(isset($_GET["id"]))
			{
				$id = $_GET["id"];
				$result = pg_query($conn,"SELECT*FROM public.category WHERE idcate='$id'");
				$row = pg_fetch_array($result,NULL,PGSQL_ASSOC);
				$cat_id = $row['idcate'];
				$cat_name = $row['namecate'];
				$cat_des = $row['descate'];
	?>
<!--form update -->
        <div class="container">
	        <h2 >Updating Category</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Category ID(*):  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Catepgy ID" readonly 
								  value='<?php echo $cat_id?>'>
							</div>
					</div>	
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Category Name(*):  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Catepgy Name" 
								  value='<?php echo $cat_name ?>'>
							</div>
					</div>
                    
                    <div class="form-group">
						    <label for="txtMoTa" class="col-sm-2 control-label">Description(*):  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description" 
								  value='<?php echo $cat_des?>'>
							</div>
					</div>
                    
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                              <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='?page=cate'" />
                              	
						</div>
					</div>
				</form>
            </div>
            <?php
	}
	else
	{
		echo'<meta http-equiv="refresh" content="0;URL=?page=cate"/>';
	}
	?>
	<?php
    if(isset($_POST["btnUpdate"]))
    {
        $id = $_POST["txtID"];
        $name = $_POST["txtName"];
        $des = $_POST["txtDes"];
        $err="";
        if($name=="")
        {
            $err.="<li>Enter category Name,Please</li>";
        }
        if($err!="")
        {
            echo "<ul>$err</ul>";
        }
        else
        {
             $sq="SELECT * FROM public.category where idcate != '$id' and namecate ='$name'";
             $result =  pg_query($conn,$sq);
             if(pg_num_rows($result)==0)
             {
                 pg_query($conn,"UPDATE public.category SET namecate = '$name', descate ='$des' WHERE idcate ='$id'");
                 echo '<meta http-equiv="refresh" content ="0;URL=?page=cate"/>';
             }
             else
             {
                 echo "<li>Duplicate category Name</li>";
             }
        }
    }
     ?>
       
</body>
</html>
