<?php include 'header.php'; ?>
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

	<title>Cart Page</title>

	<?php
			if(isset($_SESSION["useruid"])) {

	?>
		<div class = 'small-container cart-page'>
			<div class='box-header-cart with-border'>
				<h4 class='box-title'><i class='bi bi-cart'></i><b> Your Cart</b></h4>
			</div>
			<form action="" method="post">
			<div class="table-responsive scrollbar-lady-lips">
				<table id = 'cartItems'>
				<thead>
					<th style="text-align: center">Select</th>
					<th>Product</th>
					<th>Qty</th>
					<th style="text-align: center">Subtotal</th>
					<th style="text-align: center">Delete</th>
				</thead>
				<!-- Retrieve current user id -->
				<input type="hidden" name="usersId" value="<?php echo $_SESSION['userid']; ?>">
				<tbody>
					<?php
						 include 'includes/dbh.inc.php';

						 $sql = "SELECT * FROM cart 
						 LEFT JOIN products ON cart.product_id = products.product_id
						 LEFT JOIN supplies ON products.product_id = supplies.product_id
						 WHERE cart.usersId = '".$_SESSION['userid']."'";
						 $count = 1;
						 $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
						 while($row=mysqli_fetch_array($result)){
					?>
					<tr>
						<!-- Checkbox -->
						<td style="text-align: center">
							<input type="hidden" name="product_id[]" value="<?php echo $row['product_id']; ?>">
							<input type="hidden" name="verify[]" value="<?php echo $row['cart_id']; ?>">
							<input type="checkbox" class="checkbox" name="cart_id[]" value="<?php echo $row['cart_id']; ?>">
						</td>
						<td>
						<div class = 'cart-info'>
							<img src="../JessShoppe/admin/upload/<?php echo $row['image']; ?>" class="img-cart">
							<div>
								<input type="hidden" name="product_name[]" value="<?php echo $row['product_name']; ?>">

								<p style="margin-bottom: 2px">
								<?php
							 			if ($row['supplier_name'] == ""){
									
											echo "";
										}
							 			else {
											$sups = $row['supplier_name'];
											echo "[$sups]";
										}
								?> <?php echo $row['product_name']; ?></p>
								<small>Price: &#8369;<?php echo $row['price']; ?></small><br>

								<input type="hidden" name="category_name[]" value="<?php echo $row['category_name']; ?>">
								<input type="hidden" name="details[]" value="<?php echo $row['details']; ?>">
							</div>
						</div>
						</td>
						<td><input type="number" name="quantity[]" value="<?php echo $row['quantity']; ?>"></td>
						<td style="text-align: center">&#8369;<?php echo $row['price']; ?>
							<input type="hidden" name="price[]" value="<?php echo $row['price']; ?>">
						</td>
						<!-- X button -->
						<td style="text-align: center">
							<a href="#deletecart<?php echo $count; ?>" class="text-white deletecart" <?php echo $row['cart_id']; ?> data-toggle="modal"><i  class='bi bi-x-circle'></i></button>
						</td>
							<!-- Delete Cart Item Modal -->
						  <div class="modal fade" id="deletecart<?php echo $count; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Remove product</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="cart_delete.php" method="POST">
										<div class="modal-body">Do you want to remove this product?</div>
											<input type="text" class="disabled" style="width: 90%; margin-left: 20px" value="<?php echo $row['product_name']; ?>">
											<input type="hidden" name="delete_cart_id" value="<?php echo $row['cart_id']; ?>">
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: gray">Cancel</button>
											<a href="cart_delete.php?id=<?php echo $row['cart_id']; ?>">
											<button type="submit" name="deletecart" class="btn btn-primary">Remove</button></a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</tr>
					<?php
						$count++;	 
						 }
					?>
				</tbody>
			</table>
			</div>
			<div class = 'row-cart'>
				<!--<button type="submit" name="update" class = 'btn-shop checkout-btn'>Update</button>-->
				<button type="submit" name="checkout" class = 'btn-shop checkout-btn'>Checkout</button>
			</div>
			</form>
		</div>
		<?php

			}
			else {
					include 'cart_nosession.php';
			}
		?>

<!-- method for checkout -->
<?php
	include 'includes/dbh.inc.php';

	if(isset($_POST['checkout'])) {

		$counter = count($_POST['product_id']);
		$user_id = $_POST['usersId'];
		if(isset($_POST["cart_id"])){

		for($i=0;$i<$counter;$i++){
				
				$product_id = $_POST['product_id'][$i];
				$category_name = $_POST['category_name'][$i];
				$product_name = $_POST['product_name'][$i];
				$details = $_POST['details'][$i];
				$quantity = $_POST['quantity'][$i];
				$price = $_POST['price'][$i];
				$verify = $_POST['verify'][$i];
				$subtotal = $price * $quantity;
				

				if (in_array($verify, $_POST['cart_id'])) {

					$sql = "INSERT INTO checkout (usersId, product_id, category_name, product_name, details, quantity, price, subtotal) VALUES ('$user_id', '$product_id', '$category_name', '$product_name', '$details', '$quantity', '$price', '$subtotal')";

					$result = mysqli_query($conn, $sql);

					$sql2 = "DELETE FROM cart WHERE usersId = '$user_id' AND product_id = '$product_id'";
					$result = mysqli_query($conn, $sql2);
				}
				else {

					continue;
				}
			}
		}

		else {
			echo "<script> alert('Please select a product to be checked out!') </script>, <script> location.href='cart.php'; </script>";
		}

		if($result)
		{
			echo "<script> location.href='checkout.php'; </script>";
			exit;
		}
		else
		{
			echo 'Error: '.mysqli_error($conn);
		}

	}
?>

<?php include 'footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
