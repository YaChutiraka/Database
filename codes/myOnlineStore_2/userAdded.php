<html>
	<head>
		<title> Add New User </title>
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
	<head>
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
		<?php
			if(isset($_POST['submit'])){
				
				$data_missing = array();
				if(empty($_POST['name'])){
					$data_missing[] = 'Name';
				}
				else {
					$name = trim($_POST['name']);
				}
				
				if(empty($_POST['address'])){
					$data_missing[] = 'Address';
				}
				else {
					$address = trim($_POST['address']);
				}
				
				if(empty($_POST['email'])){
					$data_missing[] = 'Email';
				}
				else {
					$email = trim($_POST['email']);
				}
				
				if(empty($_POST['password'])){
					$data_missing[] = 'Password';
				}
				else {
					$password = trim($_POST['password']);
				}
				
				if(empty($_POST['is_staff'])){
					$data_missing[] = 'Is_Staff';
				}
				else {
					$is_staff = trim($_POST['is_staff']);
				}
				
				if(empty($data_missing)){
					require_once('../mysqli_connect.php');
					
					$query = "INSERT INTO User (name, address, email, password, is_staff) VALUES (?, ?, ?, ?, ?)";
					
					$stmt = mysqli_prepare($dbc, $query);
					
					#i Integers
					#d Doubles
					#b Blobs
					#s Everything Else
					
					mysqli_stmt_bind_param($stmt, "sssss", $name, $address, $email, $password, $is_staff);
					mysqli_stmt_execute($stmt);
					
					$affected_rows = mysqli_stmt_affected_rows($stmt);
					
					if($affected_rows == 1){
						echo "New User Account Created";
						mysqli_stmt_close($stmt);
						mysqli_close($dbc);
						
					}
					else {
					 
						echo 'Error Occurred<br />';
						echo mysqli_error();
					 
						mysqli_stmt_close($stmt);
					 
						mysqli_close($dbc);
					 
					}
				}	
				else {
						echo "The following data are required<br />";
						foreach($data_missing as $missing){
							echo "$missing<br />";
						}
						echo "<b>Try again</b>";
				}
			}
		?>
		<p>Create another account? <a href="http://localhost/codes/myonlinestore_2/addUser.php"> click</a></p> 
	</body>
</html>	