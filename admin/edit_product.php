<?php
include "header.php";
include "sidebarMenu.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Product</title>
</head>
<body>
  <h1>Edit Product</h1>
  <?php
  // Fetch the product details from the database
  $productId = $_GET['product_id'];
  $connection = mysqli_connect('localhost', 'root', '', 'sameru');
  $query = "SELECT * FROM products WHERE product_id = $productId";
  $result = mysqli_query($connection, $query);
  $product = mysqli_fetch_assoc($result);
  ?>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> 
  <form action="update_product.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
    <label for="product_name">Product Name:</label>
    <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>"><br><br>
    <label for="product_category">Product Category:</label>
    <input type="text" name="product_category" value="<?php echo $product['product_category']; ?>"><br><br>
    <label for="product_description">Product Description:</label>
    <textarea name="product_description"><?php echo $product['product_description']; ?></textarea><br><br>
    <label for="product_image">Product Image:</label>
    <input type="file" name="product_image"><br><br>
    <label for="product_price">Product Price:</label>
    <input type="text" name="product_price" value="<?php echo $product['product_price']; ?>"><br><br>
    <label for="product_special_offer">Product Special Offer:</label>
    <input type="text" name="product_special_offer" value="<?php echo $product['product_special_offer']; ?>"><br><br>
    <label for="product_color">Product Color:</label>
    <input type="text" name="product_color" value="<?php echo $product['product_color']; ?>"><br><br>
    <input type="submit" value="Update Product">
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