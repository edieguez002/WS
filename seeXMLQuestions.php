<?php
	$galderak= simplexml_load_file("galderak.xml");	
?>
<table border="1" bgcolor="#F3F781" align="center">
  <thead>
    <tr>
	  <th>Zailtasuna</th>
	  <th>Gaia</th>
      <th>Galdera</th>
      <th>Erantzuna</th>
      </tr>
  </thead>
  <tbody>
<?php	
	foreach($galderak->assessmentItem as $assessment){		
		echo"<tr>";
		foreach($assessment->attributes() as $attribute){
			echo "<td>".$attribute."</td>";
			//echo "Atributua ".$attribute."<br/>";
		}
			foreach($assessment->itemBody->p as $p){ 
				echo "<td>".$p."</td>";
				//echo "Galdera: ".$p."<br/>";
				foreach($assessment->correctResponse->value as $value){
					//echo "Erantzuna: ".$value."<br/>";
					echo "<td>".$value."</td>";
					echo "</tr>";
				}
			}
	}
		
	
?>
</tbody>
</table>