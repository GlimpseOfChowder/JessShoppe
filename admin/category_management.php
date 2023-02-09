<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/topbar.php'; ?>
	 
	    <title>Admin - Category Management</title>

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
                        <a href="#addcategory" data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add New Category</a>
                    </div>			
					<?php 
							if(isset($_GET['category'])){

								if($_GET['category'] == "added"){

									echo "<div style='text-align: center; color: red; font-size: 16px'>New category added!</div>";
								}
							}
					?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Category Management</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="productList" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th hidden>Category ID</th>
											<th>Category Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										include 'includes/dbh.inc.php';
										
										$sql = "SELECT * from category";
										$result = mysqli_query($conn, $sql);
										
										while($row=mysqli_fetch_array($result)){
																			
									?>
									<tr>
										<td hidden><?php echo $category_id = $row['category_id']; ?></td>
										<td><?php echo $category_name = $row['category_name']; ?></td>
										<td style="text-align: center">
										<!-- Delete Button -->
										<a href="#deletecategory" class="text-white deletecategory" <?php echo $row['category_id']; ?> data-toggle="modal"><button class='btn-block btn-circle btn-sm'><i class='fas fa-ban'></i></button></a>
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
    <div class="modal fade" id="addcategory" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class='modal-header'>
					<h5 class='modal-title'>Add a category:</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="includes/add_category.php">
					<div class="row">
						<div class="col-lg-10">
							<input type="text" class="form-control" name="category_name" placeholder="Category Name">
						</div>
					</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="addcategory" class="btn btn-primary">Add</a>
				</form>
                </div>
            </div>
        </div>
    </div>

	  <!-- Delete Modal -->
	  <div class="modal fade" id="deletecategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/delete_category.php" method="POST">
                    <div class="modal-body">Do you want to remove this category?</div>
                        <input type="hidden" name="delete_category_id" id="delete_category_id">
						<input type="text"  class="form-control disabled" name="cat_name" id="cat_name" style="width: 60%;margin-left: 10px">
						<div style="height: 10px"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<a href="delete_prod.php?id=<?php echo $row['category_id']; ?>">
                        <button type="submit" name="deletecategory" class="btn btn-primary">Remove</button></a>
                    </div>
				</form>
            </div>
        </div>
    </div>
	

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>



</body>
</html>