<html>
	<head>
		<title>   Avion </title>
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
		

	$numreservation=$_GET["numreservation"];
	
	
    $sql="delete from reservation where numreservation=$numreservation";
    $resultat=pg_query($sql);
	if (!$resultat){
			echo "Problème lors du lancement de la requête";
			exit;
	}
    echo "$sql";
	
	
	header("Location: ./choixpass.php");
	exit ;
        
	?>
	</body>
</html>
