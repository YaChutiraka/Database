<html>
	<head>
		<title> Add Order/Cart </title>
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
			$user_id = $_SESSION['logged_in_id'];
			if($user_id != ''){ //IS LOGGED IN
				if(isset($_POST['submit'])){
					$data_missing = array();
					
					if(empty($_POST['date'])){
						$data_missing[] = 'Date';
					}
					else{
						$date = trim($_POST['date']);
					}
					
					$paid = 'N';
					
					if(empty($data_missing)){
						require_once('../mysqli_connect.php');
						$query = "INSERT INTO OrderMade (date, paid) VALUES (?, ?)";
						$stmt = mysqli_prepare($dbc, $query);
					
						#i Integers
						#d Doubles
						#b Blobs
						#s Everything Else
					
						mysqli_stmt_bind_param($stmt, "ss", $date, $paid);
						mysqli_stmt_execute($stmt);
					
						$affected_rows = mysqli_stmt_affected_rows($stmt);
						
						$order_id = mysqli_insert_id($dbc);
						$_SESSION['order_id'] = $order_id;
					
						if($affected_rows == 1){
							printf("New order/cart has ID# %u.\n", $order_id);
							//echo "New Order/Cart has been created.";
							
							require_once('../mysqli_connect.php');
							$query = "INSERT INTO Orders (user_id, order_id) VALUES ('$user_id', '$order_id')";
							if(mysqli_query($dbc, $query)){
								echo "New record in Orders made successfully.";
							}
							else{
								echo 'Error Occured<br />';
								echo mysqli_error();
							}
							
							mysqli_stmt_close($stmt);
							mysqli_close($dbc);
						}
						else{
							echo 'Error Occured<br />';
							echo mysqli_error();
							mysqli_stmt_close($stmt);
							mysqli_close($dbc);
						}
						
					}
					else{
							echo "The following data are required<br />";
							foreach($data_missing as $missing){
								echo "$missing<br />";
							}
							echo "<b>Try again</b>";
					}
					
				}
			}
			else{  //IS NOT LOGGED IN
				echo "You have no permission to do this. Must be logged in.<br />";
			}
			
		?>
		<p>Create another order/cart? <a href="http://localhost/codes/myonlinestore_2/addOrder.php"> click</a></p> 
	</body>
</html>	