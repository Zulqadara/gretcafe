<?php
require_once '../core.php';

if (!isset($_SESSION["adminid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["adminid"];

$waiterR = $db->query("SELECT * FROM admin WHERE id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);


$sql = "SELECT * FROM food order by name ASC";
$results = $db->query($sql);

$errors = array();

if(isset($_GET['edit']) && !empty($_GET['edit'])){
	$editid = (int)$_GET['edit'];
	$editid = ($editid);
	
	$sql2 = "SELECT * FROM food WHERE id='$editid'";
	$editresult = $db ->query($sql2);
	$efood = mysqli_fetch_assoc($editresult);
}

if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$deleteid = (int)$_GET['delete'];
	$deleteid = ($deleteid);
	
	$sql = "DELETE FROM food WHERE id='$deleteid'";
	$db ->query($sql);
	header ('Location: menu.php');
}



if(isset($_POST['add_submit'])){
	$food = ($_POST['food']);
	$type = ($_POST['type']);
	$price = ($_POST['price']);

	if($_POST['food'] == ''){
		$errors[] .= 'You must enter a Menu Item';
	}
	if($_POST['price'] == ''){
		$errors[] .= 'You must enter a Price';
	}
	if($_POST['type'] == ''){
		$errors[] .= 'You must enter a Type';
	}
	
	$sql = "SELECT * FROM food WHERE name = '$food'";
	if(isset($_GET['edit'])){
		$sql = "SELECT * FROM food WHERE name='$food' AND id!= '$editid'";
	}
	$result = $db ->query($sql);
	$count = mysqli_num_rows($result);
	if($count > 0){
		$errors[] .= $food.' already exists, choose another food name';
	}

	if(!empty($errors)){
		echo display_errors($errors);
	}else{
	
	$sql = "INSERT INTO food (name, type, price) VALUES ('$food', '$type', '$price')";
		if(isset($_GET['edit'])){
		$sql = "UPDATE food SET name='$food', type='$type', price='$price' WHERE id= '$editid'";
	}
	$db ->query($sql);
	header('location: menu.php');
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

       
        <h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ':'Add ') ;?>Menu Item</h2><hr>
	
	<form class="form-inline" action="menu.php<?=((isset($_GET['edit'])))?'?edit='.$editid:''; ?>" method="post">
		<?php 
			
			$foodvalue ='';
			$pricevalue = '';
			if(isset($_GET['edit'])){
				$foodvalue = $efood['name'];
				$pricevalue = $efood['price'];
				
			}else{
				
				if(isset($_POST['food'])){
					$foodvalue = ($_POST['food']);
					$pricevalue = ($_POST['price']);
				}
				
			}
			
			?>
		<div class="form-group">
			<label for="food">Name*:</label>
			<input type="text" class="form-control" name="food" id="food" value="<?= $foodvalue;  ?>"/>
		
			<label for="type">Type*:</label>
			<select class="form-control" id="type" name="type">
				<option value="Main Meal">Main Meal</option>
				<option value="Hot Beverages">Hot Beverages</option>
				<option value="Soft Drinks">Soft Drinks</option>
				<option value="Snacks">Snacks</option>
				<option value="Specials">Specials</option>
				<option value="Accompaniments">Accompaniments</option>
				<option value="Vegetables">Vegetables</option>
			</select>
				
			<label for="price">Price*:</label>
			<input type="number" id="price" name="price" class="form-control"  value="<?= $pricevalue;  ?>" />
		
				
		<?php if(isset($_GET['edit'])) : ; ?>
			<a href ="menu.php" class="btn btn-default">Cancel</a>
			<?php endif; ?>
			<input type="submit" name="add_submit" value="<?=((isset($_GET['edit'])))?'Edit':'Add'; ?> Item" class="btn btn-success"/>
		</div>
		
		
	</form>
<hr>
<table class="table table-bordered stable-striped table-auto table-condensed">
	<thead>
		<th></th>
		<th>Name</th>
		<th>Type</th>
		<th>Price</th>
		<th></th>
		
	</thead>
	<tbody>
	<?php while($food = mysqli_fetch_assoc($results)) : ?>
		<tr>
			<td><a href="menu.php?edit=<?=$food['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil">Edit</span></a></td>
			<td><?=$food['name']; ?></td>
			<td><?=$food['type']; ?></td>
			<td><?=$food['price']; ?></td>
			<td><a href="menu.php?delete=<?=$food['id']; ?>" class="btn btn-xs btn-default">Delete<span class="glyphicon glyphicon-remove-sign"></span></a></td>
			
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

  </body>

</html>
