<?php
function homePage() {
    if (!isset($_SESSION['member'])) {
        header('Location: ' . BASE_URL . '/connexion');        
    }
    require 'pages/header.php';
    require 'pages/home.php';
    require 'pages/footer.php';
    unset($_SESSION['member']);
}
function connexionPage() {
    require 'pages/header.php';
    require 'pages/connexion.php';
    require 'pages/footer.php';
}
function EntreprisesPage() {
        require 'pages/header.php';
        require 'pages/entreprises.php';
        require 'pages/footer.php';
     
    }
function newEntreprisePage() {
        require 'pages/header.php';
        require 'pages/newEntreprise.php';
        require 'pages/footer.php';
    }
?>