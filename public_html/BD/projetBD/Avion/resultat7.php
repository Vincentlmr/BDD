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
	
	$sql= "select a.numavion, a.DateMiseService, a.nbplaces, t.libellet from avion a join type t on t.numtype=a.numtype" ;
	$resultat=pg_query($sql);
	if (!$resultat){
			echo "Problème lors du lancement de la requête";
			exit;
	}
	$ligne2=pg_fetch_array($resultat);
	
	echo "<h3> Notre flotille d'avions :</h3>" ;
	echo "<table>" ;
	echo "<tr><td> Numéro Avion</td><td> Date mise en service </td><td> Nombre de places </td><td> Type </td></tr>" ;
	while ($ligne2)
		{
		//affichage
		echo "<tr><td>".$ligne2['numavion']."</td><td>".$ligne2['datemiseservice']."</td><td>".$ligne2['nbplaces']."</td><td>".$ligne2['libellet']."</td><td><a href='carnetMaintenance.php?numavion=".$ligne2['numavion']."'>Consulter le carnet de maintenance de l'avion ".$ligne2['numavion']."</a></td><td><a href='carnetVol.php?numavion=".$ligne2['numavion']."'>Consulter le carnet de vol de l'avion ".$ligne2['numavion']."</a></td></tr>" ;
		$ligne2=pg_fetch_array($resultat);	
		}
	echo "</table>"	;
	
	
	
	?>
	<form action= '../site.html' method=POST>
    <input type='submit' id='submit' value='Menu principal'>
    </form>
	</body>
</html>


