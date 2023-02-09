<?php
	include 'dbh.inc.php';
 	
	if(isset($_POST['add'])) {
		
		$image = $_FILES["prod_image"]['name'];
		$category = $_POST['category'];
		$details = $_POST['details'];
		$price = $_POST['price'];
		
		$sql = "INSERT INTO products (image, category_name, details, price) VALUES ('$image', '$category', '$details', '$price')";
		$result = mysqli_query($conn, $sql);
		
		$img_extensions = array('image/jpg', 'image/jpeg', 'image/png', 'image/jfif');
		$validate_img_extension = in_array($image = $_FILES["prod_image"]['type'], $img_extensions);
		
		if($validate_img_extension) {
				
			if(file_exists("../upload/".$_FILES['prod_image']['name']))
			{
				$store = $_FILES["prod_image"]["name"];
				echo "<script> alert('File $store already exists')</script>";
				header("location: ../product_management.php");
			}
			else 
			{	

				if($result) {

					move_uploaded_file($_FILES["prod_image"]["tmp_name"], "../upload/".$_FILES["prod_image"]["name"]);
					echo "<script> alert('Product has been added') </script>";
					header("location: ../product_management.php");
				}
				else {

					echo 'Error: '.mysqli_error($conn);
				}
			}
		
		}
		else {
			
			echo "<script> alert(Only PNG, JPG, JPEG and JFIF images are allowed) </script>";
		}
	}
?>
