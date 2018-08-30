<?php include 'connection_chat.php'; ?>
<?php 
	$sql="SELECT * FROM users WHERE Online= 1";
	$result=$conn->query($sql);
	//var_dump($result);
	$online_count=$result->num_rows;
	//echo $online;
	
?>
<html>
<head>
	<title>Online Users</title>
</head>
<body>
	<table>
		<tr>
			<th>Sno</th>
			<th>Online Users</th>
			<th>Message</th>
		</tr>
		<?php
			for($i=1;$i<=$online_count;$i++){
				$row=$result->fetch_assoc();
				echo "<tr><td>$i</td>
					<td>".$row['Username']."</td>
					<td><a href='Chat/chat_box.php?user=".$row['Username']."'>Chat</a></td>
					</tr>";
			}
		?>
	</table>
</body>
</html>