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
            include_once("connection.php");
                if (isset($_GET["function"]) == "del")
            {
                if(isset($_GET["id"]))
                    {
                        $id = $_GET["id"];
                        pg_query($conn, "DELETE FROM category WHERE idcate='$id'");
                    }
            }
        ?>
<form name="frm" method="post" action="">
        <h1 align="center">Product Category</h1>
        <p>
        <img src="image/add.png" alt="Add new" width="16" height="16" border="0" /> 
        <a href="?page=addcate"> Add</a>
        </p>
        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Category Name</strong></th>
                     <th><strong>Desscriptin</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>
             <tbody>
            <!--delete-->
        
                <?php
                $No = 1;
                $result = pg_query($conn, "SELECT * FROM public.category");
                while($row = pg_fetch_array($result,NULL ,PGSQL_ASSOC))
                {
                ?>   
			<tr>
              <td class="cotCheckBox"><?php echo $No; ?></td>
              <td><?php echo $row["namecate"]; ?></td>
              <td><?php echo $row["descate"]; ?></td>
              <td style='text-align:center'> 
                    <a href="?page=updatecate&&id=<?php echo $row['idcate']; ?>">
                    <img src='image/edit.png' border='0'  />
                    </a>
                </td>
              <td style = 'text-align:center'>
                    <a href="?page=cate&&function=del&&id=<?php echo $row["idcate"]; ?>" onclick="return deleteConfirm()">
                        <img src='image/delete.png' border='0'/>
                    </a>
              </td>
            </tr>
            <?php
                $No++;
                }
            ?>
        </tbody>
    </table>  
               
                <div class="col-md-12"></div>
       
    </form>

    <?php
    }
    ?>




<!-- adđ product -->

    </body>
</html>
