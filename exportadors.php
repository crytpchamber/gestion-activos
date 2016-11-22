<?php 
// reference the Dompdf namespace

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;


 ob_start(); 
require_once 'pdfs.php';//'pdf.php';
 $options = new Options();
$options->set('isPhpEnabled', TRUE);
$options->set('isJavascriptEnabled', TRUE);

 $dompdf = new DOMPDF($options);
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Reportes de sucursales.pdf";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
/*

$options = new Options();
$options->set('enable_php', TRUE);
//$options->set('isHtml5ParserEnabled', TRUE);

// instantiate and use the dompdf class
$dompdf = new Dompdf($options);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
$dompdf->loadHtml(utf8_decode(file_get_contents('pdf.php')));
//$dompdf->setIsPhpEnabled('enable_php');
//setIsPhpEnabled('enable_php');
//$dompdf::Options->setIsPhpEnabled('enable_php');
    

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('doc');*/ 
?>