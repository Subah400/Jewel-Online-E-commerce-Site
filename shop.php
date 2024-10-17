<?php
include 'server/connection.php';
include 'header.php';
if (isset($_POST['search'])) {
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stmt1 = $conn->prepare("SELECT * FROM `products` WHERE product_category =? AND product_price<=?");
    $stmt1->bind_param("si", $category, $price);
    $stmt1->execute();
    $products = $stmt1->get_result();
} else {
    // 1. determine page number
    // $stmt = $conn->prepare("SELECT * FROM `products`");
    // $stmt->execute();
    // $products = $stmt->get_result();
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        $page_no = $_GET['page_no'];
    }else{
        $page_no = 1;
    }
    // 2. return the number of products
    $stmt2 = $conn->prepare("SELECT COUNT(*) as total_records FROM products");
    $stmt2->execute();
    $stmt2->bind_result($total_records);
    $stmt2->store_result();
    $stmt2->fetch();
    // 3. products per page
    $total_records_per_page = 8;
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);
    // 4. get all products
    $stmt3 = $conn->prepare("SELECT * FROM products ORDER BY RAND() LIMIT $offset,$total_records_per_page");
    $stmt3->execute();
    $products = $stmt3->get_result();
}

?>
<div class="shop-page">
    <section id="search" class="py-5 my-5 ms-2">
        <div class="container mt-5 py-5">
            <h4>Search Product</h4>
            <hr>
        </div>
        <form action="shop.php" method="POST">
            <div class="row mx-auto container">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <h4>Category</h4>
                    <?php
                    $categorySql = "SELECT DISTINCT product_category FROM products";
                    $categoryResult = $conn->query($categorySql);
                    if ($categoryResult->num_rows > 0) {
                        while ($categoryRow = $categoryResult->fetch_assoc()) {
                            $category = $categoryRow["product_category"];
                    ?>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="<?php echo $category ?>" name="category" id="category">
                                <label class="form-check-label" for="flexRadioDefault1"> <?php echo $category ?></label>

                            </div>



                    <?php }
                    } ?>
                </div>
            </div>


            <div class="row mx-auto container mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h4>Price</h4>
                    <input type="range" name="price" class="form-range w-50" min="1" max="1000" id="customRange2">
                    <div class="w-50">
                        <span style="float: left;">1</span>
                        <span style="float: right;">1000</span>
                    </div>

                </div>

            </div>





            <div class="form-group my-3 mx-3">
                <input type="submit" name="search" value="Search" class="btn btn-primary">
            </div>
        </form>
    </section>


    <!-- Shop -->

    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Latest Products</h3>
            <hr class="mx-auto">
            <p>Here You Can Check Out Our Latest products</p>
        </div>
        <div class="row mx-auto container-fluid">

            <?php while ($row = $products->fetch_assoc()) { ?>

                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']; ?>" alt="">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                    <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
                    <a href=<?php echo "single_product.php?product_id=" . $row['product_id']; ?>><button class="button button2">Buy Now</button></a>
                </div>
            <?php } ?>


            <nav aria-label="page navigation example">
                <ul class="pagination mt-5">
                    
                    <li class="page-item <?php if($page_no<=1){ echo 'disabled'; } ?>"> <a class="page-link" href="<?php if($page_no <= 1){ echo '#'; }else{ echo "?page_no=".$page_no-1; } ?>">Previous</a></li>



                    <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                    <li class="page-item"><a class="page-link" href="?page_n0=2">2</a></li>
                    <li class="page-item <?php if($page_no >= $total_no_of_pages){echo 'disabled';}?>"><a class="page-link" href="<?php if($page_no >= $total_no_of_pages){echo '#';}else{ echo "?page_no=".$page_no+1;} ?>">Next</a></li>
                </ul>

            </nav>
        </div>
    </section>
</div>


<?php include 'footer.php' ?>