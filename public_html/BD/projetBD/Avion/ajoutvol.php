<html>
	<head>
		<title>   Requête 9 </title>
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
		
	echo "<form action='ConfirmationAjoutVol.php' method=POST>" ;
		
		echo "<h3> Ajout d'un nouveau vol : </h3>" ;
		
		$sql=" select a.numavion from avion a";
  		$resultat=pg_query($sql);
  		if (!$resultat){
  				echo "Problème lors du lancement de la requête";
  				exit;
  		}
  		
  		echo '<label for="numavion">Numéro de l \'avion : </label>';
  		echo '<select id="numavion" name="numavion">';
  		$ligne1=pg_fetch_array($resultat);
  		while($ligne1){
  				echo '<option value='.$ligne1['numavion'].'>'.$ligne1['numavion'].'</option>';
  				$ligne1=pg_fetch_array($resultat);
  		}
  		echo '</select>';
  		echo "<br></br>";
  		
  		echo "Horaire de départ du vol : "."<input type='text' name='heuredepart' placeholder='Ex : YYYY-MM-DD HH:MM:SS' class='floating-label__input' />";
  		echo "<br></br>";
  		echo "Horaire d'arrivée du vol : "."<input type='text' name='heurearrivee' placeholder='Ex : YYYY-MM-DD HH:MM:SS' class='floating-label__input' />";
  		echo "<br></br>";
  		echo "Ville de départ : "."<input type='text' name='villedepart' placeholder='Ex : Paris' class='floating-label__input' />";
  		echo "<br></br>";
  		echo "Ville d'arrivée : "."<input type='text' name='villearrivee' placeholder='Ex : Berlin' class='floating-label__input' />";
  		echo "<br></br>";
  		
  		$sql=" select p.numposte, (p.nom || ' ' || p.prenom) as idres from personnel p";
  		$resultat=pg_query($sql);
  		if (!$resultat){
  				echo "Problème lors du lancement de la requête";
  				exit;
  		}
  		
  		echo '<label for="idres">Responsable du vol : </label>';
  		echo '<select id="idres" name="idres">';
  		$ligne1=pg_fetch_array($resultat);
  		while($ligne1){
  				echo '<option value='.$ligne1['numposte'].'>'.$ligne1['idres'].'</option>';
  				$ligne1=pg_fetch_array($resultat);
  		}
  		echo '</select>';
  		echo "<br></br>";
  		
  		
	
	echo "<br></br>";
	echo "<input type='submit' value='Creer le vol !' />" ;
	echo "</form>" ;
		
	?>
	</body>
</html>
