<?php

add_action('wp_ajax_blake_send_email', 'blake_send_email');

function blake_send_email(){
	
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['question'])){
		$todayis = date("l, F j, Y, g:i a") ;
	
		$name=$_POST["name"];
		$subject = "A message from ".$name;
		$notes = stripcslashes($_POST["question"]);
		$message = " $todayis [EST] \r\n
		Question: $notes \r\n
		";
		
		$from = "From: ".$_POST["email"];
		
		$emailToSend=blake_get_opt('_email');
		mail($emailToSend, $subject, $message, $from);
		echo wp_kses_post($name);
	}
}