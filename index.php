<?php
namespace App;

session_start();

define('BASE_URL', '/AppliSynth'); // root uri

// getting all the routes to a php array from a .json
$json_file = file_get_contents('routes.json');
$jsonToArray = json_decode($json_file, true);
$routes = $jsonToArray;

// getting the path to call the right function
$url = $_SERVER['REQUEST_URI'];
$url = str_replace('/AppliSynth', '', $url);
$url = strtok($url, '?');

if ($url == "/") {
    header('Location: ' . BASE_URL . $routes['home']['path']);
    exit();
}

// searching if there is a match between the url and the available routes
foreach ($routes as $key => $values) {
    if ($url == $values["path"]) {
        $functionToExecute = $values["run"];
        $controllerToCall = $values['from'];
        break;
    }
}

if (!isset($functionToExecute)) {
    $_SESSION['alert'] = "<div class='alert error'>L'adresse demandée n'existe pas.</div>";
    header('Location: ' . BASE_URL . $routes['home']['path']);
}

require($controllerToCall . '.php');
$controllerToCall = 'App\Controller\\' . $controllerToCall;

$controller = new $controllerToCall();
$controller->$functionToExecute();