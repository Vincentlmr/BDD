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
		
	$adnomprenom=$_POST["adnomprenom"];
	$nomprenom = explode(" ", $adnomprenom);
	$adsexe=$_POST["adSexe"];
	$adfonction=$_POST["adFonction"];
	$adMail=$_POST["adMail"];
	$adTel=$_POST["adTel"];
	$adMdp=$_POST["adMdp"];
	
	echo"$adTel";
	
	
	$sql="select numfonction from fonction where libellefonction='$adfonction'" ;
	$resultat=pg_query($sql);
			if (!$resultat){
					echo "Problème lors du lancement de la requête";
					exit;
			}
			$ligne=pg_fetch_array($resultat);
	
	$sql2="insert into personnel(NumPoste,Nom,Prenom,Sexe,NumFonction,mailpers,telpers,mdppers) VALUES (DEFAULT,'$nomprenom[0]','$nomprenom[1]','$adsexe' ,'".$ligne["numfonction"]."','$adMail','$adTel','$adMdp')";
	
	$resultat=pg_query($sql2);
	
			if (!$resultat){
					echo "Problème lors du lancement de la requête";
					exit;
			}
			$ligne=pg_fetch_array($resultat);
	
	
	header("Location: ./resultat8.php");
	exit ;
	
	?>
	</body>
</html>
