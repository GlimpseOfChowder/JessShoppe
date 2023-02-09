<?php
	include 'dbh.inc.php';
 	
	if(isset($_POST['addsupply'])) {
		
		$supplier_name = $_POST['supplier_name'];
		$product_id = $_POST['product_id'];
		$product_name = $_POST['product_name'];
		$inventory = $_POST['inventory'];
		$cost = $_POST['cost'];
		
		$sql = "INSERT INTO supplies (supplier_name, product_id, product_name, inventory, cost) VALUES ('$supplier_name','$product_id', '$product_name', '$inventory', '$cost')";
		$result = mysqli_query($conn, $sql);

			if($result) {

				echo "<script> alert('New supply has been added') </script>";
				header("location: ../supply_management.php");
			}
			else {

				echo 'Error: '.mysqli_error($conn);
			}
	}

?>
