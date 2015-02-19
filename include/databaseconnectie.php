<?php
	// zie ook dit artikel: http://codular.com/php-mysqli

	// maak verbinding met database via mysqli
	$db = new mysqli('localhost', 'bier', 'bier', 'bier');
	if($db->connect_errno > 0){
		die('Unable to connect to database [' . $db->connect_error . ']');
	}	
?>