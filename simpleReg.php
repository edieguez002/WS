<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Erregistratu</title>

<script type="text/javascript">
function bidaliEposta(){
	XMLHttpRequestObject = new XMLHttpRequest();
	
	XMLHttpRequestObject.onreadystatechange=function(){
	if (XMLHttpRequestObject.readyState==4){	 
		document.getElementById("epostaErantzuna").innerHTML= XMLHttpRequestObject.responseText;
	}
}

	var email= document.getElementById("Eposta").value;
	XMLHttpRequestObject.open("POST", "egiaztatuMatrikulaAJAX.php", true);
	XMLHttpRequestObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	XMLHttpRequestObject.send("&Eposta="+email);
}
</script>

<script type="text/javascript">
function bidaliPasahitza(){
	XMLHttpRequestObject = new XMLHttpRequest();
	
	XMLHttpRequestObject.onreadystatechange=function(){
	if (XMLHttpRequestObject.readyState==4){	 
		document.getElementById("pasahitzaErantzuna").innerHTML= XMLHttpRequestObject.responseText;
	}
}

	var pasahitza= document.getElementById("Pasahitza").value;
	var pasahitza2= document.getElementById("Pasahitza2").value;
	XMLHttpRequestObject.open("POST", "egiaztatuPasAJAX.php", true);
	XMLHttpRequestObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	XMLHttpRequestObject.send("&Pasahitza="+pasahitza+"&Pasahitza2="+pasahitza2);
}
</script>

<script type="text/javascript">
function atzera(){
	window.location="logeatu.php";
}
</script>
</head>
<form id="erregistro" name="erregistro" action="pasahitzaBerreskuratu.php" method="post">

Eposta(*):<br>
<input type="text" id="Eposta" name="Eposta" onchange="bidaliEposta()">
<br><br>

Pasahitza(*):<br>
<input type="password" id="Pasahitza" name="Pasahitza">
<br><br>

Berridatzi Pasahitza(*):<br>
<input type="password" id="Pasahitza2" name="Pasahitza2" onchange="bidaliPasahitza()">
<br><br>

<input type="submit" id="submit" value="submit"/>
<button onclick="atzera()">Atzera</button>
</form>
<div id="epostaErantzuna">
<p> </p>
</div>
<br>
<div id="pasahitzaErantzuna">
<p> </p>
</div>
</html>

<?php
if (isset($_REQUEST['Eposta'])) {
	$Eposta = $_REQUEST['Eposta'];
	} else {
	$Eposta = "";
}

if (isset($_REQUEST['Pasahitza1'])) {
	$Pasahitza1 = $_REQUEST['Pasahitza1'];
	} else {
			$Pasahitza1 = "";
}

if (isset($_REQUEST['Pasahitza2'])) {
	$Pasahitza2 = $_REQUEST['Pasahitza2'];
	} else {
			$Pasahitza2 = "";
}

if(!$Eposta || !$Pasahitza1 || !$Pasahitza2){
	echo 'Sar ezazu zure eposta eta pasahitza berria.';
}


$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
		$emaitza= mysql_query("SELECT * FROM erabiltzaile");
	
			for($i=0; $i<mysql_num_rows($emaitza); $i++){
				$row= mysql_fetch_assoc($emaitza);
				
				if(strcmp($Pasahitza1, $Pasahitza2)!=0){
					echo "Pasahitzak ez dute koinziditzen..";
				}else if(($row['Eposta']==$Eposta) && (strcmp($Pasahitza1, $Pasahitza2)==0)){
					$PasahitzaBerria= md5($Pasahitza2);
					$eguneratu= mysql_query("UPDATE erabiltzaile SET Pasahitza='$PasahitzaBerria' WHERE Eposta='$Eposta'");
					echo 'Zure pasahitza eguneratu da!';
					break;

				}
				if(($row['Eposta']==$Eposta) && ($row['Pasahitza']==$Pasahitza)){
					mysql_close($conn);
					session_start();
					$_SESSION["Eposta"]= $Eposta;
					echo "Erabiltzaile egokia!";
					echo "<br><br>";
					if(filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regexp3)))){
						header('Location: layoutTeacher.html');
						break;
					}
					header('Location: layoutStudent.html');
					break;
				}
			}
			if($i==mysql_num_rows($emaitza)){
				echo 'Ez dago horrelako erabiltzailerik. ';
				die('Ezin izan da informaziorik lortu. ' . mysql_error());
				mysql_close($conn);
			}
			
		
