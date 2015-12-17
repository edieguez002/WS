<?php
mysql_connect("mysql.hostinger.es", "u803652676_aieko", "enetor") or die(mysql_error());

mysql_select_db("u803652676_quiz") or die(mysql_error());

$erabiltzaileak = mysql_query( "select * from erabiltzaile" );

echo '<table border=1><tr><th> IZENA </th><th> ABIZENA </th><th> EPOSTA </th><th> TELEFONOA </th><th> ESPEZIALIZAZIOA </th><th> GUSTOKO TEKNOLOGIAK </th><th> ARGAZKIA </th></tr>';

while( $row = mysql_fetch_array( $erabiltzaileak ) ) {
	echo '<tr><td>'.$row['Izena'].'</td> <td>'. $row['Abizena'].'</td> <td>'. $row['Eposta'].'</td> <td>'. $row['Telefonoa'].'</td><td>'. $row['Informatika'].'</td><td>'. $row['Teknologiak'].'</td>' ;
	$image = $row['Argazkia'];
					if(!empty($image)) {
						$enc = base64_encode($image);
						echo "<td>";
						echo '<img height="128px" width="96px" align="middle" src="data:image/;base64,' . $enc . '"/>';
						echo "</td>";
					}
					echo "</tr>";
}

echo '</table>';
echo "<br>";
echo "<br>";
echo "<input type='button' value='Hasiera' onClick='window.location=\"layout.html\"'>";?>