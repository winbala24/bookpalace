<?php
function adduser()

{

    global $connection;

    $uname=$_POST['username'];

    $password=$_POST['password'];

    $cpass=$_POST['cpassword'];

    $usertype=$_POST['role'];
 
      if($password!=$cpass)

      {

        echo"<script>window.alert('Password and comfrim password are must be same')</script>";

      }

      else if($password!="" && $uname!="")

       {

           $query="select * from user where username='$uname' and password=md5('$password')";

           $ch_query=mysqli_query($connection,$query);

           $count=mysqli_num_rows($ch_query);

             if($count>0)

             {

                echo"<script>window.alert('This is already exist')</script>";

             }

             else

             {

                $hashvalue=md5($password);            

                $query="insert into user(username,password,role) values('$uname','$hashvalue','$usertype')";

                $go_query=mysqli_query($connection,$query);

                if(!$go_query)

                    {

                        die("QUERY FAILED".mysqli_error());

                    }

                 header("location:userlist.php");

             }

       }

    }
    function deluser()
    {
      global $connection;
      $userid=$_GET['uid'];
      $query="Delete from user where userid='$userid'";
      $go_query=mysqli_query($connection,$query);
      header("location:userlist.php");
    }
    function addcat()
    {
      global $connection;
      $catname=$_POST['catname'];

      if(empty($catname))
      {
        echo '<script>window.alert("Please Enter Category Name")</script>';
      }
      else
      {
        $query="select * from category where catname='$catname'";
           $ch_query=mysqli_query($connection,$query);
           $count=mysqli_num_rows($ch_query);
             if($count>0)
             {
                echo"<script>window.alert('This is already exist')</script>";
             }
             else
             {
                            
                $query="insert into category(catname) values('$catname')";
                $go_query=mysqli_query($connection,$query);
                if(!$go_query)
                    {
                        die("QUERY FAILED".mysqli_error());
                    }
                 header("location:category.php");
             }

      }
    }
    function delcat()
    {
      global $connection;
      $catid=$_GET['cid'];
      $query="Delete from category where catid='$catid'";
      $go_query=mysqli_query($connection,$query);
      header("location:category.php");
    }
    function updatecat()
    {
    global $connection;
    $catname=$_POST['updatecategory'];
    $catid=$_GET['cid'];
    $query="update category set catname='$catname' where catid='$catid'";
    $go_query=mysqli_query($connection,$query);
    if(!$go_query)
    {
        die("Query Failed".mysqli_error($connection));
    }
    header("location:category.php");

    }
    function admin_login()
{
    global $connection;
    $useraname=$_POST['username'];//textbox name
    $password=$_POST['password'];//textbox name
    $hpass=md5($password);
    $query="Select * from user";
    $go_query=mysqli_query($connection,$query);
    while($out=mysqli_fetch_array($go_query))
    {
        $dbusername=$out['username'];//fieldname
        $dbuserpassword=$out['password'];
        $dbuserrole=$out['role'];
        if($dbusername==$useraname && $dbuserpassword==$hpass && $dbuserrole=='admin')
        {
            $_SESSION['admin']=$useraname;
            header('location:dashboard.php');
        }
        else
        {
            echo "<script>window.alert('Invalid Admin Name and password')</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
    }
}
function addproduct()
{
    global $connection;
    $productname=$_POST['txtproductname'];//textbox name
    $categoryid=$_POST['category'];//select name
    $price=$_POST['price'];//textbox name
    $quantity=$_POST['qty'];//textbox name
    $photo=$_FILES['photo']['name'];//file name
    if(is_numeric($price)==false)
    {
        echo "<script>window.alert('Please Enter Price is numeric value')</script>";
    }
    elseif(is_numeric($quantity)==false)
    {
        echo "<script>window.alert('Please Enter Product Quantity is numeric value')</script>";
    }
    elseif($photo=="")
    {
        echo "<script>window.alert('Choose Product Images')</script>";
    }
    elseif($productname!="" && $photo!="")
    {
        $query="Select * from product where productname='$productname'";
        $ch_query=mysqli_query($connection,$query);
        $count=mysqli_num_rows($ch_query);
        if($count>0)
        {
            echo"<script>window.alert('This Product is already exists')</script>";
        }
        else
        {
            $query="insert into product(productname,categoryid,price,Qty,photo) values('$productname','$categoryid','$price','$quantity','$photo')";
            $go_query=mysqli_query($connection,$query);
            if(!$go_query)
            {
                die("QUERY FAILED".mysqli_error($connection));
            }
            else
            {
                move_uploaded_file($_FILES['photo']['tmp_name'],'../Photo/'.$photo);
                header("location:productlist.php");
            }
        }
    }
}

function del_product()
{
    global $connection;
    $pid=$_GET['pid'];
    $query="Delete from product where productid='$pid' ";
    $go_query=mysqli_query($connection,$query);
    header("location:productlist.php");
}
function update_product()
{
    global $connection;
    $pid=$_GET['pid'];
    $productname=$_POST['productname'];
    $categoryid=$_POST['category'];
    $price=$_POST['price'];
    $quantity=$_POST['qty'];
    $photo=$_FILES['photo']['name'];
    if(!$photo)
    {
        $query="update product set productname='$productname',
        catid='$categoryid',price='$price',qty='$quantity' 
        where productid='$pid'";
    }
    else
    {
        $query="update product set productname='$productname',
        catid='$categoryid',price='$price',qty='$quantity',
        photo='$photo' where productid='$pid'";
    }
    $go_query=mysqli_query($connection,$query);
    if(!$go_query)
    {
        die("QUERY FAILED".mysqli_error($connection));
    }
    else
    {
        move_uploaded_file($_FILES['photo']['tmp_name'],'../Photo/'.$photo);
    }
    header("location:productlist.php");
}
?>

    
