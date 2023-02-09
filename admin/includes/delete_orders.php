<?php
	include 'dbh.inc.php';

	if(isset($_POST['cancel_orders'])) {
		
		$order_id = $_POST['cancel_order_id'];
		
		$sql = "DELETE FROM orders WHERE order_id='$order_id'";
		$result = mysqli_query($conn, $sql);
		
		if($result) {
			
			echo '<script> alert("Order has been removed successfully"); </script>';
			header('location: ../order_management.php');
		}
		else {
			
			echo 'Error: '.mysqli_error($conn);
		}	
	}
?>