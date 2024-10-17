<?php
    //include('server/connection.php');
    session_start();
    if(isset($_POST['add_to_cart'])){
        // if user already added to cart
        if(isset($_SESSION['cart'])){
            $product_array_ids = array_column($_SESSION['cart'],"product_id");
            if(!in_array($_POST['product_id'],$product_array_ids)){
                $product_id = $_POST['product_id'];
             
                $product_array = array(
                                'product_id' => $_POST['product_id'],
                                'product_name' => $_POST['product_name'],
                                'product_price' => $_POST['product_price'],
                                'product_image' => $_POST['product_image'],
                                'product_quantity' => $_POST['product_quantity']
                );
                $_SESSION['cart'][$product_id]= $product_array;

            }else{
                echo'<script>alert("product was already to cart")</script>';
                //echo'<script>alert(window.location="index.php")</script>';
            }
        }
        // if this the first product
        else{
            $product_id =$_POST['product_id'];
            $product_name =$_POST['product_name'];
            $product_price =$_POST['product_price'];
            $product_image =$_POST['product_image'];
            $product_quantity =$_POST['product_quantity'];
    
            $product_array =array(
                            'product_id' => $product_id,
                            'product_name' => $product_name,
                            'product_price' => $product_price,
                            'product_image' => $product_image,
                            'product_quantity' => $product_quantity
            );
            $_SESSION['cart'][$product_id]= $product_array;
        }
         //update total
    calculatetotalcart();
    }
   
    else if(isset($_POST['remove_product'])){
        $product_id = $_POST['product_id'];
        unset($_SESSION['cart'][$product_id]);
        //update total
    calculatetotalcart();
    }
    elseif(isset($_POST['edit_quantity'])){
        $product_id = $_POST['product_id'];
        $product_quantity = $_POST['product_quantity'];
        $product_array = $_SESSION['cart'][$product_id];
        $product_array['product_quantity'] = $product_quantity;
        $_SESSION['cart'][$product_id]=$product_array;
        //update total
        calculatetotalcart();
    }else{
        //header('location: index.php');
        echo("not work");
    }



function calculatetotalcart(){
    $total_price = 0;
    $total_quantity = 0;
    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];
        $total_price = $total_price + ( $price * $quantity);
        $total_quantity = $total_quantity + $quantity;
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
}







?>







<?php include('header.php'); ?>
<!-- cart -->
<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="footer-widget-bolde"> Your Cart</h2>
        <hr>
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>SubTotal</th>
        </tr>
        <?php foreach($_SESSION['cart'] as $key => $value){?>

        <tr>
            <td>
                <div class="product-info">
                    <img src="assets/imgs/<?php echo $value['product_image']; ?>"/>
                    <div class="">
                        <p><?php echo $value['product_name']; ?></p>
                        <small><span>BDT </span><?php echo $value['product_price']; ?></small>
                        <br>
                        <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="submit" name="remove_product" class="remove-btn" value="remove">
                        </form>

                    </div>
                </div>
            </td>
            <td>
                
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                    <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                    <input type="submit" class="edit-btn" value="set" name="edit_quantity">
                </form>
                <!-- <a class="edit-btn" href="#">Edit</a> -->
            </td>
            <td>
                <span class="product-price"> <?php echo $value['product_quantity'] * $value['product_price']; ?></span>
            </td>
        </tr>

        <?php } ?>
    </table>


    <div class="cart-total">
        <table>
            <!-- <tr>
                <td>SubTotal</td>
                <td>BDT 36000</td>
            </tr> -->
            <tr>
                <td>Total</td>
                <td>$ <?php echo $_SESSION['total']; ?></td>
            </tr>
        </table>
    </div>

<div class="checkout-container">
    <form method="POST" action="checkout.php">

    <input type="submit" class="btn checkout-btn" value="CheckOut" name="checkout"></input>
    </form>
    
</div>





</section>



<!-- footer -->
<?php include('footer.php'); ?>
  
  </body>
  </html>
  