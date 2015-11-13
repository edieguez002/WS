<?php

require_once('/nusoap-0.9.5/lib/nusoap.php');

$server= new soap_server("comprobarmatricula.wsdl");
//$file= fopen("@ws.txt","r");
	$korreoak= array();
	while(!feof($file)){
		$korreoak[]=fgets($file);
	}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>