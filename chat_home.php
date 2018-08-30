<?php include 'connection_chat.php' ?>
<?php
	session_start();
	if(!($_SESSION['chat_logged_in'])){
		//$_SESSION['header_loc']="adminhome.php";
		session_unset();
		session_destroy();
		header('Location: login_chat.php');
    }
?>

<?php 
	$sql="SELECT * FROM users WHERE Online= 1";
	$result=$conn->query($sql);
	//var_dump($result);
	$online=$result->num_rows;
	//echo $online;
	
	$sql="SELECT * FROM users WHERE Online= 0";
	$result=$conn->query($sql);
	//var_dump($result);
	$offline=$result->num_rows;
	//echo $offline;
?>
<html>
<head>
	<title>Mail box</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="menu.css">
</head>
<body>
	<ul class="top-level-menu">
		<li><a href='#'>Navigation</a>
			<ul class="second-level-menu">
				<li><a href="login_chat.php?chat_logout=1">LOGOUT</a></li>
			</ul>		
		</li>
		<li>
			<a href="Home.php">Home</a><br>	
		</li>
	</ul>
	<br>
	<br>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<a href="online.php"> Online Users</a><br>
				<a href="offline.php"> Offline Users</a><br>
				<a href="inbox.php"> Inbox</a>
				
			</div>
			<div class="col-md-5">
				<legend>
					<fieldset>Online Users</fieldset>
					<h3><?php echo $online; ?></h3>
				</legend>		
			</div>
			<div class="col-md-5">
				<legend>
					<fieldset>Offline Users</fieldset>
					<h3><?php echo $offline; ?></h3>
				</legend>		
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<legend>
					<fieldset>Inbox</fieldset>
				</legend>		
			</div>
		</div>
	</div>
</body>
</html>