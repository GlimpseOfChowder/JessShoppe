<?php
	session_start();
?>

<!DOCTYPE HTML>
<html lang = "en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<!-- Google Font -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Bootstrap and Poppermin JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<!-- Bootstrap Icons -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
		<!-- Admin LTE -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<!-- Data Tables -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
		<!-- CSS File -->
		<link rel="stylesheet" href="assets/css/styles.css" />
		<link rel="icon" href ="images/logotab.ico">
	</head>
	
	<body class = "scrollbar-lady-lips">
		<div class = "header">
			<div class = "container">
				<nav class="navbar navbar-expand-lg navbar-light">
					<!-- Logo -->
					<div class = "navbar-brand">
						<a href = "index.php"><img src = "images/logo.png" width="80px"></a>
					</div>
					<!-- toggler button will appear for lower screens -->
						<button class="navbar-toggler ml-auto float-right-xs" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<i class="bi bi-list"></i>
					  </button>
						<!-- Menu will be toggled on lower screens -->
						  <ul class="navbar-nav collapse navbar-collapse" id="navbarSupportedContent">
							<li class = "nav-item">
								<a href="index.php">Home</a>
							</li>
							<li class = "nav-item">
								<a href="about.php">About Us</a>
							</li>
								<li class = "nav-item dropdown">
									<a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>							 
									<ul class = "dropdown-menu">
									<?php 
										include 'includes/dbh.inc.php';

										$sql = "SELECT * FROM category";
										$result = mysqli_query($conn, $sql);

										while($row=mysqli_fetch_array($result)){
									?>	
										<li><a href="category.php?category=<?php echo $row['category_id'] ?>" value="<?php echo $row['category_name']?>"><?php echo $row['category_name']?></a></li>
									<?php	
										}
									?>
									</ul>
								</li>
							<li class = "nav-item">
								<a href="updates.php">Updates</a>
							</li>
							<!-- Search Bar -->
							<form  method = "post" class = "navbar-form my-2 my-lg-0" action = "search.php">
								<div class = "input-group">
									<input type = "text" class = "form-control mr-sm-2" name = "search" placeholder = "Search for product">
									<div class = "input-group-btn" id = "searchBtn">
										<button type = "submit" name = "submit-search" class = "btn btn-default btn-flat">
											<i class = "bi bi-search"></i>
										</button>
									</div>
								</div>				  
							</form>
						</ul>
						<!-- Not Collapsable part of the navbar -->
						<ul class = "navbar-custom-menu">
								<!-- If a user logs in -->
							<?php	
							
								if(isset($_SESSION["useruid"])) {
																			
							?>						
								<li  class = 'dropdown'>
								<a class='bi-dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'><i class="bi bi-person-circle" style="font-size: 14px"></i> My Account</a>
									<ul class = 'dropdown-menu'>
										<li><a class = 'dropdown-item' href='profile.php'>My Profile</a></li>
										<li><a class = 'dropdown-item' href='trackOrder.php'>Track My Orders</a></li>
										<li><a class = 'footer-cart dropdown-item' href='includes/logout.inc.php'>Log out</a></li>
									</ul>
								</li>
							<?php
								}
								else {
							?>					
									<li><a href='account.php'>Account</a></li>
							<?php		
								}
							?>		
							<!-- Cart w/ Session -->
							<?php 
								if(isset($_SESSION['useruid'])){	
									include 'includes/dbh.inc.php';
											
									$sql = "SELECT * FROM cart WHERE cart.usersId = ".$_SESSION['userid']."";
									$result = $conn->query($sql);
									$rows_count_value = mysqli_num_rows($result);
									
								echo "<li class = 'dropdown'>
										<a role='button' data-bs-toggle='dropdown' aria-expanded='false'>
											<i class='bi bi-cart2 bi-dropdown-toggle'></i>
											<span class='label label-success'>$rows_count_value</span>
										</a>
										<!-- Dropdown Box When Cart is clicked -->
										<ul class = 'dropdown-menu'>
											<li class = 'dropdown-header'>
												You have <span>$rows_count_value</span> item(s) in cart		
											</li>
											<li class = 'footer-cart'>
												<a href = 'cart.php'>Go to Cart</a>
											</li>											
										</ul>							
									</li>
									</ul>";
								}
								else {
							?>
							<!-- Cart no Session -->
							<li class = 'dropdown'>
										<a role='button' data-bs-toggle='dropdown' aria-expanded='false'>
											<i class='bi bi-cart2 bi-dropdown-toggle'></i>
											<span class='label label-success'>0</span>
										</a>
										<!-- Dropdown Box When Cart is clicked -->
										<ul class = 'dropdown-menu'>
											<li class = 'dropdown-header'>
												You have <span>0</span> item(s) in cart		
											</li>
											<li class = 'footer-cart'>
												<a href = 'cart.php'>Go to Cart</a>
											</li>											
										</ul>							
									</li>
								</ul>
							<?php
								}
							?>
							</nav>				