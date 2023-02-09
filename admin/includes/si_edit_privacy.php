<?php
	include 'dbh.inc.php';
 	
	if(isset($_POST['editText'])) {
		
		$shopInfo_id = $_POST['update_id'];
		$text = $_POST['text'];

		$sql = "UPDATE shop_info SET privacy='$text' WHERE shopInfo_id = '$shopInfo_id'";

		$result = mysqli_query($conn, $sql);

		if($result) {

			echo "<script> alert('Text has been updated') </script>";
			header("location: ../si_privacy.php");
		}
		else {

			echo 'Error: '.mysqli_error($conn);
		}
	}

?>
