<?php include 'connection.php';?>
<?php
	session_start();
	if(!($_SESSION['logged_in'])){
		//$_SESSION['header_loc']="adminhome.php";
		session_unset();
		session_destroy();
		header('Location: login.php');
    }
?>
	
<?php
	if(!empty($_REQUEST['new_role']))
		$new_role=$_REQUEST['new_role'];
	else
		$new_role="";
	$str=$fltr_str;
	$sql_arr= array("all"=>"SELECT * FROM login",
				"filter"=>"SELECT * FROM login WHERE Username LIKE '%$str%'
					OR Email LIKE '%$str%' 
					OR Role LIKE '%$str%' ORDER BY SNo",
				"update"=>"UPDATE login SET Role=$new_role WHERE SNo=$id");
	$sql=$sql_arr[$q];
	$result = $conn->query($sql);
	if($id>0){
		$sql=$sql_arr["sortnfilter"];
		$result = $conn->query($sql);
	}
	echo "<table>
	<tr>
	<th>SNo</th>
	<th>Username</th>
	<th>Email</th>
	<th>Role</th>
	</tr>";
	while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
			$sno=$row['SNo'];
			$role=$row['Role'];
			//echo '$role';
			//if($role=='admin'){ echo'selected';}
			//if($role=='guest'){ echo'selected';}
			echo "<td>" . $row['SNo'] . "</td>";
			echo "<td>" . $row['Username'] . "</td>";
			echo "<td>" . $row['Email'] . "</td>";
			echo "<td>" . "<select name='roles' onchange='role_func(this.value,$sno)'>";
			?>
				<option value='admin' <?php if( $role =='admin')   {echo "selected"; }?> >Administrator</option>
				<option value='employee' <?php if( $role =='employee'){ echo "selected";} ?>>Employee</option>
				<option value='guest' <?php if( $role =='guest')   { echo "selected"; }?>>Guest</option>
			<?php
		echo "</tr>";
		
	}
	echo "</table>";
?>