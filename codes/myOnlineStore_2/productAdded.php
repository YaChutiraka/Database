<html>
	<head>
		<title> Add New Product </title>
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
		session_start();
		$is_staff = $_SESSION['is_staff'];
		if($is_staff == "Y"){
			if(isset($_POST['submit'])){
				
				$data_missing = array();
				
				if(empty($_POST['name'])){
					$data_missing[] = 'Name';
				}
				else {
					$name = trim($_POST['name']);
				}
				
				if(empty($_POST['price'])){
					$data_missing[] = 'Price';
				}
				else {
					$price = trim($_POST['price']);
				}
				
				if(empty($_POST['stock_quantity'])){
					$data_missing[] = 'Stock Quantity';
				}
				else {
					$stock_quantity = trim($_POST['stock_quantity']);
				}
				
				if(empty($_POST['description'])){
					$data_missing[] = 'Description';
				}
				else {
					$description = trim($_POST['description']);
				}
				
				if(empty($_POST['active'])){
					$data_missing[] = 'active';
				}
				else {
					$active = trim($_POST['active']);
				}
				
				
				if(empty($data_missing)){
					require_once('../mysqli_connect.php');
					
					$query = "INSERT INTO Product (name, price, stock_quantity, description, active) VALUES (?, ?, ?, ?, ?)";
					
					$stmt = mysqli_prepare($dbc, $query);
					
					#i Integers
					#d Doubles
					#b Blobs
					#s Everything Else
					
					mysqli_stmt_bind_param($stmt, "ssiss", $name, $price, $stock_quantity, $description, $active);
					mysqli_stmt_execute($stmt);
					
					$affected_rows = mysqli_stmt_affected_rows($stmt);
					
					if($affected_rows == 1){
						
						echo "New Product Has Been Added";
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
		}
		else {
			echo "You have no permission to do this<br />";
		}
	?>
		<p>Create another product? <a href="http://localhost/codes/myonlinestore_2/addProduct.php"> click</a></p>
	</body>
</html>	