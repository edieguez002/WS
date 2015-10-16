<?php
$Izena = $_POST['Izena'];
$Abizena = $_POST['Abizena']; 
$Eposta = $_POST['Eposta'];
$Pasahitza = $_POST['Pasahitza'];
$Telefonoa = $_POST['Telefonoa'];
$Informatika = $_POST['Informatika'];
$Teknologiak = $_POST['Teknologiak'];

if(!filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/[a-zA-Z]+[0-9]{3}@ikasle(\.e)hu.es$/"))) || !filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/[a-zA-Z]+[0-9]{3}@ikasle(\.e)hu.eus$/")))){
	echo"<script language='javascript'>alert('$Eposta gaizki sartu duzu.')</script>";
	header("location: signUp.html");
}else{
	$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

	if (!$conn) {
		die("Konexio errorea egon da: " . mysql_connect_error());
	}
	
	mysql_select_db("u803652676_quiz") or die(mysql_error());
	$sql = "INSERT INTO erabiltzaile (Izena, Abizena, Eposta, Pasahitza, Telefonoa, Informatika, Teknologiak) VALUES ('$Izena', '$Abizena', '$Eposta', '$Pasahitza', '$Telefonoa', '$Informatika', '$Teknologiak')";

	if (mysql_query($sql)) {
		echo "Ondo txertatu da!";
	} else {
		echo "Errorea egon da txertatzerakoan: " . mysql_error($conn);
	}

	mysql_close($conn);
	echo "<p> <a href='ikusdatuak.php'> Erregistroak ikusi </a>";
}


?>


