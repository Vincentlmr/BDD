<?php
function connect()
{
$con=pg_connect("host=serveur-etu.polytech-lille.fr user=aleloir port=5432 password=postgres dbname=xxAvion") ;
return $con;
}
?>
