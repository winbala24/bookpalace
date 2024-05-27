<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
    <?php
    include 'header.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Welcome Admin,
                    <span>
                    <?php
                    if(isset($_SESSION['admin']))
                    {
                        echo $_SESSION['admin'];
                    }
                    else
                    {
                        $_SESSION['admin']='';
                    }
                    ?>

                    </span>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-info text-center">Category</div>
                    <div class="card-body">
                        <a href="category.php" class="btn btn-info">View Details 
                        <span class="badge">
                        <?php
                        $query="Select * from category";
                        $get_query=mysqli_query($connection,$query);
                        $num=mysqli_num_rows($get_query);
                        echo $num;
                        ?>
                        </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-success text-center">User</div>
                    <div class="card-body">
                        <a href="userlist.php" class="btn btn-success">View Details 
                        <span class="badge">
                        <?php
                          $query="Select * from product";
                          $get_query=mysqli_query($connection,$query);
                          $num=mysqli_num_rows($get_query);
                          echo $num;
                          ?>
                        </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-center">Product</div>
                    <div class="card-body">
                        <a href="productlist.php" class="btn btn-primary">View Details 
                        <span class="badge">
                        5
                        </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-danger text-center">Order</div>
                    <div class="card-body">
                        <a href="order_mgmt.php" class="btn btn-danger">View Details 
                        <span class="badge">
                        5
                        </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
        <div class="col-sm-12">
        <a href="product.php" class="btn btn-primary">Add Product</a>
        <a href="user.php" class="btn btn-primary">Add User</a>
        </div>
    </div>
    </div>
</body>
</html>