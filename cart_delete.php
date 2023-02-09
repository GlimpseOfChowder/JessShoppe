<?php
	include 'includes/dbh.inc.php';

	if(isset($_POST['deletecart'])) {
		
		$cart_id = $_POST['delete_cart_id'];
		
		$sql = "DELETE FROM cart WHERE cart_id='$cart_id'";
		$result = mysqli_query($conn, $sql);
		
		if($result) {
			
			echo "<script> alert('Product deleted successfully'); </script>";
			header('location: cart.php');
		}
		else {
			
			echo 'Error: '.mysqli_error($conn);
		}	
	}
?>