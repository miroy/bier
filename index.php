<?php
	// maak doctype, html, head en body (zet hier de inhoud van het bestand 'header.html' neer)
	include 'include/header.html';

	// maak een <div> met een menu (zet hier de inhoud van het bestand 'menu.html' neer)
	include 'include/menu.html';
?>

		<H1>Studentenhuis 2</h1>

<?php
		// zie ook dit artikel: http://codular.com/php-mysqli

		// lees het bestandje in waar de database connectie wordt gemaakt
		require_once 'include/databaseconnectie.php';

		// lees tabel en bewaar de rijen
		$sql = "SELECT * FROM `bewoners` ";
		if(!$result = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
		}

		// print de rijen
		while($row = $result->fetch_assoc()){
			echo $row['id'] . ': ';
			echo $row['naam'] . '<br />';
		}
?>

	</body>
</html>
