<?php
require_once '../core.php';
if (isset($_SESSION["adminid"])) {
    header("location: index.php"); 
    exit();
}
	if(isset($_POST['log'])){
		$id = ((isset($_POST['id']))?san($_POST['id']):'');
		$password = ((isset($_POST['password']))?san($_POST['password']):'');

		$errors = array();
			//form validation
			if(empty($_POST['id']) || empty($_POST['password'])){
				$errors[] = 'You must proivde name and password';
			}

			//If user exists in DB
			$query = $db->query("SELECT * FROM admin WHERE id='$id' and password='$password'");
			$user = mysqli_fetch_assoc($query);
			$userCount = mysqli_num_rows($query);
			if($userCount < 1){
				$errors[] = 'Inncorrect Name/Password!';
			}
			
			//Check for errors
			if(!empty($errors)){
				echo display_errors($errors);
			}else{
				//Log user in
				session_start();
				$_SESSION["adminid"] = $user["id"];
				header ('Location: index.php');
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
         
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

       
        <div class="col-md-8">

          <h1 class="my-4">Login
          </h1>
		  
          <div class="card mb-4">
            <div class="card-body">
				 <form action="login.php" method="post">
				 <div class="form-group">
						<label for="id"> ID:</label>
						<input type="text" name="id" id="id" class="form-control" required />
					</div>
					<div class="form-group">
						<label for="password"> Password:</label>
						<input type="password" name="password" id="password" class="form-control" required />
					</div>
						<a href ="../index.php" class="btn btn-primary">Cancel</a>
						<input type="submit" name="log" value="Log In" class="btn btn-success"/>
					</div>
				</form>
            </div>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
