  <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
               	<img src="img/logo.png" width= "40px">              
                <div class="sidebar-brand-text mx-3">Jess Shoppe</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#salesManagement"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Sales Management</span>
                </a>
                <div id="salesManagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="order_management.php">Manage Orders</a>
                    </div>
                </div>
            </li>
			
			<!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productManagement"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-screwdriver"></i>
                    <span>Product Management</span>
                </a>
                <div id="productManagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="product_management.php">Manage Products</a>
						<a class="collapse-item" href="category_management.php">Manage Categories</a>
						<a class="collapse-item" href="supply_management.php">Item Data</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item -Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userAccountManagement"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Users Acc Management</span>
                </a>
                <div id="userAccountManagement" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="useracc_management.php">Customer Accounts</a>
                    </div>
                </div>
            </li>
			
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Others</div>

            <!-- Nav Item - Others -->
            <li class="nav-item">
				<a class="nav-link collapsed" href="#" href="#" data-toggle="collapse" data-target="#reports"
                    aria-expanded="true" aria-controls="collapseUtilities"><i class="fas fa-fw fa-chart-area"></i>
            	<span>Reports</span></a>
				<div id="reports" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="salesReport.php">Sales Reports</a>
						<a class="collapse-item" href="inventoryReport.php">Inventory Reports</a>
                    </div>
                </div>	
				
				<a class="nav-link" href="updates.php"><i class="fas fa-sync"></i>
                <span>Updates</span></a>
				
				<a class="nav-link collapsed" href="#" href="#" data-toggle="collapse" data-target="#shopInformation"
                    aria-expanded="true" aria-controls="collapseUtilities"><i class="fas fa-info-circle"></i>
            	<span>Shop Information</span></a>
				<div id="shopInformation" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../admin/si_privacy.php">Privacy</a>
						<a class="collapse-item" href="../admin/si_termsconditions.php">Terms and Conditions</a>
						<a class="collapse-item" href="../admin/si_datapolicy.php">Data Policy</a>
						<a class="collapse-item" href="../admin/si_delivery.php">Delivery Method</a>
						<a class="collapse-item" href="../admin/si_payment.php">Payment Information</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
		
		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>
