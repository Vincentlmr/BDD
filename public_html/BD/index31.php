
<?php   //debut code php

extract($_POST);


include("connexion.php");
$con=connect();

// verifier que la connexion est etablie
if (!$con)
	{
	echo "Probleme connexion Ã  la base";
	exit;
	}


if (!isset($numfilms))  exit;
echo "<h3>  Le numéro du film film suprime est </h3>";
#parcours du tableau numfilms qui contient les numÃ©ros des films sÃ©lectionnÃ©s
foreach ($numfilms as $v) 
echo $v;

$sql ="delete from film where nfilm=$v";
$resultat=pg_query($sql);

if (!$resultat)
	{ echo "Probleme lors du lancement de la requete";
	exit;
	}
//fin php

?> 
