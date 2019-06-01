<main>
    <section>
        <p><a href="nouvelle-convention">Ajouter une convention <i class="fas fa-plus-circle"></i></a></p>
        <?php foreach($allConventions as $c): ?>
            <div class="conventions">
                <div>Numéro convention : <?= $c['id_convention'] ?></div>
                <div>Entreprises : <?= $c['nom_societe'] ?></div>
                <div>Etudiant(s) :
                    <?php 
                        $names = $req->query('SELECT nom, prenom 
                                            FROM table_etudiant te, table_convention_etudiant tce 
                                            WHERE tce.id_convention = ' . $c['id_convention'] . 
                                            ' AND tce.id_etudiant = te.id_etudiant');
                        foreach ($names as $name):
                    ?> 
                    <?= $name['nom'] . ' ' . $name['prenom'] ?> /
                    <?php endforeach; ?>
                </div>
                <div>Montant : <?= $c['montant'] ?></div>
                <div><?= $c['statut_projet'] ?></div>
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
        <?php endforeach; ?>
    </section>
</main>