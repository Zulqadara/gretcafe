<?php
require_once '../core.php';

if(isset($_POST["id"])){
	$id = $_POST['id'];
	$id = (int)$id;
}else{
    $id = NULL;
}


$sql = "SELECT * FROM food WHERE id='$id'";
$result = $db ->query($sql);
$food = mysqli_fetch_assoc($result);
?>

<!-- Details Modal -->
<?php 
//better way to echo an entire page
ob_start();
?>
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
				$('#qty').numpad({
					displayTpl: '<input class="form-control" type="text" />',
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
	<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true" >
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" onclick="closeModal()" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
					<span id="modal_errors" class="bg-danger"></span>
						<div class="col-sm-12">
							<h4><?= $food['name']; ?></h4>
							<hr>
							
							<form action="index.php" method="post">
							<!-- All Inputs Get sent to footer jQuery and Ajax script, which send to add_cart -->
							<input type="hidden" name="name" id="name" value="<?=$food['name'] ;?>"/>
							<input type="hidden" name="id" id="id" value="<?=$id ;?>"/>
								<div class="form-group">
									<label for="qty"> Quantity:</label>
									<input type="number" min="0" name="qty" id="qty" class="form-control" required />
								</div>
								<button class="btn btn-warning" type="submit" name="order"> Order</button>
								<a class="btn btn-primary" onclick="closeModal()">Close</a>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				
				
							
			</div>
		  </div>
		</div>
	</div>
<script>
	function closeModal(){
		jQuery('#details-modal').modal('hide');
		setTimeout(function(){
			jQuery('#details-modal').remove();
		},500);
		jQuery('.modal-backdrop').remove();
	}
</script>
<?php 
//cleans the buffer memory
echo ob_get_clean(); ?>