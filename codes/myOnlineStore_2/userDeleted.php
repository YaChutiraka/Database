<html>
	<head>
		<title> Delete Registered User </title>
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
			if($is_staff == "N"){
				if(isset($_POST['submit'])){
				
					$data_missing = array();
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
				
					if(empty($data_missing)){
						require_once('../mysqli_connect.php');
						
						$query = "DELETE FROM User WHERE email = '".$email."' AND password = '".$password."'";
						
						$response = mysqli_query($dbc, $query);
					
						if($response){
							echo 'User deleted successfully.';
						}
						else{
							echo 'Could not delete user. Try Again.';
							echo mysqli_error($dbc);
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
			else{ //IS A STAFF MEMBER
				if(isset($_POST['submit'])){
				
					$data_missing = array();
					if(empty($_POST['email'])){
						$data_missing[] = 'Email';
					}
					else {
					$email = trim($_POST['email']);
					}
				
					if(empty($data_missing)){
						require_once('../mysqli_connect.php');
						
						$query = "DELETE FROM User WHERE email = '".$email."'";
						
						$response = mysqli_query($dbc, $query);
					
						if($response){
							echo 'User deleted successfully.';
						}
						else{
							echo 'Could not delete user. Try Again.';
							echo mysqli_error($dbc);
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
		?>
		<p>Delete another account? <a href="http://localhost/codes/myonlinestore_2/deleteUser.php"> click</a></p> 
	</body>
</html>	