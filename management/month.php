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
	<br>
    <div class="container">

      <div class="row">
<?php
	$thisYear = date("Y");
	
	$thisYearQ = $db->query("SELECT datetime, month(datetime) AS MONTH, COUNT(id) AS Sales, year(datetime) AS Year, SUM(total) as total
							FROM `order`
							where year(datetime) = '$thisYear'
							GROUP BY month(datetime) ");
		
	$current = array();
		
	$currentTotal = 0;
		
	while($x = mysqli_fetch_assoc($thisYearQ)){
		$month = date("m", strtotime($x['datetime']));
		if(!array_key_exists($month, $current)){
			$current[(int)$month] = $x['total'];
		}else{
			$current[(int)$month] += $x['total'];
		}
		$currentTotal += $x['total'];
	}

?>
       
        <div class="col-md-12" align="center">
		<table class="table table-condensed table-bordered table-striped">
	<thead>
		<th></th>
		<th>Monthly Revenue</th>
	</thead>
	<tbody>
	<?php for($i = 1; $i<= 12; $i++): 
		$dt = DateTime::createFromFormat('!m', $i); //Static function
	?>
		<tr <?=((date("m") == $i)? ' class="info"':'') ;?>>
			<td><?=$dt->format("F") ;?></td>
			<td><?=((array_key_exists($i, $current))?$current[$i]:(0)) ;?></td>
		</tr>
	<?php endfor; ?>
	<tr>
		<td>Total</td>
		<td><?=$currentTotal ;?></td>
	</tr>
	</tbody>
</table>
<?php
	$date = date("Y-m-d");
				$year = date("Y",  strtotime($date));
				$month = date("m",  strtotime($date));
				$day = date("d",  strtotime($date));
				
?>
<form method="post" action="monthp.php" target="_blank">
				<input type="hidden" name="date" value="<?=$date;?>" />
				<input type="hidden" name="year" value="<?=$thisYear;?>" />
				<button class="btn btn-success btn-lg" name="print" type="submit">Print</button>
</form>
				<br>
<a class="btn btn-primary btn-lg" href="reports.php">Back</a>
      </div>
	  <br>
      <!-- /.row -->

    </div>
	</div>
    <!-- /.container -->
<br>
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
