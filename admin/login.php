<?php

session_start();
require_once "../server/connection.php";
if (isset($_SESSION['admin_id']) != "") {
header("Location: index.php");
}
if (isset($_POST['login'])) {
$email    = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$email_error = "Please Enter Valid Email ID";
}
if (strlen($password) < 6) {
$password_error = "Password must be minimum of 6 characters";
}
$result = mysqli_query($conn, "SELECT * FROM admins WHERE admin_email = '" . $email . "' and admin_password = '" . md5($password) . "'");
if ($row = mysqli_fetch_array($result)) {
$_SESSION['admin_id']     = $row['admin_id'];
$_SESSION['admin_name']   = $row['admin_name'];
//$_SESSION['admin_mobile'] = $row['mobile'];
$_SESSION['admin_email']  = $row['admin_email'];
header("Location: index.php");
} else {
$error_message = "Incorrect Email or Password!!!";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sameru | Admin Login</title>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-lg-10">
<div class="page-header">
<h2>Admin Login </h2>
</div>
<p>Please fill all fields in the form</p>
<span class="text-danger"><?php if (isset($error_message)) echo $error_message; ?></span>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="form-group ">
<label>Email</label>
<input type="email" name="email" class="form-control" value="" maxlength="30" required="">
<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
</div>
<div class="form-group">
<label>Password</label>
<input type="password" name="password" class="form-control" value="" maxlength="8" required="">
<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
</div>
<input type="submit" class="btn btn-primary" name="login" value="submit">
<br>
</form>
</div>
</div>
</div>
</body>
</html>