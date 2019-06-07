<main>
	<section class="editionEntreprise">
			<h1>Editer une entreprise</h1>
			<div class="editer">
				<form action="" method="POST">
					<div class="form">
						<p><span class="gauche">Nom de la société : <?= $entreprise['nom_societe']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Numéro de siren : <?= $entreprise['num_siren']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Email : <?= $entreprise['email']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Adresse : <?= $entreprise['adresse']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Code postal : <?= $entreprise['code_postal']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Indice de confiance : <?= $entreprise['indice_confiance']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Telephone : <?= $entreprise['telephone']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Nombres de contrats : <?= $entreprise['nb_contrats']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Argent réglé : <?= $entreprise['argent_regle']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Argent dû : <?= $entreprise['argent_du']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Argent total : <?= $entreprise['argent_total']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
				</form>
				
			</div>
	</section>
</main>
