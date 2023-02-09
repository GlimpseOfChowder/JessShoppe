<?php include 'header.php'; ?>
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

<title>Shop</title>
<?php
	
	if(isset($_GET['page'])){
		
		$page = $_GET['page'];
	}
	else{
		
		$page = 1;
	}
	
	$num_per_page = 8;
	$start_from = ($page-1)*8;

?>
<div class = "content-wrapper">
	<div class = "content">
		<div class = "small-container">
			<div class = "row row-2">
				<h2>All Products</h2>
			</div>
			<div class = "row">
			<?php 
					include 'includes/dbh.inc.php';
			
					$sql = "SELECT * FROM products LEFT JOIN supplies ON products.product_id = supplies.product_id LIMIT $start_from, $num_per_page";
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
				<p>&#8369;<?php echo $row['price']; ?></p>
				</div>
			</div>
			<?php
					}
			?>
			</div>
			<div style="height: 100px"></div>
			<!-- Pagination -->
			<div class="pagination-btn">
			<?php
				 $pr_query = "SELECT * FROM products";
				 $result = mysqli_query($conn, $pr_query);
				 $total_record = mysqli_num_rows($result);
			
				 $total_page = ceil($total_record/$num_per_page);
				
				 if($page>1)
				 {
					 echo "<a href='allproducts.php?page=".($page-1)."' class='page-btn'><span class='page-btn'><i class='bi bi-arrow-left-short'></i></span></a>";
				 }
			
				 for($i=1;$i<$total_page;$i++)
				 {
					//echo "<a href='allproducts.php?page=".$i."' class='page-btn'><span class='page-btn'></span></a>";
					if($i == $page){
						
						echo "<a href='allproducts.php?page=".$i."' class='page-btn'><span class='page-btn' style='background: #F584C6'>$i</span></a>";
					}
					else {
						
						echo "<a href='allproducts.php?page=".$i."' class='page-btn'><span class='page-btn'>$i</span></a>";
					}
				 }
					
				 if($i>$page)
				 {
					 echo "<a href='allproducts.php?page=".($page+1)."' class='page-btn'><span class='page-btn'><i class='bi bi-arrow-right-short'></i></span></a>";
				 }
			?>
			</div>	
		</div>
	</div>
</div>	


<?php include 'footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

</body>
</html>