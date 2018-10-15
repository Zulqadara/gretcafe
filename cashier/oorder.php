<?php
require_once '../core.php';

if (!isset($_SESSION["cashierid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["cashierid"];

$waiterR = $db->query("SELECT * FROM staff WHERE type='cashier' and id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);

$menuS = $db->query("SELECT * FROM `food` ORDER BY name ASC");

if(isset($_GET['out'])){
	$outid = (int)$_GET['out'];	
	$sql2 = "UPDATE food SET available = 'No' WHERE id = '$outid'";
	$editresult = $db ->query($sql2);
	$db ->query("INSERT INTO outoforder (foodid) VALUES ('$outid')");
	header("Location: oorder.php");
}

if(isset($_GET['in'])){
	$outid = (int)$_GET['in'];	
	$sql2 = "UPDATE food SET available = 'Yes' WHERE id = '$outid'";
	$editresult = $db ->query($sql2);
	header("Location: oorder.php");
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
			  <li class="nav-item active">
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
		<table class="table table-bordered stable-striped table-auto table-condensed">
	<thead>
		
		<th>Name</th>
		<th>Type</th>
		<th>Availability</th>
		<th></th>
		
	</thead>
	<tbody>
	<?php while($food = mysqli_fetch_assoc($menuS)) : ?>
		<tr>
			<td><?=$food['name']; ?></td>
			<td><?=$food['type']; ?></td>
			<td><?=$food['available']; ?></td>
			<td><a href="oorder.php?in=<?=$food['id']; ?>" class="btn btn-xs btn-default">In<span class="glyphicon glyphicon-remove-sign"></span></a>
			<a href="oorder.php?out=<?=$food['id']; ?>" class="btn btn-xs btn-default">Out<span class="glyphicon glyphicon-remove-sign"></span></a>
			</td>
			
			
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
