<main>
    <section class="facturation">
        <p><a href="nouveauReglement">Ajouter un reglement <i class="fas fa-plus-circle"></i></a></p>
        <?php foreach ($allFacture as $fac): ?>
            <div class="facture">
                <div>
                    <p>Numero convention : <?= $fac['id_convention'] ?></p>
                    <p>Montant : <?= $fac['montant'] ?></p>
                    <p>Montant_reglé : <?= $fac['montant_regle'] ?></p>
                    <p>Montant_du : <?= $fac['montant']-$fac['montant_regle'] ?></p>
                    <p>Sujet : <?= $fac['sujet'] ?></p>
                    <p><a href="nouveauReglement?id=<?= $fac['id_convention'] ?>">Ajouter un reglement à la convention<i class="fas fa-plus-circle"></i></a></p>
                    </p>
                </div>


            </div>
        <?php endforeach; ?>
    </section>
</main>
