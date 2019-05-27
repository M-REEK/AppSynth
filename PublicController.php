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
        if (isset($_SESSION['member'])) {
            header('Location: ' . BASE_URL . '/');
        }
        $title = "Connexion";
        if (!empty($_POST)) {
            if (!empty(trim($_POST['login'])) && !empty(trim($_POST['password']))) {
                $pseudo = trim($_POST['login']);
                $password = trim($_POST['password']);
                if ($pseudo == "paulin" && $password == "lol") {
                    $_SESSION['member'] = $pseudo;
                    header('Location: ' . BASE_URL . '/accueil');
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
        require 'Manager.php';
        $manager = new Manager();
        $req = $manager->dbConnect();
        $allEntreprises=$req->query('Select * from table_client');
        require 'pages/header.php';
        require 'pages/entreprises.php';
        require 'pages/footer.php';
    }

    public  function etudiantsPage() {
        require 'Manager.php';
        $manager = new Manager();
        $req = $manager->dbConnect();
        $allEtudiants = $req->query('Select * from table_etudiant');
        require 'pages/header.php';
        require 'pages/etudiants.php';
        require 'pages/footer.php';
    }

    public function newConventionPage() {
        require 'pages/header.php';
        require 'pages/newConvention.php';
        require 'pages/footer.php';
    }

    public function newEntreprisePage() {
        require 'pages/header.php';
        require 'pages/newEntreprise.php';
        require 'pages/footer.php';
    }
}