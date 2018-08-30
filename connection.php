<?php
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$conn = mysqli_connect($servername, $username, $password, "travel");
	// Check connection	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	//CHECKING THE PARAMETERS
	if(!empty($_REQUEST["id"]))
		$id=$_REQUEST["id"];
		//echo $id;
	else
		$id=0;

	if(!empty($_REQUEST["q"]))
		$q=$_REQUEST["q"];
	else 
		$q="all";
	
	if(!empty($_REQUEST["fltr_str"]))
		$fltr_str=$_REQUEST["fltr_str"];
	else
		$fltr_str="";
	
	if(!empty($_REQUEST["sort_str"]))
		$sort_str=$_REQUEST["sort_str"];
	else
		$sort_str="SNo";
	
	if(!empty($_REQUEST["n_order"]))
		$n_order=$_REQUEST["n_order"];	
	else
		$n_order="0";

?>