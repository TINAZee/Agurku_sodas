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
        $_SESSION['err'] = 4; // <-- neigiamas agurku kiekis
        header('Location: ./sodinimas.php');
        exit;
    }

    foreach(range(0, $kiekis) as $_) {
        $_SESSION['a'][] = [
            'id' => ++$_SESSION['agurku ID'],
            $img = [
                "./img/img_1.jpg", 
                "./img/img_2.jpg", 
                "./img/img_3.jpg", 
                "./img/img_4.jpg", 
                "./img/img_5.jpg"
            ],
            'img' => $img[array_rand($img)],
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

    <?php foreach($_SESSION['a'] as $agurkas): ?>

    <div class = "row">

    <img class="img" src="<?= $agurkas['img'] ?>" alt="agurkas">

    <p>Agurko augalas nr. <?= $agurkas['id'] ?></p>

    <p style="color:rgb(19, 175, 2);font-size:18px">Agurkų vaisių: <?= $agurkas['agurkai'] ?></p>

    <button type="submit" class="btn" name="rauti" value="<?= $agurkas['id'] ?>">Išrauti</button>

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