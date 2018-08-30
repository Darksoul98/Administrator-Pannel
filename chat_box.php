<?php include 'connection_chat.php'; ?>
<?php
	$username=$_REQUEST['user'];
	$sql="SELECT * FROM users WHERE Username= '$username' AND Online = 1";
	$result=$conn->query($sql);
	$row=$result->fetch_assoc();
?>
<html>
<head>
	<title>Chat Box</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
		div.box1 {
			width: 500px;
			height: 500px;
			background-color: #eee;
		}
		
		div.box2 {
			width: 500px;
			height: 75px;
			background-color: #eef;
		}
		
		div.box3{
			width: 500px;
			height: 450px;
			background-color: #eed;
			overflow-x: hidden; /* Hide horizontal scrollbar */
			overflow-y: scroll; /* Add vertical scrollbar */
		}
	</style>
</head>
<body>
	<div class="container" align="center"> 
		<div class="box1" >
			<div class="box2">
				<h3 align="left"><?php echo $row['Username']; ?></h3>
			</div>
			<div class="box3">
			
			</div>
			<div class="box2">
			
			</div>
		</div>
	</div>
</body>
</html>