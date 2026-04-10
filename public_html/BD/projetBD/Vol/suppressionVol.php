<html>
	<head>
		<title>   Requête 1 </title>
		<link  rel="stylesheet" href="../style.css">
	  	<meta http-equiv='Content-Type' content='text/html' >
	</head>
	<body>
	<?php  
	
	include("../connexion1.php");
	$con=connect();
	if (!$con)
		{
		echo "Probleme connexion à la base";
		exit;
		}
	
	echo "<form action='suppVol.php' method=POST>" ;
		echo "<h2> Listes des vols </h2>";		
		$sql="select numvol from vol ";
		$result = pg_query ($con, $sql);

		if (!$result) {
			echo "Erreur durant la requÃªte.\n";
			echo $sql."\n";exit; }
			
		while ($l=pg_fetch_array($result))
		{
			//cases Ã  cocher avec le numÃ©ro de film comme valeur (valeur affectÃ©e au champ de saisie)
				echo " <input type=checkbox NAME='numvol[]' VALUE=".$l["numvol"].">";
			//affichage du titre
			echo $l["numvol"]."<br>";
		}
		echo "<br></br>";
		echo "<input type='submit' value='Supprimer le vol !' />" ; 		
	echo "</form>" ;
		
		
		
	?>
	</body>
</html>
