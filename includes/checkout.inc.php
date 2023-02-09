<?php
	include 'dbh.inc.php';

	if(isset($_POST['place_order'])) {

		$usersId = $_POST['usersId'];
		$counter = count($_POST['product_name']);

		$address = $_POST['addressList'];
		$delivery = $_POST['deliveryMethod'];
		$payment = $_POST['paymentMethod'];
		$shipFee = $_POST['shipFee'];
		$total = $_POST['total'];
		
		for($i=0;$i<$counter;$i++){
			
			$prod_id = $_POST['product_id'][$i];
			$product_name = $_POST['product_name'][$i];
			$quantity = $_POST['quantity'][$i];

			$sql = "INSERT INTO orders (usersId, product_id, product_name, quantity, user_address, delivery, payment, shipping, total) VALUES ('$usersId', '$prod_id','$product_name', '$quantity', '$address', '$delivery', '$payment', '$shipFee', '$total')";

			$result = mysqli_query($conn, $sql);	
				
			//decrement quantity to stock in supplies
			$sql1 = "SELECT * FROM supplies WHERE product_id = '$prod_id'";
			$answer = mysqli_query($conn, $sql1);
			while($row=mysqli_fetch_array($answer)){
			
				$stock = $row['inventory'];
				$newQty = $stock - $quantity;

				$stmt = "UPDATE supplies SET inventory='$newQty' WHERE product_id = '$prod_id'";
				$stmtResult = mysqli_query($conn, $stmt);
				
			}		

			$sql2 = "DELETE FROM checkout WHERE usersId = '$usersId' AND product_name = '$product_name'";
			$result = mysqli_query($conn, $sql2);	
		
		}

		if($result){

				header("location: ../trackOrder.php?checkout=orderplaced");
		}
		else {

			echo 'Error: '.mysqli_error($conn);
		}
	}
?>
