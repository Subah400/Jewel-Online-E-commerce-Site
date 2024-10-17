

<?php 
    session_start();
    if( !empty($_SESSION['cart']) && isset($_POST['checkout']) ){
        //let user in
    }else{
        //send user in home
        header('location: index.php');
    }
?>









<?php include('header.php'); ?>

<!-- checkout -->

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="footer-widget-bold">Check Out</h2>
        <hr class="mx-auto container">
    </div>
    <div class="mx-auto container">
        <form  id="checkout-form" method="POST" action="server/place_order.php">
            <div class="form-group checkout-small-element">
                <label for=""> Name</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group checkout-small-element">
                <label for=""> Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group checkout-small-element">
                <label for=""> Phone</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="phone" required>
            </div>
            <div class="form-group checkout-small-element">
                <label for=""> City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="city" required>
            </div>
            <div class="form-group checkout-large-element">
                <label for=""> address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
            </div>
            <div class="form-group checkout-btn-container">
                <p><h2>Total Amount: $ <?php echo $_SESSION['total'] ?></h2></p>
                <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order">
            </div>
        </form>
    </div>
</section>


<!-- footer -->
<?php include('footer.php'); ?>
  
  </body>
  </html>