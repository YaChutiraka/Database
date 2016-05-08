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
		<form action="http://localhost/codes/myonlinestore_2/paymentPaid.php" method="post">
			<b>Make Payment For Order/Cart</b>
			<!-- <p><em>Required</em></p> -->
			<p>Card Number:
				<input type="text" name="card_number" size="30" maxlength="12" value=""></>
			</p>
			<p>Pin:
				<input type="text" name="pin" size="30" maxlength="12" value=""></>
			</p>
			<p>Amount: $
				<input type="text" name="amount" size="30" maxlength="12" value=""></>
			</p>
			<p>Order ID:
				<input type="text" name="orderid" size="30" maxlength="100" value=""></>
			</p>
			<p>
				<input type="submit" name="submit" value="Submit">
			</p>
		</form>	
		<br/>
		<h1> ORDER SUMMARY </h1>
		<br/>
		<?php
			session_start();
			require_once('../mysqli_connect.php');
			$order_id = $_SESSION['order_id'];
			$is_staff = $_SESSION['is_staff'];
			$query = "SELECT C.order_id AS OrderID, C.product_id AS ProductID, P.name AS Name, P.price AS Price, C.quantity AS Quantity, P.price * C.quantity AS Subtotal FROM Contains C, Product P WHERE C.order_id = $order_id AND C.product_id = P.id";
			
			$response = @mysqli_query($dbc, $query);
			
			if($response){
				echo '<table align="left"
				celspacing="5" cellpadding="8">
				<tr>
					<td align="left"><b>Order ID</b></td>
					<td align="left"><b>Product ID</b></td>
					<td align="left"><b>Name</b></td>
					<td align="left"><b>Price Each</b></td>
					<td align="left"><b>Quantity</b></td>
					<td align="left"><b>Subtotal</b></td>
				</tr>';	
		
				while($row = mysqli_fetch_array($response)){
					echo '<tr><td align ="left">' .
					$row['OrderID'] . '</td><td align="left">' .
					$row['ProductID'] . '</td><td align="left">' .
					$row['Name'] . '</td><td align="left">' .
					$row['Price'] . '</td><td align="left">' .
					$row['Quantity'] . '</td><td align="left">' .
					$row['Subtotal'] . '</td><td align="left">';
			
					echo '</tr>';
				}
		
				echo '</table>';

			}
			else {
				echo "Couldn't issue database query<br />";
				echo mysqli_error($dbc);
			}
			
			require_once('../mysqli_connect.php');
			$query = "SELECT SUM(P.price * C.quantity) AS Total FROM Contains C, Product P WHERE C.order_id = $order_id AND C.product_id = P.id";
			$response = @mysqli_query($dbc, $query);
			if($response){
				echo '<table align="left"
				celspacing="5" cellpadding="8">
				<tr>
					<td align="left"><b>Total</b></td>
				</tr>';	
		
				while($row = mysqli_fetch_array($response)){
					echo '<tr><td align ="left">' .
					$row['Total'] . '</td><td align="left">';
					$_SESSION['total_price'] = $row['Total'];
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