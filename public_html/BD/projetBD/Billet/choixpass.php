<html>
	<head>
		<title>   Site AVION </title>
		<link  rel="stylesheet" href="style.css">
	  	<meta http-equiv='Content-Type' content='text/html' >
	</head>
	
	<body>
	<center><h1>Rechercher un billet</h1></center>
	
	<form action="billetpass.php" method="POST">
		
		
       <center>Nom Prénom du passager : <input type='text' name='choixpass' placeholder='Ex : Nom Prénom' class='floating-label__input' /></center><br>
    <center><input type='submit' value='Afficher les billets' /></center>
  	</form>
    
            
   
    <form action="ajoutbillet.php" method="POST">
            <h1> Ajouter une billet </h1>
                    
            <div class='floating-label'>
            <?php
                include("../connexion1.php");
                $con=connect();
                if (!$con)
                    {
                    echo "Probleme connexion à la base";
                    exit;
                    }
                
                $sql="select (ville1.nomville || ' - ' || ville2.nomville) as ville, v.numvol from ville ville1 join vol v on v.villedepart=ville1.numville join ville ville2 on v.villearrivee=ville2.numville";
		
                $resultat=pg_query($sql);
                if (!$resultat){
                        echo "Problème lors du lancement de la requête";
                        exit;
                }
                echo "<p> Choisissez un vol : </p>" ;
                echo '<select id="numvol" name="numvol">';
                $ligne=pg_fetch_array($resultat);
                while($ligne){
                        echo '<option value='.$ligne['numvol'].'>'.$ligne['ville'].'</option>';
                        $ligne=pg_fetch_array($resultat);
                }
                echo '</select>';	
                
                
                
            ?>
            <br><br>
            Numéro de place : <input type='text' name='numplace' placeholder='Entrer le numéro de la place' class='floating-label__input' />
            </div>		
            <br></br>
                
            
            Numéro du passager : <input type='text' name='numpass' placeholder='Entrer le numéro du passager' class='floating-label__input' />
            </div>	
            <br></br>
                
           
                
            <input type='submit' value='Ajouter un billet !' />
  	</form>
    <form action= '../site.html' method=POST>
    <input type='submit' id='submit' value='Menu principal'>
    </form>
	
	
	</body>
	
</html>
