<?php
	include 'dbh.inc.php';
 	
	if(isset($_POST['addtext'])) {
		
		$name = $_POST['name'];
		$payment = $_POST['payment'];
		$account = $_POST['account'];

		$sql = "INSERT INTO paymentinfo (client, paymentMethod, account_number) VALUES ('$name', '$payment', '$account')";

		$result = mysqli_query($conn, $sql);

		if($result) {

			echo "<script> alert('Payment info has been added') </script>";
			header("location: ../si_payment.php?payment=added");
		}
		else {

			echo 'Error: '.mysqli_error($conn);
		}
	}

?>
