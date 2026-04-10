<html>
	<head>
		<title>   Site AVION </title>
		<link  rel="stylesheet" href="../style.css">
	  	<meta http-equiv='Content-Type' content='text/html' >
	</head>
	
	<body>
	

	<a href = "inscriptionCompte.php"> Inscription passager</a><br><br><br><br>
	<form action="inscriptionpers.php" method="POST">
		<center><h1> Inscription Personnel </h1></center>
		
		
		
		<center><label><b> Nom : </b></label><br></center>
		<center><input type ="text" placeholder="Entrer votre nom" name="nom" required><br><br></center>
		
		<center><label><b> Prenom : </b></label><br></center>
		<center><input type ="text" placeholder="Entrer votre prenom" name="prenom" required><br><br></center>
		
		<center><label><b> Sexe : </b></label><br></center>
		<center><select name="sexe" id="sexe-select">
		    <option value="ng">Ne se prononce pas</option>
		    <option value="H">Homme</option>
		    <option value="F">Femme</option>    
		</select><br><br></center>
		
		<center><label><b> Numéro de de la profession : </b></label><br></center>
		<center><input type ="text" placeholder="Entrer le num de fonc" name="numfonc" required><br><br></center>
		<center>Rappel:</center>
		<center><table border=2>
		<tr><th>Numéro de la Profession</th><th>Profession</th></tr>
		<?php   //debut code php


		include("../connexion1.php");
		$con=connect();

		// verifier que la connexion est etablie
		if (!$con)
			{
			echo "Probleme connexion Ã  la base";
			exit;
			}

		//requete sql
		$sql="select numfonction,libellefonction from fonction";

		$resultat=pg_query($sql);

		//verifier que la requete a fonctionne
		if (!$resultat)
			{ echo "Probleme lors du lancement de la requete";
			exit;
			}
		//copie de la premiere ligne de resulat dans le tableau ligne
		$ligne=pg_fetch_array($resultat);

		//test si la ligne n'est pas vide 

		while ($ligne)	
			{
			$numf =$ligne["numfonction"];
			$libelle=$ligne["libellefonction"];
			//affichage
			echo "
			<tr><td>$numf </td><td> $libelle </td></tr></br>";
			$ligne=pg_fetch_array($resultat);
			}

		//fin php
		?> 
		</table></center>
		<br><br>
		<center><label><b> Email : </b></label><br></center>
		<center><input type ="text" placeholder="Entrer votre adresse mail" name="mail" required><br><br></center>
		
		<center><label><b> Téléphone : </b></label><br></center>
		<center><input type ="text" placeholder="Entrer votre téléphone" name="tel" required><br><br></center>
		
		
		<center><label><b> Mot de passe : </b></label><br></center>
		<center><input type="password" placeholder="Entrer un mot de passe" name="mdp" required><br><br></center>
	
		
		
		<center><input type="submit" id="submit" value='Inscription'></center>
		<center><INPUT TYPE="reset" VALUE="Annuler"></center>
	</body>
</html>

