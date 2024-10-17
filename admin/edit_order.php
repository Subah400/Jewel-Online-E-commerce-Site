<?php
include "header.php";
include "sidebarMenu.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Order</title>
</head>
<body>
  <h1>Edit Order</h1>
  <?php
  // Fetch the product details from the database
  $orderId = $_GET['order_id'];
  $connection = mysqli_connect('localhost', 'root', '', 'sameru');
  $query = "SELECT * FROM orders WHERE order_id = $orderId";
  $result = mysqli_query($connection, $query);
  $order = mysqli_fetch_assoc($result);
  ?>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> 
  <form action="update_order.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
    <label for="order_status">Order Status:</label>
    <input type="text" name="order_status" value="<?php echo $order['order_status']; ?>"><br><br>
    <label for="user_id">Product Category:</label>
    <input type="text" name="user_id" value="<?php echo $order['user_id']; ?>"><br><br>
    <label for="order_date">Order Date:</label>
    <textarea name="order_date"><?php echo $order['order_date']; ?></textarea><br><br>
    <label for="user_phone">User Phone:</label>
    <input type="text" name="user_phone" value="<?php echo $order['user_phone']; ?>"><br><br>
    <label for="user_address">User Address:</label>
    <input type="text" name="user_address" value="<?php echo $order['user_address']; ?>"><br><br>
    <input type="submit" value="Update Order">
  </form>
  </main>
</body>
</html>
<style>
   h1{
    text-align: center;
   }
form {
  max-width: 500px;
  margin: 0 auto;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="file"] {
  width: 100%;
  padding: 5px;
  margin-bottom: 10px;
}

input[type="submit"] {
  padding: 10px 20px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

</style>