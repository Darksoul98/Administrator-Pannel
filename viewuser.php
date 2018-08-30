<?php include'connection.php';?>
<?php
	session_start();
	if(!($_SESSION['logged_in'])){
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
	function sort(fltr_str){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("show_table").innerHTML = this.responseText;
			}
		}
		xmlhttp.open("GET", "viewuser_2.php?q=filter&id=0&fltr_str="+fltr_str,true);
		xmlhttp.send();
	}	
</script>

<script>
	function role_func(val,sno){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("msg_table").innerHTML ="updated";
			}
		}
		xmlhttp.open("GET", "viewuser_2.php?q=update&id="+sno+"&new_role="+val,true);
		xmlhttp.send();
	}	
</script>
<html>
<head>
	<title>View Form</title>
</head>
<body>
	<h1> View Form</h1>
	<form>
		Filter by :<input type="text" name="fltr_str" value="" onkeyup="sort(this.value)">  
	</form>
	<br>
	<div id="show_table">
		<script> sort("");</script>
	</div>
	
	<form method="GET">
		<a id="ref" href="viewuser.php?q=all&id=1" target="_self"> Refresh </a>
		<br>
		<a href="adminhome.php" target="_self">Back To Admin Page</a>
	</form>
</body>
</html>