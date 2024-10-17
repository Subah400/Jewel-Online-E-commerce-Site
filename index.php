<?php include'header.php'; ?>

      <!-- home -->
      <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1> <span> Best Prices</span> This Season</h1>
            <p>Sameru Shop Offers The Best Products For The Most Affordable Prices</p>
            <button><a href="shop.html">Shop Now</button>
        </div>
        
      </section>

<!-- brand -->
<section id="brand" class="container">
<div class="row">
  <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand1.png" >
  <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand2.png" >
  <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand3.png" >
  <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/imgs/brand4.png" >

</div>
</section>

<!-- new -->
<section id="new" class="w-100">
  <div class="row p-0 m-0">
    <!-- one -->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/1.png" alt="">
      <div class="details">
        <h2>Best Bags</h2>
        <button class="test-uppercase" href="shop.html">Shop Now</button>
      </div>
    </div>
    <!-- two -->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/2.png" alt="">
      <div class="details">
        <h2>Best Dresses</h2>
        <button class="test-uppercase" href="shop.html">Shop Now</button>
      </div>
    </div>
    <!-- three -->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/imgs/3.png" alt="">
      <div class="details">
        <h2>50% OFF</h2>
        <button class="test-uppercase">Shop Now</button>
      </div>
    </div>
  </div>

</section>

<!-- Featured -->
<section id="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Featured</h3>
    <hr class="mx-auto">
    <p>Here You Can Check Out Featured Products</p>
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
      <h4 class="p-price">$ <?php echo $row['product_price']; ?></h4>
      <a href= <?php echo "single_product.php?product_id=". $row['product_id'];?>><button class="button button2">Buy Now</button></a>
    </div>

    <?php } ?>
  </div>
</section>


<!-- footer -->

<?php include('footer.php'); ?> 

</body>
</html>