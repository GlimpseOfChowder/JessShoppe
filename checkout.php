<?php include 'header.php'; ?>
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

	<title>Checkout</title>
	<?php
			if(isset($_SESSION["useruid"])) {

	?>
	<div class = "content-wrapper small-container cart-page">
		<div class = "container box-body">
			<div class = "row">
				<div class='box-header-cart with-border'>
				<h4 class='box-title'><i class='bi bi-cart'></i><b>Checkout</b></h4>
				</div>
				<div class="table-responsive">
					<table id = 'cartItems' class="scrollbar-lady-lips" style="overflow: auto;">
					<thead>
						<th hidden></th>
						<th>Product</th>
						<th>Qty</th>
						<th>Subtotal</th>
					</thead>
					<tbody>
					<?php
						include 'includes/dbh.inc.php';

						$sql = "SELECT * FROM checkout LEFT JOIN products ON checkout.product_id = products.product_id WHERE checkout.usersId = '".$_SESSION['userid']."'";

						$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
						while($row=mysqli_fetch_array($result)){
					?>
					<tr>
						<td hidden><?php echo $row['cart_id']; ?></td>
						<td>
							<div class = 'cart-info'>
								<img src="../JessShoppe/admin/upload/<?php echo $row['image']; ?>" class="img-cart">
								<div>
									<p style="margin-bottom: 0;"><?php echo $row['product_name']; ?></p>
									<small>Price: &#8369;<?php echo $row['price']; ?></small>
								</div>
							</div>
						</td>
						<td><input type='number' class="disabled" name="product_quantity" value="<?php echo $row['quantity']; ?>"></td>
						<td>&#8369;<?php echo $row['price']; ?></td>
					</tr>
					</tbody>
					<?php
						}
					?>
			</table>
				</div>
				<div class = 'row-3 place-order-row'>
					<a href = '#checkoutModal' data-toggle="modal" name="place_order" class = 'btn-shop place-order-btn checkout'>Place Order</a>
				</div>
		</div>
		</div>
	</div>
	<?php
			}
	?>

	<!-- Checkout Summary Modal -->
	<div class='modal fade' id='checkoutModal' tabindex='-1' role='dialog' aria-hidden='true'>
		<div class='modal-dialog modal-dialog-centered' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title' style="color: #595c5f;">Checkout Summary</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
					<form action="includes/checkout.inc.php" method='POST'>
						<!-- Retrieve current user id -->
						<input type="hidden" name="usersId" id="usersId" value="<?php echo $_SESSION['userid']; ?>">
						<?php
							include 'includes/dbh.inc.php';

							$sql = "SELECT * FROM checkout LEFT JOIN products ON checkout.product_name = products.product_name WHERE checkout.usersId = '".$_SESSION['userid']."'";

							$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
							while($row=mysqli_fetch_array($result)){
						?>
						<div class="row" style="justify-content: center;">
								<input type="hidden" name="product_id[]" value="<?php echo $row['product_id'] ;?>">
								<label class="label-modal">Product Name</label>
								<input type="text"  style="width: 50%" class="form-control disabled" name="product_name[]" id="product_name[]" placeholder="Product Name" value="<?php echo $row['product_name']; ?>">
						</div>
						<div class="row row-modal">
							<label class="label-modal">Product Price</label>
							<input type="text" class="form-control disabled productPrice" name="price[]" id="price[]" placeholder="price" value="<?php echo $row['price']; ?>">

							<label class="label-modal">Quantity</label>
							<input type="text" class="form-control disabled quantity" name="quantity[]" id="quantity[]" placeholder="quantity" value="<?php echo $row['quantity']; ?>">
							<div style="border-top: 1px solid #d6d7d7; margin-bottom: 5px"></div>
						</div>
						<?php
							}
						?>

						<div class="row row-modal">
								<?php
										$sql = "SELECT * FROM users WHERE usersId = '".$_SESSION['userid']."'";
										$result = mysqli_query($conn, $sql);

										while($row=mysqli_fetch_array($result)) {
								?>
								<label class="label-modal">Address</label>
								<select class="address" name="addressList">
									<option value="<?php echo $row['address']; ?>"><?php echo $row['address']; ?></option>
									<option value="<?php echo $row['ship_address']; ?>"><?php echo $row['ship_address']; ?></option>
									<option value="<?php echo $row['bill_address']; ?>"><?php echo $row['bill_address']; ?></option>
								</select>
								<?php

										}
								?>
						</div>
						<div style="border-top: 1px solid #d6d7d7; margin-top: 5px; margin-bottom: 5px;"></div>
						<div class="row custom-cbx">
							<div>
								<select style="border: 1px solid #cecece" name="deliveryMethod" onchange="payment(this)">
									<option disabled selected hidden>Delivery Method</option>
									<?php
											$stmt = "SELECT * FROM deliveryinfo";
											$res = mysqli_query($conn, $stmt);

											while($row=mysqli_fetch_array($res)){
									?>
									<option value="<?php echo $row['shipping']; ?>, <?php echo $row['deliveryMethod']; ?>"><?php echo $row['deliveryMethod'];?></option>
									<?php
											}
									?>
								</select>
								<select	style="border: 1px solid #cecece" name="paymentMethod" id="paymentMethod">
									<option disabled selected hidden>Payment Method</option>
									<?php
											$stmt = "SELECT * FROM paymentinfo";
											$res = mysqli_query($conn, $stmt);

											while($rowStmt=mysqli_fetch_array($res)){
									?>
									<option value="<?php echo $rowStmt['paymentMethod']; ?>" data-client="<?php echo $rowStmt['client']; ?>" data-number="<?php echo $rowStmt['account_number']; ?>"><?php echo $rowStmt['paymentMethod']; ?></option>
									<?php
											}
									?>
								</select>
							</div>
						</div>
						<div style="border-top: 1px solid #d6d7d7; margin-top: 5px; margin-bottom: 5px;"></div>
						<div class="row row-modal">
							<label class="label-modal">Payment Information</label>
							<textarea type="text" style="width: 75%" class="form-control disabled" name="paymentInfo" id="paymentInfo"></textarea>
						</div>

						<!-- For Subtotals, Shipping Fee and Total -->
						<div class="row row-modal" style="margin-right: 15px; margin-top: 15px">
							<label class="label-modal">Subtotal</label>
							<?php
									$sql = "SELECT * FROM checkout WHERE usersId = '".$_SESSION['userid']."'";
									$result = mysqli_query($conn, $sql);
									// variable for subtotal
									$real_subtotal = 0;
									while($row=mysqli_fetch_array($result)){
										$real_subtotal += $row['subtotal'];
									}
							?>
							<input type="text"  id="subtotal" style="width: 28%" class="form-control disabled"
								   value="<?php echo $real_subtotal; ?>">
						</div>
						<div class="row row-modal"  style="margin-right: 43px;">
								<label class="label-modal">Shipping Fee</label>
								<input type="text" name="shipFee" id="shipFee" style="width: 30%" value="0" class="form-control disabled">
						</div>
						<div class="row row-modal"  style="margin-left: 20px;">
								<label class="label-modal">Total</label>
								<input type="text" name="total" id="total" style="width: 28%" class="form-control disabled">
						</div>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' style="background: gray" data-dismiss='modal'>Close</button>
					<a href="checkout.php?id=<?php echo $row['checkout_id']; ?>">
					<button type='submit' name='place_order' class='btn btn-primary' style="background: #ed7b97">Place Order</button></a>
				</div>
					</form>
			</div>
		</div>
	</div>

<?php include 'includes/scripts.php'; ?>
<?php include 'footer.php'; ?>


</body>
</html>
