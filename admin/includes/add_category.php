<?php
	include 'dbh.inc.php';
 	
	if(isset($_POST['addcategory'])) {
		
		$category_name = $_POST['category_name'];

		$sql = "INSERT INTO category (category_name) VALUES ('$category_name')";
		$result = mysqli_query($conn, $sql);

			if($result) {

				echo "<script> alert('Category has been added') </script>";
				header("location: ../category_management.php?category=added");
			}
			else {

				echo 'Error: '.mysqli_error($conn);
			}
	}

?>
