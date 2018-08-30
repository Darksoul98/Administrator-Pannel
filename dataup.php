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
	$flag=$_REQUEST['flag'];
	if($flag==0){
		$stmt = $conn->prepare("INSERT INTO `form`(`Name`, `Parent`,`ParentName`,`Link`,`Target`,`OrderNo`, `Status`, `Edit/Delete`) VALUES (?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssiss",$name,$parent,$pname,$link,$target,$order,$status,$eord);	

	}
	else{
		$stmt = $conn->prepare("UPDATE `form` SET `Name`=?,`Parent`=?,`ParentName`=?,`Link`=?,`Target`=? WHERE SNo=".$flag);
		$stmt->bind_param("sssss",$name,$parent,$pname,$link,$target);	

	}
	$name = $_POST["name"];
	$parent = $_POST["parent"];
	if($_POST["pname"] == "NULL")
		$pname ="NULL";
	else
		$pname = $_POST["pname"];
	
	$link = $_POST["link"];
	$target = $_POST["target"];
	$order = 1;
	$status = "ACTIVE";
	$eord = "edit/delete ";	
	if($stmt->execute())
		echo "Record added Successfully";
	else
		echo "Error While Adding the Record";	
?>
<html>
<head>
	<title>Data Upload</title>
</head>
<body>
	<a href="adminhome.php" target="_self">Back To Admin Page</a>
	
</body>
</html>