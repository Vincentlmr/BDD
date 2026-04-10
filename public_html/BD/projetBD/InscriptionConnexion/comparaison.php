<?php   //debut code php

extract($_POST);


include("../connexion1.php");
$con=connect();

// verifier que la connexion est etablie
if (!$con)
	{
	echo "Probleme connexion Ã  la base";
	exit;
	}

$sql = "Select numpassager,mdppass from passager where mailpass='$Mail'";



$resultat=pg_query($sql);
$ligne=pg_fetch_array($resultat);



//verifier que la requete a fonctionne
if (!$resultat)
	{ echo "Probleme lors du lancement de la requete";
	exit;
	}
if ($Mdp == $ligne['mdppass'])
	{
	echo "Connexion réussie <br><br>";
	echo '<a href="../site.html?numpass='.$ligne['numpassager'].'">Se connecter</a>';
	exit;
	
	}
else {
	echo"Echec de connexion<br>";
	
	echo"Le mot de passe ou l'adresse mail est incorrecte<br>";
	echo '<a href="ConnextionCompte.php">Retour connexion</a>';
	exit;
	}
?>

