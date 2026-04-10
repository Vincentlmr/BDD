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
		
	$sql= "select v.numvol, v.datedepart, v.datearrivee, (ville1.nomville || ' - ' || ville2.nomville) as trajet, v.numavion, (p.nom || ' ' || p.prenom) as nompers from vol v join personnel p on p.numposte=v.numposte join ville ville1 on ville1.numville=v.villedepart join ville ville2 on ville2.numville=v.villearrivee" ;
		$resultat=pg_query($sql);
		if (!$resultat){
				echo "Problème lors du lancement de la requête";
				exit;
		}
		$ligne3=pg_fetch_array($resultat);
		
		echo "<h3> Carnet de vol des avions : </h3>" ;
		
		echo "<table>" ;
		echo "<tr><td> Numéro de vol</td><td> Date de départ </td><td> Date d'arrivée </td><td> Trajet </td><td> Numéro de l'avion </td><td> Nom du responsable </td><td> Equipage </td></tr>" ;
		while ($ligne3)
			{
			//affichage
			echo "<tr><td>".$ligne3['numvol']."</td><td>".$ligne3['datedepart']."</td><td>".$ligne3['datearrivee']."</td><td>".$ligne3['trajet']."</td><td>".$ligne3['numavion']."</td><td>".$ligne3['nompers']."</td><td><a href='equipagevol.php?equipagevol=".$ligne3['numvol']."'>Consulter l'équipage du vol ".$ligne3['numvol']."</a></td><td><a href='horairevol.php?horairevol=".$ligne3['numvol']."'> Modifier l'heure de départ </a></td></tr>" ;
			$ligne3=pg_fetch_array($resultat);	
			}
		echo "</table>"	;
		
	
		echo "<form action='ajoutvol.php' method=POST>" ;
			echo "<input type='submit' value='Saisir un nouveau vol !' />" ;
		echo "</form>" ;
		echo "<form action='suppressionVol.php' method=POST>" ;
			echo "<input type='submit' value='Supprimer un vol !' />" ;
		echo "</form>" ;
	?>
	<form action= '../site.html' method=POST>
    <input type='submit' id='submit' value='Menu principal'>
    </form>
	</body>
</html>
