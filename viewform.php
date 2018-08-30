<?php include 'connection.php';?>
<?php
	session_start();
	if(!($_SESSION['logged_in'])){
		//$_SESSION['header_loc']="adminhome.php";
		session_unset();
		session_destroy();
		header('Location: login.php');
    }
	$mod=$_REQUEST['module'];
	//echo $mod;
	$sql="SELECT Access FROM acccessmanager WHERE Module='$mod'";
	//echo $sql;
	$result=$conn->query($sql)->fetch_assoc();
	$acc=$result['Access'];
	//echo $_SESSION['Role_Index'];
	//echo $acc[$_SESSION['Role_Index']+1];
	if($acc[$_SESSION['Role_Index']+1]== 0){
		header('Location: adminhome.php?msg=ACCESS DENIED');
	}
?>

<script>
	var id=<?php echo $id; ?>
	var q=<?php echo $q; ?>
	var fltr_str=<?php echo $fltr_str; ?>
	var sort_str=<?php echo $sort_str; ?>
	var n_order=<?php echo $n_order; ?>	
	var xmlhttp = new XMLHttpRequest();
	function on_start(){
		
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("show_table").innerHTML = this.responseText;
			}
		}		
		xmlhttp.open("GET", "view_2.php?q="+q+"&id="+id+"&fltr_str="+fltr_str+"&sort_str="+sort_str+"&n_order="+n_order, true);
		xmlhttp.send();
		
	}	
</script>
<script>
	function toggle_func(id){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange=function(){
			if(this.readyState == 4 && this.status == 200){
				document.getElementById("show_table").innerHTML =this.responseText;
			}
		}
		xmlhttp.open("GET","view_2.php?q=toggle&id="+id,true);
		xmlhttp.send();
	}	
</script>
<script>
	function del_func(id){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange=function(){
			if(this.readyState == 4 && this.status == 200){
				document.getElementById("show_table").innerHTML =this.responseText;
			}
		}
		xmlhttp.open("GET","view_2.php?q=delete&id="+id,true);
		xmlhttp.send();
	}	
</script>
<script>
	function order_func(n_order,id,fltr_str,sort_str){	
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange=function(){
			if(this.readyState == 4 && this.status == 200){
				document.getElementById("show_table").innerHTML =this.responseText;
			}
		}
		xmlhttp.open("GET","view_2.php?q=update&id="+id+"&n_order="+n_order,true);
		xmlhttp.send();
	}
</script>
<script>
	function sort(sort_str,fltr_str){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("show_table").innerHTML = this.responseText;
			}
		}
		xmlhttp.open("GET", "view_2.php?q=sortnfilter&id=0&fltr_str="+fltr_str+"&sort_str="+sort_str,true);
		xmlhttp.send();
	}	
</script>
<html>
<head>
	<title>View Form</title>
</head>
<body>
	<h1>View Form</h1>
	<form>
		Filter by :<input type="text" name="fltr_str" value="" onkeyup="sort(sort_str.value,this.value)"> 
		Sort by:
		<select name="sort_str" onchange="sort(this.value,fltr_str.value)">
			<option value="SNo" selected>SNo</option>
			<option value="Name" >Name</option>
			<option value="Parent" >Parent</option>
			<option value="ParentName" >Parent Name</option>
			<option value="Link" >Link</option>
			<option value="Target" >Target</option>
			<option value="OrderNo" >Order</option>
			<option value="Status" >Status</option>
		</select> 
	</form>
	<br>
	<div id="show_table">
		<script> sort("SNo","");</script>
	</div>
	
	<form method="GET">
		<a id="ref" href="viewform.php?q=all&id=1" target="_self"> Refresh </a>
		<br>
		<a href="adminhome.php" target="_self">Back To Admin Page</a>
	</form>
	
</body>
</html>
