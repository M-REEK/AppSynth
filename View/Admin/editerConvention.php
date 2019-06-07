<main>
	<section class="editionConvention">
			<h1>Editer une convention (EN COURS DE DEVELOPPEMENT : MODIFICATION NON FONCTIONNELLE)</h1>
			<div class="editer">
				<form action="" method="POST">
					<div class="form">
						<p><span class="gauche">Nom de l'entreprise : <?= $convention['nom_societe']?></span><span class="droite"><label for=>&nbspModifier : </label><input type="text" name="modif_nom" id="modif_nom"/><button>Valider</button></span>
						</p>
					</div>
					<div class="form">
						<p><span class="gauche">Prenom des étudiants : <?php
						use AppliSynth\Core\Manager;
						$manager = new Manager();
        				$req = $manager->dbConnect();
                              $names = $req->query('SELECT nom, prenom
                                                  FROM table_etudiant te, table_convention_etudiant tce
                                                  WHERE tce.id_convention = ' . $convention['id_convention'] .
                                                  ' AND tce.id_etudiant = te.id_etudiant');
                              foreach ($names as $name):
                          ?>
                          <div>
                          <?= $name['nom'] . ' ' . $name['prenom'] ?>
                          </div>
                          <?php endforeach; ?></span><span class="droite"><label for=>&nbspModifier : </label><input type="text" name="modif_prenom" id="modif_prenom"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Montant : <?= $convention['montant']?></span><span class="droite"><label for=>&nbspModifier : </label><input type="text" name="modif_DOB" id="modif_DOB"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Date de début : <?= $convention['date_debut']?></span><span class="droite"><label for=>&nbspModifier : </label><input type="text" name="modif_adresse" id="modif_adresse"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Date de fin : <?= $convention['date_fin']?></span><span class="droite"><label for=>&nbspModifier : </label><input type="text" name="modif_CP" id="modif_CP"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Sujet : <?= $convention['sujet']?></span><span class="droite"><label for=>&nbspModifier : </label><input type="text" name="modif_telephone" id="modif_telephone"/><button>Valider</button></span></p>
					</div>
					<div class="form">
						<p><span class="gauche">Date de facture : <?= $convention['date_facture']?></span><span class="droite"><label for=>&nbspModifier : </label><input type="text" name="modif_email" id="modif_email"/><button>Valider</button></span></p>
					</div>
				</form>
				
			</div>
	</section>
</main>
