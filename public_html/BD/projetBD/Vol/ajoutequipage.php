<html>
    <head>
        <title>   Requête 9 </title>
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

    $numvol = $_GET['numvol'] ;
    echo "<form action='ConfirmationAjoutEquipage.php' method=POST>" ;

        echo "<h3> Ajout de membres à l'équipage : </h3>" ;
        echo "<h2> Liste du personnel </h2>";
        $sql="select (p.nom || ' ' || p.prenom) as idres, p.numposte from personnel p where p.numposte not in (select p.numposte from personnel p join equipage e on e.numposte=p.numposte where e.numvol ='$numvol' )";
        $result = pg_query ($con, $sql);

        if (!$result) {
            echo "Erreur durant la requÃªte.\n";
            echo $sql."\n";exit; }

        while ($l=pg_fetch_array($result))
        {
            //cases Ã  cocher avec le numÃ©ro de film comme valeur (valeur affectÃ©e au champ de saisie)
                echo " <input type=checkbox NAME='numposte[]' VALUE=".$l["numposte"].">";
            //affichage du titre
            echo $l["idres"]."<br>";
        }


    echo "<br></br>";
    echo "<input type='submit' value='Ajouter le(s) membre(s) !' />" ;
    echo '<input type="hidden" name="numvol" value='.$numvol.' />' ;
    echo "</form>" ;

    ?>
    </body>
</html>
