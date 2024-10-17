
<?php
include('server/connection.php');
if(isset($_GET['product_id']))
{
    $product_id =$_GET['product_id'];
    $stmt=$conn->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt->bind_param("i",$product_id);
    $stmt->execute();
    $product = $stmt->get_result();
}
else{
    header('location: index.php');
}

?>

<?php include('header.php'); ?>


      <!-- single product -->

      <section class="single-product my-5 pt-5">
        <div class="row mt-5">
            <?php while($row =$product->fetch_assoc()){ ?>
                
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo$row['product_image']; ?>" alt="">
                <div class="small-img-group">
                    
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo$row['product_image2']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo$row['product_image3']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="assets/imgs/<?php echo$row['product_image4']; ?>" width="100%" class="small-img" alt="">
                    </div>
                </div>
            </div>
            

            <div class="col-lg-6 col-md-12 col-sm-12">
                <h6>Products</h6>
                <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                <h2>$ <?php echo$row['product_price']; ?></h2>

                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                    <input type="number" name="product_quantity" value="1">
                    <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
                </form>



               
                <h4 class="mt-5 mb-5">Key Features</h4>
                <span><?php echo$row['product_description']; ?></span>
            </div>
           
            <?php } ?>
        </div>
      </section>


      <!-- Featured -->
<section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Relative Products</h3>
      <hr class="mx-auto">
    </div>


      <div class="row mx-auto container-fluid">
<?php include('server/get_featured_products.php'); ?>
<?php while($row =$featured_products ->fetch_assoc()){ ?>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>">
      <div class="star">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
      </div>
      <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
      <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
      <a href= <?php echo "single_product.php?product_id=". $row['product_id'];?>><button class="button button2">Buy Now</button></a>
    </div>

    <?php } ?>
  
      
    </div>
  </section>



<!-- footer -->

<?php include ('footer.php'); ?>
  


<script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for(let i=0;i<4;i++)
    {
        smallImg[i].onclick = function(){
        mainImg.src = smallImg[0].src;
    }
    }





</script>  








  </body>
  </html>