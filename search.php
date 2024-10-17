<?php
include 'header.php';
?>

<!-- home -->
<section id="home">
    <div class="container">
        <h1>Search Products</h1>
    </div>

</section>


<form method="POST">
    <div class="input-group rounded">
        <input type="text" class="form-control rounded" placeholder="Search Products" aria-label="Search"
            aria-describedby="search-addon" name="searchCat">
        <button type="submit" name="search" class="btn btn-primary">Search</button>
    </div>
</form>






<!-- Featured -->
<section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">

        <hr class="mx-auto">
        <p>Here You Can Check Out Your Searched Products</p>
    </div>

    <div class="row mx-auto container-fluid">
        <?php include('server/categorical_products.php'); ?>
        <?php
        if (isset($_POST['search'])) {
            $searchcat = $_POST['searchCat'];
            $result = searchProducts($searchcat);
            if ($result->num_rows > 0) {

                foreach ($result as $results) { ?>

                    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $results['product_image']; ?>">
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="p-name">
                            <?php echo $results['product_name']; ?>
                        </h5>
                        <h4 class="p-price">$
                            <?php echo $results['product_price']; ?>
                        </h4>
                        <a href=<?php echo "single_product.php?product_id=" . $results['product_id']; ?>><button
                                class="button button2">Buy Now</button></a>
                    </div>
                    <?php
                }
            } else {
                echo "<h2>No matching results found</h2>";
            }

            ?>
        <?php } ?>
    </div>
</section>


<!-- footer -->

<?php include('footer.php'); ?>

</body>

</html>