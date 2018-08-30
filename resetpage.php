
<?php

	$timestamp=base64_decode($_REQUEST['t']);
	$username = base64_decode($_REQUEST['uname']);
	$username2=$_REQUEST['uname'];
	echo "$username";
	//$decoded = base64_decode( urldecode( $p ) );
	echo "<h3>PASSWORD RESET PAGE</h3><br>";
	if ((time()-$timestamp)>7200){
		echo "LINK EXPIRED<br>";
		echo "<a href = 'adminhome.php' target='_self'>BACK TO LOGIN PAGE</a>";
		echo "<script>document.getElementById('resetform').innerHTML=' '; </script>";
		$disableflag=1;
	}
	else
	{
		$disableflag=0;
	}
?>

<script>
	function passwordcheck(pass2,pass1)
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
	<title>PASSWORD RESET</title>
</head>
<body>

	
	<div id="error"></div>
	<?php 
	if($disableflag==0){
		echo "<div id='resetform_2.php'>
		<form method='POST' action='resetpage_2.php'>
			<input type='hidden' name='username' value=$username > 
			New password:    <input type='password' name='newpass' ><br><br>
			Confirm password:<input type='password' name='newpass2' onkeyup='passwordcheck(this.value,newpass.value)'>
			<div id='passworderror'></div>
			<input id='mysubmit' type='submit' name='submit' value ='submit'>
		</form>
		</div>";
	}
	?>
</body>
</head>	