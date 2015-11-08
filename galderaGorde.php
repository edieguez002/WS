<?php

if (isset($_REQUEST['Galdera'])) {
	$gal = $_REQUEST['Galdera'];
	} else {
	$gal = "";
	
}

if (isset($_REQUEST['Erantzuna'])) {
	$era = $_REQUEST['Erantzuna'];
	} else {
			$era = "";
			
}

if (isset($_REQUEST['Zailtasuna'])) {
	$zai = $_REQUEST['Zailtasuna'];
	} else {
			$zai = "";
			
		
	}

	
		session_start();
		$ErabPosta= $_SESSION["Eposta"];
		$gal=$_POST['Galdera'];
		$era=$_POST ['Erantzuna'];
		$zai=$_POST ['Zailtasuna'];
	
$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect_error());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
		
	
		$sententzia= "INSERT INTO galderak (ErabPosta, Galdera, Erantzuna, ZailtasunMaila) VALUES ('$ErabPosta', '$gal', '$era', '$zai')";   
		
		if (mysql_query($sententzia)) {
			echo "Datu basean ondo txertatu da!";
			echo "<br>";
			$galderak= simplexml_load_file('galderak.xml');
			if($galderak == false){
				echo "Errorea egon da XML fitxategia kargatzerakoan:";
			}else{
					$galdera= $galderak->addChild('assessmentItem');
					$galdera->addAttribute('complexity', $zai);
					$galdera->addAttribute('subject', 'DEFINITUGABEA');
					$itemBody=$galdera->addChild('itemBody');
					$itemBody->addChild('p', $gal);
					$correctResponse=$galdera->addChild('correctResponse');
					$correctResponse->addChild('value', $era);
					$galderak->asXML('galderak.xml');
					echo "Ondo txertatu da XML fitxategian";
			}
		}else {
			echo "Errorea egon da txertatzerakoan: " . mysql_error($conn);
		}
		mysql_close($conn);


?>