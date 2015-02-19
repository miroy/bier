<?php
	// als een bewoner via 'eters.php' invult dat hij mee eet en op de
	// knop klikt, dan moet dat worden opgeslagen in de database.
	// als hij 'nee' aanklikt, moet dat ook worden opgeslagen.
	
	// is het formulier opgestuurd?
	if ( isset($_POST['verzenden']))
	{
		// lees het bestandje in waar de database connectie wordt gemaakt
		require 'include/databaseconnectie.inc.php';	
		
		// is er al een rij aanwezig? dan moet de bestaande rij worden bijgewerkt. is er nog geen rij? dan moet die rij worden gemaakt.
		$ingevulde_datum = "";
		$ingevulde_bewoner_id = "";
		
		$sql = "
		select eters.id, bewoners.naam, eters.datum, eters.eetmee 			
		from eters, bewoners
		where eters.bewoner_id = bewoners.id 
		and datum=date(now())";
		if(!$result = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	}
	
	
?>





<!doctype html>

<html>
	<head>
		<title>Studentenhuis</title>
	</head>

	<body>
		<div class="menu">
			Menu<br/>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="bier.php">Bier</a></li>
			</ul>
		</div>
	
	
		<H1>Wie eet er mee?</h1>
	
<?php
		// lees het bestandje in waar de database connectie wordt gemaakt
		require 'include/databaseconnectie.inc.php';	
		
		// lees de rijen uit tabel 'eters' en bewaar de rijen 
		$sql = "SELECT * FROM eters, bewoners where eters.bewoner_id = bewoners.id ";
		if(!$result = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
		}
		
		// print de opgehaalde rijen
		while($row = $result->fetch_assoc()){
			echo $row['datum'] . ' - ';
			echo $row['naam'] . '<br />';
		}		
?>

	<!-- http://www.w3schools.com/htmL/html_forms.asp -->

	<br>
	<br>
	<br>
	
	<form action="bier.php" method="POST">
		Mee-eter: <select name="bewoner">
						  <option value="1">Michelle</option>
						  <option value="2">Mark</option>
						  <option value="3">Evelien</option>
						</select>
						
		<br>Eet je mee? 
		<br>
		<input type="radio" name="eetmee" value="ja"> ja<br>	
		<input type="radio" name="eetmee" value="nee"> nee<br>
		
		<input type="submit" name="verzenden"></input>
	</form>

	
	</body>
</html>