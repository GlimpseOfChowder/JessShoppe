<?php
	include 'dbh.inc.php';

	if(isset($_POST['update_orders'])) {

		$order_id=$_POST['update_order_id'];

		$order_status = $_POST['order_status'];



		$sql = "UPDATE orders SET order_status='$order_status' WHERE order_id='$order_id'";

		$result = mysqli_query($conn, $sql);

		if($result)
		{
			echo "<script> alert('Order has been updated') </script>";
			header("location: ../index.php");
		}
		else
		{
				echo 'Error: '.mysqli_error($conn);
		}
	}


	if(isset($_POST['paid_order'])) {

		$order_id=$_POST['update_order_id'];
		$user_id = $_POST['usersId'];
		$prod_id = $_POST['product_id'];
		
		$product = $_POST['product_name'];
		$quantity = $_POST['quantity'];
		$delivery = $_POST['deliveryMethod'];
		$shipping = $_POST['shipping'];
		$total = $_POST['total'];
		$payment = $_POST['paymentMethod'];
		$order_status = $_POST['order_status'];
		$order_status = "Completed";
		
		$revenue = $_POST['revenue'];
		
		//Getting price from product table to compute for revenue
		$sql898 = "SELECT * FROM products WHERE product_name = ?;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql898);
		mysqli_stmt_bind_param($stmt, "s", $product);
		mysqli_stmt_execute($stmt);
		$result099 = mysqli_stmt_get_result($stmt);
		$rows= mysqli_fetch_assoc($result099);
		$sellPrice = $rows['price'];
		$revenue = ($quantity * $sellPrice) + $shipping;
		
		//redirect to sales report
		$sql = "INSERT INTO sales (product_name, quantity, shipping, revenue) VALUES ('$product', '$quantity', '$shipping', '$revenue')";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		//redirect to inventory reports
		$sql3 ="INSERT INTO inventoryreport (product_name, quantity, revenue) VALUES ('$product', '$quantity', '$revenue')";
		$result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

		//redirect to customer's purchase history
		$sql1 = "INSERT INTO purchase_history (order_id, usersId, product_id, product_name, delivery, quantity, payment, shipping, total, order_status) VALUES ('$order_id', '$user_id', '$prod_id', '$product', '$delivery', '$quantity', '$payment', '$shipping', '$total', '$order_status')";
		$result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

		$sql2 = "DELETE FROM orders WHERE order_id = $order_id";
		$result2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));

		if($result)
		{
			echo "<script> alert('Sales has been updated') </script>";
			header("location: ../index.php");
		}
		else
		{
				echo 'Error: '.mysqli_error($conn);
		}
	}
?>
