<?php
Class Pdf_creator extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->library("Pdf");
}

	public function create_pdf() {
		// create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);   
  
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Patronato');
    $pdf->SetTitle('Recibo de inscripcion');
    $pdf->SetSubject('Recibo');
    $pdf->SetKeywords('Recibo, PDF, inscripcion');  
  
    // set default header data
    $pdf->SetHeaderData('css/images/pat.jpg', '40', 'Recibo de inscripcion', 'blabla', array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128));
  
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 
  
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);   
  
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
  
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }  
  
    // ---------------------------------------------------------   
  
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);  
  
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 14, '', true);  
  
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();
  
    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));   
  
    // Set some content to print
    $html = <<<EOD
    <h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
    <i>This is the first example of TCPDF library.</i>
    <p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
    <p>Please check the source code documentation and other examples for further information.</p>
     
EOD;
  
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);  
  
    // ---------------------------------------------------------   
  
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('example_0001.pdf', 'I');   
  
    //============================================================+
    // END OF FILE
    //============================================================+
    }



    public function create_pdf_diploma() {
        // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);   
  
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Patronato');
    $pdf->SetTitle('Recibo de inscripcion');
    $pdf->SetSubject('Recibo');
    $pdf->SetKeywords('Recibo, PDF, inscripcion');  
  
    // set default header data
    $pdf->SetHeaderData('css/images/pat.jpg', '40', 'Recibo de inscripcion', 'blabla', array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128));
  
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 
  
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);   
  
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
  
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }  
  
    // ---------------------------------------------------------   
  
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);  
  
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 14, '', true);  
  
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();
  
    // set text shadow effect
    //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));   
  
    // -- set new background ---

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = base_url()."css/images/DIPLOMAS-TRIATLON-2016.jpg";
$pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();


// Print a text
$html = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<span style="color:black;text-align:center;font-weight:bold;font-size:23pt;">ultrareultra reutlra reultraultraultraultra largisisisisisimo</span>';
//$pdf->writeHTML($html, true, false, true, false, '');
//$tecst = '21ultrareultra reutlra reultraultraultraultra largisisisisisimsdufoasjdfoajsodfjasodjfoasjdofjasodfjjsojf saodjfoasjdfojasdofjsadfojasjfoo12';
//$tecst = 'asd';
//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
$pdf->SetXY(50,120);
$pdf->cell(230,15,$tecst,1,0,'C',false,'',1);

    // Set some content to print
    /*$html = <<<EOD
    <h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
    <i>This is the first example of TCPDF library.</i>
    <p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
    <p>Please check the source code documentation and other examples for further information.</p>
     
EOD;*/
  
    // Print text using writeHTMLCell()
    //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);  
  
    // ---------------------------------------------------------   
  
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('example_0001.pdf', 'I');   
  
    //============================================================+
    // END OF FILE
    //============================================================+
    }

}
?>