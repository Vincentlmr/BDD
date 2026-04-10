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
	$numpass=$_POST["numpass"];
	
	
	$sql1="select current_date";
	$resultat1=pg_query($sql1);
	if (!$resultat1){
			echo "Problème lors du lancement de la requête";
			exit;
	}
	$ligne=pg_fetch_array($resultat1);
	
	
	$sql2="select count(numpassager) as nbpass,nbplaces,numvol from avion natural join vol natural join passager group by numvol,nbplaces having numvol=$numvol"; 
	$resultat2=pg_query($sql2);
	if (!$resultat2){
			echo "Problème lors du lancement de la requête";
			exit;
	}
	$ligne2=pg_fetch_array($resultat2);
	
	$nbpass=$ligne2['nbpass'];
	$nbplace=$ligne2['nbplaces'];
	
	if($nbpass<$nbplace){
	
        if($numplace<$nbplace){
            $sql="insert into reservation(numreservation,dateemission,numplace,numpassager,numvol,numposte) values(DEFAULT,'".$ligne["current_date"]."',$numplace,$numpass,$numvol,9)";
            
            $resultat=pg_query($sql);
            if (!$resultat){
                    echo "Problème lors du lancement de la requête";
                    exit;
            exit;
            }
            $ligne=pg_fetch_array($resultat);
            
            header("Location: ./choixpass.php");
            exit;
        }
        else{
            echo "la place choisie est incorrecte<br>";
            echo '<a href="choixpass.php">retour</a>';
            exit;
        }
    }
    else{
        echo "Le vol est complet<br>";
        echo '<a href="choixpass.php">retour</a>';
        exit;
    }
        
            
	exit ;
        
	?>
	</body>
</html>
