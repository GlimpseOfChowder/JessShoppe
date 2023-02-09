<?php
	include 'dbh.inc.php';
 	
	if(isset($_POST['addtext'])) {
		
		$text = $_POST['text'];

		$sql = "INSERT INTO shop_info (terms_conditions) VALUES ('$text')";

		$result = mysqli_query($conn, $sql);

		if($result) {

			echo "<script> alert('Text has been added') </script>";
			header("location: ../si_termsconditions.php");
		}
		else {

			echo 'Error: '.mysqli_error($conn);
		}
	}

?>
