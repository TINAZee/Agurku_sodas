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
    $_SESSION['a'][] = [
        'id' => ++$_SESSION['agurku ID'],
        $img = ['./img/img_1.jpg', './img/img_2.jpg', './img/img_3.jpg','./img/img_4.jpg','./img/img_5.jpg'],
        'img' => $img[array_rand($img)],
        'agurkai' => 0
    ];
    header('Location:./sodinimas.php');
    die;
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
    <form action="" method="post">
    <?php foreach($_SESSION['a'] as $agurkas): ?>
    <div id = main>
    <img class="img" src="<?= $agurkas['img'] ?>" alt="agurkas">
    <p>Agurkas nr. <?= $agurkas['id'] ?></p>
    Agurkų: <?= $agurkas['agurkai'] ?>
    <button type="submit" name="rauti" value="<?= $agurkas['id'] ?>">Išrauti</button>
    </div>

    <?php endforeach ?>
    <button type="submit" name="sodinti">SODINTI</button>
    </form>
</body>
</html>