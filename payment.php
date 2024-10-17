

<?php 
    session_start();
    include'server/connection.php';
?>






<?php include('header.php'); ?>

<!-- checkout -->

<!-- <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="footer-widget-bold">Payment</h2>
        <hr class="mx-auto container">
    </div>
    <div class="mx-auto container text-center">
        <p><?php echo $_GET['order_status']; ?></p>
        <p>Total Payment: BDT <?php echo $_SESSION['total']; ?></p>
        <input class="btn btn-primary" type="submit" value="Pay Now">
        
    </div>
</section> -->

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Payment</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center">



    <?php if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid"){ ?>
            <?php $amount= strval($_POST['order_total_price']);?>

            <?php $order_id  = $_POST['order_id']; ?>
        <p>Total Payment: $ <?php echo $_POST['order_total_price']; ?></p>
                    <!-- <input class="btn btn-primary" type="submit" value="Pay Now"/> -->
                    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>







        <?php } else if(isset($_SESSION['total'])&& $_SESSION['total']!=0) {?>
            <?php $amount= strval( $_SESSION['total']);?>
            <?php $order_id = $_SESSION['order_id']; ?>
            <p>Total Payment: $ <?php echo $_SESSION['total']; ?></p>
        <!-- <input class="btn btn-primary" type="submit" value="Pay Now" /> -->
        <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>


        


                    <?php }else {?>
                        <p>You don't have An order</p>
                    <?php } ?>


      
    </div>
</section>

    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=Ae6L1Rwntsr-xHdlj6OsqR7m6oqFYfq85wHZ0BJYdggqXf_mUdwCOaF-XBdneVRRE0lr1sACTDnxxlKq&currency=USD"></script>
    <!-- Set up a container element for the button -->
    <!-- <div id="paypal-button-container"></div> -->

<script>
    paypal.Buttons({
        createOrder: function(data, actions){
            return actions.order.create({
                purchase_units:[{
                    amount:{
                        value: '<?php echo $amount  ?>'
                    }
                }]
            });
        },
        onApprove: function(data, actions){
            return actions.order.capture().then(function(orderData){
                console.log('capture result',orderData,JSON.stringify(orderData,null,2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('transaction' + transaction.status + ':' + transaction.id + '\n\nSee console for all available transactions details');
                window.location.href ="server/complete_payment.php?transaction_id=" + transaction.id+"&order_id="+ <?php echo $order_id; ?>;
            });
        }
    }).render('#paypal-button-container');
</script>



















<!-- footer -->
<?php include('footer.php'); ?>
  </body>
  </html>