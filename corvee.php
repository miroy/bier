<?php
	// aanroep: http://localhost/corvee.php?klus_gecontroleerd_id=7
	// is er een klus gecontroleerd? dan moet er een ?klus_gecontroleerd=? zijn meegegeven in de URL.
	if ( isset ( $_GET['klus_gecontroleerd_id'] ) )
	{
		// maak database verbinding
		require_once 'include/databaseconnectie.php';	
		
		// selecteer de rij uit tabel 'corvee' waarvan het id overeenkomt met $_GET['klus_gecontroleerd_id'] 
		// opmerking: onderstaande code is lastig, ik zal later prepared statements uitleggen.
		$sql = "SELECT * from corvee where id=?";
		$stmt = $db->prepare($sql);
		$stmt->bind_param('i',$_GET['klus_gecontroleerd_id']);
		if ( ! $stmt->execute() ) {
			die('There was an error executing the query [' . $db->error . ']');
		}
		$result = $stmt->get_result();
		$exist = $result->num_rows;
		if ($exist == 0) {
			// geen rij gevonden; klus bestaat niet.
			echo 'klus bestaat niet';
		}
		else
		{
			// de klus is gevonden. wijzig de datum van controle naar vandaag
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$sql = "UPDATE corvee SET gecontroleerd_datum = NOW() WHERE id = ?";
			$stmt = $db->prepare($sql);
			$stmt->bind_param('i',$_GET['klus_gecontroleerd_id']);
			if( ! $stmt->execute() ){
				die('There was an error running the query [' . $db->error . ']');
			}
		}

	}
	
	// aanroep: http://localhost/corvee.php?klus_reset=1
	if ( isset ( $_GET['klus_reset'] ) )
	{
		require_once 'include/databaseconnectie.php';	

		// haal de bewoners id's op en stop ze in de array $bewoners_ids		
		$sql = "SELECT id FROM bewoners;";
		if(!$result = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$bewoners_ids[] = $row['id'];
		}
		
		// haal de corvee id's op en stop ze in de array $corvee_ids
		require_once 'include/databaseconnectie.php';		
		$sql = "SELECT id FROM corvee;";
		if(!$result = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$corvee_ids[] = $row['id'];
		}		
		
		// schud de id's door elkaar
		shuffle($bewoners_ids);
		
		// geef elke klus een nieuwe bewonerid
		foreach($corvee_ids as $corveeid)
		{
			$new_corveeer_id = array_shift($bewoners_ids);
			$sql = "UPDATE corvee SET corvee_bewoner_id = ?, gecontroleerd_datum = '0000-00-00' WHERE id = ?";
			$stmt = $db->prepare($sql);
			$stmt->bind_param('ii', $new_corveeer_id, $corveeid);
			if( ! $stmt->execute() ){
				die('There was an error running the query [' . $db->error . ']');
			}		
		}
	}
	

	// maak doctype, html, head en body (zet hier de inhoud van het bestand 'header.html' neer)
	include 'include/header.html';

	// maak een <div> met een menu (zet hier de inhoud van het bestand 'menu.html' neer)
	include 'include/menu.html';
?>
	
	
	<H1>Corvee</h1>
	
<?php
		// maak database connectie en haal alle corvee rijen op, bewaar de rijen in $result
		require 'include/selectcorvee.php';
		
		// start een tabel met dikgedrukte kop
		echo '<table>';
		echo '<tr>
				<th>Klus</th>
				<th>Klus</th>
				<th>Wie doet de klus? </th>
				<th>Wie controleert er? </th>
				<th>Actie</th>
			</tr>';

		// print de rijen
		while($row = $result->fetch_assoc()){
			
			echo '<tr>';
			echo '<td>' . $row['id'] . '</td>';
			echo '<td>' . $row['klusnaam'] . '</td>';
			echo '<td>' . $row['wie_doet_de_klus'] . '</td>';
			echo '<td>' . $row['wie_controleert_er'] . '</td>';
			echo '<td>' ;
				// toon "gecontroleerd" linkje alleen als de datum van controle leeg is
				if ( $row['gecontroleerd_datum'] == "0000-00-00" )
				echo '<a href="?klus_gecontroleerd_id=' . $row['id'] . '">Gecontroleerd</a>'; 
			echo '</td>';
			echo '</tr>';	
		}		
		
		// sluit de tabel
		echo '</table>';
		
		// maak "reset" linkje
		echo '<a href="?klus_reset=1">Opnieuw vullen</a>';
?>
	
	</body>
</html>