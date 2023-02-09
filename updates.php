<?php include 'header.php'; ?>
<!-- ending div tag of container from header.php -->
			</div>
<!-- ending div tag of header from header.php -->
		</div>

	<title>Updates Page</title>
		<?php
				$sql1 = "SELECT image FROM users WHERE usersId = 8";
				$result1 = mysqli_query($conn, $sql1);

				while($row1=mysqli_fetch_array($result1)){
				if($row1['image'] == ""){

					echo "<img class='img-profile' src='admin/img/undraw_profile.svg'>";
				}
				else {
		?>	
		<div class = 'content-wrapper'>
			<div class = 'content'>
				<h2 class = 'updates'>Announcements</h2>
				<div class = 'card-body-custom card scrollbar-lady-lips'>
					<?php 
						include 'includes/dbh.inc.php';
					
						$sql = "SELECT * FROM updates ORDER BY date_posted DESC";
						$result = mysqli_query($conn, $sql);
						
						while($row=mysqli_fetch_array($result)){
							$date = new DateTime($row['date_posted']);
					?>
					<div class = 'wallpost'>		
								<img src="admin/upload/users/Jess/<?php echo $row1['image'];?>" class="image rounded-circle" width="50px;" height="50px" style="margin-right: 10px">
						<h3 class = 'jess'>Jess</h3>
						<div class = 'card-body-post'>
							<p class = "postTime"><?php echo $date->format('h:i a - M d Y '); ?></p>
							<p style="margin-top: 5px"><span class = "postTitle">[<?php echo $row['title']; ?>]</span> <?php echo $row['content']; ?></p>
							<img src="admin/upload/<?php echo $row['photos'];?>" class="img">
						</div>
					</div>
					<div style="height:20px;"></div>
					<?php 
							}
					?>
				</div>
			</div>
		</div>
		<?php 
					}
				} 
		?>

<?php include 'footer.php'; ?>
<?php include 'includes/scripts.php'; ?>

</body>
</html>