<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/topbar.php'; ?>
	 
	    <title>Admin - Product Management</title>

		<?php
			if(isset($_SESSION["useruid"])) {
			
			$sql = "SELECT * FROM users WHERE usersId = '".$_SESSION['userid']."'";
			$result = mysqli_query($conn, $sql);
				
			while($row=mysqli_fetch_array($result)) {
				
				if($row["usertype"] == "admin"){
		?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
				
                    <!-- DataTables -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <a href="#addnew" data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add New Product</a>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Product Management</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="productList" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th hidden>ID</th>
											<th>Supplier</th>
											<th>Image</th>
											<th>Category</th>
                                            <th>Product Name</th>
                                            <th>Details</th>
											<th>Stock</th>
											<th>Original Cost</th>
                                            <th>Selling Price</th>
											<th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										include 'includes/dbh.inc.php';
										
										$sql = "SELECT * FROM products LEFT JOIN supplies ON products.product_id = supplies.product_id";
										$result = mysqli_query($conn, $sql);
										
										while($row=mysqli_fetch_array($result)){
									?>
									<tr>
										<td hidden><?php echo $row['product_id']; ?></td>
										<td><?php echo $row['supplier_name'];?></td>
										<td>
											<?php
													if($row['image'] == ""){

														echo "<img class='img-profile 'src='img/product.png' width='100px' height='100px'>";
													}
													else {
											?>
											<img src="upload/<?php  echo $row['image'];?>" class="image" width="100" height="100">
											<?php 
													} 
											?>
										</td>
										<td><?php echo $row['category_name']; ?></td>
										<td><?php echo $row['product_name']; ?></td>
										<td><?php echo $row['details']; ?></td>	
										<td><?php echo $row['inventory']; ?></td>
										<td><?php echo $row['cost']; ?></td>
										<td><?php echo $row['price']; ?></td>
										<td><?php echo $row['status']; ?></td>
										<td style="text-align: center">
										<!-- Edit Button -->
										<a href="#editModal" class="text-white edit" <?php echo $row['product_id']; ?> data-toggle="modal"><button class='btn-edit btn-circle btn-sm'><i class="bi bi-pen"></i></button></a>
										<!-- Delete Button
										<a href="#deleteproductmodal" class="text-white deleteproduct" <?php echo $row['product_id']; ?> data-toggle="modal"><button class='btn-block btn-circle btn-sm'><i class='fas fa-ban'></i></button></a>-->
										</td>
									</tr>
									<?php
											}
									?>
									</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
				<!-- End of container-fluid -->
                </div>  
			<!-- End of Main Content from topbar.php -->
            </div>
            
			<?php			
						}
					}
				}
				else {
			?>	
				<!-- For unwelcome visitors -->			
				<div class = "content-wrapper">
					<div class = "container box-body" style="padding-top: 200px; padding-left: 400px">
						<div class="container-fluid">
							<!-- 404 Error Text -->
							<div class="text-center">
								<div class="error mx-auto" data-text="404">404</div>
								<p class="lead text-gray-800 mb-5">Page Not Found</p>
								<p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
								<a href="../index.php" style="color: #f5a6b9">&larr; Back to Homepage</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
					}
			?>

	<!-- Add New Modal-->
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class='modal-header'>
					<h5 class='modal-title'>Add a product</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="includes/addnew.php" enctype="multipart/form-data">
					<div class="row row-order-modal">
							<label class="label-order-modal">Photo</label>
							<input type="file" class="form-control" style="padding-bottom: 35px; width: 70%; margin-left: 47px" name="prod_image">
					</div>
					<div style="height:10px;"></div>
					<div class="row row-order-modal">
								<label class="label-order-modal">Category</label>
								<select name="category" style="width: 71%; margin-left: 29px">
									<option disabled selected hidden>Category</option>
									<?php 
										include 'includes/dbh.inc.php';

										$sql = "SELECT * FROM category";
										$result = mysqli_query($conn, $sql);

										while($row=mysqli_fetch_array($result)){
									?>	
										<option value="<?php echo $row['category_name']?>"><?php echo $row['category_name']?></option>
									<?php	
										}
									?>
								</select>
					</div>
					<div style="height:10px;"></div>
					<div class="row row-order-modal">
							<label class="label-order-modal">Product Details</label>
							<textarea class="form-control" name="details" style="width: 70%"></textarea>
					</div>
					<div style="height:10px;"></div>
					<div class="row row-order-modal">
							<label class="label-order-modal">Selling price</label>
							<input type="text" class="form-control" name="price" style="width: 66%; margin-left: 20px">
					</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="add" class="btn btn-primary">Add</a>
				</form>
                </div>
            </div>
        </div>
    </div>

	<!-- Edit Modal -->							
	<div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-hidden='true'>
		<div class='modal-dialog modal-dialog-centered' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title'>Edit product</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
					<form action="includes/edit.php" method='POST' enctype="multipart/form-data">
						<input type="hidden" name="update_prod_id" id="update_prod_id">
						<div class="row row-order-modal">
								<label class="label-order-modal">Photo</label>
								<input type="file" class="form-control" style="padding-bottom: 35px; width: 60%; margin-left: 40px" name="prod_image" id="prod_image">
						</div>
						<div style="height:10px;"></div>
						<div class="row row-order-modal">
								<label class="label-order-modal">Category</label>
								<select name="category" id="category_name" style="width:60%;margin-left: 25px">
									<option disabled selected hidden>Category</option>
									<?php 
										include 'includes/dbh.inc.php';

										$sql = "SELECT * FROM category";
										$result = mysqli_query($conn, $sql);

										while($row=mysqli_fetch_array($result)){
									?>	
										<option value="<?php echo $row['category_name']?>"><?php echo $row['category_name']?></option>
									<?php	
										}
									?>
								</select>
						</div>
						<div style="height:10px;"></div>
						<div class="row row-order-modal">
								<label class="label-order-modal">Item Status</label>
								<select name="status" id="status" style="width: 60%; margin-left: 15px">
									<option disabled selected hidden>Status</option>
									<option value="Featured">Featured</option>
									<option value="Not Featured">Not Featured</option>
								</select>
						</div>
						<div style="height:10px;"></div>
						<div class="row row-order-modal">
								<label class="label-order-modal">Product Name</label>
								<input type="text" class="form-control" name="product_name" id="product_name" style="width: 60%" readonly>
						</div>
						<div style="height:10px;"></div>
						<div class="row row-order-modal">
								<label class="label-order-modal">Details</label>
								<textarea class="form-control" name="details" id="details" style="width:60%; margin-left: 40px"></textarea>
						</div>
						<div style="height:10px;"></div>
						<div class="row row-order-modal" style="margin-right: 55px">
								<label class="label-order-modal">Selling price</label>
								<input type="text" class="form-control" name="price" id="price" style="width: 55%; margin-left: 30px">
						</div>
				</div>		
				<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
					<a href="edit_product.php?id=<?php echo $row['product_id']; ?>">	
					<button type='submit' name='edit' class='btn btn-primary'>Save</button></a>
				</div>
					</form>
			</div>
		</div>
	</div>

	  <!-- Delete Modal -->
	  <div class="modal fade" id="deleteproductmodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/delete_prod.php" method="POST">
                    <div class="modal-body">Do you want to remove this product?</div>
                        <input type="hidden" name="delete_product_id" id="delete_product_id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="delete_prod.php?id=<?php echo $row['product_id']; ?>">
                        <button type="submit" name="deleteproduct" class="btn btn-primary">Remove</button></a>
                    </div>
				</form>
            </div>
        </div>
    </div>
	

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>



</body>
</html>