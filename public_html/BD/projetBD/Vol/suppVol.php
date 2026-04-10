<html>
	<head>
		<title>   Requête 4 </title>
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
	
	$checked = $_POST['numvol']; // récupère la valeur des cases cochées
    
    foreach($checked as $value)
    {
        pg_query("DELETE FROM equipage WHERE numvol ='".$value."'" );
    	pg_query("DELETE FROM vol WHERE numvol ='".$value."'" );  
    }
    
    header("Location: ./vol.php");
	exit ;
	
	?>
	</body>
</html>
