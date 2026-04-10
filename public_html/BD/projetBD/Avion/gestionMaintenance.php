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
		
	$numavion=$_POST["numavion"];
	
	$sql="select current_date";
	$resultat=pg_query($sql);
	if (!$resultat){
			echo "Problème lors du lancement de la requête";
			exit;
	}
	$ligne=pg_fetch_array($resultat);
	
	$numposte = $_POST["idres"] ;
	
	$sql2="insert into maintenance(NumMaintenance, DateMaintenance, NumAvion, NumResponsable) VALUES (DEFAULT,'".$ligne["current_date"]."','$numavion','$numposte')" ;
	$resultat=pg_query($sql2);
			if (!$resultat){
					echo "Problème lors du lancement de la requête";
					exit;
			}
			$ligne=pg_fetch_array($resultat);
	
	$sql2="select MAX(nummaintenance) as maxnum from maintenance" ;
	$resultat=pg_query($sql2);
			if (!$resultat){
					echo "Problème lors du lancement de la requête";
					exit;
			}
			$ligne=pg_fetch_array($resultat);
	
	$numaintenance = $ligne['maxnum'];
	$checked = $_POST['numposte']; // récupère la valeur des cases cochées

	foreach($checked as $num)
	{
		$sql2="insert into prendencharge(nummaintenance, numposte) VALUES ('$numaintenance','$num')";
		$resultat=pg_query($sql2);
				if (!$resultat){
						echo "Problème lors du lancement de la requête";
						exit;
				}
				$ligne=pg_fetch_array($resultat);
	}
	
	$numtype = $_POST['numtypemaintenance'] ;
	echo $numtype ;
	
	$sql2="insert into possede(NumMaintenance, NumTypeMaintenance) VALUES ('$numaintenance','$numtype')" ;
	$resultat=pg_query($sql2);
			if (!$resultat){
					echo "Problème lors du lancement de la requête";
					exit;
			}
			$ligne=pg_fetch_array($resultat);
	
	
	header("Location: ./resultat7.php");
	exit ;
	
	
		
	?>
	</body>
</html>
