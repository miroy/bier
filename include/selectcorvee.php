<?php
		// deze include file heeft als functie:
		// - verbinding maken met database (als dit nog niet is gebeurd)
		// - select uitvoeren op tabel corvee
		// - resultaat bewaren in $result
		// - foutmelding geven (via echo) als iets is misgegaan

		// maak een verbinding naar de database en bewaar die in variabele $db
		require_once 'include/databaseconnectie.php';	
		
		// lees de tabel, haal ook namen op voor de klus, de corveeer, en de controleur  
		$sql = "SELECT 
					corvee.id, 
					klussen.klusnaam, 
					corvee_bewoner.naam as wie_doet_de_klus, 
					controleur_bewoner.naam as wie_controleert_er,
					corvee.gecontroleerd_datum
				FROM 
					corvee, 
					bewoners corvee_bewoner, 
					bewoners controleur_bewoner, 
					klussen
				WHERE 
					corvee.corvee_bewoner_id = corvee_bewoner.id
					AND corvee.controleur_bewoner_id = controleur_bewoner.id
					AND corvee.klus_id = klussen.id";
		
		// voer de query uit
		$result = $db->query($sql);		
		
		// als er iets fout ging met de query, dan heeft $result de waarde false. Geef dan een foutmelding weer.
		if( $result == false ){
			die('There was an error running the query [' . $db->error . ']');
		}