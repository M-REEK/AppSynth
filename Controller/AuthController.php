<?php
namespace AppliSynth\Controller;

use AppliSynth\Core\Manager;
use AppliSynth\Core\Controller;

class AuthController extends Controller {

    public function connexionPage() {
        if (isset($_SESSION['member']))
        {
            header('Location: ' . BASE_URL . '/');
        }
        $title = "Connexion";
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
        $this->render('connexion.php', 'Connexion');
    }

    public function deconnexion() {
        unset($_SESSION['member']);
        $_SESSION['alert'] = "<div class='alert success'>Déconnexion réussie.</div>";
        header('Location: ' . BASE_URL . '/connexion');
    }

    public static function isAdmin() {
        if ($_SESSION['member']['role'] == 'admin') return true;
        return false;
    }

}
