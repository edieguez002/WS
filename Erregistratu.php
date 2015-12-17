<?php
include "zifratudeszifratu.php";

$Izena = $_POST['Izena'];
$Abizena = $_POST['Abizena']; 
$Eposta = $_POST['Eposta'];
$Password = $_POST['Pasahitza1'];
$Telefonoa = $_POST['Telefonoa'];
$Informatika = $_POST['Informatika'];
$Teknologiak = $_POST['Teknologiak'];
//Pasahitza zifratu
/*$key_size = mcrypt_get_key_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CFB);
$encryption_key = openssl_random_pseudo_bytes($key_size, $strong);

$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CFB);
$iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);

$enc_Password= mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $encryption_key,$Password, MCRYPT_MODE_CFB, $iv);*/
$enc_Password=zifratu($Password, "enetoraikeketredfgtbwasr");


if(!filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/[a-zA-Z]+[0-9]{3}@ikasle(\.e)hu.es/"))) && !filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/[a-zA-Z]+[0-9]{3}@ikasle(\.e)hu.eus/")))){
	
	echo"<script language='javascript'>alert('$Eposta gaizki sartu duzu.')</script>";
	
}else{
	$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

	if (!$conn) {
		die("Konexio errorea egon da: " . mysql_error());
	}
	
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["Argazkia"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$fileName = $_FILES['Argazkia']['name'];
	$tmpName = $_FILES['Argazkia']['tmp_name'];
	$fileSize = $_FILES['Argazkia']['size'];
	$fileType = $_FILES['Argazkia']['type'];
	if(isset($_POST["submit"])) {
		$check = false;
		if(!empty($_FILES['Argazkia']['name'])) {
			$fp = fopen($tmpName, 'r');
			$edukia = fread($fp, filesize($tmpName));
			$edukia = addslashes($edukia);
			fclose($fp);
			$check = getimagesize($_FILES["Argazkia"]["tmp_name"]);
		}
	}
	if($check !== false) {
			echo "Igotako argazkia - " . $check["mime"] . ".";
			$uploadOk = 1;
			$sql="INSERT INTO Erabiltzaile(Izena, Abizena, Eposta, Pasahitza, Telefonoa, Informatika, Teknologiak, Argazkia) VALUES ('$Izena', '$Abizena', '$Eposta', '$enc_Password', '$Telefonoa', '$Informatika', '$Teknologiak', '$edukia')";
		} else {
			echo "Ez da argazkirik igo.<br>";
			$uploadOk = 0;
			$sql="INSERT INTO Erabiltzaile(Izena, Abizena, Eposta, Pasahitza, Telefonoa, Informatika, Teknologiak) VALUES ('$Izena', '$Abizena', '$Eposta', '$enc_Password', '$Telefonoa', '$Informatika', '$Teknologiak')";
		}
	mysql_select_db("u803652676_quiz") or die(mysql_error());
	
	//$sql = "INSERT INTO erabiltzaile (Izena, Abizena, Eposta, Pasahitza, Telefonoa, Informatika, Teknologiak, Argazkia) VALUES ('$Izena', '$Abizena', '$Eposta', '$Pasahitza', '$Telefonoa', '$Informatika', '$Teknologiak', '$Argazkia')";

	if (mysql_query($sql)) {
		echo "Ondo txertatu da!";
	} else {
		echo "Errorea egon da txertatzerakoan: " . mysql_error($conn);
	}

	mysql_close($conn);
	echo "<p> <a href='ikusdatuak.php'> Erregistroak ikusi </a>";
}
echo "<br>";
echo "<br>";
echo "<input type='button' value='Hasiera' onClick='window.location=\"layout.html\"'>";
?>


