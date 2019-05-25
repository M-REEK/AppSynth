    <?php require 'menu.php' ?>
<main>

    <section>
        <p>Ajouter un etudiant <i class="fas fa-plus-circle"></i></p>
        <div>Trier par: numéro etudiant / nom / nombre convention signé / </div>
        <?php foreach ($allEtudiants as $etu): ?>
            <div class="entreprises">
                <div>
                    <p><span>Nom <?= $etu['nom'] ?></span> <span>Prenom : <?= $etu['prenom'] ?></span> <span>Numéro etudiant <?= $etu['login'] ?>/5</span></p><!-- Doit être en display flex puis space-between -->
                </div>
                <div> <!-- Doit être en display flex -->
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>