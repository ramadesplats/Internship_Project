<?xml version="1.0" encoding="UTF-8" ?>


<xsl:stylesheet exclude-result-prefixes="xs xdt err fn" version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:err="http://www.w3.org/2005/xqt-errors" xmlns:fn="http://www.w3.org/2005/xpath-functions" xmlns:xdt="http://www.w3.org/2005/xpath-datatypes" xmlns:xs="http://www.w3.org/2001/XMLSchema">
	<xsl:output indent="yes" method="xml" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"/>
	<xsl:output name="daypage" method="html" doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN"/>
	<xsl:template match="//etudiants">
		<h2>LISTE DES ETUDIANTS</h2>
		<table>
			<tr>
				<th>NOM</th>
				<th>PRENOM</th>
				<th>DATE</th>
			</tr>
			<xsl:for-each select="etudiant">
				<tr>
					<td>
						<xsl:value-of select="nom"/>
					</td>
					<td>
						<xsl:value-of select="prenom"/>
					</td>
					<td>
						<xsl:value-of select="date_naissance"/>
					</td>
				</tr>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="//responsables/responsable">
		<tr>
			<td>
				<xsl:value-of select="nom"/>
			</td>
			<td>
				<xsl:value-of select="prenom"/>
			</td>
			<td>
				<xsl:value-of select="date_naissance"/>
			</td>
			<td>
				<xsl:value-of select="fonction"/>
			</td>
			<td>
				<xsl:value-of select="telephone"/>
			</td>
			<td>
				<xsl:value-of select="email"/>
			</td>
		</tr>
	</xsl:template>
	<xsl:template match="/RefGlobale/enseignants">
		<h2>LISTE DES ENSEIGNANTS</h2>
		<table>
			<tr>
				<th>NOM</th>
				<th>PRENOM</th>
				<th>DATE</th>
				<th>FONCTION</th>
				<th>TELEPHONE</th>
				<th>E MAIL</th>
			</tr>
			<xsl:for-each select="enseignant/responsable_enseignant">
				<xsl:variable name="id" select="@idresponsable"/>
				<xsl:apply-templates select="//responsables/responsable[@idPersonne=$id]"/>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="//maitredestages">
		<h2>LISTE DES MAITRES DE STAGE</h2>
		<table>
			<tr>
				<th>NOM</th>
				<th>PRENOM</th>
				<th>DATE</th>
				<th>FONCTION</th>
				<th>TELEPHONE</th>
				<th>E MAIL</th>
			</tr>
			<xsl:for-each select="maitredestage">
				<xsl:variable name="id" select="@idresponsable"/>
				<xsl:apply-templates select="//responsables/responsable[@idPersonne=$id]"/>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="//entreprises">
		<h2>LISTE DES ENTREPRISES</h2>
		<table>
			<tr>
				<th>NOM</th>
				<th>ADRESSE</th>
				<th>SIRET</th>
			</tr>
			<xsl:for-each select="entreprise">
				<tr>
					<td>
						<xsl:value-of select="nom"/>
					</td>
					<td>
						<xsl:value-of select="adresse"/>
					</td>
					<td>
						<xsl:value-of select="siret"/>
					</td>
				</tr>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="//laboratoires">
		<h2>LISTE DES LABORATOIRES</h2>
		<table>
			<tr>
				<th>NOM</th>
				<th>ADRESSE</th>
				<th>UNITE</th>
			</tr>
			<xsl:for-each select="laboratoire">
				<tr>
					<td>
						<xsl:value-of select="nom"/>
					</td>
					<td>
						<xsl:value-of select="adresse"/>
					</td>
					<td>
						<xsl:value-of select="unite"/>
					</td>
				</tr>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="//pos">
		<h2>LISTE DES POs</h2>
		<table>
			<tr>
				<th>INTITULE</th>
				<th>DEPARTEMENT</th>
			</tr>
			<xsl:for-each select="po">
				<tr>
					<td>
						<xsl:value-of select="intitule"/>
					</td>
					<td>
						<xsl:value-of select="departement"/>
					</td>
				</tr>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="//stages">
		<h2>LISTE DES STAGES</h2>
		<table>
			<tr>
				<th>INTITULE</th>
				<th>MOT CLEF</th>
				<th>DUREE</th>
				<th>ANNEE</th>
				<th>PO</th>
				<th>EVAL TECHNIQUE</th>
				<th>STAGIAIRE</th>
				<th>TUTEUR</th>
				<th>MAITRE DES STAGES</th>
				<th>RAPPORT</th>
			</tr>
			<xsl:for-each select="stage">
				<tr>
					<td>
						<xsl:value-of select="intitule"/>
					</td>
					<td>
						<xsl:value-of select="motClef"/>
					</td>
					<td>
						<xsl:value-of select="duree"/>
					</td>
					<td>
						<xsl:value-of select="annee"/>
					</td>
					<td>
						<xsl:variable name="id_de_po" select="po/@idpo"/>
						<xsl:value-of select="//pos/po[@idPo=$id_de_po]/intitule"/>
					</td>
					<td>
						<xsl:variable name="id_de_eval" select="evaltechnique/@idevaltech"/>
						<xsl:value-of select="//evalsTechnique/evaluation[@idEvalTechnique=$id_de_eval]/note"/>
					</td>
					<td>
						<xsl:variable name="id_d_etudiant" select="stagiaire/@idetudiant"/>
						<xsl:value-of select="concat(//etudiants/etudiant[@idPersonne=$id_d_etudiant]/nom,' ',//etudiants/etudiant[@idPersonne=$id_d_etudiant]/prenom)"/>
					</td>
					<td>
						<xsl:variable name="id_de_tuteur" select="tuteur/@idtuteur"/>
						<xsl:variable name="id_de_enseg" select="//tuteurs/tuteur[@idTuteur=$id_de_tuteur]/enseignant_tuteur/@idenseignant"/>
						<xsl:variable name="id_de_respo" select="//enseignants/enseignant[@idEnseignant=$id_de_enseg]/responsable_enseignant/@idresponsable"/>
						<xsl:value-of select="concat(//responsables/responsable[@idPersonne=$id_de_respo]/nom,' ',//responsables/responsable[@idPersonne=$id_de_respo]/prenom)"/>
					</td>
					<td>
						<xsl:for-each select="maitredestage">
							<xsl:variable name="id_de_mstage" select="@idmaitredestage"/>
							<xsl:variable name="id_de_respo" select="//maitredestages/maitredestage[@idMaitredestage=$id_de_mstage]/@idresponsable"/>
							<xsl:value-of select="concat(//responsables/responsable[@idPersonne=$id_de_respo]/nom,' ',//responsables/responsable[@idPersonne=$id_de_respo]/prenom)"/>
							<br/>
						</xsl:for-each>
					</td>
					<td>
						<xsl:variable name="id_de_rap" select="rapport/@idrapport"/>
						<xsl:value-of select="//rapports/rapport[@idRapport=$id_de_rap]/intitule"/>
					</td>
				</tr>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="//jurys">
		<h2>LISTE DES JURYS</h2>
		<table>
			<tr>
				<th>TUTEUR</th>
				<th>ENSEIGNANTS</th>
				<th>MAITRE DE STAGES</th>
			</tr>
			<xsl:for-each select="jury">
				<tr>
					<td>
						<xsl:variable name="tut" select="jury_tuteur/@idtuteur"/>
						<xsl:variable name="ens" select="//tuteurs/tuteur[@idTuteur=$tut]/enseignant_tuteur/@idenseignant"/>
						<xsl:variable name="resp" select="//enseignants/enseignant[@idEnseignant=$ens]/responsable_enseignant/@idresponsable"/>
						<xsl:value-of select="concat(//responsables/responsable[@idPersonne=$resp]/nom,' ',//responsables/responsable[@idPersonne=$resp]/prenom)"/>
					</td>
					<td>
						<xsl:for-each select="jury_enseignant">
							<xsl:variable name="ens" select="@idenseignant"/>
							<xsl:variable name="resp" select="//enseignants/enseignant[@idEnseignant=$ens]/responsable_enseignant/@idresponsable"/>
							<xsl:value-of select="concat(//responsables/responsable[@idPersonne=$resp]/nom,' ',//responsables/responsable[@idPersonne=$resp]/prenom)"/>
							<br/>
						</xsl:for-each>
					</td>
					<td>
						<xsl:for-each select="jury_maitre_de_stage">
							<xsl:variable name="mait" select="@idmaitre_de_stage"/>
							<xsl:variable name="resp" select="//maitredestages/maitredestage[@idMaitredestage=$mait]/@idresponsable"/>
							<xsl:value-of select="concat(//responsables/responsable[@idPersonne=$resp]/nom,' ',//responsables/responsable[@idPersonne=$resp]/prenom)"/>
							<br/>
						</xsl:for-each>
					</td>
				</tr>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="//rapports">
		<h2>LISTE DES RAPPORTS</h2>
		<table>
			<tr>
				<th>Intitule</th>
				<th>Note rapporteur</th>
				<th>Note Jury</th>
				<th>Rapporteur</th>
				<th>Enseignants</th>
			</tr>
			<xsl:for-each select="rapport">
				<tr>
					<td>
						<xsl:value-of select="intitule"/>
					</td>
					<td>
						<xsl:value-of select="note_rapporteur"/>
					</td>
					<td>
						<xsl:value-of select="note_jury"/>
					</td>
					<td>
						<xsl:variable name="ens" select="enseignant_rapporteur/@idenseignant"/>
						<xsl:variable name="resp" select="//enseignants/enseignant[@idEnseignant=$ens]/responsable_enseignant/@idresponsable"/>
						<xsl:value-of select="concat(//responsables/responsable[@idPersonne=$resp]/nom,' ',//responsables/responsable[@idPersonne=$resp]/prenom)"/>
					</td>
					<td>
						<xsl:for-each select="enseignants/enseignant">
							<xsl:variable name="ens" select="@idenseignant"/>
							<xsl:variable name="resp" select="//enseignants/enseignant[@idEnseignant=$ens]/responsable_enseignant/@idresponsable"/>
							<xsl:value-of select="concat(//responsables/responsable[@idPersonne=$resp]/nom,' ',//responsables/responsable[@idPersonne=$resp]/prenom)"/>
							<br/>
						</xsl:for-each>
					</td>
				</tr>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="//soutenances">
		<h2>LISTE DES SOUTENANCES</h2>
		<table>
			<tr>
				<th>Stage</th>
				<th>Date</th>
				<th>Lieu</th>
				<th>Note</th>
				<th>Jury</th>
			</tr>
			<xsl:for-each select="soutenance">
				<tr>
					<td>
						<xsl:variable name="sout" select="@idSoutenance"/>
						<xsl:variable name="rap" select="//rapports/rapport[soutenance/@idSoutenance=$sout]/@idRapport"/>
						<xsl:value-of select="//stages/stage[rapport/@idrapport=$rap]/intitule"/>
					</td>
					<td>
						<xsl:value-of select="date"/>
					</td>
					<td>
						<xsl:value-of select="lieu"/>
					</td>
					<td>
						<xsl:value-of select="note_soutenance"/>
					</td>
					<td>
						<xsl:value-of select="jury/@idjury"/>
					</td>
				</tr>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="//evalsTechnique">
		<h2>LISTE DES EVALUATIONS TECHNIQUES</h2>
		<table>
			<tr>
				<th>Intitule du stage</th>
				<th>Commentaire d'integration</th>
				<th>Commentaire technique</th>
				<th>Commentaire communication</th>
				<th>Note</th>
				<th>Maitre de stage</th>
			</tr>
			<xsl:for-each select="evaluation">
				<tr>
					<td>
						<xsl:variable name="id_eval" select="@idEvalTechnique"/>
						<xsl:value-of select="//stages/stage[evaltechnique[@idevaltech=$id_eval]]/intitule"/>
					</td>
					<td>
						<xsl:value-of select="commIntegration"/>
					</td>
					<td>
						<xsl:value-of select="commTechnique"/>
					</td>
					<td>
						<xsl:value-of select="commCommunication"/>
					</td>
					<td>
						<xsl:value-of select="note"/>
					</td>
					<td>
						<xsl:for-each select="maitredestage">
							<xsl:variable name="id_mdsl" select="@idmaitredestage"/>
							<xsl:variable name="id_resp" select="//maitredestages/maitredestage[@idMaitredestage=$id_mdsl]/@idresponsable"/>
							<xsl:value-of select="concat(//responsables/responsable[@idPersonne=$id_resp]/nom,' ',//responsables/responsable[@idPersonne=$id_resp]/prenom)"/>
							<br/>
						</xsl:for-each>
					</td>
				</tr>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="//tuteurs">
		<h2>LISTE DES TUTEURS</h2>
		<table>
			<tr>
				<th>NOM</th>
				<th>PRENOM</th>
				<th>DATE</th>
				<th>FONCTION</th>
				<th>TELEPHONE</th>
				<th>E MAIL</th>
			</tr>
			<xsl:for-each select="tuteur/enseignant_tuteur">
				<xsl:variable name="id_ens" select="@idenseignant"/>
				<xsl:variable name="id" select="//enseignants/enseignant[@idEnseignant=$id_ens]/responsable_enseignant/@idresponsable"/>
				<xsl:apply-templates select="//responsables/responsable[@idPersonne=$id]"/>
			</xsl:for-each>
		</table>
	</xsl:template>
	<xsl:template match="/RefGlobale">
		<h1>Base de données des stages de l'INSA Toulouse</h1>
		<ul>
			<a href="index.html">Accueil </a>
			<a href="etudiants.html">Etudiants </a>
			<a href="enseignants.html">Enseignants </a>
			<a href="maitredestages.html">Maitres de Stage </a>
			<a href="tuteurs.html">Tuteurs </a>
			<a href="entreprises.html">Entreprises </a>
			<a href="laboratoires.html">Laboratoires </a>
			<a href="pos.html">POs </a>
			<a href="stages.html">Stages </a>
			<a href="jurys.html">Jurys </a>
			<a href="evaltech.html">Evaluation Technique</a>
			<a href="rapport.html">Rapports</a>
			<a href="soutenances.html">Soutenances</a>
			
		</ul>
		<br/>
		<br/>
	</xsl:template>
	<xsl:template match="/" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
		<xsl:result-document href="index.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<xsl:apply-templates select="/RefGlobale"/>
					<p> DESPLATS Rama - DE BRITO Guillaume - CHABERT Paul - BERTIERE Thomas</p>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="etudiants.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_etudiant.php">Ajouter un etudiant </a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//etudiants"/>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="enseignants.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_enseignant.php">Ajouter un enseignant</a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//enseignants"/>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="tuteurs.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_tuteur.php">Ajouter un Tuteur</a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//tuteurs"/>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="maitredestages.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_maitredestage_chercheur.php">Ajouter un maitre de stage Chercheur </a>
					<a href="add_maitredestage_indus.php">Ajouter un maitre de stage industriel </a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//maitredestages"/>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="entreprises.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_entreprise.php">Ajouter une entreprise</a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//entreprises"/>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="laboratoires.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_laboratoire.php">Ajouter un laboratoire</a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//laboratoires"/>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="pos.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_po.php">Ajouter une PO</a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//pos"/>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="stages.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_stage.php">Ajouter un stage</a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//stages"/>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="jurys.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_jury.php">Ajouter un jury</a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//jurys"/>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="evaltech.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_evalutation.php">Ajouter une Evaluation</a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//evalsTechnique"/>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="rapport.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_rapport.php">Ajouter un Rapport</a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//rapports"/>
				</body>
			</html>
		</xsl:result-document>
		<xsl:result-document href="soutenances.html" format="daypage">
			<html>
				<link rel="stylesheet" href="style.css"/>
				<head>
					<title>Bienvenue dans notre base de données</title>
				</head>
				<body>
					<a href="add_soutenance.php">Ajouter une Soutenance</a>
					<xsl:apply-templates select="/RefGlobale"/>
					<xsl:apply-templates select="//soutenances"/>
				</body>
			</html>
		</xsl:result-document>
	</xsl:template>
</xsl:stylesheet>
