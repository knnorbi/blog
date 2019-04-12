<?php
session_start();
if($_SESSION['level'] < 1) {
    header("Location: index.php");
}

include_once("dbcon.php");
$link = DBcon();

if(isset($_POST['reply']) && strlen($_POST['reply'])) {
    $user = $_SESSION['id'];
    $reply = $_POST['reply'];
    $datum = date('Y-m-d H:i:s');
    $replyFor = $_POST['replyfor'];

    $link->query("INSERT INTO uzik VALUES (NULL, $user, '$datum', '$reply', $replyFor);");
    header("Location: index.php");
}
$replyFor = $_GET['id'];

$result = $link->query("SELECT uzi, name 
FROM uzik LEFT JOIN users ON users.id = uzik.user
WHERE uzik.id = $replyFor;");

$adatok = mysqli_fetch_assoc($result);
$user = $adatok['name'];
if($user == "NULL")
    $user = "törölt felhasználó";
$uzenet = $adatok['uzi'];
?>

<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Válasz</title>
</head>
<body>
    <h3>Válasz küldése egy üzenetre</h3>
    <p>Felhasználó: <?php echo $user; ?></p>
    <p>Üzenet: <?php echo $uzenet; ?></p>
    <form method="post" action="reply.php">
        <textarea name="reply"></textarea><br>
        <input type="hidden" name="replyfor" value="<?php echo $replyFor; ?>">
        <input type="submit">
    </form>
</body>
</html>
