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
			if($is_staff == 'N' && $order_id != ''){ //IS NOT STAFF
				if(isset($_POST['submit'])){
					$data_missing = array();
					
					if(empty($_POST['product_id'])){
						$data_missing[] = 'Product ID';
					}
					else{
						$product_id = trim($_POST['product_id']);
					}
					
					if(empty($data_missing)){
						require_once('../mysqli_connect.php');
						$query = "DELETE FROM Contains WHERE order_id = ? AND product_id = ?";
						$stmt = mysqli_prepare($dbc, $query);

						#i Integers
						#d Doubles
						#b Blobs
						#s Everything Else	

						mysqli_stmt_bind_param($stmt, "ii", $order_id, $product_id);
						mysqli_stmt_execute($stmt);
						
						$affected_rows = mysqli_stmt_affected_rows($stmt);
						
						if($affected_rows == 1){
							echo "Deleted product from order/cart.";
							mysqli_stmt_close($stmt);
							mysqli_close($dbc);
						}
						else{
							echo 'Error Occurred<br />';
							echo mysqli_error($dbc);
					 
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
			if($is_staff == 'Y'){  //IS STAFF
				if(isset($_POST['submit'])){
					$data_missing = array();
					
					if(empty($_POST['product_id'])){
						$data_missing[] = 'Product ID';
					}
					else{
						$product_id = trim($_POST['product_id']);
					}
					if(empty($_POST['orderid'])){
						$data_missing[] = 'Order ID';
					}
					else{
						$orderid = trim($_POST['orderid']);
					}
					
					if(empty($data_missing)){
						require_once('../mysqli_connect.php');
						$query = "DELETE FROM Contains WHERE order_id = ? AND product_id = ?";
						$stmt = mysqli_prepare($dbc, $query);

						#i Integers
						#d Doubles
						#b Blobs
						#s Everything Else	

						mysqli_stmt_bind_param($stmt, "ii", $orderid, $product_id);
						mysqli_stmt_execute($stmt);
						
						$affected_rows = mysqli_stmt_affected_rows($stmt);
						
						if($affected_rows == 1){
							echo "Product deleted from order/cart.";
							mysqli_stmt_close($stmt);
							mysqli_close($dbc);
						}
						else{
							echo 'Error Occurred<br />';
							echo mysqli_error($dbc);
					 
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
			
		?>
		<p>Need another update on order/cart? <a href="http://localhost/codes/myonlinestore_2/updateOrderMenu.php"> click</a></p> 
	</body>
</html>