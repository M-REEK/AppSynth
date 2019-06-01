<?php 
namespace AppliSynth\Core;

class Controller {

    private $viewPaths = [
        "Admin" => 'View/Admin/',
        "Public" => 'View/Public/',
        "Layout" => 'View/Layout/'
    ];

    public function render($view, $title, $vars = []) {
        extract($vars);
        if (($viewToDisplay = $this->searchView($view)) != null) {
            if ($view == 'connexion.php') {
                require $this->viewPaths['Layout'] . 'headerConnexion.php';
            } else {
                require $this->viewPaths['Layout'] . 'header.php';
            }
            if ($view != 'connexion.php') require $this->viewPaths['Layout'] . 'menu.php';
            require $viewToDisplay;
            require $this->viewPaths['Layout'] . 'footer.php';
        }
    }

    public function searchView($view) {
        foreach ($this->viewPaths as $key => $path) {
            if (file_exists($path . $view)) {
                return $path . $view;
            }
        }
        return null;
    }

}