<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');
     
    $searchNode = $xml->getElementsByTagName("laboratoire");
    
    $idtest = $xml->createElement('idEtablissement');
    $idtest->nodeValue = $_POST['idlaboratoire'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idEtablissement');
        
        if($valueID == $idtest->nodeValue ){
            echo '<script>window.alert("this idEtablissement is already used"); window.location.href = "index.html"; </script>';
            die();
        }
     }  

    $laboratoires = $xml->getElementsByTagName('laboratoires')->item(0);
    $laboratoire = $xml->createElement('laboratoire');
     
    $idlaboratoire = $xml->createAttribute('idEtablissement');
    $idlaboratoire->nodeValue = $_POST['idlaboratoire'];

    $nom = $xml->createElement('nom');     
    $nom->nodeValue = $_POST['nomlaboratoire'];

    $adresse = $xml->createElement('adresse');
    $adresse->nodeValue = $_POST['adresselaboratoire'];
     
    $unite = $xml->createElement('unite');
    $unite->nodeValue = $_POST['unitelaboratoire'];
     
    
    $laboratoire->appendChild($idlaboratoire);
    $laboratoire->setIdAttribute($idlaboratoire,true);
     
    $laboratoire->appendChild($nom);
    $laboratoire->appendChild($adresse);
    $laboratoire->appendChild($unite);
    
     
    $laboratoires->appendChild($laboratoire);

    htmlentities($xml->save('GlobalXML.xml'));
     
    header('Location:entreprises.html');

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
     <label for="name">ID du laboratoire</label>
     <input type="text" name="idlaboratoire" />
     </br>
    <label for="name">Nom du laboratoire</label>
     <input type="text" name="nomlaboratoire" />
     </br>
    <label for="name">Adrese du laboratoire</label>
    <input type="text-address" name="adresselaboratoire"/>
    </br>
    <label for="name">Unite</label>
    <input type="text-unite" name="unitelaboratoire"/>
   </br>
     <input name="submit" type="submit"/>
 </form>