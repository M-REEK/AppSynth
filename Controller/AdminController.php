<?php
namespace AppliSynth\Controller;

use AppliSynth\Core\Manager;
use AppliSynth\Core\Controller;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

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
        $allEntreprises = $req->query('SELECT * FROM table_client ORDER BY nom_societe');
        $allEtudiants = $req->query('SELECT * FROM table_etudiant ORDER BY nom');
 		if (!empty($_POST)) 
         {
            if (!empty(trim($_POST['date_debut'])) && !empty(trim($_POST['date_fin'])) && !empty(trim($_POST['montant'])) && !empty(trim($_POST['sujet'])))
            {
                $date_d = trim($_POST['date_debut']);
                $date_f = trim($_POST['date_fin']);
                $montant = trim($_POST['montant']);
                $sujet = trim($_POST['sujet']);
                foreach($_POST['listeEntreprise'] as $ent)
                {
                   $entreprise=$ent;
                }
                $req_conv = $req->prepare('INSERT INTO table_convention (`id_client`,`date_debut`,`date_fin`,`montant`,`sujet`) VALUES (?,?,?,?,?)');
                $req_conv->execute(array($entreprise,$date_d,$date_f,$montant,$sujet));

                $req_cherche=$req->prepare('SELECT id_convention FROM table_convention where date_debut=? and date_fin=? and id_client=? and sujet=?');
                $data = $req_cherche->execute(array($date_d,$date_f,$entreprise,$sujet));
                $data = $req_cherche->fetch();
                foreach($_POST['listeEtudiant'] as $etu) {
		            $etudiant=$etu;
		            $req_etu =$req->prepare('INSERT INTO table_convention_etudiant (`id_convention`,`id_etudiant`) VALUES (?,?)');
		            $req_etu->execute(array($data[0],$etudiant));
		        }   
            } else {
                $_SESSION['alert'] = "<div class='alert error'>Veuillez remplir tous les champs</div>";
            }
        }
        $this->render('newConvention.php', 'Nouvelle convention', compact('allEntreprises','allEtudiants'));
    }

    public function ficheEtudiantPage() {
        $title = "ficheEtudiant";
        $manager = new Manager();
        $req = $manager->dbConnect();
        $req = $req->prepare('SELECT * FROM table_etudiant WHERE id_etudiant = ?');
        $etudiant = $req->execute([$_GET['id']]);
        $etudiant = $req->fetch();
        $this->render('ficheEtudiant.php', 'Fiche Etudiant', compact('etudiant'));
    }

    public function ficheEntreprisePage() {
        $title = "ficheEntreprise";
        $manager = new Manager();
        $req = $manager->dbConnect();
        $req = $req->prepare('SELECT * FROM table_client WHERE id_client = ?');
        $entreprise = $req->execute([$_GET['id']]);
        $entreprise = $req->fetch();
        $this->render('ficheEntreprise.php', 'Fiche Entreprise', compact('entreprise'));
    }

    public function newEntreprisePage() {
        $manager = new Manager();
         if (!empty($_POST))
         {
            if (!empty(trim($_POST['num_ent'])) && !empty(trim($_POST['nom_ent'])) && !empty(trim($_POST['num_siren_ent'])) && !empty(trim($_POST['adresse_ent'])) && !empty(trim($_POST['CP_ent'])) && !empty(trim($_POST['telephone_ent'])) && !empty(trim($_POST['email_ent'])))
            {
	         //Recuperation des données 
                $nom = trim($_POST['nom_ent']);
                $siren = trim($_POST['num_siren_ent']);
                $numEnt = trim($_POST['num_ent']);
                $adresse = trim($_POST['adresse_ent']);
                $CP = trim($_POST['CP_ent']);
                $telephone = trim($_POST['telephone_ent']);
                $email = trim($_POST['email_ent']);
                foreach($_POST['indice_confiance'] as $valeur)
                {
                   $confiance = $valeur;
                }
                foreach($_POST['indice_confiance'] as $valeur){$confiance=$valeur;}
                //Verification des données 
    		if(!preg_match("/[0-9]{9}/", $siren))
    		{$_SESSION['alert'] = "<div class='alert error'>Champs siren incorrect (9 chiffres)</div>";}	
    		if(!preg_match("/[0-9]*/", $CP))
    		{$_SESSION['alert'] = "<div class='alert error'>Champs code postal incorrect</div>";}	
                if(!filter_var($telephone, FILTER_SANITIZE_NUMBER_INT))
                {$_SESSION['alert'] = "<div class='alert error'>Champs numero incorrect</div>";}
                if(!filter_var(trim($_POST['email_ent']), FILTER_VALIDATE_EMAIL))
                {$_SESSION['alert'] = "<div class='alert error'>Champs email incorrect</div>";}
            	//Insertion dans la BDD
                $req_ent = $manager->dbConnect()->prepare('INSERT INTO table_client (`nom_societe`,`num_siren`,`email`,`adresse`,`code postal`,`indice_confiance`,`telephone`) VALUES (?,?,?,?,?,?,?)');
                $req_ent->execute(array($nom,$siren,$email,$adresse,$CP,$confiance,$telephone));
	    }
            else //Si un champs non remplis
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
                $req_etu = $manager->dbConnect()->prepare('INSERT INTO table_etudiant (`civilite`,`nom`,`prenom`,`dateDeNaissance`,`adresse`,`code_postal`,`telephone_portable`,`email`,`login`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
                $req_etu->execute(
                    array(
                        $civilite, 
                        $nom, 
                        $prenom, 
                        $DOB, 
                        $adresse, 
                        $CP, 
                        $telephone, 
                        $email, 
                        $numEtu
                    )
                );
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

    public function editerEntreprisePage() {
        $manager = new Manager();
        $this->render('editerEntreprise.php', 'Editer etudiant');
    }

    public function conventionPDF() {
        $manager = new Manager();
        $req = $manager->dbConnect();
        $req = $req->prepare('SELECT * FROM table_convention tcn, table_client tcl WHERE tcn.id_convention = ? AND tcn.id_client = tcl.id_client ORDER BY id_convention ASC');
        $data = $req->execute([$_GET['id']]);
        $data = $req->fetch();
        try {
            ob_start();
            require 'View/Layout/conventionpdf.php';
            $content = ob_get_clean();
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->writeHTML($content);
            $html2pdf->output();
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }

}