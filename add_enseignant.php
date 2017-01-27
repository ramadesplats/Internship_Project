<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');
     
    $searchNode = $xml->getElementsByTagName("responsable");
    
    $idtestrespo = $xml->createElement('idresponsable');
    $idtestrespo->nodeValue = $_POST['idresponsable'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idPersonne');
        
        if($valueID == $idtestrespo->nodeValue ){
            $enseignants = $xml->getElementsByTagName('enseignants')->item(0);
            $enseignant = $xml->createElement('enseignant');

            $idenseignant = $xml->createAttribute('idEnseignant');
            $idenseignant->nodeValue = $_POST['idenseignant'];

            $enseignant->appendChild($idenseignant);
            $enseignant->setIdAttribute($idenseignant,true);

            $respo = $xml->createElement('responsable_enseignant');
            $idrespo = $xml->createAttribute('idresponsable');
            $idrespo->nodeValue = $_POST['idresponsable'];
            $respo->appendChild($idrespo);
            $respo->setIdAttribute($idresbo,true);
            $enseignant->appendChild($respo);

            $enseignants->appendChild($enseignant);

            htmlentities($xml->save('GlobalXML.xml'));

            header('Location:enseignants.html');
            die();
        }
     }
     
    echo '<script>window.alert("no Personn with this id has been found"); window.location.href = "enseignants.html"; </script>';
    die();

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
     <label for="name">ID de l'enseignant</label>
     <input type="text" name="idenseignant" />
     </br>
     <label for="name">ID du responsable enseignant</label>
    <input type="text" name="idresponsable" />
     </br>
     <input name="submit" type="submit"/>
 </form>