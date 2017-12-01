<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication
{

	function _construct() 
	{
	    $CI =& get_instance();     
		$CI->load->database('database');     
		$CI->load->library("session");
	} 
 
	function get_userdata() 
	{
	    $CI =& get_instance();     
		if( ! $this->logged_in())
		{        
			return false;
		}     
		else     
		{     
			//` (`user_id`, `username`, `password`, `role_id`, `display`     
			$query = $CI->db->get_where("tbl_userinfo", array("role_id" => $CI->session->userdata("role_id")));          
			return $query->row();     
		}
	 }
 
	function logged_in() 
	{     
		$CI =& get_instance();     
		return ($CI->session->userdata("role_id")) ? true : false; 
	}

	function chk_login($name, $password) 
	{  
		$CI =& get_instance();
		$pass = md5(sha1($password));
		$data = "(username = '$name' AND password = '$pass' AND display='Y' AND status='Active')";
		$CI->db->where($data);
	    $query = $CI->db->get_where("tbl_userinfo");
		
		if($query->num_rows()!=1)
		{        
			return false;
		}     
		else     
		{         
			//store user id in the session       
			$CI->session->set_userdata("user_id",$query->row()->user_id);		 
			$CI->session->set_userdata("username", $query->row()->username);
			$CI->session->set_userdata("title", $query->row()->title);
			$CI->session->set_userdata("first_name", $query->row()->first_name);
			$CI->session->set_userdata("last_name", $query->row()->last_name);		 
			$CI->session->set_userdata("role_id",$query->row()->role_id);						 
	 		$CI->session->set_userdata("ISlogin", true);         
			$CI->session->sess_expire_on_close = TRUE;
			return true;     
		} 
	}

	function logout() 
	{	     
		$CI =& get_instance();
		$CI->session->unset_userdata("user_id");
		$CI->session->unset_userdata("username");
		$CI->session->unset_userdata("title");
		$CI->session->unset_userdata("first_name");
		$CI->session->unset_userdata("last_name");
		$CI->session->unset_userdata("role_id");				 
		$CI->session->unset_userdata("ISlogin");
	}

	function email_available($email = FALSE, $role_id = FALSE)
	{	
		//echo "email".$email;
		$CI =& get_instance();
	    if (empty($email))
	    {
			return FALSE;
	    }

		// Try and get the $user_id from the users current session if not passed to function.
		if (!is_numeric($role_id) && !empty($role_id))
		{
			$role_id = $CI->session->userdata("role_id");
		}

		// If $user_id is set, remove user from query so their current email is not found during the duplicate email check.
		if (is_numeric($role_id))
		{
			$CI->db->where('role_id',$role_id);
		}
		
	     $result=$CI->db->where('username', $email)->count_all_results('tbl_userinfo') == 0;
	     return $result;
	}

}/*class end*/