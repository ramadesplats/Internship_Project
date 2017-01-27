xquery version "1.0";

<ex>

<questune>
	{count(
	for $sta in //stages/stage
	where //rapports/rapport[@idRapport=$sta/rapport/@idrapport]/soutenance
	return $sta/intitule
	)}
</questune>

<questdeux>
	{count(
	for $sta in //stages/stage
	where not(//rapports/rapport[@idRapport=$sta/rapport/@idrapport]/soutenance)
	return $sta/intitule
	)}
</questdeux>

<questtrois>
	{count(
	for $mds in //maitredestages/maitredestage
	where $mds/industriel
	return //responsables/responsable[@idPersonne=$mds/@idresponsable]
	)}
</questtrois>

<questquartre>
	{ 
	for $po in //pos/po
	return
	<po name="{$po/intitule}">
		<moyenne>
			{count(
			for $edu in //etudiants/etudiant
			for $sta in //stages/stage 
			where $sta/po[@idpo=$po/@idPo] and $sta/stagiaire[@idetudiant=$edu/@idPersonne] 
			return 
				let $moyenne:=(
					let $note_sout:=number(
						for $rap in //rapports/rapport
						where $rap[@idRapport=$sta/rapport/@idrapport]
						return if (exists($rap/soutenance)) then (//soutenances/soutenance[@idSoutenance=$rap/soutenance/@idSoutenance]/note_soutenance) else 0
					)
					let $note_rap:=(
						for $rap in //rapports/rapport
						where $rap[@idRapport=$sta/rapport/@idrapport]
						return ($rap/note_rapporteur+$rap/note_jury) div 2
						)
					let $note_eval:=number(//evalsTechnique/evaluation[@idEvalTechnique=$sta/evaltechnique/@idevaltech]/note)
					return if (exists(//rapports/rapport[@idRapport=$sta/rapport/@idrapport]/soutenance)) then ($note_eval+$note_rap+$note_sout) div 3 else ($note_eval+$note_rap+$note_sout) div 2
				)
				return if ($moyenne>=10) then (<etudiant name="{$edu/nom}">{$moyenne}</etudiant>) else ()
			)}
		</moyenne>
		<pas_moyenne>
			{count(
			for $edu in //etudiants/etudiant
			for $sta in //stages/stage 
			where $sta/po[@idpo=$po/@idPo] and $sta/stagiaire[@idetudiant=$edu/@idPersonne] 
			return 
				
				let $moyenne:=(
					let $note_sout:=number(
						for $rap in //rapports/rapport
						where $rap[@idRapport=$sta/rapport/@idrapport]
						return if (exists($rap/soutenance)) then (//soutenances/soutenance[@idSoutenance=$rap/soutenance/@idSoutenance]/note_soutenance) else 0
					)
					let $note_rap:=(
						for $rap in //rapports/rapport
						where $rap[@idRapport=$sta/rapport/@idrapport]
						return ($rap/note_rapporteur+$rap/note_jury) div 2
						)
					let $note_eval:=number(//evalsTechnique/evaluation[@idEvalTechnique=$sta/evaltechnique/@idevaltech]/note)
					return if (exists(//rapports/rapport[@idRapport=$sta/rapport/@idrapport]/soutenance)) then ($note_eval+$note_rap+$note_sout) div 3 else ($note_eval+$note_rap+$note_sout) div 2
				)
				return if ($moyenne<10) then (<etudiant name="{$edu/nom}">{$moyenne}</etudiant>) else ()
			)}
		</pas_moyenne>
	</po>
	}
</questquartre>

<questcinq>
    {count(
    for $etu in //etudiants/etudiant
    return
    if (exists(//maitredestages/maitredestage[@idMaitredestage=//stages/stage[stagiaire[@idetudiant=$etu/@idPersonne]]/maitredestage/@idmaitredestage]/industriel)) then $etu  else ()
    )}
</questcinq>

<questsix>
    {count(
    for $etu in //etudiants/etudiant
    return
    if (exists(//maitredestages/maitredestage[@idMaitredestage=//stages/stage[stagiaire[@idetudiant=$etu/@idPersonne]]/maitredestage/@idmaitredestage]/chercheur)) then $etu  else ()
    )}
</questsix>

<questsept>
	{
	for $po in //pos/po
	return 
	<po name="{$po/intitule}">
		{count(
		for $sta in //stages/stage
		where $sta/po[@idpo=$po/@idPo]
		return $sta/intitule
		)}
	</po>
	}
</questsept>

<questhuit>
	{
	for $po in //pos/po
	return 
	<po name="{$po/intitule}">
		{count(
		for $sta in //stages/stage
		where $sta/po[@idpo=$po/@idPo]
		return 
			for $ens in //enseignants/enseignant
			where $ens[@idEnseignant=//tuteurs/tuteur[@idTuteur=$sta/tuteur/@idtuteur]/enseignant_tuteur/@idenseignant]
			return //responsables/responsable[@idPersonne=$ens/responsable_enseignant/@idresponsable]
		)}
	</po>
	}
</questhuit>

<questneuf>
	{
	for $po in //pos/po
	return 
	<po name="{$po/intitule}">
		{let $somme_note:=0
		let $nb_sou:=count(
			for $sta in //stages/stage 
			where $sta/po[@idpo=$po/@idPo]
			return //soutenances/soutenance[@idSoutenance=//rapports/rapport[@idRapport=$sta/rapport/@idrapport]/soutenance/@idSoutenance])
		let $somme_note:=sum(
			for $sta in //stages/stage 
			where $sta/po[@idpo=$po/@idPo]
			return //soutenances/soutenance[@idSoutenance=//rapports/rapport[@idRapport=$sta/rapport/@idrapport]/soutenance/@idSoutenance]/note_soutenance)
		 return $somme_note div $nb_sou}
	</po>
	}
</questneuf>


<questdix>
	{ 
	for $ent in //entreprises/entreprise
	return
	<entreprise name="{$ent/nom}">
		<stageplus14>
			{count(
			for $sta in //stages/stage 
			where //maitredestages/maitredestage[@idMaitredestage=$sta/maitredestage/@idmaitredestage]/industriel[@idEntrepr=$ent/@idEtablissement]
			return 
			
				let $moyenne:=(
					let $note_sout:=number(
						for $rap in //rapports/rapport
						where $rap[@idRapport=$sta/rapport/@idrapport]
						return if (exists($rap/soutenance)) then (//soutenances/soutenance[@idSoutenance=$rap/soutenance/@idSoutenance]/note_soutenance) else 0
					)
					let $note_rap:=(
						for $rap in //rapports/rapport
						where $rap[@idRapport=$sta/rapport/@idrapport]
						return ($rap/note_rapporteur+$rap/note_jury) div 2
						)
					let $note_eval:=number(//evalsTechnique/evaluation[@idEvalTechnique=$sta/evaltechnique/@idevaltech]/note)
					return if (exists(//rapports/rapport[@idRapport=$sta/rapport/@idrapport]/soutenance)) then ($note_eval+$note_rap+$note_sout) div 3 else ($note_eval+$note_rap+$note_sout) div 2
				)
				return if ($moyenne>=14) then ($sta/intitule) else ()
			)}
		</stageplus14>
		<etudmoins11>
			{count(
			for $sta in //stages/stage 
				where //maitredestages/maitredestage[@idMaitredestage=$sta/maitredestage/@idmaitredestage]/industriel[@idEntrepr=$ent/@idEtablissement]
				return 
				
					let $moyenne:=(
						let $note_sout:=number(
							for $rap in //rapports/rapport
							where $rap[@idRapport=$sta/rapport/@idrapport]
							return if (exists($rap/soutenance)) then (//soutenances/soutenance[@idSoutenance=$rap/soutenance/@idSoutenance]/note_soutenance) else 0
						)
						let $note_rap:=(
							for $rap in //rapports/rapport
							where $rap[@idRapport=$sta/rapport/@idrapport]
							return ($rap/note_rapporteur+$rap/note_jury) div 2
							)
						let $note_eval:=number(//evalsTechnique/evaluation[@idEvalTechnique=$sta/evaltechnique/@idevaltech]/note)
						return if (exists(//rapports/rapport[@idRapport=$sta/rapport/@idrapport]/soutenance)) then ($note_eval+$note_rap+$note_sout) div 3 else ($note_eval+$note_rap+$note_sout) div 2
					)
					return if ($moyenne<11) then (//etudiants/etudiant[@idPersonne=$sta/stagiaire/@idetudiant]/nom) else ()
			)}
		</etudmoins11>
	</entreprise>
	}
</questdix>

</ex>


