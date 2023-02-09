<?php
	include 'includes/dbh.inc.php';

				$unitCost = 0;
				$unitPrice = 0;
				$shipping = 0;
				$total = 0;
				$profit = 0;

	if(isset($_POST["start_date"], $_POST["end_date"])){
		
		$sql = "SELECT * FROM sales
				LEFT JOIN products ON sales.product_name = products.product_name
				LEFT JOIN supplies ON products.product_id = supplies.product_id 
				WHERE order_date BETWEEN '".$_POST["start_date"]."' AND '".$_POST["end_date"]."' ORDER BY sales_id DESC";
		
		$result = mysqli_query($conn, $sql);
		$output= '';
		$output .= "<table class='table table-bordered'>
					<thead>
                       <tr>
                        <th hidden>Sales ID</th>
						<th style='text-align: center'>Supplier</th>
						<th style='text-align: center'>Product Name</th>
						<th style='text-align: center'>Unit Cost</th>
						<th style='text-align: center'>Unit Price</th>
						<th style='text-align: center'>Quantity Sold</th>
						<th style='text-align: center'>Shipping Cost</th>
						<th style='text-align: center'>Total Amount</th>
						<th style='text-align: center'>Transaction Date</th>
                      </tr>
                    </thead>";
		
		if(mysqli_num_rows($result) > 0){
			
			while($row=mysqli_fetch_array($result)){

				$date = new DateTime($row['order_date']);
				
				$output .= "<tr>
								<td hidden>".$row['sales_id']."</td>
								<td style='text-align: center'>".$row['supplier_name']."</td>
								<td style='text-align: center'>".$row['product_name']."</td>
								<td style='text-align: center'>".$row['cost']."</td>
								<td style='text-align: center'>".$row['price']."</td>
								<td style='text-align: center'>".$row['quantity']."</td>
								<td style='text-align: center'>".$row['shipping']."</td>
								<td style='text-align: center'>".$row['revenue']."</td>
								<td style='text-align: center'>".$date->format('M d Y')."</td>
							</tr>";
							
				$unitCost += $row['cost'];	
				$unitPrice += $row['price'];
				$shipping += $row['shipping'];	
				$total+= $row['revenue'];
				$profit = $total - $unitCost;
			}
		}
		else {
			
			$output .= "<tr>
							<td colspan='7'>No Data Found</td>
						</tr>";
		}
											
			$output.="<tr>
						<td></td>
						<td></td>
						<td style='text-align: center'>Total Unit Cost: $unitCost</td>
						<td style='text-align: center'>Total Unit Price: $unitPrice</td>
						<td></td>
						<td style='text-align: center'>Total Shipping Cost: $shipping</td>
						<td style='text-align: center'>Grand Total: $total</td>
						<td style='text-align: center'>Profit: $profit</td>
					  </tr>";
		
		$output .="</table>";
		echo $output;
	}
?>
