<main>
    <section class="Listes">
        <p>Ajouter un etudiant <a href="#"><i class="fas fa-plus-circle"></i></a></p>
        <div>Trier par: numéro etudiant / nom / nombre convention signé / </div>
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
                  <a href="#" title="Editer"><i class="fas fa-pencil-alt"></i></a> <a href="#" title="Visualiser"><i class="far fa-eye"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>
