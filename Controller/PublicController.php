<?php
namespace AppliSynth\Controller;

use AppliSynth\Core\Manager;
use AppliSynth\Core\Controller;
use \Spipu\Html2Pdf\Html2Pdf;

class PublicController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['member']) && $_SERVER['REQUEST_URI'] != BASE_URL . '/connexion') {
            header('Location: ' . BASE_URL . '/connexion');
        }
    }

    public function homePage() {
        if (!AuthController::isAdmin()) {
            $manager = new Manager();
            $req = $manager->dbConnect();
            $req = $req->prepare('SELECT id_etudiant FROM table_etudiant WHERE login = ?');
            $req->execute([$_SESSION['member']['pseudo']]);
            $id = $req->fetch();
            $req = $manager->dbConnect()->prepare('SELECT id_convention FROM table_convention_etudiant WHERE id_etudiant = ?');
            $req->execute([$id['id_etudiant']]);
            $idconv = $req->fetchAll();
            $this->render('homeEtudiant.php', 'Accueil', compact('idconv'));
        } else {
            $this->render('home.php', 'Accueil');
        }
    }

    public function conventionPDF() {
        $manager = new Manager();
        $req = $manager->dbConnect();
        $req = $req->prepare('SELECT *, DATE_FORMAT(date_debut, \'%d %M %Y\') AS date_debut_fr, DATE_FORMAT(date_fin, \'%d %M %Y\') AS date_fin_fr FROM table_convention tcn, table_client tcl WHERE tcn.id_convention = ? AND tcn.id_client = tcl.id_client ORDER BY id_convention ASC');
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
