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
			$order_id = $_SESSION['order_id'];
			$total_price = $_SESSION['total_price'];
			if($user_id != '' && $order_id != ''){ //IS LOGGED IN
				if(isset($_POST['submit'])){
					$data_missing = array();
					
					if(empty($_POST['amount'])){
						$data_missing[] = 'Amount';
					}
					else{
						$amount = trim($_POST['amount']);
					}
					if(empty($_POST['orderid'])){
						$data_missing[] = 'OrderID';
					}
					else{
						$orderid = trim($_POST['orderid']);
					}
					
					if(empty($data_missing) && $amount == $total_price && $orderid == $order_id){
						require_once('../mysqli_connect.php');
						$query = "UPDATE OrderMade SET paid = 'Y' WHERE id = $order_id";
						$response = @mysqli_query($dbc, $query);
					
					
						if($response){
							echo "Order has been completed and paid for.";
							$_SESSION['order_id'] = '';
							mysqli_close($dbc);
						}
						else{
							echo 'Error Occured<br />';
							echo mysqli_error($dbc);
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