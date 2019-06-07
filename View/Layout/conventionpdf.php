<?php use AppliSynth\Core\Manager; ?>
<style>
    .title {
        background-color: black;
        color: white;
        text-align: center;
        font-size: 36px;
        font-weight: bold;
    }
    .footer {
        background-color: black;
        color: white;
        text-align: center;
        font-size: 12px;
    }
    .etu {
        margin-bottom: 5px;
        padding-bottom: 5px;
    }
</style>
<page backtop="20mm" backleft="10mm" backright="10mm" backbottom="5mm">
    <page_header> 
        <div class="title">JUNIOR ENTREPRISE CONVENTION</div>            
    </page_header>
    <page_footer> 
        <div class="footer">&copy; Tous droits réservés @JUNIOR ENTREPRISE</div>            
    </page_footer>  
    <div>Numéro de la convention : <?= $data['id_convention'] ?></div>
    <div>Date de début : <?= $data['date_debut_fr'] ?></div>
    <div>Date de fin : <?= $data['date_fin_fr'] ?></div>
    <div>Statut du projet : <?= $data['statut_projet'] ?></div>
    <div>Sujet : <?= $data['sujet'] ?></div>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium culpa dignissimos nulla! Explicabo et sequi, facere quibusdam nesciunt earum alias sunt temporibus eveniet expedita fuga eligendi eum quidem animi optio!</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium culpa dignissimos nulla! Explicabo et sequi, facere quibusdam nesciunt earum alias sunt temporibus eveniet expedita fuga eligendi eum quidem animi optio!</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium culpa dignissimos nulla! Explicabo et sequi, facere quibusdam nesciunt earum alias sunt temporibus eveniet expedita fuga eligendi eum quidem animi optio!</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium culpa dignissimos nulla! Explicabo et sequi, facere quibusdam nesciunt earum alias sunt temporibus eveniet expedita fuga eligendi eum quidem animi optio!</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium culpa dignissimos nulla! Explicabo et sequi, facere quibusdam nesciunt earum alias sunt temporibus eveniet expedita fuga eligendi eum quidem animi optio!</p>
    <div>
        <h2>Etudiant(s)</h2>                          
        <?php
        $manager = new Manager();
        $req = $manager->dbConnect();
        $etus = $req->query('SELECT * FROM table_etudiant te, table_convention_etudiant tce WHERE tce.id_convention = ' . $data['id_convention'] . ' AND tce.id_etudiant = te.id_etudiant');
        foreach ($etus as $e):
        ?>
        <div class="etu">
            <div>Nom : <?= $e['nom'] . ' ' . $e['prenom'] ?></div>
            <div>Date de naissance : <?= $e['dateDeNaissance'] ?></div>
            <div>Adresse : <?= $e['adresse'] . ', ' . $e['code_postal'] ?></div>
            <div>Téléphone : <?= $e['telephone'] ?></div>
        </div>
        <?php endforeach; ?>
    </div>
    <div>
        <h2>Entreprise</h2>                          
        <?php
        $manager = new Manager();
        $req = $manager->dbConnect();
        $ent = $req->query('SELECT * FROM table_client tc WHERE tc.id_client = ' . $data['id_client']);
        foreach ($ent as $e):
        ?>
        <div>Raison sociale : <?= $e['nom_societe'] ?></div>
        <div>SIREN : <?= $e['num_siren'] ?></div>
        <div>Adresse : <?= $e['adresse'] . ', ' . $e['code_postal'] ?></div>
        <div>Téléphone : <?= $e['telephone'] ?></div>
        <div>Motant de la convention : <?= $e['argent_total'] ?></div>
        <?php endforeach; ?>
    </div>

    <div>
        <h4>Signature</h4>
    </div>
</page>