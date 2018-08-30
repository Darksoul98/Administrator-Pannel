<?php include 'connection.php';?> 
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="menu.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/menu.css" rel="stylesheet">
	<link href="css/chocolat.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
	<!--//css-->
	<!--google fonts-->
	<link href="//fonts.googleapis.com/css?family=Poppins:200,200i,300,400,500,500i,600,700,700i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Nunito:400,700,700i,800i,900" rel="stylesheet">
</head>

<?php

	$sql_No_parent="SELECT * FROM form WHERE Parent='n' AND Status='ACTIVE' ORDER BY OrderNo ASC";
	$nav_elements = $conn->query($sql_No_parent);	
?>
<body>
<!--banner-->
	<div class="top nav">
		<nav class="navbar navbar-default">
			<div class="container">
				
				<!-- Collect the nav links, forms, and other content for toggling -->
				<ul class="top-level-menu">
					<?php
					//FIRST LEVEL
					if ($nav_elements->num_rows > 0)

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
				
			</div><!-- /.container-fluid -->
		</nav>
	</div>
</body>
</html>