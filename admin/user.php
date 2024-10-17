<?php
require_once "../server/connection.php";
include "header.php";
include "sidebarMenu.php";
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<?php

// Fetch user data from the database
$query = "SELECT * FROM `users`";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Loop through each row of user data
    while ($row = $result->fetch_assoc()) {
        $user_id = $row["user_id"];
        $user_name = $row["user_name"];
        $user_email = $row["user_email"];
        // ... additional user data fields

        // Process or display the user data as needed
        echo "User ID: " . $user_id . "<br>";
        echo "Username: " . $user_name . "<br>";
        echo "Email: " . $user_email . "<br>";
        // ... additional user data fields

        echo "<hr>"; // Add a horizontal line separator between each user's data
    }
} else {
    echo "No users found in the database.";
}

// Close the database connection
$conn->close();
?>
</main>
