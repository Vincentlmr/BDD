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
		if($_GET["numavion"]){
			$numavion=$_GET["numavion"];
			
			
			/* $numAvion = pg_query("select a.numAvion from Avion a join Type t on t.NumType=a.NumType where t.LibelleT = '$type'");
			$ligne=pg_fetch_array($numAvion); */
			

			$sql= "select m.nummaintenance, m.datemaintenance, m.numavion, (perso.nom || ' ' || perso.prenom) as nompers, t.numtypemaintenance, t.libellemaintenance from maintenance m join possede p on p.nummaintenance=m.nummaintenance join typemaintenance t on t.numtypemaintenance=p.numtypemaintenance join personnel perso on perso.numposte=m.numresponsable where m.numavion ='$numavion'" ;
			$resultat=pg_query($sql);
			if (!$resultat){
					echo "Problème lors du lancement de la requête";
					exit;
			}
			$ligne2=pg_fetch_array($resultat);
			echo "<h3> Carnet de maintenance de l'avion numéro ".$numavion." : </h3>" ;
			echo "<table>" ;
			echo "<tr><td> Numéro de maintenance</td><td> Date </td><td> Numéro de l'avion </td><td> Nom du responsable </td><td> Numéro du type de maintenance </td><td> Libelle du type </td></tr>" ;
			while ($ligne2)
				{
				//affichage
				echo "<tr><td>".$ligne2['nummaintenance']."</td><td>".$ligne2['datemaintenance']."</td><td>".$ligne2['numavion']."</td><td>".$ligne2['nompers']."</td><td>".$ligne2['numtypemaintenance']."</td><td>".$ligne2['libellemaintenance']."</td></tr>" ;
				$ligne2=pg_fetch_array($resultat);	
				}
			echo "</table>"	;
			
			echo "<form action='resultat9.php' method=POST>" ;
				echo "<input type='hidden' name='numavion' value='$numavion' />" ;
				echo "<input type='submit' value='Saisir une nouvelle maintenance !' />" ;
			echo "</form>" ;
		}
		else {
			echo "<h2> Veuillez saisir un numéro d'avion </h2>" ;
		}
	
	
	 
	?>
	<form action= '../site.html' method=POST>
    <input type='submit' id='submit' value='Menu principal'>
    </form>
	</body>
</html>
