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
$pdf->SetTitle('STORE ITEMS RELEASE HISTORY REPORT');

// Add date report ran
$pdf->SetFont('Arial','I',10);
$date =  date("F j, Y", strtotime($ddate));
$pdf->Cell(40,30,'Report date: '.$date);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(40,10,'Store Items Release History - '.$date);
 

$pdf->SetDrawColor(0, 0, 0); //black
 
//table header
$pdf->SetFillColor(170, 170, 170); //gray
$pdf->setFont("Arial","B","9");
$pdf->setXY(10, 40); 
$pdf->Cell(40, 10, "Name", 1, 0, "L", 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
$pdf->Cell(40, 10, "Quantity", 1, 0, "L", 1);
$pdf->Cell(40, 10, "Expense", 1, 0, "L", 1);
$pdf->Cell(40, 10, "Date and Time", 1, 0, "L", 1);

$y = 50;
$x = 10;  
 
$pdf->setXY($x, $y);
 
$pdf->setFont("Arial","","9");
 
require_once '../core.php';  // configure to point to your connection script.
//mysql_select_db($database_YOURDBNAME, $YOURHANDLE);
$query_result = "SELECT stockrelease.quantity, stock.price, stockrelease.date, stock.name , stockrelease.stockid, DAY(stockrelease.date) as day, MONTH(stockrelease.date) as month , YEAR(stockrelease.date) as year 
FROM stockrelease INNER JOIN stock on stock.id = stockrelease.stockid WHERE DAY(stockrelease.date)=$day AND MONTH(stockrelease.date)=$month AND YEAR(stockrelease.date)=$year"; 
$result = $db->query($query_result) or die(mysql_error());
 $currentTotal = 0;
while($row = mysqli_fetch_array($result))
{
        $pdf->Cell(40, 8, $row['name'], 1); // CHANGE THESE TO REPRESENT YOUR FIELDS
        $pdf->Cell(40, 8, $row['quantity'], 1);
		$pdf->Cell(40, 8, $row['quantity'] * $row['price'], 1);
		$pdf->Cell(40, 8, $row['date'], 1);
        $y += 8;
         $currentTotal += $row['quantity'] * $row['price'];
        if ($y > 260)    // When you need a page break
		{
            $pdf->AddPage();
            $y = 40;
			
		}
        
        $pdf->setXY($x, $y);
}
$pdf->Cell(40, 8,'', 0);
$pdf->Cell(40, 8,'', 0);
$pdf->Cell(40, 8,'', 0);
$pdf->Cell(40, 8,'Grand Total:'. $currentTotal, 0); 
$pdf->Output();
}