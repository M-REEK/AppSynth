<main>
    <section class="Listes">
        <p><a href="nouvel-etudiant">Ajouter un etudiant <i class="fas fa-plus-circle"></i></a></p>
        <?php foreach ($allEtudiants as $etu): ?>
            <div class="etudiant">
                <div>
                    <p><span><?= $etu['nom'] ?></span> <span><?= $etu['prenom'] ?></span> <span><?= $etu['login'] ?></span></p><!-- Doit être en display flex puis space-between -->
                </div>
                <div>
                    <p>Conventions signées: </p>
                    <p>Conventions en cours: </p>
                </div>
                <div>
                  <a href="editerEtudiant?id=<?= $etu['id_etudiant'] ?>" title="Editer"><i class="fas fa-pencil-alt"></i></a> <a href="ficheEtudiant?id=<?= $etu['id_etudiant'] ?>" title="Visualiser"><i class="far fa-eye"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>
