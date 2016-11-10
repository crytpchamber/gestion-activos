<?php 
// reference the Dompdf namespace

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

/**
* 
*/


 ob_start(); 
require_once 'pdfaud.php';//'pdf.php';
//$fpdf= new PDF();
//$fpdf->AliasNbPages();
?>
<script type="text/php">


        if ( isset($pdf) ) {


          $font = Font_Metrics::get_font("helvetica", "bold");
          $pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
			 

        }
        </script> 
<?php
$options = new Options();
$options->set('isPhpEnabled', TRUE);
$options->set('isJavascriptEnabled', TRUE);

 $dompdf = new DOMPDF($options);
$dompdf->load_html(ob_get_clean());
//$fpdf->Output();
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Reporte de Auditoria.pdf";
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