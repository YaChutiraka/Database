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
		<?php
			require_once('../mysqli_connect.php');
			session_start();
			$email = $_POST['email'];
			$password = $_POST['password'];
			$query = "SELECT * FROM User WHERE email = '".$email."' AND password = '".$password."'";
			$response = @mysqli_query($dbc, $query);
			# This is for customer's view
			if($response){
				$row = mysqli_fetch_array($response);
				$_SESSION['logged_in_id'] = $row['id'];
				$_SESSION['logged_in_email'] = $row['email'];
				$_SESSION['logged_in_name'] = $row['name'];
				$_SESSION['logged_in_password'] = $row['password'];
				$_SESSION['is_staff'] = $row['is_staff'];
				echo 'You are now logged in as <b>'.$row['name'].'</b> -- ';
				echo ' Email: <b>'.$row['email'].'</b> -- ';
				echo ' Is_Staff: <b>'.$row['is_staff'].'</b><br/><br/>';
				echo 'Continue shopping <a href="http://localhost/codes/myonlinestore_2/index.php">click</a>';
			}
			else {
				$_SESSION['is_staff']='';
				echo "Couldn't log in. Try again<br />";
				echo mysqli_error($dbc);
			}
			mysqli_close($dbc);
		?>
	</body>
</html>