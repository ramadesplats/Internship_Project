<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');
     
    //** TEST idEtud **
     
    $searchNode = $xml->getElementsByTagName("etudiant");
    
    $idtest = $xml->createElement('idPersonne');
    $idtest->nodeValue = $_POST['idetud'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idPersonne');
        
        if($valueID == $idtest->nodeValue ){
            echo '<script>window.alert("this idEtud is already used"); window.location.href = "etudiants.html"; </script>';
            die();
        }
     }  
     
    $searchNode = $xml->getElementsByTagName("responsable"); 
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idPersonne');
        
        if($valueID == $idtest->nodeValue){
            echo '<script>window.alert("this idEtud is already used"); window.location.href = "etudiants.html"; </script>';
            die();
        }
     }  

    $etudiants = $xml->getElementsByTagName('etudiants')->item(0);
    $etudiant = $xml->createElement('etudiant');
     
    $idetudiant = $xml->createAttribute('idPersonne');
    $idetudiant->nodeValue = $_POST['idetud'];

    $nom = $xml->createElement('nom');     
    $nom->nodeValue = $_POST['nometud'];

    $prenom = $xml->createElement('prenom');
    $prenom->nodeValue = $_POST['prenometud'];
     
    $date = $xml->createElement('date_naissance');
    $date->nodeValue = $_POST['dateetud'];
    
    $etudiant->appendChild($idetudiant);
    $etudiant->setIdAttribute($idetudiant,true);
     
    $etudiant->appendChild($nom);
    $etudiant->appendChild($prenom);
    $etudiant->appendChild($date);
     
    $etudiants->appendChild($etudiant);

    htmlentities($xml->save('GlobalXML.xml'));
     
    header('Location:etudiants.html');

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
     <label for="name">ID de l'étudiant</label>
     <input type="text" name="idetud" />
     </br>
    <label for="name">Nom de l'étudiant</label>
     <input type="text" name="nometud" />
     </br>
    <label for="name">Prenom de l'étudiant</label>
     <input type="text" name="prenometud"/>
    </br>
    <label for="name">Date de naissance (AAAA-MM-DD) </label>
    <input type="text" name="dateetud"/>
   </br>
     <input name="submit" type="submit"/>
 </form>