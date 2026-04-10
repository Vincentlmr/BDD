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
	$numavion=$_POST["numavion"];
	
	echo "<form action='gestionMaintenance.php' method=POST>" ;
		
		echo "<h3> Carnet de maintenance de l'avion numéro ".$numavion." : </h3>" ;
		
		$sql=" select p.numposte, (p.nom || ' ' || p.prenom) as idres from personnel p";
  		$resultat=pg_query($sql);
  		if (!$resultat){
  				echo "Problème lors du lancement de la requête";
  				exit;
  		}
  		
  		echo '<label for="idres">Responsable de la maintenance :</label>';
  		echo '<select id="idres" name="idres">';
  		$ligne1=pg_fetch_array($resultat);
  		while($ligne1){
  				echo '<option value='.$ligne1['numposte'].'>'.$ligne1['idres'].'</option>';
  				$ligne1=pg_fetch_array($resultat);
  		}
  		echo '</select>';
  		echo "<br></br>";
  		
  		$sql=" select t.numtypemaintenance, t.libellemaintenance from typemaintenance t";
  		$resultat=pg_query($sql);
  		if (!$resultat){
  				echo "Problème lors du lancement de la requête";
  				exit;
  		}
  		
  		echo '<label for="libellemaintenance">Type de la maintenance :</label>';
  		echo '<select id="numtypemaintenance" name="numtypemaintenance">';
  		$ligne=pg_fetch_array($resultat);
  		while($ligne){
  				echo '<option value='.$ligne['numtypemaintenance'].'>'.$ligne['libellemaintenance'].'</option>';
  				$ligne=pg_fetch_array($resultat);
  		}
  		echo '</select>';
  		echo "<p>La date de la maintenance sera renseignée automatiquement</p>" ;
  		
  		
  		echo "<h3> Listes des intervenants sur l'opération de maintenance : </h3>";		
		$sql="select p.numposte, (p.nom || ' ' || p.prenom) as idres from personnel p";
		$result = pg_query ($sql);
		if (!$result) {
			echo "Erreur durant la requÃªte.\n";
			echo $sql."\n";exit; }
			
		while ($l=pg_fetch_array($result))
		{
				echo " <input type=checkbox NAME='numposte[]' VALUE=".$l['numposte'].">";
			echo $l["idres"]."<br>";
		}
	
	echo "<br></br>";
	echo '<input type="hidden" name="numavion" value='.$numavion.' />' ;
	echo "<input type='submit' value='Saisir la maintenance !' />" ;
	echo "</form>" ;
	
	?>
	</body>
</html>


















