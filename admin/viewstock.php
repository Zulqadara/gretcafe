<?php
require_once '../core.php';

if (!isset($_SESSION["adminid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["adminid"];

$waiterR = $db->query("SELECT * FROM admin WHERE id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);

if(isset($_GET['view'])){
	$vid = $_GET['view'];
	$results = $db->query("SELECT * FROM stock JOIN stockupdate on stock.id = stockupdate.stockid WHERE stock.id = '$vid'");
	$results2 = $db->query("SELECT * FROM stock JOIN stockrelease on stock.id = stockrelease.stockid WHERE stock.id = '$vid'");
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gretsa University Cafeteria - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/blog-home.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Gretsa University Cafeteria - Admin</a>
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

<div class="col-md-6">       
        <h2 class="text-center">Store Items Update History</h2><hr>
<table class="table table-bordered stable-striped table-auto table-condensed">
	<thead>
		<th>Name</th>
		<th>Quantity</th>
		<th>Date Updated</th>
		
	</thead>
	<tbody>
	<?php while($stock = mysqli_fetch_assoc($results)) : ?>
		<tr>
			<td><?=$stock['name']; ?></td>
			<td><?=$stock['quantity']; ?></td>			
			<td><?=$stock['date']; ?></td>	
		</tr>
		<?php endwhile; ?>
	</tbody>
</table>
</div>

<div class="col-md-6">       
        <h2 class="text-center">Store Items Release History</h2><hr>
<table class="table table-bordered stable-striped table-auto table-condensed">
	<thead>
		<th>Name</th>
		<th>Quantity</th>
		<th>Date Released</th>
		
	</thead>
	<tbody>
	<?php while($stock2 = mysqli_fetch_assoc($results2)) : ?>
		<tr>
			<td><?=$stock2['name']; ?></td>
			<td><?=$stock2['quantity']; ?></td>			
			<td><?=$stock2['date']; ?></td>	
		</tr>
		<?php endwhile; ?>
	</tbody>
</table>
</div>
	  <br>
      <!-- /.row -->
</div>
     	<div class="">
<a class="btn btn-primary btn-lg" href="stock.php">Back</a>
</div> 
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
	<script>
		function detailsmodal(id){
	//"id":id = i want id from function bracket from above and it should be equal to id in quotes like below under
	var data = {"id" : id};
	jQuery.ajax({
		url : '/cafe/admin/detailsmodal.php',
		method : "post",
		data : data,
		success : function(data){
			jQuery('body').prepend(data);
			jQuery('#details-modal').modal('toggle');
		},
		error : function(){
			alert("Something went wrong");
		}
	});
}
	</script>
  </body>

</html>
