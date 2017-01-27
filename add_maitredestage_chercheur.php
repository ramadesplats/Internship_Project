<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');
     
    $searchNode = $xml->getElementsByTagName("maitredestage");
    
    $idtest = $xml->createElement('idMaitredestage');
    $idtest->nodeValue = $_POST['idmaitre'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idMaitredestage');
        
        if($valueID == $idtest->nodeValue ){
            echo '<script>window.alert("this idMaitredestage is already used"); window.location.href = "index.html"; </script>';
            die();
        }
     }
     
     
    //TEST LIEN LABORATOIRE
     
    $searchNode = $xml->getElementsByTagName("laboratoire");
    
    $idtestlabo = $xml->createElement('idLaboratoire');
    $idtestlabo->nodeValue = $_POST['idLabo'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idEtablissement');
        
        if($valueID == $idtestlabo->nodeValue){
            
            //TEST LIEN RESPONSABLE
            
            $searchNode = $xml->getElementsByTagName("responsable");
    
            $idtestresp = $xml->createElement('idresponsable');
            $idtestresp->nodeValue = $_POST['idresponsable'];

            foreach( $searchNode as $searchNode ){ 
                $valueID = $searchNode->getAttribute('idPersonne');

                if($valueID == $idtestresp->nodeValue ){

                    $maitredestages = $xml->getElementsByTagName('maitredestages')->item(0);
                    $maitredestage = $xml->createElement('maitredestage');

                    $idmaitredestage = $xml->createAttribute('idMaitredestage');
                    $idmaitredestage->nodeValue = $_POST['idmaitre'];

                    $idresponsable = $xml->createAttribute('idresponsable');
                    $idresponsable->nodeValue = $_POST['idresponsable'];

                    $maitredestage->appendChild($idmaitredestage);
                    $maitredestage->setIdAttribute($idmaitredestage,true);

                    $maitredestage->appendChild($idresponsable);
                    $maitredestage->setIdAttribute($idresponsable,true);

                    $chercheur = $xml->createElement('chercheur');
                    $idlabo = $xml->createAttribute('idEntrepr');
                    $idLabo->nodeValue = $_POST['idLabo'];
                    $chercheur->appendChild($idlabo);
                    $chercheur->setIdAttribute($idlabo,true);
                    $maitredestage->appendChild($chercheur);

                    $maitredestages->appendChild($maitredestage);

                    htmlentities($xml->save('GlobalXML.xml'));

                    header('Location:maitredestages.html');
                    die();
                }
            }
            echo '<script>window.alert("no responsable with this idPersonne has been found"); window.location.href = "evaluation.html"; </script>';
            die();
        }
    }
    echo '<script>window.alert("no laboratoire with this id has been found"); window.location.href = "evaluation.html"; </script>';
    die();

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
     <label for="name">ID du maitre de stage</label>
      <input type="text" name="idmaitre" />
     </br>
    <label for="name">ID du responsable</label>
      <input type="text" name="idresponsable" />
     </br>
    <label for="name">ID du laboratoire</label>
      <input type="text" name="idlabo" />
     </br>
     <input name="submit" type="submit"/>
 </form>