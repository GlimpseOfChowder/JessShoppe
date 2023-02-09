<?php
	include 'dbh.inc.php';
	
	if(isset($_POST['editsupply'])) {
		
		$supply_id=$_POST['update_supply_id'];
		
		$supplier_name = $_POST['supplier_name'];
		$product_id = $_POST['product_id'];
		$product_name = $_POST['product_name'];
		$inventory = $_POST['inventory'];
		$cost = $_POST['cost'];;
	
		
		$sql = "UPDATE supplies SET supplier_name='$supplier_name', product_id='$product_id', product_name='$product_name', inventory='$inventory', cost='$cost' WHERE supply_id='$supply_id'";
		$result = mysqli_query($conn, $sql);
		
		if($result)
		{	
			echo "<script> alert('Supply has been updated') </script>";
			header("location: ../supply_management.php");
		}
		else 
		{
				echo 'Error: '.mysqli_error($conn);
		}
	}
 
?>