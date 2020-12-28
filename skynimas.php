<?php
session_start();

if(!isset($_SESSION['logged']) || 1 != $_SESSION['logged']) {
    header('Location: http://localhost/BIT_KURSAI_PHP/Agurku_sodas/login.php');
    die;
}

if (!isset($_SESSION['a'])) {
    $_SESSION['a'] = [];
    $_SESSION['agurku ID'] = 0;
}

//SKINTI SCENARIJUS
if (isset($_POST['skinti'])) {
    foreach($_SESSION['a'] as $index => &$agurkas) {
            $skynimas = $_POST['kiek_skinti'];
                $agurkas['agurkai'] -= $_POST['kiek_skinti'][$agurkas['id']];
    }
    header('Location: http://localhost/BIT_KURSAI_PHP/Agurku_sodas/skynimas.php.');
    exit;
}


//SKINTI VISUS SCENARIJUS

if (isset($_POST['skinti_visus'])) {
    foreach ($_SESSION['a'] as $index => &$agurkas ) {
        if ($_POST['skinti_visus'] == $agurkas['id']) {
            $agurkas['agurkai'] -=  $agurkas['agurkai'];
        }
    }
    header('Location: http://localhost/BIT_KURSAI_PHP/Agurku_sodas/skynimas.php.');
    die;
}

//NUIMTI VISA DERLIU SCENARIJUS

if (isset($_POST['nuimtiDerliu'])) {
    foreach($_SESSION['a'] as $index => &$agurkas) {
        $agurkas['agurkai'] = 0;
    }
    header('Location: http://localhost/BIT_KURSAI_PHP/Agurku_sodas/skynimas.php.');
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
</head>
<body>
<header>
<a class="loggout" href="login.php?logout">Atsijungti</a>
<a href="sodinimas.php">Sodinimas</a>
<a href="auginimas.php">Auginimas</a>
<a href="skynimas.php">Skynimas</a>
</header>
<h1>Agurkų sodas</h1>
<h3>Agurkų skynimas</h3>
    <form action="" method="post">
    <?php foreach($_SESSION['a'] as $agurkas): ?>
    <div id = main>
    <td><img class="img" src="<?= $agurkas['img'] ?>" alt="agurkas">
    Agurkas Nr. <?= $agurkas['id'] ?>
    <p style="display:inline;color:red"> Galima skinti </p>
    <h1 style="display:inline;"><?= $agurkas['agurkai'] ?></h1>
    <input type="text" name="kiek_skinti[<?= $agurkas['id'] ?>]"value=<?= $skynimas ?? 0 ?>>
    <button type="submit" name="skinti">Skinti</button>
    <button type="submit" name="skinti_visus" value="<?= $agurkas['id'] ?>">Skinti visus</button>
    </div>
    <?php endforeach ?>
    <button type="submit" name="nuimtiDerliu">Nuimti visą derlių</button>
    </form>
</body>
</html>
