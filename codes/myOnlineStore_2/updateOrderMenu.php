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
		<h1> Update Order Menu </h1>
		<p> Add a product to order/cart <a href="http://localhost/codes/myonlinestore_2/addToContains.php"> click</a></p>
		<p> Delete a product from order/cart <a href="http://localhost/codes/myonlinestore_2/deleteContains.php"> click</a></p>
		<p> Update quantity of a product in order/cart <a href="http://localhost/codes/myonlinestore_2/updateContains.php"> click</a></p>
		<p> Make payment on order/cart <a href="http://localhost/codes/myonlinestore_2/payOrder.php"> click</a></p>
		<p> <font color ="yellow">Update date of order/cart <a href="http://localhost/codes/myonlinestore_2/updateOrderDate.php"> click</a></p>
		<p> <font color ="yellow">Update whether order/cart was paid <a href="http://localhost/codes/myonlinestore_2/updateOrderPaid.php"> click</a></p>
	</body>
</html>