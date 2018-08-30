<?php include'connection.php';?>
<?php
	session_start();
	if(!($_SESSION['logged_in'])){
		//$_SESSION['header_loc']="adminhome.php";
		session_unset();
		session_destroy();
		header('Location: login.php');
    }
?>


<html>
<head>
	<title>ACCESS CONTROL</title>
</head>
<body>
	<form>
		Filter by :<input type="text" name="fltr_str" value="" onkeyup="sort(this.value)"> 
	</form>
	<br>
	<div id="show_table">
		<script> sort("");</script>
	</div>
	<a id='refresh' href="#">REFRESH</a> 
	<div id="demo"></div>
</body>
</html>	