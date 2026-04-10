
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
echo $titre;


$sql ="insert into film(nfilm,titre,annee,nrea,ncat) values($nfilm,'$titre',$annee,$nrea,$ncat)";
echo $sql;
$resultat=pg_query($sql);

//verifier que la requete a fonctionne
if (!$resultat)
	{ echo "Probleme lors du lancement de la requete";
	exit;
	}
//fin php

?> 
