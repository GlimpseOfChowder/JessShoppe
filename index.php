<?php include 'header.php'; ?>

		<title>Homepage</title>
				<div class = "row">
					<div class = "col-2">
						<h1> Welcome to Jess Shoppe!</h1>
						<p>PH GROUP ORDERS OF ALL KPOP GROUPS | 
							<br> UPDATES 
							<a href="https://twitter.com/JESSSHOPPE_Q"><b><font color = "#E93DD8">@JESSSHOPPE_Q</font></b></a>
						| PAYMENT ACCOUNT <a href = "https://twitter.com/JESSSHOPPE_P"><b><font color = "#E93DD8">@JESSSHOPPE_P</font></b></a>
						| DTI REGISTERED |</p>
						<a href = "allproducts.php" class = "btn-shop">Shop Now</a>
					</div>
					<div class = "col-2">
						<img src = "images/wallpaper.png">
					</div>
				</div>	
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

			<!-- Categories -->
				<div class = "categories">
					<div class = "small-container">
						<div class = "row">
							<div class = "col-3">
								<img src = "images/products/category1.jfif" class = "img">
							</div>
							<div class = "col-3">
								<img src = "images/products/category3.png" class = "img">
							</div>
							<div class = "col-3">
								<img src = "images/products/category2.jfif" class = "img">
							</div>											
						</div>
					</div>				
				</div>
			<!-- Featured Products -->
				<div class = "small-container">
					<h2 class = "title">Featured Products</h2>
					<div class = "row">
					<?php 
							include 'includes/dbh.inc.php';

							$sql = "SELECT * FROM products LEFT JOIN supplies ON products.product_id = supplies.product_id";
							$result = mysqli_query($conn, $sql);
							while($row=mysqli_fetch_array($result)){
								
								if($row['status'] == "Featured"){
					?>
					<div class = "col-4"  style="margin-bottom: 100px;">
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
					?>
					</div>
				</div>
			<!-- Brands -->
				<div class = "brands">
					<div class = "small-container">
						<div class = "row">
						 	<div class = "col-5">
								<img src = "images/ktown.png" class = "img-brands">
							</div>
							<div class = "col-5">
								<img src = "images/ygselect.PNG" class = "img-brands">
							</div>
							<div class = "col-5">
								<img src = "images/bp.PNG" class = "img-brands">
							</div>
							<div class = "col-5">
								<img src = "images/lalamove.png" class = "img-brands">
							</div>
							<div class = "col-5">
								<img src = "images/gcash-logo.png" class = "img-brands">
							</div>		
						</div>
					</div>
				</div>
					
<?php include 'footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

	</body>
</html>