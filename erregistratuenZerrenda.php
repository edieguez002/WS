<?php

$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect_error());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
		
		$emaitza= mysql_query("SELECT * FROM erabiltzaile"); 
		echo "<table border=\"1\" bgcolor=\"#F3F781\" align=\"center\" >";
		echo "<tr>";  
		echo "<th>Izena</th>";  
		echo "<th>Abizena</th>";  
		echo "<th>Eposta</th>"; 
		echo "</tr>";  
		while ($row = mysql_fetch_assoc($emaitza)){   
			echo "<tr>";
			echo "<td>".$row["Izena"]."</td>";  
			echo "<td>".$row["Abizena"]."</td>"; 
			echo "<td>".$row["Eposta"]."</td>";			
			echo "</tr>";  
		}  
		 
		echo "</table>";
		mysql_close($conn);

		echo ("<input type='button' value='Atzera' onClick='window.location = \"layoutTeacher.html\";'/>")
	
?>