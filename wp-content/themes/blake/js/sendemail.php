<?php

	if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){
		
		if ($_POST['success'])
			$s = $_POST['success'];
		else
			$s = "Message send successfully.";
		
		if (blake_send_email_return($_POST['sendTo'], $_POST['subject'], $_POST['name'], $_POST['message'], $_POST['email'], 0))
			echo '{"response":{"error": "1", "message":"' . $s . '"}}';
		else {
			$err=$_POST['unsuccess'];
	  		echo '{"response":{"error": "0", "message":"'. $err . '"}}';
	  	}
	
	}
	
	function blake_send_email_return($to, $subject, $name, $msg, $e, $error){

		$headers = "From: " . $name . "\r\n";
		$headers .= "Reply-To: ". $e . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

		$msg = stripslashes($msg);

		if (mail($to, $subject, $msg, $headers)){
			return true;
		} else {
			return false;
		}
	}
?>