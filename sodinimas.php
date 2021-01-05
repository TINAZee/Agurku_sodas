<?php
session_start();

if(!isset($_SESSION['logged']) || 1 != $_SESSION['logged']) {
    header('Location: ./login.php');
    die;
}

if (!isset($_SESSION['a'])) {
    // $_SESSION['a'] = [];
    $_SESSION['obj'] = []; //<----- agurko objektai
    $_SESSION['obj1'] = [];//<----- zirnio objektai
    $_SESSION['ID'] = 0;
}

include __DIR__ . '/Agurkas.php'; //<------importuojama agurko klasė
include __DIR__ . '/Zirniai.php'; //<------importuojama agurko klasė

//Zirniu SODINIMO SCENARIJUS

include __DIR__ . '/zirniuSodinimas.php'; //<------importuojama agurko klasė

// Agurku SODINIMO SCENARIJUS

include __DIR__ . '/agurkuSodinimas.php'; //<------importuojama agurko klasė

// ISROVIMO SCENARIJUS
if (isset($_POST['rauti'])) {

    foreach($_SESSION['obj'] as $index => $agurkas) {
        $agurkas = unserialize($agurkas);
        if ($_POST['rauti'] == $agurkas->id) {
            unset($_SESSION['obj'][$index]);
            header('Location: ./sodinimas.php');
            exit;
        }
    }
    foreach($_SESSION['obj1'] as $index => $zirnis) {
        $zirnis = unserialize($zirnis);
        if ($_POST['rauti'] == $zirnis->id) {
            unset($_SESSION['obj1'][$index]);
            header('Location: ./sodinimas.php');
            exit;
        }
    }
    // foreach($_SESSION['a'] as $index => $zirnis) {
    //     if ($_POST['rauti'] == $agurkas['id']) {
    //         unset($_SESSION['a'][$index]);
    //         header('Location: ./sodinimas.php');
    //         die;
    //     }
    // }

}

_d($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sodinimas</title>
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
<h1>Agurkų ir Žirnių sodas</h1>
<h3>Sodinimas</h3>
    <?php include __DIR__.'/error.php' ?>

    <div class = "container">

    <form action="" method="post">

    <?php foreach($_SESSION['obj'] as $agurkas): ?>
    <?php $agurkas = unserialize($agurkas) ?>
    <div class = "row">
    <img class="img" src="./img/cucumber/img_<?= $agurkas->imgPath?>.jpg" alt="Agurko nuotrauka">
    <p>Agurko augalas nr. <?= $agurkas->id ?></p>
    <p style="color:rgb(19, 175, 2);font-size:18px">Agurkų vaisių: <?= $agurkas->count ?></p>
    <button type="submit" class="btn" name="rauti" value="<?= $agurkas->id ?>">Išrauti</button>
    </div>
    <?php endforeach ?>

    <?php foreach($_SESSION['obj1'] as $zirnis): ?>
    <?php $zirnis = unserialize($zirnis) ?>
    <div class = "row">
    <img class="img" src="./img/peas/img_<?= $zirnis->imgPath?>.jpg" alt="Zirnio nuotrauka">
    <p>Žirnio augalas nr. <?= $zirnis->id ?></p>
    <p style="color:rgb(19, 175, 2);font-size:18px">Žirnio vaisių: <?= $zirnis->count ?></p>
    <button type="submit" class="btn" name="rauti" value="<?= $zirnis->id ?>">Išrauti</button>
    </div>
    <?php endforeach ?>

    <br>
    <input type="text" class="text" name="kiekis">
    <button type="submit" class="btn" name="sodinti_a">Sodinti Agurką</button>
    <button type="submit" class="btn" name="sodinti_z">Sodinti Žirnį</button>
    <br>
    </form>
    </div>
</body>
</html>