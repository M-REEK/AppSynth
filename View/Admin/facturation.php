<main>
    <section class="facturation">
      <h1>Liste des Factures</h1>
        <?php foreach ($allFacture as $fac): ?>
            <div class="facture">
                <div>
                    <p>Convention n° <?= $fac['id_convention'] ?></p>
                    <p>Sujet : <?= $fac['sujet'] ?></p>
                    <p>Montant : <?= $fac['montant'] ?></p>
                    <p>Montant_reglé : <?= $fac['montant_regle'] ?></p>
                    <p>Montant_du : <?= $fac['montant']-$fac['montant_regle'] ?></p>
                    <p><a href="nouveauReglement?id=<?= $fac['id_convention'] ?>">Ajouter un reglement à la convention<i class="fas fa-plus-circle"></i></a></p>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>
