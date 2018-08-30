<?php include 'connection.php'?>
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
	$count=$_SESSION['count'];
	//$count=$GLOBALS['count'];
	if(!empty($_REQUEST['role_val'])){
		$role_val=$_REQUEST['role_val'];		
	}
	if(!empty($_REQUEST['sno'])){
		$sno=$_REQUEST['sno'];		
	}
	else
		$sno="";
	if(!empty($_REQUEST['q'])){
		$q=$_REQUEST['q'];		
	}
	if(!empty($_REQUEST['fltr_str'])){
		$fltr_str=$_REQUEST['fltr_str'];		
	}
	else{
		$fltr_str="";
	}
	if(!empty($_REQUEST['str'])){
		$str=$_REQUEST['str'];	
	}
	else{
		$str="";
		echo "asdasd";
	}
	if(!empty($_REQUEST['addrow'])){
		$rowno=$_REQUEST['addrow'];		
		$count[$rowno]++;
		$_SESSION['count']=$count;
		//var_dump($count);
		//$count=stat_count($rowno);
	}

	$sql_arr=array("filter"=>"SELECT * FROM acccessmanager WHERE Roles LIKE '%$fltr_str%'
						OR Module LIKE '%$fltr_str%'
						OR Access LIKE '%$fltr_str%' ORDER BY SNo",
					"all"=>"SELECT * FROM acccessmanager");
	
	if($q=="update"){
		$str=explode(';',$str);
		for($i=0;$i<sizeof($str)-1;$i++){
			$s=$str[$i];
			//var_dump($s);
			$str2=explode(',',$s);
			//var_dump($str2);
			$sno=$str2[0];
			$role_val=$str2[1];
			$sql="SELECT * FROM acccessmanager WHERE SNo=$sno ";
			$result=$conn->query($sql);
			$row=$result->fetch_assoc();
			$acc=$row['Access'];
			if ($acc[$role_val]=='0'){
				$acc[$role_val]='1';
			}
			else{
				$acc[$role_val]='0';
			}
			$sql="UPDATE acccessmanager SET Access=$acc WHERE SNo=$sno";
			$result=$conn->query($sql);
		}
		
	}
	else{
		$sql=$sql_arr[$q];
		$result = $conn->query($sql);
		echo"<table id='totable'>
		<tr>
		<th>SNo</th>
		<th>Module</th>
		<th>Role</th>
		<th>Access</th>
		<th></th>
		</tr>";
		if($result->num_rows > 0)
		{	$k=0;
			$clone_count=0;
			$row=0;
			$col=0;
			while($row=$result->fetch_assoc())
			{
				//$row++;
				$SNo=$row['SNo'];
				$module=$row['Module'];
				$role1=$row['Roles'];
				$access1=$row['Access'];	
				$sno=$row['SNo'];
				$role=explode(',',$role1);
				
				for($itt=0; $itt<$count[$SNo]; $itt++){
					echo "<tr id='$module'>";
						echo "<td >$SNo </td>";	
						echo "<td >$module </td>";
						echo "<td><select id='".$itt."role".$SNo."' name='roleer' onchange='access(this.value,$sno,$access1,$itt)'>
							<option value= 0 selected >SELECT ROLE</option>";
							for($i=0,$j=1;$i<sizeof($role);$j++,$i++){
								echo "<option value= $j >$role[$i]</option>";
							}
						echo "</td>
						<td>
							<select id='".$itt."access".$SNo."' onchange='update_acc($itt,$SNo)'>
								<option value=2 selected>SELECT ACCESS</option>
								<option value=1  >Yes</option>
								<option value=0 >No</option>
							</select>
						</td>
						
						<td>
							<button type='button' name='addrow' onclick='add_row($sno)'>+</button>
						</td>
					</tr>";
				} 
			}
		}
		echo "</table>";
	}

?>