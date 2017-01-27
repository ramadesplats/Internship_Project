<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');
     
    $searchNode = $xml->getElementsByTagName("po");
    
    $idtest = $xml->createElement('idPo');
    $idtest->nodeValue = $_POST['idpo'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idPo');
        
        if($valueID == $idtest->nodeValue ){
            echo '<script>window.alert("this idPo is already used"); window.location.href = "pos.html"; </script>';
            die();
        }
     }

    $pos = $xml->getElementsByTagName('pos')->item(0);
    $po = $xml->createElement('po');
     
    $idpo = $xml->createAttribute('idPO');
    $idpo->nodeValue = $_POST['idpo'];

    $intitule = $xml->createElement('intitule');     
    $intitule->nodeValue = $_POST['intitulepo'];

    $depart= $xml->createElement('departement');
    $depart->nodeValue = $_POST['departementpo'];
    
    $po->appendChild($idpo);
    $po->setIdAttribute($idpo,true);
     
    $po->appendChild($intitule);
    $po->appendChild($depart);
     
    $pos->appendChild($po);

    htmlentities($xml->save('GlobalXML.xml'));
     
    header('Location:pos.html');

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
     <label for="name">ID de la PO</label>
      <input type="text" name="idpo" />
     </br>
    <label for="name">Intitule de la PO</label>
      <input type="text" name="intitulepo" />
     </br>
    <label for="name">Departement</label>
    <input type="text" name="departementpo"/>
    </br>
     <input name="submit" type="submit"/>
 </form>