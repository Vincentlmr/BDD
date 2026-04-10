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
	echo "<form action='affichPassager.php' method=POST>" ;
		
		$sql="select (ville1.nomville || ' - ' || ville2.nomville) as ville, v.numvol from ville ville1 join vol v on v.villedepart=ville1.numville join ville ville2 on v.villearrivee=ville2.numville";
		
  		$resultat=pg_query($sql);
  		if (!$resultat){
  				echo "Problème lors du lancement de la requête";
  				exit;
  		}
		echo "<p> Choisissez un vol : </p>" ;
  		echo '<select id="numVol" name="numVol">';
  		$ligne=pg_fetch_array($resultat);
  		while($ligne){
  				echo '<option value='.$ligne['numvol'].'>'.$ligne['ville'].'</option>';
  				$ligne=pg_fetch_array($resultat);
  		}
  		echo '</select>';		
  		
  	echo "<br></br>"; 	
	echo "<input type='submit' value='Afficher les passagers du vol !' />" ;
	echo "</form>" ;
	?>
	<form action= '../site.html' method=POST>
    <input type='submit' id='submit' value='Menu principal'>
    </form>
	</body>
</html>
