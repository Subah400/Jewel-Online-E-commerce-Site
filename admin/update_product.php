<?php
// Get the form data
$productId = $_POST['product_id'];
$productName = $_POST['product_name'];
$productCategory = $_POST['product_category'];
$productDescription = $_POST['product_description'];
$productPrice = $_POST['product_price'];
$productSpecialOffer = $_POST['product_special_offer'];
$productColor = $_POST['product_color'];

// Handle the image upload
$productImage = $_FILES['product_image']['name'];
$productImageTmp = $_FILES['product_image']['tmp_name'];
$uploadDirectory = '../assets/imgs/';

// Update the product in the database
$connection = mysqli_connect('localhost', 'root', '', 'sameru');
$query = "UPDATE products SET product_name='$productName', product_category='$productCategory', product_description='$productDescription', product_price='$productPrice', product_special_offer='$productSpecialOffer', product_color='$productColor'";

if (!empty($productImage)) {
  // Remove the old image file
  $oldImageQuery = "SELECT product_image FROM products WHERE product_id = $productId";
  $oldImageResult = mysqli_query($connection, $oldImageQuery);
  $oldImage = mysqli_fetch_assoc($oldImageResult)['product_image'];
  unlink($uploadDirectory . $oldImage);

  // Upload the new image file
  $imageExtension = strtolower(pathinfo($productImage, PATHINFO_EXTENSION));
  $newImage = uniqid() . '.' . $imageExtension;
  move_uploaded_file($productImageTmp, $uploadDirectory . $newImage);

  $query .= ", product_image='$newImage'";
}

$query .= " WHERE product_id = $productId";
mysqli_query($connection, $query);

// Redirect back to the product list page
header("Location: products.php");
exit();
?>
