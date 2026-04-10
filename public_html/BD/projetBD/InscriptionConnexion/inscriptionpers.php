<?php

extract($_POST);
include("connexion1.php");
$con=connect();
if (!$con)
	{
	echo "Probleme connexion à la base";
	exit;
	}

	
$sql ="insert into Personnel(numposte,nom,prenom,sexe,numfonction,mailpers,telpers,mdppers) values(DEFAULT,'$nom','$prenom','$sexe',$numfonc,'$mail','$tel','$mdp')";
echo $sql;
$resultat=pg_query($sql);


//verifier que la requete a fonctionne
if (!$resultat)
	{ echo "Probleme lors du lancement de la requete";
	exit;
	}
header('Location: ./ConnexionCompteperso.php');	

?>
