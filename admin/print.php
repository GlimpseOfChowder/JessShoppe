<!DOCTYPE html>
<?php
	require 'includes/dbh.inc.php';
?>
<html lang="en">
	<head>
		<title>Print</title>
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
		<button name="filter" id="filterSales" class="btn btn-outline-info btn-sm">Filter</button>
		<button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
	</div>
	<div style="height: 10px"></div>
	<table class="table table-striped" id="salesList">
		<thead>
			<tr>
                <th hidden>Sales ID</th>
				<th>Supplier</th>
				<th>Product Name</th>
				<th>Unit Cost</th>
				<th>Unit Price</th>
				<th>Quantity Sold</th>
				<th>Shipping Cost</th>
				<th>Total Amount</th>
				<th>Transaction Date</th>
            </tr>
		</thead>
		<tbody>
			<?php
				require 'includes/dbh.inc.php';
 
				$query = $conn->query("SELECT * FROM sales
											LEFT JOIN products ON sales.product_name = products.product_name
											LEFT JOIN supplies ON products.product_id = supplies.product_id ORDER BY sales_id DESC");
				$unitCost = 0;
				$unitPrice = 0;
				$shipping = 0;
				$total = 0;
				while($fetch = $query->fetch_array()){
 					$date = new DateTime($fetch['order_date']);
			?>
			<tr>
				<td style="text-align:center;"><?php echo $fetch['supplier_name']?></td>
				<td style="text-align:center;"><?php echo $fetch['product_name']?></td>
				<td style="text-align:center;"><?php echo $fetch['cost']?></td>
				<td style="text-align:center;"><?php echo $fetch['price']?></td>
				<td style="text-align:center;"><?php echo $fetch['quantity']?></td>
				<td style="text-align:center;"><?php echo $fetch['shipping']?></td>
				<td style="text-align:center;"><?php echo $fetch['revenue']?></td>
				<td style="text-align:center;"><?php echo $date->format('M d Y'); ?></td>
			</tr>
			<?php
					$unitCost += $fetch['cost'];	
					$unitPrice += $fetch['price'];
					$shipping += $fetch['shipping'];
					$total+= $fetch['revenue'];	
					
					$profit = $total - $unitCost;
					}
			?>	
				<tr>
					<td></td>
					<td></td>
					<td style="text-align:center;">Total Unit Cost: <?php echo $unitCost; ?></td>
					<td style="text-align:center;">Total Unit Price: <?php echo $unitPrice; ?></td>
					<td></td>
					<td style="text-align:center;">Total Shipping Cost: <?php echo $shipping; ?></td>
					<td style="text-align:center;">Grand Total: <?php echo $total; ?></td>
					<td style="text-align:center;">Profit: <?php echo $profit; ?></td>
				</tr>
		</tbody>
	</table>
	<center><button id="PrintButton" onclick="PrintPage()">Print</button></center>
	
	
</body>
<?php include 'includes/scripts.php'; ?>	
<script type="text/javascript">
	function PrintPage() {
		window.print();
	}
</script>
</html>