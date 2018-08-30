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
	if(empty($_REQUEST['add']))
	{
		$str=$_REQUEST['str'];
		$type=$_REQUEST['type'];
		$sql="SELECT * FROM login WHERE $type='$str'";
		$result=$conn->query($sql);
		if($result->num_rows > 0){
			echo ":( This $type Already Exists";
		}
		else
			echo ":)";		
	}
	else
	{
		$Username=$_REQUEST['username2'];
		$Email=$_REQUEST['email'];
		$Role=$_REQUEST['role'];
		$Pass=$_REQUEST['pass2'];
		$Password=password_hash($Pass,PASSWORD_DEFAULT);
		$sql="INSERT INTO `login`(`Username`, `Email`, `PasswordHash`, `Role`) VALUES ('$Username','$Email','$Password','$Role')";
		if($conn->query($sql))
			echo "hogaya add";
		else 
			echo"nhi hua add";
		echo '<a href="adminhome.php">HOME WAPAS</a>';
		
	}
?>