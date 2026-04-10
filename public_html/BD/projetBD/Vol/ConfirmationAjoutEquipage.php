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


	$checked = $_POST['numposte']; // récupère la valeur des cases cochées
    $numvol=$_POST['numvol'];
    foreach($checked as $value)
    {
    	pg_query("INSERT INTO Equipage VALUES ('$value', '$numvol')");  
    	  
    }
    header("Location: ./vol.php");
	exit ;
	?>
	</body>
</html>
