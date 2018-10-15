<?php
require_once '../core.php';

if (!isset($_SESSION["productionid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["productionid"];

$waiterR = $db->query("SELECT * FROM staff WHERE type='production' and id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);
$date = date("Y-m-d");
$sql = "SELECT * FROM food order by food.name ASC";

$results = $db->query($sql);
//if date is not today update

if(isset($_POST['sub'])){
	$foodid = $_POST['id'];
	$qty = $_POST['qty'];
	$sql = $db->query("SELECT * FROM production WHERE foodid = '$foodid' and date='$date'");
	$count = mysqli_num_rows($sql);
	if($count < 1){
		$db->query("INSERT INTO `production` (foodid, quantity, date, remainder) VALUES ('$foodid', '$qty', '$date', '$qty')");
	}else{
		$db->query("UPDATE production SET quantity = quantity + '$qty', remainder = remainder + '$qty' WHERE foodid = '$foodid'");
	}
	
	header("Location: index.php");
}

if(isset($_GET['delete'])){
	$date = date("Y-m-d");
	$did = $_GET['delete'];
	$db->query("DELETE FROM production WHERE foodid = '$did' and date = '$date'");
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gretsa University Cafeteria - Production</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/blog-home.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Gretsa University Cafeteria - Production</a>
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
    <div class="">

      <div class="">

       
        <h2 class="text-center">Menu Items</h2><hr>
			<hr>
			<table class="table table-bordered stable-striped table-auto table-condensed">
				<thead>
					<th></th>
					<th>Name</th>
					<th></th>
					
				</thead>
				<tbody>
				<?php while($stock = mysqli_fetch_assoc($results)) : ?>
					<tr>
						<td><button type="button" class="btn btn-lg btn-default" onCLick="detailsmodal(<?= $stock['id']; ?>)">View/Update</button></td>
						<td><?=$stock['name']; ?></td>
						<td><a href="index.php?delete=<?=$stock['id']; ?>" class="btn btn-xs btn-default">Delete<span class="glyphicon glyphicon-remove-sign"></span></a></td>
						
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
      </div>
	  <br>
      <!-- /.row -->

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
	<script>
		function detailsmodal(id){
	//"id":id = i want id from function bracket from above and it should be equal to id in quotes like below under
	var data = {"id" : id};
	jQuery.ajax({
		url : '/cafe/production/detailsmodal.php',
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
