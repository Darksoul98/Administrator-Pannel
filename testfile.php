<html>
<head>
	<title>test file</title>
</head>
<body>
	<table>
		<tr>
			<th>SNo</th>
			<th>Username</th>
			<th>Email</th>
			<th>Role</th>
		</tr>
		<?php
			$row[1]=4;
			for($i=0;$i<$row[1];$i++){
				echo "<tr>
					<td>1</td>
					<td>1</td>
					<td>1</td>
					<td><button type='button' name='add' onclick='add_Row(1)' >+</button></td>
				</tr>";	
			}
		?>
		<tr>
			<td>2</td>
			<td>2</td>
			<td>2</td>
			<td>2</td>
		</tr>
	</table>
<div id='aa'>
<button id='213' onclick='func(this.id)'>click</button>
</div>

<div id='a1'></div>
	
</body>
</html>
<script>
	function func(id){
		//document.getElementById('a1').innerHTML=id;
		var itm = document.getElementById('aa');
		var cln = itm.cloneNode(true);
		document.getElementById('a1').appendChild(cln); 
	}
</script>