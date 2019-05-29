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
        require 'Manager.php';
        $manager = new Manager();
        if (!empty($_POST)) {
            if (!empty(trim($_POST['login'])) && !empty(trim($_POST['password']))) {
                $pseudo = trim($_POST['login']);
                $password = trim($_POST['password']);
                if ($pseudo == 'admin') {
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
                } else {
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
        require 'pages/header.php';
        require 'pages/newConvention.php';
        require 'pages/footer.php';
    }

    public function newEntreprisePage() {
        $title = "Nouvelle entreprise";
        require 'pages/header.php';
        require 'pages/newEntreprise.php';
        require 'pages/footer.php';
    }
}