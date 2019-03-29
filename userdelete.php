<?php
session_start();
if($_SESSION['level'] != 2) {
    header("Location: index.php");
}
include_once("dbcon.php");
$link = DBcon();

if(isset($_POST['delete'])) {
    $user = $_POST['id'];
    $link->query("DELETE FROM users WHERE id = '$user';");
    $link->close();
    header("Location: useradmin.php");
}

if(!isset($_GET['id'])) {
    header("Location: useradmin.php");
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Megerősítés</title>
</head>
<body>
   <?php
    $id = $_GET['id'];
    $result = $link->query("SELECT name FROM users WHERE id = '$id';");
    if($result->num_rows == 0) {
        echo "Hiba, nincs ilyen felhasználó! (id: $id)";
        echo "<br><a href=\"useradmin.php\">Vissza</a>";
        exit;
    }
    $name = mysqli_fetch_assoc($result)['name'];
    $link->close();
    ?>
    Biztos ki szeretnéd törlni a <strong><?php echo $name ?></strong> felhasználót?
    <form action="userdelete.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="checkbox" name="yes" id="cb" value="yes">
        <label for="cb">Igen, tuti biztos vagyok benne.</label>
        <input type=submit name="delete" value="Ne is lássam többet!">
    </form>
</body>
</html>