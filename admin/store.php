<?php
require_once '../core.php';

if (!isset($_SESSION["adminid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["adminid"];

$waiterR = $db->query("SELECT * FROM admin WHERE id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);


$sql = "SELECT * FROM stock order by name ASC";
$results = $db->query($sql);

$results2 = $db->query("SELECT * FROM stock");
$error='';
if(isset($_POST['add_submit'])){
	
	$name = $_POST['stock'];
	$sql = "SELECT * FROM stock WHERE name = '$name'";
	$result = $db ->query($sql);
	$count = mysqli_num_rows($result);
	if($count > 0){
		$error = $name.' already exists, choose another stock name';
		
	}else{
	$db->query("INSERT INTO stock (name) VALUES ('$name')");
	header("Location: stock.php");
	}
	
}

if(isset($_POST['sub'])){
	$foodid = $_POST['id'];
	$qty = $_POST['qty'];
	$db->query("INSERT INTO `stockupdate` (stockid, quantity) VALUES ('$foodid', '$qty')");
	$db->query("UPDATE stock SET quantity = quantity + '$qty' WHERE id = '$foodid'");
	header("Location: stock.php");
}

if(isset($_GET['delete'])){
	$did = $_GET['delete'];
	$db->query("DELETE FROM stock WHERE id = '$did'");
	$db->query("DELETE FROM stockupdate WHERE stockid = '$did'");
	header("Location: stock.php");
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
    <div class="">

      <div class="">

       
        <h2 class="text-center">Store Items</h2><hr>
	<span style="COLOR: RED"><?=$error;?></span>
	<form class="form-inline" action="stock.php" method="post">
		<div class="form-group">
			<label for="stock">Name*:</label>
			<input type="text" class="form-control" name="stock" id="stock" required />
			<input type="submit" name="add_submit" value="Add Item" class="btn btn-success"/>
		</div>
		
		
	</form>
<hr>
<table class="table table-bordered stable-striped table-auto table-condensed">
	<thead>
		<th></th>
		<th>Name</th>
		<th>Total Quantity</th>
		<th></th>
		
	</thead>
	<tbody>
	<?php while($stock = mysqli_fetch_assoc($results)) : ?>
		<tr>
			<td><button type="button" class="btn btn-lg btn-default" onCLick="detailsmodal(<?= $stock['id']; ?>)">Update</button></td>
			<td><a href="viewstock.php?view=<?=$stock['id']; ?>" class="btn btn-xs btn-default"><?=$stock['name']; ?></a></td>
			<td><?=$stock['quantity']; ?></td>
			<td><a href="stock.php?delete=<?=$stock['id']; ?>" class="btn btn-xs btn-default">Delete<span class="glyphicon glyphicon-remove-sign"></span></a></td>
			
		</tr>
		<?php endwhile; ?>
	</tbody>
</table>
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
