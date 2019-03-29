<?php
session_start();
if($_SESSION['level'] != 2) {
    header("Location: index.php");
}
include_once("dbcon.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Felhasználók kezelése</title>
</head>
<body>
<h1>Felhasználók kezelése</h1>
<p><a href="index.php">Visszalépés a főoldalra</a></p>
<h2>Felhasználó hozzáadása</h2>
<form action="reg.php" method="post">
    <input type="hidden" name="admin" value="1">
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
<h2>Felhasználók</h2>
<?php
    
$link = DBcon();
$result = $link->query("SELECT id, name FROM users WHERE level = 1;");

echo "<table>";

while($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $id = $row['id'];
    echo "<tr>";
    echo "<td>$name</td>";
    echo "<td><a href=\"userdelete.php?id=$id\">Törlés</a></td>";
    echo "</tr>";
}

echo "</table>";

?>

    
</body>
</html>