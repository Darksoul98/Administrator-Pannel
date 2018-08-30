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
	$sql="SELECT Access FROM acccessmanager WHERE Module='$mod'";
	$result=$conn->query($sql)->fetch_assoc();
	$acc=$result['Access'];
	if($acc[$_SESSION['Role_Index']+1]== 0){
		header('Location: adminhome.php?msg=ACCESS DENIED');
	}
?>

<script>
	function showNext(str,id){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("pname1").innerHTML = this.responseText;
			}
		}		
		xhttp.open("GET", "subf2_1.php?q="+str+"&id="+id, true);
		xhttp.send();
	}
</script>
<html>
<head>
	<title>Admin Page</title>
</head>
<?php 
	if($id != 0){
		$sql="SELECT * FROM form WHERE SNo =$id";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0){			
			$row =  $result->fetch_assoc();
			$name=$row['Name'];
			$parent=$row['Parent'];
			$pname=$row['ParentName'];
			$order=$row['OrderNo'];
			$status=$row['Status'];
			$link=$row['Link'];
			$target=$row['Target'];
		
		}
	}
	else{
		$name="";
		$parent="";
		$pname="";
		$order="";
		$status="";
		$link="";
		$target="";
	}
	
?>
<body>
	<h1> ADD/EDIT Form </h1>
	<form method="post" action="dataup.php?flag=<?php echo $id;?>" target="_self">
		Name: <input type="text" name="name" value= "<?php echo $name; ?>" ><br><br>
		Parent: 
		<input type="radio" name="parent" value = "y" onclick="showNext(this.value,<?php echo $id; ?>)"  <?php if($parent=='y') echo "checked";?>>Yes

		<input type="radio" name="parent" value = "n" onclick="showNext(this.value)" <?php if($parent=='n') echo "checked";?>>No<br><br>		
		
		<div id="pname1">
		<?php 
		if($parent=='y'){
			$sql="SELECT DISTINCT Name FROM form";
			$result = $conn->query($sql);
			echo "Parent Name: <select name='pname'>";
				if ($result->num_rows > 0){
					while($row2 = $result->fetch_assoc()){
						$pname2=$row2['Name'];
						echo "<option value='$pname2'"; 
						if($pname==$pname2)
							echo"selected";
						echo ">$pname2</option>";
					}
				}
			echo "</select> <br><br>";
		}
		?>
		</div>
		Link:<input type="text" name="link" value= "<?php echo $link; ?>"><br><br>
		Target:
			<select name="target">
				<option value="_self" <?php if($target== "_self")echo "selected"; ?>>_self</option>
				<option value="_blank" <?php if($target== "_blank")echo "selected"; ?>>_blank</option>
			</select>
		<br><br>
		<input type="submit" name="submit" value="Submit">
	</form>
	
</body>
</html>