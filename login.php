<?php include 'connection.php';?>

<?php
	//LOGOUT
	if(!empty($_REQUEST['logout']))
	{
		if($_REQUEST['logout']==1)
		{
			session_start();
			$_SESSION['logged_in']= false;
			session_unset();
			// destroy the session
			session_destroy();					
		}
	}
?>
<html>
<head> 
	<title>Administrator Login Page</title>
</head>
<?php
	if(!empty($_POST['username'])&&!empty($_POST['password']))
	{
		$username_n=$_POST['username'];
		$password_n=$_POST['password'];
		$sql="SELECT * FROM login WHERE Username='$username_n'";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$pass_hash=$row['PasswordHash'];//\echo
				$role=$row['Role'];
			}
			if(password_verify($password_n,$pass_hash))
			{
				session_start();
				$_SESSION['username']=$username_n;
				$_SESSION['logged_in']=true;
				$_SESSION['Role']=$role;
				
				$sql="SELECT * FROM acccessmanager ";
				$result=$conn->query($sql)->fetch_assoc();
				$role1=$result['Roles'];
				$role_arr=explode(',',$role1);
				
				$_SESSION['Role_Index']=array_search($role,$role_arr);
				
				header("location: adminhome.php");
			}
			else
				echo "INVALID CREDENTIALS";
		}
		else{
			echo "INVALID CREDENTIALS";
		}
	}
?>
<body>
	<form method="POST"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		Username: <input type="text" name="username" placeholder="enter username" required>
		<br><br>
		Password: <input type="password" name="password" required>
		<input type="submit" name="submit" value="Submit" >
	</form>
	<a href='forgotpass.php'> Forgot Password</a>
</body>
</html>