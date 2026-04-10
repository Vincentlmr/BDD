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
		
	
	$numplace=$_POST["numplace"];
	$numvol=$_POST["numvol"];
	$numreservation=$_POST["numreservation"];
   
	
	
	
	
			if ($numplace){
                $sql="update reservation set numplace=$numplace where numreservation=$numreservation";
                $resultat=pg_query($sql);
                if (!$resultat){
					echo "Problème lors du lancement de la requête";
					exit;
			}
			}
			
			if ($numvol){
                $sql2="update reservation set numvol=$numvol where numreservation=$numreservation";
                $resultat=pg_query($sql2);
                if (!$resultat){
					echo "Problème lors du lancement de la requête";
					exit;
			}
			}
    
	
	header("Location: ./choixpass.php");
	exit ;
        
	?>
	</body>
</html>
