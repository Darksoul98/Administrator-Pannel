<?php include 'connection.php';?>
<?php
	session_start();
	if(!($_SESSION['logged_in'])){
		//$_SESSION['header_loc']="adminhome.php";
		session_unset();
		session_destroy();
		header('Location: login.php');
    }
?>
<?php 
	if(!empty($_REQUEST["msg"]))
		$msg=$_REQUEST["msg"];
		//echo $id;
	else
		$msg="";
?>
<html>
<head>
	<link rel="stylesheet" href="menu.css">
	<title>Admin HomePage</title>
</head>

<body>
	<ul class="top-level-menu">
		<li><a href='#'>Navigation</a>
			<ul class="second-level-menu">
				<li><a id="" href="f2.php?module=AddForm&id=0" >Add Form</a><br></li>
				<li><a href="viewform.php?module=ViewForm">View Form</a><br></li>
				<li><a href="createpage.php">Create Form page</a></li>
				<li><a href="login.php?module=AddForm&logout=1">LOGOUT</a></li>
			</ul>		
		</li>
		<li><a href='#'>Manage Users</a>
			<ul class="second-level-menu">
				<li><a href="adduser.php?module=AddForm">Add User</a><br></li>
				<li><a href="viewuser.php?module=AddForm">View User</a><br></li>
				<li><a href="accesscontrol.php?module=AddForm">Access Control</a><br></li>
			</ul>		
		</li>
		
		<li>
			<a href="Home.php">Home</a><br>	
		</li>
	</ul>
	<br>
	<br>
	
	<div id="error"><h1><?php echo $msg; ?><h1></div>
</body>
</html>
