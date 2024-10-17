<?php
// Get the form data
$order_id = $_POST['order_id'];
$order_status = $_POST['order_status'];
$user_id = $_POST['user_id'];
$order_date = $_POST['order_date'];
$user_phone = $_POST['user_phone'];
$user_address = $_POST['user_address'];


// Update the product in the database
$connection = mysqli_connect('localhost', 'root', '', 'sameru');
$query = "UPDATE orders SET order_id='$order_id', order_status='$order_status', user_id='$user_id', order_date='$order_date', user_phone='$user_phone', user_address='$user_address'";


$query .= " WHERE order_id = $order_id";
mysqli_query($connection, $query);

// Redirect back to the product list page
header("Location: index.php");
exit();
?>
