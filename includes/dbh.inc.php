<?php
	
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "jShoppeAccounts";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if(!$conn){
	die("Connection failed: " . mysqli_connect_error());
}

date_default_timezone_set('Asia/Manila');
$error = "";