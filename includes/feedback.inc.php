<?php
	include 'dbh.inc.php';
 	
	if(isset($_POST['post'])) {
		
		$image = $_FILES["feeback_image"]['name'];
		$user_id = $_POST['usersId'];
		$prod_id = $_POST['product_id'];
		$feedback = $_POST['feedback'];
		
		$sql = "INSERT INTO feedback (usersId, product_id, feedback, feedback_image) VALUES ('$user_id', '$prod_id', '$feedback', '$image')";
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
