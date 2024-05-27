<?php
session_start();
include 'function.php';
include 'connect.php';
if(isset($_GET['action'])&& $_GET['action']=='edit')
{
    $pid=$_GET['pid'];
    $query="Select * from product where productid='$pid'";
    $go_query=mysqli_query($connection,$query);
    while($row=mysqli_fetch_array($go_query))
    {
        $productid=$row['productid'];
        $productname=$row['productname'];
        $product_cat_id=$row['categoryid'];
        $price=$row['price'];
        $qty=$row['Qty'];
        $photo=$row['photo'];
    }
}
if(isset($_POST['btnupdateproduct']))
{
    update_product();
}
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
            <h2>Welcome Admin,
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
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-header text-center bg-info">Update Product</div>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Name</label>
                        <input type="text" name="productname" class="form-control" value="<?php echo $productname ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <select name="category" id="" class="form-select">
                            <option value="">-----Select One-----</option>
                            <?php
                            $query="Select * from category";
                            $go_query=mysqli_query($connection,$query);
                            while($row=mysqli_fetch_array($go_query))
                            
                            {
                                $catid=$row['catid'];
                                $catname=$row['catname'];
                                if($product_cat_id==$catid)
                                {
                                    echo "<option value={$catid} selected>{$catname}</option>";
                                }
                                else
                                {
                                    echo "<option value={$catid}>{$catname}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="text" name="price" class="form-control" value="<?php echo $price ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Quantity</label>
                        <input type="text" name="qty" class="form-control" value="<?php echo $qty ?>">
                    </div>
                    <div class="mb-3">
                    <label for="" class="form-label">File Input</label>
                        <input type="file" name="photo" id="" class="form-control" 
                        value="<?php echo $photo ?>">
                        <img src="../Photo/<?php echo $photo ?>" width="100" height="100">
                    </div>
                    <div class="mb-3 d-grid">
                        <input type="submit" value="Update Product" name="btnupdateproduct" class="btn btn-outline-info">
                    </div>
                    

                </form>
            </div>

        </div>

    </div>
    </div>
</body>
</html>