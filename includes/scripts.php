<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<!-- Data Tables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<script>
$(document).ready(
	function () {
		//Datatable for transaction history
    $('#transactionRec').DataTable();
} );
</script>
<!-------------------------------------------------------------------->
<script>
$(document).ready(
	function () {
		//Datatable for cart items
    $('#cartItems').DataTable();
} );
</script>
<!-------------------------------------------------------------------->
<script>
$(document).ready(
	function () {
		//Datatable for checkout items
    $('#checkOut').DataTable();
} );
</script>
<!-------------------------------------------------------------------->
<script>
	//Toggle Form for login and register js
	var LoginForm = document.getElementById("LoginForm")
	var RegisterForm = document.getElementById("RegisterForm")
	var Indicator = document.getElementById("Indicator")

		function register(){
			RegisterForm.style.transform = "translateX(0px)";
			LoginForm.style.transform = "translateX(0px)";
			Indicator.style.transform = "translateX(155px)";
		}

		function login(){
			RegisterForm.style.transform = "translateX(300px)";
			LoginForm.style.transform = "translateX(300px)";
			Indicator.style.transform = "translateX(50px)";
		}
</script>

<!-------------------------------------------------------------------->
<script type="text/javascript">

// Captcha Script

function checkform(theform){
	var why = "";

	if(theform.CaptchaInput.value == ""){
		why += "- Please Enter CAPTCHA Code.\n";
	}
	if(theform.CaptchaInput.value != ""){
		if(ValidCaptcha(theform.CaptchaInput.value) == false){
			why += "- The CAPTCHA Code Does Not Match.\n";
		}
	}
	if(why != ""){
		alert(why);
		return false;
	}
}
	var a = Math.ceil(Math.random() * 9)+ '';
	var b = Math.ceil(Math.random() * 9)+ '';
	var c = Math.ceil(Math.random() * 9)+ '';
	var d = Math.ceil(Math.random() * 9)+ '';
	var e = Math.ceil(Math.random() * 9)+ '';

	var code = a + b + c + d + e;
	document.getElementById("txtCaptcha").value = code;
	document.getElementById("CaptchaDiv").innerHTML = code;

	// Validate input against the generated number
	function ValidCaptcha(){
		var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
		var str2 = removeSpaces(document.getElementById('CaptchaInput').value);

		if (str1 == str2){
			return true;
		}
		else{
			return false;
		}
	}

	// Remove the spaces from the entered and generated code
	function removeSpaces(string){
	return string.split(' ').join('');
}
</script>
<!-------------------------------------------------------------------->
<script type="text/javascript">
		//onchange functions for payment
	var fee = document.getElementById('shipFee');
	var total = document.getElementById('total');
	var subtotal = document.getElementById('subtotal');
	function payment(selected) {
			total.value = parseInt(subtotal.value)+parseInt(selected.value);
			fee.value = selected.value;
	}
</script>
<!-------------------------------------------------------------------->
<script type="text/javascript">
//onchange functions for payment
var newLine = "\r\n";
var info = document.getElementById('paymentInfo');

$('#paymentMethod').change(function () {

	info.innerHTML = $(this).find(':selected').data('client')+newLine+$(this).find(':selected').data('number');
});

</script>
