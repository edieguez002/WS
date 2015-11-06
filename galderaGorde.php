<?php

if (isset($_REQUEST['Galdera'])) {
	$gal = $_REQUEST['Galdera'];
	} else {
	$Galdera = "";
}

if (isset($_REQUEST['Erantzuna'])) {
	$era = $_REQUEST['Erantzuna'];
	} else {
			$Erantzuna = "";
}

if (isset($_REQUEST['Zailtasuna'])) {
	$zai = $_REQUEST['Zailtasuna'];
	} else {
			$Zailtasuna = "";
		
	}
	
$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect_error());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
		session_start();
		$ErabPosta= $_SESSION["Eposta"];
		$gal= $_POST['Galdera'];
		$era= $_POST['Erantzuna'];
		$zai= $_POST['Zailtasuna'];
		$sententzia= "INSERT INTO galderak (ErabPosta, Galdera, Erantzuna, ZailtasunMaila) VALUES ('$ErabPosta', '$gal', '$era', '$zai')";   
		
		if (mysql_query($sententzia)) {
			echo "Datu basean ondo txertatu da!";
		}else {
			echo "Errorea egon da txertatzerakoan: " . mysql_error($conn);
		}
		mysql_close($conn);


?>