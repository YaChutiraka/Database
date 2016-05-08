<?php
	require_once('../mysqli_connect.php');
	session_start();
	$query = "SELECT * FROM Product";
	$is_staff = $_SESSION['is_staff'];
	$response = @mysqli_query($dbc, $query);
	# This is for customer's view
	if($response){
		if($is_staff=='N'){
			echo '<table align="left"
			cellspacing="5" cellpadding="8">
			<tr>
				<td align="left"><b>ID</b></td>
				<td align="left"><b>Name</b></td>
				<td align="left"><b>Price ($)</b></td>
				<td align="left"><b>Description</b></td>
			</tr>';	
			
			while($row = mysqli_fetch_array($response)){
				echo '<tr><td align ="left">' .
				$row['id'] . '</td><td align="left">' .
				$row['name'] . '</td><td align="left">' .
				$row['price'] . '</td><td align="left">' .
				$row['description'] . '</td><td align="left"></td>';
				
				echo '</tr>';
			}
			
			echo '</table>';
		}
	
		else if($is_staff=='Y'){
			echo '<table align="left"
			cellspacing="5" cellpadding="8">
			<tr>
				<td align="left"><b>ID</b></td>
				<td align="left"><b>Name</b></td>
				<td align="left"><b>Price ($)</b></td>
				<td align="left"><b>Stock Quantity</b></td>
				<td align="left"><b>Description</b></td>
				<td align="left"><b>Active</b></td>
			</tr>';	
			
			while($row = mysqli_fetch_array($response)){
				echo '<tr><td align ="left">' .
				$row['id'] . '</td><td align="left">' .
				$row['name'] . '</td><td align="left">' .
				$row['price'] . '</td><td align="left">' .
				$row['stock_quantity'] . '</td><td align="left">' .
				$row['description'] . '</td><td align="left">' .
				$row['active'] . '</td><td align="left"></td>';
				
				echo '</tr>';
			}	
		}
		else{ // Have not logged in yet
			$is_staff = '';
			echo '<table align="left"
			cellspacing="5" cellpadding="8">
			<tr>
				<td align="left"><b>ID</b></td>
				<td align="left"><b>Name</b></td>
				<td align="left"><b>Price ($)</b></td>
				<td align="left"><b>Description</b></td>
			</tr>';	
			
			while($row = mysqli_fetch_array($response)){
				echo '<tr><td align ="left">' .
				$row['id'] . '</td><td align="left">' .
				$row['name'] . '</td><td align="left">' .
				$row['price'] . '</td><td align="left">' .
				$row['description'] . '</td><td align="left"></td>';
				
				echo '</tr>';
			}
			
			echo '</table>';
			
		}
	}	
	else {
		echo "Couldn't issue database query<br />";
		echo mysqli_error($dbc);
	}
	
	mysqli_close($dbc);
?>