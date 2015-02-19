<?php

	// controleer of er bier is gedronken en sla dat op in de database.
	if ( isset($_POST['verzenden']))
	{
		// lees het bestandje in waar de database connectie wordt gemaakt
		require_once 'include/databaseconnectie.php';		
			
		// schrijf een nieuwe rij in de tabel 
		$bewoner = $_POST['bewoner'];
		$aantal = $_POST['aantal'];
		$sql = "INSERT INTO bierverbruik (bewoner_id,datum,aantalbier) 
			VALUES ( $bewoner, NOW(), $aantal)";		
		if(!$result = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
		}
	}
?>





<?php
	// maak doctype, html, head en body (zet hier de inhoud van het bestand 'header.html' neer)
	include 'include/header.html';

	// maak een <div> met een menu (zet hier de inhoud van het bestand 'menu.html' neer)
	include 'include/menu.html';
?>
	
		<H1>Bierverbruik</h1>
	
<?php
		// lees het bestandje in waar de database connectie wordt gemaakt
		require_once 'include/databaseconnectie.php';		
				
		// lees tabel en bewaar de rijen 
		$sql = "SELECT * FROM bierverbruik, bewoners where bierverbruik.bewoner_id = bewoners.id ";
		if(!$result = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
		}
		
		// print de rijen
		while($row = $result->fetch_assoc()){
			echo $row['naam'] . ' - ';
			echo $row['datum'] . ' - ';
			echo $row['aantalbier'] . '<br />';
		}		
?>

	<!-- http://www.w3schools.com/htmL/html_forms.asp -->

	<br>
	<br>
	<br>
	
	<form action="bier.php" method="POST">
		Bierdrinker: <select name="bewoner">
						  <option value="1">Michelle</option>
						  <option value="2">Mark</option>
						  <option value="3">Evelien</option>
						</select>
		Aantal gedronken: <input type="text" name="aantal"></input>
		<input type="submit" name="verzenden"></input>
	</form>

	
	</body>
</html>