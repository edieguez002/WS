<?php

if (isset($_POST['galderak'])){
	$galdera=$_POST['galderak'];
}else{
	$galdera="";
}

if (isset($_POST['erantzuna'])){
	$erantzuna=$_POST['erantzuna'];
}else{
	$erantzuna="";
}

 $conn=mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor");

		if (!$conn) {
			die("Konexio errorea egon da: " . mysql_connect());
		}else{
	
			$erantzunZuzena=false;
			mysql_select_db("u803652676_quiz") or die(mysql_error());
			$emaitza= mysql_query("SELECT * FROM galderak");
		
				for($i=0; $i<mysql_num_rows($emaitza); $i++){
					$row= mysql_fetch_assoc($emaitza);
					if(($row['Galdera']==$galdera) && ($row['Erantzuna']==$erantzuna)){
						$erantzunZuzena=true;
						break;
					}
				}
				
			session_start();
			if(isset($_SESSION["Nick"])){
				if ($erantzunZuzena==false){
					$Okerrak=$_SESSION["Okerrak"];
					$Okerrak=$Okerrak+1;
					$_SESSION["Okerrak"]=$Okerrak;
					echo "Erantzun okerra!";
				}else{
					$Zuzenak=$_SESSION["Zuzenak"];
					$Zuzenak=$Zuzenak+1;
					$_SESSION["Zuzenak"]=$Zuzenak;
					echo "Erantzun zuzena! Zorionak!";
				}
			}else{
				if ($erantzunZuzena==false){
					echo "Erantzun okerra!";
				}else{
					echo "Erantzun zuzena! Zorionak!";
				}
			}
				
			mysql_close();
		}

	echo "<br>";
	echo "<a href='AnswerQuestions.php'>Atzera<a>";
?>