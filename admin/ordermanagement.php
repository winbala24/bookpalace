<?php
session_start();
include 'connect.php';
include 'function.php';
$orders=mysqli_query($connection,"select * from order order by orderid desc");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<body>

    <?php include 'header.php' ?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="page-header">
                        <h2>Welcome to Admin,
                            <span class="text-danger">
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
                    <table class="table table-hover">
                        <tr>
                            <td>No</td>
                            <td>Customer Name</td>
                            <td>Phone</td>
                            <td>Delivery Address</td>
                            <td>Item(s)</td>
                            <td>Order_Date</td>
                            <td>Sended_Date</td>
                            <td>Action</td>
                        </tr>
                        <?php
                        while($out=mysqli_fetch_array($orders))
                        {
                            $check=$out['status'];
                            {
                                if($check>0)
                                {
                                    $show="<tr class='mark'>";
                                }
                                else
                                {
                                    $show="<tr>";
                                }
                                $show.='<td>'.$out['orderid'].'</td>';
                                $show.='<td>'.$out['deliveryname'].'</td>';
                                $show.='<td>'.$out['deliveryphone'].'</td>';
                                $show.='<td>'.$out['deliveryaddress'].'</td>';
                                $show.='<td>';
                                $orderid=$out['orderid'];
                                $order=mysqli_query($connection,"Select orderdetail.*,product.* from orderdetail left join product on orderdetail.productid=product.productid where orderdetail.orderid='$orderid'");
                                while($row=mysqli_fetch_assoc($order))
                                {
                                    $show.='<ul><li>'.$row['productname'].'<span style="color:red;">['.$row['productqty'].']</span></li></ul>';}
                                    $show.='</td>';
                                    $show.='<td>'.$out['orderdate'].'</td>';
                                    $chesec=$out['status'];
                                    if($chesec>0)
                                    {
                                        $show.='<td>'.$out['senddate'].'</td>';
                                    }
                                    else
                                    {
                                        $show.='<td>----/---/------</td>';
                                    }
                                    if($out['status'])
                                    {
                                        $show.='<td><a href="status.php?id='.$out['orderid'].'&status=0" class="btn btn-danger">Undo</a></td>';
                                    }
                                    else
                                    {
                                        $show.='<td><a href="status.php?id='.$out['orderid'].'&status=1" class="btn btn-success">Mark as Delivered</a></td>';}
                                        $show.='</tr>';
                                        echo $show;
                                    }
                                

                                }
                            
                        
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>