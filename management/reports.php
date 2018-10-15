<?php
require_once '../core.php';

if (!isset($_SESSION["managementid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["managementid"];

$waiterR = $db->query("SELECT * FROM management WHERE id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gretsa University Cafeteria - Management</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/blog-home.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Gretsa University Cafeteria - Management</a>
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

       
        <div class="col-md-12" align="center">
		<br><br>
           <a href="daily.php" class="btn btn-success">Daily Sales</a><br><br>
		   <a href="month.php" class="btn btn-success">Monthly Sales</a><br><br>
		   <a href="waiter.php" class="btn btn-success">Activities per Waiter</a><br><br>
		   <a href="sales.php" class="btn btn-success">Sales Ranking</a><br><br>
		   <a href="outofstock.php" class="btn btn-success">Out of Stock Menu Items</a><br><br>
		   <a href="stock2.php" class="btn btn-success">Daily Stock Movement</a><br><br>
		    <a href="production.php" class="btn btn-success">Production vs Sales</a><br><br>
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
