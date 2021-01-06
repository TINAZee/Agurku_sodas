<?php
session_start();

if(!isset($_SESSION['logged']) || 1 != $_SESSION['logged']) {
    header('Location: ./login.php');
    die;
}

if (!isset($_SESSION['a'])) {
    $_SESSION['a'] = [];
    $_SESSION['ID'] = 0;
}

include 'Darzoves.php'; //<------importuojama tevine darzoves klasė
include 'Agurkas.php';
include 'Zirniai.php';

//SKINTI SCENARIJUS
if (isset($_POST['skinti'])) {

    $nuskinti = $_POST['kiek_skinti'];

    foreach($_SESSION['obj'] as $index => $agurkas) {

        $agurkas = unserialize($agurkas); // <----- agurko objektas
        $agurkas->removeVegatable($_POST['kiek_skinti'][$agurkas->id]); // <------- atimam agurka
        $agurkas = serialize($agurkas); // <------ vel stringas
        $_SESSION['obj'][$index] = $agurkas; // <----- uzsaugom agurkus
    }

    foreach($_SESSION['obj1'] as $index => $zirnis) {

        $zirnis = unserialize($zirnis); // <----- agurko objektas
        $zirnis->removeVegatable($_POST['kiek_skinti'][$zirnis->id]); // <------- atimam agurka
        $zirnis = serialize($zirnis); // <------ vel stringas
        $_SESSION['obj1'][$index] = $zirnis; // <----- uzsaugom agurkus
    }

    header('Location: ./skynimas.php');
    exit;
}

//SKINTI VISUS SCENARIJUS

if (isset($_POST['skinti_visus'])) {

    foreach ($_SESSION['obj'] as $index => $agurkas ) {
            $agurkas = unserialize($agurkas); // <----- agurko objektas
            $agurkas->removeAllVegatables($_POST['skinti_visus']); // <------- atimam visus agurka
            $agurkas = serialize($agurkas); // <------ vel stringas
            $_SESSION['obj'][$index] = $agurkas; // <----- uzsaugom agurkus
    }

    foreach ($_SESSION['obj1'] as $index => $zirnis ) {
        $zirnis = unserialize($zirnis); // <----- agurko objektas
        $zirnis->removeAllVegatables($_POST['skinti_visus']); // <------- atimam visus agurka
        $zirnis = serialize($zirnis); // <------ vel stringas
        $_SESSION['obj1'][$index] = $zirnis; // <----- uzsaugom agurkus
    }

    header('Location: ./skynimas.php');
    die;
}

//NUIMTI VISA DERLIU SCENARIJUS

if (isset($_POST['nuimtiDerliu'])) {
   $_SESSION['obj'] = Agurkas::nuimtiDerliu($_SESSION['obj']);
   $_SESSION['obj1'] = Zirniai::nuimtiDerliu($_SESSION['obj']);
    header('Location: ./skynimas.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skynimas</title>
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
<h3>Agurkų skinimas</h3>
    <?php include 'error.php' ?>

    <div class = "container">

    <form action="" method="post">

    <?php foreach($_SESSION['obj'] as $agurkas): ?>
    <?php $agurkas = unserialize($agurkas) ?>
    <div class = "row">
    <img class="img" src="./img/cucumber/img_<?= $agurkas->imgPath?>.jpg" alt="Agurko nuotrauka">
    <p> Agurko augalas Nr. <?= $agurkas->id ?></p>
    <p style="color:red;font-size:19px"> Galima skinti: </p>
    <h3 style="background-color: rgb(174, 226, 174);display:inline-block;"><?= $agurkas->count ?></h1>
    <p style="display:inline-block;line-height:1.8">agurk.</p>
    <br>
    <input type="text" class="text"  name="kiek_skinti[<?= $agurkas->id ?>]"value=<?= $nuskinti ?? 0 ?>>
    <button type="submit" class="btn" name="skinti">Skinti</button>
    <br>
    <button type="submit" class="btn" name="skinti_visus" value="<?= $agurkas->id ?>">Skinti visus</button>
    </div>
    <?php endforeach ?>

    <?php foreach($_SESSION['obj1'] as $zirnis): ?>
    <?php $zirnis = unserialize($zirnis) ?>
    <div class = "row">
    <img class="img" src="./img/peas/img_<?= $zirnis->imgPath?>.jpg" alt="Zirnio nuotrauka">
    <p> Žirnio augalas Nr. <?= $zirnis->id ?></p>
    <p style="color:red;font-size:19px"> Galima skinti: </p>
    <h3 style="background-color: rgb(174, 226, 174);display:inline-block;"><?= $zirnis->count ?></h1>
    <p style="display:inline-block;line-height:1.8">agurk.</p>
    <br>
    <input type="text" class="text"  name="kiek_skinti[<?= $zirnis->id ?>]"value=<?= $nuskinti ?? 0 ?>>
    <button type="submit" class="btn" name="skinti">Skinti</button>
    <br>
    <button type="submit" class="btn" name="skinti_visus" value="<?= $zirnis->id ?>">Skinti visus</button>
    </div>
    <?php endforeach ?>

    <br>
    <button type="submit" class="btn" name="nuimtiDerliu">Nuimti visą derlių</button>
    </form>
    </div>
</body>
</html>
