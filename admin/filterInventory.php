<?php
	include 'includes/dbh.inc.php';

	if(isset($_POST["start_date"], $_POST["end_date"])){
		
		$sql = "SELECT * FROM inventoryreport
				LEFT JOIN products ON inventoryreport.product_name = products.product_name
				LEFT JOIN supplies ON products.product_id = supplies.product_id 
				WHERE order_date BETWEEN '".$_POST["start_date"]."' AND '".$_POST["end_date"]."' ORDER BY inv_id DESC";
		$result = mysqli_query($conn, $sql);
		$output= '';
		$output .= "<table class='table table-bordered'>
					<thead>
                    	 <tr>
                            <th hidden>Inventory ID</th>
							<th style='text-align: center'>Supplier</th>
							<th style='text-align: center'>Product Name</th>
							<th style='text-align: center'>Beginning Quantity</th>
							<th style='text-align: center'>Unit Cost</th>
							<th style='text-align: center'>Quantity Sold</th>
							<th style='text-align: center'>Ending Balance</th>
							<th style='text-align: center'>Total Amount</th>
							<th style='text-align: center'>Stock Valuation</th>
							<th style='text-align: center'>Transaction Date</th>
                         </tr>
                   	</thead>";
		
		if(mysqli_num_rows($result) > 0){
			
			while($row=mysqli_fetch_array($result)){
				$date = new DateTime($row['order_date']);
				$beginQty = $row['quantity'] + $row['inventory'];
				$endingBalance = $beginQty - $row['quantity'];
				$stockValuation = $row['quantity'] * $row['price'];
				$output .= "<tr>
								<td hidden>".$row['inv_id']."</td>
								<td style='text-align: center'>".$row['supplier_name']."</td>
								<td style='text-align: center'>".$row['product_name']."</td>
								<td style='text-align: center'>".$beginQty."</td>
								<td style='text-align: center'>".$row['cost']."</td>
								<td style='text-align: center'>".$row['quantity'] ."</td>
								<td style='text-align: center'>".$endingBalance." </td>
								<td style='text-align: center'>".$row['revenue']."</td>
								<td style='text-align: center'>".$stockValuation."</td>
								<td style='text-align: center'>".$date->format('M d Y')."</td>
							</tr>";
			}
		}
		else {
			
			$output .= "<tr>
							<td colspan='7'>No Data Found</td>
						</tr>";
		}
		$output .="</table>";
		echo $output;
	}