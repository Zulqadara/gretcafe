<?php
require_once '../core.php';

if (!isset($_SESSION["storeid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["storeid"];

$waiterR = $db->query("SELECT * FROM staff WHERE type='store' and id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);

$stockS2 = $db->query("SELECT * FROM stock WHERE quantity > 0 AND arch='0' ORDER BY name");
$error = '';
if(isset($_POST['rel'])){
	$relid = $_POST['name2'];
	$quantity = $_POST['quantity'];
	$stockS = $db->query("SELECT * FROM stock WHERE id='$relid'");
	$stock = mysqli_fetch_assoc($stockS);
	$qty = $stock['quantity'];
	if($quantity > $qty){
		$error = 'Released quantity is less than available quantity';
	}else{
	$db->query("UPDATE stock SET quantity = quantity - '$quantity' WHERE id = '$relid'");
	$db->query("INSERT into stockrelease (stockid, quantity) VALUES ('$relid','$quantity')");
	header ("Location: index.php");
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

    <title>Gretsa University Cafeteria - Store</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/blog-home.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Gretsa University Cafeteria - Store</a>
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
		<span style="COLOR: RED"><?=$error;?></span>
          <form action="index.php" method="post">
				 <div class="form-group col-md-6">
						<label for="name"> Name:</label>
						<select class="form-control" id="name2" name="name2" multiple required>
							<?php while($stock2 = mysqli_fetch_assoc($stockS2)): ?>
								<option value="<?=$stock2['id'];?>"><?=$stock2['name'];?> - <?=$stock2['quantity'];?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group col-md-6">
						<label for="quantity"> Quantity:</label>
						<input type="number" step=".01" min="0" name="quantity" id="quantity" class="form-control" required />
					</div>
						<input type="submit" name="rel" value="Release" class="btn btn-success"/>
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
