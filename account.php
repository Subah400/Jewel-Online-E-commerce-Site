<?php
session_start();
include 'header.php';

if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
}
include 'server/connection.php';
if (isset($_POST['change_password'])) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];
    //if password is not match
    if ($password !== $confirm_password) {
        header('location: account.php?error=passwords dont match');
    }
    //if password is less than 6 characters
    else if (strlen($password) < 6) {
        header('location: account.php?error=password must be between 6 characters');
    }
    //no errors
    else {
        $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
        $stmt->bind_Param('ss', md5($password), $user_email);
        if ($stmt->execute()) {
            header('location: account.php?massage=password has been changed Successfully');
        } else {
            header('location: account.php?error=could not update password');
        }
    }
}


//get orders
if (isset($_SESSION['logged_in'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ");
    $stmt->bind_Param('i', $user_id);
    $stmt->execute();
    $orders = $stmt->get_result();
}
// Retrieve the existing user information from the database for pre-filling the form
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sameru";
// Create a new PDO instance
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
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
                <p><a href="#orders" id="order-btn">Your Orders</a></p>
                <p><a href="./logout.php" id="logout-btn">Logout</a></p>
            </div>
            <a href="./accountEdit.php" class="btn btn-danger btn-2">Edit Profile</a>
            <!-- <button class="btn btn-2">Edit Profile</a></button> -->
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <form id="account-form" method="POST" action="account.php">
                <p class="text-center" style="color:red"><?php if (isset($_GET['error'])) {
                                                                echo $_GET['error'];
                                                            } ?></p>
                <p class="text-center" style="color:green"><?php if (isset($_GET['massage'])) {
                                                                echo $_GET['massage'];
                                                            } ?></p>
                <h3>Change password</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" id="account-password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control" id="account-password-confirm" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="change_password" value="Change Password" class="btn" id="change-pass-btn">
                </div>
            </form>
        </div>
    </div>
</section>


<!-- order list -->
<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
        <h2 class="footer-widget-bolde text-center"> Your Orders</h2>
        <hr class="mx-auto">
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Order id</th>
            <th>Order Cost</th>
            <th>Order Status</th>
            <th>Order Date</th>
            <th>Order Details </th>
        </tr>
        <?php while ($row = $orders->fetch_assoc()) { ?>
            <tr>
                <td>
                    <div class="product-info">
                        <!-- <img src="assets/imgs/laptop1.png" alt="">
                            <div class="">
                                <p class="mt-3"><?php echo $row['order_id']; ?> </p>
                            </div> -->
                        <span><?php echo $row['order_id']; ?></span>
                    </div>
                </td>
                <td>
                    <span><?php echo $row['order_cost']; ?></span>
                </td>
                <td>
                    <span><?php echo $row['order_status']; ?></span>
                </td>
                <td>
                    <span><?php echo $row['order_date']; ?></span>
                </td>
                <td>
                    <form method="POST" action="order_details.php">
                        <input type="hidden" name="order_status" value="<?php echo $row['order_status']; ?>" />
                        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>" />
                        <input class="btn order-details-btn" type="submit" value="details" name="order_details_btn" />
                    </form>
                </td>
            </tr>
        <?php } ?>






    </table>





</section>
<!-- script -->
<script>
    function zoomImage() {
        var image = document.getElementById('myImage');
        image.classList.toggle('zoom-image');
    }
</script>
<!-- footer -->

<?php include('footer.php'); ?>

</body>

</html>