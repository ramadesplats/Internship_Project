<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');

    $rapports = $xml->getElementsByTagName('rapports')->item(0);
    $rapport = $xml->createElement('rapport');
     
    $idrapport = $xml->createAttribute('idrapport');
    $idrapport->nodeValue = $_POST['idrapport'];
    $rapport->appendChild($idrapport);
    $rapport->setIdAttribute($idrapport,true);
     
    $intitule = $xml->createElement('intitule');
    $intitule->nodeValue = $_POST['intitule'];
    $rapport->appendChild($intitule);
      
    $noterapport = $xml->createElement('note_rapporteur');
    $noterapport->nodeValue = $_POST['noterapporteur'];
    $rapport->appendChild($noterapport);
     
    $notejury = $xml->createElement('note_jury');
    $notejury->nodeValue = $_POST['notejury'];
    $rapport->appendChild($notejury);
     
    $enseignantsupp = $xml->createElement('soutenance');
    $idenseignantsupp = $xml->createAttribute('idenseignant');
    $idenseignantsupp->nodeValue = $_POST['idenseignantrapporteur'];
    $enseignantsupp->appendChild($idenseignantsupp);
    $enseignantsupp->setIdAttribute($idenseignantsupp,true);
    $rapport->appendChild($enseignantsupp);
    
    if("" != trim($_POST['idenseignant1'])){
        $rapportens = $xml->createElement('rapport_enseignant');
        $idens = $xml->createAttribute('idenseignant');
        $idens->nodeValue = $_POST['idenseignant1'];
        $rapportens->appendChild($idens);
        $rapportens->setIdAttribute($idens,true);
        $rapport->appendChild($rapportens);
    }
    if("" != trim($_POST['idenseignant2'])){
        $rapportens = $xml->createElement('rapport_enseignant');
        $idens = $xml->createAttribute('idenseignant');
        $idens->nodeValue = $_POST['idenseignant2'];
        $rapportens->appendChild($idens);
        $rapportens->setIdAttribute($idens,true);
        $rapport->appendChild($rapportens);
    }
    if("" != trim($_POST['idenseignant3'])){
        $rapportens = $xml->createElement('rapport_enseignant');
        $idens = $xml->createAttribute('idenseignant');
        $idens->nodeValue = $_POST['idenseignant3'];
        $rapportens->appendChild($idens);
        $rapportens->setIdAttribute($idens,true);
        $rapport->appendChild($rapportens);
    }
     
    if("" != trim($_POST['idsoutenance'])){
        $soutenance = $xml->createElement('soutenance');
        $idsoutenance = $xml->createAttribute('idSoutenance');
        $idsoutenance->nodeValue = $_POST['idsoutenance'];
        $soutenance->appendChild($idsoutenance);
        $soutenance->setIdAttribute($idsoutenance,true);
        $rapport->appendChild($soutenance);
    }
     
    $rapports->appendChild($rapport);

    htmlentities($xml->save('GlobalXML.xml'));
     
    header('Location:rapports.html');

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
     <label for="name">ID du rapport</label>
     <input type="text" name="idrapport" />
     </br> 
    <label for="name">Intitule du rapport</label>
    <input type="text" name="intitule" />
     </br>
    <label for="name">Note rapporteur</label>
    <input type="text" name="noterapporteur" />
     </br>
    <label for="name">Note jury</label>
    <input type="text" name="notejury" />
     </br>
    <label for="name">ID Enseignant rapporteur</label>
    <input type="text" name="idenseignantrapporteur" />
     </br>
    <label for="name">ID de l'enseignant 1</label>
     <input type="text" name="idenseignant1" />
     </br>
    <label for="name">ID de l'enseignant 2</label>
    <input type="text" name="idenseignant2" />
     </br>
    <label for="name">ID de l'enseignant 3</label>
    <input type="text" name="idenseignant3" />
     </br>
    <label for="name">ID de la soutenance</label>
     <input type="text" name="idsoutenance" />
     </br>
     <input name="submit" type="submit"/>
 </form>