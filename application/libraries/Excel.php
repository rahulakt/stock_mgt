<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Rahul Mahindrakar 
 *  Purpose    : Generating report for invice sys.


 *  ======================================= 
 */  
require_once APPPATH."third_party/PHPExcel.php"; 
 
class Excel extends PHPExcel { 
    public function __construct() {  
        parent::__construct(); 
        $CI =& get_instance();  
		//$CI->load->database();     
		//$CI->load->library("session");
    } 

    function generate_report($report_data)
    {
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');
    	PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
		$CI->excel->getProperties()->setCreator("Moonveda Infotech Pvt. Ltd")
							 	   ->setLastModifiedBy("Moonveda Infotech Pvt. Ltd")
							 	   ->setTitle("Shipment Report For SEZ")
							 	   ->setSubject("Shipment Report For SEZ")
							 	   ->setDescription("System Generated File.")
							 	   ->setKeywords("office 2007")
							 	   ->setCategory("Confidential");

		$allborders = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,					
				),
			),
		);	

		$CI->excel->setActiveSheetIndex(0);
		$CI->excel->getActiveSheet()->getStyle("A1:T3")->getAlignment()->setWrapText(true);
		$CI->excel->getActiveSheet()->setTitle('Invoice Report');

		$CI->excel->getActiveSheet()->mergeCells('A1:T1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		$CI->excel->getActiveSheet()->getStyle('A1:T1')->applyFromArray($allborders);							

		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $CI->excel->getActiveSheet()->setCellValue('A2', 'Invoice Report');
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Bookman Old Style');
        $CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(50);
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(20);
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);															
		
		$CI->excel->getActiveSheet()->mergeCells('A2:T2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		$CI->excel->getActiveSheet()->getStyle('A2:T2')->applyFromArray($allborders);							

		$CI->excel->getActiveSheet()->getStyle('A2:T2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);															
		$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.');
		$CI->excel->getActiveSheet()->setCellValue('B3', 'Invoice No');
		$CI->excel->getActiveSheet()->setCellValue('C3', 'Invoice Date');
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Client Name');	
		$CI->excel->getActiveSheet()->setCellValue('E3', 'Client Address 1');
		$CI->excel->getActiveSheet()->setCellValue('F3', 'Client Address 2');
		$CI->excel->getActiveSheet()->setCellValue('G3', 'Client Email Id');	
		$CI->excel->getActiveSheet()->setCellValue('H3', 'Client Contact No');
		$CI->excel->getActiveSheet()->setCellValue('I3', 'Product Details');
		
		$CI->excel->getActiveSheet()->mergeCells('I3:T3');
		
		$CI->excel->getActiveSheet()->setCellValue('I4', 'Sr. No.');
		$CI->excel->getActiveSheet()->setCellValue('J4', 'Product Name');
		$CI->excel->getActiveSheet()->setCellValue('K4', 'Product Description');
		$CI->excel->getActiveSheet()->setCellValue('L4', 'HSN Code');
		$CI->excel->getActiveSheet()->setCellValue('M4', 'Quantity');	
		$CI->excel->getActiveSheet()->setCellValue('N4', 'Rate(Rs.)');
		$CI->excel->getActiveSheet()->setCellValue('O4', 'Per');
		$CI->excel->getActiveSheet()->setCellValue('P4', 'Discount(%)');
		$CI->excel->getActiveSheet()->setCellValue('Q4', 'Amount(Rs.)');
		$CI->excel->getActiveSheet()->setCellValue('R4', 'GST(%)');
		$CI->excel->getActiveSheet()->setCellValue('S4', 'Tax Amount(Rs.)');
		$CI->excel->getActiveSheet()->setCellValue('T4', 'Total Amount(Rs.)');

		$CI->excel->getActiveSheet()->mergeCells('A3:A4');
		$CI->excel->getActiveSheet()->mergeCells('B3:B4');
		$CI->excel->getActiveSheet()->mergeCells('C3:C4');
		$CI->excel->getActiveSheet()->mergeCells('D3:D4');
		$CI->excel->getActiveSheet()->mergeCells('E3:E4');
		$CI->excel->getActiveSheet()->mergeCells('F3:F4');
		$CI->excel->getActiveSheet()->mergeCells('G3:G4');
		$CI->excel->getActiveSheet()->mergeCells('H3:H4');

		$CI->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);
		$CI->excel->getActiveSheet()->getRowDimension('4')->setRowHeight(30);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(20);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(20);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(20);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(40);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(40);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(40);// client email id
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(30);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(30);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(30);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(10); 
		
		$CI->excel->getActiveSheet()->getStyle('A3:T4')->getFont()->setName('Bookman Old Style');
        $CI->excel->getActiveSheet()->getStyle('A3:T4')->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle('A2:T4')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A3:T4')->getFont()->getColor()->setRGB('FFFFFFFF');														
		$CI->excel->getActiveSheet()->getStyle('A3:T4')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A3:T4')->applyFromArray($allborders);							
		$CI->excel->getActiveSheet()->getStyle('A3:T4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);															


		if(isset($report_data) && !empty($report_data))
		{
			$i=4;			
			$sr=0;	
			$a = 0;
			$b = 0;
			$t_qty = 0;
			$t_rate = 0;
			$t_amt = 0;
			$tax_amt = 0;
			$tt_amt = 0;

			foreach ($report_data as $key) 
			{
				$inv = $key['inv'];
				$inv_count = count($inv);
				$key = $key['key'];
				
				$sr++;
				$i++;	
				$CI->excel->getActiveSheet()->setCellValue('A'.$i, $sr);
				$CI->excel->getActiveSheet()->setCellValue('B'.$i, $key->invoice_no);
				$CI->excel->getActiveSheet()->setCellValue('C'.$i, (isset($key->invoice_date) && !empty($key->invoice_date) && $key->invoice_date !='1970-01-01')?date('d-m-Y',strtotime($key->invoice_date)):'-');
				$CI->excel->getActiveSheet()->setCellValue('D'.$i, $key->client_name);
				$CI->excel->getActiveSheet()->setCellValue('E'.$i, (isset($key->client_addr1) && !empty($key->client_addr1))?$key->client_addr1:'-');
				$CI->excel->getActiveSheet()->setCellValue('F'.$i, (isset($key->client_addr2) && !empty($key->client_addr2))?$key->client_addr2:'-');
				$CI->excel->getActiveSheet()->setCellValue('G'.$i, (isset($key->client_email_id) && !empty($key->client_email_id))?$key->client_email_id:'-');
				$CI->excel->getActiveSheet()->setCellValue('H'.$i, (isset($key->client_contact_no) && !empty($key->client_contact_no))?$key->client_contact_no:'-');

				$a = $i;
				if(isset($inv) && !empty($inv))
				{
					$sr1 = 0;
					foreach ($inv as $row) 
					{
						$sr1++;

						$total_qty = $row->qty * 1;
						$t_qty += $total_qty;
			
						$total_rate = $row->total_rate * 1;
						$t_rate += $total_rate;
			
						$total_amount = $row->amount * 1;
						$t_amt += $total_amount;
			
						$tax_amount = ($row->total_cgst + $row->total_sgst)*1;
						$tax_amt += $tax_amount;
			
						$tt_amount = $row->total_rate * 1;
						$tt_amt += $tt_amount;

						$CI->excel->getActiveSheet()->getRowDimension($i)->setRowHeight(30);
						$CI->excel->getActiveSheet()->setCellValue('I'.$i, $sr1);
						$CI->excel->getActiveSheet()->setCellValue('J'.$i, $row->item_name);
						$CI->excel->getActiveSheet()->setCellValue('K'.$i, $row->item_desc);
						$CI->excel->getActiveSheet()->setCellValue('L'.$i, $row->hsn_code);	
						$CI->excel->getActiveSheet()->setCellValue('M'.$i, $row->qty);
						$CI->excel->getActiveSheet()->setCellValue('N'.$i, 'Rs. '.number_format($row->total_rate,2));
						$CI->excel->getActiveSheet()->setCellValue('O'.$i, $row->per);
						$CI->excel->getActiveSheet()->setCellValue('P'.$i, $row->disc.'%');
						$CI->excel->getActiveSheet()->setCellValue('Q'.$i, 'Rs. '.number_format($row->amount,2));
						$CI->excel->getActiveSheet()->setCellValue('R'.$i, $row->cgst_per + $row->sgst_per.'%');
						$CI->excel->getActiveSheet()->setCellValue('S'.$i, 'Rs. '.number_format($row->total_cgst + $row->total_sgst,2));
						$CI->excel->getActiveSheet()->setCellValue('T'.$i, 'Rs. '.number_format($row->total_rate,2));						
						 
						$CI->excel->getActiveSheet()->getStyle('A'.$i.':T'.$i)->applyFromArray($allborders);				
						$CI->excel->getActiveSheet()->getStyle('A'.$i.':T'.$i)->getFont()->setName('Bookman Old Style');
				        $CI->excel->getActiveSheet()->getStyle('A'.$i.':T'.$i)->getFont()->setSize(10);
						$CI->excel->getActiveSheet()->getStyle('A'.$i.':T'.$i)->applyFromArray($allborders);							
						$CI->excel->getActiveSheet()->getStyle('A'.$i.':T'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																			->setWrapText(true);
						$i = $i+1;
					}
					$i = $i-1;
				}

				$b = $i;

				$CI->excel->getActiveSheet()->mergeCells('A'.$a.':A'.$b);
				$CI->excel->getActiveSheet()->mergeCells('B'.$a.':B'.$b);
				$CI->excel->getActiveSheet()->mergeCells('C'.$a.':C'.$b);
				$CI->excel->getActiveSheet()->mergeCells('D'.$a.':D'.$b);
				$CI->excel->getActiveSheet()->mergeCells('E'.$a.':E'.$b);
				$CI->excel->getActiveSheet()->mergeCells('F'.$a.':F'.$b);
				$CI->excel->getActiveSheet()->mergeCells('G'.$a.':G'.$b);
				$CI->excel->getActiveSheet()->mergeCells('H'.$a.':H'.$b);

				$CI->excel->getActiveSheet()->getStyle('A'.$i.':T'.$i)->applyFromArray($allborders);				
				$CI->excel->getActiveSheet()->getStyle('A'.$i.':T'.$i)->getFont()->setName('Bookman Old Style');
				$CI->excel->getActiveSheet()->getStyle('A'.$i.':T'.$i)->getFont()->setSize(10);
				$CI->excel->getActiveSheet()->getStyle('A'.$i.':T'.$i)->applyFromArray($allborders);							
				$CI->excel->getActiveSheet()->getStyle('A'.$i.':T'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																			->setWrapText(true);								
			}
			
			$CI->excel->getActiveSheet()->setCellValue('A'.($i+1), 'Total');
			$CI->excel->getActiveSheet()->getRowDimension(($i+1))->setRowHeight(30);
			$CI->excel->getActiveSheet()->mergeCells('A'.($i+1).':H'.($i+1));
			$CI->excel->getActiveSheet()->getStyle('A'.($i+1).':T'.($i+1))->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('A'.($i+1).':T'.($i+1))->getFont()->setBold(true);

			$CI->excel->getActiveSheet()->getStyle('A'.($i+1).':H'.($i+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$CI->excel->getActiveSheet()->getStyle('I'.($i+1).':T'.($i+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	
			$CI->excel->getActiveSheet()->setCellValue('M'.($i+1), (isset($t_qty) && !empty($t_qty))?$t_qty:'0');
			$CI->excel->getActiveSheet()->setCellValue('N'.($i+1), (isset($t_rate) && !empty($t_rate))?'Rs. '.number_format($t_rate,2):'0');
			$CI->excel->getActiveSheet()->setCellValue('Q'.($i+1), (isset($t_amt) && !empty($t_amt))?'Rs. '.number_format($t_amt,2):'0');
			$CI->excel->getActiveSheet()->setCellValue('S'.($i+1), (isset($tax_amt) && !empty($tax_amt))?'Rs. '.number_format($tax_amt,2):'0');
			$CI->excel->getActiveSheet()->setCellValue('T'.($i+1), (isset($tt_amt) && !empty($tt_amt))?'Rs. '.number_format($tt_amt,2):'0');

			$CI->excel->getActiveSheet()->getStyle('A'.($i+1).':T'.($i+1))
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		}

		$filename='invoice_report-'.$current_date.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($CI->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		//$objWriter->save(str_replace(__FILE__,'./upload/report',__FILE__));
		$objWriter->save('php://output'); 
	} 
	
	public function generate_purchase_invoice_report($report_data)
	{
    	$CI =& get_instance(); 
    	/*date_default_timezone_set('Asia/kolkata');*/
    	$current_date = date('d/m/Y');    	
    	$CI->load->library('excel');
    	PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
		$CI->excel->getProperties()->setCreator("Moon Education Pvt. Ltd")
							 	   ->setLastModifiedBy("Moon Education Pvt. Ltd")
							 	   ->setTitle("DMS Report")
							 	   ->setSubject("DMS Report")
							 	   ->setDescription("System Generated File.")
							 	   ->setKeywords("office 2007")
							 	   ->setCategory("Confidential");

		$allborders = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					
				),
			),
		);					 	   


		$CI->excel->setActiveSheetIndex(0);
		$CI->excel->getActiveSheet()->getStyle("A1:M3")->getAlignment()->setWrapText(true);
		$CI->excel->getActiveSheet()->setTitle('DMS Report');


		$CI->excel->getActiveSheet()->mergeCells('A1:M1')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		$CI->excel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($allborders);							

		$CI->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $CI->excel->getActiveSheet()->setCellValue('A2', 'Purchase Invoice Report');
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setName('Bookman Old Style');
        $CI->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(50);
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(20);
		$CI->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);															
		
		$CI->excel->getActiveSheet()->mergeCells('A2:M2')
									->getStyle()
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		$CI->excel->getActiveSheet()->getStyle('A2:M2')->applyFromArray($allborders);							

		$CI->excel->getActiveSheet()->getStyle('A2:M2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);															
		$CI->excel->getActiveSheet()->setCellValue('A3', 'Sr. No.');
		$CI->excel->getActiveSheet()->setCellValue('B3', 'Bill Number');
		$CI->excel->getActiveSheet()->setCellValue('C3', 'Invoice Date');
		$CI->excel->getActiveSheet()->setCellValue('D3', 'Supplier Name');	
		$CI->excel->getActiveSheet()->setCellValue('E3', 'GSTIN Number');	
		$CI->excel->getActiveSheet()->setCellValue('F3', 'GST Tax(28%)');
		$CI->excel->getActiveSheet()->setCellValue('G3', 'SGST Tax(14%)');
		$CI->excel->getActiveSheet()->setCellValue('H3', 'CGST Tax(14%)');	
		$CI->excel->getActiveSheet()->setCellValue('I3', 'IGST Tax(14%)');
		$CI->excel->getActiveSheet()->setCellValue('J3', 'GST Tax(12%)');
		$CI->excel->getActiveSheet()->setCellValue('K3', 'SGST Tax(6%)');
		$CI->excel->getActiveSheet()->setCellValue('L3', 'CGST Tax(6%)');
		$CI->excel->getActiveSheet()->setCellValue('M3', 'IGST Tax(6%)');
		

		$CI->excel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(20);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(30);							
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(20);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(20);	
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(20);
		$CI->excel->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(20);

		$CI->excel->getActiveSheet()->getStyle('A3:M3')->getFont()->setName('Bookman Old Style');
        $CI->excel->getActiveSheet()->getStyle('A3:M3')->getFont()->setSize(10);
		$CI->excel->getActiveSheet()->getStyle('A2:M3')->getFont()->setBold(true);															
		$CI->excel->getActiveSheet()->getStyle('A3:M3')->getFont()->getColor()->setRGB('FFFFFFFF');														
		$CI->excel->getActiveSheet()->getStyle('A3:M3')
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('FF428bca');
		$CI->excel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($allborders);							
		$CI->excel->getActiveSheet()->getStyle('A3:M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																	->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);															
	
		if(isset($report_data) && !empty($report_data))
		{
			$i=3;			
			$sr=0;	
			
			$t_twenty = 0;
			$t_sgst_four = 0;
			$t_cgst_four = 0;
			$t_igst_four = 0;
			$t_twelve = 0;
			$t_sgst_six = 0;
			$t_cgst_six = 0;
			$t_igst_six = 0;

			// $total_gst_tax_twenty_eight = 0;		
			// $total_sgst_tax_fourteen = 0;
			// $total_cgst_tax_fourteen = 0;
			// $total_igst_tax_fourteen = 0;
			// $total_gst_tax_twelve = 0;
			// $total_sgst_tax_six = 0;
			// $total_cgst_tax_six = 0;
			// $total_igst_tax_six = 0;
			foreach ($report_data as $key) 
			{
				$sr++;
				$i++;
				
				$total_gst_tax_twenty_eight = $key->gst_tax_twenty_eight * 1;
				$t_twenty += $total_gst_tax_twenty_eight;
	
				$total_sgst_tax_fourteen = $key->sgst_tax_fourteen * 1;
				$t_sgst_four += $total_sgst_tax_fourteen;
	
				$total_cgst_tax_fourteen = $key->cgst_tax_fourteen * 1;
				$t_cgst_four += $total_cgst_tax_fourteen;
	
				$total_igst_tax_fourteen = $key->igst_tax_fourteen * 1;
				$t_igst_four += $total_igst_tax_fourteen;

				$total_gst_tax_twelve = $key->gst_tax_twelve * 1;
				$t_twelve += $total_gst_tax_twelve;
	
				$total_sgst_tax_six = $key->sgst_tax_six * 1;
				$t_sgst_six += $total_sgst_tax_six;

				$total_cgst_tax_six = $key->cgst_tax_six * 1;
				$t_cgst_six += $total_cgst_tax_six;
	
				$total_igst_tax_six = $key->igst_tax_six * 1;
				$t_igst_six += $total_igst_tax_six;

				$CI->excel->getActiveSheet()->setCellValue('A'.$i, $sr);
				$CI->excel->getActiveSheet()->setCellValue('B'.$i, (isset($key->bill_number) && !empty($key->bill_number))?$key->bill_number:'-');
				$CI->excel->getActiveSheet()->setCellValue('C'.$i, (isset($key->invoice_date) && !empty($key->invoice_date))?date('d-m-Y',strtotime($key->invoice_date)).' ':'-');
				$CI->excel->getActiveSheet()->setCellValue('D'.$i, (isset($key->supplier_name) && !empty($key->supplier_name))?$key->supplier_name:'-');
				$CI->excel->getActiveSheet()->setCellValue('E'.$i, (isset($key->supp_gstin_no) && !empty($key->supp_gstin_no))?$key->supp_gstin_no:'-');
				$CI->excel->getActiveSheet()->setCellValue('F'.$i, (isset($key->gst_tax_twenty_eight) && !empty($key->gst_tax_twenty_eight))?'Rs. '.$key->gst_tax_twenty_eight:'-');
				$CI->excel->getActiveSheet()->setCellValue('G'.$i, (isset($key->sgst_tax_fourteen) && !empty($key->sgst_tax_fourteen))?'Rs. '.$key->sgst_tax_fourteen:'-');	
				$CI->excel->getActiveSheet()->setCellValue('H'.$i, (isset($key->cgst_tax_fourteen) && !empty($key->cgst_tax_fourteen))?'Rs. '.$key->cgst_tax_fourteen:'-');
				$CI->excel->getActiveSheet()->setCellValue('I'.$i, (isset($key->igst_tax_fourteen) && !empty($key->igst_tax_fourteen))?'Rs. '.$key->igst_tax_fourteen:'-'); 
				$CI->excel->getActiveSheet()->setCellValue('J'.$i, (isset($key->gst_tax_twelve) && !empty($key->gst_tax_twelve))?'Rs. '.$key->gst_tax_twelve:'-');
				$CI->excel->getActiveSheet()->setCellValue('K'.$i, (isset($key->sgst_tax_six) && !empty($key->sgst_tax_six))?'Rs. '.$key->sgst_tax_six:'-');
				$CI->excel->getActiveSheet()->setCellValue('L'.$i, (isset($key->cgst_tax_six) && !empty($key->cgst_tax_six))?'Rs. '.$key->cgst_tax_six:'-');
				$CI->excel->getActiveSheet()->setCellValue('M'.$i, (isset($key->igst_tax_six) && !empty($key->igst_tax_six))?'Rs. '.$key->igst_tax_six:'-');

				$CI->excel->getActiveSheet()->getStyle('A'.$i.':M'.$i)->applyFromArray($allborders);				
				$CI->excel->getActiveSheet()->getStyle('A'.$i.':M'.$i)->getFont()->setName('Bookman Old Style');
		        $CI->excel->getActiveSheet()->getStyle('A'.$i.':M'.$i)->getFont()->setSize(10);
				$CI->excel->getActiveSheet()->getStyle('A'.$i.':M'.$i)->applyFromArray($allborders);							
				$CI->excel->getActiveSheet()->getStyle('A'.$i.':M'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
																			->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																			->setWrapText(true);													
			}

			$CI->excel->getActiveSheet()->setCellValue('A'.($i+1), 'Total');
			$CI->excel->getActiveSheet()->getRowDimension(($i+1))->setRowHeight(30);
			$CI->excel->getActiveSheet()->mergeCells('A'.($i+1).':E'.($i+1));
			$CI->excel->getActiveSheet()->getStyle('A'.($i+1).':M'.($i+1))->applyFromArray($allborders);
			$CI->excel->getActiveSheet()->getStyle('A'.($i+1).':M'.($i+1))->getFont()->setBold(true);

			$CI->excel->getActiveSheet()->getStyle('A'.($i+1).':E'.($i+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$CI->excel->getActiveSheet()->getStyle('F'.($i+1).':M'.($i+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	
			$CI->excel->getActiveSheet()->setCellValue('F'.($i+1), (isset($t_twenty) && !empty($t_twenty))?'Rs. '.$t_twenty:'0');
			$CI->excel->getActiveSheet()->setCellValue('G'.($i+1), (isset($t_sgst_four) && !empty($t_sgst_four))?'Rs. '.$t_sgst_four:'0');
			$CI->excel->getActiveSheet()->setCellValue('H'.($i+1), (isset($t_cgst_four) && !empty($t_cgst_four))?'Rs. '.$t_cgst_four:'0');
			$CI->excel->getActiveSheet()->setCellValue('I'.($i+1), (isset($t_igst_four) && !empty($t_igst_four))?'Rs. '.$t_igst_four:'0');
			$CI->excel->getActiveSheet()->setCellValue('J'.($i+1), (isset($t_twelve) && !empty($t_twelve))?'Rs. '.$t_twelve:'0');
			$CI->excel->getActiveSheet()->setCellValue('K'.($i+1), (isset($t_sgst_six) && !empty($t_sgst_six))?'Rs. '.$t_sgst_six:'0');
			$CI->excel->getActiveSheet()->setCellValue('L'.($i+1), (isset($t_cgst_six) && !empty($t_cgst_six))?'Rs. '.$t_cgst_six:'0');
			$CI->excel->getActiveSheet()->setCellValue('M'.($i+1), (isset($t_igst_six) && !empty($t_igst_six))?'Rs. '.$t_igst_six:'0');

			$CI->excel->getActiveSheet()->getStyle('A'.($i+1).':M'.($i+1))
									->getFill()
									->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()->setARGB('EEEEEEEE');
		}															

		

		$filename='invoice_report-'.$current_date.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($CI->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		//$objWriter->save(str_replace(__FILE__,'./upload/report',__FILE__));
		$objWriter->save('php://output'); 

    } 
   
}