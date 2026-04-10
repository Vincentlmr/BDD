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
	
	echo "<form action='suppPerso.php' method=POST>" ;
		echo "<h2> Listes des employés </h2>";		
		$sql="select (p.nom || ' ' || p.prenom) as nompers, p.numposte from personnel p ";
		$result = pg_query ($con, $sql);

		if (!$result) {
			echo "Erreur durant la requÃªte.\n";
			echo $sql."\n";exit; }
			
		while ($l=pg_fetch_array($result))
		{
			//cases Ã  cocher avec le numÃ©ro de film comme valeur (valeur affectÃ©e au champ de saisie)
				echo " <input type=checkbox NAME='numposte[]' VALUE=".$l["numposte"].">";
			//affichage du titre
			echo $l["nompers"]."<br>";
		}
		echo "<br></br>";
		echo "<input type='submit' value='Supprimer des employés !' />" ; 		
	echo "</form>" ;
		
		
		
	?>
	</body>
</html>
