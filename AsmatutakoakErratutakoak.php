<?php
session_start();
echo "Asmatutakoak:";
echo $_SESSION["Zuzenak"];
echo "<br>";
echo "Erratutakoak:";
echo $_SESSION["Okerrak"];
echo "<br>";
echo ("<a href='layoutAnonymous.html'>Gorde</a>");

?>