<?php
header("Content-type: text/html; charset=utf-8");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
	function sendMail($recipient, $name, $subject, $message) {
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->SMTPDebug  = 0;                      //Disable verbose debug output
			$mail->CharSet = 'UTF-8'; //
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'mail.tifatech.vn';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'tifatech@tifatech.vn';                     //SMTP username
			$mail->Password   = 'Tftpkd@12354';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		
			//Recipients
			$mail->setFrom('tifatech@tifatech.vn', 'Tifatech');
			$mail->addAddress($recipient, $name);
			// $mail->addCC('support@tifatech.vn');
			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addBCC('bcc@example.com');
		
			// //Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
		
			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $message; // HTML enable
			$mail->send();
			return  1; // Maile has been sent successfully
		} catch (Exception $e) {
			return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}

	}
        ?>