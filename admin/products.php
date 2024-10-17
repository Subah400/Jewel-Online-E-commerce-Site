<?php
include'header.php';
require_once "../server/connection.php";
?>
<?php include'sidebarMenu.php'; ?>
<?php
$stmt =$conn->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->get_result();    
?>
<h2>Products</h2>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

      <div class="table-responsive">
     

<table class="table table-striped table-sm ">
          <thead>
            <tr>
              <th scope="col">Product Id</th>
              <th scope="col">Product Name</th>
              <th scope="col">Product Category</th>
              <th scope="col">Product Description</th>
              <th scope="col">Product Image</th>
              <th scope="col">Product Price</th>
              <th scope="col">Product Color</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product){ ?>
            <tr>
              <td> <?php echo $product ['product_id']; ?></td>
              <td><?php echo $product ['product_name']; ?></td>
              <td><?php echo $product ['product_category']; ?></td>
              <td><?php echo $product ['product_description']; ?></td>
              <td><img src=" <?php echo "../assets/imgs/". $product['product_image']; ?>" style="width: 70px; height:70px" ></td>
              <td><?php echo $product ['product_price']; ?></td>
              <td><?php echo $product ['product_color']; ?></td>
              <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id']; ?> ">Edit</a></td>
              <td><a class="btn btn-danger" href="product_delete.php?product_id=<?php echo $product['product_id']; ?> ">Delete</a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
</main>




    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>













