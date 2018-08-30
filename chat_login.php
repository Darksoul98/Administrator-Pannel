<?php include 'navbar.php' ?>
<?php include 'connection_chat.php' ?>
	else{
		$timestamp=base64_decode($_REQUEST['t']);
		$username = base64_decode($_REQUEST['uname']);
		if ((time()-$timestamp)>7200){
			echo "LINK EXPIRED<br>";
			echo "<a href = 'Home.php' target='_self'>BACK TO HOMEPAGE</a>";
			echo "<script>document.getElementById('resetform').innerHTML=' '; </script>";
			$disableflag=1;
		}
	}