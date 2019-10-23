<?php
class exam_settings{
 	
	 function __construct(){
      $this->query=new Queries();
	}
	
function sendeMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message){
		$headers  = "MIME-Version: 1.0\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "X-MSMail-Priority: Normal\n";
		$headers .= "X-Mailer: php\n";
		$headers .= "From: \"".$fromname."\" <".$fromaddress.">\n";
		if(mail($toaddress, $subject, $message, $headers))
		return 1;
		else
		return 0;
		
	}
	}
	
?>