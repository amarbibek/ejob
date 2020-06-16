<?php
include_once("../db-connection/connection.php"); 
require 'PHPMailerAutoload.php'; 

		$mail = new PHPMailer;

		$htmlversion="<p style='color:red;'>Hi There!, <br><br> New Job has been added, Kidly visit our site to check it. </p>";
		$textVersion="Hi There!,.\r\n New Job has been added, Kidly visit our site to check it.";
		$mail->isSMTP();                                     		 // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  								// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                                // Enable SMTP authentication
		$mail->Username = 'imamar020@gmail.com';         			  // SMTP username
		$mail->Password = 'Bkumar020'; 
		$mail->SMTPSecure = 'tls';                     // SMTP password
		$mail->Port = 587;                                   // TCP port to connect to
		$mail->setFrom('imamar020@gmail.com', 'Job Recommendation');
		// $mail->addAddress($email);               // Name is optional
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		// add email list
		$query="SELECT * FROM `emaillist`";
		$result = $conn->query($query);
		$count=0;
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) { 
				$email = $row['email']; 
				// echo $email;					  
				// sendEmail($email);
				$count++;
				$mail->addAddress($email);
			
			}
		} else {
			echo "No Email Addresses Found In Email List!";
		}
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Test Email Subject';
		$mail->Body    = $htmlversion;
		$mail->AltBody = $textVersion;
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

	if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent to '.$count.' emails <br><br>';
	}
// }
?>