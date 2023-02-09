<?php include 'header.php'; ?>
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

<title>Shop</title>

	<div class = "content-wrapper">
		<div class = "content">
			<div class = "small-container">
			<div class = "row">
			<?php	
				if(isset($_GET['category'])){
					
					$cat_id = $_GET['category'];

					$sql = "SELECT * FROM category WHERE category_id = $cat_id";
					$result = mysqli_query($conn, $sql);
							
					while($row=mysqli_fetch_array($result)){
						
			?>	
			<div class = "row row-2">	
				<h2><?php echo $row['category_name']; ?></h2>
				<p><a  href = "allproducts.php" style="color: #F584C6">All Products</a></p>
			</div>
			<?php	
						}
					}
					$sql = "SELECT * FROM products LEFT JOIN category ON products.category_name = category.category_name WHERE category.category_id = $cat_id";
					$result = mysqli_query($conn, $sql);
					$queryResult = mysqli_num_rows($result);	
				
					if($queryResult > 0){
						
						while($row=mysqli_fetch_array($result)){
						
						
			?>			
			<div class = "col-4"  style="margin-bottom: 100px;">
				<h4><a style="font-size: 11px" href="products.php?product=<?php echo $row['product_id']; ?>"></h4>
				<img src="../JessShoppe/admin/upload/<?php echo $row['image'];?>" class="img">
				<div style="height: 10px">	
				<?php echo $row['product_name']; ?></a>
				<p>&#8369;<?php echo $row['price']; ?></p>
			    </div>
			</div>
			<?php	
						}
					}
					else {
			?>
			<div class = "col-4">
					<h4 style="height: 300px; width: 110%">There are no results found!</h4>
			</div>
			<?php 
					} 
			?>		
			</div>
		</div>
	</div>

<?php include 'footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

</body>
</html>