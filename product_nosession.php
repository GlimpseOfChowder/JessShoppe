<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

<title>Product Details</title>

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
						<!-- Retrieve category -->
						<input type="hidden" name="category_name" value="<?php echo $row['category_name']; ?>">
						<p>Category / <?php echo $row['category_name']; ?></p>
						<!-- Retrieve prod name -->
						<input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
						<h1><?php echo $row['product_name']; ?></h1>
						<!-- Retrieve price -->
						<h4 class = "price"><input type="hidden" name="price" value="<?php echo $row['price']; ?>"> 
						<!-- Html Peso Sign-> -->&#8369;<?php echo $row['price']; ?></h4>
						<input type="number" value="1" name="product_quantity">
						<h3>Description <i class="bi bi-text-indent-left"></i><span style="font-size: 14px">
						<?php echo $row['inventory']; ?> piece(s) available</span></h3>
						<p style="height: 100px; overflow: auto" class="scrollbar-lady-lips"><input type="hidden" name="details" value="<?php echo $row['details']; ?>"><?php echo $row['details']; ?></p>
						<a href="#addtocartnosession" data-toggle="modal" class="btn-shop">Add to Cart</a>
					</div>
				</div>
				</form>	
				<?php
							}
						}
				?>
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
									$username = $row['usersUid'];
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
										$username = $row['usersUid'];
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

				<div style="height:20px;"></div>
				<div class = "small-container">
					<div class = "row row-2">
						<h2>Related Products</h2>
						<p><a  href = "allproducts.php" style="color: #F584C6">View More</a></p>
					</div>

				<div class = "row">
				<?php 
					include 'includes/dbh.inc.php';
			
					$sql = "SELECT * FROM products ORDER BY RAND() LIMIT 4";
					$result = mysqli_query($conn, $sql);
					while($row=mysqli_fetch_array($result)){
				?>
				<div class = "col-4">
					<h4><a href="products.php?product=<?php echo $row['product_id']; ?>"></h4>
					<img src="../JessShoppe/admin/upload/<?php echo $row['image'];?>" class="img">
					<?php echo $row['product_name']; ?></a>
					<p>&#8369;<?php echo $row['price']; ?></p>
				</div>
				<?php
						}
				?>
				</div>
				</div>
			</div>
		</div>

<!-- Add to cart modal-->
    <div class="modal fade" id="addtocartnosession" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class='modal-header'>
					<h5 class='modal-title' style="color: black">Hi there!</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
                <div class="modal-body">
					Please <a href="account.php" style="color: #f5a6b9">login</a> first to add this item.
           		</div>
			</div>
        </div>
    </div>

<?php include 'includes/scripts.php'; ?>


</body>
</html>