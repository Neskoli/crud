<?php
	//este é o pdf.php
	require("fpdf.php");
	
	class PDF extends FPDF
	{
		// Page header
		function Header()
		{
			// Logo
			//$this->Image('Logo.php,10,6,30);
			// Arial bold 15
			$this->SeFont('Arial','B',15);
			// Mover to the right
			//$this->Cell(40);
			// Title
			$this->Cell(180,10,"titulo do pdf",1,0,'C');
			// Line break
			$this->Ln(20);
		}
		
		// Page footer
		function Footer()
		{
			// Position at l.5 cm from bottom
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Page number
			$this->Cell(0,10,'Pagina '.$this->PageNo().' de {nb}',0,0,'C');
		}
	}
?>