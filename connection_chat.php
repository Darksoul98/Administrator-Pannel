<?php
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$conn = mysqli_connect($servername, $username, $password, "chatsystem");
	// Check connection	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}	
?>