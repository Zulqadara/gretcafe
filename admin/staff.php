<?php
require_once '../core.php';

if (!isset($_SESSION["adminid"])) {
    header("location: ../index.php"); 
    exit();
}
$id = $_SESSION["adminid"];

$waiterR = $db->query("SELECT * FROM admin WHERE id='$id'");
$waiter = mysqli_fetch_assoc($waiterR);


$sql = "SELECT * FROM staff order by type ASC";
$results = $db->query($sql);

$errors = array();

if(isset($_GET['edit']) && !empty($_GET['edit'])){
	$editid = (int)$_GET['edit'];
	$editid = ($editid);
	
	$sql2 = "SELECT * FROM staff WHERE id='$editid'";
	$editresult = $db ->query($sql2);
	$estaff = mysqli_fetch_assoc($editresult);
}

if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$deleteid = (int)$_GET['delete'];
	$deleteid = ($deleteid);
	
	$sql = "DELETE FROM staff WHERE id='$deleteid'";
	$db ->query($sql);
	header ('Location: staff.php');
}



if(isset($_POST['add_submit'])){
	$staff = ($_POST['staff']);
	$type = ($_POST['type']);
	$password = ($_POST['password']);

	if($_POST['staff'] == ''){
		$errors[] .= 'You must enter a Staff';
	}
	if($_POST['password'] == ''){
		$errors[] .= 'You must enter a password';
	}
	if($_POST['type'] == ''){
		$errors[] .= 'You must enter a Type';
	}
	
	$sql = "SELECT * FROM staff WHERE name = '$staff'";
	if(isset($_GET['edit'])){
		$sql = "SELECT * FROM staff WHERE name='$staff' AND id!= '$editid'";
	}
	$result = $db ->query($sql);
	$count = mysqli_num_rows($result);
	if($count > 0){
		$errors[] .= $staff.' already exists, choose another staff name';
	}

	if(!empty($errors)){
		echo display_errors($errors);
	}else{
	
	$sql = "INSERT INTO staff (name, type, password) VALUES ('$staff', '$type', '$password')";
		if(isset($_GET['edit'])){
		$sql = "UPDATE staff SET name='$staff', type='$type', password='$password' WHERE id= '$editid'";
	}
	$db ->query($sql);
	header('location: staff.php');
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

       
        <h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ':'Add ') ;?>Staff</h2><hr>
	
	<form class="form-inline" action="staff.php<?=((isset($_GET['edit'])))?'?edit='.$editid:''; ?>" method="post">
		<?php 
			
			$staffvalue ='';
			$passwordvalue = '';
			if(isset($_GET['edit'])){
				$staffvalue = $estaff['name'];
				$passwordvalue = $estaff['password'];
				
			}else{
				
				if(isset($_POST['staff'])){
					$staffvalue = ($_POST['staff']);
					$passwordvalue = ($_POST['password']);
				}
				
			}
			
			?>
		<div class="form-group">
			<label for="staff">Name*:</label>
			<input type="text" class="form-control" name="staff" id="staff" value="<?= $staffvalue;  ?>"/>
		
			<label for="type">Type*:</label>
			<select class="form-control" id="type" name="type">
				<option value="cashier">Cashier</option>
				<option value="store">Store</option>
				<option value="waiter">Waiter</option>
				<option value="production">Production Manager</option>
			</select>
				
			<label for="password">Password*:</label>
			<input type="password" id="password" name="password" class="form-control"  value="<?= $passwordvalue;  ?>" />
			
		
				
		<?php if(isset($_GET['edit'])) : ; ?>
			<a href ="staff.php" class="btn btn-default">Cancel</a>
			<?php endif; ?>
			<input type="submit" name="add_submit" value="<?=((isset($_GET['edit'])))?'Edit':'Add'; ?> Staff" class="btn btn-success"/>
		</div>
		
		
	</form>
<hr>
<table class="table table-bordered stable-striped table-auto table-condensed">
	<thead>
		<th></th>
		<th>Staff ID</th>
		<th>Name</th>
		<th>Type</th>
		<th></th>
		
	</thead>
	<tbody>
	<?php while($staff = mysqli_fetch_assoc($results)) : ?>
		<tr>
			<td><a href="staff.php?edit=<?=$staff['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil">Edit</span></a></td>
			<td><?=$staff['id']; ?></td>
			<td><?=$staff['name']; ?></td>
			<td><?=$staff['type']; ?></td>
			<td><a href="staff.php?delete=<?=$staff['id']; ?>" class="btn btn-xs btn-default">Delete<span class="glyphicon glyphicon-remove-sign"></span></a></td>
			
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
