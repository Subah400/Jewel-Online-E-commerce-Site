
<?php
require_once "../server/connection.php";
include "header.php";
include "sidebarMenu.php";
?>
<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the product information from the form
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];

    // Validate the form data
    // Add your validation logic here
    $errors = array();

    // Perform necessary validation checks
    if (empty($product_name)) {
        $errors[] = "Product name is required.";
    }
    if (empty($product_category)) {
        $errors[] = "Product Category is required.";
    }
    if (empty($product_price) || !is_numeric($product_price)) {
        $errors[] = "Valid price is required.";
    }

    // If there are validation errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // Handle the file upload and store the image
        $targetDir = "../assets/imgs/"; // Specify the directory to store the uploaded images
        $fileName = uniqid() . "_" . $_FILES['product_image']['name']; // Generate a unique filename
        $targetFilePath = $targetDir . $fileName; // Path to store the uploaded image

        // Check if the file is a valid image
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Only JPG, JPEG, and PNG files are allowed.";
        } else {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFilePath)) {
                // Insert the product into the database
                $stmt = $conn->prepare("INSERT INTO `products` (`product_name`, `product_category` ,`product_price`, `product_description`, `product_image`) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("ssdss", $product_name, $product_category, $product_price, $product_description, $fileName);

                if ($stmt->execute()) {
                    header('location: add_new_product.php?message=Product added successfully');
                    echo "Product added successfully!";
                } else {
                    echo "Error adding product: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                header('location: add_new_product.php?error=could not uploading the image');
                // echo "Error uploading the image.";
            }
        }
    }
}

// Close the database connection
$conn->close();
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<!-- HTML form to add a new product with an image -->
<form action="add_new_product.php" method="post" enctype="multipart/form-data">
<P style="color: red " class="text-center" ><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></P>
<P style="color: green " class="text-center" ><?php if(isset($_GET['message'])){ echo $_GET['message']; } ?></P>
<div class="container">

<label for="product_name">Product Name:</label>
    <input type="text" name="product_name" required>
    <label for="product_category">Product Category:</label>
    <input type="text" name="product_category" required>
    <label for="product_price">Product Price:</label>
    <input type="number" name="product_price" step="0.01" required>
    <label for="product_description">Product Description:</label>
    <textarea name="product_description"></textarea>
    <label for="product_image">Product Image:</label>
    <input type="file" name="product_image" required>
    <input type="submit" value="Add Product">
</div>
    
</form>
</main>

<style>
    
    .container {
  width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  background-color: #f9f9f9;
}

h2 {
  text-align: center;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"] {
  width: 100%;
  padding: 20px;
  margin-bottom: 10px;
}

input[type="submit"] {
  width: 100%;
  margin-top: 20px;
  padding: 10px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}
</style>