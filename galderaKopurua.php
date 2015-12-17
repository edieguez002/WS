<?php


 $conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
		session_start();
		$Eposta=$_SESSION["Eposta"];
		
		$emaitza1= mysql_query("SELECT COUNT(GZbkia) AS danak FROM galderak");
		$emaitza2= mysql_query("SELECT COUNT(GZbkia) AS gureak FROM galderak WHERE ErabPosta='$Eposta'");
		
		echo "Galdera guztiak:";
		$data=mysql_fetch_assoc($emaitza1);
		echo $data['danak'];
		echo"<br>";
		echo "Sartutako galderak:";
		$data2=mysql_fetch_assoc($emaitza2);
		echo $data2['gureak'];
		
		mysql_close();
		
		
		echo "<br>";
		//echo ("<input type='button' value='Atzera' onClick='window.location = \"layoutStudent.html\";'/>")
		echo ("<a href='layoutStudent.html'>Gorde</a>");

?>