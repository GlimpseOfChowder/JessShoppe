<?php
	include 'dbh.inc.php';

	if(isset($_POST['verify'])) {
		
		$usersId=$_POST['update_id'];
		$status=$_POST['status'];
		
		$sql = "UPDATE users SET status='$status' WHERE usersId='$usersId'";
		$result = mysqli_query($conn, $sql);
		
		if($result) {
			
			echo '<script> alert("User is now verified"); </script>';
			header("location: ../index.php?users=pending");
		}
		else {
			
			echo 'Error: '.mysqli_error($conn);
		}	
	}

?>