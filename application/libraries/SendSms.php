<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SendSms
{

	function _construct() 
	{
	    $CI =& get_instance();     
		$CI->load->database();     
		$CI->load->library("session");
	}

	function send_text($mobile_no, $message)
	{
		// Mobile No
		$mob_no = $mobile_no;

		// Message 
		$msg = $message;      
		$str = trim(str_replace(' ', '%20', $msg));

		// Sender Id
		$sender_id='NEWMEA';

		// API URL
		// $url="https://control.msg91.com/api/sendhttp.php?authkey=171474ABspSM20599e973c&mobiles=91".$mob_no."&message=".$str."&sender=".$sender_id."&route=4&country=91";
		$url = "http://api.msg91.com/api/sendhttp.php?sender=".$sender_id."&route=4&mobiles=".$mobile_no."&authkey=171474ABspSM20599e973c&country=91&message=".$msg."";
	
		// create a new cURL resource
		$ch = curl_init($url);

		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		// grab URL and pass it to the browser
		$response = curl_exec($ch);
		// $err = curl_error($ch);
		
		// close cURL resource, and free up system resources
		curl_close($ch);

		if ($response) {
			return true;
		} else {
			return false;
		}
	} 	 

	// Generate OTP Send SMS
	function send_sms($mobile_no, $message, $otp_code)
	{
		// Mobile No
		$mob_no = $mobile_no;

		// Message 
		$msg = $message;      
		$str = trim(str_replace(' ', '%20', $msg));

		// Sender Id
		$sender_id='SCRADD';

		// API URL
		//url = "https://control.msg91.com/api/sendotp.php?authkey=171474ABspSM20599e973c&mobile=919156100613&message=Your%20OTP%20is%20080808&sender=SCRADD&otp=080808&otp_expiry=1&otp_length=6";
		$url="https://control.msg91.com/api/sendotp.php?authkey=171474ABspSM20599e973c&mobile=91".$mob_no."&message=".$str."&sender=".$sender_id."&otp=".$otp_code."&otp_expiry=15&otp_length=6";
		// echo $url;
		// create a new cURL resource
		$ch = curl_init($url);

		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		// grab URL and pass it to the browser
		$resp = curl_exec($ch);
		$resp=json_decode($resp);
		// close cURL resource, and free up system resources
		curl_close($ch);

		if ($resp->type == 'success') {
			return true;
		} else {
			return false;
		}		
	}

	// Verify OTP
	function verify_sms($mobile_no, $otp)
	{
		// Mobile No
		$mob_no = $mobile_no;

		// API URL
		//url = "https://control.msg91.com/api/verifyRequestOTP.php?authkey=171474ABspSM20599e973c&mobile=919156100613&otp=0808";
		$url="https://control.msg91.com/api/verifyRequestOTP.php?authkey=171474ABspSM20599e973c&mobile=91".$mob_no."&otp=".$otp."";
		// echo $url;
		// create a new cURL resource
		$ch = curl_init($url);

		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		// grab URL and pass it to the browser
		$resp = curl_exec($ch);
		$resp=json_decode($resp);
		// close cURL resource, and free up system resources
		curl_close($ch);

		if ($resp->type == 'success') {
			return true;
		} else {
			return false;
		}
	}

	// ReGenerate OTP Send SMS
	function resend_sms($mobile_no)
	{
		// Mobile No
		$mob_no = $mobile_no;

		// API URL
		//url = "https://control.msg91.com/api/retryotp.php?authkey=171474ABspSM20599e973c&mobile=919156100613&retrytype=voice";
		$url="https://control.msg91.com/api/retryotp.php?authkey=171474ABspSM20599e973c&mobile=91".$mobile_no."&retrytype=text";
		// echo $url;
		// create a new cURL resource
		$ch = curl_init($url);

		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		// grab URL and pass it to the browser
		$resp = curl_exec($ch);
		$resp=json_decode($resp);
		// close cURL resource, and free up system resources
		curl_close($ch);

		if ($resp->type == 'success') {
			return true;
		} else {
			return false;
		}
	}
}