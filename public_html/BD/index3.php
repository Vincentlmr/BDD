<html>
<head>
	<title> videoclub 3 </title>
</head>

<body>

<h1> Selctionner un film </h1>

<form action="index31.php" method="POST">

<?php
include("connexion.php");
$con=connect();

if (!$con)
	{
	echo "Probleme connexion Ã  la base";
	exit;
	}


$sql="select titre, nfilm from film";
$result = pg_query ($con, $sql);

if (!$result)
	{ echo "Probleme lors du lancement de la requete";
	exit;
	}

echo "<h2> Listes des films </h2>";

while ($l=pg_fetch_array($result)){
	echo " <input type=checkbox NAME='numfilms[]' VALUE=".$l["nfilm"].">";
	echo $l["titre"]."<br>";
	}
?>
	
<INPUT TYPE="submit" VALUE="Supprimer">
<INPUT TYPE="reset" VALUE="Annuler">
</FORM>




</body>
</html>
