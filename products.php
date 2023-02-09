<?php include 'header.php' ?>
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

<title>Product Details</title>

	<?php
			if(isset($_SESSION["userid"])) {

				include 'includes/dbh.inc.php';

	?>
	<div class = "content-wrapper">
		<div class = "content">
			<div class = "small-container prod-details">
				<form action="" method="POST" enctype="multipart/form-data">
				<div class = "row">
					<?php
						if(isset($_GET['product'])){
							$prod_id = $_GET['product'];

							$sql = "SELECT * FROM products LEFT JOIN supplies ON products.product_id = supplies.product_id WHERE products.product_id = $prod_id";
							$result = mysqli_query($conn, $sql);

							while($row=mysqli_fetch_array($result)){

					?>
					<div class = "col-2">
						<img src="../JessShoppe/admin/upload/<?php echo $row['image']; ?>" class="img-single-prod" name=prod_image>
					</div>
					<div class = "col-2">
						<!-- Retrieve current user id -->
						<input type="hidden" name="usersId" value="<?php echo $_SESSION['userid']; ?>">
						<!-- Retrieve category and prod id -->
						<input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
						<input type="hidden" name="category_name" value="<?php echo $row['category_name']; ?>">
						<p>Category / <?php echo $row['category_name']; ?></p>
						<!-- Retrieve prod name -->
						<input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
						<h1><?php
							 			if ($row['supplier_name'] == ""){
									
											echo "";
										}
							 			else {
											$sups = $row['supplier_name'];
											echo "[$sups]";
										}
								?>  <?php echo $row['product_name']; ?></h1>
						<!-- Retrieve price -->
						<h4 class = "price"><input type="hidden" name="price" value="<?php echo $row['price']; ?>">
						<!-- Html Peso Sign-> -->&#8369;<?php echo $row['price']; ?></h4>
						<input type="number" value="1" name="product_quantity">
						<!-- Retrieve inventory -->
						<h3>Description <i class="bi bi-text-indent-left"></i><span style="font-size: 14px">
						<?php echo $row['inventory']; ?> piece(s) available</span></h3>
						<!-- Retrieve details -->
						<p style="height: 100px; overflow: auto" class="scrollbar-lady-lips"><input type="hidden" name="details" value="<?php echo $row['details']; ?>"><?php echo $row['details']; ?></p>
						<!-- Conditional add to cart button -->
						<?php
								$sql = "SELECT * FROM users WHERE usersId = '".$_SESSION['userid']."'";
								$result = mysqli_query($conn, $sql);

								while($row=mysqli_fetch_array($result)){
									if($row['status'] == "verified"){
						?>
						<!-- Add to cart button for verified users -->
						<button type="submit" name="addtocart" class = "btn-shop">Add to Cart</button>
						<?php
									}
									else {
						?>
						<!-- Add to cart button for not verified users -->
						<button type="submit" style="cursor: not-allowed" class = "btn-shop" disabled>Add to Cart</button>
						<?php
									}
								}
						?>
					</div>
				</div>
				</form>
				
				<!-- Feedback Form -->
				<div class = 'content-wrapper'>
					<div class = 'content'>
						<div class = 'card-body-custom card scrollbar-lady-lips feedback' style="height: auto">
							<div class="box-header with-border">
								<h4 class="box-title"><b>Feedback</b></h4>
							</div>
							<?php 
									include 'includes/dbh.inc.php';

									$sql = "SELECT * FROM feedback 
									LEFT JOIN users ON feedback.usersId = users.usersId 
									WHERE feedback.product_id = $prod_id";

									$result = mysqli_query($conn, $sql);
									$queryResult = mysqli_num_rows($result);	

									if($queryResult > 0){

										while($row=mysqli_fetch_array($result)){

											$date = new DateTime($row['date_posted']);
							?>
							<div class = 'wallpost'>		
								<?php
									$username = $_SESSION['useruid'];
									if($row['image'] == ""){

										echo "<img class='image rounded-circle' width='50px;' height='50px' style='margin-right: 10px 'src='admin/img/undraw_profile_1.svg'>";
									}
									else {
								?>			
								<img src="admin/upload/users/<?php echo $username ?>/<?php echo $row['image'];?>" class="image rounded-circle" width="50px;" height="50px" style="margin-right: 10px">
								<?php 
										} 
								?>
								<h3 class = 'jess'><?php echo $row['usersUid']; ?></h3>
								<div class = 'card-body-post'>
									<p class = "postTime"><?php echo $date->format('h:i a - M d Y '); ?></p>
									<p style="margin-top: 5px"><?php echo $row['feedback']; ?></p>					
									<?php
										$username = $_SESSION['useruid'];
										if($row['feedback_image'] == ""){

											echo "<img class='img-single-prod image-feedback'src='admin/img/blackpink.jpg'>";
										}
										else {
									?>			
									<img src="admin/upload/users/<?php echo $username ?>/<?php echo $row['feedback_image'];?>" class="img-single-prod  image-feedback">
									<?php 
											} 
									?>
								</div>
								<?php
										}
									}
									else {

										echo "<div style='text-align: center; margin-top: 20px; margin-bottom: 20px;'>No ratings yet!</div>";
									}	
								?>
							</div>
						</div>
					</div>
				</div>
				<?php
							}
						}
				?>
				<div style="height:20px;"></div>
				<div class = "small-container">
					<div class = "row row-2">
						<h2>Related Products</h2>
						<p style="padding-top: 10px;"><a  href = "allproducts.php" style="color: #F584C6">View More</a></p>
					</div>
				<div class = "row">
				<?php
					include 'includes/dbh.inc.php';

					$sql = "SELECT * FROM products LEFT JOIN supplies ON products.product_id = supplies.product_id ORDER BY RAND() LIMIT 4";
					$result = mysqli_query($conn, $sql);
					while($row=mysqli_fetch_array($result)){
				?>
				<div class = "col-4" style="margin-bottom: 100px;">
					<h4><a style="font-size: 11px" href="products.php?product=<?php echo $row['product_id']; ?>"></h4>
					<img src="../JessShoppe/admin/upload/<?php echo $row['image'];?>" class="img">
					<div style="height: 10px">
						<?php
							 			if ($row['supplier_name'] == ""){
									
											echo "";
										}
							 			else {
											$sups = $row['supplier_name'];
											echo "[$sups]";
										}
								?>  <?php echo $row['product_name']; ?></a>
						<p>&#8369;<?php echo $row['price']; ?></p></div>	
				</div>
				<?php
							}
						}
						else{

							include 'product_nosession.php';
						}
				?>
				</div>

				</div>
			</div>
		</div>


<!-- Php method for adding to cart -->
<?php
	include 'includes/dbh.inc.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		$product_id = $_POST['product_id'];

		$user_id = (int)$_POST['usersId'];
		$category_name = $_POST['category_name'];
		$product_name = $_POST['product_name'];
		$details = $_POST['details'];
		$quantity = $_POST['product_quantity'];
		$price = $_POST['price'];

		$sql4 = "SELECT * FROM cart WHERE usersId = ? AND product_id = ?;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $sql4);
		mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);
		mysqli_stmt_execute($stmt);
		$result_2 = mysqli_stmt_get_result($stmt);
		
		if($result_2->num_rows > 0){
			
			$item_2 = mysqli_fetch_assoc($result_2);
			$cart_id = $item_2['cart_id'];
			$quantity2 = $item_2['quantity']+$quantity;
			
			$sql = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
			$stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt, $sql);
			mysqli_stmt_bind_param($stmt, "ii", $quantity2, $cart_id);
			
			if(mysqli_stmt_execute($stmt)){
				
				echo "<script> alert('Product added to cart') </script>,
					  <meta http-equiv='refresh' content='0'>";
			}
			else{
					echo 'Error: '.mysqli_error($conn);
			}
		}
		else {

			$sql = "INSERT INTO cart (product_id, usersId, category_name, product_name, details, quantity, price) VALUES ('$product_id', '$user_id', '$category_name', '$product_name', '$details', '$quantity', '$price')";

			$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

			if($result)
			{
				echo "<script> alert('Product added to cart') </script>,
					  <meta http-equiv='refresh' content='0'>";
			}
			else
			{
					echo 'Error: '.mysqli_error($conn);
			}
		}
	}
?>

<?php include 'footer.php'; ?>
<?php include 'includes/scripts.php'; ?>


</body>
</html>
