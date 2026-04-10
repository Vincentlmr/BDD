<html>
	<head>
		<title>   Requête 7 </title>
		<link  rel="stylesheet" href="../style.css">
	  	<meta http-equiv='Content-Type' content='text/html' >
	</head>
	<body>
	<?php  
	
	include("connexion1../.php");
	$con=connect();
	if (!$con)
		{
		echo "Probleme connexion à la base";
		exit;
		}
	
	$numavion=$_POST['numavion'] ;
	
	if(isset($_POST['maintenance'])){
			header("Location: ./carnetMaintenance.php?numavion=$numavion");
			exit ;
	}
	else if(isset($_POST['vol'])){
			header("Location: ./carnetVol.php?numavion=$numavion");
			exit ;
	}
	?>
	</body>
</html>
