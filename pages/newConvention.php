<?php require 'menu.php'; ?>
<main class="newConvention">
	<p>Création ou modification d'une convention</p>
	<div id="convention">
		<form class="" action="index.html" method="post">
			<div class="form">
				<label for="">Num convention</label>
				<input type="text" name="" value="">
			</div>
			<div class="form">
				<label for="">Entreprise</label>
				<input type="text" name="nomEntreprise" value="" placeholder="Nom entreprise">
				<input type="text" name="idEntreprise" value="" placeholder="ID entreprise">
			</div>
			<div class="form">
				<label for="">Etudiant</label>
				<input type="text" name="nomEtudiant" value="" placeholder="Nom Etudiant">
				<input type="text" name="prenomEtudiant" value=""placeholder="Prénom Etudiant">
				<input type="text" name="numEtudiant" value="" placeholder="num étudiant">
			</div>
			<div class="form">
				<label for="dateDebut">Date de début</label>
				<input id="dateDebut" type="text" name="dateDebut" value="">
				<label for="dateFin">Date de fin</label>
				<input id="dateFin" type="text" name="dateFin" value="">
			</div>
			<div class="form">
				<label for="">Montant</label>
				<input type="text" name="montant" value="">
			</div>
			<div class="form">
				<label for="sujet">Sujet</label>
				<input id="sujet" type="text" name="sujet" value="">
			</div>
			<button>Ajouter la convention</button>
		</form>
	</div>
</main>
