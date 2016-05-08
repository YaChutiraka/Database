<?php
	DEFINE('DB_USER', 'storeWebsite');
	DEFINE('DB_PASSWORD', 'yachutiraka');
	DEFINE('DB_HOST', 'localhost');
	DEFINE('DB_NAME', 'myOnlineStore_2');
	
	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
	OR die('Could not connect to MySQL: ' .
			mysqli_connect_error());
	
?>