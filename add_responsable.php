<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');
     
    $searchNode = $xml->getElementsByTagName("responsable");
    
    $idtest = $xml->createElement('idPersonne');
    $idtest->nodeValue = $_POST['idresp'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idPersonne');
        
        if($valueID == $idtest->nodeValue ){
            echo '<script>window.alert("this idPersonne is already used"); window.location.href = "index.html"; </script>';
            die();
        }
     }

    $responsables = $xml->getElementsByTagName('responsables')->item(0);
    $responsable = $xml->createElement('responsable');
     
    $idresponsable = $xml->createAttribute('idPersonne');
    $idresponsable->nodeValue = $_POST['idresp'];

    $nom = $xml->createElement('nom');     
    $nom->nodeValue = $_POST['nomresp'];

    $prenom = $xml->createElement('prenom');
    $prenom->nodeValue = $_POST['prenomresp'];
     
    $date = $xml->createElement('date_naissance');
    $date->nodeValue = $_POST['dateresp'];
     
    $fonction = $xml->createElement('fonction');
    $fonction->nodeValue = $_POST['fonctionresp'];
     
    $telephone = $xml->createElement('telephone');
    $telephone->nodeValue = $_POST['numresp'];
     
    $email = $xml->createElement('email');
    $email->nodeValue = $_POST['mailresp'];
       
    $responsable->appendChild($idresponsable);
    $responsable->setIdAttribute($idresponsable,true);
     
    $responsable->appendChild($nom);
    $responsable->appendChild($prenom);
    $responsable->appendChild($date);
    $responsable->appendChild($fonction);
    $responsable->appendChild($telephone);
    $responsable->appendChild($email);
     
    $responsables->appendChild($responsable);

    htmlentities($xml->save('GlobalXML.xml'));
     
    header('Location:responsables.html');

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
    <label for="name">ID du responsable</label>
    <input type="text" name="idresp" />
    </br>
    <label for="name">Nom du responsable</label>
    <input type="text" name="nomresp" />
    </br>
    <label for="name">Prenom du responsable</label>
    <input type="text" name="prenomresp"/>
    </br>
    <label for="name">Date de naissance (AAAA-MM-DD)</label>
    <input type="text" name="dateresp"/>
    </br>
    <label for="name">Fonction</label>
    <input type="text" name="fonctionresp"/>
   </br>
    <label for="name">Telephone</label>
    <input type="text" name="numresp"/>
   </br>
    <label for="name">Email</label>
    <input type="text" name="mailresp"/>
   </br>
     <input name="submit" type="submit"/>
 </form>