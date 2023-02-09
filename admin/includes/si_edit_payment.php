<?php
	include 'dbh.inc.php';
 	
	if(isset($_POST['editText'])) {
		
		$id = $_POST['update_id'];
		
		$name= $_POST['name'];
		$payment = $_POST['payment'];
		$account = $_POST['account'];

		$sql = "UPDATE paymentinfo SET client='$name', paymentMethod='$payment', account_number='$account' WHERE payment_id = '$id'";

		$result = mysqli_query($conn, $sql);

		if($result) {

			echo "<script> alert('Payment info has been updated') </script>";
			header("location: ../si_payment.php?payment=edit");
		}
		else {

			echo 'Error: '.mysqli_error($conn);
		}
	}

?>