<?php
namespace TINAZee;

use TINAZee\Agurkas;
use TINAZee\Zirnis;

class App {
    //router
public static function route() {

    $uri = str_replace(INSTALL_FOLDER,'',$_SERVER['REQUEST_URI']);
    $uri = explode('/', $uri);

    if ('sodinimas' == $uri[0]) {
    include DIR. '/sodinimas.php';
    }
    elseif ('auginimas' == $uri[0]) {
        include DIR. '/auginimas.php';
    }
    elseif ('skynimas' == $uri[0]) {
        include DIR. '/skynimas.php';
    }
}

public static function redirect($url)
{
    header('Location: '.URL.$url);
    exit;
}
    // public static function setSession() {
    //     if (!isset($_SESSION['a'])) {
    //         $_SESSION['a'] = [];
    //         $_SESSION['obj'] = []; //<----- agurko objektai
    //         $_SESSION['obj1'] = [];//<----- zirnio objektai
    //         $_SESSION['ID'] = 0;
    //     }
    // }


    // public static function sodintiAgurka() {

    //     $agurkoObj = new Agurkas($_SESSION['ID']);
    //     $_SESSION['ID']++;
    //     $_SESSION['obj'][] = serialize($agurkoObj); 
    // }


    // public static function sodintiZirni() {

    //     $zirnioObj = new Zirniai($_SESSION['ID']);
    //     $_SESSION['ID']++;
    //     $_SESSION['obj1'][] = serialize($zirnioObj); 
    // }

    // public static function rauti() {

    //     if (isset($_POST['rauti'])) {

    //         foreach($_SESSION['obj'] as $index => $agurkas) {
    //             $agurkas = unserialize($agurkas);
    //             if ($_POST['rauti'] == $agurkas->id) {
    //                 unset($_SESSION['obj'][$index]);
    //                 header('Location: ./sodinimas.php');
    //                 exit;
    //             }
    //         }
    //         foreach($_SESSION['obj1'] as $index => $zirnis) {
    //             $zirnis = unserialize($zirnis);
    //             if ($_POST['rauti'] == $zirnis->id) {
    //                 unset($_SESSION['obj1'][$index]);
    //                 header('Location: ./sodinimas.php');
    //                 exit;
    //             }
    //         }
    //     }
    // }

    // public static function auginti() {

    //     foreach($_SESSION['obj'] as $index => $agurkas) { // <---- serializuotas stringas
    //         $agurkas = unserialize($agurkas); // <----- agurko objektas
    //         $agurkas->addVegatable($_POST['kiekis'][$agurkas->id]); // <------- pridedam agurka
    //         $agurkas = serialize($agurkas); // <------ vel stringas
    //         $_SESSION['obj'][$index] = $agurkas; // <----- uzsaugom agurkus
    //     }
    
    //     foreach($_SESSION['obj1'] as $index => $zirnis) { 
    //         $zirnis = unserialize($zirnis); 
    //         $zirnis->addVegatable($_POST['kiekis'][$zirnis->id]); 
    //         $zirnis = serialize($zirnis); 
    //         $_SESSION['obj1'][$index] = $zirnis; 
    //     }
    // }

    // public static function skinti() {
    //     $nuskinti = $_POST['kiek_skinti'];

    //     foreach($_SESSION['obj'] as $index => $agurkas) {
    
    //         $agurkas = unserialize($agurkas); // <----- agurko objektas
    //         $agurkas->removeVegatable($_POST['kiek_skinti'][$agurkas->id]); // <------- atimam agurka
    //         $agurkas = serialize($agurkas); // <------ vel stringas
    //         $_SESSION['obj'][$index] = $agurkas; // <----- uzsaugom agurkus
    //     }
    
    //     foreach($_SESSION['obj1'] as $index => $zirnis) {
    
    //         $zirnis = unserialize($zirnis); // <----- agurko objektas
    //         $zirnis->removeVegatable($_POST['kiek_skinti'][$zirnis->id]); // <------- atimam agurka
    //         $zirnis = serialize($zirnis); // <------ vel stringas
    //         $_SESSION['obj1'][$index] = $zirnis; // <----- uzsaugom agurkus
    //     }
    // }

    // public static function skintiVisus() {
    //     foreach ($_SESSION['obj'] as $index => $agurkas ) {
    //         $agurkas = unserialize($agurkas); // <----- agurko objektas
    //         $agurkas->removeAllVegatables($_POST['skinti_visus']); // <------- atimam visus agurka
    //         $agurkas = serialize($agurkas); // <------ vel stringas
    //         $_SESSION['obj'][$index] = $agurkas; // <----- uzsaugom agurkus
    //     }

    //     foreach ($_SESSION['obj1'] as $index => $zirnis ) {
    //         $zirnis = unserialize($zirnis); // <----- agurko objektas
    //         $zirnis->removeAllVegatables($_POST['skinti_visus']); // <------- atimam visus agurka
    //         $zirnis = serialize($zirnis); // <------ vel stringas
    //         $_SESSION['obj1'][$index] = $zirnis; // <----- uzsaugom agurkus
    //     }

    // }

    // public static function nuimtiVisaDerliu() {
    //     $_SESSION['obj'] = Agurkas::nuimtiDerliu($_SESSION['obj']);
    //     $_SESSION['obj1'] = Zirniai::nuimtiDerliu($_SESSION['obj']);
    // }

    // public static function redirect($fileName) {
    //     header("Location: ./$fileName.php");
    //     exit;
    // }
}