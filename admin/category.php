<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<?php
session_start();
include 'connect.php';
include 'function.php';
if(isset($_POST['btnaddcat']))
{
    addcat();
}
if(isset($_GET['action'])&& $_GET['action']=='delete')
{
    delcat();
}
if(isset($_POST['btnupdatecategory']))
{
    updatecat();
}
?>
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
<div class="container">
<div class="row">
<div class="col-md-6">
    <div class="card">
        <div class="card-header text-center bg-info">
        Add Category
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">
                    Category Name
                    </label>
                    <input type="text" name="catname" class="form-control">
                </div>
                <div class="d-grid">
                    <input type="submit" name="btnaddcat" value="Add Category" class="btn btn-outline-info">
                </div>
            </form>       
        </div>
    </div>
    <hr>
    <?php
        if(isset($_GET['action'])&& $_GET['action']=='edit')
            {
                $catid=$_GET['cid'];
                $query="Select  * from category where catid='$catid'";
                $go_query=mysqli_query($connection,$query);
                while($out=mysqli_fetch_array($go_query))
                {
                    $catname=$out['catname'];//fieldname
    ?>
    <div class="card">
        <div class="card-header text-center bg-info">
        Update Category
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                <label for="" class="form-label">
                Category Name
                </label>
                <input type="text" name="updatecategory" class="form-control" value="<?php echo $catname  ?>">
                </div>
                <div class="d-grid">
                <input type="submit" name="btnupdatecategory" value="Update Category" class="btn btn-outline-info">
                </div>
            </form>          
        </div>
    </div>
    <?php
                }
            }
    ?>
</div>
<div class="col-md-6">
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>

        </tr>
        <?php
                    $go_query="Select  * from category";
                    $query=mysqli_query($connection,$go_query);
                    while($row=mysqli_fetch_array($query))
                    {
                        $catid=$row['catid'];//fieldname
                        $catname=$row['catname'];
                        
                        
                        echo "<tr>";
                        echo "<td>{$catid}</td>";
                        echo "<td>{$catname}</td>";
                       
                        echo "<td>
                                <a href='category.php?action=delete&cid={$catid}' class='btn btn-danger' onclick='return confirm('Are you sure?')'>Delete</a> ||
                                <a href='category.php?action=edit&cid={$catid}' class='btn btn-outline-success' >Edit</a>
                                </td>";
                        echo "</tr>";
                    }
                    ?>
    </table>
</div>
</div>
</div>
</body>
</html>