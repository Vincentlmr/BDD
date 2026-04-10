<html>
	<head>
		<title>   Site AVION </title>
		<link  rel="stylesheet" href="../style.css">
	  	<meta http-equiv='Content-Type' content='text/html' >
	</head>
	
	<body>
	
	<form action="modifBillet.php" method="POST">
		<center><h1> Affichage billet </h1></center>
		
		<?php
			include("../connexion1.php");

			$con=connect();
			if (!$con)
				{
				echo "Probleme connexion à la base";
				exit;
				}
            $adnomprenom=$_POST["choixpass"];
           
            $nomprenom = explode(" ", $adnomprenom);
			
			$sql ="select numreservation,dateemission,numplace,numvol from reservation  natural join passager where nom='$nomprenom[0]' and prenom='$nomprenom[1]'";
			$resultat=pg_query($sql);
			
			$ligne=pg_fetch_array($resultat);
			echo "<table border=2>
		<tr><th>Numéro de Reservation</th><th>Date emission</th><th>Numéro de la place</th><th>Numéro du vol</th></tr>";
			while ($ligne)	
			{
				$numreservation =$ligne["numreservation"];
				$dateemission=$ligne["dateemission"];
				$numplace=$ligne["numplace"];
				$numvol=$ligne["numvol"];
				
				//affichage
				echo"
				<tr><td>$numreservation </td><td> $dateemission </td><td> $numplace </td><td> $numvol </td><td><a href='supbillet.php?numreservation=".$ligne['numreservation']."'> Supprimer le billet </a><td><a href='changebillet.php?numreservation=".$ligne['numreservation']."'> Modifier le billet</a></td></td></tr>";
				$ligne=pg_fetch_array($resultat);
			}
			echo "</table>";

			//verifier que la requete a fonctionne
			if (!$resultat)
				{ echo "Probleme lors du lancement de la requete";
				exit;
				}
			
		

		?>
	
	<form action= '.../site.html' method=POST>
    <input type='submit' id='submit' value='Menu principal'>
    </form>
	
	</body>
	
</html>
