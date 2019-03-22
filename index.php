<?php
session_start();
if($_SESSION['level'] < 1) {
    header("Location: login.php");
}
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
<textarea class="form-control" name="uzi" id="uzi"></textarea><br>
</div>
<input type="submit" class="btn btn-primary">
</form>
<a href="logout.php">Logout</a>
</div>

<div class="col-md-9">
<?php

include_once("dbcon.php");
$link = DBcon();

if(isset($_POST['uzi'])) {
    $uzenet = $_POST['uzi'];
    $datum = date('Y-m-d H:i:s');
    $id = $_SESSION['id'];
    $query = "INSERT INTO uzik VALUES (NULL, $id, \"$datum\", \"$uzenet\");";
    //echo $query;
    $link->query($query);
}

$eredmeny = $link->query("SELECT uzik.id, uzi, name, date FROM uzik INNER JOIN users ON users.id = uzik.user;");

while ($row = mysqli_fetch_array($eredmeny)) {
    $uzi = $row['uzi'];
    $date = $row['date'];
    $user = $row['name'];
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






















