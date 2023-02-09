<?php
	include 'dbh.inc.php';
 	
	if(isset($_POST['editText'])) {
		
		$id = $_POST['update_id'];
		
		$delivery = $_POST['deliveryMethod'];
		$shipping = $_POST['shipping'];


		$sql = "UPDATE deliveryInfo SET deliveryMethod='$delivery', shipping='$shipping' WHERE delivery_id = '$id'";

		$result = mysqli_query($conn, $sql);

		if($result) {

			echo "<script> alert('Delivery info has been updated') </script>";
			header("location: ../si_delivery.php?delivery=edit");
		}
		else {

			echo 'Error: '.mysqli_error($conn);
		}
	}

?>
