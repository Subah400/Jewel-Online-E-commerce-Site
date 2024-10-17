<?php
include'header.php';
//include 'server/connection.php';
include'sidebarMenu.php';

?>
<?php if (!isset($_SESSION['admin_id'])) {
  header('location: login.php');
  exit();
}
 ?>

<?php
$stmt =$conn->prepare("SELECT * FROM orders");
$stmt->execute();
$orders = $stmt->get_result();    
?>

<h2>Orders</h2>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Order Id</th>
              <th scope="col">Order Status</th>
              <th scope="col">User ID</th>
              <th scope="col">Order Date</th>
              <th scope="col">User Phone</th>
              <th scope="col">User Address</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $order){ ?>
            <tr>
              <td> <?php echo $order ['order_id']; ?></td>
              <td><?php echo $order ['order_status']; ?></td>
              <td><?php echo $order ['user_id']; ?></td>
              <td><?php echo $order ['order_date']; ?></td>
              <td><?php echo $order ['user_phone']; ?></td>
              <td><?php echo $order ['user_address']; ?></td>
              <td><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id']; ?> ">Edit</a></td>
              <td><a class="btn btn-danger" href="order_delete.php?order_id=<?php echo $order['order_id']; ?> ">Delete</a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>

