<?php
require_once '../core.php';
$page = $_SERVER['PHP_SELF'];
$sec = "10";
if (!isset($_SESSION["cashierid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["cashierid"];

$waiterR = $db->query("SELECT * FROM staff WHERE type='cashier' and id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);

$orderS = $db->query("SELECT *, order.id as oid FROM `order` inner join staff on staff.id = order.waiterid where `order`.status = 0 order by `order`.id DESC");

if(isset($_GET['del'])){
	$id = $_GET['del'];
	$db->query("DELETE FROM `order` WHERE id = '$id'");
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
 <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gretsa University Cafeteria - Cashier</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/blog-home.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Gretsa University Cafeteria - Cashier</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
         <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
			  <li class="nav-item">
              <a class="nav-link" href="oorder.php">Out of Stock
                <span class="sr-only">(current)</span>
              </a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="menu.php">Take Order
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php"><?=$waiter['name'];?>: Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
	<br>
    <div class="container">

      <div class="row">
<br><br>
       
        <div class="col-md-12" align="center">
		<table class="table table-bordered table-condensed table-striped">
			<thead>
				<th></th>
				<th>Order #</th>
				<th>Staff ID</th>
				<th>Date and Time</th>
				<th></th>
			</thead>
			<tbody>
			<?php while($order = mysqli_fetch_assoc($orderS)) :
				$orderID = $order['oid'];
				$waiterID = $order['waiterid'];
				$date = $order['datetime'];
			?>
				<tr>
					<td><a href="index.php?del=<?= $order['oid'];?>" class="btn btn-xs btn-default"><span>Delete</span></a></td>
					<td><?= $orderID ;?></td>
					<td><?= $waiterID ;?> - <?=$order['name'];?></td>
					<td><?= $date ;?></td>
					<td><a href="order.php?order=<?= $order['oid'];?>" class="btn btn-xs btn-default"><span>Process</span></a></td>
				</tr>
			<?php endwhile; ?>
			</tbody>
		</table>
          
        </div>

      </div>
	  <br>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Gretsa University Cafeteria 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
