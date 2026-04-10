<?php
function connect()
{
$con=pg_connect("host=serveur-etu.polytech-lille.fr user=vlemeur port=5432 password=postgres dbname=tp_videoclub") ;
return $con;
}
?>

