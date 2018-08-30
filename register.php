<?php include'navbar.php' ?>
<html>
<head>
	<title>Registration</title>
	<meta name='Description' content=Chat System>
	<meta name='Keywords' content=Chat>
</head>
<body>
	<h1>Register</h1>
	<p> Register Yourself </p>
	<form method="post" action="register_2.php">
		Name: <input type='text' name='name'><br><br>
		Mobile No: <input type='text' name='mobile'><br><br>
		Email: <input type='email' name='email'><br><br>
		<input type="hidden" name="type" value="send"> <!-- to check what the functions has to do in next link-->
		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>