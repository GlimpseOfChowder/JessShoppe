<?php
	include 'dbh.inc.php';

	if(isset($_POST['edit'])) {
		
		$product_id=$_POST['update_prod_id'];
		
		$edit_image = $_FILES['prod_image']['name'];
		$category = $_POST['category'];
		$product_name = $_POST['product_name'];
		$details = $_POST['details'];
		$price = $_POST['price'];
		$status = $_POST['status'];;
		
		$sql = "UPDATE products SET image='$edit_image', category_name='$category', product_name='$product_name', details='$details', price='$price', status='$status' WHERE product_id='$product_id'";
		$result = mysqli_query($conn, $sql);
		
		$img_extensions = array('image/jpg', 'image/jpeg', 'image/png', 'image/jfif');
		$validate_img_extension = in_array($image = $_FILES["prod_image"]['type'], $img_extensions);
		
		if($validate_img_extension) {
				
			if($result)
			{	
				move_uploaded_file($_FILES["prod_image"]["tmp_name"], "../upload/".$_FILES["prod_image"]["name"]);
				echo "<script> alert('Product has been updated') </script>";
				header("location: ../product_management.php");
			}
			else 
			{
					echo 'Error: '.mysqli_error($conn);
			}	
		}
		else {
			
			echo "<script> alert(Only PNG, JPG, JPEG and JFIF images are allowed) </script>";
		}
	}
?>