<?php
include('smtp/PHPMailerAutoload.php');

error_reporting(E_ALL & ~E_DEPRECATED);

function smtp_mailer($to, $subject, $msg, $attachmentPath){
	$mail = new PHPMailer(); 
	//$mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "k201093@nu.edu.pk";
	$mail->Password = "sm03002128375";
	$mail->SetFrom("k201093@nu.edu.pk");
	$mail->Subject = $subject;
	$mail->Body = $msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions = array('ssl'=>array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => false
	));

	// Add attachment
	$mail->AddAttachment($attachmentPath);

	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		// return 'Sent';
	}
}
?>
