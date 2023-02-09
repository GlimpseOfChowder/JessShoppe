<?php include 'header.php'; ?>
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

<title>Shop</title>

<div class = "content-wrapper">
	<div class = "content">
		<div class = "small-container">
			<div class = "row row-2">
				<h2>Search results:</h2>
			</div>
			<div class = "row">
			<?php
				if(isset($_POST['submit-search'])){

					$search = mysqli_real_escape_string($conn, $_POST['search']);
					$sql = "SELECT * FROM products WHERE product_name LIKE '%$search%' OR details LIKE '%$search%'";
					$result = mysqli_query($conn, $sql);
					$queryResult = mysqli_num_rows($result);

					if($queryResult > 0){

						while($row = mysqli_fetch_assoc($result)){			
			?>
						<div class = "col-4" style="margin-bottom: 100px;">
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
					<h4>There are no results found!</h4>
				</div>
			<?php
					}
				}
			?>
			</div>	
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
