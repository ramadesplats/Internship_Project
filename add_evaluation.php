<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');
     
    $searchNode = $xml->getElementsByTagName("evaluation");
    
    $idtest = $xml->createElement('idEvalTechnique');
    $idtest->nodeValue = $_POST['idevaluation'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idEvalTechnique');
        
        if($valueID == $idtest->nodeValue ){
            echo '<script>window.alert("this idEvalTechnique is already used"); window.location.href = "index.html"; </script>';
            die();
        }
     }
     
    $searchNode = $xml->getElementsByTagName("maitredestage");
    
    $idtestmaitre = $xml->createElement('idmaitredestage');
    $idtestmaitre->nodeValue = $_POST['maitredestage'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idPersonne');
        
        if($valueID == $idtestmaitre->nodeValue ){

            $evalsTechnique = $xml->getElementsByTagName('evalsTechnique')->item(0);
            $evaluation = $xml->createElement('evaluation');

            $idevaluation = $xml->createAttribute('idEvaluation');
            $idevaluation->nodeValue = $_POST['idevaluation'];

            $comminte = $xml->createElement('commIntegration');     
            $comminte->nodeValue = $_POST['comminte'];

            $commtech = $xml->createElement('commTechnique');
            $commtech->nodeValue = $_POST['commetech'];

            $commcomm = $xml->createElement('commCommunication');
            $commcomm->nodeValue = $_POST['commecomm'];

            $note= $xml->createElement('note');
            $note->nodeValue = $_POST['note'];

            $evaluation->appendChild($idevaluation); 
            $evaluation->setIdAttribute($idevaluation,true);

            $evaluation->appendChild($comminte);
            $evaluation->appendChild($commtech);
            $evaluation->appendChild($commcomm);
            $evaluation->appendChild($note);

            $maitre = $xml->createElement('maitredestage');
            $idmaitre = $xml->createAttribute('idmaitredestage');
            $idmaitre->nodeValue = $_POST['maitredestage'];
            $maitre->appendChild($idmaitre);
            $maitre->setIdAttribute($idmaitre,true);
            $evaluation->appendChild($maitre);

            $evalsTechnique->appendChild($evaluation);

            htmlentities($xml->save('GlobalXML.xml'));

            header('Location:evaluations.html');
            die();
        }
    }
    echo '<script>window.alert("no maitredestage with this id has been found"); window.location.href = "evaluation.html"; </script>';
    die();

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
     <label for="name">ID de l'evaluation</label>
     <input type="text" name="idevaluation" />
     </br>
    <label for="name">Commentaire integration</label>
     <input type="text" name="comminte" />
     </br>
    <label for="name">Commentaire Technique</label> 
    <input type="text" name="commtech"/>
    </br>
    <label for="name">Commentaire Communication</label>
    <input type="text" name="commecomm"/>
   </br>
    <label for="name">Note </label>
    <input type="text" name="note"/>
   </br>
    <label for="name">Maitre de Stage associé</label>
    <input type="text" name="maitredestage"/>
   </br>
     <input name="submit" type="submit"/>
 </form>