<?php
session_start();
include './server/connection.php';
include './header.php';
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sameru";

// Create a new PDO instance
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user information from the form
    $user_id = $_SESSION['user_id']; // Replace with the actual user ID
    $fieldsToUpdate = array();

    
    $sql = "SELECT * FROM users WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    // Retrieve the form values and compare with the existing values
    $name = $_POST["name"];
    if (!empty($name) && $name !== $existingUser["user_name"]) {
        $fieldsToUpdate["user_name"] = $name;
    }

    $number = $_POST["number"];
    if (!empty($number) && $number !== $existingUser["user_number"]) {
        $fieldsToUpdate["user_number"] = $number;
    }

    $address = $_POST["address"];
    if (!empty($address) && $address !== $existingUser["user_address"]) {
        $fieldsToUpdate["user_address"] = $address;
    }

    $state = $_POST["state"];
    if (!empty($state) && $state !== $existingUser["user_state"]) {
        $fieldsToUpdate["user_state"] = $state;
    }

    $zip = $_POST["zip"];
    if (!empty($zip) && $zip !== $existingUser["user_zip"]) {
        $fieldsToUpdate["user_zip"] = $zip;
    }

    // Update user information in the database
    if (!empty($fieldsToUpdate)) {
        $sql = "UPDATE users SET ";
        $params = array();

        foreach ($fieldsToUpdate as $field => $value) {
            $sql .= $field . "=?, ";
            $params[] = $value;
        }

        $sql = rtrim($sql, ", ");
        $sql .= " WHERE user_id=?";
        $params[] = $user_id;

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        // Display success message
        echo "User information updated successfully!";
    } else {
        // Display message if no fields were updated
        echo "No fields were updated.";
    }
}

// Retrieve the existing user information from the database for pre-filling the form
$user_id = $_SESSION['user_id']; // Replace with the actual user ID
$sql = "SELECT * FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Account</title>
</head>

<body>

    <!-- account -->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 col-lg-6 col-md-12 col-sm-12">
                <h3 class="font-weight-bold">Account Info</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name : <span> <?php echo $user['user_name']; ?></span></p>
                    <p>Email : <span><?php echo $user['user_email']; ?></span></p>
                    <p>Mobile Number : <span><?php echo $user['user_number']; ?></span></p>
                    <p>Address : <span><?php echo $user['user_address']; ?></span></p>
                    <p>State : <span><?php echo $user['user_state']; ?></span></p>
                   
                    
                    <p><a href="./logout.php" id="logout-btn">Logout</a></p>
                </div>
                <a href="./account.php" class="btn btn-danger btn-2">Account</a>
                <!-- <button class="btn btn-2">Edit Profile</a></button> -->
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="post" enctype="multipart/form-data">
                <h3>Update Your Information</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $user['user_name']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="number">Phone Number:</label>
                        <input type="text" class="form-control" name="number" id="number" value="<?php echo $user['user_number']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" id="address" value="<?php echo $user['user_address']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="state">State:</label>
                        <input type="text" class="form-control" name="state" id="state" value="<?php echo $user['user_state']; ?>">
                    </div>

                  

                    <input type="submit" class="btn" id="change-pass-btn" value="Save">
                </form>

            </div>
        </div>
    </section>
</body>

</html>