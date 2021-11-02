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
<?php
	include_once("connection.php");
	if(isset($_POST["btnAdd"]))
	{
		$id = $_POST["txtID"];
		$name = $_POST["txtName"];
		$des = $_POST["txtDes"];
		$err="";
		If($id==""){
			$err.="<li>Enter Category ID, please</li>";
		}
		If($name==""){
			$err.="<li>Enter Category Name, please</li>";
		}
		If($err!=""){
			echo "<ul>$err</ul>";
		}
		else{
			$sq="SELECT * FROM public.category where idcate='$id' or namecate='$name'";
			$result = pg_query($conn,$sq) or die(pg_error($conn));
			if(pg_num_rows($result)==0)
			{
				pg_query($conn,"INSERT INTO public.category(idcate,namecate,descate) VALUES ('$id','$name','$des')");
				echo '<meta http-equiv="refresh" content="0;URL=?page=cate"/>';
			}
			else
			{
				echo "<li>Duplicate category ID or Name </li>";
			}
		}

	}
?>

<div class="container">
	<h1>Adding New Category</h1>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Category ID(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Catepgy ID" value='<?php echo isset($_POST["txtID"])?($_POST["txtID"]):"";?>'>
							</div>
					</div>	
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Category Name(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Catepgy Name" value='<?php echo isset($_POST["txtName"])?($_POST["txtName"]):"";?>'>
							</div>
					</div>
                    
                    <div class="form-group">
						    <label for="txtMoTa" class="col-sm-2 control-label">Description(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description" value='<?php echo isset($_POST["txtDes"])?($_POST["txtDes"]):"";?>'>
							</div>
					</div>
                    
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new"/>
                              <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Cancel" onclick="window.location='?page=cate'" />
                              	
						</div>
					</div>
				</form>
</div>