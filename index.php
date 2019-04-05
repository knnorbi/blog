<?php
session_start();
if($_SESSION['level'] < 1) {
    header("Location: login.php");
}

include_once("dbcon.php");
$link = DBcon();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-3">
<form action="index.php" method="post">
<div class="form-group">
<label for="uzi">Message</label>
<textarea class="form-control" name="uzi" id="uzi" autofocus></textarea><br>
</div>
<input type="submit" class="btn btn-primary">
</form>

    <hr>
    <h4>Üzenetek szűrése</h4>
    <form method="get" action="index.php">
        <div class="form-group">
        <label for="SelectedUser">Felhasználó:</label>
        <select class="form-control" id="SelectedUser" name="selectedUser">
            <option value="0">Mindenki</option>
            <?php
            $result = $link->query("SELECT id, name FROM users;");
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $user = $row['name'];
                echo "<option value=\"$id\"";
                if(isset($_GET['selectedUser']) && $_GET['selectedUser'] == $id) {
                    echo " selected";
                }
                echo ">$user</option>";
            }
            ?>
        </select>
        </div>
        <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Szűrés">
        </div>
    </form>
    <hr>
    <a href="logout.php">Logout</a>
    <?php
    if($_SESSION['level'] == 2) {
        echo "<br><a href=\"useradmin.php\">Felhasználók kezelése</a>";
    }
    ?>
</div>

<div class="col-md-9">
<?php
if(isset($_POST['uzi'])) {
    $uzenet = $_POST['uzi'];
    $datum = date('Y-m-d H:i:s');
    $id = $_SESSION['id'];
    $query = "INSERT INTO uzik VALUES (NULL, $id, \"$datum\", \"$uzenet\");";
    //echo $query;
    $link->query($query);
}
$feltetel = "";

if(isset($_GET['selectedUser']) && $_GET['selectedUser'] != 0) {
    $feltetel = "WHERE users.id = " . $_GET['selectedUser'];
}

$eredmeny = $link->query(
        "SELECT uzik.id, uzi, name, date 
FROM uzik LEFT JOIN users ON users.id = uzik.user 
$feltetel 
ORDER BY date;");

while ($row = mysqli_fetch_array($eredmeny)) {
    $uzi = $row['uzi'];
    $date = $row['date'];
    $user = $row['name'];
    if($user == null) {
        $user = "törölt felhasználó";
    }
    echo "<i>$user said at $date</i><br>";
    echo "<p>$uzi</p>";
    if($_SESSION['level'] == 2) {
        $id = $row['id'];
        echo "<a href=\"delete.php?id=$id\">Delete</a>";
    }
    echo "<hr>";
}

$link->close();
    
?>
</div>
</div>
</div> 
</body>
</html>






















