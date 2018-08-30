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
<script>

	function display(str){
		document.getElementById("ref").href="view_2.php?q=update&nos="+new_order+"&id="+id;
	}
</script>
<script>
	var id=<?php echo $id; ?>
	var q=<?php echo $q; ?>
	var fltr_str=<?php echo $fltr_str; ?>
	var sort_str=<?php echo $sort_str; ?>
	var n_order=<?php echo $n_order; ?>
</script>
<?php

	$str=$fltr_str;
	$str1=$sort_str;

	$sql_arr= array("parent"=>"SELECT * FROM form ORDER BY Parent" ,
				"sort"=>"SELECT * FROM temp ORDER BY $str1",
				"all"=>"SELECT * FROM form",
				"filter"=>"CREATE VIEW temp AS SELECT * FROM form WHERE SNo LIKE '%$str%'
					OR Name LIKE '%$str%' 
					OR Parent LIKE '%$str%' 
					OR ParentName LIKE '%$str%' 
					OR Link LIKE '%$str%' 
					OR Target LIKE '%$str%' 
					OR OrderNo LIKE '%$str%' 
					OR Status LIKE '%$str%'",
				"sortnfilter"=>"SELECT * FROM form WHERE SNo LIKE '%$str%'
					OR Name LIKE '%$str%' 
					OR Parent LIKE '%$str%' 
					OR ParentName LIKE '%$str%' 
					OR Link LIKE '%$str%' 
					OR Target LIKE '%$str%' 
					OR OrderNo LIKE '%$str%' 
					OR Status LIKE '%$str%' ORDER BY $str1",
				"update"=>"UPDATE form SET OrderNo=$n_order WHERE SNo=$id",
				"toggle"=>"UPDATE form SET Status=IF(STRCMP(Status,'ACTIVE')=0,'INACTIVE','ACTIVE') WHERE SNo=$id",
				"delete"=>"DELETE FROM form WHERE SNo='$id'");

		$sql=$sql_arr[$q];
		$result = $conn->query($sql);
		if($id>0){
			//echo "line 112";
			$sql=$sql_arr["sortnfilter"];
			$result = $conn->query($sql);
			//$result = $conn->query("SELECT * FROM form");
		}
		echo "<table>
		<tr>
		<th>SNo</th>
		<th>Name</th>
		<th>Parent</th>
		<th>Parent Name</th>
		<th>Link</th>
		<th>Target</th>
		<th>OrderNo</th>
		<th>Status</th>
		<th>Edit/Delete</th>
		</tr>";
		while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			$pname=$row['ParentName'];
			$sql_count="SELECT COUNT(ParentName) AS c FROM form WHERE ParentName='$pname'";
			$count = $conn->query($sql_count);
			$total=$count->fetch_assoc();
			
			$i=$row['SNo'];
			echo "<td>" . $row['SNo'] . "</td>";
			echo "<td>" . $row['Name'] . "</td>";
			echo "<td>" . $row['Parent'] . "</td>";
			echo "<td>" . $row['ParentName'] . "</td>";
			echo "<td>" . $row['Link'] . "</td>";
			echo "<td>" . $row['Target'] . "</td>";
			echo "<td>" . "<select name='orderchange' onchange='order_func(this.value,$i)'>";
							for($i2=1;$i2<=$total['c'];$i2++){
							echo "<option value='$i2'"; 
								if ($i2==$row['OrderNo']){ 
									echo 'selected';
								} 
								echo ">$i2</option>}";
							}
				echo "</td>";
			echo "<td>" . $row['Status'] . "</td>";
			echo "<td>" . "<a href='f2.php?module=AddForm&id=$i'>edit</a> / 
						<a href='#' onclick='del_func($i)'> delete </a> /
						<a href='#' onclick='toggle_func($i)'> Toggle Status </a>"	. "</td>";
			echo "</tr>";
		}
		echo "</table>";
		
		$conn->close();
?>
