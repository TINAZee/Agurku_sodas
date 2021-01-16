<?php

defined('DOOR_BELL') || die('Iejimas tik pro duris');


if(!isset($_SESSION['logged']) || 1 != $_SESSION['logged']) {
    header('Location: ./login.php');
    die;
}

use TINAZee\App;
use TINAZee\Agurkas;
use TINAZee\Zirniai;

// $store = new TINAZee\Store('agurkas');

if (!isset($_SESSION['a'])) {
    $_SESSION['a'] = [];
    $_SESSION['obj'] = []; //<----- agurko objektai
    $_SESSION['obj1'] = [];//<----- zirnio objektai
    $_SESSION['ID'] = 0;
}

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
        
        header("Location: ./sodinimas");
        exit;
    }

    if(empty($kiekis)) {
        $_SESSION['err'] = 4; 
        header("Location: ./sodinimas");
        exit;
    }

    foreach(range(0, $kiekis-1) as $_) {

        // $agurkoObj = new Agurkas($store->getNewId());
        // $store->addNew($agurkoObj);

        $agurkoObj = new Agurkas($_SESSION['ID']);
        $_SESSION['ID']++;
        $_SESSION['obj'][] = serialize($agurkoObj);
    }

    // TINAZee\App::redirect('sodinimas');
    header('Location: ./sodinimas');
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
            
        header("Location: ./sodinimas");
        exit;
    }
    
    if(empty($kiekis)) {
         $_SESSION['err'] = 4; 
         header("Location: ./sodinimas");
        exit;
    }
    
    foreach(range(0, $kiekis-1) as $_) {
    
        $zirnioObj = new Zirniai($_SESSION['ID']);
        $_SESSION['ID']++;
        $_SESSION['obj1'][] = serialize($zirnioObj); 
    
            // $_SESSION['a'][] = [
            //     'id' => ++$_SESSION['agurku ID'],
            //     'agurkai' => 0
            // ];
    }
    
header("Location: ./sodinimas");
        exit;
}

// ISROVIMO SCENARIJUS
if (isset($_POST['rauti'])) {

    // TINAZee\Store::remove($_POST['rauti']);
    // // TINAZee\App::redirect('sodinimas');
    // header('Location: ./sodinimas');

    foreach($_SESSION['obj'] as $index => $agurkas) {
        $agurkas = unserialize($agurkas);
        if ($_POST['rauti'] == $agurkas->id) {
            unset($_SESSION['obj'][$index]);
            header('Location: ./sodinimas');
            exit;
        }
    }
    foreach($_SESSION['obj1'] as $index => $zirnis) {
        $zirnis = unserialize($zirnis);
        if ($_POST['rauti'] == $zirnis->id) {
            unset($_SESSION['obj1'][$index]);
            header('Location: ./sodinimas');
            exit;
        }
    }
}
    // foreach($_SESSION['a'] as $index => $zirnis) {
    //     if ($_POST['rauti'] == $agurkas['id']) {
    //         unset($_SESSION['a'][$index]);
    //         header('Location: ./sodinimas.php');
    //         die;
    //     }
    // }

//<?= URL.'sodinimas'
//  <?php foreach(TINAZee\Store::getAll() as $agurkas): 

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
<a  href="sodinimas">Sodinimas</a>
<a href="auginimas">Auginimas</a>
<a href="skynimas">Skinimas</a>
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