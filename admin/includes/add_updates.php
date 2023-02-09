<?php
	include 'dbh.inc.php';
 	
	if(isset($_POST['add_updates'])) {
		$title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_FILES['updates_image']['name'];

		$sql = "INSERT INTO updates (title, content, photos) VALUES ('$title','$content','$image')";
		$result = mysqli_query($conn, $sql);

        $img_extensions = array('image/jpg', 'image/jpeg', 'image/png', 'image/jfif');
		$validate_img_extension = in_array($image = $_FILES['updates_image']['type'], $img_extensions);

        if($validate_img_extension) {
				
			if(file_exists("../upload/".$_FILES['updates_image']['name']))
			{
				$store = $_FILES["updates_image"]["name"];
				echo "File $store already exists";
			}
			else 
			{	
				if($result) {

					move_uploaded_file($_FILES["updates_image"]["tmp_name"], "../upload/".$_FILES["updates_image"]["name"]);
					echo "<script> alert('Update has been added') </script>";
					header("location: ../Updates.php");
				}
				else {

					echo 'Error: '.mysqli_error($conn);
				}
			}
		
		}
		else {
			
			echo "Only PNG, JPG, JPEG and JFIF images are allowed";
		}
	}
?>
