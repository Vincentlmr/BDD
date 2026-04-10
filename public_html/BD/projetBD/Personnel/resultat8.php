<html>
	<head>
		<title>   Requête 8 </title>
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

	$sql= "select p.numposte, (p.nom || ' ' || p.prenom) as nompers, p.sexe, f.libellefonction, p.mailpers, p.telpers from personnel p join fonction f on f.numfonction=p.numfonction order by f.libellefonction" ;
	$resultat=pg_query($sql);
	if (!$resultat){
			echo "Problème lors du lancement de la requête";
			exit;
	}
	$ligne=pg_fetch_array($resultat);

	echo "<h3> Employé(s) de la compagnie : </h3>" ;
	
	echo "<table>" ;
	echo "<tr><td> Numéro de l'employé </td><td> Nom de l'employé </td><td> Sexe </td><td> Fonction </td><td> Mail </td><td> Téléphone </td></tr>" ;
	while ($ligne)
		{
		//affichage
		echo "<tr><td>".$ligne['numposte']."</td><td>".$ligne['nompers']."</td><td>".$ligne['sexe']."</td><td>".$ligne['libellefonction']."</td><td>".$ligne['mailpers']."</td><td>".$ligne['telpers']."</td></tr>" ;
		$ligne=pg_fetch_array($resultat);	
		}
	echo "</table>"	;
    echo "<form action='adpersonnel.php' method=POST>";
	echo "<h3> Ajouter un employé : </h3>";
		echo "<div class='floating-label'>" ;
			echo "Nom Prénom de l'employé : "."<input type='text' name='adnomprenom' placeholder='Ex : Nom Prénom' class='floating-label__input' />";
		echo "</div>" ;
		echo "<div class='floating-label'>" ;
			echo "Sexe de l'employé : "."<input type='text' name='adSexe' placeholder='Ex : F/H' class='floating-label__input' />";
		echo "</div>" ;
		echo "<div class='floating-label'>" ;
			echo "Fonction de l'employé : "."<input type='text' name='adFonction' placeholder='Ex : Pilote' class='floating-label__input' />";
		echo "</div>" ;
		echo "<div class='floating-label'>" ;
			echo "Téléphone de l'employé : "."<input type='text' name='adTel' placeholder=' Entrer un numéro' class='floating-label__input' />";
		echo "</div>" ;
		echo "<div class='floating-label'>" ;
			echo "Mail de l'employé : "."<input type='text' name='adMail' placeholder=' Entrer un mail'  class='floating-label__input' />";
		echo "</div>" ;	
		echo "<div class='floating-label'>" ;
			echo "Mot de passe de l'employé : "."<input type='text' name='adMdp' placeholder='Ex : 123' class='floating-label__input' />";
		echo "</div>" ;		
		echo "<br></br>";
		
  	echo "<input type='submit' value='Ajouter un employé !' />" ;
  	echo "</form>";
  	echo "<form action= 'suppressionPerso.php' method=POST>";
  		echo "<input type='submit' id='submit' value='Supprimer un employé'>";
	echo "</form>" ;
  	echo "<form action= '../site.html' method=POST>";
  		echo "<input type='submit' id='submit' value='Menu principal'>";
	echo "</form>" ;
	
	
	?>
	</body>
</html>
