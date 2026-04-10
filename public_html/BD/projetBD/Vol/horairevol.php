<html>
	<head>
		<title>   Requête 6 </title>
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
		
		$numvol = $_GET["horairevol"];
		
		$sql="select distinct(v.numvol), v.datedepart, v.datearrivee, (ville1.nomville || ' - ' || ville2.nomville) as trajet, v.numavion, (p.nom || ' ' || p.prenom) as nompers from vol v join personnel p on p.numposte=v.numposte join ville ville1 on ville1.numville=v.villedepart join ville ville2 on ville2.numville=v.villearrivee where v.numvol='$numvol'" ;
		
		$resultat=pg_query($sql);
		$ligne=pg_fetch_array($resultat);
		
		echo "<h3> Equipage du vol numéro ".$numvol." : </h3>" ;
		
		echo "<table>" ;
		echo "<tr><td> Numéro de vol</td><td> Date de départ </td><td> Date d'arrivée </td><td> Trajet </td><td> Numéro de l'avion </td><td> Numéro du responsable </td></tr>" ;
		while ($ligne)
			{
			//affichage
			echo "<tr><td>".$ligne['numvol']."</td><td>".$ligne['datedepart']."</td><td>".$ligne['datearrivee']."</td><td>".$ligne['trajet']."</td><td>".$ligne['numavion']."</td><td>".$ligne['nompers']."</td></tr>" ;
			$ligne=pg_fetch_array($resultat);	
			}
		echo "</table>"	;
		
		echo "<br></br>";
		echo "<form action='modifhorairevol.php' method=POST>" ;
				echo "<div class='floating-label'>" ;
					echo "Nouvelle heure de départ du vol : "."<input type='text' name='heurevol' placeholder='Ex : YYYY-MM-DD HH:MM:SS' class='floating-label__input' />";
				echo "</div>" ;
		  		echo "<br></br>";
		  		echo "<input type='hidden' name='numvol' value='$numvol' />" ;
				echo "<input type='submit' value='Modifier l'horaire de départ !' />" ;
			echo "</form>" ;
		
		
		
?>
	</body>
</html>


