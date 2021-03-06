<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Galderen kudeaketa</title>

<!--galderaren eguneraketa AJAX eta javascript erabilita.-->
<script type="text/javascript">
function galderaEditatu(){
	XMLHttpRequestObject = new XMLHttpRequest();
	
	XMLHttpRequestObject.onreadystatechange=function(){
	if (XMLHttpRequestObject.readyState==4){	 
		document.getElementById("result").innerHTML= XMLHttpRequestObject.responseText;
	}
}

	var galderaID= document.getElementById("select").value;
	var galderaBerria= document.getElementById("galdera").value;
	var erantzunBerria= document.getElementById("erantzuna").value;
	var zailtasunBerria= document.getElementById("zailtasuna").value;
	XMLHttpRequestObject.open("POST", "galderaEditatu.php", false);
	XMLHttpRequestObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	XMLHttpRequestObject.send("&select="+mota+"&galdera"+galderaID+"&erantzuna="+erantzunBerria+"&zailtasuna="+zailtasunBerria);
}
</script>

<!--galderaren eguneraketa AJAX eta jQuery erabilita.-->
<script type="text/javascript">
function galderaEditatu(f){
		$(document).ready(function(){
		
	$.ajax({
		
		type: "POST",
		url:"galderaEditatu.php",
		data: "select="+f.selectah.value+"&galdera="+f.galdera.value+"&erantzuna="+f.erantzuna.value+"&zailtasuna="+f.zailtasuna.value,
		beforeSend: function() { $('#result').html('<div></div>')},
		success: function(datuak){$('#result').fadeIn().html(datuak);}
	});
	});
}
</script>

<script type="text/javascript">
function back(){
	window.location="layoutTeacher.html";
}

</script>
</head>
<body>
<?php

$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
		session_start();
		$ErabPosta= $_SESSION["Eposta"];
		$emaitza= mysql_query("SELECT * FROM galderak"); 
		
		//Galderak erakusten dituen taula sortzen da eta betetzen da DBko datuekin.
		echo "<table border=\"1\" bgcolor=\"#F3F781\" align=\"center\" >";
		echo "<tr>";  
		echo "<th>Galderak</th>";  
		echo "<th>Zailtasun-maila</th>";
		echo "<th>Erantzuna</th>";
		echo "<th>Egilea</th>";
		echo "</tr>";  
		while ($row = mysql_fetch_assoc($emaitza)){   
			echo "<tr>";
			echo "<td>".$row["Galdera"]."</td>";  
			echo "<td>".$row["ZailtasunMaila"]."</td>";
			echo "<td>".$row["Erantzuna"]."</td>";
			echo "<td>".$row["ErabPosta"]."</td>";
			echo "</tr>";  
		}  
		 
		echo "</table>";
		
		//Formularioa sortzen da irakasleak nahi duen galderaren atributu bat(zu)en balioa aldatzeko.
		echo "<br><br>";
		echo "<center>";
?>
		<form action="galderaEditatu.php" method="post">
<?php
		echo "Zein galdera aldatu nahi duzu?";
		echo "<br><br>";
		echo "<select id=\"selectah\" name=\"selectah\">";
		
		$emaitza1= mysql_query("SELECT * FROM galderak");
		while ($row = mysql_fetch_assoc($emaitza1)){
			echo '<option value="'.htmlspecialchars($row['Galdera']).'">'.htmlspecialchars($row['Galdera']).'</option>';
		}
?>
		</select>
		<br><br>
		**********BALIO BERRIAK**********
		<br><br>
		Galdera: 
		<input type="text" id="galdera" name="galdera"/>
		<br>
		Erantzuna:
		<input type="text" id="erantzuna" name="erantzuna"/>
		<br>
		
		Zailtasuna: 
		<input type="text" id="zailtasuna" name="zailtasuna"/>
		<br><br>
		<input type="submit" id="gorde" value="Gorde" onclick="galderaEditatu(this.form)"/>
		<input type="button" id="atzera" value="Atzera" onclick="back()"/>
	</form>

<div id="result">
	<p></p>
</div>
<?php
		echo "</center>";
		mysql_close($conn);

?>
</body>
</html>