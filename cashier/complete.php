<?php
require_once '../core.php';
if (!isset($_SESSION["cashierid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["cashierid"];

$waiterR = $db->query("SELECT * FROM staff WHERE type='cashier' and id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);

$error='';

if(isset($_POST['comp'])){
	$orderid = $_POST['order'];
	$total = $_POST['total'];
}

if(isset($_POST['done'])){
	$total= $_POST['total'];
	$rec= $_POST['rec'];
	$orderid= $_POST['orderid'];
	if($rec < $total){
		$error = 'Received less than total!';
	}else{
	$date = date("Y-m-d");
	$orderDS = $db->query("SELECT *, orderdetails.id as oid FROM `orderdetails` INNER JOIN food ON food.id = orderdetails.foodid
	WHERE orderdetails.orderid = '$orderid'");
	while($orderD = mysqli_fetch_assoc($orderDS)){
		$foodid2 = $orderD['foodid'];
		$quantity2 = $orderD['quantity'];
		echo $quantity2;
		$db->query("UPDATE `production` SET remainder = remainder - '$quantity2' WHERE foodid='$foodid2' AND date='$date'");
	}
	$change = 0;
	$change = $rec - $total;
	$time = date("Y-m-d H:i:s");
	$db->query("UPDATE `order` SET total = '$total', received = '$rec', `change` = '$change', timeofsale = '$time', status = '1' WHERE id='$orderid'");
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.open('print.php?order=$orderid');
		window.open('index.php','_self');
		</SCRIPT>");
	}
	
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
		<h3><span style="COLOR: RED"><?=$error;?></span></h3>
		<form action="complete.php" method="post">
			<div class="form-group col-md-8">	
				<label for="total"> <h2>Total: <?=$total;?></h2></label>
				<input type="hidden" name="total" id="total" value="<?=$total;?>" />
				<input type="hidden" name="orderid" id="orderid" value="<?=$orderid;?>" />
			</div>
			<div class="form-group col-md-8">	
				<label for="rec"> Received:</label>
				<input type="text" name="rec" id="rec" class="form-control" required />
			</div>
			<div class="form-group col-md-8">	
			<input type="submit" name="done" value="Confirm"  class="btn btn-success"/>
			</div>
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
