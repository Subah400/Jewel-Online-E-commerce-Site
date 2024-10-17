
<?php
require_once "../server/connection.php";
include "header.php";
include "sidebarMenu.php";
?>
<?php
// Get the product ID from the request
$product_id = $_GET['product_id'];

// Prepare the SQL statement to delete the product
$stmt = $conn->prepare("DELETE FROM `products` WHERE `product_id` = ?");
$stmt->bind_param("i", $product_id);

// Execute the query
if ($stmt->execute()) {
    echo "Product deleted successfully!";
    header("Location: products.php");
} else {
    echo "Error deleting product: " . $stmt->error;
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>
