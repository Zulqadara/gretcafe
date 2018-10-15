<?php
//require_once '../core.php';
require('../fpdf/fpdf.php');
if(isset($_POST['print'])){
	$ddate = $_POST['date'];
	$year = date("Y",  strtotime($ddate));
	$month = date("m",  strtotime($ddate));
	$day = date("d",  strtotime($ddate));

class PDF extends FPDF
{
//Page header
function Header()
{
	$this->SetFont('Arial','B');
	$this->Cell(40,10,'                                                                                                                       Gretsa University',0,1, 'C');
	$this->SetFont('Arial', 'I', 10);
	$this->Cell(40,10,'                                                                                                                                             Hospitality Training Center',0,1, 'C');
    //Logo
    //Logo
   // $this->Image('logo.png',10,8,33);
   
}
 
//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 
 
$pdf = new PDF();
$pdf->open();
$pdf->AddPage();
$pdf->AliasNbPages();   // necessary for x of y page numbers to appear in document
$pdf->SetAutoPageBreak(false);
 
// document properties
$pdf->SetAuthor('...');
$pdf->SetTitle('PRODUCTION VS SALES REPORT');

// Add date report ran
$pdf->SetFont('Arial','I',10);
$date =  date("F j, Y", strtotime($ddate));
$pdf->Cell(40,30,'Report date: '.$date);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(40,10,'Produced Items Vs Sold Items - '.$date);
 

$pdf->SetDrawColor(0, 0, 0); //black
 
//table header
$pdf->SetFillColor(170, 170, 170); //gray
$pdf->setFont("Arial","B","9");
$pdf->setXY(10, 40); 
$pdf->Cell(60, 10, "Item Name", 1, 0, "L", 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
$pdf->Cell(40, 10, "Quantity Produced", 1, 0, "L", 1); 
$pdf->Cell(40, 10, "Quantity Sold", 1, 0, "L", 1); 
$pdf->Cell(40, 10, "Balance", 1, 0, "L", 1); 

$y = 50;
$x = 10;  
 
$pdf->setXY($x, $y);
 
$pdf->setFont("Arial","","9");
 
require_once '../core.php';  // configure to point to your connection script.
//mysql_select_db($database_YOURDBNAME, $YOURHANDLE);
$query_result = "select name, sum(orderdetails.quantity) as q, (production.quantity) from orderdetails inner join `order` on `order`.id = orderdetails.orderid
inner join food on food.id = orderdetails.foodid
inner join production on production.foodid = orderdetails.foodid
where day(date)=$day and month(date)=$month and year(date)=$year and `order`.status = 1 
and day(datetime)=$day and month(datetime)=$month and year(datetime)=$year
 group by production.id"; 
$result = $db->query($query_result) or die(mysql_error());
 
while($row = mysqli_fetch_array($result))
{
		$bal = $row['quantity']-$row['q'];
        $pdf->Cell(60, 8, $row['name'], 1); // CHANGE THESE TO REPRESENT YOUR FIELDS
        $pdf->Cell(40, 8, $row['quantity'], 1);
		$pdf->Cell(40, 8, $row['q'], 1);
		$pdf->Cell(40, 8, $bal, 1);
        $y += 8;
        
        if ($y > 260)    // When you need a page break
		{
            $pdf->AddPage();
            $y = 40;
			
		}
        
        $pdf->setXY($x, $y);
}
 
$pdf->Output();
}