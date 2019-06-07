<main>
	<section class="editionEtudiant">
			<h1>Editer une étudiant</h1>
			<div class="editer">
				<form action="" method="POST">
					<div class="form">
						<p><span class="gauche">Nom de l'étudiant : <?= $etudiant['nom']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Prenom de l'étudiant : <?=$etudiant['prenom']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_prenom" id="modif_prenom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Date de naissance : <?= $etudiant['dateDeNaissance']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_DOB" id="modif_DOB"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Adresse : <?= $etudiant['adresse']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_adresse" id="modif_adresse"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Code postal : <?= $etudiant['code_postal']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_CP" id="modif_CP"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Telephone : <?= $etudiant['telephone']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_telephone" id="modif_telephone"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">E-mail : <?= $etudiant['email']?></span><span class="droite"><label for=>Modifier : </label><input type="text" name="modif_email" id="modif_email"/><button>Valider</button></span></p>
					</div>
				</form>

			</div>
	</section>
</main>
