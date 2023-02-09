<?php
	/* registration functions */
	function invalidPwd($pwd, $passwordlength){
		
		$result;
		
		if($passwordlength < 8){
			
			$result = true;
		}
		else {
			
			$result = false;
		}
		
		return $result;
	}
		
	function pwdPattern($pwd) {
        // contains uppercase, lowercase
		if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d).+$/", $pwd)){
			
			$result = true;
		}
		else {
			
			$result = false;
		}
		
		return $result;
	}
	
	function invalidUid($username) {
		
		$result;
		
		if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			
			$result = true;
		}
		else {
			
			$result = false;
		}
		
		return $result;
	} 

	function invalidEmail($email) {
		
		$result;
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			
			$result = true;
		}
		else {
			
			$result = false;
		}
		
		return $result;
	} 

	function pwdMatch($pwd, $pwdRepeat) {
		
		$result;
		
		if($pwd !== $pwdRepeat) {
			
			$result = true;
		}
		else {
			
			$result = false;
		}
		
		return $result;
	} 


	function uidExists($conn, $username, $email) {
		
		$sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../account.php?error=stmtfailed");
			exit();
		}
		
		mysqli_stmt_bind_param($stmt, "ss", $username, $email);
		mysqli_stmt_execute($stmt);
		
		$resultData = mysqli_stmt_get_result($stmt);
		
		if($row = mysqli_fetch_assoc($resultData)){
			
			return $row;
		}
		else {
			
			$result = false;
			return $result;
		}
		
		mysqli_stmt_close($stmt);
	} 

	function createUser($conn, $name, $email, $username, $pwd) {
		
		$sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
		$stmt = mysqli_stmt_init($conn);
		
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location: ../account.php?error=stmtfailed");
			exit();
		}
		
		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
		
		mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		mkdir("../admin/upload/users/" .$username);

		
		header("location: ../account.php?error=none");
		exit();
		
	} 
	/* login functions */
	function loginUser($conn, $username, $pwd) {
		
		$uidExists = uidExists($conn, $username, $username);
		
		if($uidExists === false) {
			
			header("location: ../account.php?error=wronglogin");
			exit();
		}
		
		$pwdHashed = $uidExists["usersPwd"];
		$checkPwd = password_verify($pwd, $pwdHashed);
		
		if($checkPwd === false) {
			
			header("location: ../account.php?error=wronglogin");
			exit();
		}
		else if($checkPwd === true) {
			
			$sql = "SELECT * FROM  users WHERE usersUid='".$username."' AND usersPwd='".$pwdHashed."';";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			
			if($row["usertype"] == "user") {
				session_start();
				$_SESSION["userid"] = $uidExists["usersId"];
				$_SESSION["useruid"] = $uidExists["usersUid"];
				header("location: ../profile.php");
			}
			else if($row["usertype"] == "admin") {
				session_start();
				$_SESSION["userid"] = $uidExists["usersId"];
				$_SESSION["useruid"] =$uidExists["usersUid"];
				header("location: ..//admin/index.php");
			}
			else {
				header("location: ../account.php?error=wronglogin");	
			}

		}
	}