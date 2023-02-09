    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
	
	 <!-- Page level plugins for Datatables -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts for Datatables -->
    <script src="js/demo/datatables-demo.js"></script>
	<!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!-- Momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script>
$(document).ready( 
	function () {
		//Datatable for user account management
    $('#userAccounts').DataTable();
} );
</script>
<!--------------------------------------------------------------------------------->
<script>
$(document).ready(function() {
		//Datatable for product management
    $('#productList').DataTable( {
        "scrollX": true
    } );
} );
</script>
<!--------------------------------------------------------------------------------->
<script>
$(document).ready(function (){
    var table = $('#orderList').DataTable({
       dom: 'lrtip'
    });
    
    $('#statusFilter').on('change', function(){
       table.search(this.value).draw();   
    });
});
</script>
<!--------------------------------------------------------------------------------->
<script>
$(document).ready( 
	function () {
		//Datatable for sales list management
    $('#salesList').DataTable();
} );
</script>
<!--------------------------------------------------------------------------------->
<script>
$(document).ready( 
	function () {
		//Datatable for inventory list
    $('#inventoryList').DataTable();
} );
</script>
<!--------------------------------------------------------------------------------->
<script>
$(document).ready( 
	function () {
		//Datatable for shop info
    $('#shopInfo').DataTable();
} );
</script>
<!--------------------------------------------------------------------------------->
 <script type="text/javascript" language="javascript" >
    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
    });

    // Filter for sales rep
    $('#filterSales').click(function(){
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		if(start_date != '' && end_date != ''){
			
			$.ajax({
				url: "filterSales.php",
				method: "POST",
				data:{start_date:start_date, end_date:end_date},
				success:function(data)
				{
					$('#salesList').html(data);
				}
			});
		}
		else {
			
			alert("Please select date");
		}
		
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
	  // Filter for order management
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

<!--------------------------------------------------------------------------------->	
<script>
	//Retrieving data for verify user modal
$(document).on('click', 
	function() {
		$('.verify').on('click', function() {
			$('#verifyModal').modal('show');
			
				$tr = $(this).closest('tr');
				
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();
			
				console.log(data);
				$('#update_id').val(data[0]);
				$('#email').val(data[3]);
				$('#status').val(data[4]);
		});	
	});
</script>

<!--------------------------------------------------------------------------------->
<script>
	//script for Retrieving data of edit product modal
$(document).on('click',
	function() {
		$('.edit').on('click', function() {
			$('#editModal').modal('show');	
			
				$tr = $(this).closest('tr');
				
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
			
				$('#update_prod_id').val(data[0]);
				$('#category_name').val(data[3]);
				$('#product_name').val(data[4]);
				$('#details').val(data[5]);
				$('#price').val(data[8]);
				$('#status').val(data[9]);
		});	
	});
</script>

<!--------------------------------------------------------------------------------->
<script>
$(document).on('click',
	//script for delete modal of category
	function () {
            $('.deletecategory').on('click', function () {
                $('#deletecategory').modal('show');
				
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#delete_category_id').val(data[0]);
				$('#cat_name').val(data[1]);

            });
        });
</script>
<!--------------------------------------------------------------------------------->
<script>
	//script for Retrieving data of edit supply modal
$(document).on('click',
	function() {
		$('.editsupply').on('click', function() {
			$('#editsupply').modal('show');	
				
				$tr = $(this).closest('tr');
				
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
			
				$('#update_supply_id').val(data[0]);
				$('#supplier_name').val(data[1]);
				$('#product_id').val(data[2]);
				$('#product_name').val(data[3]);
				$('#inventory').val(data[4]);
				$('#cost').val(data[5]);
		});	
	});
</script>

<script>
function addNewStock(){
	
      var inventory = parseInt(document.getElementById("inventory").value);
      var addStock = parseInt(document.getElementById("addStock").value);

      var sum = inventory + addStock;

      document.getElementById("inventory").value = sum;  

  }
</script>

<!--------------------------------------------------------------------------------->
<script>
	//script for Retrieving data of edit shop information modal
$(document).on('click',
	function() {
		$('.edit').on('click', function() {
			$('#editText').modal('show');	
			
				$tr = $(this).closest('tr');
				
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				
				$('#update_id').val(data[0]);
				$('#text').val(data[1]);
		});	
	});
</script>

<!--------------------------------------------------------------------------------->
<script>
	//script for Retrieving data of edit payment info modal
$(document).on('click',
	function() {
		$('.editPayment').on('click', function() {
			$('#editPayment').modal('show');	
			
				$tr = $(this).closest('tr');
				
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				
				$('#update_id').val(data[0]);
				$('#name').val(data[1]);
				$('#payment').val(data[2]);
				$('#account').val(data[3]);
		});	
	});
</script>
<!--------------------------------------------------------------------------------->
<script>
	//script for Retrieving data of edit delivery info modal
$(document).on('click',
	function() {
		$('.editDelivery').on('click', function() {
			$('#editDelivery').modal('show');	
			
				$tr = $(this).closest('tr');
				
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
				
				$('#update_id').val(data[0]);
				$('#deliveryMethod').val(data[1]);
				$('#shipping').val(data[2]);
		});	
	});
</script>
<!--------------------------------------------------------------------------------->
<script>
	//script for Retrieving data in updates.php
$(document).on('click',
	function() {
		$('.editPost').on('click', function() {
			$('#editPost').modal('show');	
			
				$tr = $(this).closest('tr');
				
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
			
				$('#updates_id').val(data[0]);
				$('#update_title').val(data[2]);
				$('#update_content').val(data[3]);
				$('#updates_image').val(data[3]);
		});	
	});
</script>
<!--------------------------------------------------------------------------------->
<script>
	//script for Retrieving data of check user/order summary product modal on order management
$(document).on('click',
	function() {
		$('.checkUser').on('click', function() {
			$('#checkUserModal').modal('show');	
			
				$tr = $(this).closest('tr');
				
				var data = $tr.children("td").map(function() {
					return $(this).text();
				}).get();

				console.log(data);
			
				$('#update_order_id').val(data[0]);
				$('#product_id').val(data[1]);
			    $('#userName').val(data[3]);
			   	$('#email').val(data[4]);
				$('#usersId').val(data[5]);
				$('#mobile').val(data[6]);
				$('#shipping').val(data[7]);
				$('#supplier').val(data[8]);
				$('#product_name').val(data[9]);
			    $('#quantity').val(data[10]);
				$('#total').val(data[11]);
				$('#address').val(data[12]);
				$('#order_status').val(data[13]);
				$('#deliveryMethod').val(data[14]);
				$('#paymentMethod').val(data[15]);
				$('#order_date').val(data[16]);
				$('#reference').val(data[17]);
		});	
	});
</script>
<!--------------------------------------------------------------------------------->
<script>
$(document).on('click',
	//script for cancelling order modal
	function () {
            $('.cancelOrders').on('click', function () {
                $('#cancelOrders').modal('show');
				
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);
                $('#cancel_order_id').val(data[0]);

            });
        });
</script>
<!--------------------------------------------------------------------------------->
