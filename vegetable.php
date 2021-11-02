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
    
<br>  

                <script language="javascript">
                    function deleteConfirm()
                    {
                        if (confirm("Are you sure to delete"))
                            {
                                return true;
                            }
                        else{
                                return false;
                            }
                    }
                </script>

<?php
            if (!isset($_SESSION['admin'])or $_SESSION['admin']==0)
            {
            echo "<script>alert('You are not adminstrator')</script>";
            echo '<meta http-equiv="refresh" content="0;URL=?page=index"/>';
            }
            else
            {
            ?>
<?php
    if (isset($_GET["function"]) == "delproduct") {
        if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sq = "SELECT productimage from product WHERE productid='$id'";
        $res = pg_query($conn, $sq);
        $row = pg_fetch_array($res, NULL,PGSQL_ASSOC);
        $filePic = $row['productimage'];
        unlink("image/".$filePic);
        pg_query($conn, "DELETE FROM product WHERE productid='$id'");
        }
    }
?>
<form name="frm" method="post" action="">
<h1 align="center">Product Management</h1>
<p>
<img src="image/add.png" alt="Addnew" width="16" height="16" border="0"/> <a href="?page=addpro"> Add new
</p>
<table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th><strong>No.</strong></th>
<th><strong>Product ID</strong></th>
<th><strong>Product Name</strong></th>
<th><strong>Price</strong></th>

<th><strong>Category</strong></th>
<th><strong>Image</strong></th>
<th><strong>Edit</strong></th>
<th><strong>Delete</strong></th>
</tr>
</thead>
<tbody>
<?php
    $No = 1;
    $result = pg_query($conn, "SELECT productid, productname, price, productimage, namecate FROM product a, category b
            WHERE a.idcate = b.idcate ORDER BY price DESC");
    while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)) {
?>
    <tr>
        <td><?php echo $No; ?></td>
        <td><?php echo $row["productid"]; ?></td>
        <td><?php echo $row["productname"]; ?></td>
        <td><?php echo $row["price"]; ?></td>
        <td><?php echo $row["Namecate"]; ?></td>
        <td align='center' class='cotNutChucNang'>
        <img src='image/<?php echo $row['productimage'] ?>' border='0' width="50" height="50" />
        </td>
        <td align='center' class='cotNutChucNang'><a href="?page=updateprod&&id=<?php echo $row["productid"]; ?>"><img src='image/edit.png' border='0' width="30" height="30" /></a></td>
        <td align='center' class='cotNutChucNang'><a href="?page=cate&&function=delproduct&&id=<?php echo $row["productid"]; ?>" onclick="return deleteConfirm()"><img src='image/delete.png' border='0' width="30" height="30" /></a></td>
    </tr>
    <?php 
    $No++;
    }
    ?>

 
</tbody>

</table>
<?php 
    } 
    ?>
</form>
    </body>
</html>
