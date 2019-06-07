<main>
<?php 
    use AppliSynth\Core\Manager;
    foreach ($idconv as $id): ?>
    <?php 
        $manager = new Manager();
        $req = $manager->dbConnect();
        $req = $req->prepare('SELECT *, DATE_FORMAT(date_debut, \'%d %M %Y\') AS date_debut_fr, DATE_FORMAT(date_fin, \'%d %M %Y\') AS date_fin_fr FROM table_convention WHERE id_convention = ?');
        $req->execute([$id['id_convention']]);
        $data = $req->fetch();
    ?>
    <div class="conventions">
        <div>Numéro de la convention : <?= $data['id_convention'] ?></div>
        <div>Date de début : <?= $data['date_debut_fr'] ?></div>
        <div>Date de fin : <?= $data['date_fin_fr'] ?></div>
        <div>Statut du projet : <?= $data['statut_projet'] ?></div>
        <div>Sujet : <?= $data['sujet'] ?></div>
        <a href="conventionPDF?id=<?= $data['id_convention'] ?>" title="Visualiser"><i class="far fa-eye"></i></a>
    </div>
    <?php endforeach; ?>
</main>