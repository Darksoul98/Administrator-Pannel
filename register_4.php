<?php include "connection_chat.php"; 
?>
<?php 
	$user_mail=$_REQUEST["email"];
	$code_url=$_REQUEST["code"];
	$sql = "SELECT * FROM verification WHERE Email='$user_mail'";
	$result=$conn->query($sql);
	if($result->num_rows > 0 ){
		$row=$result->fetch_assoc();
		$code_db=$row['Code'];
		if($code_url == $code_db ){
			echo "MATCH";	
			$sql = "UPDATE `users` SET `Verified`=1 WHERE Email='$user_mail'";
			$result=$conn->query($sql);
			$sql= "DELETE * FROM `verification` WHERE Email='$user_mail'";
			$result=$conn->query($sql);
		}
		else
			echo "NO MATCH";
	}
/*
		$sql= "DELETE * FROM `verification` WHERE Email='$user_mail'";
		$result=$conn->query($sql);
 */
?>