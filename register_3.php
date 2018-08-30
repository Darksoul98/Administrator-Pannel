<?php include 'navbar.php' ?>
<?php 
	//$timestamp=base64_decode($_REQUEST['t']);
	//$timestamp=base64_decode($_REQUEST['t']);
	//$username = base64_decode($_REQUEST['uname']);
	//$user_mail = base64_decode($_REQUEST['umail']);
	//$mobile = base64_decode($_REQUEST['mobile']);
	$timestamp=urldecode($_REQUEST['t']);
	$username = urldecode($_REQUEST['uname']);
	$user_mail = urldecode($_REQUEST['umail']);
	$mobile = urldecode($_REQUEST['mobile']);
	echo "<br>HEYY, $username";
	echo "<br>HEYY, $timestamp";
	echo "<br>HEYY, $user_mail";
	echo "<br>HEYY, $mobile";
	echo "<h3>User Verification Page</h3><br>";
	if ((time()-$timestamp)>7200){
		echo "LINK EXPIRED<br>";
		$disableflag=1;
	}
	else
	{
		echo "LINK NOT EXPIRED<br>";
		$disableflag=0;
	}
?>
<script>
	function code_check(){
		try{
			//document.write("12");
			var user_mail= "<?php echo $user_mail;?>";
			var code= document.getElementById("code_id").value;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("demo").innerHTML = this.responseText;
					if ( this.responseText == "MATCH"){
						document.getElementById('codeinput').innerHTML = "Account verified successfully";
						document.getElementById('resend').innerHTML = "";
					}
					else{
						document.getElementById('codeinput').innerHTML = "INVALID CODE";
					}
					
				}
			}		
			xhttp.open("GET", "register_4.php?email="+user_mail+"&code="+code, true);
			xhttp.send();
		}
		catch(err) {
			document.getElementById("demo").innerHTML = err.message;
		}
	}
</script>
<html>
<head>
	<title>VERIFICATION PAGE</title>
</head>
<body>
	<div id="error"></div>
	<?php 
		if($disableflag == 0){
	?>
	
		<div id="codeinput">
		
			Enter Code: <input id="code_id" type="text" >
			<button type="button" onclick="code_check()" >Submit</button>
		
		</div>
	<?php 
		}
	?>
	<div id="resend">
		<?php 
			echo "<a href='register_3.php?type=send&name=".$username."&email=".$user_mail."&mobile=".$mobile."'>RESEND CODE </a>";
		?>
	</div>
		
	<div id="demo"></div>
	
</body>
</head>	