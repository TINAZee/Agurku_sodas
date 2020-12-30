<?php
session_start();

if(!isset($_SESSION['logged']) || 1 != $_SESSION['logged']) {
    header('Location: ./login.php');
    die;
}

if (!isset($_SESSION['a'])) {
    $_SESSION['a'] = [];
    $_SESSION['agurku ID'] = 0;
}

_d($_SESSION,'SESIJA');

// SODINIMO SCENARIJUS
// SODINIMO SCENARIJUS
if (isset($_POST['sodinti'])) {

    $kiekis = (int) $_POST['kiekis'];

    if (0 > $kiekis || 10 < $kiekis) { // <--- validacija
        if (0 > $kiekis) {
            $_SESSION['err'] = 1; // <-- neigiamas agurku kiekis
        }
        elseif(4 < $kiekis) {
            $_SESSION['err'] = 2; // <-- per daug
        }
        
        header('Location: ./sodinimas.php');
        exit;
    }

    foreach(range(1, $kiekis) as $_) {
        $_SESSION['a'][] = [
            'id' => ++$_SESSION['agurku ID'],
            'agurkai' => 0
        ];
    }


    header('Location: ./sodinimas.php');
    exit;
}

// ISROVIMO SCENARIJUS
if (isset($_POST['rauti'])) {
    foreach($_SESSION['a'] as $index => $agurkas) {
        if ($_POST['rauti'] == $agurkas['id']) {
            unset($_SESSION['a'][$index]);
            header('Location: ./sodinimas.php');
            die;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sodinimas</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<header>
<a class="loggout" href="login.php?logout">Atsijungti</a>
<a href="sodinimas.php">Sodinimas</a>
<a href="auginimas.php">Auginimas</a>
<a href="skynimas.php">Skynimas</a>
</header>
<h1>Agurkų sodas</h1>
<h3>Sodinimas</h3>
    <?php include __DIR__.'/error.php' ?>
    <form action="" method="post">
    <?php foreach($_SESSION['a'] as $agurkas): ?>
    <div id = main>
    <img class="img" src="<?= $agurkas['img'] ?>" alt="agurkas">
    <p>Agurkas nr. <?= $agurkas['id'] ?></p>
    Agurkų: <?= $agurkas['agurkai'] ?>
    <button type="submit" name="rauti" value="<?= $agurkas['id'] ?>">Išrauti</button>
    </div>

    <?php endforeach ?>
    <input type="text" name="kiekis">
    <button type="submit" name="sodinti">SODINTI</button>
    
    </form>
</body>
</html>