<?php include 'connection.php'; ?>
<?php
	$username=$_POST['username'];
	//echo $_POST['newpass'];
	$new_password=password_hash($_POST['newpass'],PASSWORD_DEFAULT);
	echo $username;
//	echo $new_password;
	$sql="UPDATE login SET PasswordHash='$new_password' WHERE Username='$username'";
	if($conn->query($sql)){
		ECHO"PASSWORD UPDATED<br>";
		ECHO"<a href='Home.php' target='_self'>BACK TO HOME PAGE</a>";	
	}	
?>