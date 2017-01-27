<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');
     
    $searchNode = $xml->getElementsByTagName("tuteur");
    
    $idtest = $xml->createElement('idTuteur');
    $idtest->nodeValue = $_POST['idtuteur'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idTuteur');
        
        if($valueID == $idtest->nodeValue ){
            echo '<script>window.alert("this idTuteur is already used"); window.location.href = "index.html"; </script>';
            die();
        }
    }
     
    $searchNode = $xml->getElementsByTagName("enseignant");
    
    $idtestjury = $xml->createElement('idenseignant');
    $idtestjury->nodeValue = $_POST['idenseignant'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idEnseignant');
        
        if($valueID == $idtest->nodeValue ){

            $tuteurs = $xml->getElementsByTagName('tuteurs')->item(0);
            $tuteur = $xml->createElement('tuteur');

            $idtuteur = $xml->createAttribute('idtuteur');
            $idtuteur->nodeValue = $_POST['idtuteur'];
            $tuteur->appendChild($idtuteur);
            $tuteur->setIdAttribute($idtuteur,true);

            $enseignant = $xml->createElement('enseignant_tuteur');
            $idenseignant = $xml->createAttribute('idenseignant');
            $idenseignant->nodeValue = $_POST['idenseignant'];
            $enseignant->appendChild($idenseignant);
            $enseignant->setIdAttribute($idenseignant,true);
            $tuteur->appendChild($enseignant);

            $tuteurs->appendChild($tuteur);

            htmlentities($xml->save('GlobalXML.xml'));

            header('Location:tuteurs.html');
            die();
        }
    }
    echo '<script>window.alert("no enseignant with this id has been found"); window.location.href = "index.html"; </script>';
    die();

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
     <label for="name">Id tuteur</label>
     <input type="text" name="idtuteur" />
     </br>
    <label for="name">Id enseignant</label>
     <input type="text" name="idenseignant" />
     </br>
     <input name="submit" type="submit"/>
 </form>