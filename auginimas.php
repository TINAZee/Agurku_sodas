<?php
defined('DOOR_BELL') || die('Iejimas tik pro duris');

// use TINAZee\App;
use TINAZee\Agurkas;
use TINAZee\Zirniai;

if (!isset($_SESSION['a'])) {
    $_SESSION['a'] = [];
    $_SESSION['obj'] = []; //<----- agurko objektai
    $_SESSION['obj1'] = [];//<----- zirnio objektai
    $_SESSION['ID'] = 0;
}

if(!isset($_SESSION['logged']) || 1 != $_SESSION['logged']) {
    header('Location:./login.php');
    die;
}

// include 'Darzoves.php'; //<------importuojama tevine darzoves klasė
// include 'Agurkas.php';
// include 'Zirniai.php';

// AUGINIMO SCENARIJUS
if (isset($_POST['auginti'])) {
    // foreach($_SESSION['a'] as $index => &$agurkas) {
    //     $agurkas['agurkai'] += $_POST['kiekis'][$agurkas['id']];
    // }

    foreach($_SESSION['obj'] as $index => $agurkas) { // <---- serializuotas stringas
        $agurkas = unserialize($agurkas); // <----- agurko objektas
        $agurkas->addVegatable($_POST['kiekis'][$agurkas->id]); // <------- pridedam agurka
        $agurkas = serialize($agurkas); // <------ vel stringas
        $_SESSION['obj'][$index] = $agurkas; // <----- uzsaugom agurkus
    }

    foreach($_SESSION['obj1'] as $index => $zirnis) { 
        $zirnis = unserialize($zirnis); 
        $zirnis->addVegatable($_POST['kiekis'][$zirnis->id]); 
        $zirnis = serialize($zirnis); 
        $_SESSION['obj1'][$index] = $zirnis; 
    }

    header('Location:./auginimas');
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
<a href="sodinimas">Sodinimas</a>
<a href="auginimas">Auginimas</a>
<a href="skynimas">Skinimas</a>
</header>
<h1>Daržovių sodas</h1>
<h3>Auginimas</h3>
    <div class = "container">
    <form action="" method="post">

    <?php foreach($_SESSION['obj'] as $agurkas): ?>
    <?php $agurkas = unserialize($agurkas) ?>
    <div class = "row">
    <img class="img" src="./img/cucumber/img_<?= $agurkas->imgPath?>.jpg" alt="Agurko nuotrauka">
    <p>Agurko augalas nr. <?= $agurkas->id ?></p>
    <h3 style="background-color: rgb(174, 226, 174);display:inline-block;"><?= $agurkas->count ?></h1>
    <h3 style="display:inline;color:red;background-color: rgb(174, 226, 174);font-size: 23px">+<?= $agurkas->kiekAugti() ?></h3>
    <input type="hidden" name="kiekis[<?= $agurkas->id ?>]" value="<?=  $agurkas->kiekAugti() ?>">
    </div>
    <?php endforeach ?>

    <?php foreach($_SESSION['obj1'] as $zirnis): ?>
    <?php $zirnis = unserialize($zirnis) ?>
    <div class = "row">
    <img class="img" src="./img/peas/img_<?= $zirnis->imgPath?>.jpg" alt="Zirnio nuotrauka">
    <p>Žirnio augalas nr. <?= $zirnis->id ?></p>
    <h3 style="background-color: rgb(174, 226, 174);display:inline-block;"><?= $zirnis->count ?></h1>
    <h3 style="display:inline;color:red;background-color: rgb(174, 226, 174);font-size: 23px">+<?= $zirnis->kiekAugti() ?></h3>
    <input type="hidden" name="kiekis[<?= $zirnis->id ?>]" value="<?=  $zirnis->kiekAugti() ?>">
    </div>
    <?php endforeach ?>
    <br>
    <button type="submit" class="btn" name="auginti">Auginti</button>
    </form>
    </div>
</body>
</html>