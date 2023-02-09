<?php
	include 'includes/dbh.inc.php';

	if(isset($_POST["start_date"], $_POST["end_date"])){
		
		$sql = "SELECT * FROM orders
				LEFT JOIN products ON orders.product_id = products.product_id
				LEFT JOIN supplies ON products.product_id = supplies.product_id
				LEFT JOIN users ON orders.usersId = users.usersId
				WHERE order_date BETWEEN '".$_POST["start_date"]."' AND '".$_POST["end_date"]."' ORDER BY order_date DESC";
		$result = mysqli_query($conn, $sql);
		$output= '';
		$output .= "<table class='table table-bordered'>
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
                   </thead>";
		
		if(mysqli_num_rows($result) > 0){
			
			while($row=mysqli_fetch_array($result)){
				$date = new DateTime($row['order_date']);
				$counter=0;
				$output .= "<tr>
										<td style='text-align: center'>".$row['order_id']."</td>
										<td style='text-align: center'>".$row['usersName']."<br><br></td>
										<td hidden>".$row['usersEmail']."</td>
										<td hidden>".$row['usersId']."</td>
										<td hidden>".$row['mobile']."</td>
										<td hidden>".$row['shipping']."</td>
										<td style='text-align: center'>".$row['product_name']."</td>
										<td style='text-align: center'>".$row['quantity']."</td>
										<td style='text-align: center'>".$row['total']."</td>
										<td hidden>".$row['address']."</td>
										<td style='text-align: center'>".$row['order_status']."</td>
										<td hidden>".$row['delivery']."</td>
										<td hidden>".$row['payment']."</td>
										<td style='text-align: center'>".$date->format('M d Y ')."</td>
										<td hidden>".$row['reference']."</td>
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