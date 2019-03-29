<?php
include_once("dbcon.php");
$minleng = 6;
session_start();
if(isset($_SESSION['level']) && $_SESSION['level'] > 0 && !isset($_POST['admin'])) {
    header("Location: index.php");
}
if(isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['password2'])) {
    $link = DBcon();
    $ok = true;
    $user = $_POST['username'];
    if(strlen($user) < 5) {
        echo "<div>Túl rövid felhasználónév!</div>";
        $ok = false;
    }
    if($ok) {
        $result = $link->query("SELECT id FROM users WHERE name = '$user';");
        if($result->num_rows != 0) {
            echo "<div>Foglalt felhasználónév!</div>";
            $ok = false;
            $link->close();
        }
    }
    if($ok && strlen($_POST['password1']) < $minleng) {
        echo "<div>A jelszónak legalább $minleng karakterből kell állnia!</div>";
        $ok = false;
    }
    if($ok && $_POST['password1'] != $_POST['password2']) {
        echo "<div>A két jelszó nem egyezik meg!</div>";
        $ok = false;
    }
    if($ok) {
        $pass = md5($_POST['password1']);
        $link->query("INSERT INTO users VALUES (NULL, '$user', '$pass', 1);");
        $link->close();
        if($_POST['admin'] != 1) {
            header("Location: regsuccess.php");
        }
        else {
            header("Location: useradmin.php");
        }
    }
    if(!$ok && $_POST['admin'] == 1) {
        echo "<br><a href=\"useradmin.php\">Vissza</a>";
        exit;
    }
}

?>

<h2>Regisztráció</h2>
<form action="reg.php" method="post">
    <div>
    <label for="username">Felhasználónév:</label>
    <input type="text" name="username" id="username" autofocus>
    </div>
    <div>
    <label for="password1">Jelszó:</label>
    <input type="password" name="password1" id="password1">
    </div>
    <div>
    <label for="password2">Jelszó újra:</label>
    <input type="password" name="password2" id="password2">
    </div>
    <div>
    <input type="submit">
    </div>
</form>