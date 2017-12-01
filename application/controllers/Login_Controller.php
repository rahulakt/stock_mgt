<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Controller extends CI_Controller {

	public function __construct()
    { 
        parent::__construct();
		$this->clear_cache();           
    }   
	
	public function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

	public function index()
	{
		$msg = 'ProjectMsg';
		$key = 'ProjectKey';
		$value = base_url();
		setcookie("new_invoice",$value, time()+3600*24,'/');
		if($this->authentication->logged_in()==FALSE)
		{
		 	$data['key_string'] = $this->encrypt->encode($msg, $key);
		 	$this->session->set_userdata("secret_key", $data['key_string']);
		 	$data['title']="Admin Login";
			$this->load->view("login",$data);
		}
		else
		{
			$this->load->view('page_not_found');
		}
	}

	// public function page_not_found()
	// {
	// 	$this->load->view('page_not_found');
	// }

    public function admin_login() 
	{		
		$secretkey = $this->session->userdata('secret_key');
		$a=$this->input->post('key');
		$pass=$this->input->post('password');
		$login=$this->input->post('username');
		
		if (isset($a) && $a==$secretkey)
		{
			$valid = false;
			if (!isset($login) or strlen($login) == 0)
			{
				$error = 'Please enter your user name.';
			}
			elseif (!isset($pass) or strlen($pass) == 0)
			{
				$error = 'Please enter your password.';
			}
			else
			{
				$valid['state']=$this->authentication->chk_login($login,$pass);
				if (!$valid['state'])
					$error = 'Wrong user/password, please try again.';
			}
 
			$ajax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

			if ($valid['state']==true)
			{		
    			if ($ajax)
				{					
					$data=array(
						'valid' => TRUE,
						'msg'=>"Please Wait, We Will Redirect You Soon...",
						'redirect' => base_url()
					);
					$this->json->jsonReturn($data);					
				}
				else
				{					
					$this->logout();
					redirect('admin_user');
				}					
			}
			else
			{
				if ($ajax)
				{
					$data=array(
						'valid' => FALSE,
						'msg' => $error
					);
					$this->json->jsonReturn($data);
				}
			}
		}
		else
		{
			$this->load->view('login');
		}		
    }

	public function admin_load() 
	{		
		$msg = 'ProjectMsg';
		$key = 'ProjectKey';
		$value = base_url();
		setcookie("new_invoice",$value, time()+3600*24,'/');
		$data['key_string'] = $this->encrypt->encode($msg, $key);
		$secretkey = $this->encrypt->encode($msg, $key);
		$this->session->set_userdata("secret_key", $data['key_string']);			
		
		$state = $this->authentication->logged_in();

		if($state==false)
		{		
			$this->load->view('login',$data); 	
		}				
		else if($state==true)
		{
			//redirect(base_url().'#/dashboard');	
			$value = base_url();
			setcookie("new_invoice",$value, time()+3600*24,'/'); // change cookie name
			$this->load->view('home');					 		
		}
		else 
		{
			redirect('admin_user');	
		}
	}

	function logout()	
	{
		$this->authentication->logout();	 
		redirect(base_url());		
	}

	function change_password()
	{
		$this->load->view('change_password');
	}

}

/* End of file Login_Controller.php */
/* Location: ./application/controllers/Login_Controller.php */