<?php
session_start();

if(!isset($_SESSION['logged']) || 1 != $_SESSION['logged']) {
    header('Location:./login.php');
    die;
}

if (!isset($_SESSION['a'])) {
    $_SESSION['a'] = [];
    // $_SESSION['obj'] = []; //<----- agurko objektai
    $_SESSION['agurku ID'] = 0;
}

include __DIR__ . '/Agurkas.php';

// AUGINIMO SCENARIJUS
if (isset($_POST['auginti'])) {
    // foreach($_SESSION['a'] as $index => &$agurkas) {
    //     $agurkas['agurkai'] += $_POST['kiekis'][$agurkas['id']];
    // }

    foreach($_SESSION['obj'] as $index => $agurkas) { // <---- serializuotas stringas
        $agurkas = unserialize($agurkas); // <----- agurko objektas
        $agurkas->addAgurkas($_POST['kiekis'][$agurkas->id]); // <------- pridedam agurka
        $agurkas = serialize($agurkas); // <------ vel stringas
        $_SESSION['obj'][$index] = $agurkas; // <----- uzsaugom agurkus
    }

    header('Location:./auginimas.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auginimas</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Open+Sans+Condensed:wght@300&family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
<header>
<a class="loggout" href="login.php?logout">Atsijungti</a>
<div id="space"></div>
<a  href="sodinimas.php">Sodinimas</a>
<a href="auginimas.php">Auginimas</a>
<a href="skynimas.php">Skinimas</a>
</header>
<h1>Agurkų sodas</h1>
<h3>Auginimas</h3>
    <div class = "container">
    <form action="" method="post">
    <?php foreach($_SESSION['obj'] as $agurkas): ?>
    <?php $agurkas = unserialize($agurkas) ?>
    <div class = "row">
    <?php $kiekis = rand(2, 9) ?>
    <img class="img" src="./img/cucumber/img_<?= $agurkas->imgPath?>.jpg" alt="Agurko nuotrauka">
    <p>Agurko augalas nr. <?= $agurkas->id ?></p>
    <h3 style="background-color: rgb(174, 226, 174);display:inline-block;"><?= $agurkas->count ?></h1>
    <h3 style="display:inline;color:red;background-color: rgb(174, 226, 174);font-size: 23px">+<?= $kiekis ?></h3>
    <input type="hidden" name="kiekis[<?= $agurkas->id ?>]" value="<?= $kiekis ?>">
    </div>
    <?php endforeach ?>
    <br>
    <button type="submit" class="btn" name="auginti">Auginti</button>
    </form>
    </div>
</body>
</html>