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
    if(isset($_POST['btnLogin']))
    {
        $us = $_POST['txtUsername'];
        $pa = $_POST['txtPass'];

        $err = "";
        if($us=="")
        {
            $err .= "Enter Username please<br/>";
        }

        if($pa=="")
        {
            $err .= "Enter password please <br>";
        }

        if($err!= ""){
            echo $err;
        }
        else{
            include_once("connection.php");
            $pass = md5($pa);
            $res = pg_query($conn, "SELECT username, password,state FROM account WHERE username='$us' AND password='$pass'")
            or die (pg_error($conn));
            $row = pg_fetch_array($res,NULL ,PGSQL_ASSOC);
            if (pg_num_rows($res)==1){
                $_SESSION["us"]= $us;
                $_SESSION["admin"] = $row["state"];
                echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            }
            else{
                echo "you loged in fail";
            }
        }
    }  
?>
<?php
    if(isset($_POST['btnCancel']))
    {
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    }
?>
<!-- form login-->
<h1 align="center">Login</h1>
<form id="form1" name="form1" method="POST">
    <div class="row">
        <div class="form-group">				    
            <label for="txtUsername" class="col-sm-2 control-label">Username(*):  </label>
            <div class="col-sm-10">
                <input type="text" name="txtUsername" id="txtUsername" class="form-control" placeholder="Username" value=""/>
            </div>
        </div>  
        
        <div class="form-group">
            <label for="txtPass" class="col-sm-2 control-label">Password(*):  </label>			
            <div class="col-sm-10">
                    <input type="password" name="txtPass" id="txtPass" class="form-control" placeholder="Password" value=""/>
            </div>
            <p><a href="?page=register">Register for new account.</p>
        </div> 
        <div class="form-group"> 
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <input type="submit" name="btnLogin"  class="btn btn-primary" id="btnLogin" value="Login"/> &nbsp;
                <input type="submit" name="btnCancel"  class="btn btn-primary" id="btnLogin" value="Cancel"/>
            </div>  
        </div>
    </div>
</form>