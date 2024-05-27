<?php
session_start();
include 'admin/connect.php';
include 'userfunction.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shopping Cart</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'userheader.php'; ?>
<div class="container">
<div class="row mt-5">
<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h3>Welcome
<span class="showname">
<?php
                            if (!empty($_SESSION['user'])) {
                                echo $_SESSION['user'];
                            } else {
                                $_SESSION['user'] = '';
                                echo "no";
                            }
                            ?>
</span>
</h3>
</div>
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header text-center">
<h2>Shopping Cart</h2>
</div>
<?php if (!empty($_SESSION['cart'])) : ?>
    <div class="card-body">
        <table class="table table-condensed">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
<body>
<?php
         $total = 0;
         foreach ($_SESSION['cart'] as $id => $qty) {
         $id = mysqli_real_escape_string($connection, $id);
         $result = mysqli_query($connection, "SELECT * FROM product WHERE productid='$id'");
 
         if ($result) {
         $row = mysqli_fetch_assoc($result);
?>
<tr>
<td><img src="photo/<?php echo $row['photo'] ?>" width="100" height="100" class="img img-thumbnail" /></td>
<td><?php echo $row['productname'] ?></td>
<td>
<?php echo $qty ?>
<span>
<a href="change-qty.php?id=<?php echo $id; ?>&action=increase" class="btn btn-outline-primary btn-sm">+</a>
<a href="change-qty.php?id=<?php echo $id; ?>&action=decrease" class="btn btn-outline-secondary btn-sm">-</a>
</span>
</td>
<td>MMK-<?php echo $row['price'] ?></td>
<td>MMK-<?php echo $row['price'] * $qty ?></td>
<td>
<a href="remove.php?id=<?php echo $id ?>" class="btn btn-outline-danger btn-sm">Remove</a>
</td>
</tr>
<?php
                                $total += $row['price'] * $qty;
                                } else {
                                echo "Error in query: " . mysqli_error($connection);
                                    }
                                }
?>
</tbody>

<tfoot>
    <tr>
        <td colspan="4" align="right"><b>Total:</b></td>
        <td>MMK-<?php echo $total; ?></td>
        <td></td>
    </tr>
</tfoot>
</table>
</div>
<div class="card-footer">
<a href="clear.php" class="btn btn-danger">Clear Cart</a>
<a href="index.php" class="btn btn-default">Back</a>
<a href="submit-order.php" class="btn btn-primary">Submit Order</a>
</div>
<?php else : ?>
    <div class="card-body">
    <h3 class="text-danger lead text-center">You have not selected any products yet!</h3>
    <p class="text-center"><a href="index.php" class="btn btn-info">Shop Now</a></p>
    </div>
<?php endif; ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>