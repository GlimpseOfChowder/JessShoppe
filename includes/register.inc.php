<?php

if (isset($_POST["submit"])) {
	
	$name = $_POST["name"];
	$email = $_POST["email"];
	$username = $_POST["uid"];
	$pwd = $_POST["pwd"];
	$pwdRepeat = $_POST["pwdrepeat"];
	
	$passwordlength = strlen($pwd);
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	if(invalidPwd($pwd, $passwordlength) !== false){
		
		header("location: ../account.php?error=invalidpwd");
		exit();
	}
	
	if(pwdPattern($pwd) !== false){
		
		header("location: ../account.php?error=pwdPattern");
		exit();
	}
	
	if (invalidUid($username) !== false) {
		
		header("location: ../account.php?error=invaliduid");
		exit();
	}
	
	if (invalidEmail($email) !== false) {
		
		header("location: ../account.php?error=invalidemail");
		exit();
	}
	
	if (pwdMatch($pwd, $pwdRepeat) !== false) {
		
		header("location: ../account.php?error=passwordsdontmatch");
		exit();
	}
	
	if (uidExists($conn, $username, $email) !== false) {
		
		header("location: ../account.php?error=usernametaken");
		exit();
	}
	
	createUser($conn, $name, $email, $username, $pwd);

}
	

else {
	
	header("location: ../account.php");
	exit();
}