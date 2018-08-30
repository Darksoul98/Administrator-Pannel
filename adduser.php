<?php include 'connection.php';?>
<?php
	session_start();
	if(!($_SESSION['logged_in']))
	{
		//$_SESSION['header_loc']="adminhome.php";
		session_unset();
		session_destroy();
		header('Location: login.php');
    }
	$mod=$_REQUEST['module'];
	$sql="SELECT Access FROM acccessmanager WHERE Module='$mod'";
	$result=$conn->query($sql)->fetch_assoc();
	$acc=$result['Access'];
	if($acc[$_SESSION['Role_Index']+1]== 0){
		header('Location: adminhome.php?msg=ACCESS DENIED');
	}

?>
<script>
	function check(str_value,str_type){
		var div_error=str_type+"_err";
		//document.write(div_error);
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//document.write(1223);
				document.getElementById(div_error).innerHTML = this.responseText;
			}
		}		
		xhttp.open("GET", "adduser_2.php?str="+str_value+"&type="+str_type, true);
		xhttp.send();	
	}
</script>
<script> 			
	function passcheck(pass1,pass2)
	{
		if(pass1===pass2){
			document.getElementById('mysubmit').disabled = false;
			document.getElementById('passworderror').innerHTML="<br>password Match<br>";
		}
		else{
			document.getElementById('mysubmit').disabled = true;
			document.getElementById('passworderror').innerHTML="<br>password doesn't Match<br>";
		}
	}
</script>

<html>
<head>
	<link rel="stylesheet" href="menu.css">
	<title>User Registration Form</title>
</head>
<body>
	<h1>User Registration Form</h1>
	<form method='POST' action='adduser_2.php?add=1'>                                                     
		Username:<input type='text' name='username2' placeholder='Your Username' onkeyup='check(this.value,"Username")'  required><br>
			<div id='Username_err'></div><br>
		E-mail ID:<input type='email' name='email' value='' placeholder='Your Email' onkeyup='check(this.value,"Email")' required><br>
			<div id='Email_err'></div><br>
		Password:<input type='password' name='pass2' value='' placeholder='Your Password' required><br><br>
		Confirm Password:<input type='password' value='' name='con_pass2' placeholder='Confirm Password' onkeyup='passcheck(pass2.value,this.value)' required> <span id='passworderror'></span><br>
		<br>
		<br>
		Role:<select name='role' >
				<option value="admin">Administrator</option>
				<option value="employee">Employee</option>
				<option value="guest" selected>Guest</option>
			</select>
		<input id='mysubmit' type='submit' name='submit' value ='submit'>
	</form>
</body>
</html>
