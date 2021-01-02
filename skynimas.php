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

//SKINTI SCENARIJUS
if (isset($_POST['skinti'])) {

    $nuskinti = $_POST['kiek_skinti'];
    foreach($_SESSION['a'] as $index => &$agurkas) {

        if ((int)$_POST['kiek_skinti'][$agurkas['id']] < 0 ) { 
            $_SESSION['err'] = 1; 
        }
        elseif ((int)$_POST['kiek_skinti'][$agurkas['id']] > $agurkas['agurkai'] ) {
            $_SESSION['err'] = 3;  
        }
        elseif (!is_numeric($nuskinti)) {
            $_SESSION['err'] = 4;  
        } 
        elseif (!is_int($nuskinti)) {
            $_SESSION['err'] = 5;  
        } 
        else {
        $agurkas['agurkai'] -= (int)$_POST['kiek_skinti'][$agurkas['id']];
        }
    }
    header('Location: ./skynimas.php');
    exit;
    }



//SKINTI VISUS SCENARIJUS

if (isset($_POST['skinti_visus'])) {

    foreach ($_SESSION['a'] as $index => &$agurkas ) {
        if ($_POST['skinti_visus'] == $agurkas['id']) {
            $agurkas['agurkai'] -=  $agurkas['agurkai'];
        }
    }
    header('Location: ./skynimas.php');
    die;
}

//NUIMTI VISA DERLIU SCENARIJUS

if (isset($_POST['nuimtiDerliu'])) {
    foreach($_SESSION['a'] as $index => &$agurkas) {
        $agurkas['agurkai'] = 0;
    }
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
</head>
<body>
<header>
<a class="loggout" href="login.php?logout">Atsijungti</a>
<a href="sodinimas.php">Sodinimas</a>
<a href="auginimas.php">Auginimas</a>
<a href="skynimas.php">Skinimas</a>
</header>
<h1>Agurkų sodas</h1>
<h3>Agurkų skinimas</h3>
    <?php include __DIR__.'/error.php' ?>

    <div class = "container">

    <form action="" method="post">

    <?php foreach($_SESSION['a'] as $agurkas): ?>

    <div class = "row col-3 col-lg-3 col-md-2">
    <td><img class="img" src="<?= $agurkas['img'] ?>" alt="agurkas">
    <p> Agurkas Nr. <?= $agurkas['id'] ?></p>
    <p style="color:red"> Galima skinti: </p>
    <h1 style="background-color: rgb(174, 226, 174);"><?= $agurkas['agurkai'] ?></h1>
    <input type="text" class="text" style="display:inline-block;" name="kiek_skinti[<?= $agurkas['id'] ?>]"value=<?= $nuskinti ?? 0 ?>>
    <button type="submit" name="skinti">Skinti</button>
    <br>
    <button type="submit" name="skinti_visus" value="<?= $agurkas['id'] ?>">Skinti visus</button>
    </div>
    <?php endforeach ?>
    <br>
    <button type="submit" name="nuimtiDerliu">Nuimti visą derlių</button>
    </form>
    </div>
</body>
</html>
