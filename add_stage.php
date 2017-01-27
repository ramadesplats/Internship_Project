<?php
 if (isset($_POST['submit'])){


    $xml = new DOMDocument('1.0', 'utf-8');     
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;     
    $xml->load('GlobalXML.xml');
     
    //NO OTHER STAGE WITH THE SAME ID
     
    $searchNode = $xml->getElementsByTagName("stage");
    
    $idtest = $xml->createElement('idStage');
    $idtest->nodeValue = $_POST['idstage'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idStage');
        
        if($valueID == $idtest->nodeValue ){
            echo '<script>window.alert("this idStage is already used"); window.location.href = "index.html"; </script>';
            die();
        }
    }
     
    //TESTING PO
     
    $searchNode = $xml->getElementsByTagName("po");
    
    $idtestpo = $xml->createElement('idpo');
    $idtestpo->nodeValue = $_POST['postage'];
     
    foreach( $searchNode as $searchNode ){ 
        $valueID = $searchNode->getAttribute('idPo');
        if($valueID == $idtestpo->nodeValue ){ //coresspondance des po
            
            //TESTING Evaltechnique
            
            $searchNode2 = $xml->getElementsByTagName("evaluation");
    
            $idtesteval = $xml->createElement('idevaltechnique');
            $idtesteval->nodeValue = $_POST['evalstage'];

            foreach( $searchNode2 as $searchNode2 ){ 
                $valueID = $searchNode2->getAttribute('idEvalTechnique');
                if($valueID == $idtesteval->nodeValue ){ //coresspondance des eval
                    
                    //TESTING Stagiaire
            
                    $searchNode3 = $xml->getElementsByTagName("etudiant");

                    $idtestetud = $xml->createElement('idetudiant');
                    $idtestetud->nodeValue = $_POST['etudstage'];

                    foreach( $searchNode3 as $searchNode3 ){ 
                        $valueID = $searchNode3->getAttribute('idPersonne');
                        if($valueID == $idtestetud->nodeValue ){ //coresspondance des etud
                            
                            //TESTING tuteur

                            $searchNode4 = $xml->getElementsByTagName("tuteur");

                            $idtesttut = $xml->createElement('idtuteur');
                            $idtesttut->nodeValue = $_POST['tuteurstage'];

                            foreach( $searchNode4 as $searchNode4 ){ 
                                $valueID = $searchNode4->getAttribute('idTuteur');
                                if($valueID == $idtesttut->nodeValue ){ //coresspondance des tuteurs
                                    
                                    //TESTING maitre de stage

                                    $searchNode5 = $xml->getElementsByTagName("maitredestage");

                                    $idtestmaitre = $xml->createElement('idmaitredestage');
                                    $idtestmaitre->nodeValue = $_POST['maitrestage'];

                                    foreach( $searchNode5 as $searchNode5 ){ 
                                        $valueID = $searchNode5->getAttribute('idMaitredestage');
                                        if($valueID == $idtestmaitre->nodeValue ){ //coresspondance des maitre de stage
                                            
                                            //TESTING rapport

                                            $searchNode6 = $xml->getElementsByTagName("rapport");

                                            $idtestrapport = $xml->createElement('idrapport');
                                            $idtestrapport->nodeValue = $_POST['rapportstage'];

                                            foreach( $searchNode6 as $searchNode6 ){ 
                                                $valueID = $searchNode6->getAttribute('idRapport');
                                                if($valueID == $idtestrapport->nodeValue ){ //coresspondance des rapports

                                                    $stages = $xml->getElementsByTagName('stages')->item(0);
                                                    $stage = $xml->createElement('stage');

                                                    $idstage = $xml->createAttribute('idStage');
                                                    $idstage->nodeValue = $_POST['idstage'];

                                                    $intitule = $xml->createElement('intitule');     
                                                    $intitule->nodeValue = $_POST['nomstage'];

                                                    $motcle = $xml->createElement('motClef');
                                                    $motcle->nodeValue = $_POST['motclefstage'];

                                                    $duree = $xml->createElement('duree');
                                                    $duree->nodeValue = $_POST['dureestage'];

                                                    $annee = $xml->createElement('annee');
                                                    $annee->nodeValue = $_POST['anneestage'];

                                                    $po = $xml->createElement('po');
                                                    $idpo = $xml->createAttribute('idpo');
                                                    $idpo->nodeValue = $_POST['postage'];

                                                    $eval = $xml->createElement('evalTechnique');
                                                    $ideval = $xml->createAttribute('idevaltech');
                                                    $ideval->nodeValue = $_POST['evalstage'];

                                                    $stagiaire = $xml->createElement('stagiaire');
                                                    $idetud = $xml->createAttribute('idetudiant');
                                                    $idetud->nodeValue = $_POST['etudstage'];

                                                    $tuteur = $xml->createElement('tuteur');
                                                    $idtut = $xml->createAttribute('idtuteur');
                                                    $idtut->nodeValue = $_POST['tuteurstage'];

                                                    $maitre = $xml->createElement('maitredestage');
                                                    $idmaitre = $xml->createAttribute('idmaitredestage');
                                                    $idmaitre->nodeValue = $_POST['maitrestage'];

                                                    $rapport = $xml->createElement('rapport');
                                                    $idrapport = $xml->createAttribute('idrapport');
                                                    $idrapport->nodeValue = $_POST['rapportstage'];

                                                    $stage->appendChild($idstage);
                                                    $stage->setIdAttribute($idstage,true);

                                                    $stage->appendChild($intitule);
                                                    $stage->appendChild($motcle);
                                                    $stage->appendChild($duree);
                                                    $stage->appendChild($annee);

                                                    $po->appendChild($idpo);
                                                    $po->setIdAttribute($idpo,true); 
                                                    $stage->appendChild($po);

                                                    $eval->appendChild($ideval);
                                                    $eval->setIdAttribute($ideval,true);
                                                    $stage->appendChild($eval);

                                                    $stagiaire->appendChild($idetud);
                                                    $stagiaire->setIdAttribute($idetud,true);
                                                    $stage->appendChild($stagiaire);

                                                    $tuteur->appendChild($idtut);
                                                    $tuteur->setIdAttributes($idtut,true);
                                                    $stage->appendChild($tuteur);

                                                    $maitre->appendChild($idmaitre);
                                                    $maitre->setIdAttribute($idmaitre,true);
                                                    $stage->appendChild($maitre);

                                                    $rapport->appendChild($idrapport);
                                                    $rapport->setIdAttribute($idrapport,true);
                                                    $stage->appendChild($rapport);

                                                    $stages->appendChild($stage);

                                                    htmlentities($xml->save('GlobalXML.xml'));

                                                    header('Location:stages.html');
                                                    die();
                                                }
                                            }
                                            echo '<script>window.alert("no rapport with this id has been found"); window.location.href = "stages.html"; </script>';
                                            die();
                                        }
                                    }
                                    echo '<script>window.alert("no maitredestage with this id has been found"); window.location.href = "stages.html"; </script>';
                                    die();
                                }
                            }
                            echo '<script>window.alert("no tuteur with this id has been found"); window.location.href = "stages.html"; </script>';
                            die();
                        }
                    }
                    echo '<script>window.alert("no stagiaire with this id has been found"); window.location.href = "stages.html"; </script>';
                    die();
                }
            }
            echo '<script>window.alert("no evaltechnique with this id has been found"); window.location.href = "stages.html"; </script>';
            die();
        }
    }
    echo '<script>window.alert("no po with this id has been found"); window.location.href = "stages.html"; </script>';
    die();

 }

 ?>

<link rel="stylesheet" href="style.css" type="text/css">

 <form method="POST" action=''>
     <label for="name">ID du stage</label>
    <input type="text" name="idstage" />
     </br>
    <label for="name">Intitule du stage</label>
    <input type="text" name="nomstage" />
     </br>
    <label for="name">Mot Clefs du stage</label>
    <input type="text" name="motclefstage" />
     </br>
    <label for="name">Duree du stage</label>
    <input type="text" name="dureestage"/>
    </br>
    <label for="name">Annee du stage</label>
    <input type="text" name="anneestage"/>
   </br>
    <label for="name">ID PO</label>
     <input type="text" name="postage"/>
   </br>
    <label for="name">ID Evaluation Technique</label>
    <input type="text" name="evalstage"/>
   </br>
    <label for="name">ID Stagiaire</label>
    <input type="text" name="etudstage"/>
   </br>
    <label for="name">ID Tuteur</label>
    <input type="text" name="tuteurstage"/>
   </br>
    <label for="name">ID Maitre de Stage</label>
    <input type="text" name="maitrestage"/>
   </br>
    <label for="name">ID Rapport</label>
    <input type="text" name="rapportstage"/>
   </br>
     <input name="submit" type="submit"/>
 </form>