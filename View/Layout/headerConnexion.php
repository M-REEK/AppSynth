<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
    </head>
<body>
    <?= isset($_SESSION['alert']) ? $_SESSION['alert'] : '' ?>
    <header>
        <h1 id="main-title">Junior Entreprise</h1>
        <div>
            <p id="welcome-message">Bienvenue sur Junior Entreprise</p>
            <p>Veuillez vous connecter</p>
        </div>
    </header>