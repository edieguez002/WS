<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<script type="text/javascript">
function hasieraraBueltatu(){
	window.location="layout.html";
}

</script>
</head>
<body>
<h1> Identifikatu</h1>
<form id="login" name="login"  method="post" onSubmit="aukeratuBidea()" action="logeatu.php">

Eposta:<br>
<input type="text" id="Eposta" name="Eposta"><br><br>

Pasahitza:<br>
<input type="password" id="Pasahitza" name="Pasahitza"><br><br>

<input type="submit" id="submit" name="logeatu" value="Logeatu"/>
<button type="button" id="hasiera" name="hasiera" onClick="hasieraraBueltatu()">Hasiera</button>
</form>
<?php

if (isset($_REQUEST['Eposta'])) {
	$Eposta = $_REQUEST['Eposta'];
	} else {
	$Eposta = "";
}

if (isset($_REQUEST['Pasahitza'])) {
	$Pasahitza = $_REQUEST['Pasahitza'];
	} else {
			$Pasahitza = "";
}

$regexp1="/[a-zA-Z]+[0-9]{3}@ikasle(\.e)hu.es/";
$regexp2="/[a-zA-Z]+[0-9]{3}@ikasle(\.e)hu.eus/";
$regexp3="/[a-zA-Z]+[0-9]{3}@ehu(\.e)s/";

if(!$Eposta || !$Pasahitza){
	echo 'Eposta eta pasahitza sartu behar dituzu.';
}
else{
	if(!filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regexp1))) && !filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regexp2))) && !filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regexp3)))){
		echo"<script language='javascript'>alert('$Eposta gaizki sartu duzu.')</script>";
	}else{
		$conn=mysql_connect("localhost", "root", "");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect_error());
		}
	
		mysql_select_db("quiz") or die(mysql_error());
		$emaitza= mysql_query("SELECT * FROM erabiltzaile");
	
			for($i=0; $i<mysql_num_rows($emaitza); $i++){
				$row= mysql_fetch_assoc($emaitza);
				
				if(($row['Eposta']==$Eposta) && ($row['Pasahitza']!=$Pasahitza)){
					echo 'Pasahitza okerra.';
					break;

				}
				if(($row['Eposta']==$Eposta) && ($row['Pasahitza']==$Pasahitza)){
					mysql_close($conn);
					session_start();
					$_SESSION["Eposta"]= $Eposta;
					echo "Erabiltzaile egokia!";
					echo "<br><br>";
					if(filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regexp3)))){
						echo "<p> <a href='adminQuestions.php'> Galderen kudeaketa </a>";
						break;
					}
					echo "<p> <a href='handlingQuizzes.php'> Galdetegi Berria </a>";
					break;
				}
			}
			if($i==mysql_num_rows($emaitza)){
				echo 'Ez dago horrelako erabiltzailerik. ';
				die('Ezin izan da informaziorik lortu. ' . mysql_error());
				mysql_close($conn);
			}
			
		}
		
	}
	
	
?>

</body>
</html>