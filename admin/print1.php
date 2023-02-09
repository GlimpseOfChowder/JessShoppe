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
		<button name="filter" id="filterInventory" class="btn btn-outline-info btn-sm">Filter</button>
		<button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
	</div>
	<div style="height: 10px"></div>
	<table class="table table-striped" id="inventoryList">
		<thead>
			<tr>
				<th hidden>Inventory ID</th>
				<th>Supplier</th>
				<th>Product Name</th>
				<th>Beginning Quantity</th>
				<th>Amount</th>
				<th>Quantity Sold</th>
				<th>Ending Balance</th>
				<th>Stock Valuation</th>
				<th>Transaction Date</th>
            </tr>
		</thead>
		<tbody>
			<?php
				require 'includes/dbh.inc.php';
 
				$query = $conn->query("SELECT * FROM inventoryreport
											LEFT JOIN products ON inventoryreport.product_name = products.product_name
											LEFT JOIN supplies ON products.product_id = supplies.product_id ORDER BY inv_id DESC");

				while($fetch = $query->fetch_array()){
 					$date = new DateTime($fetch['order_date']);
			?>
			<tr>
				<td hidden><?php echo $fetch['inv_id']; ?></td>
				<td style="text-align: center"><?php echo $fetch['supplier_name']; ?></td>
				<td style="text-align: center"><?php echo $fetch['product_name']; ?></td>
				<td style="text-align: center"><?php echo $fetch['inventory']; ?></td>
				<td style="text-align: center"><?php echo $fetch['cost']; ?></td>
				<td style="text-align: center"><?php echo $fetch['quantity']; ?></td>
				<td style="text-align: center"><?php echo $fetch['price']; ?></td>
				<td style="text-align: center"><?php echo $fetch['revenue']; ?></td>
				<td style="text-align: center"><?php echo $date->format('M d Y'); ?></td>
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
    $('#filterInventory').click(function(){
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		if(start_date != '' && end_date != ''){
			
			$.ajax({
				url: "filterInventory.php",
				method: "POST",
				data:{start_date:start_date, end_date:end_date},
				success:function(data)
				{
					$('#inventoryList').html(data);
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

<script type="text/javascript">
	function PrintPage() {
		window.print();
	}
</script>
</html>