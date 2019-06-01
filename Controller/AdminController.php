<?php
namespace AppliSynth\Controller;

use AppliSynth\Core\Manager;
use AppliSynth\Core\Controller;

class AdminController extends Controller {

    public function __construct() {
        if (!AuthController::isAdmin() && $_SERVER['REQUEST_URI'] != BASE_URL . '/connexion') {
            header('Location: ' . BASE_URL . '/connexion');     
        }
    }
   
    public function entreprisesPage() {
        $title = "Entreprises";
        $manager = new Manager();
        $req = $manager->dbConnect();
        $allEntreprises = $req->query('SELECT * FROM table_client');
        $this->render('entreprises.php', 'Entreprises', compact('allEntreprises'));
    }

    public  function etudiantsPage() {
        $manager = new Manager();
        $req = $manager->dbConnect();
        $allEtudiants = $req->query('SELECT * FROM table_etudiant');
        $this->render('etudiants.php', 'Etudiants', compact('allEtudiants'));
    }

    public function newConventionPage() {
        $manager = new Manager();
        $req = $manager->dbConnect();
        $allEntreprises = $req->query('SELECT * FROM table_client');
        $this->render('newConvention.php', 'Nouvelle convention', compact('allEntreprises'));
    }

    public function newEntreprisePage() {
        $manager = new Manager();
         if (!empty($_POST)) 
         {
            if (!empty(trim($_POST['num_ent'])) && !empty(trim($_POST['nom_ent'])) && !empty(trim($_POST['num_siren_ent'])) && !empty(trim($_POST['adresse_ent'])) && !empty(trim($_POST['CP_ent'])) && !empty(trim($_POST['telephone_ent'])) && !empty(trim($_POST['email_ent'])))
            {
                $nom = trim($_POST['nom_ent']);
                $siren = trim($_POST['num_siren_ent']);
                $numEnt = trim($_POST['num_ent']);
                $adresse = trim($_POST['adresse_ent']);
                $CP = trim($_POST['CP_ent']);
                $telephone = trim($_POST['telephone_ent']);
                $email = trim($_POST['email_ent']);
                foreach($_POST['indice_confiance'] as $valeur)
                {
                   $confiance=$valeur;
                }
                $req_ent = $manager->dbConnect()->prepare('INSERT INTO table_client (`nom_societe`,`num_siren`,`email`,`adresse`,`code postal`,`indice_confiance`,`telephone`) VALUES (?,?,?,?,?,?,?)');
                $req_ent->execute(array($nom,$siren,$email,$adresse,$CP,$confiance,$telephone));
            }

            else
            {
                 $_SESSION['alert'] = "<div class='alert error'>Veuillez remplir tous les champs</div>";
            }
        }
        $this->render('newEntreprise.php', 'Nouvelle entreprise');
    }

    public function parametrePage() {
        $manager = new Manager();
        $req = $manager->dbConnect();
        if (($test = $_SESSION['member']['pseudo']) == 'admin') 
        {
            $req = $manager->dbConnect()->prepare('SELECT * FROM table_utilisateur_admin WHERE login = ?');
        }
        $user = $req->execute([$test]);
        $user = $req->fetch();
        if(!empty($_POST))
        {
            if(!empty(trim($_POST['modif_id'])))
            {
                $login = trim($_POST['modif_id']);
                $req_id = $manager->dbConnect()->prepare('UPDATE table_utilisateur_admin SET login = ? WHERE login = ?');
                $req_id->execute(array($login, $user['login']));
            }
            if(!empty(trim($_POST['modif_mdp'])))
            {
                $mdp = trim($_POST['modif_mdp']);
                $req_mdp = $manager->dbConnect()->prepare('UPDATE table_utilisateur_admin SET mdp = ? WHERE login = ?');
                $req_mdp->execute(array($mdp, $user['login']));
            }
            if(!empty(trim($_POST['modif_mail'])))
            {
                $mail = trim($_POST['modif_mail']);
                $req_main = $manager->dbConnect()->prepare('UPDATE table_utilisateur_admin SET mail = ? WHERE login = ?');
                $req_main->execute(array($mail, $user['login']));
            }
        }
        $this->render('parametre.php', 'Paramètres', compact('user'));  
    }

    public function newEtudiantPage() {
        $manager = new Manager();
         if (!empty($_POST)) 
         {
            if (!empty(trim($_POST['nom_etu'])) && !empty(trim($_POST['prenom_etu'])) && !empty(trim($_POST['num_etu'])) && !empty(trim($_POST['adresse_etu'])) && !empty(trim($_POST['CP_etu'])) && !empty(trim($_POST['telephone_etu'])) && !empty(trim($_POST['e-mail_etu'])) && !empty(trim($_POST['DOB_etu'])))
            {
                $nom = trim($_POST['nom_etu']);
                $prenom = trim($_POST['prenom_etu']);
                $numEtu = trim($_POST['num_etu']);
                $adresse = trim($_POST['adresse_etu']);
                $CP = trim($_POST['CP_etu']);
                $telephone = trim($_POST['telephone_etu']);
                $email = trim($_POST['e-mail_etu']);
                $DOB = trim($_POST['DOB_etu']);

                foreach($_POST['civilite'] as $valeur)
                {
                   $civilite=$valeur;
                }
                $req_etu = $manager->dbConnect()->prepare('INSERT INTO table_etudiant (`civilite`,`nom`,`prenom`,`dateDeNaissance`,`adresse`,`code_postal`,`telephone_portable`,`email`,`login`) VALUES (?,?,?,?,?,?,?,?,?)');
                $req_etu->execute(array($civilite,$nom,$prenom,$DOB,$adresse,$CP,$telephone,$email,$numEtu));
            }
            else
            {
                $_SESSION['alert'] = "<div class='alert error'>Veuillez remplir tous les champs</div>";
            }
        }
        $this->render('newEtudiant.php', 'Nouvel étudiant');
    }

    public function conventionsPage() {
        $manager = new Manager();
        $req = $manager->dbConnect();
        $allConventions = $req->query('SELECT * FROM table_convention tcn, table_client tcl WHERE tcn.id_client = tcl.id_client ORDER BY id_convention ASC');
        $this->render('conventions.php', 'Conventions', compact('allConventions', 'req'));
    }

}
