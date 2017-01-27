<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');

    $jurys = $xml->getElementsByTagName('jurys')->item(0);
    $jury = $xml->createElement('jury');
     
    $idjury = $xml->createAttribute('idJury');
    $idjury->nodeValue = $_POST['idjury'];
    $jury->appendChild($idjury);
    $jury->setIdAttribute($idjury,true);
    
    if("" != trim($_POST['idenseignant1'])){
        $juryens = $xml->createElement('jury_enseignant');
        $idens = $xml->createAttribute('idenseignant');
        $idens->nodeValue = $_POST['idenseignant1'];
        $juryens->appendChild($idens);
        $juryens->setIdAttribute($idrens,true);
        $jury->appendChild($juryens);
    }
    if("" != trim($_POST['idenseignant2'])){
        $juryens = $xml->createElement('jury_enseignant');
        $idens = $xml->createAttribute('idenseignant');
        $idens->nodeValue = $_POST['idenseignant2'];
        $juryens->appendChild($idens);
        $juryens->setIdAttribute($idrens,true);
        $jury->appendChild($juryens);
    }
    if("" != trim($_POST['idenseignant3'])){
        $juryens = $xml->createElement('jury_enseignant');
        $idens = $xml->createAttribute('idenseignant');
        $idens->nodeValue = $_POST['idenseignant3'];
        $juryens->appendChild($idens);
        $juryens->setIdAttribute($idrens,true);
        $jury->appendChild($juryens);
    }
     
    if("" != trim($_POST['idmaitredestage1'])){
        $maitredestage = $xml->createElement('jury_maitre_de_stage');
        $idmaitre = $xml->createAttribute('idmaitre_de_stage');
        $idmaitre->nodeValue = $_POST['idmaitredestage1'];
        $maitredestage->appendChild($idmaitre);
        $maitredestage->setIdAttribute($idmaitre,true);
        $jury->appendChild($maitredestage);
    }
    if("" != trim($_POST['idmaitredestage2'])){
        $maitredestage = $xml->createElement('jury_maitre_de_stage');
        $idmaitre = $xml->createAttribute('idmaitre_de_stage');
        $idmaitre->nodeValue = $_POST['idmaitredestage2'];
        $maitredestage->appendChild($idmaitre);
        $maitredestage->setIdAttribute($idmaitre,true);
        $jury->appendChild($maitredestage);
    }
    if("" != trim($_POST['idmaitredestage3'])){
        $maitredestage = $xml->createElement('jury_maitre_de_stage');
        $idmaitre = $xml->createAttribute('idmaitre_de_stage');
        $idmaitre->nodeValue = $_POST['idmaitredestage3'];
        $maitredestage->appendChild($idmaitre);
        $maitredestage->setIdAttribute($idmaitre,true);
        $jury->appendChild($maitredestage);
    }
     
    if("" != trim($_POST['idtuteur1'])){
        $tuteur = $xml->createElement('jury_tuteur');
        $idtut = $xml->createAttribute('idtuteur');
        $idtut->nodeValue = $_POST['idtuteur1'];
        $tuteur->appendChild($idtut);
        $tuteur->setIdAttribute($idtut,true);
        $jury->appendChild($tuteur);
    }
    if("" != trim($_POST['idtuteur2'])){
        $tuteur = $xml->createElement('jury_tuteur');
        $idtut = $xml->createAttribute('idtuteur');
        $idtut->nodeValue = $_POST['idtuteur2'];
        $tuteur->appendChild($idtut);
        $tuteur->setIdAttribute($idtut,true);
        $jury->appendChild($tuteur);
    }
    if("" != trim($_POST['idtuteur3'])){
        $tuteur = $xml->createElement('jury_tuteur');
        $idtut = $xml->createAttribute('idtuteur');
        $idtut->nodeValue = $_POST['idtuteur3'];
        $tuteur->appendChild($idtut);
        $tuteur->setIdAttribute($idtut,true);
        $jury->appendChild($tuteur);
    }
     
    $jurys->appendChild($jury);

    htmlentities($xml->save('GlobalXML.xml'));
     
    header('Location:jurys.html');

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
    <label for="name">ID du jury</label>
     <input type="text" name="idjury" />
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
    <label for="name">ID du maitre de stage 1</label>
    <input type="text" name="idmaitredestage1" />
     </br>
    <label for="name">ID du maitre de stage 2</label>
    <input type="text" name="idmaitredestage2" />
     </br>
    <label for="name">ID du maitre de stage 3</label>
    <input type="text" name="idmaitredestage3" />
     </br>
    <label for="name">ID du tuteur 1</label>
    <input type="text" name="idtuteur1" />
     </br>  
    <label for="name">ID du tuteur 2</label>
    <input type="text" name="idtuteur2" />
     </br> 
    <label for="name">ID du tuteur 3</label>
    <input type="text" name="idtuteur3" />
     </br>  
     <input name="submit" type="submit"/>
 </form>