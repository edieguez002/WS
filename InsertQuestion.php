<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert Question</title>
</head>
<body>
<h1>Gehitu galdera: </h1>
<form method="post" action="InsertQuestion.php">

Galdera:<br>
<input type="text" id="Galdera" name="Galdera"><br><br>

Erantzuna:<br>
<input type="text" id="Erantzuna" name="Erantzuna"><br><br>

Zailtasun-maila:<br>
<input type="text" id="Zailtasuna" name="Zailtasuna"><br><br>
<input type="submit" id="Gorde" name="Gorde" value="Galdera gorde"/>
<button onclick="logeatu.php">Atzera</button>
</form>

<?php

if (isset($_REQUEST['Galdera'])) {
	$Galdera = $_REQUEST['Galdera'];
	} else {
	$Galdera = "";
}

if (isset($_REQUEST['Erantzuna'])) {
	$Erantzuna = $_REQUEST['Erantzuna'];
	} else {
			$Erantzuna = "";
}

if (isset($_REQUEST['Zailtasuna'])) {
	$Zailtasuna = $_REQUEST['Zailtasuna'];
	} else {
			$Zailtasuna = "";
		
	}
	
switch(true){
	case (!$Galdera && !$Erantzuna && !$Zailtasuna):
		echo 'Eremu guztiak derrigorrezkoak dira.';
		break;
		
	case (!$Galdera && !$Erantzuna && $Zailtasuna):
		echo 'Galdera egin behar duzu, erantzuna konkretu bat izan dezan, noski.';
		break;

	case (!$Galdera && $Erantzuna && !$Zailtasuna):
		echo 'Galdera eta zailtasun-maila jarri behar dituzu.';
		break;
		
	case (!$Galdera && $Erantzuna && $Zailtasuna):
		echo 'Galdera bat egin behar duzu.';
		break;
		
	case ($Galdera && !$Erantzuna && !$Zailtasuna):
		echo 'Galderak erantzuna eta zailtasun-maila izan behar du.';
		break;
		
	case ($Galdera && !$Erantzuna && $Zailtasuna):
		echo 'Galderak erantzuna izan behar du.';
		break;
		
	case (($Galdera && $Erantzuna && $Zailtasuna) || ($Galdera && $Erantzuna && !$Zailtasuna)):
		$conn=mysql_connect("localhost", "root", "");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect_error());
		}
	
		mysql_select_db("quiz") or die(mysql_error());
		session_start();
		$ErabPosta= $_SESSION["Eposta"];
		$sententzia= "INSERT INTO Galderak (ErabPosta, Galdera, Erantzuna, ZailtasunMaila) VALUES ('$ErabPosta', '$Galdera', '$Erantzuna', '$Zailtasuna')";
		
		if (mysql_query($sententzia)) {
			echo "Datu basean ondo txertatu da!";
			
			$galderak= simplexml_load_file('galderak.xml');
			if($galderak == false){
				echo "Errorea egon da XML fitxategia kargatzerakoan:";
			}else{
					$galdera= $galderak->$assessmentItems->$assessmentItem->addChild('galdera');
					$galdera->addAttribute('complexity', $Zailtasuna);
					$galdera->addAttribute('subject', 'DEFINITUGABEA');
					$itemBody=$galdera->addChild('itemBody');
					$itemBody->addChild('p', $Galdera);
					$correctResponse=$galdera->addChild('correctResponse');
					$correctResponse->addChild('value', $Erantzuna);
					echo $galderak->asXML();
					echo "Ondo txertatu da XML fitxategian:";
			}
			
		} else {
			echo "Errorea egon da txertatzerakoan: " . mysql_error($conn);
		}

		mysql_close($conn);
			

}

?>
<br><br>
<a href="seeXMLQuestions.php">Galderak ikusi</a>
</body>
</html>