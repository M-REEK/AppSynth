<main>
    <section class="Listes">
        <p><a href="nouveauReglement">Ajouter un reglement <i class="fas fa-plus-circle"></i></a></p>
        <?php foreach ($allFacture as $fac): ?>
            <div class="factures">
                <div>
                    <p><span>Numero convention : <?= $fac['id_convention'] ?></span>
                    <span>Montant : <?= $fac['montant'] ?></span>
                    <span>Montant_reglé : <?= $fac['montant_regle'] ?></span>
                    <span>Montant_du : <?= $fac['montant']-$fac['montant_regle'] ?></span>
                    <span>Sujet : <?= $fac['sujet'] ?></span>
                     <p><a href="nouveauReglement?id=<?= $fac['id_convention'] ?>">Ajouter un reglement à la convention<i class="fas fa-plus-circle"></i></a></p>
                    </p>
                </div>


            </div>
        <?php endforeach; ?>
    </section>
</main>