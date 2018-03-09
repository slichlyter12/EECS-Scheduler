<?php
	
	session_start();
	
/*
	error_reporting(-1);
    ini_set('display_errors', 'On');
*/
	
	mailStudent($_POST["subject"], $_SESSION["script"]);
	
	function mailStudent($subject, $message) {
		$data = $_SESSION["data"];
		$from = "Calvin.Hughes@oregonstate.edu";
		$to = $data["email"];
		
		$headers = "From: $from\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
		
		$result = mail($to, $subject, $message, $headers);
		if ($result) {
			echo "Successfully sent script to $to";
		} else {
			echo "Failed to send email to $to";
		}
	}
	
?>