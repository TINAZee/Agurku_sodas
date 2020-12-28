<?php
session_start();

if(isset($_GET['logout'])) {
    $_SESSION['logged'] = 0;
    header('Location: http://localhost/BIT_KURSAI_PHP/Agurku_sodas/sodinimas.php.');
    die;
}

if(isset($_SESSION['logged']) && 1 == $_SESSION['logged']) {
    echo "<span style='display: block; max-width: 200px; text-align:center; margin: auto; margin-top: 50px; padding: 100px; border: 2px solid #DCDCDC; border-radius: 5px; font-size: 20px'>
    Tu jau esi prisijungęs.</span>";
    die;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') { //JEIGU PASPAUDE MYGTUKA SUMBIT
    $data = json_decode(file_get_contents('data.json'),1);
    foreach($data as $user) {
        if(($_POST['vardas'] ?? '') === $user['name'] &&
            md5($_POST['pass'] ?? '') === $user['pass']){
               $_SESSION['vardas'] = $user['name'];
               $_SESSION['logged'] = 1;
               header('Location: http://localhost/BIT_KURSAI_PHP/Agurku_sodas/sodinimas.php.');
               die;
           }
    }
    $_SESSION['msg'] = "<span style='display: block; max-width: 300px; text-align:center; margin: auto; margin-top: 20px; font-size: 20px; color: #5c565c; text-transform: uppercase'>
    Bad email or password.</span>";
    header('Location: http://localhost/BIT_KURSAI_PHP/Agurku_sodas/login.php.');
    die;
}

if(isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h1>Agurkų sodas</h1>
    <div><?= $msg ?? '' ?></div>
    <form id = logginform action="" method="POST">
        <input class = logginfrm type="text" name="vardas" placeholder="Vardas">
        <br><br>
        <input class = logginfrm type="password" name="pass" value="" placeholder="Password">
        <br><br>
        <input class = logginfrm class="btn" type="submit" value="Login" value="">  
    </form>
</body>
</html>
