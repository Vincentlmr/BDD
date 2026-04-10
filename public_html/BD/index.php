<html>
<head>
	<title> videoclub </title>
</head>

<body>

<table border=3>
<tr><th>Titre</th><th>Annee</th><th>Realisateur</th><th>Categorie</th></tr>
<?php   //debut code php


include("connexion.php");
$con=connect();

// verifier que la connexion est etablie
if (!$con)
	{
	echo "Probleme connexion Ã  la base";
	exit;
	}

//requete sql
$sql="select film.titre,film.annee,realisateur.nom,realisateur.prenom,categorie.libelle from film join categorie on film.ncat=categorie.ncat join realisateur on realisateur.nrea=film.nrea";

$resultat=pg_query($sql);

//verifier que la requete a fonctionne
if (!$resultat)
	{ echo "Probleme lors du lancement de la requete";
	exit;
	}
//copie de la premiere ligne de resulat dans le tableau ligne
$ligne=pg_fetch_array($resultat);

//test si la ligne n'est pas vide 

while ($ligne)	
	{
	$titre =$ligne["titre"];
	$annee =$ligne["annee"];
	$prenom =$ligne["prenom"];
	$nom =$ligne["nom"];
	$libelle=$ligne["libelle"];
	//affichage
	echo "
	<tr><td>$titre </td> <td> $annee </td><td>$prenom $nom </td> <td> $libelle </td></tr></br>";
	$ligne=pg_fetch_array($resultat);
	}

//fin php
?> 
</table>


</body>
</html>
