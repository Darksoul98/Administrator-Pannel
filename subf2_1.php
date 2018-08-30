<?php
	session_start();
	if(!($_SESSION['logged_in'])){
		//$_SESSION['header_loc']="adminhome.php";
		session_unset();
		session_destroy();
		header('Location: login.php');
    }
?>
<?php include 'connection.php';?>
<?php 
	if($q=='y'){
		$sql="SELECT ParentName FROM form WHERE SNo=$id";
		$result = $conn->query($sql);
		if ($result->num_rows > 0){			
			$row =  $result->fetch_assoc();
			$pname=$row['ParentName'];
		}
		else
			$pname="NULL";
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
	else
		echo '<input type="hidden" name="pname" value="NULL" > ';
?>