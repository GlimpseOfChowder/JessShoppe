<?php
	include "dbh.inc.php";

	if(isset($_POST['reset-request-submit'])){
		
		$selector = bin2hex(random_bytes(8));
		$token = random_bytes(32);
		
		$url = "localhost/JessShoppe/create-new-password.php?selector=" . $selector ."&validator=" . bin2hex($token);
		
		$expires = date("U") + 1800;
		
		require 'dbh.inc.php';
		
		$userEmail = $_POST["email"];
		
		$sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
		$stmt = mysqli_stmt_init($conn); 
		if(!mysqli_stmt_prepare($stmt, $sql)){
			
			echo "There was an error!";
			exit();
		}
		else {
			
			mysqli_stmt_bind_param($stmt, "s", $userEmail);
			mysqli_stmt_execute($stmt);
		}
		
		$sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";
		$stmt = mysqli_stmt_init($conn); 
		if(!mysqli_stmt_prepare($stmt, $sql)){
			
			echo "There was an error!";
			exit();
		}
		else {
			
			$hashedToken = password_hash($token, PASSWORD_DEFAULT);
			mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
			mysqli_stmt_execute($stmt);
		}
		
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		
		/*	require_once('../PHPMailer/PHPMailerAutoLoad.php');
	
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'ss1';
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = '465';
			$mail->isHTML();*/
		
		$to = $userEmail;
		
		$subject = 'Reset your password';
		$message = '<p>We received a password request. The link to reset your password is below, if you did not make this request, you can ignore this email.</p>';
		
		$message .= '<p>Here is your password reset link: </br>';
		$message .= '<a href="'	. $url . '">' . $url . '</a></p>';
		
		$headers = "From: Jess <jess@gmail.com>\r\n";
		$headers .= "Reply-To: jess@gmail.com\r\n";
		$headers .= "Content-Type: text/html\r\n";
		
		mail($to, $subject, $message, $headers);
		header("location: ../forgot_password.php?reset=success");
	}
	else {
		
		header("location: ../account.php");
	}