<?php

if (isset($_POST['sodinti_z'])) {

$kiekis = (int) $_POST['kiekis'];

if (0 > $kiekis || 4 < $kiekis) { // <--- validacija
    if (0 > $kiekis) {
        $_SESSION['err'] = 1; // <-- neigiamas kiekis
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

        $zirnioObj = new Zirniai($_SESSION['ID']);
        $_SESSION['ID']++;
        $_SESSION['obj1'][] = serialize($zirnioObj);
        // $_SESSION['a'][] = [
        //     'id' => ++$_SESSION['ID'],
        //     'agurkai' => 0
        // ];
    }
}

if ($kiekis > 1 ) {

    foreach(range(0, $kiekis-1) as $_) {

        $zirnioObj = new Zirniai($_SESSION['ID']);
        $_SESSION['ID']++;
        $_SESSION['obj1'][] = serialize($zirnioObj);
    

        // $_SESSION['a'][] = [
        //     'id' => ++$_SESSION['agurku ID'],
        //     'agurkai' => 0
        // ];
    }
}

header('Location: ./sodinimas.php');
exit;
}