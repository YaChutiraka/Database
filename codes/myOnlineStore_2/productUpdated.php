<html>
	<head>
		<title> Update Product </title>
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
		if($is_staff == 'Y'){  //IS STAFF MEMBER
			if(isset($_POST['submit'])){
				
				$data_missing = array();
				
				if(empty($_POST['id'])){ // id is a required input
					$data_missing[] = 'ID';
				}
				else {
					$id = trim($_POST['id']);
				}
				require_once('../mysqli_connect.php');
				$query = "SELECT * FROM Product WHERE id = '".$id."'";
				$response = @mysqli_query($dbc, $query);
				$result = mysqli_fetch_array($response);
		
				if($_POST['name']==''){
					$name = $result['name'];
				}
				else {
					$name = trim($_POST['name']);
				}
				
				if($_POST['price']==''){
					$price = $result['price'];
				}
				else {
					$price = $_POST['price'];
				}
				if($_POST['stock_quantity']==''){
					$stock_quantity = (int)$result['stock_quantity'];
				}
				else {
					$stock_quantity = (int)$_POST['stock_quantity'];
				}
				if($_POST['description']==''){
					$description = $result['description'];
				}
				else {
					$description = $_POST['description'];
				}
				if($_POST['active']==''){
					$active = $result['active'];
				}
				else {
					$active = $_POST['active'];
				}
				if(empty($data_missing)){
					require_once('../mysqli_connect.php');
					
					$query = "UPDATE Product SET name = ?, price = ?, stock_quantity = ?, description = ?, active = ? WHERE id = ?";

					$stmt = mysqli_prepare($dbc, $query);
					
					#i Integers
					#d Doubles
					#b Blobs
					#s Everything Else
					
					mysqli_stmt_bind_param($stmt, "ssissi", $name, $price, $stock_quantity, $description, $active, $id);
					mysqli_stmt_execute($stmt);
					
					$affected_rows = mysqli_stmt_affected_rows($stmt);
					
					if($affected_rows == 1){
						echo "Product Details Updated<br />";
						if($stock_quantity < 20){
							echo "Stock is dangerously low for this product! PLEASE RESTOCK SOON!";
						}
						mysqli_stmt_close($stmt);
						mysqli_close($dbc);
						
					}
					else {
					 
						echo 'Error Occurred<br />';
						echo mysqli_error($dbc);
					 
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
		else{  //IS NOT STAFF MEMBER
			echo "You have no permission to do this<br />";
		}
		?>
		<p>Update other products? <a href="http://localhost/codes/myonlinestore_2/updateProduct.php"> click</a></p> 
	</body>
</html>	