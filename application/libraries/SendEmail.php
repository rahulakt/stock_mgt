<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SendEmail
{

	function _construct() 
	{
	    $CI =& get_instance();     
		$CI->load->database();     
		$CI->load->library("session");
	}


	public function sendMail($to,$cc,$subject,$msg,$from,$fromname,$attachment_file)
	{
		$config = Array(
						  'protocol' => 'smtp',
						  'smtp_host' => 'ssl://smtp.googlemail.com',
						  'smtp_port' => 465,
						  'smtp_user' => 'test4moonveda@gmail.com', // change it to yours
						  'smtp_pass' => 'moonveda@8', // change it to yours
						  'mailtype' => 'html',
						  'charset' => 'iso-8859-1',
						  'MIME-Version'=>'1.0',
						  'wordwrap' => TRUE,
						  'starttls'  => true,
						  
						);
        $CI->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->reply_to('test4moonveda@gmail.com', 'Moon SEZ');
        //echo './upload/pdf/'.$attachment_file;
        $this->email->attach('./upload/pdf/'.$attachment_file);
        $this->email->set_newline("\r\n");
        $this->email->from($from,$fromname); // change it to yours
        $this->email->to($to);// change it to yours
        $this->email->cc($cc);
        $this->email->subject($subject);
        $this->email->message($msg);
        if($this->email->send())
        {
       		return true;
        }
        else
        {
	    show_error($this->email->print_debugger());
	   		return false;
        }
    } 

    function mail_sent($data) 
    {
    	
		date_default_timezone_set('Etc/UTC');

		require_once 'email/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0; 

		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		//Set the hostname of the mail server
		//$mail->Host = 'smtp.mandrillapp.com';
		$mail->Host = 'smtp.gmail.com';

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		//$mail->Port = 587;
		$mail->Port = 465;

		//Set the encryption system to use - ssl (deprecated) or tls
		//$mail->SMTPSecure = 'tls';
		$mail->SMTPSecure = 'ssl';

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "new.mahindrakar@gmail.com";

		//Password to use for SMTP authentication
		//$mail->Password = "MPbD9kDjpKAJBQcAUThZzg";
		$mail->Password = "Newele@123";

		//Set who the message is to be sent from
		//$mail->setFrom('test4mooneducation@gmail.com', 'SEZ Form A1 A2 A3');
		$mail->setFrom('new.mahindrakar@gmail.com', 'New Mahindrakar Electronics Invoice Generation');

		//Set an alternative reply-to address
		//$mail->addReplyTo('test4mooneducation@gmail.com', 'SEZ Form A1 A2 A3');
		$mail->setFrom('new.mahindrakar@gmail.com', 'New Mahindrakar Electronics Invoice Generation');

		//Set who the message is to be sent to
        /*for($i=0;$i<count($email_id);$i++)
		{
			$mail->addAddress($email_id[$i]['email_id']);
		}*/		
		$mail->addAddress($data['email_id']);

		//Set the subject line
		$mail->Subject = $data['subject'];

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		
		$mail->MsgHTML($data['msg_body']);
		
		//Replace the plain text body with one created manually
		$mail->AltBody = $data['alt_msg'];

		
		// $mail->addAttachment('./images/phpmailer_mini.png');
		// $mail->addAttachment('./images/freak-logo.png');
		
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
		// for($i=0;$i<count($attachement);$i++)
		// {
		//echo $data['attachment'];
		if(isset($data['attachment']) && !empty($data['attachment'])){
		 	$mail->addAttachment($data['attachment']);
		}

		if(isset($data['cc']) && !empty($data['cc'])){
			$mail->AddCC($data['cc']);
	   	}
		
		// }

		//send the message, check for errors
		if (!$mail->send()) 
		{
			//echo 0;
		    return false;
		} 
		else 
		{
			//echo 1;
		    return true;
		}
	}

 }