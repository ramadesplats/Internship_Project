<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');
     
    $searchNode = $xml->getElementsByTagName("soutenance");
    
    $idtest = $xml->createElement('idSoutenance');
    $idtest->nodeValue = $_POST['idsoutenance'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idSoutenance');
        
        if($valueID == $idtest->nodeValue ){
            echo '<script>window.alert("this idSoutenance is already used"); window.location.href = "index.html"; </script>';
            die();
        }
    }
     
    $searchNode = $xml->getElementsByTagName("jury");
    
    $idtestjury = $xml->createElement('idjury');
    $idtestjury->nodeValue = $_POST['idjury'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idJury');
        
        if($valueID == $idtest->nodeValue ){

            $soutenances = $xml->getElementsByTagName('soutenances')->item(0);
            $soutenance = $xml->createElement('soutenance');

            $idsoutenance = $xml->createAttribute('idsoutenance');
            $idsoutenance->nodeValue = $_POST['idsoutenance'];

            $date = $xml->createElement('date');     
            $date->nodeValue = $_POST['datesoutenance'];

            $lieu = $xml->createElement('commTechnique');
            $lieu->nodeValue = $_POST['commetech'];

            $note= $xml->createElement('note_soutenance');
            $note->nodeValue = $_POST['notesoutenance'];

            $soutenance->appendChild($idsoutenance); 
            $soutenance->setIdAttribute($idsoutenance,true);

            $soutenance->appendChild($date);
            $soutenance->appendChild($lieu);
            $soutenance->appendChild($note);

            $jury = $xml->createElement('jury');
            $idjury = $xml->createAttribute('idjury');
            $idjury->nodeValue = $_POST['notesoutenance'];
            $jury->appendChild($idjury);
            $jury->setIdAttribute($idjury,true);
            $soutenance->appendChild($jury);

            $soutenances->appendChild($soutenance);

            htmlentities($xml->save('GlobalXML.xml'));

            header('Location:soutenances.html');
            die();
        }
    }
    echo '<script>window.alert("no jury with this id has been found"); window.location.href = "index.html"; </script>';
    die();

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
    <label for="name">ID de la soutenance</label>
    <input type="text" name="idsoutenance" />
    </br>
    <label for="name">Date</label>
    <input type="text" name="datesoutenance" />
     </br>
    <label for="name">Lieu</label>
    <input type="text" name="lieusoutenance"/>
    </br>
    <label for="name">Note Soutenance</label>
    <input type="text" name="notesoutenance"/>
    </br>
    <label for="name">Id Jury</label>
    <input type="text" name="idjury"/>
    </br>
     <input name="submit" type="submit"/>
 </form>