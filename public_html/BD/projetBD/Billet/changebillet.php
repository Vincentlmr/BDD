<html>
	<head>
		<title>   Site AVION </title>
		<link  rel="stylesheet" href="../style.css">
	  	<meta http-equiv='Content-Type' content='text/html' >
	</head>
	
	<body>
	
	<form action="modifBillet.php" method="POST">
		<center><h1> Modifier billet </h1></center>
		
		<?php
			include("../connexion1.php");
            echo "<form action='modifbillet.php' method=POST>" ;
            $numreservation=$_GET['numreservation'];
                echo "<h3> Modifier le billet </h3>";
                
                echo "<div class='floating-label'>" ;
                    echo "Nouveau numéro de place : "."<input type='text' name='numplace' placeholder='Entrer le numéro de la place' class='floating-label__input' />";
                echo "</div>" ;		
                echo "<br></br>";
                
                echo "<div class='floating-label'>" ;
                    echo "Nouveau numéro de vol : "."<input type='text' name='numvol' placeholder='Entrer le numéro du vol' class='floating-label__input' />";
                echo "</div>" ;		
                echo "<br></br>";
                
            echo "<input type='hidden' name='numreservation' value='$numreservation'>";
            echo "<input type='submit' value='Modifier le billet !' />" ;
            echo "</form>";
            
         
		
   		?>
	
	
	
	</body>
	
</html>
