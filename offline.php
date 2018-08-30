<?php include 'connection_chat.php'; ?>
<?php 
	$sql="SELECT * FROM users WHERE Online= 0";
	$result=$conn->query($sql);
	//var_dump($result);
	$offline_count=$result->num_rows;
	//echo $online;
	
?>
<html>
<head>
	<title>Offline Users</title>
</head>
<body>
	<table>
		<tr>
			<th>Sno</th>
			<th>Offline Users</th>
			<th>Message</th>
		</tr>
		<?php
			for($i=1;$i<=$offline_count;$i++){
				$row=$result->fetch_assoc();
				echo "<tr><td>$i</td>
					<td>".$row['Username']."</td>
					<td><button type='button'>Message</button>
					</tr>";
			}
		?>
	</table>
</body>
</html>