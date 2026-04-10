<html>
	<head>
		<title>   Requête 7 </title>
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
	if($_GET["numavion"]) {
		$numavion=$_GET["numavion"];
		
		$sql= "select numvol, datedepart, datearrivee, villedepart, villearrivee, (p.nom || ' ' || p.prenom) as nompers from vol join personnel p on p.numposte=vol.numposte where numavion ='$numavion' " ;
		$resultat=pg_query($sql);
		if (!$resultat){
				echo "Problème lors du lancement de la requête";
				exit;
		}
		$ligne3=pg_fetch_array($resultat);
		echo "<h3> Carnet de vol de l'avion numéro ".$numavion." : </h3>" ;
		
		echo "<table>" ;
		echo "<tr><td> Numéro du vol</td><td> Date de départ </td><td> Date d'arrivée </td><td> Ville de départ </td><td> Ville d'arrivée </td><td> Nom du responsable </td></tr>" ;
		while ($ligne3)
			{
			//affichage
			echo "<tr><td>".$ligne3['numvol']."</td><td>".$ligne3['datedepart']."</td><td>".$ligne3['datearrivee']."</td><td>".$ligne3['villedepart']."</td><td>".$ligne3['villearrivee']."</td><td>".$ligne3['nompers']."</td></tr>" ;
			$ligne3=pg_fetch_array($resultat);	
			}
		echo "</table>"	;
	}
	else {
		echo "<h2> Veuillez saisir un numéro d'avion </h2>" ;
	}
	
	echo "<form action='ajoutVolbis.php' method=POST>" ;
		echo "<input type='hidden' name='numavion' value='$numavion' />" ;
		echo "<input type='submit' value='Saisir un nouveau vol !' />" ;
	echo "</form>" ;
	?>
	<form action= '../site.html' method=POST>
    <input type='submit' id='submit' value='Menu principal'>
    </form>
	</body>
</html>
