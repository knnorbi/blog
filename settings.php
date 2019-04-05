<?php
session_start();
if($_SESSION['level'] < 1) {
    header("Location: index.php");
}
include_once("dbcon.php");
$link = DBcon();

$userName = $_SESSION['user'];
$userId = $_SESSION['id'];

$hiba = false;
$siker = false;

if(isset($_POST['pass1']) && isset($_POST['pass2'])) {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if($pass1 != $pass2) {
        $hiba = true;
    }
    elseif (strlen($pass1) < 5) {
        $hiba = true;
    }
    else {
        $password = md5($pass1);
        $link->query("UPDATE users SET password = $password WHERE id = $userId;");
        $siker = true;
    }
}
?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beállítások</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div>
            <h2>Felhasználó fiók beállítása</h2>
        </div>
    </div>
    <div class="row">
        <div>
            <p>Üdvözöllek <?php echo $userName;?> a fiókod beállítása oldalon!</p>
            <p><a href="index.php">Vissza a főoldalra</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3>Jelszó megváltoztatása</h3>
        </div>
        <div class="col-md-8">
            <form action="settings.php" method="post">
                <div class="form-group">
                    <label for="pass1">Új jelszó:</label>
                    <input class="form-control" type="password" id="pass1" name="pass1">
                </div>
                <div class="form-group">
                    <label for="pass2">Új jelszó újra:</label>
                    <input class="form-control" type="password" id="pass2" name="pass2">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Jelszó változtatása">
                </div>
            </form>
            <?php if($hiba) { print(file_get_contents("jelszohiba.php")); }?>
            <?php if($siker) { print(file_get_contents("jelszosiker.php")); }?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3>Regisztráció törlése</h3>
        </div>
        <div class="col-md-8">
            
        </div>
    </div>
</div>
</body>
</html>
