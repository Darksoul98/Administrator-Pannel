<?php include 'connection_chat.php'; ?>
<?php
	//LOGOUT
	if(!empty($_REQUEST['chat_logout']))
	{
		if($_REQUEST['chat_logout']==1)
		{
			session_start();
			$_SESSION['logged_in']= false;
			$username_n=$_SESSION['chat_username'];
			$sql="UPDATE `users` SET `Online`= 0 WHERE Username= '$username_n'";
			$result =$conn->query($sql);
			session_unset();
			// destroy the session
			session_destroy();			
			header("location: Home.php");			
		}
	}
?>
<html>
<head>
	<title>Chat Login Page</title>
</head>
<?php
	if(!empty($_POST['username'])&&!empty($_POST['password']))
	{
		$username_n=$_POST['username'];
		$password_n=$_POST['password'];
		$sql="SELECT * FROM users WHERE Username='$username_n'";
		$result =$conn->query($sql);
		
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$pass_hash=$row['Password'];//\echo
				$role=$row['Role'];
				$email=$row['Email'];
			}
			if($password_n === $pass_hash)//password_verify($password_n,$pass_hash))
			{
				session_start();
				$_SESSION['chat_username']=$username_n;
				$_SESSION['chat_email']=$email;
				$_SESSION['chat_logged_in']=true;
				//$_SESSION['Role']=$role;
				$sql="UPDATE `users` SET `Online`= 1 WHERE Username='$username_n'";
				$result =$conn->query($sql);
				//$sql="SELECT * FROM users ";
				//$result=$conn->query($sql)->fetch_assoc();
				//$role1=$result['Roles'];
				//$role_arr=explode(',',$role1);
			
				//$_SESSION['Role_Index']=array_search($role,$role_arr);
				
				header("location: chat_home.php");
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
</body>
</html>
