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
		<form action="http://localhost/codes/myonlinestore_2/userAdded.php" method="post">
			<b>Add a new User</b>
			<p>Name:
				<input type="text" name="name" size="30" maxlength="100" value=""></>
			</p>
			<p>Address:
				<input type="text" name="address" size="30" maxlength="300" value=""></>
			</p>
			<p>Email (CANNOT USE SAME EMAIL AS ANOTHER USER):
				<input type="text" name="email" size="30" maxlength="100" value=""></>
			</p>
			<p>Password:
				<input type="text" name="password" size="30" maxlength="20" value=""></>
			</p>
			<p>Is_Staff:
				<input type="text" name="is_staff" size="30" maxlength="1" value=""></>
			</p>
			<p>
				<input type="submit" name="submit" value="Send">
			</p>
		</form>	
	</body>
</html>