<?php
session_start();

include __DIR__ . '/vendor/autoload.php';

if(!isset($_SESSION['logged']) || 1 != $_SESSION['logged']) {
    header('Location: ./login.php');
    die;
}

use TINAZee\App;

App::setSession();

// include __DIR__.'/inc/Darzoves.php'; //<------importuojama tevine darzoves klasė
// include __DIR__.'/inc/Agurkas.php'; //<------importuojama agurko klasė
// include __DIR__.'/inc/Zirniai.php'; //<------importuojama zirnio klasė

//AGURKU SODINIMO SCENARIJUS

if (isset($_POST['sodinti_a'])) {

    $kiekis = (int) $_POST['kiekis'];

    if (0 > $kiekis || 4 < $kiekis) { // <--- validacija
        if (0 > $kiekis) {
            $_SESSION['err'] = 1; // <-- neigiamas kiekis
        }
        elseif(4 < $kiekis) {
            $_SESSION['err'] = 2; // <-- per daug
        }
        
        App::redirect('sodinimas');
    }

    if(empty($kiekis)) {
        $_SESSION['err'] = 4; 
        App::redirect('sodinimas');
    }

    foreach(range(0, $kiekis-1) as $_) {

        App::sodintiAgurka();
    }

    App::redirect('sodinimas');
}

// ZIRNIU SODINIMO SCENARIJUS

if (isset($_POST['sodinti_z'])) {

    $kiekis = (int) $_POST['kiekis'];
    
    if (0 > $kiekis || 4 < $kiekis) { // <--- validacija
        if (0 > $kiekis) {
             $_SESSION['err'] = 1; // <-- neigiamas kiekis
        }
        elseif(4 < $kiekis) {
            $_SESSION['err'] = 2; // <-- per daug
        }
            
        App::redirect('sodinimas');
    }
    
    if(empty($kiekis)) {
         $_SESSION['err'] = 4; 
         App::redirect('sodinimas');
    }
    
    foreach(range(0, $kiekis-1) as $_) {
    
        App::sodintiZirni();
    
            // $_SESSION['a'][] = [
            //     'id' => ++$_SESSION['agurku ID'],
            //     'agurkai' => 0
            // ];
    }
    
App::redirect('sodinimas');
}

// ISROVIMO SCENARIJUS
App::rauti();
    // foreach($_SESSION['a'] as $index => $zirnis) {
    //     if ($_POST['rauti'] == $agurkas['id']) {
    //         unset($_SESSION['a'][$index]);
    //         header('Location: ./sodinimas.php');
    //         die;
    //     }
    // }



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
<h1>Daržovių sodas</h1>
<h3>Sodinimas</h3>
    <?php include 'error.php' ?>

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