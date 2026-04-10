<html>
	<head>
		<title> AVION </title>
		<link  rel="stylesheet" href="../style.css">
	  	<meta http-equiv='Content-Type' content='text/html' >
	</head>
	
	<body>
	<?php
		include("../connexion1.php");
	?>

	
	<form action="comparaisonpers.php" method="POST">
		<center><h1> Connexion Personnel</h1>
		<a href = "ConnextionCompte.php"> Connexion passager</a><br><br><br><br>
		<center><label><b> Email : </b></label><br></center>
		<center><input type ="text" placeholder="Entrer votre adresse mail" name="Mail" required><br><br></center>
		
		<center><label><b> Mot de passe : </b></label><br></center>
		<center><input type="password" placeholder="Entrer un mot de passe" name="Mdp" required><br><br></center>
		
		<center><input type="submit" id="submit" value='Connection'></center>
		<center><INPUT TYPE="reset" VALUE="Annuler"><br><br>
		<a href = "inscriptionComptepers.php"> S'inscrire</a></center>
	
	

	</body>
</html>
