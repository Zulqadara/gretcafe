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
           <form class="form-inline" action="daily.php" method="post">
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
				
				$qu = $db->query("SELECT SUM(total) as sum, COUNT(*) as count, DAY(datetime) as day, MONTH(datetime) as month , YEAR(datetime) as year FROM `order` WHERE DAY(datetime)=$day AND MONTH(datetime)=$month AND YEAR(datetime)=$year  AND `order`.status = 1
				   GROUP BY YEAR(datetime), MONTH(datetime), DAY(datetime);");
				$res = mysqli_fetch_assoc($qu);
				
				$qu2 = $db->query("SELECT SUM(price * stockrelease.quantity) as sum  FROM `stockrelease` 
inner join stock on stock.id = stockrelease.stockid
WHERE DAY(stockrelease.date)=$day AND MONTH(stockrelease.date)=$month AND YEAR(stockrelease.date)=$year
GROUP BY YEAR(stockrelease.date), MONTH(stockrelease.date), DAY(stockrelease.date);");
				$res2 = mysqli_fetch_assoc($qu2);  
				
				$qu1 = $db->query("select *, orderdetails.total as sum from `order` inner join orderdetails on orderdetails.orderid = `order`.id
					inner join food on food.id = orderdetails.foodid
					 WHERE DAY(datetime)=$day AND MONTH(datetime)=$month AND YEAR(datetime)=$year AND `order`.status = 1");
				
				
        ?>
		
				<div class="col-md-6">       
					<h2 class="text-center">Daily Sales Overview</h2><hr>
						<table class="table table-bordered stable-striped table-auto table-condensed">
							<thead>
								<th>Amount Sold</th>
								<th>Date</th>
								<th>Revenue</th>
								<th>Expense</th>
								<th>variation</th>
								
							</thead>
							<tbody>
								<tr>
									<td><?=$res['count']; ?></td>
									<td><?=$res['day']; ?>-<?=$res['month']; ?>-<?=$res['year']; ?></td>			
									<td><?=$res['sum']; ?></td>	
									<td><?=$res2['sum'] ?></td>	
									<td><?=$res['sum'] - $res2['sum']; ?></td>	
								</tr>
							</tbody>
						</table>
				</div>
				
				<div class="col-md-12">       
					<h2 class="text-center">Daily Sales Details</h2><hr>
						<table class="table table-bordered stable-striped table-auto table-condensed">
							<thead>
								<th>Item Name</th>
								<th>Quantity</th>
								<th>Total</th>
								
							</thead>
							<tbody>
							<?php 
							$currentTotal = 0;
							while($res1 = mysqli_fetch_assoc($qu1)) : ?>
								<tr>
									<td><?=$res1['name']; ?></td>
									<td><?=$res1['quantity']; ?></td>			
									<td><?=$res1['sum']; ?></td>	
								</tr>
								<?php
								$currentTotal += $res1['sum'];
								endwhile; ?>
								<tr>
									<td></td>
									<td><b>Grand Total:</b></td>
									<td><b><?=$currentTotal;?></b></td>
								</tr>
							</tbody>
						</table>
				</div>
				<form method="post" action="dailyp2.php" target="_blank">
				<input type="hidden" name="date" value="<?=$date;?>" />
				<button class="btn btn-warning btn-lg" name="print" type="submit">Print Overview</button>
				</form>
				<br>
<form method="post" action="dailyp.php" target="_blank">
				<input type="hidden" name="date" value="<?=$date;?>" />
				<button class="btn btn-success btn-lg" name="print" type="submit">Print Details</button>
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
