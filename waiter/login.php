<?php
require_once '../core.php';

	if(isset($_POST['log'])){
		$id = ((isset($_POST['id']))?san($_POST['id']):'');
		$name = ((isset($_POST['name']))?san($_POST['name']):'');
		$name = trim($name);
		$password = ((isset($_POST['password']))?san($_POST['password']):'');

		$errors = array();
			//form validation
			if(empty($_POST['name']) || empty($_POST['password'])){
				$errors[] = 'You must proivde name and password';
			}

			//If user exists in DB
			$query = $db->query("SELECT * FROM staff WHERE type='waiter' and name='$name' and password='$password' and id = '$id'");
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
				$_SESSION["id"] = $user["id"];
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
	    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- jQuery.NumPad -->
		<script src="../jquery.numpad.js"></script>
		<link rel="stylesheet" href="../jquery.numpad.css">
		<script type="text/javascript">
			// Set NumPad defaults for jQuery mobile. 
			// These defaults will be applied to all NumPads within this document!
			$.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
			$.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
			$.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control" />';
			$.fn.numpad.defaults.buttonNumberTpl =  '<button type="button" class="btn btn-default"></button>';
			$.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn" style="width: 100%;"></button>';
			$.fn.numpad.defaults.onKeypadCreate = function(){$(this).find('.done').addClass('btn-primary');};
			
			// Instantiate NumPad once the page is ready to be shown
			$(document).ready(function(){
				$('#password').numpad({
					displayTpl: '<input class="form-control" type="password" />',
					hidePlusMinusButton: true,
					hideDecimalButton: true	
				});
			});
		</script>
		<style type="text/css">
			.nmpd-grid {border: none; padding: 20px;}
			.nmpd-grid>tbody>tr>td {border: none;}
			
			/* Some custom styling for Bootstrap */
			.qtyInput {display: block;
			  width: 100%;
			  padding: 6px 12px;
			  color: #555;
			  background-color: white;
			  border: 1px solid #ccc;
			  border-radius: 4px;
			  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
			  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
			  -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
			  -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
			  transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
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

          <h1 class="my-4">Login
          </h1>
		  
          <div class="card mb-4">
            <div class="card-body">
              <h4 class="card-title"><a href="" style="color: black"><?=$name ;?></a></h4>
				 <form action="login.php" method="post">
					<div class="form-group">
						<label for="password"> Password:</label>
						<input type="password" name="password" id="password" class="form-control" required />
					</div>
						<input type="hidden" name="id" value="<?= $id;?>" />
						<input type="hidden" name="name" value="<?= $name;?>" />
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



  </body>

</html>
