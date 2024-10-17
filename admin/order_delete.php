
<?php
require_once "../server/connection.php";
include "header.php";
include "sidebarMenu.php";
?>
<?php
// Get the order ID from the request
$order_id = $_GET['order_id'];

// Prepare the SQL statement to delete the order
$stmt = $conn->prepare("DELETE FROM `orders` WHERE `order_id` = ?");
$stmt->bind_param("i", $order_id);

// Execute the query
if ($stmt->execute()) {
    echo "Product deleted successfully!";
    header("Location: index.php");
} else {
    echo "Error deleting order: " . $stmt->error;
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>
