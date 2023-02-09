<?php
	include 'dbh.inc.php';

	if(isset($_POST['editText'])) {
		
		$updates_id = $_POST['updates_id'];

		$update_title = $_POST['update_title'];
		$update_content = $_POST['update_content'];
		$edit_image = $_FILES['updates_image']['name'];
				
		$sql = "UPDATE updates SET title='$update_title', content='$update_content', photos='$edit_image' WHERE updates_id='$updates_id'";
		$result = mysqli_query($conn, $sql);
		
		$img_extensions = array('image/jpg', 'image/jpeg', 'image/png', 'image/jfif');
		$validate_img_extension = in_array($image = $_FILES["updates_image"]['type'], $img_extensions);
		
		if($validate_img_extension) {
				
			if($result)
			{	
				move_uploaded_file($_FILES["updates_image"]["tmp_name"], "../upload/".$_FILES["updates_image"]["name"]);
				echo "<script> alert('Product has been updated') </script>";
				header("location: ../Updates.php");
			}
			else 
			{
					echo 'Error: '.mysqli_error($conn);
			}	
		}
		else {
			
			echo "Only PNG, JPG, JPEG and JFIF images are allowed";
		}
	}
?>