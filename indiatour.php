<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="menu.css">

</head>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "password";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, "travel");

	// Check connection	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql_No_parent="SELECT * FROM form WHERE Parent='n' AND Status='ACTIVE' ORDER BY OrderNo ASC";
	$nav_elements = $conn->query($sql_No_parent);	
?>
<body>
	<ul class="top-level-menu">
		<?php
		//FIRST LEVEL
		if ($nav_elements->num_rows > 0)
			//print_r($nav_elements);
		// output data of each row
			while($row = $nav_elements->fetch_assoc())
			{
				echo "<li>
						<a href=".$row['Link']." target=".$row['Target'].">".$row['Name']."</a>";
				
				//SECOND LEVEL
				$pname=$row['Name'];
				$sql_2nd_lvl="SELECT * FROM form WHERE ParentName='$pname' AND Status = 'ACTIVE' ORDER BY OrderNo ASC";
				$sub_2nd_lvl=$conn->query($sql_2nd_lvl);
					if ($sub_2nd_lvl->num_rows >0){
						echo "<ul class='second-level-menu'>";					
						while($row2 = $sub_2nd_lvl->fetch_assoc()){
							echo "<li>
								<a href=".$row2['Link']." target=".$row2['Target'].">".$row2['Name']."</a>";
							
							//THIRD LEVEL
							$pname2=$row2['Name'];
							$sql_3rd_lvl="SELECT * FROM form WHERE ParentName='$pname2' AND Status = 'ACTIVE' ORDER BY OrderNo ASC";
							$sub_3rd_lvl=$conn->query($sql_3rd_lvl);
							if ($sub_3rd_lvl->num_rows >0){
								echo "<ul class='third-level-menu'>";					
								while($row3 = $sub_3rd_lvl->fetch_assoc()){
									echo "<li>
										<a href=".$row3['Link']." target=".$row3['Target'].">".$row3['Name']."</a>";
									echo "</li>";
								}
								echo "</ul>";
							}
							echo "</li>";
						}
						echo "</ul>";
					}	
				echo "</li>";
			}
		?>
	</ul>
	<h1>INDIA TOUR</h1>

</body>
</html>
