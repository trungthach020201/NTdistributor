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

<br>   
<?php
//Get custmer information
$query = "SELECT cusname, address, email, telephone from public.account
			where username = '" . $_SESSION["us"] . "'";
$result = pg_query($conn, $query) or die(pg_error($conn));
$row = pg_fetch_array($result,NULL, PGSQL_ASSOC);

$us = $_SESSION["us"];
$email = $row["email"];
$fullname = $row["cusname"];
$address = $row["address"];
$telephone = $row["telephone"];

//Update information when the user presses the "Update" button
if (isset($_POST['btnUpdate'])) {
	$fullname = $_POST['txtFullname'];
	$address = $_POST['txtAddress'];
	$tel = $_POST['txtTel'];

	$test = check();
	if ($test == "") {
		if ($_POST['txtPass1'] != "") {
			$pass = md5($_POST['txtPass1']);

			$sq = "UPDATE account set cusname='$fullname', address = '$address',
			telephone='$telephone', password='$pass' WHERE username='" . $_SESSION['us'] . "'";

			pg_query($conn, $sq) or die(pg_error($conn));
		} else {
			$sq = "UPDATE account set cusname='$fullname', address = '$address',
			telephone='$telephone' where username='" . $_SESSION['us'] . "'";

			pg_query($conn, $sq) or die(pg_error($conn));
		}
		echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
	} else {
		echo $test;
	}
}

//Write check() function to check information
function check()
{
	if ($_POST['txtFullname'] == "" || $_POST['txtAddress'] == "") {
		return "<li>Enter Fullname or Address</li>";
	} elseif (strlen($_POST['txtPass1']) > 0 && strlen($_POST['txtPass1']) <= 5) {
		return "<li>Password is greater than 5 characters</li>";
	} elseif ($_POST['txtPass1'] != $_POST['txtPass2']) {
		return "<li>Password and Confirm do not match</li>";
	} else {
		return "";
	}
}


?>
<div class="container">

	<h2 >Update Profile</h2>

	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
		<div class="form-group">

			<label for="lblTenDangNhap" class="col-sm-2 control-label">Username(*): </label>
			<div class="col-sm-10">
				<label class="form-control" style="font-weight:400"><?php echo $fullname;  ?></label>
			</div>
		</div>

		<div class="form-group">
			<label for="lblEmail" class="col-sm-2 control-label">Email(*): </label>
			<div class="col-sm-10">
				<label class="form-control" style="font-weight:400"><?php echo $email; ?></label>
			</div>
		</div>

		<div class="form-group">
			<label for="lblMatKhau1" class="col-sm-2 control-label">Password(*): </label>
			<div class="col-sm-10">
				<input type="password" name="txtPass1" id="txtPass1" class="form-control" />
            </div>
		</div>

		<div class="form-group">
			<label for="lblMatKhau2" class="col-sm-2 control-label">Confirm Password(*): </label>
			<div class="col-sm-10">
				<input type="password" name="txtPass2" id="txtPass2" class="form-control" />
			</div>
		</div>

		<div class="form-group">
			<label for="lblHoten" class="col-sm-2 control-label">Full name(*): </label>
			<div class="col-sm-10">
				<input type="text" name="txtFullname" id="txtFullname" value="<?php echo $fullname; ?>" class="form-control" placeholder="Enter Fullname, please" />
			</div>
		</div>

		<div class="form-group">
			<label for="lblDiaChi" class="col-sm-2 control-label">Address(*): </label>
			<div class="col-sm-10">
				<input type="text" name="txtAddress" id="txtAddress" value="<?php echo $address; ?>" class="form-control" placeholder="Enter Address, please" />
			</div>
		</div>

		<div class="form-group">
			<label for="lblDienThoai" class="col-sm-2 control-label">Telephone(*): </label>
			<div class="col-sm-10">
				<input type="text" name="txtTel" id="txtTel" value="<?php echo $telephone; ?>" class="form-control" placeholder="Enter Telephone, please" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
                <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Cancel" onclick="window.location='?page=index'"/>
			</div>
		</div>
	</form>
</div>