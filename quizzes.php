<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Quizzes</title>
</head>
<body>
<h1 align="center">Galderak: </h1>


<?php
$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect_error());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
		$emaitza= mysql_query("SELECT * FROM galderak"); 
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
<br>
<center>
<button type="button" id="Atzera" onClick="history.back()" align="center">Atzera</button>
</center>
</body>
</html>
