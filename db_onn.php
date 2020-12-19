<?php
	$sname = "localhost";
	$uname = "root";
	$password = "";
	$db_name = "rest_db";
	$conn = mysqli_connect($sname,$uname,$password,$db_name);
	if(!$conn){
		echo "Connection Failed";
	}
?>