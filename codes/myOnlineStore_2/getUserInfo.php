<html>
	<head>
		<style>
			ul {
				list-style-type: none;
				margin: 0;
				padding: 0;
				overflow: hidden;
				background-color: #333;
			}

			li {
				float: left;
			}

			li a {
				display: inline-block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}

			li a:hover {
				background-color: #111;
			}
		</style>
	</head>
	<body>
		<ul>
		  <li><a class="active" href="http://localhost/codes/myonlinestore_2/index.php">Home</a></li>
		  <li><a href="http://localhost/codes/myonlinestore_2/accountMenu.php">Account Menu</a></li>
		  <li><a href="http://localhost/codes/myonlinestore_2/productMenu.php"><font color="yellow">Product Menu</font></a></li>
		  <li><a href="http://localhost/codes/myonlinestore_2/orderMenu.php"><font color="yellow">Order Menu</a></li>
		  <li><a href="http://localhost/codes/myonlinestore_2/chooseUser.php">Log In</a></li>
		  <li><a href="http://localhost/codes/myonlinestore_2/logOut.php">Log Out</a></li>
		  <li><a href="http://localhost/codes/myonlinestore_2/getUserInfo.php"><font color="yellow">User Directory</font></a></li>
		  <font color="black">
		</ul>
		<h1>USER DIRECTORY</h1>
<?php
	require_once('../mysqli_connect.php');
	$query = "SELECT id, name, address, email, password, is_staff FROM User";
	
	$response = @mysqli_query($dbc, $query);
	
	if($response){
		echo '<table align="left"
		celspacing="5" cellpadding="8">
		<tr>
			<td align="left"><b>ID</b></td>
			<td align="left"><b>Name</b></td>
			<td align="left"><b>Address</b></td>
			<td align="left"><b>Email</b></td>
			<td align="left"><b>Password</b></td>
			<td align="left"><b>Is_Staff</b></td>
		</tr>';	
		
		while($row = mysqli_fetch_array($response)){
			echo '<tr><td align ="left">' .
			$row['id'] . '</td><td align="left">' .
			$row['name'] . '</td><td align="left">' .
			$row['address'] . '</td><td align="left">' .
			$row['email'] . '</td><td align="left">' .
			$row['password'] . '</td><td align="left">' .
			$row['is_staff'] . '</td><td align="left">';
			
			echo '</tr>';
		}
		
		echo '</table>';
	}
	else {
		echo "Couldn't issue database query<br />";
		echo mysqli_error($dbc);
	}
	mysqli_close($dbc);
?>
	</body>
</html>