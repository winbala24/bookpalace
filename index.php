<?php
session_start();
include 'admin/connect.php';
include 'userfunction.php';
$getquery = "select * from product";
$perpage = 3; // Change this to 3 for three cards per page
$go_query = mysqli_query($connection, $getquery);
$num = mysqli_num_rows($go_query);
$num = ceil($num / $perpage);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product List</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/style.css"/>
</head>
<body>
<?php include 'userheader.php' ?>
<div class="container mt-5">
<div class="row">
<div class="col-sm-12">
<div class="alert alert-primary">
<h3>Welcome
<span class="showname">
<?php
            if (!empty($_SESSION['user'])) {
              echo $_SESSION['user'];
            } else {
              $_SESSION['user'] = '';
            }
            ?>
</span>
</h3>
</div>
</div>
<div class="col-sm-12">
<div class="row">
<?php
        $start = ($page - 1) * $perpage;
        $query = "SELECT * FROM product LIMIT $start, $perpage";
        $go_query = mysqli_query($connection, $query);
        while ($out = mysqli_fetch_array($go_query)) {
          $product_id = $out['productid'];
          $product_name = $out['productname'];
          $price = $out['price'];
          $photo = $out['photo'];
          ?>
<div class="col-md-4 mb-4">
<div class="card">
<img src="photo/<?php echo $photo; ?>" class="card-img-top img-fluid" alt="<?php echo $product_name; ?>">
<div class="card-body">
<h5 class="card-title"><?php echo $product_name; ?></h5>
<p class="card-text"><?php echo $price; ?></p>
<a href="addtocart.php?id=<?php echo $product_id; ?>" class="btn btn-primary">Add to Cart</a>
</div>
</div>
</div>
<?php
        }
        ?>
</div>
</div>
</div>
<ul class="pagination justify-content-center mt-3">
<?php
    for ($i = 1; $i <= $num; $i++) {
      if ($i == $page) 
      {
        echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
      } 
      else 
      {
        echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
      }
    }
    ?>
</ul>
</div>
</body>
</html>