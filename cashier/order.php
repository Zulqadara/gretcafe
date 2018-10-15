<?php
require_once '../core.php';

if (!isset($_SESSION["cashierid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["cashierid"];

$waiterR = $db->query("SELECT * FROM staff WHERE type='cashier' and id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);

if(isset($_GET['order'])){
$ordrid = $_GET['order'];
$orderS = $db->query("SELECT * FROM `order` WHERE id = '$ordrid'");
$order = mysqli_fetch_assoc($orderS);
$orderDS = $db->query("SELECT *, orderdetails.id as oid FROM `orderdetails` INNER JOIN food ON food.id = orderdetails.foodid WHERE orderdetails.orderid = '{$order['id']}'");
}

if(isset($_GET['del'])){
	$id = $_GET['del'];
	$ordrid = $_GET['order'];
	$db->query("DELETE FROM orderdetails WHERE id = '$id'");
	header('Location: order.php?order='.$ordrid.'');
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
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
            <li class="nav-item">
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
              <a class="nav-link" href="logout.php"><?=$waiter['name'];?>: Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
	<br>
	<br><br>
    <div class="container">
<h5>Order #: <small><?=$order['id'];?></small></h5>
<h5>Waiter ID:  <small><?=$order['waiterid'];?></small></h5>
<h5>Date and Time: <small><?=$order['datetime'];?></small></h5>
      <div class="row">

       
        <div class="col-md-12" align="center">
		<table class="table table-bordered table-condensed table-striped">
			<thead>
				<th>Food Name</th>
				<th>Quantity</th>
				<th>Total</th>
				<th></th>
				
			</thead>
			<tbody>
			<?php $sub_total=0; while($orderD = mysqli_fetch_assoc($orderDS)) :
				$orderID = $orderD['name'];
				$waiterID = $orderD['quantity'];
				$date = $orderD['total'];
			?>
				<tr>
					<td><?= $orderID ;?></td>
					<td><?= $waiterID ;?></td>
					<td><?= $date ;?></td>
					<td><a href="order.php?order=<?=$ordrid;?>&del=<?= $orderD['oid'];?>" class="btn btn-xs btn-default"><span>Remove</span></a></td>
				</tr>
			<?php $sub_total += ($orderD['price']*$orderD['quantity']); endwhile; ?>
			</tbody>
		</table>
		<h4>Total: <small><?=$sub_total ;?> </small></h4>
		
	<form action="complete.php" method="post">
	<input type="hidden" name="order" value="<?=$ordrid;?>"/>
	<input type="hidden" name="total" value="<?=$sub_total;?>"/>
	<a href="index.php" class="btn btn-lg btn-default">Cancel</a>
	<button type="submit" name = "comp" class="btn btn-lg btn-primary">Complete Order</button>
	</form>
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
