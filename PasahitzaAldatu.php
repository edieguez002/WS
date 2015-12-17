<?php
include "zifratudeszifratu.php";
$Izena = $_POST['Izena'];
$Abizena = $_POST['Abizena']; 
$Eposta = $_POST['Eposta'];
$Pasahitza = $_POST['Pasahitza1'];

$pasahitzaZif= zifratu($Pasahitza, "enetoraikeketredfgtbwasr");

$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect_error());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
		$emaitza= mysql_query("SELECT * FROM erabiltzaile"); 
		     
		while ($row = mysql_fetch_assoc($emaitza)){   
			if($row["Eposta"]==$Eposta){
				if($row["Abizena"]==$Abizena && $row["Izena"]==$Izena){
					
			$sql = mysql_query("UPDATE erabiltzaile SET Pasahitza='$pasahitzaZif' WHERE Eposta='$Eposta'") or die(mysql_error());
						
					echo "Pasahitza ondo aldatu da";
					echo "<script>window.location='logeatu.php';</script>";
					
				}else{
					echo "datuak ez dira zuzenak";
				}
			}
		}  
		 
		mysql_close($conn);
?>