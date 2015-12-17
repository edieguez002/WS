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
<form id="login" name="login"  method="post" action="logeatu.php">

Zure kontuarekin:<br><br>

Eposta:<br>
<input type="text" id="Eposta" name="Eposta" oninput="login.Nick.disabled=true"><br><br>

Pasahitza:<br>
<input type="password" id="Pasahitza" name="Pasahitza" oninput="login.Nick.disabled=true"><br><br>

Nick-ren bidez:<br><br>

Nick-a:<br>
<input type="text" id="Nick" name="Nick" oninput="login.Eposta.disabled=true;login.Pasahitza.disabled=true"><br><br>

<input type="submit" id="submit" name="logeatu" value="Logeatu"/>
<button type="button" id="hasiera" name="hasiera" onClick="hasieraraBueltatu()">Hasiera</button>
<br><br>
</form>

<?php

include "zifratudeszifratu.php";
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

if (isset($_REQUEST['Nick'])) {
	$Nick = $_REQUEST['Nick'];
	} else {
			$Nick = "";
}

$regexp1="/[a-zA-Z]+[0-9]{3}@ikasle(\.e)hu.es/";
$regexp2="/[a-zA-Z]+[0-9]{3}@ikasle(\.e)hu.eus/";
$regexp3="/[a-zA-Z]+[0-9]{3}@ehu(\.e)s/";

if(!$Nick &&(!$Eposta || !$Pasahitza)){
	echo 'Eposta eta pasahitza sartu behar dituzu.';
}
else if(!$Nick){
	if(!filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regexp1))) && !filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regexp2))) && !filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regexp3)))){
		echo"<script language='javascript'>alert('$Eposta gaizki sartu duzu.')</script>";
	}else{
		$conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect());
		}
	
		mysql_select_db("u803652676_quiz") or die(mysql_error());
		$emaitza= mysql_query("SELECT * FROM erabiltzaile");
		
			for($i=0; $i<mysql_num_rows($emaitza); $i++){
				$row= mysql_fetch_assoc($emaitza);
				
				$deszifratuta= deszifratu($row['Pasahitza'], "enetoraikeketredfgtbwasr");

				if(($row['Eposta']==$Eposta) && ($row['Pasahitza']==$Pasahitza) && filter_var($Eposta, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>$regexp3)))){
						session_start();
						$_SESSION['Eposta']= $Eposta;
						echo "Erabiltzaile egokia!";
						echo "<br><br>";
						mysql_close($conn);
						header('Location: layoutTeacher.html');
						break;
					}
				if(($row['Eposta']==$Eposta) && ($deszifratuta!=$Pasahitza)){
					session_start();
					if (isset($_SESSION['kontagailua'])) 
{
$_SESSION['kontagailua']=$_SESSION['kontagailua']+1; 
$int = $_SESSION['kontagailua'];
if ($int <= 3) 
{
header ("Location: logeatu.php");
echo $deszifratuta; 
exit;
}
if ($int > 3) 
{
	session_destroy();
header ("Location: layout.html"); 
exit;
}
}
else 
{
$_SESSION['kontagailua'] = 1;
$int = $_SESSION['contador'];
header ("Location: logeatu.php");
exit;
}
					
					break;
				}
				if(($row['Eposta']==$Eposta) && ($deszifratuta==$Pasahitza)){
					session_start();
					$_SESSION["Eposta"]= $Eposta;
					echo "Erabiltzaile egokia!";
					echo "<br><br>";
					mysql_close($conn);
					header('Location: layoutStudent.html');
					break;
				}
			}
			if($i==mysql_num_rows($emaitza)){
				echo 'Ez dago horrelako erabiltzailerik. ';
				die('Ezin izan da informaziorik lortu. ' . mysql_error());
				mysql_close($conn);
			}
			
		}
		
	}else if ($Nick){
		session_start();
		$_SESSION["Nick"]= $Nick;
		$_SESSION["Zuzenak"]=0;
		$_SESSION["Okerrak"]=0;
		header('Location: layoutAnonymous.html');
	}
	

	
	
?>

<br>
<a href="pasahitzaBerreskuratu.php">Password recovery</a>
</body>
</html>