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
           <form class="form-inline" action="production.php" method="post">
		   <div class="form-group">
		   <input type="date" name="dp" id="dp" class="form-control"/>
		   <button name="sub" class="btn btn-success">Submit</button>
		   </div>
		   </form>
		   <?php
		   if(isset($_POST['sub'])):
				$date = $_POST['dp'];
				$year = date("Y",  strtotime($date));
				$month = date("m",  strtotime($date));
				$day = date("d",  strtotime($date));
				   
				$qu1 = $db->query("select name, sum(orderdetails.quantity) as q, (production.quantity) from orderdetails inner join `order` on `order`.id = orderdetails.orderid
inner join food on food.id = orderdetails.foodid
inner join production on production.foodid = orderdetails.foodid
where day(date)=$day and month(date)=$month and year(date)=$year and `order`.status = 1
and day(datetime)=$day and month(datetime)=$month and year(datetime)=$year
  group by production.id");
        ?>
				<div class="col-md-12">       
					<h2 class="text-center">Produced Items vs Sold Items</h2><hr>
						<table class="table table-bordered stable-striped table-auto table-condensed">
							<thead>
								<th>Item Name</th>
								<th>Quantity Produced</th>
								<th>Quantity Sold</th>
								<th>Balance</th>
								
							</thead>
							<tbody>
							<?php while($res1 = mysqli_fetch_assoc($qu1)) : ?>
								<tr>
									<td><?=$res1['name']; ?></td>
									<td><?=$res1['quantity']; ?></td>			
									<td><?=$res1['q']; ?></td>	
									<td><?=$res1['quantity']-$res1['q']; ?></td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
				</div>
<form method="post" action="productionp.php" target="_blank">
				<input type="hidden" name="date" value="<?=$date;?>" />
				<button class="btn btn-success btn-lg" name="print" type="submit">Print</button>
				</form>
				<br>
<?php endif; ?>
<a class="btn btn-primary btn-lg" href="reports.php">Back</a>
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
