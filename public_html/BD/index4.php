<html>
<head>
	<title> videoclub 4 </title>
</head>

<body>

<h2> Emprunt d un dvd </h2>

<form method=post action=index41.php>
Emprunter un film

<table border=0>
	<tr><td>Nom de l abonne</td><td><input type=text name="nomab"></td></tr>
	<tr><td>Titre</td><td><input type=text name="titre"></td></tr>
	
	
<?php

include("connexion.php");
$con=connect();

if (!$con)
	{
	echo "Probleme connexion Ã  la base";
	exit;
	}


$sql="select titre";
$result = pg_query ($con, $sql);

while ($l=pg_fetch_array($result)){
	$titre =$l["titre"];
	echo "
	<tr><td>Film a emprunter</td><td><select ><option value="titre">$titre</option></select> </td></tr></br>";
	
	}

?>
	
	
	
	<tr><td colspan=2> <input type="submit" VALUE="Ajouter"> <INPUT TYPE="reset" VALUE="Annuler"></td></tr>

</table>
</form>


</table>
</body>
</html>
