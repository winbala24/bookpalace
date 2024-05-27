<?php
session_start();
include 'admin/connect.php';
include 'userfunction.php';
 
if (isset($_POST['register'])) //register button name
{
    $user_name = $_POST['username'];//textbox name
    $password = $_POST['password'];//textbox name
    $confirm_password = $_POST['confirmpassword'];//textbox name
    $email = $_POST['email'];//textbox name
    $phone = $_POST['phone'];//textbox name
    $address = $_POST['address'];//textbox name
 
    $errors = array(
        'username' => '',
        'password' => '',
        'confirm_password' => '',
        'match_password' => '',
        'email' => '',
        'phone' => '',
        'address' => '',
    );
 
    if (empty($user_name)) {
        $errors['username'] = 'User Name must be entered';
    } else {
        if (strlen($user_name) < 3) {
            $errors['username'] = 'User Name needs to be longer';
        }
    }
 
    if (empty($password)) {
        $errors['password'] = 'This field could not be empty';
    } else {
        if (strlen($password) < 3) {
            $errors['password'] = 'Password needs to be longer';
        }
    }
 
    if (empty($confirm_password)) {
        $errors['confirm_password'] = 'This Field could not be empty';
    } else {
        if ($password != $confirm_password) {
            $errors['match_password'] = 'Password Do not match';
        }
    }
 
    if (empty($email)) {
        $errors['email'] = 'This field could not be empty';
    }
 
    if (empty($phone)) {
        $errors['phone'] = 'This field could not be empty';
    }
 
    if (empty($address)) {
        $errors['address'] = 'This field could not be empty';
    }
 
    foreach ($errors as $key => $value) {
        if (empty($value)) {
            unset($errors[$key]);
        }
    }
 
    if (empty($errors)) {
        create_accu();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'userheader.php'; ?>
    <div class="container ">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
            <div class="card">
            <div class="card-header">
            <h3 class="text-center">Registration</h3>
    </div>
    <div class="card-body">
    <form action="#" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" name="username" value="<?php echo isset($user_name) ? $user_name : ''; ?>"
                                    class="form-control" id="username" placeholder="Enter user name"/>
                <label class="text-danger"><?php echo isset($errors['username']) ? $errors['username'] : ''; ?> </label>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
            <input type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>"
                                    class="form-control" id="password" placeholder="Enter Password"/>
        <label class="text-danger"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?> </label>
    </div>
    <div class="mb-3">
        <label for="confirmpassword" class="form-label">Confirm Password</label>
            <input type="password" name="confirmpassword"
                                    value="<?php echo isset($confirm_password) ? $confirm_password : ''; ?>"
                                    class="form-control" id="confirmpassword" placeholder="Enter Password again"/>
        <label class="text-danger"><?php echo isset($errors['confirm_password']) ? $errors['confirm_password'] : ''; ?> </label>
        <label class="text-danger"><?php echo isset($errors['match_password']) ? $errors['match_password'] : ''; ?> </label>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
            <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>"
                                    class="form-control" id="email" placeholder="Enter your email"/>
            <label class="text-danger"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?> </label>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>"
                                    class="form-control" id="phone" placeholder="Enter your Phone Number"/>
        <label class="text-danger"><?php echo isset($errors['phone']) ? $errors['phone'] : ''; ?> </label>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
            <textarea name="address" class="form-control"
                                        placeholder="Your Current Address"><?php echo isset($address) ? $address : ''; ?></textarea>
        <label class="text-danger"><?php echo isset($errors['address']) ? $errors['address'] : ''; ?> </label>
    </div>
    <div class="d-grid"><button type="submit" class="btn btn-primary" name="register">Register</button></div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
</body>
</html>