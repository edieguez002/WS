<?php
mysql_connect("mysql.hostinger.es","u803652676_aieko", "enetor") or die(mysql_error());

mysql_select_db("u803652676_quiz") or die(mysql_error());

$erabiltzaileak = mysql_query( "select * from erabiltzaile" );

echo '<table border=1><tr><th> IZENA </th><th> ABIZENA </th><th> EPOSTA </th><th> TELEFONOA </th><th> ESPEZIALIZAZIOA </th><th> GUSTOKO TEKNOLOGIAK </th></tr>';

while( $row = mysql_fetch_array( $erabiltzaileak ) ) {
	echo '<tr><td>'.$row['Izena'].'</td> <td>'. $row['Abizena'].'</td> <td>'. $row['Eposta'].'</td> <td>'. $row['Telefonoa'].'</td><td>'. $row['Informatika'].'</td><td>'. $row['Teknologiak'].'</td></tr>.' ;
}

echo '</table>';
?>