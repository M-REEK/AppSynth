<main>
    <section class="Listes">
      <h1>Liste des Etudiants</h1>
        <p><a href="nouvel-etudiant">Ajouter un etudiant <i class="fas fa-plus-circle"></i></a></p>
        <?php foreach ($allEtudiants as $etu): ?>
            <div class="etudiant">
                <div>
                    <p><span><?= $etu['nom'] ?></span> <span><?= $etu['prenom'] ?></span> <span><?= $etu['login'] ?></span></p><!-- Doit être en display flex puis space-between -->
                </div>
                <div>
                <?php
                $nb_conv = $req->prepare('SELECT count(id_convention) as nb_conv FROM table_convention_etudiant WHERE id_etudiant=?');
                $nb=$nb_conv->execute(array($etu['id_etudiant']));
                $nb=$nb_conv->fetch();
                ?>
                    <p>Nombre de Conventions: <span><?= $nb['nb_conv'] ?></span></p>
                </div>
                <div>
                  <a href="editerEtudiant?id=<?= $etu['id_etudiant'] ?>" title="Editer"><i class="fas fa-pencil-alt"></i></a> <a href="ficheEtudiant?id=<?= $etu['id_etudiant'] ?>" title="Visualiser"><i class="far fa-eye"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>
