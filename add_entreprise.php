<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');
     
    $searchNode = $xml->getElementsByTagName("entreprise");
    
    $idtest = $xml->createElement('idEtablissement');
    $idtest->nodeValue = $_POST['identreprise'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idEtablissement');
        
        if($valueID == $idtest->nodeValue ){
            echo '<script>window.alert("this idEtablissement is already used"); window.location.href = "index.html"; </script>';
            die();
        }
     }  

    $entreprises = $xml->getElementsByTagName('entreprises')->item(0);
    $entreprise = $xml->createElement('entreprise');
     
    $identreprise = $xml->createAttribute('idEtablissement');
    $identreprise->nodeValue = $_POST['identreprise'];

    $nom = $xml->createElement('nom');     
    $nom->nodeValue = $_POST['nomentreprise'];

    $adresse = $xml->createElement('adresse');
    $adresse->nodeValue = $_POST['adresseentreprise'];
     
    $siret = $xml->createElement('siret');
    $siret->nodeValue = $_POST['siretentreprise'];
     
     
    $entreprise->appendChild($identreprise);
    $entreprise->setIdAttribute($identreprise,true);
     
    $entreprise->appendChild($nom);
    $entreprise->appendChild($adresse);
    $entreprise->appendChild($siret);
     
    $entreprises->appendChild($entreprise);

    htmlentities($xml->save('GlobalXML.xml'));
     
    header('Location:entreprises.html');

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
     <label for="name">ID de l'entreprise </label>
     <input type="text" name="identreprise" />
     </br>
     <label for="name">Nom de l'entreprise </label>
     <input type="text" name="nomentreprise" />
     </br>
    <label for="name">Adrese de l'entreprise  </label>
     <input type="text" name="adresseentreprise"/>
    </br>
    <label for="name">Siret </label>
    <input type="text" name="siretentreprise"/>
   </br>
     <input name="submit" type="submit"/>
 </form>