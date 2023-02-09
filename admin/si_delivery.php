<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/topbar.php'; ?>

    <title>Shop Info - Delivery Information</title>
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
           	  <a href="#addText" data-toggle="modal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add New Info</a>
           </div>
		   <?php 
					if(isset($_GET['delivery'])){

						if($_GET['delivery'] == "added"){

							echo "<div style='text-align: center; color: red; font-size: 16px'>New info added!</div>";
						}
						if($_GET['delivery'] == "edit"){

							echo "<div style='text-align: center; color: red; font-size: 16px'>New info updated!</div>";
						}
					}
			?>
           <div class="card shadow mb-4">
               <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Delivery Information</h6>
               </div>
               <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-bordered" id="shopInfo" width="100%" cellspacing="0">
                           <thead>
                               <tr>
								   <th hidden>ID</th>
                                   <th>Delivery Method</th>
								   <th>Shipping Fee</th>
								   <th></th>
                               </tr>
                           </thead>
						   <tbody>
							<?php
							   	include 'includes/dbh.inc.php';
							   	
								$sql = "SELECT  * FROM deliveryInfo";
								$result = mysqli_query($conn, $sql);
								while($row=mysqli_fetch_array($result)){
							?>
							<tr>
								<td hidden><?php echo $row['delivery_id']; ?></td>
								<td><?php echo $row['deliveryMethod']; ?></td>
								<td><?php echo $row['shipping']; ?></td>
								<td style="text-align: center">
								<!--Edit Button -->
								<a href="#editDelivery" class="text-white editDelivery" <?php echo $row['delivery_id']; ?> data-toggle="modal"><button class='btn-edit btn-circle btn-sm'><i class='fas fa-edit'></i></button></a>
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
    <div class="modal fade" id="addText" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class='modal-header'>
					<h5 class='modal-title'>Add info</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
                <div class="modal-body">
					<div class="container-fluid">
						<form method="POST" action="includes/si_add_delivery.php">
							<div class="row row-order-modal">
								<label class="label-order-modal">Delivery Method</label>
								<input type="text" class="form-control" name="deliveryMethod" style="width: 60%">
							</div>
							<div style="height: 10px"></div>
							<div class="row row-order-modal">
								<label class="label-order-modal">Shipping Fee</label>
								<input type="text" class="form-control" name="shipping" style="width: 60%; margin-left: 19px">
							</div>
						</div>
						<div style="height:10px;"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="submit" name="addtext" class="btn btn-primary">Add</a>
						</form>
					</div>
            	</div>
       	 	</div>
    	</div>
	</div> 

	<!-- Edit Modal -->							
	<div class='modal fade' id='editDelivery' tabindex='-1' role='dialog' aria-hidden='true'>
		<div class='modal-dialog modal-dialog-centered' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title'>Edit Info</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
			<div class='modal-body'>
				<form action="includes/si_edit_delivery.php" method='POST'>
					<div class='form-group'>	
						<input type='hidden' name='update_id' id='update_id'>	
							<div class="row row-order-modal">
								<label class="label-order-modal">Delivery Method</label>
								<input type="text" class="form-control" name="deliveryMethod" id="deliveryMethod" style="width: 60%">
							</div>
							<div style="height: 10px"></div>
							<div class="row row-order-modal">
								<label class="label-order-modal">Shipping Fee</label>
								<input type="text" class="form-control" name="shipping" id="shipping" style="width: 60%; margin-left: 19px;">
							</div>
				</div>
			</div>		
			<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
					<a href="si_edit_privacy.php?id=<?php echo $row['payment_id']; ?>">
						<button type='submit' name='editText' class='btn btn-primary'>Save</button></a>
				</form>
			</div>
			</div>
		</div>
	</div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
	
</body>
</html>