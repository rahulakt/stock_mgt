<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class check_is_loged
{
	function check_for_isloged()
	{
		if (isset($_SERVER['REMOTE_ADDR']))
		{
			$CI =& get_instance();
            // This is for ajax request only before login
            if($CI->input->is_ajax_request())
            {
                if($CI->session->userdata("ISlogin") != TRUE)
                {
                    $action=basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                    $allowed_action=array('admin_login');
                    if (in_array($action,$allowed_action) )
                    {
                        $CI->output->_display();
                    }else
                    {
                        $CI->load->library('authentication');
                        $CI->authentication->logout();	
                        $new_buffer='Please Login....';
                        $CI->output->set_output($new_buffer);
                        $CI->output->_display();
                    }	
                }else
                {
                    $CI->output->_display();
                }
            }
            else
            {
                $isloger = $CI->session->userdata("ISlogin");
                if($isloger != TRUE)
                {							
                    $request_url = $_SERVER['REQUEST_URI'];
                    $action=basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                    $allowed_action=array('login');
                    $index_page='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    $REDIRECT_QUERY_STRING = '';
                    if(isset($_SERVER['REDIRECT_QUERY_STRING']))
                    {
                        $REDIRECT_QUERY_STRING = $_SERVER['REDIRECT_QUERY_STRING'];
                    }
                    if ( in_array($action,$allowed_action) || $index_page==base_url() )
                    {
                        $CI->output->_display();
                    }else
                    {
                        $CI->load->library('authentication');
                        $CI->authentication->logout();	
                        redirect('logout');
                    }
                }
                else{$CI->output->_display();}
            } 
		}else if($CI->input->is_ajax_request())
        {
            $CI->output->_display();
        } 
	}
}