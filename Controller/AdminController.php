<?php
namespace AppliSynth\Controller;

use AppliSynth\Core\Manager;
use AppliSynth\Core\Controller;
use \Spipu\Html2Pdf\Html2Pdf;

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
    public  function facturationPage() {
        $manager = new Manager();
        $req = $manager->dbConnect();
        $allFacture = $req->query('SELECT * FROM table_convention WHERE date_facture not like "null"');
        $this->render('facturation.php', 'Factures', compact('allFacture'));
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
                $data=$req_cherche->fetch();

 						foreach($_POST['listeEtudiant'] as $etu)
                		{
		                  $etudiant=$etu;
		                  $req_etu =$req->prepare('INSERT INTO table_convention_etudiant (`id_convention`,`id_etudiant`) VALUES (?,?)');
		                 $req_etu->execute(array($data[0],$etudiant));
		                }
                	
                
            }

            else
            {
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
                if(!filter_var(trim($_POST['modif_mail']), FILTER_VALIDATE_EMAIL))
                {
                    $_SESSION['alert'] = "<div class='alert error'>Veuillez taper un e-mail valide</div>";
                }
                    
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
            if (!empty(trim($_POST['nom_etu'])) && !empty(trim($_POST['prenom_etu'])) && !empty(trim($_POST['num_etu'])) && !empty(trim($_POST['adresse_etu'])) && !empty(trim($_POST['CP_etu'])) && !empty(trim($_POST['telephone_etu'])) && !empty(trim($_POST['email_etu'])) && !empty(trim($_POST['DOB_etu'])))
            {
                //Récupération des données
                $nom = trim($_POST['nom_etu']);
                $prenom = trim($_POST['prenom_etu']);
                $numEtu = trim($_POST['num_etu']);
                $adresse = trim($_POST['adresse_etu']);
                $CP = trim($_POST['CP_etu']);
                $telephone = trim($_POST['telephone_etu']);
                $email = trim($_POST['email_etu']);
                $DOB = trim($_POST['DOB_etu']);
                foreach($_POST['civilite'] as $valeur)
                {$civilite=$valeur;}

                $ERREUR=0;
                //Verification des données  
                if(!preg_match("/[0-9]*/", $CP))
                {$_SESSION['alert'] = "<div class='alert error'>Champs code postal incorrect</div>";}   
                if(!filter_var($telephone, FILTER_SANITIZE_NUMBER_INT))
                {$_SESSION['alert'] = "<div class='alert error'>Champs numero incorrect</div>";}
                if(!filter_var(trim($_POST['email_etu']), FILTER_VALIDATE_EMAIL))
                {$_SESSION['alert'] = "<div class='alert error'>Champs email incorrect</div>";}

                //Insertion dans la BDD
                $req_etu = $manager->dbConnect()->prepare('INSERT INTO table_etudiant (`civilite`,`nom`,`prenom`,`dateDeNaissance`,`adresse`,`code_postal`,`telephone_portable`,`email`,`login`) VALUES (?,?,?,?,?,?,?,?,?)');
                $req_etu->execute(array($civilite,$nom,$prenom,$DOB,$adresse,$CP,$telephone,$email,$numEtu));
                
            }
            else //Si un des champs n'est pas remplis
            {
                $_SESSION['alert'] = "<div class='alert error'>Veuillez remplir tous les champs</div>";
            }
        }
        $this->render('newEtudiant.php', 'Nouvel étudiant');
    }

        public function newReglementPage() {
        $title = "Nouveau reglement";
        $manager = new Manager();
        $req = $manager->dbConnect();
        $req2= $manager->dbConnect();

        //Preparation pour afficher la page
        $req = $req->prepare('SELECT * FROM table_convention WHERE id_convention = ?');
        $reglement = $req->execute([$_GET['id']]);
        $reglement = $req->fetch();
        $req2 = $req2->prepare('SELECT * FROM table_client WHERE id_client = ?');
        $client=$req2->execute(array($reglement['id_client']));
        $client=$req2->fetch();
        

        //Récupération des données
        if (!empty($_POST))
        {
             if (!empty(trim($_POST['montant'])))
             {
                $id = $reglement['id_convention'];
                $date = date("Y-m-d");
                $montant_regle= trim($_POST['montant']);
                foreach($_POST['type_reglement'] as $valeur){$type=$valeur;}
                if(empty(trim($_POST['numero_reglement']))){$numero=null;}
                else{$numero=trim($_POST['numero_reglement']);}

                //Insertion dans la BDD
                $req_regl = $manager->dbConnect()->prepare('INSERT INTO table_reglement (`id_convention`,`date_reglement`,`montant_regle`,`mode_de_reglement`,`numero_cheque_cb`) VALUES (?,?,?,?,?)');
                $req_regl->execute(array($id,$date,$montant_regle,$type,$numero));
                $req_conv = $manager->dbConnect()->prepare('UPDATE table_convention SET montant_regle = ? WHERE id_convention = ?');
                $montant=$reglement['montant_regle']+$montant_regle;
                $req_conv->execute(array($montant, $reglement['id_convention']));

            }
            else //Si un des champs n'est pas remplis
            {
                $_SESSION['alert'] = "<div class='alert error'>Veuillez remplir tous les champs</div>";
            }
        }


        $this->render('nouveauReglement.php', 'Nouveau reglement', compact('reglement','client'));
    }

    public function conventionsPage() {
        $manager = new Manager();
        $req = $manager->dbConnect();
        $allConventions = $req->query('SELECT * FROM table_convention tcn, table_client tcl WHERE tcn.id_client = tcl.id_client ORDER BY id_convention ASC');
        $this->render('conventions.php', 'Conventions', compact('allConventions', 'req'));
    }

    public function editerEntreprisePage() {
        $title = "Edition entreprise";
        $manager = new Manager();
        $req = $manager->dbConnect();
        $req = $req->prepare('SELECT * FROM table_client WHERE id_client = ?');
        $entreprise = $req->execute([$_GET['id']]);
        $entreprise = $req->fetch();
        $this->render('editerEntreprise.php', 'Editer entreprise', compact('entreprise'));
    }


    public function editerEtudiantPage() {
        $title = "Edition etudiant";
        $manager = new Manager();
        $req = $manager->dbConnect();
        $req = $req->prepare('SELECT * FROM table_etudiant WHERE id_etudiant = ?');
        $etudiant = $req->execute([$_GET['id']]);
        $etudiant = $req->fetch();
        $this->render('editerEtudiant.php', 'Editer etudiant', compact('etudiant'));
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

