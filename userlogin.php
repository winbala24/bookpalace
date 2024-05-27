<?php
session_start();
include 'userfunction.php';
include 'admin/connect.php';
if(isset($_POST['login']))
{
    user_login();
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
    include 'userheader.php';
?>
<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
<div class="card-header">
<h3 class="text-center">Login</h3>
</div>
<div class="card-body">
<form action="#" method="post">
<div class="mb-3">
<label for="" class="form-label">User Name</label>
<input type="text" name="username" id="" class="form-control" required>
</div>
<div class="mb-3">
<label for="" class="form-label">Password</label>
<input type="password" name="password" id="" class="form-control" required>
</div>
<div class="mb-3">
<button type="submit" class="btn btn-info w-100" name="login">Login</button>
</div>
 
                        </form>
</div>
</div>
</div>
 
        </div>
</div>
</body>
</html>