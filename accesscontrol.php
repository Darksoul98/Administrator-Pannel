<?php include'connection.php';?>
<?php
	session_start();
	if(!($_SESSION['logged_in'])){
		session_unset();
		session_destroy();
		header('Location: login.php');
    }
?>
<?php 
	if(!empty($_REQUEST['role_val'])){
		$role_val=$_REQUEST['role_val'];		
	}
	if(!empty($_REQUEST['sno'])){
		$id=$_REQUEST['sno'];		
	}
	
	if(!empty($_REQUEST['fltr_str'])){
		$fltr_str=$_REQUEST['fltr_str'];		
	}
	else{
		$fltr_str="";
	}
?>
<?php 
	$_SESSION['count']=array(0,1,1);
?>

<script>
	var row=0;
	var col=0;
	var clone_count=0;
	var clone;
	function getRowId(){
		row++;
		return row+","+col+","+clone_count;
	}
	function getColId(){
		col++;
		return row+","+col+","+clone_count;
	}
</script>
<script>
	var clone=0;
	function access(val,sno,str,k)
	{	
		try{
			var i=0;
			var arr=[];
			var temp=str;//access int
			temp=temp.toString();//convert to string for indexing
			access_val=temp[val];//1 for admin, 2 for employee, 3 for guest 
			document.getElementById(k+"access"+sno).value=access_val;

		}
		catch(err) {
			document.getElementById("demo").innerHTML = err.message;
		}
	}
</script>
<script>	
	var str="";
</script>
<script>
	function update_acc(itt,sno){
		try{
			
			var role_val=document.getElementById(itt+"role"+sno).value;
			str += sno+","+role_val+";";
			document.getElementById("demo").innerHTML = str;
		}
		catch(err) {
			document.getElementById("demo").innerHTML = err.message;
		}		
	}
</script>
<script>
	function sort(fltr_str){

		try{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if(this.readyState == 4 && this.status == 200){
					document.getElementById("show_table").innerHTML =this.responseText;
				}
			}
			xmlhttp.open("GET","accesscontrol_2.php?q=filter&fltr_str="+fltr_str,true);
			xmlhttp.send();
		}
		catch(err) {
			document.getElementById("demo").innerHTML = err.message;
		}		
	}
</script>
<script>

	function add_row(sno){
		var count=0
		document.getElementById("demo").innerHTML = count++;
		try{	
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if(this.readyState == 4 && this.status == 200){
					document.getElementById("show_table").innerHTML =this.responseText;
				}
			}
			xmlhttp.open("GET","accesscontrol_2.php?q=filter&addrow="+sno,true);
			xmlhttp.send();
		}
		catch(err) {
			document.getElementById("demo").innerHTML = err.message;

		}		
	}
</script>
<script>
	function f_update(){
		try{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if(this.readyState == 4 && this.status == 200){
					document.getElementById("demo").innerHTML =this.responseText;
					document.getElementById("refresh").href="accesscontrol.php";
					document.getElementById("refresh").click();
				}
			}
			xmlhttp.open("GET","accesscontrol_2.php?q=update&str="+str,true);
			xmlhttp.send();
		}
		catch(err) {
			document.getElementById("demo").innerHTML = err.message;
		}	
	}
</script>
<?php
	$sql="SELECT * FROM acccessmanager";
	$result = $conn->query($sql);
?>

<html>
<head>
	<title>ACCESS CONTROL</title>
</head>
<body>
	<form>
		Filter by :<input type="text" name="fltr_str" value="" onkeyup="sort(this.value)"> 	
		<a id='go' href="#" onclick="f_update()" >GO</a> 
	</form>
	<br>
	<div id="show_table">
		<script> sort("");</script>
	</div>
	<a id="refresh" href="#" onclick="f_update()">REFRESH</a> 
	<a href="adminhome.php" >Back to Admin Page</a> 
	<div id="demo"></div>
</body>
</html>	