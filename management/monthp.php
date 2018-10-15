<?php
//require_once '../core.php';
require('../fpdf/fpdf.php');
if(isset($_POST['print'])){
	$ddate = $_POST['date'];
	$year = date("Y",  strtotime($ddate));
	$month = date("m",  strtotime($ddate));
	$day = date("d",  strtotime($ddate));
	$thisYear = $_POST['year'];

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
$pdf->SetTitle('MONTHLY SALES REPORT');
 // Add date report ran
$pdf->SetFont('Arial','I',10);
$date =  date("F j, Y", strtotime($ddate));
$pdf->Cell(40,30,'Report date: '.$date);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(40,10,'Monthly Sales - '.$date);
 

$pdf->SetDrawColor(0, 0, 0); //black
 
//table header
$pdf->SetFillColor(170, 170, 170); //gray
$pdf->setFont("Arial","B","9");
$pdf->setXY(10, 40); 
$pdf->Cell(40, 10, "", 1, 0, "L", 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
$pdf->Cell(80, 10, "Monthly Revenue", 1, 0, "L", 1);

$y = 50;
$x = 10;  
 
$pdf->setXY($x, $y);
 
$pdf->setFont("Arial","","9");
 
require_once '../core.php';  // configure to point to your connection script.
//mysql_select_db($database_YOURDBNAME, $YOURHANDLE);
$query_result = "SELECT datetime, month(datetime) AS MONTH, COUNT(id) AS Sales, year(datetime) AS Year, SUM(total) as total
							FROM `order`
							where year(datetime) = $thisYear
							GROUP BY month(datetime)"; 
							
$query_result2 = "SELECT SUM(total) as total
FROM `order` WHERE YEAR(datetime)=$thisYear"; 
$result = $db->query($query_result) or die(mysql_error());
$result2 = $db->query($query_result2) or die(mysql_error());
 
while($row = mysqli_fetch_array($result))
{
		$dateObj   = DateTime::createFromFormat('!m', $row['MONTH']);
		$monthName = $dateObj->format('F');
        $pdf->Cell(40, 8, $monthName, 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
        $pdf->Cell(80, 8, $row['total'], 1);
        $y += 8;
        
        if ($y > 260)    // When you need a page break
		{
            $pdf->AddPage();
            $y = 40;
			
		}
        
        $pdf->setXY($x, $y);
}
while($row = mysqli_fetch_array($result2))
{
        $pdf->Cell(40, 8, "Total", 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
        $pdf->Cell(80, 8, $row['total'], 1);
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