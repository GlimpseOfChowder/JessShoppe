<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/topbar.php'; ?>
<?php
  include 'includes/dbh.inc.php';
?>

    <title>Admin - Customer Management</title>

	<?php
			if(isset($_SESSION["useruid"])) {

			$sql = "SELECT * FROM users WHERE usersId = '".$_SESSION['userid']."'";
			$result = mysqli_query($conn, $sql);
      		$counter = 1;
			while($row=mysqli_fetch_array($result)) {

				if($row["usertype"] == "admin"){
	?>
       <!-- Begin Page Content -->
       <div class="container-fluid">

           <!-- DataTable -->
           <div class="card shadow mb-4">
               <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Customer Account Management</h6>
               </div>
               <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-bordered" id="userAccounts" width="100%" cellspacing="0">
                           <thead>
                               <tr>
                                   <th hidden>ID</th>
                                   <th>Full Name</th>
                                   <th>Username</th>
                                   <th>Email</th>
								   <th>Identification</th>
                                   <th>Status</th>
                                   <th></th>
                               </tr>
                           </thead>
						   <tbody>
							<?php
							   	include 'includes/dbh.inc.php';

								$sql = "SELECT * FROM users";
								$result = mysqli_query($conn, $sql);
								while($row=mysqli_fetch_array($result)){
								
								if($row["usertype"] == "user") {
							?>
							<tr>
								<td hidden><?php echo $row['usersId']; ?></td>
								<td><?php echo $row['usersName']; ?></td>
								<td><?php echo $username = $row['usersUid']; ?></td>
								<td><?php echo $row['usersEmail']; ?></td>
								<td>
								<?php
										if($row['verifyImage'] == ""){
								
											echo "<img class='img' width='100px' height='100px' src='img/id.jpg'>";
										}
										else {
								?>		
									<a href="#viewModal" onclick="search<?php echo $counter ?>('<?php echo $row['usersId']; ?>')" <?php echo $row['usersId']; ?> data-toggle="modal"><img src="upload/users/<?php echo $username ?>/<?php echo $row['verifyImage'];?>" class="image" width="100px" height="100px"></a>
								<?php 
										}
								?>
								</td>
								<td><?php echo $row['status']; ?></td>
								<script>
									//script for fetching image modal
									var imageLink
									function search<?php echo $counter;?>(vals) {
									  $.ajax({
									  url : 'idsearch.php',
									  data : {'vals' : vals},
									  dataType : 'JSON',
									  type : 'POST',
									  cache : false,	  	
									  success : function(result) {
										imageLink = "upload/users/<?php echo $username ?>/"+result;
										document.getElementById('verifyIMG').src = imageLink;
									  },

									  error: function(xhr, status, error) {
										imageLink = "upload/users/<?php echo $username ?>/"+xhr.responseText;
										document.getElementById('verifyIMG').src = imageLink;

									  }
									  });
									}
								</script>
								<td style="text-align: center">
								<!--Verify Button -->
								<a href="#verifyModal" class="text-white verify" <?php echo $row['usersId']; ?> data-toggle="modal"><button class='btn-check btn-circle btn-sm'><i class="bi bi-check-circle"></i></button></a>
							</tr>
							<?php
              					$counter++;
									}
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

	<!-- Verify Modal -->							
	<div class='modal fade' id='verifyModal' tabindex='-1' role='dialog' aria-hidden='true'>
		<div class='modal-dialog modal-dialog-centered' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title'>Verify user:</h5>
					<input type='text' name='email' id='email' class='custom-form-control' disabled>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
			<div class='modal-body'>
				<form action="includes/verify.php" method='POST'>
					<div class='form-group'>
						<p>Click 'verified' status if you want to verify this user.</p>	
						<input type='hidden' name='update_id' id='update_id'>	
						<select name="status" id="status">
							<option disabled selected hidden>status</option>
							<option value="verified">Verified</option>
							<option value="bogusBuyer">Bogus Buyer</option>
						</select>
					</div>
			</div>		
			<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
					<a href="verify.php?id=<?php echo $row['usersId']; ?>">
						<button type='submit' name='verify' class='btn btn-primary'>Verify</button></a>
				</form>
			</div>
			</div>
		</div>
	</div>

	<!--ID viewing-->
	<div class='modal fade' id='viewModal' tabindex='-1' role='dialog' aria-hidden='true'>
		<div class='modal-dialog modal-dialog-centered' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title'>View ID:</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
						<img src="" id="verifyIMG" class="image" width="100%" height="100%">
				</div>
			</div>
		</div>
	</div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
