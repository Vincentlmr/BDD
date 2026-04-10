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
		
	$heuredepart=$_POST["heuredepart"];
	$heurearrivee=$_POST["heurearrivee"];
	$villedepart=$_POST["villedepart"];
	$villearrivee=$_POST["villearrivee"];
	$numavion=$_POST["numavion"];
	$idres=$_POST["idres"];
	
	$sql2="select nomville from ville where nomville='$villedepart'" ;
		$resultat=pg_query($sql2);
				if (!$resultat){
						echo "Problème lors du lancement de la requête";
						exit;
				}
				$ligne=pg_fetch_array($resultat);
	
	if(isset($ligne['nomville'])){
	}
	else{
		$sql2="insert into ville(numville, nomville) VALUES (DEFAULT,'$villedepart')" ;
		$resultat=pg_query($sql2);
				if (!$resultat){
						echo "Problème lors du lancement de la requête";
						exit;
				}
				$ligne=pg_fetch_array($resultat);
	}
	
	$sql2="select nomville from ville where nomville='$villearrivee'" ;
		$resultat=pg_query($sql2);
				if (!$resultat){
						echo "Problème lors du lancement de la requête";
						exit;
				}
				$ligne=pg_fetch_array($resultat);
	
	if(isset($ligne['nomville'])){
	}
	else{
		$sql2="insert into ville(numville, nomville) VALUES (DEFAULT,'$villearrivee')" ;
		$resultat=pg_query($sql2);
				if (!$resultat){
						echo "Problème lors du lancement de la requête";
						exit;
				}
				$ligne=pg_fetch_array($resultat);
	}
	
	$sql2="select numville from ville where nomville='$villedepart'" ;
		$resultat=pg_query($sql2);
				if (!$resultat){
						echo "Problème lors du lancement de la requête";
						exit;
				}
				$ligne1=pg_fetch_array($resultat);
				
	$sql2="select numville from ville where nomville='$villearrivee'" ;
		$resultat=pg_query($sql2);
				if (!$resultat){
						echo "Problème lors du lancement de la requête";
						exit;
				}
				$ligne2=pg_fetch_array($resultat);
	
	if($heurearrivee < $heuredepart){
		echo "Veuillez saisir une date d'arrivée antérieur à la date de départ" ;
	}
	else{
		$sql2="insert into vol(numvol, datedepart, datearrivee, villedepart, villearrivee, numavion, numposte) VALUES (DEFAULT,'$heuredepart','$heurearrivee',".$ligne1["numville"].",".$ligne2["numville"].",'$numavion','$idres')" ;
		$resultat=pg_query($sql2);
				if (!$resultat){
						echo "Problème lors du lancement de la requête";
						exit;
				}
				$ligne=pg_fetch_array($resultat);
				
		$maxnumvol="select Max(numvol) as max from vol " ;
		$resultat=pg_query($maxnumvol);
				if (!$resultat){
						echo "Problème lors du lancement de la requête";
						exit;
				}
				$ligne=pg_fetch_array($resultat);
		$m = $ligne["max"];
		$sql = "INSERT INTO Equipage VALUES (".$idres.",".$m.")" ;
		pg_query($sql);  
				
		header("Location: ./vol.php");
		exit ;
	}
	
	
			
	?>
	</body>
</html>
