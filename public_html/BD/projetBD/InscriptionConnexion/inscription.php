<?php
extract($_POST);

include("../connexion1.php");

$con=connect();
if (!$con)
	{
	echo "Probleme connexion à la base";
	exit;
	}

$sql ="insert into passager(numpassager,nom,prenom,telpass,mailpass,mdppass) values(DEFAULT,'$nom','$prenom','$tel','$mail','$mdp')";
$resultat=pg_query($sql);
echo $sql;
//verifier que la requete a fonctionne
if (!$resultat)
	{ echo "Probleme lors du lancement de la requete";
	exit;
	}
header('Location: ./ConnextionCompte.php');
?>
	
