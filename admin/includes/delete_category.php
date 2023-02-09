<?php
	include 'dbh.inc.php';

	if(isset($_POST['deletecategory'])) {
		
		$category_id = $_POST['delete_category_id'];
		
		$sql = "DELETE FROM category WHERE category_id='$category_id'";
		$result = mysqli_query($conn, $sql);
		
		if($result) {
			
			echo '<script> alert("Category deleted successfully"); </script>';
			header('location: ../category_management.php');
		}
		else {
			
			echo 'Error: '.mysqli_error($conn);
		}	
	}
?>