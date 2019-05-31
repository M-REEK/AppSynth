<?php
namespace App\Controller;

class PublicController {

    public function __construct() {
        if (!isset($_SESSION['member']) && $_SERVER['REQUEST_URI'] != BASE_URL . '/connexion') {
            header('Location: ' . BASE_URL . '/connexion');     
        }
    }

    public function homePage() {
        
        $title = "Accueil";
        require 'pages/header.php';
        require 'pages/home.php';
        require 'pages/footer.php';
    }
    
    public function connexionPage() {
        if (isset($_SESSION['member'])) 
        {
            header('Location: ' . BASE_URL . '/');
        }
        $title = "Connexion";
        require 'Manager.php';
        $manager = new Manager();
        if (!empty($_POST))
        {
            if (!empty(trim($_POST['login'])) && !empty(trim($_POST['password']))) 
            {
                $pseudo = trim($_POST['login']);
                $password = trim($_POST['password']);
                if ($pseudo == 'admin') 
                {
                    $req = $manager->dbConnect()->prepare('SELECT * FROM table_utilisateur_admin WHERE login = ?');
                } else {
                    $req = $manager->dbConnect()->prepare('SELECT * FROM table_utilisateur_etudiant WHERE login = ?');
                }
                $user = $req->execute([$pseudo]);
                $user = $req->fetch();
                if (password_verify($password, $user['mdp'])) {
                    unset($_SESSION['member']);
                    $_SESSION['member'] = [
                        'pseudo' => $user['login']
                    ];
                    if ($user['login'] == 'admin') {
                        $_SESSION['member']['role'] = 'admin';
                    } else {
                        $_SESSION['member']['role'] = 'etudiant';
                    }
                    header('Location: ' . BASE_URL . '/accueil');
                } else 
                {
                    $_SESSION['alert'] = "<div class='alert error'>Identifiants incorrects.</div>";
                }
            }
        }
        require 'pages/headerConnexion.php';
        require 'pages/connexion.php';
        require 'pages/footer.php';
    }

    public function deconnexion() {
        unset($_SESSION['member']);
        $_SESSION['alert'] = "<div class='alert success'>Déconnexion réussie.</div>";
        header('Location: ' . BASE_URL . '/connexion');
    }

    public function entreprisesPage() {
        $title = "Entreprises";
        require 'Manager.php';
        $manager = new Manager();
        $req = $manager->dbConnect();
        $allEntreprises = $req->query('SELECT * FROM table_client');
        require 'pages/header.php';
        require 'pages/entreprises.php';
        require 'pages/footer.php';
    }

    public  function etudiantsPage() {
        $title = "Etudiants";
        require 'Manager.php';
        $manager = new Manager();
        $req = $manager->dbConnect();
        $allEtudiants = $req->query('SELECT * FROM table_etudiant');
        require 'pages/header.php';
        require 'pages/etudiants.php';
        require 'pages/footer.php';
    }

    public function newConventionPage() {
        $title = "Nouvelle convention";
        require 'Manager.php';
        $manager = new Manager();
        $req = $manager->dbConnect();
        $allEntreprises = $req->query('SELECT * FROM table_client');

        require 'pages/header.php';
        require 'pages/newConvention.php';
        require 'pages/footer.php';
    }

    public function newEntreprisePage() {
        $title = "Nouvelle entreprise";
        require 'Manager.php';
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
        require 'pages/header.php';
        require 'pages/newEntreprise.php';
        require 'pages/footer.php';
    }

    public function parametrePage() {
        $title = "Parametres";
        require 'Manager.php';
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
                $req_id->execute(array($login,$user['login']));
            }
            if(!empty(trim($_POST['modif_mdp'])))
            {
                $mdp = trim($_POST['modif_mdp']);
                $req_mdp = $manager->dbConnect()->prepare('UPDATE table_utilisateur_admin SET mdp = ? WHERE login = ?');
                $req_mdp->execute(array($mdp,$user['login']));
            }
            if(!empty(trim($_POST['modif_mail'])))
            {
                $mail = trim($_POST['modif_mail']);
                $req_main = $manager->dbConnect()->prepare('UPDATE table_utilisateur_admin SET mail = ? WHERE login = ?');
                $req_main->execute(array($mail,$user['login']));
            }
        }
        require 'pages/header.php';
        require 'pages/parametre.php';
        require 'pages/footer.php';   
    }

    public function newEtudiantPage() {

        $title = "Nouvel etudiant";
        require 'Manager.php';
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
            require 'pages/header.php';
            require 'pages/newEtudiant.php';
            require 'pages/footer.php';

    }
}
