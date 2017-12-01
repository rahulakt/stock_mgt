<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_Creation
{

	function _construct() 
	{
	    $CI =& get_instance();     
		$CI->load->database();     
		$CI->load->library("session");
	}

	function create_pdf($html,$pdfname)
	{
		/*
		 * Required files 
		 * 1. A folder name dompdf which contain classes should be placed in thirdparty folder.
		 * 2. A library with name dompdf_gen.php in library folder.
		 * 
		 * 
		 * 
		 * Input Data 
		 * 1.  	html file with data.
		 * 2.  	filename
		 * 
		 * Way to call this function 
		 * 
		 * 	$filename = 'file name';
			$html = $this->load->view('view path','$data_to_view',TRUE);
		 * 
		 * */
		 
		$pdfname = $pdfname.'.pdf';
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait' );
		$dompdf->render();
		$dompdf->stream($pdfname);
	}


	function create_mpdf($html,$pdfname)
	{
		/*
		 * Required files 
		 * 1. A folder name dompdf which contain classes should be placed in thirdparty folder.
		 * 2. A library with name dompdf_gen.php in library folder.
		 * 
		 * 
		 * 
		 * Input Data 
		 * 1.  	html file with data.
		 * 2.  	filename
		 * 
		 * Way to call this function 
		 * 
		 * 	$filename = 'file name';
			$html = $this->load->view('view path','$data_to_view',TRUE);
		 * 
		 * */
		 
		$pdfname = $pdfname.'.pdf';
		require_once APPPATH.'third_party/mpdf/mpdf.php';
		$mpdf = new mPDF();

		$mpdf->SetTitle($pdfname);

		// Write some HTML code:
		$mpdf->WriteHTML($html);

		// Output a PDF file directly to the browser
		$mpdf->Output($pdfname, 'D');
	}


	function mergePDFFiles(Array $filenames, $outFile) {
	    require_once APPPATH.'third_party/mpdf/mpdf.php';
	    $mpdf = new mPDF();
	    if ($filenames) {
	        //  print_r($filenames); die;
	        $filesTotal = sizeof($filenames);
	        $fileNumber = 1;
	        $mpdf->SetImportUse();
	        if (!file_exists($outFile)) {
	            $handle = fopen($outFile, 'w');
	            fclose($handle);
	        }
	        foreach ($filenames as $fileName) {
	            if (file_exists($fileName)) {
	                $pagesInFile = $mpdf->SetSourceFile($fileName);
	                //print_r($fileName); die;
	                for ($i = 1; $i <= $pagesInFile; $i++) {
	                    $tplId = $mpdf->ImportPage($i);
	                    $mpdf->UseTemplate($tplId);
	                    if (($fileNumber < $filesTotal) || ($i != $pagesInFile)) {
	                        $mpdf->WriteHTML('<pagebreak />');
	                    }
	                }
	            }
	            $fileNumber++;
	        }
	        $mpdf->Output($outFile, 'D');
	    }
	}

	function Save_pdf($html,$pdfname)
	{
		/*
		 * Required files 
		 * 1. A folder name dompdf which contain classes should be placed in thirdparty folder.
		 * 2. A library with name dompdf_gen.php in library folder.
		 * 
		 * 
		 * 
		 * Input Data 
		 * 1.  	html file with data.
		 * 2.  	filename
		 * 
		 * Way to call this function 
		 * 
		 * 	$filename = 'file name';
			$html = $this->load->view('view path','$data_to_view',TRUE);
		 * 
		 * */
		 
		$pdfname = $pdfname.'.pdf';
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait' );
		$dompdf->render();
		$output = $dompdf->output();
   		file_put_contents($pdfname, $output);
   		return $pdfname;
		
	}

    function create_digitally_signed_pdf()
    {
    	//============================================================+
		// File name   : example_052.php
		// Begin       : 2009-05-07
		// Last Update : 2013-05-14
		//
		// Description : Example 052 for TCPDF class
		//               Certification Signature (experimental)
		//
		// Author: Nicola Asuni
		//
		// (c) Copyright:
		//               Nicola Asuni
		//               Tecnick.com LTD
		//               www.tecnick.com
		//               info@tecnick.com
		//============================================================+

		/**
		 * Creates an example PDF TEST document using TCPDF
		 * @package com.tecnick.tcpdf
		 * @abstract TCPDF - Example: Certification Signature (experimental)
		 * @author Nicola Asuni
		 * @since 2009-05-07
		 */

		// Include the main TCPDF library (search for installation path).
		//require_once('');
		require_once APPPATH.'third_party/TCPDF/tcpdf_include.php';
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('TCPDF Example 052');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 052', PDF_HEADER_STRING);

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

		/*
		NOTES:
		 - To create self-signed signature: openssl req -x509 -nodes -days 365000 -newkey rsa:1024 -keyout tcpdf.crt -out tcpdf.crt
		 - To export crt to p12: openssl pkcs12 -export -in tcpdf.crt -out tcpdf.p12
		 - To convert pfx certificate to pem: openssl pkcs12 -in tcpdf.pfx -out tcpdf.crt -nodes
		*/

		// set certificate file
		$certificate = 'file://'.realpath(APPPATH.'third_party/TCPDF/examples/data/cert/ashish.cer');

		// set additional information
		$info = array(
			'Name' => 'Ashish Jhagarawat',
			'Location' => 'Pune',
			'Reason' => 'Invoice',
			'ContactInfo' => 'http://www.moonsez.com',
			);

		// set document signature
		$pdf->setSignature($certificate,$certificate, '', '', 2, $info);

		// set font
		$pdf->SetFont('helvetica', '', 12);

		// add a page
		$pdf->AddPage();

		// print a line of text
		$text = 'This is a <b color="#FF0000">digitally signed document</b> using the default (example) <b>tcpdf.crt</b> certificate.<br />To validate this signature you have to load the <b color="#006600">tcpdf.fdf</b> on the Arobat Reader to add the certificate to <i>List of Trusted Identities</i>.<br /><br />For more information check the source code of this example and the source code documentation for the <i>setSignature()</i> method.<br /><br /><a href="http://www.tcpdf.org">www.tcpdf.org</a>';
		$pdf->writeHTML($text, true, 0, true, 0);

		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		// *** set signature appearance ***

		// create content for signature (image and/or text)
		$pdf->Image(APPPATH.'third_party/TCPDF/examples/images/tcpdf_signature.png', 180, 60, 15, 15, 'PNG');

		// define active area for signature appearance
		$pdf->setSignatureAppearance(180, 60, 15, 15);

		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

		// *** set an empty signature appearance ***
		$pdf->addEmptySignatureAppearance(180, 80, 15, 15);

		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf->Output('example_052.pdf', 'D');

		//============================================================+
		// END OF FILE
		//============================================================+
    }

	
	function create_excel($title,$description,$inputdata,$filename)
	{
		/*
		 * Required files 
		 * 1. A folder name PHPExcel which contain classes should be placed in thirdparty folder.
		 * 2. A file name PHPExcel.php will be in thirdparty folder.
		 * 3. A library with name excel.php in library folder.
		 * 
		 * 
		 * 
		 * Input Data should be in format like 
		 * 1.  	$inputdata = array(array('No','Name'),array('1','Aakash'),array('2','Tehra'));
		 * 2.  	$inputdata[] =  array('No','Name');
				$inputdata[] =  array('1','Aakash');
				$inputdata[] =  array('2','Tehra');
		 * 
		 * Way to call this function 
		 * 
		 * 	$title = 'Excel Title';
		 *  $description = 'Excel Description';
			$filename = 'file name';
			$this->report_creation->create_excel($title,$description,$inputdata,$filename);
		 * 
		 * */
		
		$CI =& get_instance();     
		$CI->load->library('excel');
		$sheet = new PHPExcel();
		$sheet->getProperties()->setTitle($title)->setDescription($description);
		$sheet->setActiveSheetIndex(0);
		$col = 0;
		foreach ($inputdata[0] as $field=>$value)
		{
			$sheet->getActiveSheet()->setCellValueByColumnAndRow($col, 0, $field);
			$col++;
		}
		$row = 1;
		foreach ($inputdata as $data)
		{
			$col = 0;
			foreach ($data as $field_val)
			{
				$sheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field_val);
				$col++;
			}
			$row++;
		}
		$sheet_writer = PHPExcel_IOFactory::createWriter($sheet, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'_'.date('dMy').'.xls"');
		header('Cache-Control: max-age=0');
		$sheet_writer->save('php://output');
	}

	function create_plain_excel($filename)
	{
		/* Way to call this function ..
		 * 
		 * 	$filename = 'filename';
			$this->report_creation->create_plain_excel($filename);
			$this->load->view('view_file_path',$datatoviewfile);
		 * 
		 * */
		// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$filename.'_'.date('dMy').".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
	}
	
	function create_csv_with_excel($title,$description,$inputdata,$filename)
	{
		/*
		 * Required files 
		 * 1. A folder name PHPExcel which contain classes should be placed in thirdparty folder.
		 * 2. A file name PHPExcel.php will be in thirdparty folder.
		 * 3. A library with name excel.php in library folder.
		 * 
		 * 
		 * 
		 * Input Data should be in format like 
		 * 1.  	$inputdata = array(array('No','Name'),array('1','Aakash'),array('2','Tehra'));
		 * 2.  	$inputdata[] =  array('No','Name');
				$inputdata[] =  array('1','Aakash');
				$inputdata[] =  array('2','Tehra');
		 * 
		 * Way to call this function 
		 * 
		 * 	$title = 'Excel Title';
		 *  $description = 'Excel Description';
			$filename = 'file name';
			$this->report_creation->create_excel($title,$description,$inputdata,$filename);
		 * 
		 * */
		
		$CI =& get_instance();     
		$CI->load->library('excel');
		$sheet = new PHPExcel();
		$sheet->getProperties()->setTitle($title)->setDescription($description);
		$sheet->setActiveSheetIndex(0);
		$col = 0;$fieldnamearray = array();$fielddataarray = array();
		foreach ($inputdata[0] as $field=>$value)
		{
			$fieldnamearray[] = $value;
		}
		$fieldnamestring = implode(';', $fieldnamearray);
		$sheet->getActiveSheet()->setCellValueByColumnAndRow($col, 0, $fieldnamestring);
		$row = 1;
		foreach ($inputdata as $data)
		{
			$col = 0;$fielddataarray = array();
			foreach ($data as $field=>$value)
			{
				$fielddataarray[] = $value;
				
			}
			$fielddatastring = implode(';', $fielddataarray);
			$sheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $fielddatastring);
			$row++;
		}
		$sheet_writer = PHPExcel_IOFactory::createWriter($sheet, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'_'.date('dMy').'.csv"');
		header('Cache-Control: max-age=0');
		$sheet_writer->save('php://output');
	}

	function create_csv($inputdata,$filename)
	{
		/*
		 * Required files 
		 *  
		 * Input Data should be in format like 
		 * 1.  	$inputdata = array(array('No','Name'),array('1','Aakash'),array('2','Tehra'));
		 * 2.  	$inputdata[] =  array('No','Name');
				$inputdata[] =  array('1','Aakash');
				$inputdata[] =  array('2','Tehra');
		 * 
		 * Way to call this function 
		 * 
		 * 	
			$filename = 'file name';
			$this->report_creation->create_csv($inputdata,$filename);
		 * 
		 * */
		$tempfilename = tempnam(sys_get_temp_dir(), "csv");
		$file = fopen($tempfilename,"w");
		foreach ($inputdata as $fields)
		{
    		fputcsv($file, $fields);
		}
		fclose($file);
		header("Content-Type: application/csv");
		header("Content-Disposition: attachment;Filename=".$filename.'_'.date('dMy').".csv");
		readfile($tempfilename);
		unlink($tempfilename);
	}



}