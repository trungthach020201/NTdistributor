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

<br> 
<?php
	include_once("connection.php");
	function blind_Category_List($conn)
	{
		$sqlstring = "SELECT idcate, namecate from category";
		$result = pg_query($conn, $sqlstring);
		echo "<select name='CategoryList' class='form-control'>
		<option value='0'>Choose category</option>";
		while ($row = pg_fetch_array($result,NULL ,PGSQL_ASSOC)) {
			echo "<option value = '" . $row['idcate'] . "'>" . $row['namecate'] . "</option>";
		}
		echo "</select>";
	}
	if (isset($_POST["btnAdd"])) {
		$id = $_POST["txtID"];
		$proname = $_POST["txtName"];
		$price = $_POST['txtPrice'];
		$pic = $_FILES['txtImage'];
		$category = $_POST['CategoryList'];
		$err = "";
            if (trim($category) == "0") {
			$err .= "<li>enter category, Please</li>";
		}
		if (trim($id) == "") {
			$err .= "<li>enter poduct ID, Please</li>";
		}
		if (trim($proname) == "") {
			$err .= "<li>enter Product Name, Please</li>";
		}
		if (!is_numeric($price) || ($price <= 0)) {
			$err .= "<li>enter price, Please</li>";
		}
		if ($err != "") {
			echo "<ul>$err</ul>";
		} else {
			if ($pic['type'] == "image/jpg"  || $pic['type'] == "image/jpeg" || $pic['type'] == "image/png" || $pic['type'] == "image/gif") {
				if ($pic['size'] <= 6144000) {
					$sq = "SELECT * from public.product where productid='$id' or productname='$proname'";
					$result = pg_query($conn, $sq);
					if (pg_num_rows($result) == 0) {
						copy($pic['tmp_name'], "./image/" . $pic['name']);
						$_filePic = $pic['name'];
						$sqlstring = "INSERT INTO product (idcate, productid, productname, price, productimage) 
						VALUES ('$category','$id','$proname','$price','$_filePic')";
						pg_query($conn, $sqlstring);
						echo '<meta http-equiv="refresh" content="0;URL=?page=cate"/>';
					} else {
						echo "<li>duplicate product</li>";
					}
				} else {
					echo "<li>image is so big</li>";
				}
			} else {
				echo "<li>image fomat is not correct</li>";
			}
		}
	}
	?>  
<div class="container">
	<h2>Adding new Product</h2>
	 	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
             <div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Product category(*):  </label>
							<div class="col-sm-10">
							      <?php blind_Category_List($conn);?>
							</div>
                </div>  
                        <div class="form-group">
					<label for="txtTen" class="col-sm-2 control-label">Product ID(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" value=''/>
							</div>
				</div> 
				<div class="form-group"> 
					<label for="txtTen" class="col-sm-2 control-label">Product Name(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value=''/>
							</div>
                </div>             
                <div class="form-group">  
                    <label for="lblGia" class="col-sm-2 control-label">Price(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value=''/>
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
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new"/>
                                          <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Cancle" onclick="window.location='?page=cate'" />	
						</div>
				</div>
			</form>
</div>
</html>
