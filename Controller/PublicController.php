<?php
namespace AppliSynth\Controller;

use AppliSynth\Core\Controller;

class PublicController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['member']) && $_SERVER['REQUEST_URI'] != BASE_URL . '/connexion') {
            header('Location: ' . BASE_URL . '/connexion');
        }
    }

    public function homePage() {
        $this->render('home.php', 'Accueil');
    }

}
