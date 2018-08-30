<?php
	$str = 'https://home.php?id=0&mail=bhuvnesh.cityinnovates@gmail.com';
//localtime();
	$times=time();
echo "$times<br>";
$encoded = urlencode( base64_encode( $str ) );
$decoded = base64_decode( urldecode( $encoded ) );
$new_string = chunk_split(base64_encode($str));
print_r($new_string);
//echo parse_url($decoded);
//var_dump($decoded);
// print_r($decoded->email);
//echo"<br>$encoded<br>";
//echo "$decoded";
?>





<script>
	function verifyMail(user_mail)
	{
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.statsus == 200) {
				document.getElementById('msg').innerHTML = this.responseText;
			}
		}		
		xhttp.open("GET", "forgotpass_2.php?email="+user_mail, true);
		xhttp.send();
	}
</script>
<html>
<head>
	<title>Forgot Password</title> 	
</head>
<body>
	<h3>PLEASE ENTER YOUR REGISTERED EMAIL ID TO RESET YOUR PASSWORD</h3>
	<br>
	<!--<form onsubmit='verifyMail(email.value)'>-->
	<form method="GET" action='forgotpass_2.php' target='_self'>
		Email: <input type='email' name='email' placeholder='Your Email Address' required>
		<br>
		<input type="submit" name="submit" value="Submit" > 
	</form>
	<div id="msg"></div>
</body>
</html>

	