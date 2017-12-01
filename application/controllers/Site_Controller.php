<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Controller extends CI_Controller {

	public function __construct()
    { 
        parent::__construct();
        $this->clear_cache();
		$this->load->model('master_model');           
    }   
	
	public function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

	// Start Dashboard
	public function dashboard()
	{
		$this->load->view('dashboard');
	}
	// End Dashboard

	// Start Purchase Product Page
	public function purchase()
	{
		$this->load->view('purchase');
	}

	public function save_purchase_invoice()
	{
		$data = (array)json_decode(file_get_contents("php://input"));
		
		if ($this->master_model->saveDataBatch('tbl_purchase_product', $data)) {
			echo json_encode(array('valid' => 'true', 'msg' => "Purchase product saved successfully."));
		} else {
			echo json_encode(array('valid' => 'false', 'msg' => "While saving purchase product details."));
		}
	}
	// End Purchase Product Page

	// Start Sale Product Page
	public function sale()
	{
		$this->load->view('sale');
	}
	// End Sale Product Page

	// Start Purchase Report Page
	public function purchase_report()
	{
		$this->load->view('purchase_report');
	}
	// End Purchase Report Page

	
	// Start Sale Report Page
	public function sale_report()
	{
		$this->load->view('sale_report');
	}
	// End Sale Report Page

}

/* End of file Site_Controller.php */
/* Location: ./application/controllers/Site_Controller.php */