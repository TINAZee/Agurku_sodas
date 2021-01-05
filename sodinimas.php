<?php
session_start();

if(!isset($_SESSION['logged']) || 1 != $_SESSION['logged']) {
    header('Location: ./login.php');
    die;
}

if (!isset($_SESSION['a'])) {
    // $_SESSION['a'] = [];
    $_SESSION['obj'] = []; //<----- agurko objektai
    $_SESSION['agurku ID'] = 0;
}

include __DIR__ . '/Agurkas.php'; //<------importuojama agurko klasė


// SODINIMO SCENARIJUS
if (isset($_POST['sodinti'])) {

    $kiekis = (int) $_POST['kiekis'];

    if (0 > $kiekis || 4 < $kiekis) { // <--- validacija
        if (0 > $kiekis) {
            $_SESSION['err'] = 1; // <-- neigiamas agurku kiekis
        }
        elseif(4 < $kiekis) {
            $_SESSION['err'] = 2; // <-- per daug
        }
        
        header('Location: ./sodinimas.php');
        exit;
    }

    if(empty($kiekis)) {
        $_SESSION['err'] = 4; 
        header('Location: ./sodinimas.php');
        exit;
    }

    if ($kiekis <= 1) {
        foreach(range(0, 0) as $_) {

            $agurkoObj = new Agurkas($_SESSION['agurku ID']);

            $_SESSION['obj'][] = serialize($agurkoObj);
            $_SESSION['agurku ID']++;
            // $_SESSION['a'][] = [
            //     'id' => ++$_SESSION['agurku ID'],
            //     'agurkai' => 0
            // ];
        }
    }

    if ($kiekis > 1 ) {

        foreach(range(1, $kiekis) as $_) {

            $agurkoObj = new Agurkas($_SESSION['agurku ID']);

            $_SESSION['obj'][] = serialize($agurkoObj);
            $_SESSION['agurku ID']++;

            // $_SESSION['a'][] = [
            //     'id' => ++$_SESSION['agurku ID'],
            //     'agurkai' => 0
            // ];
        }
    }

    header('Location: ./sodinimas.php');
    exit;
}

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
    // foreach($_SESSION['a'] as $index => $agurkas) {
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
<h1>Agurkų sodas</h1>
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
    <br>
    <input type="text" class="text" name="kiekis">
    <button type="submit" class="btn" name="sodinti">SODINTI</button>
    <br>
    </form>
    </div>
</body>
</html>