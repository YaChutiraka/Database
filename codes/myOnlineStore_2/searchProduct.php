<?php
	require_once('../mysqli_connect.php');
	$searchKey = $_POST['searchKey'];
	echo '<b>Search Key is: </b>'. $searchKey . '<br/><br />';
	$query = "SELECT id, name, price, description, stock_quantity FROM Product WHERE name LIKE '%" . $searchKey . "%' OR description LIKE '%" . $searchKey . "%' ORDER BY price";
	//$query = "SELECT id, name, price, description, stock_quantity FROM Product WHERE (name LIKE '%shampoo%' OR description LIKE '%shampoo%') AND active = 'Y' AND stock_quantity > 0";
	
	$response = @mysqli_query($dbc, $query);
	if($response){
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
			$row['description'] . '</td><td align="left">';
			
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