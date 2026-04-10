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
		
	$numvol=$_POST["numvol"];
	$heurevol=$_POST["heurevol"];
	
	$sql="select datearrivee from vol where numvol ='$numvol'" ;
	$resultat=pg_query($sql);
			if (!$resultat){
					echo "Problème lors du lancement de la requête";
					exit;
			}
			$ligne=pg_fetch_array($resultat);
		
	if ($heurevol > $ligne['datearrivee']){
		echo "Impossible de renseigner une date de départ postérieure à la date d'arrivée";
	}
	else{
		$sql3 = "select(datearrivee + (datearrivee - datedepart)) as tempstrajet from vol where numvol = '$numvol'";
		$resultat=pg_query($sql3);
			if (!$resultat){
					echo "Problème lors du lancement de la requête";
					exit;
			}
			$ligne=pg_fetch_array($resultat);
		$newdatearrivee = $ligne['tempstrajet'] ;
		
		$sql3="UPDATE vol SET datedepart = '$heurevol', datearrivee = '$newdatearrivee' WHERE numvol = '$numvol'" ;
		echo $sql3 ;
		$resultat=pg_query($sql3);
				if (!$resultat){
						echo "Problème lors du lancement de la requête";
						exit;
				}
				$ligne=pg_fetch_array($resultat);
			
		header("Location: ./vol.php");
		exit ;
	}
			
	
	
	
?>
	</body>
</html>
