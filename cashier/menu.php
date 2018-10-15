<?php
require_once '../core.php';
$page = $_SERVER['PHP_SELF'];
$sec = "10";
if (!isset($_SESSION["cashierid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["cashierid"];

$waiterR = $db->query("SELECT * FROM staff WHERE type='cashier' and id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);
$err='';
	$date = date("Y-m-d");
if(isset($_POST['order'])){
	$foodid = $_POST['id'];
	$qty = $_POST['qty'];
		$checks = $db->query("select *, food.id as fid from food left join production on production.foodid = food.id AND date='$date' where food.id='$foodid'");
	$check = mysqli_fetch_assoc($checks);
	//if($qty < $check['remainder']){
		$orders = $db->query("SELECT * FROM food WHERE id = '$foodid'");
		$orderr = mysqli_fetch_assoc($orders);
		$total = $orderr['price'] * $qty;
		$odid3 = $_SESSION['orderid'];
		$db->query("INSERT INTO `orderdetails` (orderid, foodid, quantity, total) VALUES ('$odid3', '$foodid', '$qty', '$total')");
	//}else{
		//$err = 'The quantity input is more than available items';
	//}
}

if(isset($_POST['start'])){
	//IF PROBS OCCUR CHANGE $_POST TO $_SESSION!
	$date = date('Y-m-d');
	$db->query("INSERT INTO `order` (waiterid, `datetime`) VALUES ('$id', '$date')");
	$odid = $db->insert_id;
	$_SESSION['orderid'] = $odid;
}

if(isset($_POST['cancel'])){
	$odid2 = $_SESSION['orderid'];
	$db->query("DELETE FROM `order` WHERE id = ('$odid2')");
	$db->query("DELETE FROM `orderdetails` WHERE orderid = ('$odid2')");
	unset($_SESSION['orderid']);
	header('Location: index.php');
}

if(isset($_POST['confirm'])){
	//unset($_SESSION['orderid']);
	//header('Location: index.php');
	$orderid = $_SESSION['orderid'];
		echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.open('print2.php?order=$orderid');
		window.open('unset.php','_self');
		</SCRIPT>");
	
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gretsa University Cafeteria</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/blog-home.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Gretsa University Cafeteria</a>
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
<br>
<br>
    <!-- Page Content -->
    <div class="container">
	<?php
		if(!isset($_SESSION['orderid'])):
	?>
	<form action="menu.php" method="post">
		<button type="submit" name="start" class="btn btn-lg btn-primary">START ORDER</button>
		
	</form>
	<?php endif; ?>
	
	<?php
		if(isset($_SESSION['orderid'])):
	?>
	<div class="">
	<form action="menu.php" method="post">
		
		<button type="submit" name="confirm" class="btn btn-lg btn-success">CONFIRM ORDER</button>
		
		<div class="col-md-12 text-right">
		<button type="submit" name="cancel" class="btn btn-lg btn-danger">CANCEL ORDER</button>
		</div>
	</form>
	</div>
	 <h3><span style="COLOR: RED"><?=$err;?></span></h3>
	<?php endif; ?>

      <div class="row">
		<?php
		if(isset($_SESSION['orderid'])):
		$date = date("Y-m-d");
		?>
        <div class="col-md-4">
          <h2 class="my-4">
            Main Meal
          </h2>
				  <?php 
				  $i=0;
				  $foods = $db->query("select *, food.id as fid from food left join production on production.foodid = food.id AND date='$date'
					where type='main meal'");
				  while($food = mysqli_fetch_assoc($foods)): 
				  if ($i % 2 == 0){
					$c = "btn btn-lg btn-primary";
					}
					else{
					$c = "btn btn-lg btn-success";
					}
					if(($food['available']=='No')){
					$b = "disabled";
					$a= " Item Unavailable!";
					}else{
					$b = "";	
					$a = "";
					}
					
						if(($food['remainder']=='' || $food['remainder']<='0')){
						$b = "disabled";
						$a= " Item Unavailable!";
						$e = '';
						}else{
						$b = "";	
						$a = "";
						$e = '('.$food['remainder'].')';
						}
					
				  ?>
					<button <?=$b ;?> type="button" class="<?=$c ;?>" onCLick="detailsmodal(<?= $food['fid']; ?>)"><?=$food['name'] ;?></button><span style="Color: RED"> <?=$a ;?></span><span style="Color: BLUE"> <?=$e ;?></span>
					<br>
					<br>
				  <?php 
				  $i++;
				  endwhile; ?>
        </div>
		<div class="col-md-4">
          <h2 class="my-4">Soft Drinks
          </h2>
		  				  <?php 
				  $i=0;
				  $foods = $db->query("select *, food.id as fid from food left join production on production.foodid = food.id AND date='$date'
					where type='soft drinks'");
				  while($food = mysqli_fetch_assoc($foods)): 
				  if ($i % 2 == 0){
					$c = "btn btn-lg btn-primary";
					}
					else{
					$c = "btn btn-lg btn-success";
					}
					if(($food['available']=='No')){
					$b = "disabled";
					$a= " Item Unavailable!";
					}else{
					$b = "";	
					$a = "";
					}
					
						if(($food['remainder']=='' || $food['remainder']<='0')){
						$b = "disabled";
						$a= " Item Unavailable!";
						$e = '';
						}else{
						$b = "";	
						$a = "";
						$e = '('.$food['remainder'].')';
						}
					
				  ?>
					<button <?=$b ;?> type="button" class="<?=$c ;?>" onCLick="detailsmodal(<?= $food['fid']; ?>)"><?=$food['name'] ;?></button><span style="Color: RED"> <?=$a ;?></span><span style="Color: BLUE"> <?=$e ;?></span>
					<br>
					<br>
				  <?php 
				  $i++;
				  endwhile; ?>

        </div>
		<div class="col-md-4">
          <h2 class="my-4">Snacks
          </h2>
		  	<?php 
				  $i=0;
				  $foods = $db->query("select *, food.id as fid from food left join production on production.foodid = food.id AND date='$date'
					where type='snacks'");
				  while($food = mysqli_fetch_assoc($foods)): 
				  if ($i % 2 == 0){
					$c = "btn btn-lg btn-primary";
					}
					else{
					$c = "btn btn-lg btn-success";
					}
					if(($food['available']=='No')){
					$b = "disabled";
					$a= " Item Unavailable!";
					}else{
					$b = "";	
					$a = "";
					}
					
						if(($food['remainder']=='' || $food['remainder']<='0')){
						$b = "disabled";
						$a= " Item Unavailable!";
						$e = '';
						}else{
						$b = "";	
						$a = "";
						$e = '('.$food['remainder'].')';
						}
					
				  ?>
					<button <?=$b ;?> type="button" class="<?=$c ;?>" onCLick="detailsmodal(<?= $food['fid']; ?>)"><?=$food['name'] ;?></button><span style="Color: RED"> <?=$a ;?></span><span style="Color: BLUE"> <?=$e ;?></span>
					<br>
					<br>
				  <?php 
				  $i++;
				  endwhile; ?>

        </div>
		
				<div class="col-md-4">
          <h2 class="my-4">Hot Beverages
          </h2>
		  				  <?php 
				  $i=0;
				  $foods = $db->query("select *, food.id as fid from food left join production on production.foodid = food.id AND date='$date'
					where type='Hot Beverages'");
				  while($food = mysqli_fetch_assoc($foods)): 
				  if ($i % 2 == 0){
					$c = "btn btn-lg btn-primary";
					}
					else{
					$c = "btn btn-lg btn-success";
					}
					if(($food['available']=='No')){
					$b = "disabled";
					$a= " Item Unavailable!";
					}else{
					$b = "";	
					$a = "";
					}
					
						if(($food['remainder']=='' || $food['remainder']<='0')){
						$b = "disabled";
						$a= " Item Unavailable!";
						$e = '';
						}else{
						$b = "";	
						$a = "";
						$e = '('.$food['remainder'].')';
						}
					
				  ?>
					<button <?=$b ;?> type="button" class="<?=$c ;?>" onCLick="detailsmodal(<?= $food['fid']; ?>)"><?=$food['name'] ;?></button><span style="Color: RED"> <?=$a ;?></span><span style="Color: BLUE"> <?=$e ;?></span>
					<br>
					<br>
				  <?php 
				  $i++;
				  endwhile; ?>

        </div>
		
						<div class="col-md-4">
          <h2 class="my-4">Vegetables
          </h2>
		  				 <?php 
				  $i=0;
				  $foods = $db->query("select *, food.id as fid from food left join production on production.foodid = food.id AND date='$date'
					where type='vegetables'");
				  while($food = mysqli_fetch_assoc($foods)): 
				  if ($i % 2 == 0){
					$c = "btn btn-lg btn-primary";
					}
					else{
					$c = "btn btn-lg btn-success";
					}
					if(($food['available']=='No')){
					$b = "disabled";
					$a= " Item Unavailable!";
					}else{
					$b = "";	
					$a = "";
					}
					
						if(($food['remainder']=='' || $food['remainder']<='0')){
						$b = "disabled";
						$a= " Item Unavailable!";
						$e = '';
						}else{
						$b = "";	
						$a = "";
						$e = '('.$food['remainder'].')';
						}
					
				  ?>
					<button <?=$b ;?> type="button" class="<?=$c ;?>" onCLick="detailsmodal(<?= $food['fid']; ?>)"><?=$food['name'] ;?></button><span style="Color: RED"> <?=$a ;?></span><span style="Color: BLUE"> <?=$e ;?></span>
					<br>
					<br>
				  <?php 
				  $i++;
				  endwhile; ?>

        </div>
								<div class="col-md-4">
          <h2 class="my-4">Accompaniments
          </h2>
		  				  <?php 
				  $i=0;
				  $foods = $db->query("select *, food.id as fid from food left join production on production.foodid = food.id AND date='$date'
					where type='Accompaniments'");
				  while($food = mysqli_fetch_assoc($foods)): 
				  if ($i % 2 == 0){
					$c = "btn btn-lg btn-primary";
					}
					else{
					$c = "btn btn-lg btn-success";
					}
					if(($food['available']=='No')){
					$b = "disabled";
					$a= " Item Unavailable!";
					}else{
					$b = "";	
					$a = "";
					}
					
						if(($food['remainder']=='' || $food['remainder']<='0')){
						$b = "disabled";
						$a= " Item Unavailable!";
						$e = '';
						}else{
						$b = "";	
						$a = "";
						$e = '('.$food['remainder'].')';
						}
					
				  ?>
					<button <?=$b ;?> type="button" class="<?=$c ;?>" onCLick="detailsmodal(<?= $food['fid']; ?>)"><?=$food['name'] ;?></button><span style="Color: RED"> <?=$a ;?></span><span style="Color: BLUE"> <?=$e ;?></span>
					<br>
					<br>
				  <?php 
				  $i++;
				  endwhile; ?>

        </div>
		
		
			<div class="col-md-4">
          <h2 class="my-4">Specials
          </h2>
		  				 <?php 
				  $i=0;
				  $foods = $db->query("select *, food.id as fid from food left join production on production.foodid = food.id AND date='$date'
					where type='specials'");
				  while($food = mysqli_fetch_assoc($foods)): 
				  if ($i % 2 == 0){
					$c = "btn btn-lg btn-primary";
					}
					else{
					$c = "btn btn-lg btn-success";
					}
					if(($food['available']=='No')){
					$b = "disabled";
					$a= " Item Unavailable!";
					}else{
					$b = "";	
					$a = "";
					}
					
						if(($food['remainder']=='' || $food['remainder']<='0')){
						$b = "disabled";
						$a= " Item Unavailable!";
						$e = '';
						}else{
						$b = "";	
						$a = "";
						$e = '('.$food['remainder'].')';
						}
					
				  ?>
					<button <?=$b ;?> type="button" class="<?=$c ;?>" onCLick="detailsmodal(<?= $food['fid']; ?>)"><?=$food['name'] ;?></button><span style="Color: RED"> <?=$a ;?></span><span style="Color: BLUE"> <?=$e ;?></span>
					<br>
					<br>
				  <?php 
				  $i++;
				  endwhile; ?>

        </div>
<?php
	endif;
?>
      </div>
      <!-- /.row -->
<br>
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
		url : '/cafe/cashier/detailsmodal.php',
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
