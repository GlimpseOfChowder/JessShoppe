<!DOCTYPE html>
<?php
	require 'includes/dbh.inc.php';
?>
<html lang="en">
	<head>
		<!-- Datepicker -->
    	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<style>	
		.table {
			width: 100%;
			margin-bottom: 20px;
		}	
 
		.table-striped tbody > tr:nth-child(odd) > td,
		.table-striped tbody > tr:nth-child(odd) > th {
			background-color: #f9f9f9;
		}
 
		@media print{
			#print {
				display:none;
			}
		}
		@media print {
			#PrintButton {
				display: none;
			}
		}
 
		@page {
			size: auto;   /* auto is the initial value */
			margin: 0;  /* this affects the margin in the printer settings */
		}
		.dataTables_filter, .dataTables_info { 
			display: none; 
		}
		.pagination{
			
			list-style-type: none;
			display: flex;
			
		}	
		.pagination a {
			text-align: center;
			border: 1px solid trasparent;
			text-decoration: none;
			padding-left: 10px;
			padding-right: 10px;
			color: transparent;
		}
			.pagination a:hover {
				
				color: black;
			}	
	</style>
	</head>
<body>
	<b style="color:blue;">Date Prepared:</b>
	<?php
		$date = date("Y-m-d", strtotime("+6 HOURS"));
		echo $date;
	?>
	<br /><br />
	<div class="row">
		<div class="col-md-6">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text bg-info text-white"><i class="fas fa-calendar-alt"></i></span>
				</div>
				<input type="text" class="form-control" id="start_date" placeholder="Start Date" readonly>
			</div>
		</div>
		<div style="height: 5px"></div>
		<div class="col-md-6">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text bg-info text-white"><i class="fas fa-calendar-alt"></i></span>
				</div>
				<input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
			</div>
		</div>
	</div>
	<div style="height: 10px"></div>
	<div style="margin-bottom: 10px">
		<button name="filter" id="filterOrders" class="btn btn-outline-info btn-sm">Filter</button>
		<button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
	</div>
	<div style="height: 10px"></div>
	<div class="status-filter" style="margin-bottom: 10px; width: 20%; float: left">
		<select id="statusFilter" class="form-control" style="color: gray">
			<option value="">Show All</option>
			<option value="preparing items">preparing items</option>
			<option value="package in-transit">package in-transit</option>
			<option value="arrived in the Philippines">arrived in the Philippines</option>
			<option value="packing of the items">packing of the items</option>
			<option value="order shipped out">order shipped out</option>
			<option value="delivered">delivered</option>
		</select>
	</div>
	<table class="table table-striped" id="orderList">
		 <thead>
            <tr>
				<th>Order ID</th>
				<th>Customer Name</th>
				<th hidden>Email</th>
				<th hidden>User ID</th>
				<th hidden>Mobile#</th>
				<th hidden>Shipping</th>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Total Amount</th>
				<th hidden>Address</th>
				<th>Status</th>
				<th hidden>Delivery</th>
				<th hidden>Payment</th>
				<th>Order Date</th>
				<th hidden>Reference#</th>
            </tr>
                            
		<tbody>
			<?php
				require 'includes/dbh.inc.php';
 
				$query = $conn->query("SELECT * FROM orders
											LEFT JOIN products ON orders.product_id = products.product_id
											LEFT JOIN supplies ON products.product_id = supplies.product_id
											LEFT JOIN users ON orders.usersId = users.usersId");

				while($fetch = $query->fetch_array()){
 					$date = new DateTime($fetch['order_date']);
			?>
			<tr>
				<td style="text-align: center"><?php echo $fetch['order_id']; ?></td>
				<td style="text-align: center"><?php echo $fetch['usersName']; ?><br><br></td>
				<td hidden><?php echo $fetch['usersEmail']; ?></td>
				<td hidden><?php echo $fetch['usersId']; ?></td>
				<td hidden><?php echo $fetch['mobile']; ?></td>
				<td hidden><?php echo $fetch['shipping']; ?></td>
				<td style="text-align: center"><?php echo $fetch['product_name']; ?></td>
				<td style="text-align: center"><?php echo $fetch['quantity']; ?></td>
				<td style="text-align: center"><?php echo $fetch['total']; ?></td>
				<td hidden><?php echo $fetch['address']; ?></td>
				<td style="text-align: center"><?php echo $fetch['order_status']; ?></td>
				<td hidden><?php echo $fetch['delivery']; ?></td>
				<td hidden><?php echo $fetch['payment']; ?></td>
				<td style="text-align: center"><?php echo $date->format('M d Y '); ?></td>
				<td hidden><?php echo $fetch['reference']; ?></td>
			</tr>
			<?php	
					}
			?>
		</tbody>
	</table>
	<center><button id="PrintButton" onclick="PrintPage()">Print</button></center>
</body>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Page level plugins for Datatables -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!-- Momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	
	<script type="text/javascript" language="javascript" >
    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
    });

	 // Filter for inventory rep
    $('#filterOrders').click(function(){
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		if(start_date != '' && end_date != ''){
			
			$.ajax({
				url: "filterOrders.php",
				method: "POST",
				data:{start_date:start_date, end_date:end_date},
				success:function(data)
				{
					$('#orderList').html(data);
				}
			});
		}
		else {
			
			alert("Please select date");
		}
		
	}); 

    // Reset
    $(document).on("click", "#reset", function(e) {
        e.preventDefault();
        $("#start_date").val(''); // empty value
        $("#end_date").val('');
    });
</script>
<script>
$(document).ready(function (){
    var table = $('#orderList').DataTable({
        "lengthChange": false
    });
    
    $('#statusFilter').on('change', function(){
       table.search(this.value).draw();   
    });
});
</script>
	
<script type="text/javascript">
	function PrintPage() {
		window.print();
	}
</script>
</html>