<?php
	session_start();
	if(!($_SESSION['logged_in'])){
		session_unset();
		session_destroy();
		header('Location: login.php');
    }
	
	if(!empty($_REQUEST['name'])){
		$name=$_REQUEST['name'];
	}
	if(!empty($_REQUEST['url'])){
		$url=$_REQUEST['url'];
	}
	if(!empty($_REQUEST['title'])){
		$title=$_REQUEST['title'];
	}
	if(!empty($_REQUEST['descrip'])){
		$desp=$_REQUEST['descrip'];
	}
	else
		$desp="NULL";
	if(!empty($_REQUEST['keyword'])){
		$keyword=$_REQUEST['keyword'];
	}
	if(!empty($_REQUEST['content'])){
		$content=$_REQUEST['content'];
	}
	$htmlcontent="<?php include'navbar.php' ?>
				<html>
				<head>
					<title>$title</title>
					<meta name='Description' content=$desp>
					<meta name='Keywords' content=$keyword>
				</head>
				<body>
					<h1>$name</h1>
					<p> $content </p>
				</body>
				</html>";
	try{
		$fp=fopen($url,"w");
		fwrite($fp,$htmlcontent);
		fclose($fp);
		echo "FILE CREATED";
		echo "<a href='adminhome.php'>Back Home</a>";
	}
	//catch exception
	catch(Exception $e) {
		echo 'Message: ' .$e->getMessage();
	}
?>
