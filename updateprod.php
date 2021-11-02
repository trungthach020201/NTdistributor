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
    <title>NTdistributor</title>
	<script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    </head>
    <body>

    <?php
	include_once("connection.php");
	Function bind_Category_List($conn,$selectedValue){
		$sqlstring="SELECT idcate, namecate FROM public.category";
		$result = pg_query($conn, $sqlstring);
		echo "<select name='CategoryList' class='form-control'>
			<option value='0'>Chose category</option>";
			while ($row = pg_fetch_array($result,NULL ,PGSQL_ASSOC)){
				if($row['idcate'] == $selectedValue)
				{
					echo "<option value='".$row['idcate']."' selected>".$row['namecate']."</option>";
				}
				else{
					echo "<option value='".$row['idcate']."'>".$row['namecate']."</option>";
				}
			}
		echo "</select>";
	}
	if(isset($_GET["id"]))
	{
		$id= $_GET["id"];
		$sqlstring = "SELECT productname, price, productimage, idcate
		FROM public.product WHERE productid = '$id' ";

		$result = pg_query($conn, $sqlstring);
		$row = pg_fetch_array($result,NULL ,PGSQL_ASSOC);
		
		$proname =$row["productname"];
		$price=$row['price'];
		$pic =$row['productimage'];
		$category= $row['idcate'];
    ?>
                <div class="container">
                    <h2 >Updating Product</h2>
                        <form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
                            <div class="form-group">   
                                    <label for="" class="col-sm-2 control-label">Product category(*):  </label>
                                            <div class="col-sm-10">
                                                <?php bind_Category_List($conn,$category);?>
                                            </div>
                                </div>  
                                        <div class="form-group">
                                    <label for="txtTen" class="col-sm-2 control-label">Product ID(*):  </label>
                                            <div class="col-sm-10">
                                                <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" value='<?php echo $id ?>'/>
                                            </div>
                                </div> 
                                <div class="form-group"> 
                                    <label for="txtTen" class="col-sm-2 control-label">Product Name(*):  </label>
                                            <div class="col-sm-10">
                                                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value='<?php echo $proname ?>'/>
                                            </div>
                                </div>             
                                <div class="form-group">  
                                    <label for="lblGia" class="col-sm-2 control-label">Price(*):  </label>
                                            <div class="col-sm-10">
                                                <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='<?php echo $price ?>'/>
                                            </div>
                                </div>   
                
                                <div class="form-group">  
                                    <label for="sphinhanh" class="col-sm-2 control-label">Image(*):  </label>
                                            <div class="col-sm-10">
                                                <input type="file" name="txtImage" id="txtImage" class="form-control" value=""/>
                                            </div>
                                        </div>
                                        
                                <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                                        <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Cancel" onclick="window.location='?page=cate'" /> </div>
                                </div>
                            </form>
                </div>

                <?php
	}	
	else 
	{
		echo '<meta http-equiv="Refresh" content="0; URL=?page=cate"/>';
	}
?>
<?php	
	if(isset($_POST["btnUpdate"]))
	{
		$id=$_POST["txtID"];
		$proname=$_POST["txtName"];
		$price=$_POST['txtPrice'];
		$pic=$_FILES['txtImage'];
		$category=$_POST['CategoryList'];
		$err="";

		if(trim($id)=="")
		{
			$err .="<li>Enter Product ID, please</li>";
		}
		if(trim($proname)=="")
		{
			$err .= "<li>Enter product name,please</li>";
		}
		if($category=="0")
		{
			$err .= "<li>Choose product category,please</li>";
		}
		if(!is_numeric($price))
		{
			$err .= "<li>Product price must be number</li>";
		}
		if($err != "")
		{
			echo "<ul>$err</ul>";
		}
		else
		{
			if($pic['name'] !="")
			{
				if($pic['type']=="image/jpg" || $pic['type']=="image/jpeg" || $pic['type']=="image/png" || $pic['type']=="image/git" )
				{
					if($pic['size']<= 614400)
					{
						$sq="SELECT * FROM public.product WHERE productid != '$id' and productname='$proname'";
						$result=pg_query($conn,$sq);
						if(pg_num_rows($result)==0)
						{
						copy($pic['tmp_name'], "image/".$pic['name']);
						$filePic = $pic['name'];

						$sqlstring="UPDATE public.product SET productname='$proname', price=$price, 
						productimage='$filePic',idcate='$category' WHERE productid='$id'";
						pg_query($conn,$sqlstring);
						echo '<meta http-equiv="refresh" content="0;URL=?page=cate"/>';
						}
						else 
						{
							echo "<li>Duplicate productId or Name</li>";
						}
					}
					else 
					{
						echo "Size of image too big";
					}	
				}
				else 
				{
					echo "Image format is not correct";
				}
			}
			else
			{
				$sq="SELECT * FROM public.product where productid != '$id' and productname='$proname'";
				$result= pg_query($conn,$sq);
				if(pg_num_rows($result)==0)
				{
					$sqlstring="UPDATE public.product SET productname='$proname',
					price=$price, idcate='$category' WHERE productid='$id'";

					pg_query($conn,$sqlstring);
					echo '<meta http-equiv="refresh" content="0;URL=?page=cate"/>';
				}
				else 
				{	
					echo "<li>Duplicate productId or Name</li>";
				}
			}
		} 
	}
?>

    </body>
</html>