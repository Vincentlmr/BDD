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
	
	$vol=$_POST["numVol"];
	
	echo "<h2> Liste des passagers du vol ".$vol." </h2>";
	
	$sql= "select (p.nom || ' ' || p.prenom) as nompass, p.TelPass, p.MailPass, r.dateemission, (pers.nom || ' ' || pers.prenom) as nompers from passager p join reservation r on p.numpassager=r.numpassager join personnel pers on pers.numPoste=r.numPoste where r.numvol = '$vol'" ;
	$resultat=pg_query($sql);
	if (!$resultat){
			echo "Problème lors du lancement de la requête";
			exit;
	}
	$ligne=pg_fetch_array($resultat);
	echo "<table>" ;
	echo "<tr><td> Nom du voyageur </td><td> Numéro de téléphone </td><td> E-mail </td><td> Date d'émission du billet </td><td> Employée ayant validant le billet </td></tr>" ;
	while ($ligne)
		{
		//affichage
		echo "<tr><td>".$ligne['nompass']."</td><td>".$ligne['telpass']."</td><td>".$ligne['mailpass']."</td><td>".$ligne['dateemission']."</td><td>".$ligne['nompers']."</td></tr>" ;
		$ligne=pg_fetch_array($resultat);	
		}
	echo "</table>"	;
	
	?>
	<form action= '../site.html' method=POST>
    <input type='submit' id='submit' value='Menu principal'>
    </form>
	</body>
</html>
