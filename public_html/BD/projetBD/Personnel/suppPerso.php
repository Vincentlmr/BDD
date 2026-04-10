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
	
	$checked = $_POST['numposte']; // récupère la valeur des cases cochées
    
    foreach($checked as $value)
    {
    
    	pg_query("DELETE FROM personnel WHERE numposte ='".$value."'" );  
    }
    
    header("Location: ./resultat8.php");
	exit ;
	
	?>
	</body>
</html>
