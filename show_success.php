<?php 
session_start();
include 'admin/connect.php';
 
$order_id = $_SESSION['oder_id']; 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Confirmation</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'userheader.php' ?>
<div class="container mt-5">
<div class="row">
<div class="col-md-6">
<?php
                $query = "select * from orders where orderid='$order_id'";
                $go_query = mysqli_query($connection, $query);
                while ($out = mysqli_fetch_array($go_query)) {
                    $db_name = $out['deliveryname'];
                    $db_phone = $out['deliveryphone'];
                    $db_address = $out['deliveryaddress'];
                }
            ?>
<div class="card">
<div class="card-header bg-primary text-white">
<h4 class="card-title">Customer Information</h4>
</div>
<div class="card-body">
<p class="card-text"><strong>Customer Name:</strong> <?php echo $db_name; ?></p>
<p class="card-text"><strong>Customer Phone:</strong> <?php echo $db_phone; ?></p>
<p class="card-text"><strong>Customer Address:</strong> <?php echo $db_address ;?></p>
</div>
</div>
</div>
<div class="col-md-6">
<table class="table table-striped">
<thead>
<tr>
<th colspan="4" class="bg-success text-white">Order Information</th>
</tr>
<tr>
<th>Product Name</th>
<th>Product Price</th>
<th>Product Qty</th>
<th>Unit Price</th>
</tr>
</thead>
<tbody>
<?php 
                    $total = 0;
                    $query = "select orderdetail.*,product.* from orderdetail left join product on orderdetail.productid=product.productid where orderdetail.orderid='$order_id'";
                    $go_query = mysqli_query($connection, $query);
                    while ($out = mysqli_fetch_array($go_query)) {
                        $product_name = $out['productname'];
                        $price = $out['price'];
                        $qty = $out['productqty'];
                        $unit_price = $qty * $price;
                        $total += $unit_price;
                        echo "<tr>
<td>{$product_name}<br></td>
<td>{$price}<br></td>
<td>{$qty}<br></td>
<td>{$unit_price}</td>
</tr>";
                    }
                    ?>
<tr>
<td colspan="3" align="right"><strong>Total Amount:</strong></td>
<td><?php echo $total; ?></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>