<main class="newConvention">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/black-tie/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<script>
  $( function() 
  {
    $( "#datepicker" ).datepicker();
    $( "#datepicker2" ).datepicker();
  } 
  );
  	</script>
	<h1>Nouvelle convention</h1>
	<form method="POST" action="">
		<p>
			<label for="listeEntreprise">Choisir une entreprise</label>
			<select name="listeEntreprise[]" id="listeEnteprise">
			<?php
	 		while ($donnees = $allEntreprises->fetch())
			{?>
	           <option value=" <?php echo $donnees['id_client']; ?>"> <?php echo $donnees['nom_societe']; ?></option>
			<?php
			}
			$allEntreprises->closeCursor();
			?>
			</select>
		</p>
		<p>
			<label for="listeEtudiant">Choisir un etudiant</label>
			<select name="listeEtudiant[]" id="listeEtudiant" multiple size = 5>
			<?php
	 		while ($donnees = $allEtudiants->fetch())
			{?>
	           <option value=" <?php echo $donnees['id_etudiant']; ?>" title="Pour selectionner plusieurs étudiants maintenir ctrl"> <?php echo $donnees['nom']; ?></option>
			<?php
			}
			$allEtudiants->closeCursor();
			?>
			</select>
		</p>
		<p><label for="date_debut">Date de début:</label> <input type="date" id="date_debut" name="date_debut"></p>
		<p><label for="date_fin">Date de fin:</label> <input type="date" id="date_fin" name="date_fin"></p>
		<p><label for="montant">Montant</label> : <input step="0.01" type="number" name="montant" id="montant" /></p>
		<p><label for="sujet">Sujet</label> : <input type="text" name="sujet" id="sujet" /></p>


    <p><button >Ajouter Convention</button></p>
	</form>
</main>
