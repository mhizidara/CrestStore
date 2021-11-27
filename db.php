<?php
	//Enter the Host, username, password, database below.
	$con = mysqli_connect("localhost","root","","online_shop"); //$con = mysqli_connect("localhost","root","","allphtricks"); initial connect.
    if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die();
	}
?>