<?php 
// reference the Dompdf namespace

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;



// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml(utf8_decode(file_get_contents('pdf.php')));

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
//$dompdf->setIsPhpEnabled('enable_php');
//setIsPhpEnabled('enable_php');
//$dompdf::Options->setIsPhpEnabled('enable_php');
    

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream(); ?>