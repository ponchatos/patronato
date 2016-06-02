<?php
Class Pdf_creator extends CI_Controller {

public function __construct(){
	parent::__construct();
	$this->load->library("Pdf");

    $this->load->helper('form');

    $this->load->library('session');

    // Load form validation library
    $this->load->library('form_validation');

    $this->load->model('leer_datos');
}

    public function recibo_pdf(){
        $this->form_validation->set_rules('folio','Folio','trim|required|xss_clean|numeric');
        if($this->form_validation->run()==FALSE){
            
            $data=$this->leer_datos->get_spinner_datas();
            $data['message']="<p style='color:red;font-weight:bold;'>Folio necesario</p>";
            $this->load->view('barra_nav');
            $this->load->view('registrar_alumno',$data);
        }else{
            $folio=$this->input->post('folio');
            $result=$this->leer_datos->get_inscrito_info($folio);
            if($result!=FALSE){
                $fol=$folio;
                while(strlen($fol)<5){
                    $fol='0'.$fol;
                }
                // create new PDF document
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);   
              
                // set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Patronato');
                $pdf->SetTitle('Recibo Inscripcion - '.$fol.'.pdf');
                $pdf->SetSubject('Folio de inscripcion');
                $pdf->SetKeywords('Folio, PDF, patronato');  
              
                // set default header data
                //$pdf->SetHeaderData('css/images/pat.jpg', '40', 'Recibo de inscripcion', 'blabla', array(0,64,255), array(0,64,128));
                //$pdf->setFooterData(array(0,64,0), array(0,64,128));
              
                // set header and footer fonts
                //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 
              
                // set default monospaced font
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
              
                // set margins
                $pdf->SetMargins(0, 0, 0);
                $pdf->SetHeaderMargin(0);
                //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);   
              
                // set auto page breaks
                $pdf->SetAutoPageBreak(TRUE, 0);
              
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
                //$img_file = base_url()."uploads/".;
                //$img_file=base_url()."".$carrera_info->diploma_url;
                $pdf->Image(base_url()."css/images/Recibo.png", 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
                // restore auto-page-break status
                $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
                // set the starting point for the page content
                $pdf->setPageMark();


                // Print a text
                /*$html = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <span style="color:black;text-align:center;font-weight:bold;font-size:23pt;">ultrareultra reutlra reultraultraultraultra largisisisisisimo</span>';*/
                
                //Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
                $pdf->SetTextColor(255,0,0);
                $pdf->SetXY(185,6);
                $pdf->cell(20,10,$fol,0,0,'L',false,'',1);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetXY(59,34);
                $pdf->cell(128,5,$result['nombre'],0,0,'L',false,'',1);
                $pdf->SetXY(63,41.5);
                $pdf->cell(124,5,$result['fec_nac'],0,0,'L',false,'',1);
                $pdf->SetXY(67,49);
                $pdf->cell(120,5,$result['nombre_tutor'],0,0,'L',false,'',1);
                $pdf->SetXY(43,56.5);
                $pdf->cell(144,5,$result['domicilio'],0,0,'L',false,'',1);
                $pdf->SetXY(43,64.5);
                $pdf->cell(144,5,$result['telefono'],0,0,'L',false,'',1);
                $pdf->SetXY(76,72.5);
                $pdf->cell(111,5,$result['escuela'],0,0,'L',false,'',1);
                $pdf->SetXY(38,96);
                $pdf->cell(83,5,$result['plantel'],0,0,'L',false,'',1);
                $pdf->SetXY(37,103.5);
                $pdf->cell(84,5,$result['curso'],0,0,'L',false,'',1);
                $pdf->SetXY(35,110);
                $pdf->cell(86,5,$result['taller'],0,0,'L',false,'',1);
                $pdf->SetXY(63,117);
                $pdf->cell(58,5,'11 al 29 de Julio del 2016',0,0,'L',false,'',1);
                $pdf->SetXY(36,123.5);
                $pdf->cell(85,5,$result['costo'],0,0,'L',false,'',1);
                $pdf->SetXY(36,130.5);
                $pdf->cell(85,5,$result['grupo'],0,0,'L',false,'',1);
                $pdf->SetXY(175,21);
                $pdf->cell(30,5,$result['f_registro'],0,0,'L',false,'',1);
                
                $pdf->SetTextColor(255,0,0);
                $pdf->SetXY(185,154);
                $pdf->cell(20,10,$fol,0,0,'L',false,'',1);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetXY(59,182.5);
                $pdf->cell(128,5,$result['nombre'],0,0,'L',false,'',1);
                $pdf->SetXY(63,190);
                $pdf->cell(124,5,$result['fec_nac'],0,0,'L',false,'',1);
                $pdf->SetXY(67,4,0,0,'L',false,'',1);
                $pdf->SetXY(67,197.5);
                $pdf->cell(120,5,$result['nombre_tutor'],0,0,'L',false,'',1);
                $pdf->SetXY(43,205);
                $pdf->cell(144,5,$result['domicilio'],0,0,'L',false,'',1);
                $pdf->SetXY(43,213);
                $pdf->cell(144,5,$result['telefono'],0,0,'L',false,'',1);
                $pdf->SetXY(76,221);
                $pdf->cell(111,5,$result['escuela'],0,0,'L',false,'',1);
                $pdf->SetXY(38,244.5);
                $pdf->cell(83,5,$result['plantel'],0,0,'L',false,'',1);
                $pdf->SetXY(37,252);
                $pdf->cell(84,5,$result['curso'],0,0,'L',false,'',1);
                $pdf->SetXY(35,258.5);
                $pdf->cell(86,5,$result['taller'],0,0,'L',false,'',1);
                $pdf->SetXY(63,266);
                $pdf->cell(58,5,'11 al 29 de Julio del 2016',0,0,'L',false,'',1);
                $pdf->SetXY(36,272);
                $pdf->cell(85,5,$result['costo'],0,0,'L',false,'',1);
                $pdf->SetXY(36,279.5);
                $pdf->cell(85,5,$result['grupo'],0,0,'L',false,'',1);
                $pdf->SetXY(175,169);
                $pdf->cell(30,5,$result['f_registro'],0,0,'L',false,'',1);
                
                $salida = 'folio'.$fol.'.pdf';
                $pdf->Output($salida, 'I');   
            }else{
                $data=$this->leer_datos->get_spinner_datas();
                $data['message']="<p style='color:red;font-weight:bold;'>El folio no existe</p>";
                $this->load->view('barra_nav');
                $this->load->view('registrar_alumno',$data);
            }
        }
    }

    public function credencial_pdf(){

        $this->form_validation->set_rules('folio','Folio','trim|required|xss_clean|numeric');
        if($this->form_validation->run()==FALSE){
            
            $data=$this->leer_datos->get_spinner_datas();
            $data['message']="<p style='color:red;font-weight:bold;'>Folio necesario</p>";
            $this->load->view('barra_nav');
            $this->load->view('registrar_alumno',$data);
        }else{
            $folio=$this->input->post('folio');

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);   
          
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Patronato');
            $pdf->SetTitle('Recibo Inscripcion.pdf');
            $pdf->SetSubject('Folio de inscripcion');
            $pdf->SetKeywords('Folio, PDF, patronato');  
          
            // set default header data
            //$pdf->SetHeaderData('css/images/pat.jpg', '40', 'Recibo de inscripcion', 'blabla', array(0,64,255), array(0,64,128));
            //$pdf->setFooterData(array(0,64,0), array(0,64,128));
          
            // set header and footer fonts
            //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 
          
            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
          
            // set margins
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetHeaderMargin(0);
            //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);   
          
            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, 0);
          
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
            $pdf->SetFont('dejavusans', '', 8, '', true);  
          
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
            //$img_file = base_url()."uploads/".;
            //$img_file=base_url()."".$carrera_info->diploma_url;
            $pdf->Image(base_url()."css/images/credencialp1.png", 5, 20, 188, 53, '', '', '', false, 300, '', false, false, 0);
            //$pdf->Image(base_url()."css/images/credencialp2.png", 100, 20, 100, 53, '', '', '', false, 300, '', false, false, 0);
            // restore auto-page-break status
            $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
            // set the starting point for the page content
            $pdf->setPageMark();


            // Print a text
            /*$html = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <span style="color:black;text-align:center;font-weight:bold;font-size:23pt;">ultrareultra reutlra reultraultraultraultra largisisisisisimo</span>';*/
            
            $data=$this->leer_datos->get_credencial_info($folio);

            $fol=$folio;
            while(strlen($fol)<5){
                $fol='0'.$fol;
            }

            if($data!=false){
                //Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
                $pdf->SetTextColor(255,255,255);
                $pdf->SetXY(141,20.5);
                $pdf->cell(128,5,$data['curso'],0,0,'L',false,'',1);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetXY(149,27);
                $pdf->cell(44,5,$data['nombre'],0,0,'L',false,'',1);                
                $pdf->SetXY(150,31);
                $pdf->cell(43,5,$data['plantel'],0,0,'L',false,'',1);                
                $pdf->SetTextColor(255,255,255);
                $pdf->SetXY(101,40);
                $pdf->cell(38,6,$data['domicilio'],0,0,'L',false,'',1);
                $pdf->SetXY(105,49);
                $pdf->cell(38,5,$data['grupo'],0,0,'L',false,'',1);              
                $pdf->SetXY(110,58);
                $pdf->cell(37,5,"29 de Julio de 2016",0,0,'L',false,'',1);                
                $pdf->SetTextColor(0,0,0);
                $pdf->SetXY(99,68.5);
                $pdf->cell(52,5,$data['taller'],0,0,'L',false,'',1);                
                $pdf->SetTextColor(255,255,255);
                $pdf->SetXY(179.5,68.3);
                $pdf->cell(13,5,$fol,0,0,'L',false,'',1); 
            }
            $salida = 'folio.pdf'; 
            $pdf->Output($salida, 'I');
        }
    }

    public function prueba2(){
        $this->load->view('pruebas');
    }

    public function prueba(){
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);   
      
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Patronato');
        $pdf->SetTitle('Lista Grupo .pdf');
        $pdf->SetSubject('Lista de alumnos');
        $pdf->SetKeywords('Lista, PDF, patronato');  
      
        // set default header data
        //$pdf->SetHeaderData('css/images/pat.jpg', '40', 'Recibo de inscripcion', 'blabla', array(0,64,255), array(0,64,128));
        //$pdf->setFooterData(array(0,64,0), array(0,64,128));
      
        // set header and footer fonts
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 
      
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      
        // set margins
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetHeaderMargin(0);
        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);   
      
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 0);
      
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
        //$img_file = base_url()."uploads/".;
        //$img_file=base_url()."".$carrera_info->diploma_url;
        //$pdf->Image(base_url()."css/images/Recibo.png", 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $pdf->setPageMark();

        $html = '<table>
        <tr>
            <td>Asignatura:</td>
        </tr>
        <tr><td>Profesor:</td></tr>
        <tr><td>Grupo:</td></tr>
        </table>';
        $pdf->writeHTML($html, true, false, true, false, 'C');
        // Print a text
        /*$html = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <span style="color:black;text-align:center;font-weight:bold;font-size:23pt;">ultrareultra reutlra reultraultraultraultra largisisisisisimo</span>';*/
        
        //Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
        
        
        $salida = 'folio.pdf';
        $pdf->Output($salida, 'I');   

    }


}
?>