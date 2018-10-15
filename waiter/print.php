<?php
require_once '../core.php';
if (!isset($_SESSION["id"])) {
    header("location: ../index.php"); 
    exit();
}

if (isset($_GET['order'])){
	
	$orderid = $_GET['order'];
	$orders = $db->query("SELECT * FROM `order` INNER JOIN staff on staff.id = `order`.waiterid WHERE `order`.id='$orderid'");
	$orders2 = $db->query("SELECT * FROM `order` INNER JOIN orderdetails on orderdetails.orderid= `order`.id INNER JOIN food on orderdetails.foodid = food.id WHERE `order`.id='$orderid'");
	$orders3 = $db->query("SELECT SUM(orderdetails.total) as total FROM `order` INNER JOIN orderdetails on orderdetails.orderid= `order`.id INNER JOIN food on orderdetails.foodid = food.id WHERE `order`.id='$orderid'");
	$order3 = mysqli_fetch_assoc($orders3);
	$total = $order3['total'];
while($order =mysqli_fetch_assoc($orders)){
$id = $order["id"];
$waiterid =$order["waiterid"];
$waitername =$order["name"];
$datetime =$order["datetime"];
$received =$order['received'];
$change =$order['change'];
$time =$order['timeofsale'];
}

require('../fpdf/fpdf.php');
$pdf = new FPDF('P','mm',array(100,300));
$pdf->AliasNbPages();
//$pdf = new FPDF('P','mm',array(100,150));
$pdf->AddPage();
$pdf->SetFont('Arial','B');
$pdf->Cell(45,10,'Gretsa University',0,1, 'C');
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(40,10,'Hospitality Training Center',0,1, 'C');
$pdf->SetFont('Arial','BUI', 12);
$pdf->Cell(40,10,'Order Receipt',0,1, 'C');
$pdf->SetFont('Arial','B',12);	
$pdf->Cell(31,10,"Order Number:");
$pdf->Cell(40,10,"{$orderid}", 0 , 1);
$pdf->Cell(40,10,"Date and time:", 0 , 1);
$pdf->Cell(40,10,"{$time}", 0 , 1);
$pdf->Cell(40,10,"Items List Order:", 0 , 1);
while($order2 =mysqli_fetch_assoc($orders2)){
$pdf->SetFont('Arial','BI');
$pdf->Cell(40,10,"- {$order2['name']} x {$order2['quantity']}", 0 , 1);
}
$pdf->SetFont('Arial','B');
$pdf->Cell(15,10,"Total:");
$pdf->SetFont('Arial','BUI');
$pdf->Cell(40,10,"{$total}", 0 , 1);
$pdf->SetFont('Arial', 'B');
$pdf->Cell(15,10,"Waiter:");
$pdf->Cell(40,10,"{$waiterid}-{$waitername}", 0 , 1);
$pdf->Output();

		

}else{

echo "Error";
exit();
}



?>
