<?php
include_once("../db-connection/connection.php"); 
require 'PHPMailerAutoload.php';

		// $mysql_hostname = 'Database Host';
		// $mysql_username = 'Database Username';
		// $mysql_password = 'Database Password';
		// $mysql_dbname = 'Database Name';
		
		// $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        // /*** $message = a message saying we have connected ***/

        // /*** set the error mode to excptions ***/
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // /*** prepare the select statement ***/
        //  $stmt = $dbh->prepare("SELECT id, name, email, promocode FROM email");

        // /*** execute the prepared statement ***/
		// $stmt->execute();
		$query="SELECT * FROM `emaillist`";
		$result = $conn->query($query);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) { 
				$email = $row['email']; 
				// echo $email;					  
				sendEmail($email);
			
			}
		} else {
			echo "No Email Addresses Found In Email List!";
		}

		 
	function sendEmail($email){

		$mail = new PHPMailer;

		$htmlversion="<p style='color:red;'>Hi ".$email.", <br><br> New Job has been added, Kidly visit our site to check it. </p>";
		$textVersion="Hi ".$email.",.\r\n New Job has been added, Kidly visit our site to check it.";
		$mail->isSMTP();                                     		 // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  								// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                                // Enable SMTP authentication
		$mail->Username = 'imamar020@gmail.com';         			  // SMTP username
		$mail->Password = ''; 
		$mail->SMTPSecure = 'tls';                     // SMTP password
		$mail->Port = 587;                                   // TCP port to connect to
		$mail->setFrom('imamar020@gmail.com', 'Test Email');
		$mail->addAddress($email);               // Name is optional
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
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
		echo 'Message has been sent to Email:  '.$email.'<br><br>';
	}
}
?>
