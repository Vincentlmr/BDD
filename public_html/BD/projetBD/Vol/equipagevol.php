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
		
		$numvol = $_GET["equipagevol"];
		
		if (!isset($numvol))
		{ 
		$sql="select p.NumPoste, (p.nom || ' ' || p.prenom) as nomperso , p.Sexe , p.NumFonction from equipage e join personnel p on p.numposte=e.numposte ";
		}
		else
		{
		$sql="select p.NumPoste, (p.nom || ' ' || p.prenom) as nomperso , p.Sexe , p.NumFonction from equipage e join personnel p on p.numposte=e.numposte where e.numvol ='$numvol'" ;
		}
		$resultat=pg_query($sql);
		$ligne=pg_fetch_array($resultat);
		
		echo "<h3> Equipage du vol numéro ".$numvol." : </h3>" ;
		
		echo "<table>" ;
		echo "<tr><td> Numero personnel </td> <td> Nom Prenom </td><td> Sexe </td><td> Numero Fonction </td></tr>" ;
		while ($ligne)
			{
			//affichage
			echo "<tr><td>".$ligne['numposte']."</td><td>".$ligne['nomperso']."</td><td>".$ligne['sexe']."</td><td>".$ligne['numfonction']."</td></tr>" ;
			$ligne=pg_fetch_array($resultat);	
			}
		echo "</table>"	;
		
		echo "<a href='ajoutequipage.php?numvol=".$numvol."'> Ajouter un membre à l équipage du vol ! </a>" ;
		
?>
<form action= '../site.html' method=POST>
    <input type='submit' id='submit' value='Menu principal'>
    </form>
	</body>
</html>

