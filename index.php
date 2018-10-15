<?php
require_once 'core.php';

$waiterR = $db->query("SELECT * FROM staff WHERE type='waiter'");
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gretsa University Cafeteria</title>
	
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>

@media (min-width: 992px) {
  body {
    padding-top: 56px;
	background-image: url("images/background.jpg");
	background-color: #cccccc;
  }
}


</style>
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
         
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

       
        <div class="col-md-8">

          <h1 class="my-4">Waiter List<br>
            <small>Tap on your name</small>
          </h1>
		  
          <div class="card mb-4">
            <div class="card-body">
			<?php while($waiter = mysqli_fetch_assoc($waiterR)): ?>
              <h4 class="card-title">
				<button type="button" class="btn btn-primary"  onCLick="detailsmodal(<?= $waiter['id']; ?>)">
				<?=$waiter['name'] ;?>
				</button>
			  </h4><hr>
			 <?php endwhile; ?>
            </div>
          </div>
		  
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
			<h1 class="my-4">Other Users<br>
				<small>Tap on your role</small>
			</h1>
			<div class="dropdown">
			  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Back End Login
			  <span class="caret"></span></button>
			  <ul class="dropdown-menu">
				<li><div class="card my-4">
					<h5 class="card-header"><a href="cashier/login.php" style="color: black">Cashier Login</a></h5>
				  </div>
				</li>
				<li>
					 <div class="card my-4">
						<h5 class="card-header"><a href="production/login.php" style="color: black">Production Manager Login</a></h5>
					  </div>
				</li>
				<li>
				 <div class="card my-4">
					<h5 class="card-header"><a href="store/login.php" style="color: black">Store Login</a></h5>
				  </div>
				</li>
				<li>
					<div class="card my-4">
						<h5 class="card-header"><a href="admin/login.php" style="color: black">Admin Login</a></h5>
					</div>
				</li>
				<li>
					 <div class="card my-4">
						<h5 class="card-header"><a href="management/login.php" style="color: black">Management Login</a></h5>
					  </div>
				</li>
			  </ul>
			</div>
        </div>

      </div>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script>
		function detailsmodal(id){
	//"id":id = i want id from function bracket from above and it should be equal to id in quotes like below under
	var data = {"id" : id};
	jQuery.ajax({
		url : '/cafe/includes/detailsmodal.php',
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
