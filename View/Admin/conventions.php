<main>
    <section>
        <p><a href="nouvelle-convention">Ajouter une convention <i class="fas fa-plus-circle"></i></a></p>
        <?php foreach($allConventions as $c): ?>
            <div class="conventions">
                <div>Numéro convention : <?= $c['id_convention'] ?></div>
                <div class="infos">
                  <div>
                    <div>Entreprises : <?= $c['nom_societe'] ?></div>
                    <div>Etudiant(s) :
                      <div class="listeEtu">
                          <?php
                              $names = $req->query('SELECT nom, prenom
                                                  FROM table_etudiant te, table_convention_etudiant tce
                                                  WHERE tce.id_convention = ' . $c['id_convention'] .
                                                  ' AND tce.id_etudiant = te.id_etudiant');
                              foreach ($names as $name):
                          ?>
                          <div>
                          <?= $name['nom'] . ' ' . $name['prenom'] ?>
                          </div>
                          <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                  <div class="listeInfos">
                    <div>Montant : <?= $c['montant'] ?></div>
                    <div>Statut: <?= $c['statut_projet'] ?></div>
                    <div>
                        <?php
                            $reglements = $req->query('SELECT montant_regle
                                                    FROM table_reglement tr
                                                    WHERE tr.id_convention = ' . $c['id_convention']);
                            foreach ($reglements as $reglement):
                        ?>
                        <?= ($reglement['montant_regle']) ? 'Montant réglé : ' . $reglement['montant_regle'] : 'Aucun montant réglé' ?>
                        <?php endforeach; ?>
                    </div>
                  </div>
                </div>
                <div class="pics">
                  <a href="editerConvention?id=<?= $c['id_convention'] ?>" title="Editer"><i class="fas fa-pencil-alt"></i></a> <a href="conventionPDF?id=<?= $c['id_convention'] ?>" title="Visualiser"><i class="far fa-eye"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>