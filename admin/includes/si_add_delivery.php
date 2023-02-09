<?php
	include 'dbh.inc.php';
 	
	if(isset($_POST['addtext'])) {
		
		$delivery = $_POST['deliveryMethod'];
		$shipping = $_POST['shipping'];

		$sql = "INSERT INTO deliveryInfo (deliveryMethod, shipping) VALUES ('$delivery', '$shipping')";

		$result = mysqli_query($conn, $sql);

		if($result) {

			echo "<script> alert('Delivery info has been added') </script>";
			header("location: ../si_delivery.php?delivery=added");
		}
		else {

			echo 'Error: '.mysqli_error($conn);
		}
	}

?>
