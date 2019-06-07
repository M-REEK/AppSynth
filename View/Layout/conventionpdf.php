<?php use AppliSynth\Core\Manager; ?>
<style>
    .title {
        background-color: black;
        color: white;
        text-align: center;
        font-size: 36px;
        font-weight: bold;
    }
</style>
<page backtop="20mm" backleft="10mm" backright="10mm" backbottom="10mm">
    <page_header> 
        <div class="title">JUNIOR ENTREPRISE CONVENTION</div>            
    </page_header> 
    <div>Numéro de la convention : <?= $data['id_convention'] ?></div>
    <div>Nom(s) :                           
    <?php
    $manager = new Manager();
    $req = $manager->dbConnect();
    $names = $req->query('SELECT nom, prenom FROM table_etudiant te, table_convention_etudiant tce WHERE tce.id_convention = ' . $data['id_convention'] . ' AND tce.id_etudiant = te.id_etudiant');
    foreach ($names as $name):
    ?>
        <?= $name['nom'] . ' ' . $name['prenom'] ?>
    <?php endforeach; ?></div>
</page>