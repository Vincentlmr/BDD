<html>
	<head>
		<title>   Site AVION </title>
		<link  rel="stylesheet" href="../style.css">
	  	<meta http-equiv='Content-Type' content='text/html' >
	</head>
	
	<body>
	
    <a href = "inscriptionComptepers.php"> Inscription personnel</a><br><br><br><br>
	
	<form action="inscription.php" method="POST">
		<center><h1> Inscription Passager</h1></center>
	
		
		
		<center><label><b> Nom : </b></label><br></center>
		<center><input type ="text" placeholder="Entrer votre nom" name="nom" required><br><br></center>
		
		<center><label><b> Prenom : </b></label><br></center>
		<center><input type ="text" placeholder="Entrer votre prenom" name="prenom" required><br><br></center>
		
		<center><label><b> Téléphone : </b></label><br></center>
		<center><input type ="text" placeholder="Entrer votre téléphone" name="tel" required><br><br></center>
		
		<center><label><b> Email : </b></label><br></center>
		<center><input type ="text" placeholder="Entrer votre adresse mail" name="mail" required><br><br></center>
		
		<center><label><b> Mot de passe : </b></label><br></center>
		<center><input type="password" placeholder="Entrer un mot de passe" name="mdp" required><br><br></center>
		
		<center><input type="submit" id="submit" value='Inscription'></center>
		<center><INPUT TYPE="reset" VALUE="Annuler"></center>
	
	

	</body>
</html>

