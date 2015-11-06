<?php

$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect_error());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
		session_start();
		$ErabPosta= $_SESSION["Eposta"];
		$emaitza= mysql_query("SELECT * FROM galderak WHERE ErabPosta='$ErabPosta'"); 
		echo "<table border=\"1\" bgcolor=\"#F3F781\" align=\"center\" >";
		echo "<tr>";  
		echo "<th>Galderak</th>";  
		echo "<th>Zailtasun-maila</th>";    
		echo "</tr>";  
		while ($row = mysql_fetch_assoc($emaitza)){   
			echo "<tr>";
			echo "<td>".$row["Galdera"]."</td>";  
			echo "<td>".$row["ZailtasunMaila"]."</td>";  
			echo "</tr>";  
		}  
		 
		echo "</table>";
		mysql_close($conn);


?>